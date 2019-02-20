<!DOCTYPE HTML>

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>PDF</title>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
</head>

<body style="font-family: 'Open Sans', sans-serif;">

    <section>
        <article>
            <header>
                <center>
                    <img style="width: 100px;border-radius: 100%;height: 100px;margin-bottom: 20px;" src="{{ asset('uploads/banners/conjunto/'.$img) }}" />
                </center>
                <center><h2>Reporte envio de Información</h2></center>

            </header>
            <p><strong>Conjunto Residencial:</strong> {{ $c_nombre }}</p>
            <p><strong>Fecha:</strong>  {{ $fecha }}</p>
            <p><strong>Fecha Leido:</strong>  {{ $fecha_leido }}</p>

            <table border="0" cellspacing="10" width="75%">
                <tr>
                    <td>Residente</td>
                    <td><center>Unidad</center></td>
                    <td><center>Apartamento</center></td>
                </tr>
                <tr>
                    <td><p style="border-right: 1px solid gray; padding-right: 15px;">{{ $nombres }} {{ $apellidos }}</p></td>
                    <td><p style="border-right: 1px solid gray; padding-right: 15px;text-align: center;">{{ $c_tipo }} {{ $c_value }}</p></td>
                    <td><p style="border-right: 1px solid gray; padding-right: 15px;text-align: center;">{{ $c_apartamento }}</p></td>
                </tr>
            </table>

        </article>
        <article>
            <header>
                <h3>Mensaje</h3>
            </header>
            <p><strong>Asunto: </strong> {{ $asunto }}</p>
            <br/>
            <p>{{ $mensaje }}</p>
        </article>
    </section>

    <footer style="position: absolute;bottom: 10px;">
        <center><img src="{{ asset('build/assets/img/logo_login.png') }}" width="60" height="60"></center>
        <center>Copyright 2017 - HGV</center>
    </footer>

</body>

</html>