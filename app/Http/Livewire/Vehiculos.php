<?php

namespace App\Http\Livewire;

use App\Models\Reporte;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Vehiculo;
use App\Models\TipoVehiculo;
use App\Models\UsuarioVehiculo;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\DocBlock\Tags\Uses;
use Illuminate\Support\Facades\Route;
class Vehiculos extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $placa, $tipo_vehiculo_id=1, $observacion, $propietario= false, $user_id=1, $placa_;
    public $updateMode = false;
    protected $listeners = [ 'eliminar' => 'eliminar'];
     
   



    public function render( )
    {
        $usuarios = User::all();
        $TipoVehiculo = TipoVehiculo::all();
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.vehiculos.view', [
            'vehiculos' => $resultado = Vehiculo::join("tipo_vehiculos", "tipo_vehiculos.id", "=", "vehiculos.tipo_vehiculo_id")
                        ->select("vehiculos.id","vehiculos.placa", "tipo_vehiculos.descripcion","vehiculos.observacion")
						->orWhere('vehiculos.placa', 'LIKE', $keyWord)	
                        ->orWhere('tipo_vehiculos.descripcion', 'LIKE', $keyWord)						
						->orWhere('vehiculos.observacion', 'LIKE', $keyWord)
						->paginate(10),
                        'TipoVehiculo' => $TipoVehiculo,
                        'usuarios' => $usuarios]);
    }

	
    public function cancel()
    {
        $this->resetInput();
        $this->updateMode = false;
    }
	
    private function resetInput()
    {		
		$this->placa = null;
		$this->tipo_vehiculo_id = null;
		$this->observacion = null;
        $this->propietario= null;
        $this->user_id = null;
    }

    public function store()
    {
        $this->validate([
		'placa' => 'required',
        'tipo_vehiculo_id' => 'required',
		'observacion' => 'required',       
        ]);

     

        Vehiculo::create([ 
			'placa' => $this-> placa,
			'tipo_vehiculo_id' => $this->tipo_vehiculo_id,
			'observacion' => $this-> observacion
        ]);

        $record = Vehiculo::where("placa","=",$this-> placa)->select("id")->value('id');
      
       
        if ($this->propietario) {
          UsuarioVehiculo::create([
            'placa_id' => $record,
            'user_id' =>  Auth::user()->id,

          ]);
        }
       
        
        
        $this->resetInput();
		$this->emit('closeModal');
        $this->emit('alert','Vehiculo se creo satisfactoriamente');
		session()->flash('message', 'Vehiculo Successfully created.');
    }

    public function edit($id)
    {
        $record = Vehiculo::findOrFail($id);

        $this->selected_id = $id; 
		$this->placa = $record-> placa;
		$this->tipo_vehiculo_id = $record-> tipo_vehiculo_id;
		$this->observacion = $record-> observacion;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		
		'tipo_vehiculo_id' => 'required',
		'observacion' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Vehiculo::find($this->selected_id);
            $record->update([ 			
			'tipo_vehiculo_id' => $this-> tipo_vehiculo_id,
			'observacion' => $this-> observacion
            ]);

            $this->resetInput();
            $this->updateMode = false;
            $this->emit('alert','Vehiculo se actualizo satisfactoriamente');
			session()->flash('message', 'Vehiculo Successfully updated.');
        }
    }

    public function eliminar($id)
    {
        if (DB::table('user_vehiculo')
            ->where('placa_id',$id)->count() == 0 ) 
            {
                if (DB::table('reportes')
                ->where('placa_id',$id)->count() == 0 ) 
                {

                    if ($id) {
                        $record = Vehiculo::where('id', $id);
                        $record->delete();
                    }               
                
            } else {
                $this->emit('alertnodelete','el registro no se puede borrar porque esta asosiado a un reporte.','Reportes');
            }    
        } else {
                $this->emit('alertnodelete','el registro no se puede borrar porque esta asosiado a un usuario.','Usuarios');
            }      
    }

    public function autorizar($id)
    {
        if (DB::table('user_vehiculo')
        ->where('placa_id',$id)->count() == 0 ) 
        {

        }

        $record = Vehiculo::findOrFail($id);

        $this->selected_id = $id; 
		$this->placa = $record-> placa;
		$this->tipo_vehiculo_id = $record-> tipo_vehiculo_id;
		$this->observacion = $record-> observacion;
		
        $this->updateMode = true;
    }

    public function user_vehiculo($id)
    {       
        $placa3 = Vehiculo::findOrFail($id);              
        return redirect()->route('asignar',compact('placa'));
       
    }


}
