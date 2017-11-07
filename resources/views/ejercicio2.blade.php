<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">

        <title>Ejercicio2</title>
        <!--
        2. Crear una página a la que le pediremos la lista de películas
        almacenadas en un fichero XML que estara en el servidor.
        A la hora de mostrarlos, se creara una tabla y apareceran en dos columnas separadas.
        -->

        <script>
            function comprobarExistenciaFicheroXML(event){
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

            function pedirPeliculas(){
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
            <form id="formulario" onsubmit="pedirPeliculas(event)">
                <input type="submit" value="Pedir Peliculas"/>
            </form>
            <p id="respuesta"/>
        </div>
    </body>
</html>
