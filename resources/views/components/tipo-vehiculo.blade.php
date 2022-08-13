<div class="mr-1 mb-3">
	<div>
	  
	    <div class="mt-1 relative rounded-md shadow-sm">
		  	<select			    
			  class="form-control">
		  		<option value="">Seleccione</option>
		  		@foreach($TipoVehiculo as $row)
					<option value=" {{$row->id}}">{{$row->descripcion}}</option>
				@endforeach
		  	</select>

		</div>
	</div>
</div>