<?php

namespace App\Http\Livewire;
use RealRashid\SweetAlert\Facades\Alert;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\TipoVehiculo;
use App\Models\Vehiculo;
use Illuminate\Support\Facades\DB;

class TipoVehiculos extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $descripcion;
    public $updateMode = false;

    protected $listeners = [ 'eliminar' => 'eliminar'];
    

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.tipo-vehiculos.view', [
            'tipoVehiculos' => TipoVehiculo::latest()
						->orWhere('descripcion', 'LIKE', $keyWord)
						->paginate(10),
        ]);
    }
	
    public function cancel()
    {
        $this->resetInput();
        $this->updateMode = false;
    }
	
    private function resetInput()
    {		
		$this->descripcion = null;
    }

    public function store()
    {
        $this->validate([
		'descripcion' => 'required',
        ]);

        TipoVehiculo::create([ 
			'descripcion' => $this-> descripcion
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
        $this->emit('alert','Tipo de vehiculo se creo satisfactoriamente'); 
		session()->flash('message', 'TipoVehiculo satisfactoriamente creado.');
    }

    public function edit($id)
    {
        $record = TipoVehiculo::findOrFail($id);

        $this->selected_id = $id; 
		$this->descripcion = $record-> descripcion;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'descripcion' => 'required',
        ]);

        if ($this->selected_id) {
			$record = TipoVehiculo::find($this->selected_id);
            $record->update([ 
			'descripcion' => $this-> descripcion
            ]);

            $this->resetInput();
            $this->updateMode = false;
            $this->emit('alert','la sede se actualizo satisfactoriamente'); 
			session()->flash('message', 'TipoVehiculo satisfactoriamente  actualizado.');
        }
    }

    public function eliminar($id)
    {         
        if (DB::table('vehiculos')
            ->where('tipo_vehiculo_id',$id)->count() == 0 ) 
            {
                if ($id) {
                    $record = TipoVehiculo::where('id', $id);
                    $record->delete();
                }               
                
            } else {
                $this->emit('alertnodelete','el registro no se puede borrar porque esta asosiado a un vehiculo.','Vehiculos');
            }       
    }
}
