<div>
@section('title', __('Sedes'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							<h4><i class="fa fa-university"></i>
							Sedes Americana </h4>
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
						<div class="btn btn-sm btn-info" data-toggle="modal" data-target="#createDataModal">
						<i class="fa fa-plus"></i>  Crear Sedes
						</div>
					</div>
				</div>
				
				<div class="card-body">
						@include('livewire.sedes.create')
						@include('livewire.sedes.update')
				<div class="table-responsive">
					<table class="table table-bordered table-sm">
						<thead class="thead cursor-pointer">
							<tr class="cursor-pointer"> 
								<td class="cursor-pointer">#</td> 
								<th class="cursor-pointer"  wire:click="order('nombre')" > <strong class="cursor-pointer"> Nombre </strong></th>
								<th  class="cursor-pointer" wire:click="order('direccion')" > <strong class="cursor-pointer">Direccion </strong> </th>
								<th  class="cursor-pointer" wire:click="order('descripcion')" > <strong class="cursor-pointer"> Descripcion </strong> </th>
								<td>ACTIONS</td>
							</tr>
						</thead>
						<tbody>
							@foreach($sedes as $row)
							<tr>
								<td>{{ $loop->iteration }}</td> 
								<td>{{ $row->nombre }}</td>
								<td>{{ $row->direccion }}</td>
								<td>{{ $row->descripcion }}</td>
								<td width="90">
								<div class="btn-group">
									<button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Actiones
									</button>
									<div class="dropdown-menu dropdown-menu-right">
									<a data-toggle="modal" data-target="#updateModal" class="dropdown-item" wire:click="edit({{$row->id}})"><i class="fa fa-edit"></i> Edit </a>							 
									<a class="dropdown-item"  wire:click="$emit('deleteRecord',{{$row->id}},'sedes')"><i class="fa fa-trash"></i> Delete </a>   
									</div>
								</div>
								</td>
							@endforeach
						</tbody>
					</table>						
					{{ $sedes->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
		@push('js')
			
		@endpush

</div>
