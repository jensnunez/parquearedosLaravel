@extends('adminlte::page')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @livewire('tipo-vehiculos')
        </div>     
    </div>   
</div>
@endsection
@section('js')
    <script> 
          livewire.on('deleteRecord',function(sedeid,nameComponent) {
					Swal.fire({
					title: 'Deseas eliminar el registro?',
					text: "Los resultados no se podran revertir!",
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Yes, delete it!'
				}).then((result) => {
					if (result.isConfirmed) {
						livewire.emitTo(nameComponent,'eliminar',sedeid);
					Swal.fire(
						'Borrado!',
						'El registro ha sido borrado.',
						'success'
					)
					} else {
                        Swal.fire(
						'No procesado',
                        'Se cancelo la operacion',
						'success'
					)
                    }
				})
				});

                livewire.on('alert', function(message) {
            Swal.fire(
            'PARQUEADEROS',
            message,
            'success'
)
        });

        livewire.on('alertnodelete', function(message, titulo) {
            Swal.fire({
                icon: 'warning',
                title: titulo,
                text: message,
                footer: '<a href="">Verificar registro maestro</a>'
                })
        });

    </script>
@stop