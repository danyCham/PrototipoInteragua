@extends('adminlte::page')

@section('title', 'Home')

@section('content_header')
    <h1>Bienvenido</h1>
@stop

@section('content')
    <div class="content ">
        <div class="title text-center">
            <img class="img-responsive center-block" style="margen:auto auto" src="vendor/adminlte/dist/img/logointeragua.png" alt="logo">
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop