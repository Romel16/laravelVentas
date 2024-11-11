@extends('adminlte::page')

@section('content_header')
    <h1><b>Roles / Detalle del Rol</b></h1>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Datos Registrador</h3>
                </div>

                <div class="card-body">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                   <p>{{$role->name}}</p>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <a href="{{url('/admin/roles')}}" class="btn btn-secondary">Volver</a>
                                </div>
                            </div>
                        </div>

                </div>

            </div>
        </div>
    </div>
@stop

@section('css')

@stop

@section('js')

@stop
