<?php

namespace App\Http\Livewire;

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

class Reportes extends Component
{
    use WithPagination;
    use WithFileUploads;
	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $fecha,$estado, $tipo_reporte_id=1, $placa_id=1, $user_id=1, $sede_id=1,$image, $periodo_id=1;
    public $updateMode = false;
    protected $listeners = ['update2' => 'update2'];




    public function render( )
    {
        $TipoReportes = TipoReporte::all();
        $Vehiculos = Vehiculo::all();
        $periodos = Periodo::all();
        $Sedes = Sede::all();
		
        return view('livewire.reportes.view', [
            'reportes' => $resultado = Reporte::join("tipo_reportes", "tipo_reportes.id", "=", "reportes.tipo_reporte_id")
            ->join("vehiculos", "vehiculos.id", "=", "reportes.placa_id")
            ->join("users", "users.id", "=", "reportes.user_id")
            ->join("sedes", "sedes.id", "=", "reportes.sede_id")
            ->join("periodos", "periodos.id", "=", "reportes.periodo_id")           
                        ->select("reportes.id","reportes.image","reportes.fecha", "reportes.estado","tipo_reportes.descripcion as tipo_reporte","vehiculos.placa","users.name as usuario","sedes.descripcion as sede","periodos.descripcion as periodo")
                        ->Where('reportes.estado', '=', 1)
                        ->where(function ($query) {
                            $keyWord = '%'.$this->keyWord .'%';
                        $query->where('vehiculos.placa', 'LIKE', $keyWord)	
                        ->orWhere('tipo_reportes.descripcion', 'LIKE', $keyWord)						
						->orWhere('sedes.descripcion', 'LIKE', $keyWord)
                        ->orWhere('reportes.fecha', 'LIKE', $keyWord) ;
                    })                      
						->paginate(10),
                        'TipoReportes' => $TipoReportes,
                        'Vehiculos' => $Vehiculos,
                        'periodos' => $periodos,
                        'Sedes' => $Sedes]);
    }
	
    public function cancel()
    {
        $this->resetInput();
        $this->updateMode = false;
    }
	
    private function resetInput()
    {		
		$this->fecha = null;
		$this->estado = null;
		$this->tipo_reporte_id = null;
        $this->placa_id = null;
		$this->user_id = null;
		$this->sede_id = null;
        $this->image = null;
        $this->periodo_id=null;
    }

    public function store()
    {
        $this->validate([
		'fecha' => 'required',        
		'tipo_reporte_id' => 'required',
        'placa_id' => 'required',       
		'sede_id' => 'required',  
        'periodo_id' => 'required' ,
        'image' => 'required'
        ]);
        $image = $this->image->store('imagen');
     

        Reporte::create([ 
			'fecha' => $this-> fecha,
			'estado' => 1,
			'tipo_reporte_id' => $this-> tipo_reporte_id,
            'placa_id' => $this-> placa_id,
			'user_id' =>  Auth::user()->id,
			'sede_id' => $this-> sede_id,
            'periodo_id' => $this->periodo_id,
            'image' => $this-> image,
           
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
        $this->emit('alert','se creo el reporte satisfactoriamente'); 
		session()->flash('message', 'Reporte Successfully created.');
    }

    public function edit($id)
    {
        $record = Reporte::findOrFail($id);

        $this->selected_id = $id; 
		$this->fecha = $record-> fecha;
		$this->tipo_reporte_id = $record-> tipo_reporte_id;
		$this->placa_id = $record-> placa_id;       
		$this->sede_id = $record-> sede_id;
        $this->image = $record-> image;
        $this->periodo_id = $record-> periodo_id;

        $this->updateMode = true;
    }

    public function update2($id) {      
        $reporte = Reporte::findOrFail($id);
        $reporte->estado = 0;
        $reporte->save();    
        $this->emit('alert','Reporte desbloqueado'); 
       
       
    }

    public function eliminar($id)
    {
        if ($id) {
            $record = Reporte::where('id', $id);
            $record->delete();
        }
    }
}

