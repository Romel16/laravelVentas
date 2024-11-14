@extends('adminlte::page')

@section('content_header')
    <h1><b>Cliente / Registro de Cliente</b></h1>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-10">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title">Ingrese los datos</h3>
                </div>

                <div class="card-body">
                    <form action="{{url('/admin/clientes',$cliente->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nombre_cliente">Nombre del Cliente <b>*</b></label>
                                            <input type="text" class="form-control" value="{{$cliente->nombre_cliente}}" name="nombre_cliente" required>
                                            @error('nombre_cliente')
                                            <small style="color: red;">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nit_codigo">Nit / Codigo <b>*</b></label>
                                            <input type="text" class="form-control" value="{{$cliente->nit_codigo}}" name="nit_codigo" required>
                                            @error('nit_codigo')
                                            <small style="color: red;">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="telefono">Telefono<b>*</b></label>
                                            <input type="text" class="form-control" value="{{$cliente->telefono}}" name="telefono" required>
                                            @error('telefono')
                                            <small style="color: red;">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="email">Email<b>*</b></label>
                                            <input type="email" class="form-control" value="{{$cliente->email}}" name="email" required>
                                            @error('email')
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
                                    <a href="{{url('/admin/clientes')}}" class= "btn btn-secondary"><i class="fa-solid fa-circle-xmark"> Cancelar</i></a>
                                    <button type="submit" class="btn btn-success"><i class="fas fa-save"> Modificar</i>
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
