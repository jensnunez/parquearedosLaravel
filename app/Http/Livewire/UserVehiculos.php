<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\UsuarioVehiculo;
use App\Models\Vehiculo;
use Livewire\Component;
use Livewire\WithPagination;





class UserVehiculos extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $placa,  $placa_id=1,  $keyWord, $user_id=1;
    public $updateMode = false;
   

    public function cancel()
    {
        $this->resetInput();
        $this->updateMode = false;
    }
	
    private function resetInput()
    {			
        $this->user_id = null;
    }
   




    public function render()
    {
        
        $record = Vehiculo::where("placa","=",$this->placa)->select("id")->value('id');
      
        $usuarios = User::whereNotIn('id', function($query) {
            $recordV = Vehiculo::where("placa","=",$this->placa)->select("id")->value('id');
            $query->select('user_id')->from('user_vehiculo')
            ->orWhere('user_vehiculo.placa_id', '=',  $recordV);
        })->get();    
        $vehiculos = Vehiculo::all();
       
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.user-vehiculos.view', [
            'user_vehiculo' => $resultado = UsuarioVehiculo::join("vehiculos", "vehiculos.id", "=", "user_vehiculo.placa_id")
            ->join("users", "users.id", "=", "user_vehiculo.user_id")
                        ->select("vehiculos.placa","users.name", "users.email")
						->Where('vehiculos.id', '=',  $record)	                      
						->paginate(10),                       
                        'usuarios' => $usuarios,
                        'vehiculos' => $vehiculos]);
    }

   
    public function store()
    {
        $this->validate([
		'placa_id' => 'required',
        'user_id' => 'required',		
        ]);     
        $record = Vehiculo::where("placa","=",$this->placa)->select("id")->value('id');


        UsuarioVehiculo::create([ 
			'placa_id' =>  $record,
			'user_id' => $this->user_id
        ]);       
        
        $this->resetInput();
		$this->emit('closeModal');
        $this->emit('alert','Se asigno usuario al vehiculo satisfactoriamente');
		session()->flash('message', 'Asignacion Successfully.');
    }
   


   




}
