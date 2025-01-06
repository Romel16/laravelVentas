@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><b>Listado de Productos</b></h1>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Productos Registrados</h3>
                    <div class="card-tools">
                        <a href="{{url('/admin/productos/reporte')}}" target="_blank" class="btn btn-danger"><i class="fa fa-file-pdf"> Crear nuevo</i></a>
                        <a href="{{url('/admin/productos/create')}}" class="btn btn-primary"><i class="fa fa-plus"> Crear nuevo</i></a>

                    </div>
                </div>
                <div class="card-body">
                    <table id="miTabla" class="table table-striped table-hover table-sm">
                        <thead class="thead-light">
                            <tr>
                              <th scope="col" style="text-align: center">Nro</th>
                              <th scope="col">Categoria</th>
                              <th scope="col">Codigo</th>
                              <th scope="col">Nombre</th>
                              <th scope="col">Descripcion</th>
                              <th scope="col">Stock</th>
                              <th scope="col">Precio Compra</th>
                              <th scope="col">Precio Venta</th>
                              <th scope="col">Imagen</th>
                              <th scope="col" style="text-align: center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $contador = 1;?>
                        @foreach ($productos as $producto)
                            <tr>
                                <th style="text-align: center">{{$contador++}}</th>
                                <td>{{$producto->categoria->nombre}}</td>
                                <td>{{$producto->codigo}}</td>
                                <td>{{$producto->nombre}}</td>
                                <td>{{$producto->descripcion}}</td>
                                <td style="text-align: center;background-color: rgba(233,231,16,0.15)">{{$producto->stock}}</td>
                                <td style="text-align: center">{{$producto->precio_compra}}</td>
                                <td style="text-align: center">{{$producto->precio_venta}}</td>
                                <td style="text-align: center">
                                    <img src="{{asset('storage/'.$producto->imagen)}}" width="100px" alt="logo">
                                </td>
                                <td style="text-align: center">
                                    <div class="btn-group" usuario="group" aria-label="Basic example">
                                        <a href="{{url('/admin/productos', $producto->id)}}" type="button" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                        <a href="{{url('/admin/productos/'.$producto->id.'/edit')}}" type="button" class="btn btn-success btn-sm"><i class="fas fa-pencil"></i></a>
                                        <form action="{{url('/admin/productos',$producto->id)}}" method="POST" onclick="preguntar{{$producto->id}}(event)" id='miFormulario{{$producto->id}}'>
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                        </form>
                                        <script>
                                            function preguntar{{$producto->id}} (event) {
                                                event.preventDefault() ;
                                                Swal.fire({
                                                    title: '¿Desea eliminar esta registro?',
                                                    text: '',
                                                    icon: 'question',
                                                    showDenyButton: true,
                                                    confirmButtonText: 'Eliminar',
                                                    confirmButtonColor: '#a5161d' ,
                                                    denyButtonColor: '#270a0a',
                                                    denyButtonText: 'Cancelar',
                                                }).then ((result) => {
                                                    if(result.isConfirmed) {
                                                        var form = $('#miFormulario{{$producto->id}}');
                                                        form.submit ();
                                                    }
                                                });
                                            }
                                        </script>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')

@stop

@section('js')
    <script>
        $('#miTabla').DataTable({
            language: {
                "sProcessing": "Procesando...",
                "sLengthMenu": "Mostrar _MENU_ Productos",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "Ningún dato disponible en esta tabla",
                "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix": "",
                "sSearch": "Buscar:",
                "sUrl": "",
                "sInfoThousands": ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }
        });
    </script>

@stop
