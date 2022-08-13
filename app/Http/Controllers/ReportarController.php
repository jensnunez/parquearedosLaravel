<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Periodo;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Reporte;
use App\Models\Sede;
use App\Models\TipoReporte;
use App\Models\Vehiculo;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use App\Mail\ReportarMail;
use Illuminate\Support\Facades\Mail;


class ReportarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $TipoReportes = TipoReporte::all();
        $Vehiculos = Vehiculo::all();
        $periodos = Periodo::all();
        $Sedes = Sede::all();

        return view(' livewire.reportes.index', [
            'reportes' => $resultado = Reporte::join("tipo_reportes", "tipo_reportes.id", "=", "reportes.tipo_reporte_id")
            ->join("vehiculos", "vehiculos.id", "=", "reportes.placa_id")
            ->join("users", "users.id", "=", "reportes.user_id")
            ->join("sedes", "sedes.id", "=", "reportes.sede_id")
            ->join("periodos", "periodos.id", "=", "reportes.periodo_id")           
                        ->select("reportes.id", "reportes.image","reportes.fecha", "reportes.estado","tipo_reportes.descripcion as tipo_reporte","vehiculos.placa","users.name as usuario","sedes.descripcion as sede","periodos.descripcion as periodo")
                        ->Where('reportes.estado', '=', 1)                                    
						->paginate(10),
                        'TipoReportes' => $TipoReportes,
                        'Vehiculos' => $Vehiculos,
                        'periodos' => $periodos,
                        'Sedes' => $Sedes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'fecha' => 'required',        
            'tipo_reporte_id' => 'required',
            'placa_id' => 'required',       
            'sede_id' => 'required',  
            'periodo_id' => 'required' ,
            'image' => 'required'
            ]);
        
            // script para subir la imagen
        if($request->hasFile("image")){

            $imagen = $request->file("image");           
            $nombreimagen =  time()."_".$imagen->getClientOriginalName() .".".$imagen->guessExtension();
            $ruta = public_path("imagenes/");
            //$imagen->move($ruta,$nombreimagen);
            copy($imagen->getRealPath(),$ruta.$nombreimagen);                    
            
        }

        Reporte::create(['fecha' => $request-> fecha,
        'estado' => 1,
        'tipo_reporte_id' => $request-> tipo_reporte_id,
        'placa_id' => $request-> placa_id,
        'user_id' =>  Auth::user()->id,
        'sede_id' => $request-> sede_id,
        'periodo_id' => $request->periodo_id,
        'image' => $nombreimagen,]);      

        $record = Vehiculo::where("id","=", $request-> placa_id)->select("placa")->value('placa');


        $correodestino =  Auth::user()->email;
        $correo = new ReportarMail($record,$ruta.$nombreimagen);
        Mail::to($correodestino)->send($correo);
      
	
        return redirect()->route('reportar.index')->with("success","Correo enviado exitosamente!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
