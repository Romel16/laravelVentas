@extends('adminlte::page')

@section('content_header')
    <h1><b>Productos / Registro de Productos</b></h1>
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
                    <form action="{{url('/admin/productos/create')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="categoria_id">Categoria</label>
                                            <select name="categoria_id" id="" class="form-control">
                                                @foreach ($categorias as $categoria)
                                                    <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="codigo">Codigo <b>*</b></label>
                                            <input type="text" class="form-control" value="{{old('codigo')}}" name="codigo" required>
                                            @error('codigo')
                                            <small style="color: red;">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nombre">Nombre del Producto <b>*</b></label>
                                            <input type="text" class="form-control" value="{{old('nombre')}}" name="nombre" required>
                                            @error('nombre')
                                            <small style="color: red;">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="descripcion">Descripcion</label>
                                            <textarea name="descripcion"  id="" cols="30" rows="2" class="form-control"></textarea>
                                            @error('descripcion')
                                            <small style="color: red;">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="stock">Stock<b>*</b></label>
                                            <input type="number" class="form-control" value="0" name="stock" required>
                                            @error('stock')
                                            <small style="color: red;">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="stock_minimo">Stock Minimo<b>*</b></label>
                                            <input type="number" class="form-control" value="0" name="stock_minimo" required>
                                            @error('stock_minimo')
                                            <small style="color: red;">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="stock_maximo">Stock Max<b>*</b></label>
                                            <input type="number"class="form-control" value="0" name="stock_maximo" required>
                                            @error('stock_maximo')
                                            <small style="color: red;">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="precio_compra">Precio Comp<b>*</b></label>
                                            <input type="text"class="form-control" value="{{old('precio_compra')}}" name="precio_compra" required>
                                            @error('precio_compra')
                                            <small style="color: red;">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="precio_venta">Precio Venta<b>*</b></label>
                                            <input type="text"class="form-control" value="{{old('precio_venta')}}" name="precio_venta" required>
                                            @error('precio_venta')
                                            <small style="color: red;">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="fecha_ingreso">Fecha Ingreso<b>*</b></label>
                                            <input type="date"class="form-control" value="{{old('fecha_ingreso')}}" name="fecha_ingreso" required>
                                            @error('fecha_ingreso')
                                            <small style="color: red;">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="logo">Imagen</label>
                                    <input type="file" id="file" name="imagen" accept=".jpg,.jpeg,.png" class="form-control">
                                    <br>
                                    <center><output id="list"></output></center>

                                    <script>
                                        function archivo(evt) {
                                            var files = evt.target.files; // File List object
                                            // Obtenemos la imagen del campo "file"
                                            for (var i = 0, f; f = files[i]; i++) {
                                                // Solo admitimos imágenes
                                                if (!f.type.match('image.*')) {
                                                    continue;
                                                }
                                                var reader = new FileReader();
                                                reader.onload = (function(theFile) {
                                                    return function(e) {
                                                        // Insertamos la imagen
                                                        document.getElementById("list").innerHTML = [
                                                            '<img class="thumb thumbnail" src="',
                                                            e.target.result,
                                                            '" width="70%" title="',
                                                            escape(theFile.name),
                                                            '"/>'
                                                        ].join('');
                                                    };
                                                })(f);
                                                reader.readAsDataURL(f);
                                            }
                                        }
                                        document.getElementById('file').addEventListener('change', archivo, false);
                                    </script>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <a href="{{url('/admin/productos')}}" class= "btn btn-secondary"><i class="fa-solid fa-circle-xmark"> Cancelar</i></a>
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
