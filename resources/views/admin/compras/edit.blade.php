@extends('adminlte::page')

@section('content_header')
    <h1><b>Compras / Modificar datos de la Compra</b></h1>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Ingrese los datos</h3>
                </div>

                <div class="card-body">
                    <form action="{{url('/admin/compras/'.$compra->id)}}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="cantidad">Cantidad<b>*</b></label>
                                            <input type="number" class="form-control" style="text-align: center; backgorund-color: #ebe7ae" value="1" id="cantidad" name="cantidad" required>
                                            @error('cantidad')
                                            <small style="color: red;">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="">Codigo</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                                            </div>
                                            <input type="text" id="codigo" class="form-control" placeholder="Código del producto">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div style="height: 32px"></div>
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-search"></i></button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Listado de Productos</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    </div>
                                                    <!-- CONTENIDO DEL MODAL -->
                                                    <div class="modal-body">
                                                        <table id="miTabla" class="table table-striped table-hover table-sm table-responsive">
                                                            <thead class="thead-light">
                                                                <tr>
                                                                  <th scope="col" style="text-align: center">Nro</th>
                                                                  <th scope="col" style="text-align: center">Accion</th>
                                                                  <th scope="col">Categoria</th>
                                                                  <th scope="col">Codigo</th>
                                                                  <th scope="col">Nombre</th>
                                                                  <th scope="col">Stock</th>
                                                                  <th scope="col">Precio Compra</th>
                                                                  <th scope="col">Precio Venta</th>
                                                                  <th scope="col">Imagen</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php $contador = 1;?>
                                                            @foreach ($productos as $producto)
                                                                <tr>
                                                                    <th style="text-align: center">{{$contador++}}</th>
                                                                    <td style="text-align: center">
                                                                        <button type="button" class="btn btn-info seleccionar-btn" data-id="{{$producto->codigo}}">Seleccionar</button>
                                                                    </td>
                                                                    <td>{{$producto->categoria->nombre}}</td>
                                                                    <td>{{$producto->codigo}}</td>
                                                                    <td>{{$producto->nombre}}</td>
                                                                    <td style="text-align: center;background-color: rgba(233,231,16,0.15)">{{$producto->stock}}</td>
                                                                    <td style="text-align: center">{{$producto->precio_compra}}</td>
                                                                    <td style="text-align: center">{{$producto->precio_venta}}</td>
                                                                    <td style="text-align: center">
                                                                        <img src="{{asset('storage/'.$producto->imagen)}}" width="100px" alt="logo">
                                                                    </td>
                                                                    <td style="text-align: center">
                                                                        <div class="btn-group" usuario="group" aria-label="Basic example"></div>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                            <a href="{{url('/admin/productos/create')}}" type="button" class="btn btn-success"><i class="fas fa-plus"></i></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <table class="table table-sm table-striped table-bordered table-hover">
                                        <thead style="background-color: #cccccc">
                                            <tr>
                                                <th>Nro</th>
                                                <th>Codigo</th>
                                                <th>Cantidad</th>
                                                <th>Nombre</th>
                                                <th>Costo</th>
                                                <th>Total</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $count = 1; $total_cantidad = 0; $total_compra=0?>
                                            @foreach($compra->detalles as $detalle)
                                                <tr>
                                                    <td style="text-align: center">{{$count++}}</td>
                                                    <td style="text-align: center">{{$detalle->producto->codigo}}</td>
                                                    <td style="text-align: center">{{$detalle->cantidad}}</td>
                                                    <td style="text-align: center">{{$detalle->producto->nombre}}</td>
                                                    <td style="text-align: center">{{$detalle->precio_compra}}</td>
                                                    <td style="text-align: center">{{$costo = $detalle->cantidad*$detalle->producto->precio_compra}}</td>
                                                    <td style="text-align: center">
                                                        <button type="button" class="btn btn-danger btn-sm delete-btn" data-id="{{$detalle->id}}"><i class="fas fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                                @php
                                                    $total_cantidad += $detalle->cantidad;
                                                    $total_compra += $costo;
                                                @endphp
                                            @endforeach
                                        </tbody>
                                        <tfooter>
                                            <tr>
                                                <td colspan="2" style="text-align: right"><b>Cantidad Total</b></td>
                                                <td style="text-align: center"><b>{{$total_cantidad}}</b></td>
                                                <td colspan="2" style="text-align: right"><b>Total Compra</b></td>
                                                <td style="text-align: center"><b>{{$total_compra}}</b></td>
                                            </tr>
                                        </tfooter>
                                    </table>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
                                            Buscar Proveedor
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Lista de Proveedor</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <!--CONTENIDO DEL MODAL -->
                                                <div class="modal-body">
                                                    <table id="miTabla2" class="table table-striped table-hover table-sm table-responsive">
                                                        <thead class="thead-light">
                                                            <tr>
                                                              <th scope="col" style="text-align: center">Nro</th>
                                                              <th scope="col" style="text-align: center">Accion</th>
                                                              <th scope="col">Empresa</th>
                                                              <th scope="col">Telefono</th>
                                                              <th scope="col">Nombre</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $contador = 1;?>
                                                        @foreach ($proveedores as $proveedor)
                                                            <tr>
                                                                <th style="text-align: center">{{$contador++}}</th>
                                                                <td style="text-align: center">
                                                                    <button type="button" class="btn btn-info seleccionar-btn-proveedor" data-id="{{$proveedor->id}}"  data-empresa="{{$proveedor->empresa}}">Seleccionar</button>
                                                                </td>
                                                                <td style="text-align: center">{{$proveedor->empresa}}</td>
                                                                <td style="text-align: center">{{$proveedor->telefono}}</td>
                                                                <td style="text-align: center">{{$proveedor->nombre}}</td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <input type="text" class="form-control" value="{{$detalle->proveedor->empresa}}" id="empresa_proveedor"  disabled>
                                        <input type="text" class="form-control" id="id_proveedor"  name="id_proveedor" hidden>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fecha">Fecha de Compra<b>*</b></label>
                                            <input type="date" class="form-control" value="{{$compra->fecha}}" name="fecha">
                                            @error('fecha')
                                            <small style="color: red;">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="comprobante">Comprobante<b>*</b></label>
                                            <input type="text"class="form-control" value="{{$compra->comprobante}}" name="comprobante">
                                            @error('comprobante')
                                            <small style="color: red;">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="precio_total">Precio Total<b>*</b></label>
                                            <input type="text" style="text-align: center;background-color: #cccc" class="form-control" value="{{$total_compra}}" name="precio_total">
                                            @error('precio_total')
                                            <small style="color: red;">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success btn-lg btn-save"><i class="fas fa-save"> Actualizar Compra</i>
                                            </button>
                                        </div>
                                    </div>
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
    <script>

        $('.seleccionar-btn').on('click',function(){
            var id_producto = $(this).data('id');
            $('#codigo').val(id_producto);
            $('#exampleModal').modal('hide');
            $('#exampleModal').on('hidden.bs.modal', function(){
                $('#codigo').focus();
            })
        })

        /* $('.delete-btn').click(function(){
            var id = $(this).data('id');
            if (id) {
                $.ajax({
                    url: "{{url('/admin/compras/create/tmp')}}/"+id,
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
                        location.reload();
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
                        alert('Ha ocurrido un error: ' + error);
                    }
                });
            }
        }) */

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
                            url: "{{url('/admin/compras/create/tmp')}}/" + id,
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




        $('.seleccionar-btn-proveedor').click(function(){
            var id_proveedor = $(this).data('id');
            var empresa = $(this).data('empresa');

            $('#empresa_proveedor').val(empresa);
            $('#id_proveedor').val(id_proveedor);
            $('#staticBackdrop').modal('hide');
            $('#staticBackdrop').on('hidden.bs.modal', function(){
                $('#empresa_proveedor').focus();
            })
        })

        $('#codigo').focus();
        $('#form_compra').on('keypress',function (e){
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
                        url: "{{route('admin.compras.tmp_compras')}}",
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
                "sLengthMenu": "Mostrar _MENU_ Proveedor",
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
