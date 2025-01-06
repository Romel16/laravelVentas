@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><b>Listado de Arqueos</b></h1>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Arqueos Registrados</h3>
                    <div class="card-tools">
                        <a href="{{url('/admin/arqueos/reporte')}}" target="_blank" class="btn btn-danger"><i class="fa fa-file-pdf"> Crear nuevo</i></a>
                        @if ($arqueoAbierto)

                        @else
                            <a href="{{url('/admin/arqueos/create')}}" class="btn btn-primary"><i class="fa fa-plus"> Crear nuevo</i></a>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <table id="miTabla" class="table table-striped table-hover table-sm">
                        <thead>
                            <tr>
                              <th scope="col" style="text-align: center">Nro</th>
                              <th scope="col">Fecha de Apertura</th>
                              <th scope="col">Monto Inicial</th>
                              <th scope="col">Fecha de Cierre</th>
                              <th scope="col">Monto Final</th>
                              <th scope="col">Descripcion</th>
                              <th scope="col">Movimientos</th>
                              <th scope="col" style="text-align: center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $contador = 1;?>
                        @foreach ($arqueos as $arqueo)
                            <tr>
                                <td style="text-align: center">{{$contador++}}</td>
                                <td>{{$arqueo->fecha_apertura}}</td>
                                <td>{{$arqueo->monto_inicial}}</td>
                                <td>{{$arqueo->fecha_cierre}}</td>
                                <td>{{$arqueo->monto_final}}</td>
                                <td>{{$arqueo->descripcion}}</td>
                                <td>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <b>Ingresos</b> <br>
                                            {{number_format($arqueo->total_ingresos, 2, '.', '')}}
                                        </div>
                                        <div class="col-md-6">
                                            <b>Egresos</b> <br>
                                            {{number_format($arqueo->total_egresos, 2, '.', '')}}
                                        </div>
                                    </div>
                                </td>
                                <td style="text-align: center">
                                    <div class="btn-group" usuario="group" aria-label="Basic example">
                                        <a href="{{url('/admin/arqueos', $arqueo->id)}}" type="button" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                        <a href="{{url('/admin/arqueos/'.$arqueo->id.'/edit')}}" type="button" class="btn btn-success btn-sm"><i class="fas fa-pencil"></i></a>
                                        <a href="{{url('/admin/arqueos/'.$arqueo->id.'/ingreso-egreso')}}" type="button" class="btn btn-warning btn-sm"><i class="fas fa-cash-register"></i></a>
                                        <a href="{{url('/admin/arqueos/'.$arqueo->id.'/cierre')}}" type="button" class="btn btn-secondary btn-sm"><i class="fas fa-lock"></i></a>
                                        <form action="{{url('/admin/arqueos',$arqueo->id)}}" method="POST" onclick="preguntar{{$arqueo->id}}(event)" id='miFormulario{{$arqueo->id}}'>
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                        </form>
                                        <script>
                                            function preguntar{{$arqueo->id}} (event) {
                                                event.preventDefault() ;
                                                Swal.fire({
                                                    title: '¿Desea eliminar esta registro?',
                                                    text: 'Se eliminarán todos los movimientos de este registro',
                                                    icon: 'question',
                                                    showDenyButton: true,
                                                    confirmButtonText: 'Eliminar',
                                                    confirmButtonColor: '#a5161d' ,
                                                    denyButtonColor: '#270a0a',
                                                    denyButtonText: 'Cancelar',
                                                }).then ((result) => {
                                                    if(result.isConfirmed) {
                                                        var form = $('#miFormulario{{$arqueo->id}}');
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
            "sLengthMenu": "Mostrar _MENU_ Arqueos",
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
