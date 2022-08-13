<!-- Modal -->
<div wire:ignore.self class="modal fade" id="createDataModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="createDataModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Create New Vehiculo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
           <div class="modal-body">
				<form>
            <div class="form-group">
                <label for="placa"></label>
                <input wire:model="placa" type="text" class="form-control" id="placa" placeholder="Placa">@error('placa') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="tipo_vehiculo_id"></label>
                <select		wire:model.defer="tipo_vehiculo_id"	    
                    class="form-control">
                   
                   
                     @foreach($TipoVehiculo as $row)
					    <option value=" {{$row->id}}">{{$row->descripcion}}</option>
				      @endforeach
                  
                </select>
                @error('tipo_vehiculo_id') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="observacion"></label>
                <input wire:model="observacion" type="text" class="form-control" id="observacion" placeholder="Observacion">@error('observacion') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-check">
               
                <input wire:model="propietario"  class="form-check-input" type="checkbox" id="propietario" placeholder="propietario">@error('propietario') <span class="error text-danger">{{ $message }}</span> @enderror 
                <label for="propietario" class="form-check-label" >Propietario</label>
            </div>


          

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
                <button type="button" wire:click.prevent="store()" class="btn btn-primary close-modal">Save</button>
            </div>
        </div>
    </div>
</div>
