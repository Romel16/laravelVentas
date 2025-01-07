@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><b>Asignar Permisos a el Rol: {{$rol->name}}</b></h1>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-10">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Permisos Registrados</h3>

                </div>
                <div class="card-body">
                    <form action="{{url('/admin/roles/asignar',$rol->id)}}" method="post">
                        @csrf
                        @method('put')

                        @foreach ($permisos as $modulo => $grupoPermisos)
                            <div class="col-md-4">
                                <h3>{{$modulo}}</h3>
                                @foreach ($grupoPermisos as $permiso)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="permisos[]" value="{{$permiso->id}}" {{$rol->hasPermissionTo($permiso->name) ? 'checked' : ''}}/>
                                        <label class="form-check-label" for="">{{$permiso->name}}</label>
                                    </div>
                                @endforeach
                                <hr>
                            </div>

                        @endforeach
                        <hr>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')

@stop

@section('js')

@stop
