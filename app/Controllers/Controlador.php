<?php
    require_once  '../../config/Connection_BD.php';
    require_once __DIR__ . '/../Models/PHP/Alumno.php';
    
    class Controlador {
        private $conexion;
        private $db; //USARA mysqli

        public function __construct() {
            /*  Creación de la instanciación para la conexión */
            $this->conexionBD = new Connection_BD();
            $this->db = $this->conexionBD->getConnection(); #Obtiene la conexión
        }

        // Getter para la conexión de la base de datos - Puede quitarse
        public function getDB() {
            return $this->db;
        }

        /*  Metodos/Funciones para hacer la base de datos y conexión con el formulario */
        /*Dependiendo del rol en el que esta, lo redirigira al formulario o pagina acorde de las gestiones */
        public function loginUsuario(string $usr, string $pw): bool
        {
            $rol =  $this->conexionBD->loginUsuarioSP($usr, $pw);
            if(!$rol) {
                return false;
            }
            
            // Login exitoso, redirigir según el rol
            switch ($rol) {
                case 'Administrador':
                    header("Location: ../Views/GestionesAdministradorG.html");
                    exit();
                case 'Administrativo_Vinculacion':
                    header("Location: ../Views/GestionesAdmin_Vinculacion.html");
                    exit();
                case 'Administrativo_ServicioEsco':
                    header("Location: ../Views/GestionesAdmin_ServEsco.html");
                    exit();
                case 'Administrativo_DesaAca':
                    header("Location: ../Views/GestionesAdmin_DesAca.html");
                    exit();
                case 'Administrativo_DAE':
                    header("Location: ../Views/GestionesAdmin_DAE.html");
                    exit();
                case 'Administrativo_Direccion':
                    header("Location: ../Views/GestionesAdmin_Direccion.html");
                    exit();
                case 'Administrativo_Medico':
                    header("Location: ../Views/GestionesAdmin_Medico.html");
                    exit();
                default:
                    // Otro rol no permitido
                    echo "<p style='color:red'>Rol no permitido</p>";
            }
        }

        /* Metodo para hacer el registro de los Alumnos */
        public function registrarAlumno(Alumno $unAlumno): bool{
            //Codigo para hacer el registro del alumno
            $ingreso = $this->conexionBD->registrarAlumnoSP($unAlumno);
            return $ingreso;
        }
        public function asignarQRHash(Alumno $alumno): bool{
            $ingreso = $this->conexionBD->asignarHashQR($alumno);
            return $ingreso;
        }
        /* Metodo para incluir la información medica de un alumno, despues de registrar */
        public function registrarInfoMedica(InformacionMedica $unaInforMed): bool {

            $registroInfo = $this->conexionBD->registrarInfoMedAlumno($unaInforMed);
            return $registroInfo;
        }


        /* Metodo para hacer el registro de los Usuarios */
        public function registrarUsuario(Usuario $unUsuario): ?Usuario{
            //Codigo para hacer el registro del usuario
            $ingreso = $this->conexionBD->registrarUsuarioSP($unUsuario);
            return $ingreso;
        }

    }
?>