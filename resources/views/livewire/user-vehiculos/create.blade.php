<!-- Modal -->
<div wire:ignore.self class="modal fade" id="createDataModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="createDataModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Asignar usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
           <div class="modal-body">
				<form>         
           
            
            <div class="form-group">
                <label for="placa_id"></label>
                <select	wire:model="placa_id"		    
                    class="form-control" @disabled(true) >
                   
                    @foreach($vehiculos as $row)
                    <option value="{{ $row->id }}" @if($row->placa == $placa) selected @endif>{{ $placa }}</option>
                    @endforeach
                </select>

              

                @error('placa_id') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>   
            
            <div class="form-group">
                <label for="user_id"></label>
                <select	wire:model.defer="user_id"		    
                     class="form-control" >
                   
                    @foreach($usuarios as $row)
                    <option value="{{ $row->id }}" >{{ $row->name }}</option>
                    @endforeach
                </select>

              

                @error('user_id') <span class="error text-danger">{{ $message }}</span> @enderror
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
