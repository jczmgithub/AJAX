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
            function loadDoc(event) {
                event.preventDefault();
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        myFunction(this);
                    }
                };
                xhttp.open("GET", "Peliculas.xml", true);
                xhttp.send();
            }

            function myFunction(xml) {
                var i;
                var xmlDoc = xml.responseXML;
                var table="<tr><th>Director</th><th>Titulo</th></tr>";
                var x = xmlDoc.getElementsByTagName("Pelicula");
                for (i = 0; i <x.length; i++) {
                    table += "<tr><td>" +
                        x[i].getElementsByTagName("Director")[0].childNodes[0].nodeValue +
                        "</td><td>" +
                        x[i].getElementsByTagName("Titulo")[0].childNodes[0].nodeValue +
                        "</td></tr>";
                }
                document.getElementById("respuesta").innerHTML = table;
            }
        </script>

        <style>
            #respuesta, th, td {
                border: 1px solid black;
                margin-top: 20px;
            }
        </style>
    </head>
    <body>
        <div align="center">
            <form id="formulario" onsubmit="loadDoc(event)">
                <input type="submit" value="Pedir Peliculas"/>
            </form>
            <table id="respuesta"/>
        </div>
    </body>
</html>
