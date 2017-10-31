<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">

        <title>Ejemplo</title>

        <style>

        </style>
    </head>
    <body>
        <div align="center">
            <form id="formulario" action="ejemplo/submit" method="get">

                <input type="text" name="nombre" placeholder="Nombre"></br>

                <button type="submit">Enviar</button>

            </form>
        </div>
    </body>
</html>
