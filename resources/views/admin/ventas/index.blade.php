@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><b>Listado de Ventas</b></h1>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Ventas Registrados</h3>
                    <div class="card-tools">
                        <a href="{{url('/admin/ventas/reporte')}}" target="_blank" class="btn btn-danger"><i class="fa fa-file-pdf"> Crear nuevo</i></a>

                         @if($arqueoAbierto)
                            <a href="{{url('/admin/ventas/create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Crear nuevo</a>
                        @else
                            <a href="{{url('/admin/arqueos/create')}}" class="btn btn-danger"><i class="fa fa-plus"></i> Abrir caja</a>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <table id="miTabla" class="table table-striped table-hover table-sm">
                        <thead class="thead-light">
                            <tr>
                              <th scope="col" style="text-align: center">Nro</th>
                              <th scope="col" style="text-align: center">Fecha</th>
                              <th scope="col" style="text-align: center">Precio Total</th>
                              <th scope="col" style="text-align: center">Producto</th>
                              <th scope="col" style="text-align: center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $contador = 1;?>
                        @foreach ($ventas as $venta)
                            <tr>
                                <th style="text-align: center">{{$contador++}}</th>
                                <td style="text-align: center">{{$venta->fecha}}</td>
                                <td style="text-align: center">{{$venta->precio_total}}</td>
                                <td style="vertical-align: middle">
                                    @foreach ($venta->detallesVenta as $detalle)
                                        <li>{{$detalle->producto->nombre.' - '.$detalle->cantidad}}</li>
                                    @endforeach
                                </td>
                                <td style="text-align: center" style="text-align: center">
                                    <div class="btn-group" usuario="group" aria-label="Basic example">
                                        <a href="{{url('/admin/ventas', $venta->id)}}" type="button" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                        <a href="{{url('/admin/ventas/'.$venta->id.'/edit')}}" type="button" class="btn btn-success btn-sm"><i class="fas fa-pencil"></i></a>
                                        <a href="{{url('/admin/ventas/pdf/'.$venta->id)}}" target="_blank" type="button" class="btn btn-warning btn-sm"><i class="fas fa-print"></i></a>
                                        <form action="{{url('/admin/ventas',$venta->id)}}" method="POST" onclick="preguntar{{$venta->id}}(event)" id='miFormulario{{$venta->id}}'>
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                        </form>
                                        <script>
                                            function preguntar{{$venta->id}} (event) {
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
                                                        var form = $('#miFormulario{{$venta->id}}');
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
                "sLengthMenu": "Mostrar _MENU_ Ventas",
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
