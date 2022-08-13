@extends('adminlte::page')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
          
            <livewire:admin.admin>
        </div>     
    </div>   
</div>
@endsection
@section('js')
    <script> 
         livewire.on('autorizar',function(userid,nameComponent, tipousuario) {
					Swal.fire({
					title: 'Deseas cambiar el estado del usuario?',
					text: "Los resultados no se podran revertir!",
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Yes, Confirm!'
				}).then((result) => {
					if (result.isConfirmed) {
						livewire.emitTo(nameComponent,'update2',userid,tipousuario);
					
					} else {
                        Swal.fire(
						'No procesado',
                        'Se cancelo la operacion',
						'success'
					)
                    }
				})
				});
    </script>
@stop
