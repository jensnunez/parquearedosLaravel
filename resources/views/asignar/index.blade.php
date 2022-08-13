@extends('adminlte::page')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <livewire:user-vehiculos :placa="$placa">
        </div>     
    </div>   
</div>
@endsection