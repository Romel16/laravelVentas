@extends('adminlte::page')

@section('content_header')
    <h1><b>Cliente / Registro de nuevo Cliente</b></h1>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-10">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Ingrese los datos</h3>
                </div>

                <div class="card-body">
                    <form action="{{url('/admin/clientes/create')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nombre_cliente">Nombre del Cliente</label>
                                    <input type="text" class="form-control" value="{{old('nombre_cliente')}}" name="nombre_cliente" required>
                                    @error ('nombre_cliente' )
                                    <small style="color: red;">{{$message}} </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nit_codigo">Nit / Codigo</label>
                                    <input type="text" class="form-control" value="{{old('nit_codigo')}}" name="nit_codigo" required>
                                    @error ('nit_codigo' )
                                    <small style="color: red;">{ {$message} } </small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="telefono">Telefono</label>
                                    <input type="number" class="form-control" value="{{old('telefono')}}" name="telefono" required>
                                    @error ('telefono' )
                                    <small style="color: red;">{{$message}} </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" value="{{old('email')}}" name="email" required>
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
