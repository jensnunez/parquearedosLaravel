<div>
	@section('title', __('admin'))
	<div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<div style="display: flex; justify-content: space-between; align-items: center;">
							<div class="float-left">
								<h4><i class="fas fa-user-check"></i>
								Listado de usuarios </h4>
							</div>
							<div wire:poll.60s>
								<code><h5>{{ now()->format('H:i:s') }} UTC</h5></code>
							</div>
							@if (session()->has('message'))
							<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
							@endif
							<div>
								<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Search Sedes">
							</div>
							
						</div>
					</div>
					
					<div class="card-body">
							
					<div class="table-responsive">
						<table class="table table-bordered table-sm">
							<thead class="thead">
								<tr> 
									<td>#</td> 
									<th>Nombre</th>
									<th>correo</th>	
									<th>Tipo Usuario</th>							
									<td>ACTIONS</td>
								</tr>
							</thead>
							<tbody>
								@foreach($users as $row)
								<tr>
									<td>{{ $loop->iteration }}</td> 
									<td>{{ $row->name }}</td>
									<td>{{ $row->email }}</td>	
									<td>{{ $row->descripcion }}</td>							
									<td width="90">
									<div class="btn-group">
										<button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										Actions
										</button>
										<div class="dropdown-menu dropdown-menu-right">
																	 
										<a class="dropdown-item" wire:click="$emit('autorizar',{{$row->id}},'admin.admin',2)"><i class="fa fa-check-square" aria-hidden="true"></i> @if($row->tipo_usuarios_id === 3) Volver estudiante @else Autorizar @endif  </a>   
										<a class="dropdown-item" wire:click="$emit('autorizar',{{$row->id}},'admin.admin',3)"><i class="fa fa-unlock" aria-hidden="true"></i> Volver Administrador </a>   
										<a class="dropdown-item" wire:click="$emit('autorizar',{{$row->id}},'admin.admin',1)"><i class="fa fa-minus-circle" aria-hidden="true"></i> Dar de baja </a>
									</div>
									</div>
									</td>
								@endforeach
							</tbody>
						</table>						
						{{ $users->links() }}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>