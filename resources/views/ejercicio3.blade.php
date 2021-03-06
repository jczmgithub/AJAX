<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">

        <title>Ejercicio3</title>
        <!--
        3. Crear una página en la que apareceran los carteles de las peliculas del ejercicio anterior.
        Cuando pulsemos sobre cada cartel aparecera la sinopsis de esa pelicula en un partado que estara debajo de las imagenes.
        Cada sinopsis se guardaran en un fichero diferente.
        -->

        <style>
            .cartel {
                width: 120px;
                height: 100px;
                margin: 10px;
                border: solid;
                display: inline-block;
                vertical-align: top;
            }

            #sinopsisP {
                max-width: 900px;
                min-height: 100px;
                border: solid;
            }

            #cartelesDiv {
                align-content: center;
            }
        </style>

        <script>
            var xmlDocPeliculas;

            window.onload = iniciar;
            function iniciar() {
                loadDocPeliculas();
            }

            function loadDocPeliculas() {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        xmlDocPeliculas = this.responseXML;
                        crearCarteles();
                    }
                };
                xhttp.open("GET", "Peliculas.xml", true);
                xhttp.send();
            }

            function crearCarteles() {
                var carteles = document.getElementById("cartelesDiv");
                var peliculas = xmlDocPeliculas.getElementsByTagName("Pelicula");

                for (var i = 0; i < peliculas.length; i++) {
                    var cartel = document.createElement("div");
                    cartel.className = "cartel";
                    cartel.id = "cartel"+i;
                    cartel.textContent = peliculas[i].getElementsByTagName("Titulo")[0].childNodes[0].nodeValue;
                    cartel.addEventListener("click", mostrarSinopsis);
                    carteles.appendChild(cartel);
                }
            }

            function mostrarSinopsis(event) {
                var sinopsis="Sinopsis: ";

                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        var xmlDocSinopsis = this.responseXML;
                        sinopsis += xmlDocSinopsis.getElementsByTagName("Sinopsis")[0].childNodes[0].nodeValue;
                        document.getElementById("sinopsisP").textContent = sinopsis;
                    }
                };
                xhttp.open("GET", "sinopsis/"+event.target.textContent+".xml", true);
                xhttp.send();
            }
        </script>

    </head>
    <body>
        <div align="center">
            <div id="cartelesDiv"></div>
            <p id="sinopsisP"/>
        </div>
    </body>
</html>
