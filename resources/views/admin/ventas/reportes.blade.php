<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body{
            font-family: Arial, sans-serif;
            margin: 0;
        }

        /*ENCABEZADO*/
        .header{
            background: #f0f0f0;
        }
        /*PIE DE PAGINA*/
        .footer{
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: 30px;
            background: #f0f0f0;
            text-align: center;
            line-height: 30px;
            font-size: 12px;
            border-top: 1px solid #ddd;
        }
        /*ESTILO DEL CONTENIDO*/
        .content{
            margin: 20px 20px 50px 20px;/*ESPACIO ENTRE EL ENCABEZADO Y PIE*/
        }

        .page-number:before{
            content: "Pagina " counter(page);
        }

        .table{
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            border-collapse: collapse;
        }
        .table-bordered{
            border: 1px solid #00000;
        }
        .table-bordered td, .table-bordered th{
            border: 1px solid #00000;
        }
        .table-bordered thead th{
            vertical-align: bottom;
            border-bottom-width: 2px;
        }
    </style>
</head>
<body>
    <div class="header">
        <table style="font-size: 8pt">
            <tr>
                <td style="text-align: center">
                    {{$empresa->nombre_empresa}}<br>
                    {{$empresa->tipo_empresa}}<br>
                    {{$empresa->correo}}<br>
                    {{$empresa->telefono}}<br>
                </td>

                <td width="500px" style="text-align: center"><h1>SISTEMA DE VENTA</h1></td>
                <td style="text-align: center"><img src="{{public_path('storage/'.$empresa->logo)}}" width="100px" alt=""></td>
            </tr>

        </table>
    </div>

    <div class="content">
        <h2>Reporte de Ventas</h2>
        <hr>
        <table class="table table-striped table-hover table-sm table-responsive table-bordered " cellpadding="5">
            <thead>
                <tr>
                    <th width="30px" style="text-align: center">Nro</th>
                    <th width="30px" style="text-align: center">Precio Total</th>
                    <th width="30px" style="text-align: center">Cliente</th>
                    <th width="30px" style="text-align: center">NIT/Codigo</th>
                    <th width="30px" style="text-align: center">Fecha y hora de Registro</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $contador = 1;
                    $suma_total = 0;
                @endphp
                @foreach ($ventas as $venta)
                    @php
                        $suma_total += $venta->precio_total;
                    @endphp
                    <tr>
                        <td style="text-align: center">{{$contador++}}</td>
                        <td style="text-align: center">{{$venta->precio_total}}</td>
                        <td style="text-align: center">{{$venta->cliente->nombre_cliente}}</td>
                        <td style="text-align: center">{{$venta->cliente->nit_codigo}}</td>
                        <td style="text-align: center">{{$venta->created_at}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <p><b>Total de Ventas: {{$suma_total}}</b></p>
    </div>

    <div class="footer">
        <div class="page-number"></div>
    </div>

</body>
</html>
