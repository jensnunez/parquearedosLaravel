@extends('adminlte::page')

@section('title', 'Parqueaderos')

@section('content_header')
    <h1>Datos del usuario</h1>
@stop

@section('content')
<div class="container">
   
    <hr>
    <div class="row">
        <aside class="col-sm-4">
        <p>Perfil</p>
        <div class="card">
        <article class="card-body">   
            <form>
                <div class="form-group">
                    <label>Nombre</label>
                    <input name="" class="form-control" placeholder="Nombre" type="text" @disabled(true) value="{{auth()->user()->name}}">
                </div> <!-- form-group// -->  

            <div class="form-group">
                <label>Email</label>
                <input name="" class="form-control" placeholder="Email" type="email" @disabled(true) value="{{auth()->user()->email}}" >
            </div> <!-- form-group// -->  

            <div class="form-group">
                <label>Tipo de usuario</label>
                <input name="" class="form-control" placeholder="Tipo usuario" type="text" @disabled(true) value="@if(auth()->user()->tipo_usuarios_id === 3) ADMINISTRADOR @elseif(auth()->user()->tipo_usuarios_id === 2) ESTUDIANTE @else INVITADO @endif ">
            </div> <!-- form-group// -->  

       
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