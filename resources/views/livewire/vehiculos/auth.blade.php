<!-- Modal -->
<div wire:ignore.self class="modal fade" id="authModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Asignar Usuario</h5>
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
                <label for="user_id"></label>
                <select	wire:model="user_id"		    
                    class="form-control">
                   
                    @foreach($usuarios as $row)
                    <option value="{{ $row->id }}" @if($row->id == $user_id) selected @endif>{{ $row->name }}</option>
                    @endforeach
                </select>

               <div> {{$user_id}}</div>

                @error('user_id') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
          

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" wire:click.prevent="autorizar()" class="btn btn-primary" data-dismiss="modal">Save</button>
            </div>
       
            <div class="card-body">
					
				<div class="table-responsive">
					<table class="table table-bordered table-sm">
						<thead class="thead">
							<tr> 
								<td>#</td> 
								<th>Placa</th>
								<th>Usuario</th>								
							</tr>
						</thead>
						<tbody>
							@foreach($user_vehiculo as $row)
							<tr>
								<td>{{ $loop->iteration }}</td> 
								<td>{{ $row->placa }}</td>
								<td>{{ $row->name }}</td>								
								<td width="90">
								<div class="btn-group">
									<button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Actions
									</button>
									<div class="dropdown-menu dropdown-menu-right">
										<a data-toggle="modal" data-target="#authModal" class="dropdown-item" wire:click="autorizar({{$row->id}})"><i class="fa fa-edit"></i> Auth </a>							 
									<a data-toggle="modal" data-target="#updateModal" class="dropdown-item" wire:click="edit({{$row->id}})"><i class="fa fa-edit"></i> Edit </a>							 
									<a class="dropdown-item"  wire:click="$emit('deleteRecord',{{$row->id}},'vehiculos')"><i class="fa fa-trash"></i> Delete </a>   
									</div>
								</div>
								</td>
							@endforeach
						</tbody>
					</table>						
					{{ $user_vehiculo->links() }}
					</div>
				</div>
       
       
        </div>
    </div>
</div>
