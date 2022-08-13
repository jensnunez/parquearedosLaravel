<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

	<title>@hasSection('title') @yield('title') | @endif {{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

   

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
	 @livewireStyles
</head>
<body>
   
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
					@auth()
                   
                    <ul class="navbar-nav mr-auto">
						<!--Nav Bar Hooks - Do not delete!!-->
						
						
                        <li class="nav-item">
                            <a href="{{ url('/admin') }}" class="nav-link"><i class="fas fa-user-check"></i> Admin</a> 
                        </li>
						<li class="nav-item">
                            <a href="{{ url('/tipo_vehiculos') }}" class="nav-link"><i class="fas fa-car"></i> Tipo Vehiculos</a> 
                        </li>
						<li class="nav-item">
                            <a href="{{ url('/tipo_reportes') }}" class="nav-link"><i class="fas fa-file-alt"></i> Tipo Reportes</a> 
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/periodos') }}" class="nav-link"><i class="fas fa-book-open"></i> Periodos</a> 
                        </li>
						<li class="nav-item">
                            <a href="{{ url('/sedes') }}" class="nav-link"><i class="fa fa-university"></i> Sedes</a> 
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/vehiculos') }}" class="nav-link"><i class="fas fa-car-side"></i> Vehiculos</a> 
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/reportar') }}" class="nav-link"><i class="fa fa-times-circle"></i> Reportar vehiculo</a> 
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/asignar-vehiculos') }}" class="nav-link"><i class="fa fa-times-circle"></i> Reportar vehiculo</a> 
                        </li>

                       
                       

                    </ul>
                    
					@endauth()
					
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Registro') }}</a>
                                </li>
                            @endif
                        @else
                                <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-2">
            @yield('content')
        </main>
    </div>
    @livewireScripts
   
    @stack('js')
    <script>
        livewire.on('alert', function(message) {
            Swal.fire(
            'PARQUEADEROS',
            message,
            'success'
)
        })

        livewire.on('alertnodelete', function(message, titulo) {
            Swal.fire({
                icon: 'warning',
                title: titulo,
                text: message,
                footer: '<a href="">Verificar registro maestro</a>'
                })
        })


        

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

                livewire.on('desbloquear',function(userid,nameComponent) {
					Swal.fire({
					title: 'Deseas desbloquear el reporte?',
					text: "Los resultados no se podran revertir!",
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Yes, Confirm!'
				}).then((result) => {
					if (result.isConfirmed) {
						livewire.emitTo(nameComponent,'update2',userid);
					
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



<script type="text/javascript">


	window.livewire.on('closeModal', () => {
		$('#createDataModal').modal('hide');
	});
  


    

</script>



 


</body>
</html>

