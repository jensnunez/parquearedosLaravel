@extends('adminlte::page')

@section('title', 'Parqueaderos')

@section('content_header')
    <h1>Cambiar contraseña</h1>
@stop

@section('content')
<div class="container">
   
    <hr>
    <div class="row">
        <aside class="col-sm-4">
        <p>Contraseña</p>
        <div class="card">
        <article class="card-body">   
            <form method="POST" action="{{ route('changepassword') }}">
                @csrf
                <div class="input-group mb-3">
                    <input name="password" required type="password" class="form-control" placeholder="Password">
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                      </div>                           
                    </div>
                  </div>
               

                  <div class="input-group mb-3">
                    <input name="password_confirmation" required type="password" class="form-control" placeholder="Retype password">
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                      </div>
                    </div>
                  </div>
                  <div class="row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Cambiar') }}
                        </button>                       
                    </div>
                </div>     
                @error('password')
                <br>
                <small>{{$message}}
                <br>
              @enderror
                
        </form>
            </article>
        </div> <!-- card.// -->
        </aside> <!-- col.// -->
    
    </div> <!-- row.// -->
    </div>
    <!--container end.//-->
    
@stop




@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop