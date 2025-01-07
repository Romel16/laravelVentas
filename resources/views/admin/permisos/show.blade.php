@extends('adminlte::page')

@section('content_header')
    <h1><b>Permisos / Datos del Permiso</b></h1>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Datos registrados</h3>
                </div>

                <div class="card-body">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">Nombre del Permiso</label>
                                    <input type="text" class="form-control" value="{{$permiso->name}}" name="name" disabled>
                                    @error ('name' )
                                    <small style="color: red;">{ {$message} } </small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="name">Fecha y Hora de Registro</label>
                                    <input type="text" class="form-control" value="{{$permiso->created_at}}" name="name" disabled>
                                    @error ('name' )
                                    <small style="color: red;">{ {$message} } </small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <a href="{{url('/admin/permisos')}}" class="btn btn-primary"><i class="fas fa-save"> Regresar</i>

                                    </a>
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
