
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
        <h2>Gestión de documentos de alumnos - Médico</h2>
        <div id = "generarCitaMedica">
            <form action="">
                <fieldset>
                    <legend>Generar cita medica</legend>
                    <!--!: Aquí se encontrara toda la información relevante para obtener un QR y generar la información del extracurricular -->
                    <label for = "codigoQR_Estudiante">Escanear_QR</label> <!--*: Aquí debería abrir la camara para escanear-->
                    <br><br>
                    <label for="idTramite">Tramite a realizar: </label>
                        <select name="idTramite" id="idTramite" required>
                            <option no value="" disabled="disabled" selected>Seleccione</option>
                            <option value="0013">Consulta médica</option>
                        </select>
                    <br>
                    <hr>
                    <!-- Datos médicos adicionales -->
                    <label for="temperatura">Temperatura (°C): </label>
                        <input type="number" step="0.1" id="temperatura" name="temperatura" requiered>
                    <br><br>

                    <label for="altura">Altura (cm): </label>
                        <input type="number" step="0.1" id="altura" name="altura" requiered>
                    <br><br>

                    <label for="peso">Peso (kg): </label>
                    <input type="number" step="0.1" id="peso" name="peso" requiered>
                    <br><br>

                    <label for="descripcion">Descripción adicional: </label><br>
                    <textarea id="descripcion" name="descripcion" rows="3" cols="40"
                            placeholder="Observaciones médicas..."></textarea>
                    <br>
                    <hr>
                    
                    <!--*: Cuando se registre, en el descripción se incluira: "Realizo una cita en el departamento de Medicina para ......"-->
                    <input type="submit" value="Registrar cita" name = "Enviar_DocumentoAlumno_Medicina" onclick="alert('Datos enviados con exito')">
                </fieldset>
            </form>
        </div>

        <div id = "consultarCitaMedica">
            <form action="">
                <fieldset>
                    <legend>Revisar y actualizar citas con el medico</legend>
                    <!--!: Aquí se encontrara toda la información relevante para obtener un QR y generar el justificante-->
                    <label for = "codigoQR_Estudiante">Escanear_QR</label> <!--*: Aquí debería abrir la camara para escanear-->
                    <table id = "citaTramite">
                        <th>Folio de registro </th>
                        <th>Tramite realizado </th>
                        <th>Fecha y hora </th>
                        <th>Descripción </th>
                        <th>Estatus </th>
                        <th>Matricula </th>
                        <!--*: TODOS ESTOS DATOS SE DEBERAN LLENAR ACORDE A LOS DATOS QUE SE TIENEN--> 
                        <!-- Aquí se llenarán los datos dinámicamente -->
                    </table>
                    <br><br>

                    <!-- Checkbox: si quieres forzar que el usuario marque para editar -->
                    <label for="actualizarCita">¿Desea actualizar esta cita?</label>
                    <input type="checkbox" id="actualizarCita">

                    <hr>

                    <!-- FORMULARIO DE EDICION (oculto por defecto). Se envía por POST a tu controlador -->
                    <form id="frmEditarCita" action="/ruta/a/tu/controlador_medico.php" method="POST" style="display:none; margin-top:10px;">
                        <!-- Hidden: datos necesarios para identificar registro -->
                        <input type="hidden" name="FolioRegistro" id="FolioRegistro" value="">
                        <input type="hidden" name="Matricula" id="Matricula" value="">
                        <input type="hidden" name="idTramite" id="idTramite" value="0013">

                        <label for="temperatura">Temperatura (°C): </label>
                        <input type="number" step="0.1" id="temperatura" name="temperatura" required>
                        <br><br>

                        <label for="altura">Altura (cm): </label>
                        <input type="number" step="0.1" id="altura" name="altura" required>
                        <br><br>

                        <label for="peso">Peso (kg): </label>
                        <input type="number" step="0.1" id="peso" name="peso" required>
                        <br><br>

                        <label for="presion">Presión arterial (mmHg): </label>
                        <input type="text" id="presion" name="presion" placeholder="Ej: 120/80">
                        <br><br>

                        <label for="descripcion_med">Observaciones / descripción: </label><br>
                        <textarea id="descripcion_med" name="descripcion_med" rows="3" cols="60" placeholder="Observaciones médicas..."></textarea>
                        <br><br>

                        <!-- botón de actualización -->
                        <button type="submit" name="Actualizar_CitaMedica">Actualizar cita</button>
                    </form>

                </fieldset>
            </form>
        </div>
        <!--!: Considerar que todo lo que se encuentra abajo no es tan valido.
                NOTA.- 2025-10-05 @BBLO230123 (MODIFICAR)-->
        <script>
        // Referencias
        const tabla = document.getElementById('tablaCitas');
        const actualizarCheckbox = document.getElementById('actualizarCita');
        const frmEditar = document.getElementById('frmEditarCita');

        // Inputs del formulario de edición
        const inputFolio = document.getElementById('FolioRegistro');
        const inputMatricula = document.getElementById('Matricula');
        const inputTemperatura = document.getElementById('temperatura');
        const inputAltura = document.getElementById('altura');
        const inputPeso = document.getElementById('peso');
        const inputPresion = document.getElementById('presion');
        const inputDescripcion = document.getElementById('descripcion_med');
        const inputIdTramite = document.getElementById('idTramite');

        let filaSeleccionada = null;

        // Mostrar/ocultar edición al marcar el checkbox (solo si hay fila seleccionada)
        actualizarCheckbox.addEventListener('change', () => {
            if (actualizarCheckbox.checked) {
            if (!filaSeleccionada) {
                alert('Seleccione primero una fila en la tabla para editar.');
                actualizarCheckbox.checked = false;
                return;
            }
            frmEditar.style.display = 'block';
            } else {
            frmEditar.style.display = 'none';
            }
        });

        // Al hacer clic en cualquier fila la marcamos y cargamos datos en el formulario (pero sin mostrarlo hasta que marquen el checkbox)
        tabla.querySelectorAll('tbody tr').forEach(tr => {
            tr.addEventListener('click', () => {
            // estilo visual para la fila seleccionada
            if (filaSeleccionada) filaSeleccionada.classList.remove('fila-seleccionada');
            tr.classList.add('fila-seleccionada');
            filaSeleccionada = tr;

            // leer atributos data-*
            const folio = tr.dataset.folio || '';
            const idtramite = tr.dataset.idtramite || '';
            const fechahora = tr.dataset.fechahora || '';
            const requisitos = tr.dataset.requisitos || '';
            const matricula = tr.dataset.matricula || '';

            // llenar campos ocultos e inputs
            inputFolio.value = folio;
            inputMatricula.value = matricula;
            inputIdTramite.value = idtramite || '0013';

            // Si requisitos está en formato clave:valor; separarlo (ejemplo simple)
            // Esperamos formato: "Temperatura:37.2;Altura:170;Peso:70;Presion:120/80;Obs:Comentario"
            const parts = requisitos.split(';').reduce((acc, part) => {
                const [k, ...v] = part.split(':');
                if (k) acc[k.trim().toLowerCase()] = v.join(':').trim();
                return acc;
            }, {});

            inputTemperatura.value = parts['temperatura'] || '';
            inputAltura.value = parts['altura'] || '';
            inputPeso.value = parts['peso'] || '';
            inputPresion.value = parts['presion'] || '';
            inputDescripcion.value = parts['obs'] || '';
            
            // Si el checkbox ya estaba marcado, mostramos el formulario inmediatamente
            if (actualizarCheckbox.checked) frmEditar.style.display = 'block';
            });
        });
        </script>
        <!--!: Considerar que todo lo que se encuentra arriba no es tan valido. NOTA.- 2025-10-05 @BBLO230123 (MODIFICAR)-->

        <div id = "bajaCitaMedica">
            <form action="">
                <fieldset>
                    <legend>Cancelar cita medica:        </legend>
                    <!--!: Aquí se encontrara toda la información relevante para obtener un QR y generar el justificante-->
                    <label for = "codigoQR_Estudiante">Escanear_QR</label> <!--*: Aquí debería abrir la camara para escanear-->
                               <form action="">
                <fieldset>
                    <legend>Revisar y actualizar citas con el medico</legend>
                    <!--!: Aquí se encontrara toda la información relevante para obtener un QR y generar el justificante-->
                    <label for = "codigoQR_Estudiante">Escanear_QR</label> <!--*: Aquí debería abrir la camara para escanear-->
                    <table id = "citaTramite" border="1">
                        <th>Folio de registro </th>
                        <th>Tramite realizado </th>
                        <th>Fecha y hora </th>
                        <th>Descripción </th>
                        <th>Estatus </th>
                        <th>Matricula </th>
                        <!--*: TODOS ESTOS DATOS SE DEBERAN LLENAR ACORDE A LOS DATOS QUE SE TIENEN--> 
                        <!-- Aquí se llenarán los datos dinámicamente -->
                    </table>
                    <br><br>

                    <!-- Checkbox: si quieres forzar que el usuario marque para editar -->
                    <label for="bajaCita">¿Desea dar de baja esta cita?</label>
                    <input type="checkbox" id="bajaCita">

                    <label for="folioRegistro_CitaMed">Folio de registro de la cita: </label>
                        <input type="text" name="folioRegistro_CitaMed" id="folioRegistro_CitaMed">
                    <hr>
                        <input type="submit" value="Baja_CitaMed_Alumno" name = "Baja_CitaMed_Alumno" onclick="alert('Datos eliminados con exito')">
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