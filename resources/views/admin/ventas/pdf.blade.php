<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Sistema de Ventas</title>
  </head>
  <body>
    <table style="font-size: 8pt">
        <tr>
            <td style="text-align: center"><img src="{{public_path('storage/'.$empresa->logo)}}" width="100px" alt=""></td>
            <td width="500px"></td>
            <td style="text-align: center">
              <b>NIT: </br>{{$empresa->nit}}<br>
              <br>Nro Factura: </br>{{$venta->id}}<br>
            </td>
        </tr>
        <tr>
            <td style="text-align: center">
                {{$empresa->nombre_empresa}}<br>
                {{$empresa->tipo_empresa}}<br>
                {{$empresa->correo}}<br>
                {{$empresa->telefono}}<br>
            </td>

            <td width="500px" style="text-align: center"><h1>FACTURA</h1></td>
            <td style="text-align: center"><h4>ORIGIAL</h4></td>
        </tr>

    </table>

    <br>
    <?php
        $fecha_db = $venta->fecha;

        //convertir la fecha al formtato deseado
        $fecha_formateada = date('d', strtotime($fecha_db)) . " de " .
                            date('F', strtotime($fecha_db)) . " del " .
                            date('Y', strtotime($fecha_db));

        $meses = [
            'January' =>'Enero',
            'February' =>'Febrero',
            'March' =>'Marzo',
            'April' =>'Abril',
            'May' =>'Mayo',
            'June' =>'Junio',
            'July' =>'Julio',
            'August' =>'Agosto',
            'September' =>'Septiembre',
            'October' =>'Octubre',
            'November' =>'Noviembre',
            'December' =>'Diciembre',
        ];

        $fecha_formateada = str_replace(array_keys($meses), array_values($meses), $fecha_formateada);



    ?>

    <div style="border: 1px solid #000">
      <table cellpadding="6">
        <tr>
          <td width="300px"><b>Fecha: </b>{{$fecha_formateada}}</b></td>
          <td width="200px"></td>
          <td><b>Nit/CI: </b>{{$venta->cliente->nit_codigo}}</td>
        </tr>
        <tr>
          <td><b>Señor(es): </b>{{$venta->cliente->nombre_cliente}}</td>
        </tr>
      </table>
    </div>


    <Table border="1">
        <tr>
            <td width="30px" style="background-color: #ccccc; text-align: center"><b>Nro</b"></td>
            <td width="150px" style="background-color: #ccccc; text-align: center"><b>Productos</b"></td>
            <td width="190px" style="background-color: #ccccc; text-align: center"><b>Descripcion</b"></td>
            <td width="90px" style="background-color: #ccccc; text-align: center"><b>Cantidad</b"></td>
            <td width="110px" style="background-color: #ccccc; text-align: center"><b>Precio Unitario</b"></td>
            <td width="90px" style="background-color: #ccccc; text-align: center"><b>SubTotal</b"></td>
        </tr>
    </Table>



    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    -->
  </body>
</html>
