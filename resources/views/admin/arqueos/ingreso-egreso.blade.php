@extends('adminlte::page')

@section('content_header')
    <h1><b>Arqueos / Registro de Ingresos - Egresos</b></h1>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Ingrese los datos</h3>
                </div>

                <div class="card-body">
                    <form action="{{url('/admin/arqueos/create_ingresos_egresos')}}" method="post">
                        @csrf
                        <input type="text" value="{{$arqueo->id}}" name="id" hidden/>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="fecha_apertura">Fecha de Apertura <b>*</b></label>
                                    <input type="datetime-local" name="fecha_apertura" id="" class="form-control" value="{{$arqueo->fecha_apertura,old('fecha_apertura')}}" disabled></input>
                                    @error('fecha_apertura')
                                        <small style="color: red;">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="tipo">Tipo</label>
                                    <select name="tipo" id="" class="form-control">
                                        <option value="INGRESO">Ingreso</option>
                                        <option value="EGRESO">Egreso</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="monto">Monto</label>
                                    <input type="text" class="form-control" value="{{old('monto')}}" name="monto">
                                    @error('monto')
                                    <small style="color: red;">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="descripcion">Descripcion</label>
                                    <input type="text" class="form-control" value="{{old('descripcion')}}" name="descripcion">
                                    @error('descripcion')
                                    <small style="color: red;">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-14">
                                <div class="form-group">
                                    <a href="{{url('/admin/arqueos')}}" class= "btn btn-secondary"><i class="fa-solid fa-circle-xmark"> Cancelar</i></a>
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
