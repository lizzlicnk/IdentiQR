<?php
    /*Realizamos la instancia del controlador */
    require_once __DIR__ . '/../../config/Connection_BD.php';
    require_once __DIR__ . '/../Models/ModeloDirecciones.php';
    require_once __DIR__ . '/../Models/ModeloAlumno.php';

    class DirectionsController{
        private $directionModel;
        private $alumnoModel;

        public function __construct($conn){
            $this->directionModel = new DireccionesModel($conn);
            $this->alumnoModel = new AlumnoModel($conn);
        }

        /*Funciones para la generación de los tramites. */
        //1. Función para ingresar dentro de TRAMITES
        public function registrarTramite(){
            //Validar que el botón fue enviado y tiene datos
            if(isset($_POST['registrarTramite_dirDirACA'])){
                $matricula = $_POST['matriculaEscaneadoBD']; // Aquí se escaneara

                $idTramite = (int)$_POST['idTramite'];
                
                $fechaJustificante = $_POST['fechaJustificante'];
                $requisitos = $_POST['Requisitos'];

                /*AQUÍ SE RECUPERARAN LOS DATOS DEL ALUMNO. */
                $resultDatos = $this->alumnoModel->recuperarDatosAlumnoPorMatricula($matricula);

                /*Hacemos la validación para recuperar los datos*/
                if($resultDatos){
                    $Nombre_AUX         = $resultDatos['Nombre'];
                    $ApePat_AUX         = $resultDatos['ApePat'];
                    $ApeMat_AUX         = $resultDatos['ApeMat'];
                    $FechaNac_AUX       = $resultDatos['FechaNac'];
                    $FeIngreso_AUX      = $resultDatos['FeIngreso'];
                    $Correo_AUX         = $resultDatos['Correo'];
                    $Direccion_AUX      = $resultDatos['Direccion'];
                    $Telefono_AUX       = $resultDatos['Telefono'];
                    $Ciudad_AUX         = $resultDatos['Ciudad'];
                    $Estado_AUX         = $resultDatos['Estado'];
                    $Genero_AUX         = $resultDatos['Genero'];
                    $idCarrera_AUX      = $resultDatos['idCarrera'];
                    $DescripcionCarrera_AUX = $resultDatos['descripcion']; // de tabla carrera
                    $PlanEstudios_AUX   = $resultDatos['planEstudios'];
                    $idDepto_AUX        = $resultDatos['idDepto'];         // de tabla carrera
                    $TipoSangre_AUX     = $resultDatos['TipoSangre'];
                    $Alergias_AUX       = $resultDatos['Alergias'];
                    $ContactoEmergencia_AUX = $resultDatos['contacto_emergencia'];
                    $FechaIngresoInfoMed_AUX = $resultDatos['fechaIngreso_InfoMed'];
                    $Cuatri_AUX          = $resultDatos['Cuatri'];          // función calcCuatrimestre()

                    //Concatenación de datos
                    $nombreCompleto = trim("$Nombre_AUX $ApePat_AUX $ApeMat_AUX");

                    //Validamos que tipo de servicio es
                    switch($idTramite){
                        case 11: 
                            $tram = "JUSTIFICANTE";
                            $fraseDia = "para el día";
                            break;
                        case 12:
                            $tram = "RECURSAMIENTO";
                            $fraseDia = "el día";
                            break;
                        default:
                            $tram = "JUSTIFICANTE";
                            $fraseDia = "para el día";
                            break;
                    }

                    // Generamos la descripción
                    $descripcionTotal = sprintf(
                        "El Alumno [%s] con matrícula [%s] del cuatrimestre [%s] de la carrera [%s] solicitó un <%s> %s [%s]. Requisitos o notas [$%s]",
                        $nombreCompleto,
                        $matricula,
                        $Cuatri_AUX,
                        $DescripcionCarrera_AUX,
                        $tram,
                        $fraseDia,
                        $fechaJustificante,
                        $requisitos
                    );
                    $insert = $this->directionModel -> registrarTramite($matricula, $idTramite, $descripcionTotal);
                    
                    if($insert){
                        //echo "<br>Registro exitoso";
                    } else {
                        //echo "<br>Error en el registro";
                    }
                } else {
                    echo "<br>Error: No se encontró el alumno con la matrícula proporcionada";
                }
            }
            
            //Incluimos la vista
            include_once(__DIR__ . '/../Views/dirDirAca/gestionJustificantes_Dir.php');
        }

        
        //2.0. Funcion para consultar TODOS LOS TRAMITES

        //2.1. Funcion para consultar TODOS LOS TRAMITES por DEPARTAMENTO
        public function consultarTramitesPorDEPTO(){
            $direccion = null; // default: null
            $idDepto = 2; // default: Dirección Académica
            
            if(isset($_POST['consultarTramite_Depto'])){
                // Obtener idDepto del POST o usar el valor por defecto
                $idDepto = isset($_POST['idDepto']) ? (int)$_POST['idDepto'] : 2;
                
                // Llamada al modelo (devuelve mysqli_result)
                $direccion = $this->directionModel->consultarTramitesPorDepto($idDepto);
            }

            //Evaluamos que tipo de direccion es para Incluirlo
            switch($idDepto){
                case 2:
                    include_once(__DIR__ . '/../Views/dirDirAca/gestionJustificantes_Dir.php');
                    break;
                default:
                    include_once(__DIR__ . '/../Views/dirDirAca/gestionJustificantes_Dir.php');
                    break;
            }
        }
        //2.2 Funcion para consultar TODOS los TRAMITES ESPECIFICOS DE ALGÚN TIPO.
        public function consultarPorTipoTramite(){
            $direccion = null; // default: null
            $idTramite = null;
            $idDepto = null;
            
            if(isset($_POST['consultarTramite_idTramite'])){
                $idTramite = (int)$_POST['idTramite'];
                $idDepto = isset($_POST['idDepto']) ? (int)$_POST['idDepto'] : 2;

                // Llamada al modelo (devuelve mysqli_result)
                $direccion = $this->directionModel->consultarPorTipoTramite($idTramite);
            }

            //Evaluamos que tipo de direccion es para Incluirlo
            switch($idDepto){
                case 2:
                    include_once(__DIR__ . '/../Views/dirDirAca/gestionJustificantes_Dir.php');
                    break;
                default:
                    include_once(__DIR__ . '/../Views/dirDirAca/GestionesAdmin_Direccion.php'); //Vista de justificantes
                    break;
            }
        }
        
        //2.3 Función para consultar TODOS los TRAMITES realizados por algún alumno (por Matrícula)
        public function consultarPorMatricula(){
            $direccion = null; // default: null
            $matricula = null;
            $idDepto = null;
            
            if(isset($_POST['consultarTramite_Matricula'])){
                $matricula = $_POST['Matricula'];
                $idDepto = isset($_POST['idDepto']) ? (int)$_POST['idDepto'] : 2;

                // Llamada al modelo (devuelve mysqli_result)
                $direccion = $this->directionModel->consultarTramitesPorMatricula($matricula);
            }

            //Evaluamos que tipo de direccion es para Incluirlo
            switch($idDepto){
                case 2:
                    include_once(__DIR__ . '/../Views/dirDirAca/gestionJustificantes_Dir.php');
                    break;
                default:
                    include_once(__DIR__ . '/../Views/dirDirAca/GestionesAdmin_Direccion.php'); //Vista de justificantes
                    break;
            }
        }
        
        //2.4 Función para consultar TRAMITES por Folio
        public function consultarPorFolio(){
            $direccion = null; // default: null
            $folio = null;
            $idDepto = null;
            
            if(isset($_POST['consultarTramite_Folio'])){
                $folio = $_POST['FolioRegistro'];
                $idDepto = isset($_POST['idDepto']) ? (int)$_POST['idDepto'] : 2;

                // Llamada al modelo (devuelve mysqli_result)
                $direccion = $this->directionModel->consultarTramitePorFolio($folio);
            }

            //Evaluamos que tipo de direccion es para Incluirlo
            switch($idDepto){
                case 2:
                    include_once(__DIR__ . '/../Views/dirDirAca/gestionJustificantes_Dir.php');
                    break;
                default:
                    include_once(__DIR__ . '/../Views/dirDirAca/GestionesAdmin_Direccion.php'); //Vista de justificantes
                    break;
            }
        }

        /*Funcion para realizar la actualización de datos dentro del Tramite*/
        public function actualizarTramite(){
            $row = null;
            if(isset($_GET['Folio'])){
                $FolioRegistro = $_GET['Folio'];
                $idDepto = isset($_GET['idDepto']) ? (int)$_GET['idDepto'] : 2;

                //Llamar al metodo del modelo para hacer la consulta
                $result = $this->directionModel->consultarTramitePorFolio($FolioRegistro);
                
                // Obtener el primer registro del resultado
                if($result && $result->num_rows > 0){
                    $row = $result->fetch_assoc();
                }
                
                //Evaluamos que tipo de direccion es para Incluirlo
                switch($idDepto){
                    case 2:
                        include_once(__DIR__ . '/../Views/dirDirAca/modificacionTramite.php');
                        break;
                    default:
                        include_once(__DIR__ . '/../Views/dirDirAca/GestionesAdmin_Direccion.php'); //Vista de justificantes
                        break;
                }
                return;
            }
            //ENVIAR INFO
            if(isset($_POST['actualizarTramite_Tramite'])){
                $FolioRegistro = $_POST['FolioRegistro'];
                $FolioSeguimiento = $_POST['FolioSeguimiento'];
                $Descripcion = $_POST['Descripcion'];
                $estatusT = $_POST['estatusT'];    

                $update = $this -> directionModel -> actualizarTramite($Descripcion, $estatusT, $FolioRegistro, $FolioSeguimiento);
                if($update){
                    /*switch($idDepto){
                    case 2:
                        include_once(__DIR__ . '/../Views/dirDirAca/modificacionTramite.php');
                        break;
                    default:
                        include_once(__DIR__ . '/../Views/dirDirAca/GestionesAdmin_Direccion.php'); //Vista de justificantes
                        break;
                    }*/
                    header("Location: /IdentiQR/app/Views/dirDirAca/GestionesAdmin_Direccion.php?action=consult");
                } else {
                    header("Location: /IdentiQR/app/Views/dirDirAca/GestionesAdmin_Direccion.php?action=update");
                }
            }
            include_once(__DIR__ . '/../Views/dirDirAca/modificacionTramite.php');
        }

        public function actualizarTramiteManual(){
            $row = null;
            if(isset($_POST['Actualizar_Tramite'])){
                $FolioRegistro = trim($_POST['FolioAct']);
                $idDepto = isset($_GET['idDepto']) ? (int)$_GET['idDepto'] : 2;

                //Llamar al metodo del modelo para hacer la consulta
                $result = $this->directionModel->consultarTramitePorFolio($FolioRegistro);
                
                // Obtener el primer registro del resultado
                if($result && $result->num_rows > 0){
                    $row = $result->fetch_assoc();
                }
                
                //Evaluamos que tipo de direccion es para Incluirlo
                switch($idDepto){
                    case 2:
                        include_once(__DIR__ . '/../Views/dirDirAca/modificacionTramite.php');
                        break;
                    default:
                        include_once(__DIR__ . '/../Views/dirDirAca/GestionesAdmin_Direccion.php'); //Vista de justificantes
                        break;
                }
                return;
            }
            //ENVIAR INFO
            if(isset($_POST['actualizarTramite_Tramite'])){
                $FolioRegistro = $_POST['FolioRegistro'];
                $FolioSeguimiento = $_POST['FolioSeguimiento'];
                $Descripcion = $_POST['Descripcion'];
                $estatusT = $_POST['estatusT'];    

                $update = $this -> directionModel -> actualizarTramite($Descripcion, $estatusT, $FolioRegistro, $FolioSeguimiento);
                if($update){
                    /*switch($idDepto){
                    case 2:
                        include_once(__DIR__ . '/../Views/dirDirAca/modificacionTramite.php');
                        break;
                    default:
                        include_once(__DIR__ . '/../Views/dirDirAca/GestionesAdmin_Direccion.php'); //Vista de justificantes
                        break;
                    }*/
                    header("Location: /IdentiQR/app/Views/dirDirAca/GestionesAdmin_Direccion.php?action=consult");
                } else {
                    header("Location: /IdentiQR/app/Views/dirDirAca/GestionesAdmin_Direccion.php?action=update");
                }
            }
            include_once(__DIR__ . '/../Views/dirDirAca/modificacionTramite.php');
        }

        /*Funciones para realizar la baja de los servicios/tramites */
        //1. Baja por FolioRegistro (desde la tabla)
        public function bajaTramiteFR(){
            if(isset($_GET['Folio'])){
                $FolioRegistro = $_GET['Folio']; // Mantener como string para preservar los ceros
                $idDepto = isset($_GET['idDepto']) ? (int)$_GET['idDepto'] : 2;

                // Llamar al modelo para eliminar
                $eliminado = $this->directionModel->cancelarTramiteFR($FolioRegistro);
                
                // Incluir la vista primero
                $direccion = $this->directionModel->consultarTramitesPorDepto($idDepto);
                include_once(__DIR__ . '/../Views/dirDirAca/gestionJustificantes_Dir.php');
                
                // Mostrar mensaje después de cargar la vista
                if($eliminado > 0){
                    echo "<script>
                        Swal.fire({
                            title: 'Eliminado',
                            text: 'Se eliminó correctamente el Trámite con Folio de Registro: " . $FolioRegistro . "',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                    </script>";
                } else {
                    echo "<script>
                        Swal.fire({
                            title: 'Error',
                            text: 'No se pudo eliminar el trámite con Folio: " . $FolioRegistro . "',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    </script>";
                }
            }
        }

        //2. Baja por FolioSeguimiento (desde el formulario)
        public function bajaTramiteFS(){
            $eliminado = 0;
            
            if(isset($_POST['BajaServicio_Tramite']) || (isset($_POST['accionEliminar']) && $_POST['accionEliminar'] === 'eliminarTramite')){
                $FolioSeguimiento = $_POST['FolioSeguimiento'];
                $idDepto = isset($_POST['idDepto']) ? (int)$_POST['idDepto'] : 2;

                // Llamar al modelo para eliminar
                $eliminado = $this->directionModel->cancelarTramiteFS($FolioSeguimiento);
            }
            
            // Incluir la vista con el resultado
            include_once(__DIR__ . '/../Views/dirDirAca/gestionJustificantes_Dir.php');
            
            // Mostrar mensaje después de cargar la vista
            if($eliminado > 0){
                echo "<script>
                    Swal.fire({
                        title: 'Eliminado',
                        text: 'El trámite ha sido eliminado exitosamente',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(function() {
                        window.location.href = '/IdentiQR/app/Views/dirDirAca/GestionesAdmin_Direccion.php?action=consult';
                    });
                </script>";
            } elseif(isset($_POST['BajaServicio_Tramite']) || isset($_POST['accionEliminar'])){
                echo "<script>
                    Swal.fire({
                        title: 'Error',
                        text: 'No se pudo eliminar el trámite',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                </script>";
            }
        }
    }
?>
