<div>
    <div class="form-group">
        <label for="tipo_vehiculo_id"></label>
        <select wire:model="counter"		    
            class="form-control">
           
            <option value="">  Seleccione</option>
           
              <option value="a">a</option>
              <option value="b">b</option>
              <option value="c">c</option>
          
        </select>
      
        @error('counter') <span class="error text-danger">{{ $message }}</span> @enderror
    </div>
   

</div>
