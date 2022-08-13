<?php

namespace App\Http\Livewire;
use RealRashid\SweetAlert\Facades\Alert;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Sede;
use Illuminate\Support\Facades\DB;

class Sedes extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $nombre, $direccion, $descripcion;
    public $updateMode = false;

    public $direction ='desc' ;
    public $sort = 'nombre' ;
  


    protected $listeners = [ 'eliminar' => 'eliminar'];


    public function render()
    {
       
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.sedes.view', [
            'sedes' => Sede::Where('nombre', 'LIKE', $keyWord)
						->orWhere('direccion', 'LIKE', $keyWord)
						->orWhere('descripcion', 'LIKE', $keyWord)
                        ->orderby($this->sort,$this->direction)
						->paginate(10),
        ]);
    }

    public function order($sort) {

        if($this->sort==$sort) {
            if($this->direction=='desc') {
                $this->direction= 'asc';
            } else {
                $this->direction= 'desc';
            }

        } else {
            $this->sort= $sort;
            $this->direction= 'desc';
        }
        
    }

	
    public function cancel()
    {
        $this->resetInput();
        $this->updateMode = false;
    }
	
    private function resetInput()
    {		
		$this->nombre = null;
		$this->direccion = null;
		$this->descripcion = null;
    }

    public function mensaje(){
        alert()->info('Title','Lorem Lorem Lorem');
    }

    public function store()
    {
       
        $this->validate([
		'nombre' => 'required',
		'direccion' => 'required',
		'descripcion' => 'required',
        ]);
        
        Sede::create([ 
			'nombre' => $this-> nombre,
			'direccion' => $this-> direccion,
			'descripcion' => $this-> descripcion
        ]);
       
        
        $this->resetInput();
		$this->emit('closeModal');   
        $this->emit('alert','la sede se creo satisfactoriamente'); 
		session()->flash('message', 'Sede Successfully created.');
        
       
    }

    public function edit($id)
    {
        $record = Sede::findOrFail($id);

        $this->selected_id = $id; 
		$this->nombre = $record-> nombre;
		$this->direccion = $record-> direccion;
		$this->descripcion = $record-> descripcion;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'nombre' => 'required',
		'direccion' => 'required',
		'descripcion' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Sede::find($this->selected_id);
            $record->update([ 
			'nombre' => $this-> nombre,
			'direccion' => $this-> direccion,
			'descripcion' => $this-> descripcion
            ]);

            $this->resetInput();
            $this->updateMode = false;
            $this->emit('alert','la sede se actualizo satisfactoriamente'); 
			session()->flash('message', 'Sede Successfully updated.');
        }
    }

    public function eliminar($id)
    {
        if (DB::table('reportes')
            ->where('sede_id',$id)->count() == 0 ) 
            {
                if ($id) {
                    $record = Sede::where('id', $id);
                    $record->delete();
                }               
                
            } else {
                $this->emit('alertnodelete','el registro no se puede borrar porque esta asosiado a un reportes.','Reportes');
            }     
    }
}
