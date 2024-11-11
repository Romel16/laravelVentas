@extends('adminlte::page')

@section('content_header')
    <h1><b>Productos / Datos del Producto</b></h1>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title">Datos Registrados</h3>
                </div>

                <div class="card-body">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="categoria_id">Categoria</label>
                                            <p>{{$producto->categoria->nombre}}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="codigo">Codigo</label>
                                            <p>{{$producto->codigo}}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nombre">Nombre del Producto <b>*</b></label>
                                            <p>{{$producto->nombre}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="descripcion">Descripcion</label>
                                            <p>{{$producto->descripcion}}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="stock">Stock</label>
                                            <p style="text-align: center ;width:30px;background-color: rgba(233,231,16,0.15)"> {{$producto->stock}}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="stock_minimo">Stock Minimo<b>*</b></label>
                                            <p>{{$producto->stock_minimo}}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="stock_maximo">Stock Max<b>*</b></label>
                                            <p>{{$producto->stock_maximo}}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="precio_compra">Precio Comp<b>*</b></label>
                                            <p>{{$producto->precio_compra}}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="precio_venta">Precio Venta<b>*</b></label>
                                            <p>{{$producto->precio_venta}}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="fecha_ingreso">Fecha Ingreso<b>*</b></label>
                                            <p>{{$producto->fecha_ingreso}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="logo">Imagen</label><br>
                                    <img src="{{asset('storage/'.$producto->imagen)}}" width="100%" alt="logo">

                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <a href="{{url('/admin/productos')}}" class= "btn btn-secondary"><i class="fa-solid fa-circle-xmark"> Cancelar</i></a>
                                    
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
