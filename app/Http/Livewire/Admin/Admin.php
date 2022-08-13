<?php

namespace App\Http\Livewire\Admin;

use App\Models\TipoUsuario;
use Livewire\WithPagination;
use App\Models\User;


use Livewire\Component;

class Admin extends Component
{
    use WithPagination;

    protected $listeners = [ 'update2' => 'update2'];

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $nombre, $direccion, $descripcion;
    public $updateMode = false;

    public function render()
    {
        $TipoUsuario = TipoUsuario::all();
        $keyWord = '%'.$this->keyWord .'%';
        return view('livewire.admin.admin', [
            'users' => $resultado = User::join("tipo_usuarios", "tipo_usuarios.id", "=", "users.tipo_usuarios_id")
                        ->select("users.id","users.name", "users.email","tipo_usuarios.descripcion","users.tipo_usuarios_id")
						->orWhere('users.id', 'LIKE', $keyWord)	
                        ->orWhere('users.name', 'LIKE', $keyWord)						
						->orWhere('users.email', 'LIKE', $keyWord)
                        ->orWhere('tipo_usuarios.descripcion', 'LIKE', $keyWord)
						->paginate(10),
                        'TipoUsuario' => $TipoUsuario]);
    }

    public function update2($id,$tipousuario) {      
        $usuario = User::findOrFail($id);
        $usuario->tipo_usuarios_id = $tipousuario;
        $usuario->save();    
        $this->emit('alert','Cambio estado usuario aplicado'); 
       
       
    }

}
