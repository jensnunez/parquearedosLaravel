<!-- Modal -->
<div wire:ignore.self class="modal fade" id="updateModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Update Vehiculo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span wire:click.prevent="cancel()" aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
					<input type="hidden" wire:model="selected_id">
            <div class="form-group">
                <label for="placa"></label>
                <input wire:model="placa" type="text" class="form-control" id="placa" @disabled(true) placeholder="Placa">@error('placa') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="tipo_vehiculo_id"></label>
                <select	wire:model.defer="tipo_vehiculo_id"		    
                    class="form-control">
                   
                    @foreach($TipoVehiculo as $row)
                    <option value="{{ $row->id }}" @if($row->id == $tipo_vehiculo_id) selected @endif>{{ $row->descripcion }}</option>
                    @endforeach
                </select>

             

                @error('tipo_vehiculo_id') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="observacion"></label>
                <input wire:model="observacion" type="text" class="form-control" id="observacion" placeholder="Observacion">@error('observacion') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" wire:click.prevent="update()" class="btn btn-primary" data-dismiss="modal">Save</button>
            </div>
       </div>
    </div>
</div>
