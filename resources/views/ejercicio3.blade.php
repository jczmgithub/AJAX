<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">

        <title>Ejercicio3</title>
        <!--
        2. Crear una página a la que le pediremos la lista de películas
        almacenadas en un fichero XML que estara en el servidor.
        A la hora de mostrarlos, se creara una tabla y apareceran en dos columnas separadas.

        3. Crear una página en la que apareceran los carteles de las peliculas del ejercicio anterior.
        Cuando pulsemos sobre cada cartel aparecera la sinopsis de esa pelicula en un partado que estara debajo de las imagenes.
        Cada sinopsis se guardaran en un fichero diferente.
        -->

        <style>
            .cartel {
                width: 100px;
                height: 100px;
                margin: 10px;
                border: solid;
                display: inline-block;
            }

            #sinopsisP {
                max-width: 1000px;
                min-height: 100px;
                border: solid;
            }
        </style>

        <script>
            var xmlDoc;

            window.onload = iniciar;
            function iniciar() {
                loadDoc();
            }

            function loadDoc() {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        xmlDoc = this.responseXML;
                        crearCarteles();
                    }
                };
                xhttp.open("GET", "Peliculas.xml", true);
                xhttp.send();
            }

            function crearCarteles() {
                var carteles = document.getElementById("cartelesDiv");

                for (var i = 0; i < xmlDoc.getElementsByTagName("Pelicula").length; i++) {
                    var cartel = document.createElement("div");
                    cartel.className = "cartel";
                    cartel.id = "cartel"+i;
                    cartel.textContent = cartel.id;
                    cartel.addEventListener("click", mostrarSinopsis);
                    carteles.appendChild(cartel);
                }
            }

            function mostrarSinopsis() {
                var sinopsis="Sinopsis: ";
                /*
                var x = xmlDoc.getElementsByTagName("Pelicula");

                for (var i = 0; i <x.length; i++) {
                    sinopsis += "<tr><td>" +
                        x[i].getElementsByTagName("Director")[0].childNodes[0].nodeValue +
                        "</td><td>" +
                        x[i].getElementsByTagName("Titulo")[0].childNodes[0].nodeValue +
                        "</td></tr>";
                }
                */
                document.getElementById("sinopsisP").textContent = sinopsis;
            }

            function myFunction(xml) {
                var i;
                var xmlDoc = xml.responseXML;

                var sinopsis="Sinopsis: ";
                var x = xmlDoc.getElementsByTagName("Pelicula");
                for (i = 0; i <x.length; i++) {
                    sinopsis += "<tr><td>" +
                        x[i].getElementsByTagName("Director")[0].childNodes[0].nodeValue +
                        "</td><td>" +
                        x[i].getElementsByTagName("Titulo")[0].childNodes[0].nodeValue +
                        "</td></tr>";
                }

                document.getElementById("sinopsisP").textContent = sinopsis;
            }
        </script>

    </head>
    <body>
        <div align="center">
            <div id="cartelesDiv" align="center"></div>
            <p id="sinopsisP"/>
        </div>
    </body>
</html>
