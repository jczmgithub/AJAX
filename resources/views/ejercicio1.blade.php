<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">

        <title>Ejercicio1</title>
        <!--
        1. Crear una página en el que aparecerá un cuadro de texto y un boton.
        Al pulsar el boton pediremos al servidor web el contenido del fichero que le indiquemos en el cuadro de texto.
        Este texto deberá aparecer debajo de los elementos en un cuadro.
        En el caso de que el fichero no exista en el servidor tendra que avisarnos de ello.
        -->

        <script>
            function comprobarExistenciaFichero(event){
                event.preventDefault();
                file_url = document.getElementById('formulario').elements['fichero'].value;
                var http = new XMLHttpRequest();
                http.open('HEAD', file_url, true);
                http.onreadystatechange = function () {
                    if (http.readyState == 4) {
                        if (http.status == 200) {
                            pedirContenidoFichero();
                        } else {
                            alert("El fichero no existe");
                        }
                    }
                }
                http.send();
            }

            function pedirContenidoFichero(){
                var xhr = new XMLHttpRequest();
                var url = "ejercicio1/submit" + "?fichero=" + document.getElementById('formulario').elements['fichero'].value;
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
            #respuesta {
                min-width: 200px;
                min-height: 200px;
                border: solid;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <div align="center">
            <form id="formulario" onsubmit="comprobarExistenciaFichero(event)">
                <input type="text" name="fichero" placeholder="Nombre del fichero"></br></br>

                <input type="submit" value="Mostrar contenido"/>
            </form>
            <p id="respuesta"/>
        </div>
    </body>
</html>
