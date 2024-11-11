@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Listado de Roles</h1>
    <hr>
@stop

@section('content')

@stop

@section('css')

@stop

@section('js')
    @if ((($mensaje = Session::get('mensaje')) && ($icono = Session::get('icono'))))
        <script>
            Swal.fire({
                position: "top-end",
                icon: "{{$icono}}",
                title: "{{$mensaje}}",
                showConfirmButton: false,
                timer: 300
            });
        </script>
    @endif
@stop
