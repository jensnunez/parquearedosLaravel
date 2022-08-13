<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\TipoReporte;
use Illuminate\Support\Facades\DB;

class TipoReportes extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $descripcion;
    public $updateMode = false;
    protected $listeners = [ 'eliminar' => 'eliminar'];

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.tipo-reportes.view', [
            'tipoReportes' => TipoReporte::latest()
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

        TipoReporte::create([ 
			'descripcion' => $this-> descripcion
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
        $this->emit('alert','el tipo de reporte se creo satisfactoriamente'); 
		session()->flash('message', 'TipoReporte Successfully created.');
    }

    public function edit($id)
    {
        $record = TipoReporte::findOrFail($id);

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
			$record = TipoReporte::find($this->selected_id);
            $record->update([ 
			'descripcion' => $this-> descripcion
            ]);

            $this->resetInput();
            $this->updateMode = false;
            $this->emit('alert','el tipo de reporte  se actualizo satisfactoriamente'); 
			session()->flash('message', 'TipoReporte Successfully updated.');
        }
    }

    public function eliminar($id)
    {
        if (DB::table('reportes')
            ->where('tipo_reporte_id',$id)->count() == 0 ) 
            {
                if ($id) {
                    $record = TipoReporte::where('id', $id);
                    $record->delete();
                }               
                
            } else {
                $this->emit('alertnodelete','el registro no se puede borrar porque esta asosiado a un reportes.','Reportes');
            }     
    }
}
