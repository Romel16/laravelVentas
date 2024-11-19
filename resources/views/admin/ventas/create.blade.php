@extends('adminlte::page')

@section('content_header')
    <h1><b>Ventas / Registro de Ventas</b></h1>
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
                    <form action="{{url('/admin/ventas/create')}}" id="form_cliente" method="post">
                        @csrf
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
                                            <?php $count = 1; $total_cantidad = 0; $total_venta=0?>
                                            @foreach($tmp_ventas as $tmp_venta)
                                                <tr>
                                                    <td style="text-align: center">{{$count++}}</td>
                                                    <td style="text-align: center">{{$tmp_venta->producto->codigo}}</td>
                                                    <td style="text-align: center">{{$tmp_venta->cantidad}}</td>
                                                    <td style="text-align: center">{{$tmp_venta->producto->nombre}}</td>
                                                    <td style="text-align: center">{{$tmp_venta->producto->precio_venta}}</td>
                                                    <td style="text-align: center">{{$costo = $tmp_venta->cantidad*$tmp_venta->producto->precio_venta}}</td>
                                                    <td style="text-align: center">
                                                        <button type="button" class="btn btn-danger btn-sm delete-btn" data-id="{{$tmp_venta->id}}"><i class="fas fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                                @php
                                                    $total_cantidad += $tmp_venta->cantidad;
                                                    $total_venta += $costo;
                                                @endphp
                                            @endforeach
                                        </tbody>
                                        <tfooter>
                                            <tr>
                                                <td colspan="2" style="text-align: right"><b>Cantidad Total</b></td>
                                                <td style="text-align: center"><b>{{$total_cantidad}}</b></td>
                                                <td colspan="2" style="text-align: right"><b>Total Compra</b></td>
                                                <td style="text-align: center"><b>{{$total_venta}}</b></td>
                                            </tr>
                                        </tfooter>
                                    </table>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <button type="button" class="btn btn-primary me-2" data-toggle="modal" data-target="#staticBackdrop">
                                            Buscar Cliente
                                        </button>
                                        <br>
                                        <br>
                                        <button type="button" class="btn btn-success ms-3" data-toggle="modal" data-target="#staticBackdrop_crear_cliente">
                                            <i class="fas fa-plus"></i>
                                        </button>

                                        <!-- Modal Buscar Cliente -->
                                        <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Lista de Clientes</h5>
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
                                                              <th scope="col">Nombre Cliente</th>
                                                              <th scope="col">Nit / Codigo</th>
                                                              <th scope="col">Telefono</th>
                                                              <th scope="col">Nombre</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $contador = 1;?>
                                                        @foreach ($clientes as $cliente)
                                                            <tr>
                                                                <th style="text-align: center">{{$contador++}}</th>
                                                                <td style="text-align: center">
                                                                    <button type="button" class="btn btn-info seleccionar-btn-cliente" data-id="{{$cliente->id}}"  data-nombrecliente="{{$cliente->nombre_cliente}}">Seleccionar</button>
                                                                </td>
                                                                <td style="text-align: center">{{$cliente->nombre_cliente}}</td>
                                                                <td style="text-align: center">{{$cliente->nit_codigo}}</td>
                                                                <td style="text-align: center">{{$cliente->telefono}}</td>
                                                                <td style="text-align: center">{{$cliente->email}}</td>
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

                                        <!-- Modal Registrar Nuevo Cliente-->
                                        <div class="modal fade" id="staticBackdrop_crear_cliente" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Registro de Clientes</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <!--CONTENIDO DEL MODAL -->
                                                <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="nombre_cliente">Nombre del Cliente</label>
                                                                    <input type="text" class="form-control" value="{{old('nombre_cliente')}}" id="nombre_cliente" name="nombre_cliente" required>
                                                                    @error ('nombre_cliente' )
                                                                    <small style="color: red;">{{$message}} </small>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="nit_codigo">Nit Codigo</label>
                                                                    <input type="text" class="form-control" value="{{old('nit_codigo')}}" id="nit_codigo" name="nit_codigo" required>
                                                                    @error ('nit_codigo' )
                                                                    <small style="color: red;">{{$message}} </small>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="telefono">Telefono</label>
                                                                    <input type="number" class="form-control" value="{{old('telefono')}}" id="telefono" name="telefono" required>
                                                                    @error ('telefono' )
                                                                    <small style="color: red;">{{$message}} </small>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="email">Email</label>
                                                                    <input type="email" class="form-control" value="{{old('email')}}" id="email" name="email" required>
                                                                    @error ('email' )
                                                                    <small style="color: red;">{ {$message} } </small>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="button" onclick="guardar_cliente()" class="btn btn-primary" ><i class="fas fa-save"> Registrar</i>
                                                    </button>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="nombrecliente" disabled>

                                        <input type="text" class="form-control" id="id_clientes" name="id_clientes" hidden>

                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="fecha">Fecha de Venta<b>*</b></label>
                                            <input type="date" class="form-control" value="{{old('fecha')}}" name="fecha">
                                            @error('fecha')
                                            <small style="color: red;">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="precio_total">Precio Total<b>*</b></label>
                                            <input type="text" style="text-align: center;background-color: #cccc" class="form-control" value="{{$total_venta}}" name="precio_total">
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
                                            <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fas fa-save"> Registrar Compra</i>
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

        function guardar_cliente(){
            const data = {
                nombre_cliente: $('#nombre_cliente').val(),
                nit_codigo: $('#nit_codigo').val(),
                telefono: $('#telefono').val(),
                email: $('#email').val(),
                _token: '{{csrf_token()}}'
            };

            $.ajax({
                url: '{{route("admin.ventas.cliente.store")}}',
                type: 'POST',
                data: data,
                success: function(response){
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "Se registro el cliente",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    location.reload();
                },
                error: function(xhr, status, error){
                    Swal.fire({
                        position: "top-end",
                        icon: "error",
                        title: "No se registro el Cliente",
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            });
        }

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




        $('.seleccionar-btn-cliente').click(function(){
            var id_cliente = $(this).data('id');
            var nombre_cliente = $(this).data('nombrecliente');//Se obtine el nombre del data data-nombrecliente="{{$cliente->nombre_cliente}}">Seleccionar</button>

            /* alert(nombre_cliente); */

            $('#nombrecliente').val(nombre_cliente);
            $('#id_clientes').val(id_cliente);
            $('#staticBackdrop').modal('hide') ;
        })

        $('#codigo').focus();
        $('#form_cliente').on('keypress',function (e){
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
