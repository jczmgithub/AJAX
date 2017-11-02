<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">

        <title>Ejemplo</title>

        <script>
            function pruebaAJAX(){
                var xhr = new XMLHttpRequest();
                var url = "ejemplo/submit" + "?nombre=" + document.getElementById('formulario').elements['nombre'].value;
                xhr.open("GET", url, true);
                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4) {
                        // Se ha recibido la respuesta.
                        if(xhr.status==200) {
                            // Aquí escribiremos lo que queremos que
                            // se ejecute tras recibir la respuesta
                            var datosDoc = xhr.responseText;
                            document.getElementById('respuesta').textContent = datosDoc;
                        } else {
                            // Ha ocurrido un error
                            alert("Error: "+xhr.statusText);
                        }
                    }
                };
                xhr.send(null);
            }
        </script>

        <style>

        </style>
    </head>
    <body>
        <div align="center">
            <form id="formulario">

                <input type="text" name="nombre" placeholder="Nombre"></br>

                <input type="button" onclick="pruebaAJAX()" value="Enviar"></inputbutton>

            </form>
            <p id="respuesta"/>
        </div>
    </body>
</html>
