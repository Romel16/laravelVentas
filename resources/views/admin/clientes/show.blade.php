@extends('adminlte::page')

@section('content_header')
    <h1><b>Cliente / Detalle de Cliente</b></h1>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-10">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title">Datos Registrado</h3>
                </div>

                <div class="card-body">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="col-md-12">
                                    <label for="">Nombre_Cliente</label>
                                    <input type="text" class="form-control" value="{{$cliente->nombre_cliente}}" disabled></input>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nit_codigo">Nit / Codigo</label>
                                    <input type="text" class="form-control" value="{{$cliente->nit_codigo}}" name="nit_codigo" disabled>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="telefono">Telefono</label>
                                    <input type="number" class="form-control" value="{{$cliente->telefono}}" name="telefono" disabled>
                                    @error ('telefono' )
                                    <small style="color: red;">{{$message}} </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" value="{{$cliente->email}}" name="email" disabled>
                                    @error ('email' )
                                    <small style="color: red;">{ {$message} } </small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <a href="{{url('/admin/clientes')}}" class= "btn btn-secondary"><i class="fa-solid fa-circle-xmark"> Atras</i></a>
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
