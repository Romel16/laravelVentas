@extends('adminlte::page')


@section('content_header')
    <h1>Configuracion/Editar</h1>
    <hr>
@stop

@section('content')

    <div class="row">
        <div class="col-md-12">
            {{-- Card Box --}}
            <div class="card card-outline card-success" style="box-shadow: 5px 5px 5px 5px #cccccc">

                <div class="card-header {{ config('adminlte.classes_auth_header', '') }}">
                    <h3 class="card-title float-none">
                        <b>Datos Registrados</b>
                    </h3>
                </div>


                {{-- Card Body --}}
                <div class="card-body {{ $auth_type ?? 'login' }}-card-body {{ config('adminlte.classes_auth_body', '') }}">
                    <form action="{{url('/admin/configuraciones', $empresa->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="logo">Logo</label>
                                    <input type="file" id="file" name="logo" accept=".jpg,.jpeg,.png" class="form-control">
                                    <br>
                                    <center>
                                        <output id="list">
                                            <img src="{{asset('storage/'.$empresa->logo)}}" width="50%" alt="logo">
                                        </output>
                                    </center>

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
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="pais">País</label>
                                            <select name="pais" id="select-pais" class="form-control">
                                                @foreach($paises as $pais)
                                                <option value="{{$pais->id}}" {{$empresa->pais == $pais->id ? 'selected': ''}}>{{$pais->name}}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="departamento">Provincia/Region</label>
                                            <select name="departamento" id="select_departamento2" class="form-control">
                                                @foreach($departamentos as $departamento)
                                                <option value="{{$departamento->id}}" {{$empresa->departamento == $departamento->id ? 'selected': ''}}>{{$departamento->name}}</option>
                                                @endforeach
                                            </select>
                                            <div id="respuesta-pais">

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="ciudad">Ciudad</label>
                                            <select name="ciudad" id="select_ciudad2" class="form-control">
                                            @foreach($ciudades as $ciudad)
                                                <option value="{{$ciudad->id}}" {{$empresa->ciudad == $ciudad->id ? 'selected': ''}}>{{$ciudad->name}}</option>
                                                @endforeach
                                            </select>
                                            <div id="respuesta-ciudad">

                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="nombre_empresa">Nombre de la Empresa</label>
                                            <input type="text" value="{{$empresa->nombre_empresa}}" name="nombre_empresa"class="form-control" required>
                                            @error('nombre_empresa')
                                            <small style="color: red;">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tipo_empresa">Tipo de la Empresa</label>
                                            <input type="text" value="{{$empresa->tipo_empresa}}" name ="tipo_empresa" class="form-control" required> @error('tipo_empresa')
                                            <small style="color: red;">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="nit">NIT</label>
                                            <input type="text" value="{{$empresa->nit}}" name="nit" class="form-control" required> @error('nit')
                                            <small style="color: red;">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="moneda">Moneda</label>
                                            <select name="moneda" id="" class="form-control">
                                                @foreach($monedas as $moneda)
                                                <option value="{{$moneda->id}}"{{$empresa->moneda == $moneda->id ? 'selected': ''}}>{{$moneda->symbol}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="nombre_impuesto">Nombre del Impuesto</label>
                                                <input type="text" value="{{$empresa->nombre_impuesto}}" name="nombre_impuesto"class="form-control" required> @error('nombre_impuesto')
                                                <small style="color: red;">{{$message}}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="cantidad_impuesto">Cantidad</label>
                                                <input type="number" value="{{$empresa->cantidad_impuesto}}"name="cantidad_impuesto"class="form-control" required> @error('Cantidad')
                                                <small style="color: red;">{{$message}}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="telefono_empresa">Telefono de la Empresa</label>
                                                <input type="text" value="{{$empresa->telefono}}" name="telefono"class="form-control" required> @error('telefono')
                                                <small style="color: red;">{{$message}}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="correo_empresa">Correo de la Empresa</label>
                                                <input type="email" value="{{$empresa->correo}}"name="correo"class="form-control" required> @error('correo_empresa')
                                                <small style="color: red;">{{$message}}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>


                                </div>

                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="direccion">Direccion</label>
                                            <input id="pac-input" class="form-control" name="direccion" type="text" value="{{$empresa->direccion}}" required>@error('direccion')
                                            <small style="color: red;">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="codigo_postal">Codigo Postal</label>
                                            <select name="codigo_postal" id="" class="form-control">
                                                @foreach($paises as $pais)
                                                <option value="{{$pais->phone_code}}" {{$empresa->codigo_postal == $pais->phone_code ? 'selected': ''}}>{{$pais->phone_code}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <div class="row">
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-lg btn-success btn-black">Actualizar datos</button>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Card Footer --}}
            @hasSection('auth_footer')
            <div class="card-footer {{ config('adminlte.classes_auth_footer', '') }}">
                @yield('auth_footer')
            </div>
            @endif

        </div>
    </div>
@stop

@section('css')

@stop

@section('js')
<script>
    $('#select-pais').on('change', function() {
        /* alert("hola") */
        var id_pais=$('#select-pais').val();

        if (id_pais) {
            $.ajax({
                url: "{{url('/admin/configuraciones/pais/')}}"+'/'+id_pais,
                type:"GET",
                success:function(data){
                    //sobre escribe el combo para reemplazar
                    $('#select_departamento2').css('display','none');
                    $('#respuesta-pais').html(data);
                }
            });
        }else{
            alert('debe seleccionar un pais');
        }

    });
</script>

<script>
    $(document).on('change','#select_estado',function(){
        var id_estados=$(this).val();
        /* alert(id_estados); */

        if (id_estados) {
            $.ajax({
                url: "{{url('/admin/configuraciones/estado/')}}"+'/'+id_estados,
                type:"GET",
                success:function(data){
                    $('#select_ciudad2').css('display','none');
                    $('#respuesta-ciudad').html(data);
                }
            });
        }else{
            alert('debe seleccionar un estados');
        }
    });
</script>

@stop
