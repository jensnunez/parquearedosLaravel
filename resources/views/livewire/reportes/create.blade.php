<!-- Modal -->
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
                       
                            <div class="col-auto">
                                <label for="fecha">Fecha</label>
                                <input type="date" class="form-control" id="fecha" placeholder="fecha">@error('fecha') <span class="error text-danger">{{ $message }}</span> @enderror
                        
                                <label for="tipo_reporte_id">Tipo reporte</label>
                                <select			    
                                    class="form-control">
                                
                                
                                    @foreach($TipoReportes as $row)
                                        <option value=" {{$row->id}}">{{$row->descripcion}}</option>
                                    @endforeach
                                
                                </select>
                                @error('tipo_reporte_id') <span class="error text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="col-auto">
                                <label for="placa_id">Placa</label>
                                <select	    
                                    class="form-control">
                                
                                    @foreach($Vehiculos as $row)
                                    <option value="{{ $row->id }}" @if($row->id == $placa_id) selected @endif>{{ $row->placa }}</option>
                                    @endforeach
                                </select>           

                                @error('placa_id') <span class="error text-danger">{{ $message }}</span> @enderror
                        
                                <label for="tipo_reporte_id">Periodos</label>
                                <select			    
                                    class="form-control">                   
                                    @foreach($periodos as $row)
                                    <option value="{{ $row->id }}" @if($row->id == $tipo_reporte_id) selected @endif>{{ $row->descripcion }}</option>
                                    @endforeach
                                </select>             

                                @error('tipo_reporte_id') <span class="error text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="col-auto">
                                <label for="sede_id">Sede</label>
                                <select			    
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
                                    <input   class="form-control" type="file" id="formFile">
                                </div>
                            </div>




           

          

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
                <button type="submit"  class="btn btn-primary close-modal">Save</button>
            </div>
        </div>
    </div>
</div>
