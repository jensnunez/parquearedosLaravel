@section('title', __('Reportes'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							<h4><i class="fas fa-car-side"></i>
							Reportar vehiculos </h4>
						</div>
						<div >
							<code><h5>{{ now()->format('H:i:s') }} UTC</h5></code>
						</div>
						@if (session()->has('message'))
						<div  class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
						@endif
						<div>
							<input  type="text" class="form-control" name="search" id="search" placeholder="Search Vehiculos">
						</div>
						<div class="btn btn-sm btn-info" data-toggle="modal" data-target="#createDataModal">
						<i class="fa fa-plus"></i>  Reportar
						</div>
					</div>
				</div>
				
				<div class="card-body">
					<div  class="modal fade" id="createDataModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="createDataModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Reportar Vehiculo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
           <div class="modal-body">
			
                    <form method="POST" action="{{route('reportar.store')}}" enctype="multipart/form-data"  class="row g-2" >
                      @csrf
					  @method('POST')
                            <div class="col-auto">
                                <label for="fecha">Fecha</label>
                                <input type="date" class="form-control" name="fecha" placeholder="fecha">
								@error('fecha') <span class="error text-danger">{{ $message }}</span> @enderror
                        
                                <label for="tipo_reporte_id">Tipo reporte</label>
                                <select		name="tipo_reporte_id"	    
                                    class="form-control">
                                
                                
                                    @foreach($TipoReportes as $row)
                                        <option value=" {{$row->id}}">{{$row->descripcion}}</option>
                                    @endforeach
                                
                                </select>
                                @error('tipo_reporte_id') <span class="error text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="col-auto">
                                <label for="placa_id">Placa</label>
                                <select	    name="placa_id"	  
                                    class="form-control">
                                
                                    @foreach($Vehiculos as $row)
                                    <option value="{{ $row->id }}" @if($row->id == $placa_id) selected @endif>{{ $row->placa }}</option>
                                    @endforeach
                                </select>           

                                @error('placa_id') <span class="error text-danger">{{ $message }}</span> @enderror
                        
                                <label for="periodo_id">Periodos</label>
                                <select			 name="periodo_id"	      
                                    class="form-control">                   
                                    @foreach($periodos as $row)
                                    <option value="{{ $row->id }}" @if($row->id == $periodo_id) selected @endif>{{ $row->descripcion }}</option>
                                    @endforeach
                                </select>             

                                @error('periodo_id') <span class="error text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="col-auto">
                                <label for="sede_id">Sede</label>
                                <select		name="sede_id"	  	    
                                    class="form-control">
                                
                                    @foreach($Sedes as $row)
                                    <option value="{{ $row->id }}" @if($row->id == $sede_id) selected @endif>{{ $row->descripcion }}</option>
                                    @endforeach
                                </select>

                            

                                @error('sede_id') <span class="error text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-auto">
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Imagen</label>
                                    <input  name="image" class="form-control" type="file" id="formFile">
                                </div>
                            </div>




           

          

               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
                <button type="submit"  class="btn btn-primary close-modal">Save</button>
            </div>
		</form>
        </div>
    </div>
</div>

						
				<div class="table-responsive">
					<table class="table table-bordered table-sm">
						<thead class="thead">
							<tr> 
								<td>#</td> 
								<th>fecha</th>
								<th>Tipo Reporte</th>
								<th>Placa</th>
								<th>Usuario</th>
								<th>Imagen</th>
								<th>Sede</th>
								<th>Periodo</th>
								<td>ACCIONES</td>
							</tr>
						</thead>
						<tbody>
							@foreach($reportes as $row)
							<tr>
								<td>{{ $loop->iteration }}</td> 
								<td>{{ $row->fecha }}</td>
								<td>{{ $row->tipo_reporte }}</td>
								<td>{{ $row->placa }}</td>
								<td>{{ $row->usuario }}</td>
								<td> <img src="{{ asset('imagenes/'.$row->image) }}" width="60%">   </td>
								
								
								<td>{{ $row->sede }}</td>
								<td>{{ $row->periodo }}</td>
								<td width="90">
								<div class="btn-group">
									<button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Actions
									</button>
									<div class="dropdown-menu dropdown-menu-right">								
										<a class="dropdown-item" ><i class="fa fa-key" aria-hidden="true"></i> Desbloquear </a>   
									</div>
								</div>
								</td>
							@endforeach
						</tbody>
					</table>						
					{{ $reportes->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
