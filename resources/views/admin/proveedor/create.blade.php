@extends('adminlte::page')

@section('content_header')
    <h1><b>Proveedor / Registro de Proveedor</b></h1>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Ingrese los datos</h3>
                </div>

                <div class="card-body">
                    <form action="{{url('/admin/proveedor/create')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="empresa">Nombre de la Empresa <b>*</b></label>
                                            <input type="text" class="form-control" value="{{old('empresa')}}" name="empresa" required>
                                            @error('empresa')
                                            <small style="color: red;">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="direccion">Direccion<b>*</b></label>
                                            <input type="text" class="form-control" value="{{old('direccion')}}" name="direccion" required>
                                            @error('direccion')
                                            <small style="color: red;">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="telefono">Telefono<b>*</b></label>
                                            <input type="text" class="form-control" value="{{old('telefono')}}" name="telefono" required>
                                            @error('telefono')
                                            <small style="color: red;">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="email">Email<b>*</b></label>
                                            <input type="text" class="form-control" value="{{old('email')}}" name="email" required>
                                            @error('email')
                                            <small style="color: red;">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nombre">Nombre del Proveedor<b>*</b></label>
                                            <input type="text" class="form-control" value="{{old('nombre')}}" name="nombre" required>
                                            @error('nombre')
                                            <small style="color: red;">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="celular">Celular del Proveedor<b>*</b></label>
                                            <input type="text" class="form-control" value="{{old('celular')}}" name="celular" required>
                                            @error('celular')
                                            <small style="color: red;">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <a href="{{url('/admin/proveedor')}}" class= "btn btn-secondary"><i class="fa-solid fa-circle-xmark"> Cancelar</i></a>
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"> Registrar</i>

                                    </button>
                                </div>
                            </div>
                        </div>
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
