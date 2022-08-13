@section('title', __('Vehiculos'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							<h4><i class="fas fa-car-side"></i>
							Vehiculos </h4>
						</div>
						<div wire:poll.60s>
							<code><h5>{{ now()->format('H:i:s') }} UTC</h5></code>
						</div>
						@if (session()->has('message'))
						<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
						@endif
						<div>
							<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Search Vehiculos">
						</div>
						<div class="btn btn-sm btn-info" data-toggle="modal" data-target="#createDataModal">
						<i class="fa fa-plus"></i>  Crear Vehiculos
						</div>
					</div>
				</div>
				
				<div class="card-body">
						@include('livewire.vehiculos.create')
						@include('livewire.vehiculos.update')						
				<div class="table-responsive">
					<table class="table table-bordered table-sm">
						<thead class="thead">
							<tr> 
								<td>#</td> 
								<th>Placa</th>
								<th>Tipo Vehiculo</th>
								<th>Observacion</th>
								<td>ACCIONES</td>
							</tr>
						</thead>
						<tbody>
							@foreach($vehiculos as $row)
							<tr>
								<td>{{ $loop->iteration }}</td> 
								<td>{{ $row->placa }}</td>
								<td>{{ $row->descripcion }}</td>
								<td>{{ $row->observacion }}</td>
								<td width="90">
								<div class="btn-group">
									<button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Actions
									</button>
									<div class="dropdown-menu dropdown-menu-right">
										<a href="{{ url('/asignar',$row->placa) }}"  class="dropdown-item" ><i class="fa fa-edit"></i> Auth </a>							 
									<a data-toggle="modal" data-target="#updateModal" class="dropdown-item" wire:click="edit({{$row->id}})"><i class="fa fa-edit"></i> Edit </>							 
									<a class="dropdown-item"  wire:click="$emit('deleteRecord',{{$row->id}},'vehiculos')"><i class="fa fa-trash"></i> Delete </a>   
									</div>
								</div>
								</td>
							@endforeach
						</tbody>
					</table>						
					{{ $vehiculos->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
