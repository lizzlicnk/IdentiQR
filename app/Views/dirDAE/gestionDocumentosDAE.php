
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/jpg" href="Media/img/Favicon.ico"/> <!--FAVICON-->
        <title>DireccionDAE_IdentiQR</title>

        <!--TODO: Aquí se tendra que pasar a CSS-->
    </head>
    <body>
        <!-- !Aquí se encontrara el emcabezado, este podrá cambiar: nota-->
        <header id="HeaderIndex1">
            <div class="container__header">
                <div class="logo">
                    <img src="../Media/img/IdentiQR-Eslogan-SinFonde.png" alt="Banner-IdentiQR" weight="200" height="200">
                </div>
                <div class="container__nav">
                    <nav id="nav">
                        <ul>
                            <li><a href="../index.html" class="select">INICIO</a></li>
                            <li><a href="#">TEMAS</a></li>
                            <li><a href="#">CONTACTOS</a></li>
                        </ul>
                    </nav>
                    <div class="btn__menu" id="btn_menu">
                        <i class="fas fa-bars"></i>
                    </div>
                </div>
            </div>
        </header>
        <!--*Apartir de acá se inicializara la parte de la página general, sera nuestro tema central e identificación de lo que contendra-->
        <div id="HeaderLogin">
            <h2><center>IdentiQR</center></h2>
            
        </div>
        <hr>
        <!-- TODO: Aquí empezaremos con la información que tiene que ver con los datos o mayoritariamente del index principal (Recursos, etc.)-->
        <h2>Gestión de documentos de alumnos</h2>
        <div id = "inscripcionExtracurricular">
            <form action="">
                <fieldset>
                    <legend>Inscripción a extracurricular</legend>
                    <!--!: Aquí se encontrara toda la información relevante para obtener un QR y generar la información del extracurricular -->
                    <label for = "codigoQR_Estudiante">Escanear_QR</label> <!--*: Aquí debería abrir la camara para escanear-->
                    <br><br>
                    <label for="idTramite">Tramite a realizar: </label>
                        <select name="idTramite" id="idTramite" required>
                            <option no value="" disabled="disabled" selected>Seleccione</option>
                            <option value="0001">Inscripción a extracurricular</option>
                        </select>
                    <br><br>
                    <label for="seleccionExtra">Seleccione el extracurricular a inscribir: </label>
                        <select name="seleccionExtra" id="seleccionExtra">
                            <option value="" disabled="disabled" selected>Selección de extracurricular</option>
                            <option value="Fubtol">Futbol</option>
                            <option value="Voleibol">Voleibol</option>
                            <option value="Pasaporte literario">Pasaporte literario</option>
                            <option value="Latín clásico">Latín clásico</option>
                            <option value="Cine debate">Cine debate</option>
                            <option value="Ajedrez">Ajedrez</option>
                            <option value="Básquetbol">Básquetbol</option>
                            <option value="Dibujo">Dibujo</option>
                            <option value="Baile">Baile</option>
                            <option value="Canto">Canto</option>
                            <option value="Fotografía">Fotografía</option>
                        </select>
                    <br>
                    <!--*: Cuando se registre, en el descripción se incluira: "Realizo una inscripción en el departamento de DAE para el extracurricular de: ..."-->
                    <input type="submit" value="Registrar extracurricular alumno" name = "Enviar_DocumentoAlumno_DAE" onclick="alert('Datos enviados con exito')">
                </fieldset>
            </form>
        </div>

        <div id = "revisarExtracurricular">
            <form action="">
                <fieldset>
                    <legend>Revisar y actualizar extracurricular</legend>
                    <!--!: Aquí se encontrara toda la información relevante para obtener un QR y generar el justificante-->
                    <label for = "codigoQR_Estudiante">Escanear_QR</label> <!--*: Aquí debería abrir la camara para escanear-->
                    <table id = "extracurricularTramite">
                        <th>Folio de registro </th>
                        <th>Tramite realizado </th>
                        <th>Fecha y hora </th>
                        <th>Descripción </th>
                        <th>Estatus </th>
                        <th>Matricula </th>
                        <th>Extracurricular inscrito </th>
                        <!--*: TODOS ESTOS DATOS SE DEBERAN LLENAR ACORDE A LOS DATOS QUE SE TIENEN--> 
                        <!-- Aquí se llenarán los datos dinámicamente -->
                    </table>
                    <br><br>

                    <label for="ActualizarExtra">Desea actualizar el extracurricular?</label>
                        <input type="checkbox" name="actualizarExtra" id="actualizarExtra">
                    <hr>
                     <!-- Contenedor oculto por defecto -->
                    <div id="nuevoExtraDiv" style="display:none; margin-top:10px;">
                        <label for="nuevoExtra">Nuevo extracurricular: </label>
                        <select name="nuevoExtra" id="nuevoExtra" required>
                            <option value="" disabled="disabled" selected>Selección de extracurricular</option>
                            <option value="Fubtol">Futbol</option>
                            <option value="Voleibol">Voleibol</option>
                            <option value="Pasaporte literario">Pasaporte literario</option>
                            <option value="Latín clásico">Latín clásico</option>
                            <option value="Cine debate">Cine debate</option>
                            <option value="Ajedrez">Ajedrez</option>
                            <option value="Básquetbol">Básquetbol</option>
                            <option value="Dibujo">Dibujo</option>
                            <option value="Baile">Baile</option>
                            <option value="Canto">Canto</option>
                            <option value="Fotografía">Fotografía</option>
                        </select>
                        <br><br>
                        <input type="submit" value="Actualizar_DocAlumno_DAE" name = "Actualizar_DocAlumno_DAE" onclick="alert('Datos actualizados con exito')">
                    </div>
                    <hr>
                </fieldset>
            </form>
        </div>
        <!--!: Script para ocultar y aparecer las opciones-->
        <script>
            const checkExtra = document.getElementById("actualizarExtra");
            const divNuevoExtra = document.getElementById("nuevoExtraDiv");

            checkExtra.addEventListener("change", () => {
                divNuevoExtra.style.display = checkExtra.checked ? "block" : "none";
            });
        </script>

        <br>
        <hr>
        <br>

        <div id = "bajaExtracurricular">
            <form action="">
                <fieldset>
                    <legend>Revisar y actualizar extracurricular</legend>
                    <!--!: Aquí se encontrara toda la información relevante para obtener un QR y generar el justificante-->
                    <label for = "codigoQR_Estudiante">Escanear_QR</label> <!--*: Aquí debería abrir la camara para escanear-->
                    <table id = "extracurricularTramite">
                        <th>Folio de registro </th>
                        <th>Tramite realizado </th>
                        <th>Fecha y hora </th>
                        <th>Descripción </th>
                        <th>Estatus </th>
                        <th>Matricula </th>
                        <th>Extracurricular inscrito </th>
                        <!--*: TODOS ESTOS DATOS SE DEBERAN LLENAR ACORDE A LOS DATOS QUE SE TIENEN--> 
                        <!-- Aquí se llenarán los datos dinámicamente -->
                    </table>
                    <br><br>

                    <label for="folioRegistro_Extra">Folio de registro: </label>
                        <input type="text" name="folioRegistro_Extra" id="folioRegistro_Extra">
                    <label for="BajaExtra">Desea cancelar el extracurricular?</label>
                        <input type="checkbox" name="BajaExtra" id="BajaExtra">
                    <hr>
                        <input type="submit" value="Baja_DocAlumno_DAE" name = "Baja_DocAlumno_DAE" onclick="alert('Datos eliminados con exito')">
                    <hr>
                </fieldset>
            </form>
        </div>


        <footer class="FooterIndex1" id = "FooterIndex1">
            <div class="FooterIndex1">
                <div class="footer__info">
                    <h3>IdentiQR</h3>
                    <p>
                        ©2025 IdentiQR. Todos los derechos reservados.
                        <br>
                        Diseñado por: Lizbeth B. y Alexis S.
                    </p>
                </div>
                <div class="footer__links">
                    <!--*: Todo esto tiene que ver con los LINKS que se involucraran al diseñar el sitio web-->
                    <a href="mailto: IdentiQR.info@gmail.com">Contact Us</a>
                    <a href="#Terms_Index1">Terminos del servicio</a>
                </div>
            </div>

            <!-- Nuevo div de términos -->
            <div id="Terms_Index1">
                <p>
                    Toda información resguardada será de carácter relevante. 
                    No se podrá acceder a este sistema si no se cuenta con previo registro. 
                    Por ningún motivo el estudiante podrá acceder al sistema.
                </p>
            </div>
        </footer>
    </body>
</html>