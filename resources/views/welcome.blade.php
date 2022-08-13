@extends('layouts.app')
@section('title', __('Parqueaderos'))
@section('content')
<div class="container-fluid">
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header"><h5><span class="text-center fa fa-university"></span> @yield('title')</h5></div>
            <div class="card-body">
              <h5>  
            @guest
				
				{{ __('Sistema de') }} {{ config('app.name', 'Laravel') }} {{__('Corporacion universitaria americana') }}  </br>
				
               
                            <img src="{{asset('img/logoamericana.jpeg')}}" width="200" height="200" alt="logo americana">
                      

                <div class="container">
                    <div class="row">
                        <div class="col-md-12">                          
                            <p>Instrucciones:</p>
                            <ol>
                                <li>Registrate en la opcion de registro.</li>
                                <li>Inicie sesion en la opcion de login.</li>
                                <li>Para finalizar la sesion, click en la opcion salir .</li>
                            </ol>
                            <br>
                            <ul type="none">
                            <li><i class="fa fa-check" aria-hidden="true"></i> Puede acceder desde cualquier navegador google chrome </li>
                            <li><i class="fa fa-check" aria-hidden="true"></i> Ideal para reportar vehiculos.</li>
                            <li><i class="fa fa-check" aria-hidden="true"></i> funciona desde cualquier sede </li>
                            </ul>
                
                         </div>
                    </div>
                </div>

                
			@else
           
					Hi {{ Auth::user()->name }}, Welcome back to {{ config('app.name', 'Laravel') }}.
                    
            @endif	
				</h5>
               
            </div>
        </div>
    </div>
</div>
</div>
@endsection