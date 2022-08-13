@section('title', __('Asignar Vehiculos'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							<h4><i class="fas fa-car-side"></i>
							Asignar Vehiculos a Usuarios  </h4>
						</div>
						<div wire:poll.15s>
							<code><h5>{{ now()->format('H:i:s') }} UTC</h5></code>
						</div>
						@if (session()->has('message'))
						<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
						@endif

						<div class="form-group">
							<label for="placa"> </label>
							<input wire:model="placa" type="text" @disabled(true) class="form-control" id="placa" placeholder="Placa" value="{{$placa}}">
						</div>

						
						
					</div>
							<div class="btn btn-sm btn-info" data-toggle="modal" data-target="#createDataModal">
								<i class="fa fa-plus"></i>  asignar  Usuario
							</div>

				</div>
				
				<div class="card-body">
					@include('livewire.user-vehiculos.create')				
				
					
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
</div>

