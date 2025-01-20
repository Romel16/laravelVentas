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
                    <span ><i class="fas fa-user-check"></i></span>
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

        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box zoomP">
                <a href="{{url('/admin/clientes')}}" class="info-box-icon bg-info">
                    <span ><i class="fas fa-fw fa-users"></i></span>
                </a>
                <div class="info-box-content">
                    <span class="info-box-text">Clientes</span>
                    <span class="info-box-number">{{$total_clientes}} clientes</span>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box zoomP">
                <a href="{{url('/admin/arqueos')}}" class="info-box-icon bg-primary">
                    <span ><i class="fas fa-fw fa-cash-register"></i></span>
                </a>
                <div class="info-box-content">
                    <span class="info-box-text">Arqueos</span>
                    <span class="info-box-number">{{$total_arqueos}} arqueos</span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Total cantidad de ventas</h3>
                </div>
                <div class="card-body">
                    <div>
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Total costo de ventas</h3>
                </div>
                <div class="card-body">
                    <div>
                        <canvas id="myChart2"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title">Total cantidad de compras</h3>
                </div>
                <div class="card-body">
                    <div>
                        <canvas id="myChart3"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title">Total costo de compras</h3>
                </div>
                <div class="card-body">
                    <div>
                        <canvas id="myChart4"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

@section('css')

@stop

@section('js')
    <?php
        $meses = array_fill(1,12,0);
        $suma_ventas = array_fill(1,12,0);

        foreach ($ventas as $venta) {
            $fecha = strtotime($venta['fecha']);
            $mes = date('m',$fecha);

            $meses[(int)$mes]++;
            $suma_ventas[(float)$mes] += $venta['precio_total'];
        }


        $reporte_cantidad = implode(',', $meses);
        $reporte_ventas = implode(',', $suma_ventas);


    ?>

    <?php
    // Inicializar arrays para los meses
    $meses_compras = array_fill(1, 12, 0); // Cantidad de compras por mes
    $suma_compras = array_fill(1, 12, 0); // Total de compras por mes

    // Procesar las compras
    foreach ($compras as $compra) {
        $fecha = strtotime($compra['fecha']); // Convertir la fecha a formato timestamp
        $mes = date('m', $fecha); // Obtener el mes de la compra (01-12)

        $meses_compras[(int)$mes]++; // Incrementar la cantidad de compras en el mes correspondiente
        $suma_compras[(int)$mes] += $compra['precio_total']; // Sumar el total de la compra al mes correspondiente
    }

    // Convertir los datos a cadenas para su uso en gráficos
    $reporte_cantidad_compras = implode(',', $meses_compras); // Cantidad de compras por mes
    $reporte_total_compras = implode(',', $suma_compras); // Total de compras por mes
    ?>


    <script>
        var meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
        var datos = [{{$reporte_cantidad}}];
        const ctx = document.getElementById('myChart');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: meses,
                datasets: [{
                    label: 'Cantidad de ventas',
                    data: datos,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        var meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
        var datos = [{{$reporte_ventas}}];
        const ctx2 = document.getElementById('myChart2');
        new Chart(ctx2, {
            type: 'doughnut',
            data: {
                labels: meses,
                datasets: [{
                    label: 'Cantidad de ventas',
                    data: datos,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });



        var meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
        var datos = [{{$reporte_cantidad_compras}}];
        const ctx3 = document.getElementById('myChart3');
        new Chart(ctx3, {
            type: 'bar',
            data: {
                labels: meses,
                datasets: [{
                    label: 'Cantidad de compras',
                    data: datos,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        var meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
        var datos = [{{$reporte_total_compras}}];
        const ctx4 = document.getElementById('myChart4');
        new Chart(ctx4, {
            type: 'doughnut',
            data: {
                labels: meses,
                datasets: [{
                    label: 'Cantidad de compras',
                    data: datos,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>


@stop
