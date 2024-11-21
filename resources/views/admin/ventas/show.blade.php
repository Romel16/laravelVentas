@extends('adminlte::page')

@section('content_header')
    <h1><b>Ventas / Detalle de Ventas</b></h1>
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
                            <div class="col-md-8">
                                <div class="row">
                                    <table class="table table-sm table-striped table-bordered table-hover">
                                        <thead style="background-color: #cccccc">
                                            <tr style="text-align: center">
                                                <th>Nro</th>
                                                <th>Codigo</th>
                                                <th>Cantidad</th>
                                                <th>Nombre</th>
                                                <th>Costo</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $count = 1; $total_cantidad = 0; $total_venta=0?>
                                            @foreach($venta->detallesVenta as $detalle)
                                                <tr>
                                                    <td style="text-align: center">{{$count++}}</td>
                                                    <td style="text-align: center">{{$detalle->producto->codigo}}</td>
                                                    <td style="text-align: center">{{$detalle->cantidad}}</td>
                                                    <td style="text-align: center">{{$detalle->producto->nombre}}</td>
                                                    <td style="text-align: center">{{$detalle->producto->precio_venta}}</td>
                                                    <td style="text-align: center">{{$costo = $detalle->cantidad*$detalle->producto->precio_venta}}</td>

                                                </tr>
                                                @php
                                                    $total_cantidad += $detalle->cantidad;
                                                    $total_venta += $costo;
                                                @endphp
                                            @endforeach
                                        </tbody>
                                        <tfooter>
                                            <tr>
                                                <td colspan="2" style="text-align: right"><b>Cantidad Total</b></td>
                                                <td style="text-align: center"><b>{{$total_cantidad}}</b></td>
                                                <td colspan="2" style="text-align: right"><b>Total Venta</b></td>
                                                <td style="text-align: center"><b>{{$total_venta}}</b></td>
                                            </tr>
                                        </tfooter>
                                    </table>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="">Nombre del Cliente</label>
                                        @if($venta->cliente)
                                        <input type="text" class="form-control" value="{{ $venta->cliente->nombre_cliente }}" disabled></input>
                                        @else
                                            <input type="text" class="form-control" value="s/n" disabled></input>
                                        @endif
                                        <input type="text" class="form-control" id="id_clientes" name="id_clientes" hidden>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Nit Codigo</label>
                                        @if($venta->cliente)
                                        <input type="text" class="form-control" value="{{$venta->cliente->nit_codigo}}" disabled></input>
                                        @else
                                        <input type="text" class="form-control" value="0" disabled></input>
                                        @endif
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fecha">Fecha de Venta<b>*</b></label>
                                            <input type="date" class="form-control" value="{{$venta->fecha}}" name="fecha" disabled>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="precio_total">Precio Total<b>*</b></label>
                                            <input type="text" style="text-align: center;background-color: #cccc" class="form-control" value="{{$venta->precio_total}}" name="precio_total" disabled>

                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <a href="{{url('/admin/ventas')}}" class= "btn btn-secondary"><i class="fa-solid fa-circle-xmark"> Cancelar</i></a>
                                        </div>
                                    </div>
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
    <script>

        $('.seleccionar-btn').on('click',function(){
            var id_producto = $(this).data('id');
            $('#codigo').val(id_producto);
            $('#exampleModal').modal('hide');
            $('#exampleModal').on('hidden.bs.modal', function(){
                $('#codigo').focus();
            })
        })

        $('.delete-btn').click(function(){
            var id = $(this).data('id');

            // Mostrar la alerta de confirmación antes de eliminar
            Swal.fire({
                title: '¿Desea eliminar este registro?',
                text: '',
                icon: 'question',
                showDenyButton: true,
                confirmButtonText: 'Eliminar',
                confirmButtonColor: '#a5161d',
                denyButtonText: 'Cancelar',
                denyButtonColor: '#270a0a',
            }).then((result) => {
                if (result.isConfirmed) {
                    if (id) {
                        // Si se confirma la eliminación, se ejecuta la solicitud AJAX
                        $.ajax({
                            url: "{{url('/admin/ventas/create/tmp')}}/" + id,
                            type: 'POST',
                            data: {
                                _token: '{{csrf_token()}}',
                                _method: 'DELETE'
                            },
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire({
                                        position: "top-end",
                                        icon: "success",
                                        title: "Se eliminó el producto",
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    location.reload(); // Recargar la página después de la eliminación
                                } else {
                                    Swal.fire({
                                        position: "top-end",
                                        icon: "error",
                                        title: "No se pudo eliminar el producto",
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                }
                            },
                            error: function(xhr, status, error) {
                                console.log(xhr.responseText);  // Muestra el detalle del error en la consola
                                Swal.fire('Error', 'Ocurrió un error al eliminar el producto', 'error');
                            }
                        });
                    }
                }
            });
        });




        $('#codigo').focus();
        $('#form_venta').on('keypress',function (e){
            if (e.keyCode === 13) {
                e.preventDefault();
            }
        });


        $('#codigo').on('keyup', function(event) {
            // Detectar si la tecla presionada es Enter (código 13)
            if (event.which === 13) {
                var codigo = $(this).val();
                var cantidad = $('#cantidad').val(); // Capturando la cantidad desde el input

                // Verifica que el campo de código no esté vacío
                if (codigo.length > 0) {
                    $.ajax({
                        url: "{{route('admin.ventas.tmp_ventas')}}",
                        method: 'POST',
                        data: {
                            _token: '{{csrf_token()}}',
                            codigo: codigo,
                            cantidad: cantidad // Asegúrate de enviar la cantidad aquí
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    position: "top-end",
                                    icon: "success",
                                    title: "Se registro el producto",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                location.reload();
                            } else {
                                Swal.fire({
                                    position: "top-end",
                                    icon: "error",
                                    title: "No se registro el producto",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);  // Muestra el detalle del error en la consola
                            alert('Ha ocurrido un error: ' + error);
                        }
                    });
                }
            }
        });

    </script>

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
        $('#miTabla2').DataTable({
            language: {
                "sProcessing": "Procesando...",
                "sLengthMenu": "Mostrar _MENU_ Cliente",
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
