<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">

        <title>Ejercicio4</title>
        <!--
        2. Crear una página a la que le pediremos la lista de películas
        almacenadas en un fichero XML que estara en el servidor.
        A la hora de mostrarlos, se creara una tabla y apareceran en dos columnas separadas.

        3. Crear una página en la que apareceran los carteles de las peliculas del ejercicio anterior.
        Cuando pulsemos sobre cada cartel aparecera la sinopsis de esa pelicula en un partado que estara debajo de las imagenes.
        Cada sinopsis se guardaran en un fichero diferente.

        4. Crear una página en la que habra un boton para pedir al servidor los datos de las peliculas.
        Cuando pulsemos sobre el nos apareceran dos objetos select (menu desplegable).
        En el primero elegiremos el nombre del director y en funcion de esa eleccion, en el segundo nos apareceran las peliculas de ese director.
        Cuando hayamos elegido la pelicula aparecera una breve sinospsis de la pelicula debajo de los objetos select.
        Si no se selecciona director, no aparecera ninguna pelicula para elegir.
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

            #desplegablesDiv {
                align-content: center;
                margin-top: 20px;
            }
        </style>

        <script>
            var formulario;
            var xmlDocPeliculas;
            var desplegables;
            var peliculas;
            var selectDirector;

            window.onload = iniciar;
            function iniciar() {
                formulario = document.getElementById('formulario');
            }

            function pedirPeliculas(event) {
                event.preventDefault();

                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        xmlDocPeliculas = this.responseXML;
                        crearDesplegables();
                        formulario.elements["submit"].disabled = true;
                    }
                };
                xhttp.open("GET", "Peliculas.xml", true);
                xhttp.send();
            }

            function crearDesplegables() {
                desplegables = document.getElementById("desplegablesDiv");
                peliculas = xmlDocPeliculas.getElementsByTagName("Pelicula");

                crearSelectDirector();
                crearSelectPeliculas();
            }

            function crearSelectDirector() {
                crearSelect("directorSelect");
                crearOptionsDirector();
            }

            function crearSelectPeliculas() {
                crearSelect("peliculaSelect");
            }

            function crearOptionsDirector() {
                selectDirector = document.getElementById("directorSelect");
                crearDefaultOptions(selectDirector);

                for (var i = 0; i < peliculas.length; i++) {
                    var option = document.createElement("option");
                    option.value = peliculas[i].getElementsByTagName("Director")[0].childNodes[0].nodeValue;
                    var texto = peliculas[i].getElementsByTagName("Director")[0].childNodes[0].nodeValue;
                    option.appendChild(document.createTextNode(texto));
                    selectDirector.appendChild(option);
                }



                selectDirector.addEventListener("change", crearOptionsPelicula);
            }

            function crearOptionsPelicula() {
                var selectPelicula = document.getElementById("peliculaSelect");
                vaciarSelect(selectPelicula);
                crearDefaultOptions(selectPelicula);

                for (var i = 0; i < peliculas.length; i++) {
                    var director = peliculas[i].getElementsByTagName("Director")[0].childNodes[0].nodeValue;
                    var titulo = peliculas[i].getElementsByTagName("Titulo")[0].childNodes[0].nodeValue;
                    if (selectDirector.value == director) {
                        var option = document.createElement("option");
                        option.value = titulo;
                        option.appendChild(document.createTextNode(titulo));
                        selectPelicula.appendChild(option);
                    }
                }

                selectPelicula.addEventListener("change", mostrarSinopsis);
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
                xhttp.open("GET", "sinopsis/"+event.target.value+".xml", true);
                xhttp.send();
            }

            function crearSelect(name) {
                var select = document.createElement("select");
                select.id = name;
                desplegables.appendChild(select);
            }

            function crearDefaultOptions(select) {
                var defaultOption = document.createElement("option");
                defaultOption.value = "";
                defaultOption.selected = true;
                defaultOption.disabled = true;
                //defaultOption.hidden = true;
                defaultOption.appendChild(document.createTextNode("Selecciona una opcion"));
                select.appendChild(defaultOption);
            }

            function vaciarSelect(select) {
                options = document.querySelectorAll("#"+select.id+" > option");
                for (var i = 0; i < options.length; i++) {
                    options[i].parentNode.removeChild(options[i]);
                }
            }

        </script>

    </head>
    <body>
        <div align="center">
            <form id="formulario" onsubmit="pedirPeliculas(event)">
                <input type="submit" name="submit" value="Pedir peliculas"/>
            </form>
            <div id="desplegablesDiv"></div>
            <p id="sinopsisP"/>
        </div>
    </body>
</html>
