
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/jpg" href="/IdentiQR/public/Media/img/Favicon.ico"/> <!--FAVICON-->
        <link rel="stylesheet" href="/IdentiQR/public/CSS/gestionesTramites_Direcciones.css">
        <title>DireccionVinculación_IdentiQR</title>
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
        <div id = "generarJustificante">
            <form action="">
                <fieldset>
                    <legend>Generar justificante</legend>
                    <!--!: Aquí se encontrara toda la información relevante para obtener un QR y generar el justificante-->
                    <label for = "codigoQR_Estudiante">Escanear_QR</label> <!--*: Aquí debería abrir la camara para escanear-->
                    <br><br>
                    <label for="idTramite">Tramite a realizar: </label>
                        <select name="idTramite" id="idTramite" required>
                            <option no value=""></option>
                            <option value="0005">Estancia I</option>
                            <option value="0006">Estancia II</option>
                            <option value="0007">Estadia</option>
                            <option value="0008">Practicas profesionales</option>
                            <option value="0009">Servicio sócial</option>
                        </select>
                    <br><br>
                    <label for="requisitos">Requisitos: </label>
                        <textarea rows="5" cols="10" placeholder="Requisitos o notas aquí, si no aplica dejar en blanco"></textarea>
                    <hr>
                    <input type="submit" value="Enviar_DocumentoAlumno_Vincu" name = "Enviar_DocumentoAlumno_Vincu" onclick="alert('Datos enviados con exito')">
                </fieldset>
            </form>
        </div>

        <div id = "revisarJustificante">
            <form action="">
                <fieldset>
                    <table></table>
                    <legend>Actualizar justificante</legend>
                    <!--!: Aquí se encontrara toda la información relevante para obtener un QR y generar el justificante-->
                    <label for = "codigoQR_Estudiante">Escanear_QR</label> <!--*: Aquí debería abrir la camara para escanear-->
                    <br><br>
                    <label for="idTramite">Tramite a realizar: </label>
                        <select name="idTramite" id="idTramite" required>
                            <option no value=""></option>
                            <option value="0011">Justificante</option>
                            <option value="0012">Recursamiento</option>
                        </select>
                    <br><br>
                    <label for="requisitos">Requisitos: </label>
                        <textarea rows="5" cols="10" placeholder="Requisitos o notas aquí, si no aplica dejar en blanco"></textarea>
                    <hr>
                    <input type="submit" value="Enviar_DocumentoAlumno_Vincu" name = "Enviar_DocumentoAlumno_Vincu" onclick="alert('Datos enviados con exito')">
                </fieldset>
            </form>
        </div>

        <div id = "eliminarJustificante">
            <form action="">
                <fieldset>
                    <table></table>
                    <legend>Eliminar justificante</legend>
                    <!--!: Aquí se encontrara toda la información relevante para obtener un QR y generar el justificante-->
                    <label for = "codigoQR_Estudiante">Escanear_QR</label> <!--*: Aquí debería abrir la camara para escanear-->
                    <br><br>
                    <label for="idTramite">Tramite a realizar: </label>
                        <select name="idTramite" id="idTramite" required>
                            <option no value=""></option>
                            <option value="0011">Justificante</option>
                            <option value="0012">Recursamiento</option>
                        </select>
                    <br><br>
                    <label for="requisitos">Requisitos: </label>
                        <textarea rows="5" cols="10" placeholder="Requisitos o notas aquí, si no aplica dejar en blanco"></textarea>
                    <hr>
                    <input type="submit" value="Enviar_DocumentoAlumno_Vincu" name = "Enviar_DocumentoAlumno_Vincu" onclick="alert('Datos enviados con exito')">
                </fieldset>
            </form>
        </div>

        <br>
        <footer class="FooterIndex1" id="FooterIndex1">
            <div class="footer__container">
                <div class="footer__info">
                <h3>IdentiQR</h3>
                <p>
                    ©2025 IdentiQR. Todos los derechos reservados.<br>
                    Diseñado por: Lizbeth B. y Alexis S.
                </p>
                </div>
                <div class="footer__links">
                <a href="mailto:IdentiQR.info@gmail.com">Contact Us</a>
                <a href="#Terms_Index1">Términos del servicio</a>
                </div>
                <div class="footer__terms" id="Terms_Index1">
                <p>
                    Toda información resguardada será de carácter relevante. 
                    No se podrá acceder a este sistema si no se cuenta con previo registro. 
                    Por ningún motivo el estudiante podrá acceder al sistema.
                </p>
                </div>
            </div>
        </footer>
    </body>
</html>