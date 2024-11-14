@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><span>Bienvenido: {{$empresa->nombre_empresa}}</span></h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box zoomP">
                <a href="{{url('/admin/roles')}}" class="info-box-icon bg-info">
                    <span ><i class="fas fa-user"></i></span>
                </a>
                <div class="info-box-content">
                    <span class="info-box-text">Roles</span>
                    <span class="info-box-number">{{$total_roles}} roles</span>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box zoomP">
                <a href="{{url('/admin/usuarios')}}" class="info-box-icon bg-primary">
                    <span ><i class="fas fa-users"></i></span>
                </a>
                <div class="info-box-content">
                    <span class="info-box-text">Usuarios</span>
                    <span class="info-box-number">{{$total_usuarios}} usuarios</span>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box zoomP">
                <a href="{{url('/admin/categorias')}}" class="info-box-icon bg-success">
                    <span ><i class="fas fa-tags"></i></span>
                </a>
                <div class="info-box-content">
                    <span class="info-box-text">Categorias</span>
                    <span class="info-box-number">{{$total_categorias}} categorias</span>
                </div>
            </div>
        </div>


        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box zoomP">
                <a href="{{url('/admin/productos')}}" class="info-box-icon bg-warning">
                    <span ><i class="fas fa-list"></i></span>
                </a>
                <div class="info-box-content">
                    <span class="info-box-text">Productos</span>
                    <span class="info-box-number">{{$total_productos}} categorias</span>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box zoomP">
                <a href="{{url('/admin/proveedor')}}" class="info-box-icon bg-danger">
                    <span ><i class="fas fa-fw fa-truck-fast"></i></span>
                </a>
                <div class="info-box-content">
                    <span class="info-box-text">Proveedores</span>
                    <span class="info-box-number">{{$total_proveedores}} proveedores</span>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box zoomP">
                <a href="{{url('/admin/compras')}}" class="info-box-icon bg-dark">
                    <span ><i class="fas fa-fw fa-shopping-cart"></i></span>
                </a>
                <div class="info-box-content">
                    <span class="info-box-text">Compras</span>
                    <span class="info-box-number">{{$total_compras}} compras</span>
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
