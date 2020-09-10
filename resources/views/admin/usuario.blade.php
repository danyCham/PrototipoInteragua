@extends('adminlte::page')

@section('title', 'Home')

@section('content_header')
    <h1>Bienvenido</h1>
@stop

@section('content')
    <div class="container">
        <div class="container-fluid">   	  	
            <div class="row">   	  		
            <div class="card">
                <template>
                    <usuario></usuario>
                </template>   	 	 	    
            </div>   
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script src="{{asset('js/app.js')}}"></script>
@stop