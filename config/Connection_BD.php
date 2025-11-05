<?php
    /*  Clase para la conexión a la base de datos - Usando mysqli y POO */
    //require_once 'Alumno.php';
    $host="localhost";
    $user="root";
    $pw="";
    $bd="IdentiQR";

    //GENERAMOS LA CONEXION CON EL SERVIDOR
    $conn= new mysqli($host,$user,$pw,$bd);
    if(!$conn){
        die("Error en la conexion: ".mysqli_connect_error());
    } else{ 
        //echo "Conexion exitosa"; //Este se tendría que quitar
    }
    class Connection_BD {
        /* Atributos que posee la clase */
        private $conn; //Variable para la conexion
        public function __construct(){
            $this->conn = $this->conn();
        }
        
        private function conn()
        {
            try{
                $host="localhost";
                $user="root";
                $pw="";
                $bd="IdentiQR";

                //GENERAMOS LA CONEXION CON EL SERVIDOR
                $conectar= new mysqli($host,$user,$pw,$bd);
                if(!$conectar){
                    die("Error en la conexion: ".mysqli_connect_error());
                } else{ 
                    //echo "Conexion exitosa"; //Este se tendría que quitar
                }
            }catch(Exception $e){
                echo "Error en la conexion: ".$e->getMessage();
            }
            return $conectar;
        }

        public function getConnection()
        {
            return $this->conn;
        }

        /*  Funciones o metodos para hacer los manejos e inserciones */
        /**
         * loginUsuario
         * - Recibe $usr y $pw (los argumentos que desea el controlador)
         * - Ejecuta la consulta preparada, obtiene el hash y verifica con password_verify
         * - Retorna true si el login es correcto, false en cualquier otro caso
         */
        /*string|bool: Retorna el rol como string si login correcto, y false si falla. */
        public function loginUsuarioSP(string $usr, string $pw): string|bool
        {
            //Codigo para hacer el login
            $sql = "call Login(?, ?)";
            $stmt = $this->conn->prepare($sql);
            if (!$stmt) {
                echo("Connection_BD->loginUsuario prepare error: " . $this->conn->error);
                return false;
            }

            $stmt->bind_param("ss", $usr, $pw);
            if (!$stmt->execute()) {
                echo("Connection_BD->loginUsuario execute error: " . $stmt->error);
                return false;
            }

            $res = $stmt->get_result();
            if ($res && $row = $res->fetch_assoc()) {
                $stmt->close();
                // Devuelve el rol del usuario
                return $row['rol']; 
            }

            $stmt->close();
            return false;
        }

        /* Otro metodo para poder registrar alumnos o dar de alta */
        public function registrarAlumnoSP(Alumno $unAlumno): bool
        {
            //Codigo para hacer el registro de alumnos
            $sql_statement = "INSERT INTO Alumno (Matricula, Nombre, ApePat, ApeMat, FechaNac, FeIngreso, Correo, Direccion, Telefono, Ciudad, Estado, Genero, idCarrera)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"; // Aquí iría la llamada al procedimiento almacenado para registrar alumno 
            
            $stmt = $this->conn->prepare($sql_statement   );
            if (!$stmt) {
                echo("Connection_BD->registrarAlumno prepare error: " . $this->conn->error);
                return false;
            }


            /*2025-09-23. NOTA: La parte de aca abajo, char me ayudo a solucionar*/
            // --- IMPORTANTE: bind_param necesita VARIABLES (pasadas por referencia).
            // Desreferenciamos y lo guardamos en Variables locales
            $matricula = $unAlumno->getMatricula();
            $nombre = $unAlumno->getNombre();
            $ApePat = $unAlumno->getApePat();
            $ApeMat = $unAlumno->getApeMat();
            $FechaNac = $unAlumno->getFechaNac();
            $FeIngreso = $unAlumno->getFeIngreso();
            $correo = $unAlumno->getCorreo();
            $direccion = $unAlumno->getDireccion();
            $telefono = $unAlumno->getTelefono();
            $ciudad = $unAlumno->getCiudad();
            $estado = $unAlumno->getEstado();
            $genero = $unAlumno->getGenero();
            $idCarrera = (int)($unAlumno->getIdCarrera());

            // Ahora sí, bind_param con las variables locales:
            $stmt->bind_param("ssssssssssssi", 
                $matricula,
                $nombre,
                $ApePat,
                $ApeMat,
                $FechaNac,
                $FeIngreso,
                $correo,
                $direccion,
                $telefono,
                $ciudad,
                $estado,
                $genero,
                $idCarrera
            );
            
            if (!$stmt->execute()) {
                echo("Connection_BD->registrarAlumno execute error: " . $stmt->error);
                return false;
            }
            $stmt->close();

            return true;
        }
        public function asignarHashQR(Alumno $alumno): bool {
            /*Hacemos la variable que contendra el query sql*/ 
            $matricula = $alumno->getMatricula();
            $hash = $alumno->getQrHash();
            $sql = "update Alumno set qrHash = ? where Matricula = ?";
            $stmt = $this->conn->prepare($sql);
            if (!$stmt) {
                echo("Connection_BD->asignarHashQR prepare error: " . $this->conn->error);
                return false;
            }

            // Ahora sí, bind_param con las variables locales:
            $stmt->bind_param("ss", $hash,$matricula);
            
            if (!$stmt->execute()) {
                echo("Connection_BD->asignarQRHash execute error: " . $stmt->error);
                $stmt->close();
                return false;
            }
            $stmt->close();

            return true;
            //$this->conn->close(); //Cierra la conexion a la base de datos
            //return true;
        }

        public function registrarInfoMedAlumno(InformacionMedica $unaInforMed): bool 
        {
            /*Realizamos la recuperación de los objetos para mandar la información*/
            $matriculaID = $unaInforMed->getMatricula();
            $tipoSangre = $unaInforMed->getTipoSangre();
            $alergias = $unaInforMed->getAlergias();
            $numContacto = $unaInforMed->getContactoEmergencia();
            /*Hacemos la variable que contendra el query sql*/ 
            $sql = "INSERT INTO InformacionMedica(idInfoM,Matricula,TipoSangre,Alergias,contacto_emergencia) values (null,'$matriculaID','$tipoSangre','$alergias','$numContacto')";
            if($this->conn->query($sql) === TRUE){
                //echo "Nuevo registro creado correctamente";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
                return false;
            }

            //$this->conn->close(); //Cierra la conexion a la base de  - SE ENCUENTRA COMENTADA PORQUE NO LA ESTOY CERRANDO MIENTRAS (NOTA.- MODIFICAR)
            return true;
        }
        /* Metodo para hacer el registro de los Usuarios */
        public function registrarUsuarioSP(Usuario $unUsuario): ?Usuario
        {
            //Codigo para hacer el registro del usuario
            $sql = "INSERT INTO Usuario (nombre, apellido_paterno, apellido_materno, usr, email, passw, rol, idDepto)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)"; // Aquí iría la llamada al procedimiento almacenado para registrar usuario 
            
            $stmt = $this->conn->prepare($sql);
            if (!$stmt) {
                echo("Error al conectar con la BD: " . $this->conn->error);
                return false;
            }

            /*2025-09-25. NOTA: La parte de aca abajo obtiene mediante los getter los valores que tiene*/
            // --- IMPORTANTE: bind_param necesita VARIABLES (pasadas por referencia).
            // Desreferenciamos y lo guardamos en Variables locales
            $nombre = $unUsuario->getNombre();
            $apellido_paterno = $unUsuario->getApellidoPaterno();
            $apellido_materno = $unUsuario->getApellidoMaterno();
            $usr = $unUsuario->getUsr();
            $email = $unUsuario->getEmail();
            $passw = $unUsuario->getPassw();
            $rol = $unUsuario->getRol();
            $idDepto = (int)($unUsuario->getIdDepto());

            $stmt->bind_param("sssssssi", 
                $nombre,
                $apellido_paterno,
                $apellido_materno,
                $usr,
                $email,
                $passw,
                $rol,
                $idDepto
            );
            
            if (!$stmt->execute()) {
                echo("Error al registrar: " . $stmt->error);
                return false;
            }

            /*NOTA. 2025-09-25 || Aquí CHAT ayudo para recuperar el usuario que se creo */
            // Obtener el id insertado usando la conexión (disponible aquí)
            $lastId = $this->conn->insert_id;
            $stmt->close();

            // Recuperar la fila completa insertada — trigger BEFORE INSERT ya ajustó usr y FechaRegistro
            $select = "SELECT * FROM Usuario WHERE id_usuario = ?";
            $stmt2 = $this->conn->prepare($select);
            if (!$stmt2){
                die("Prepare select error: " . $this->conn->error);
            }
            $stmt2->bind_param("i", $lastId);
            if (!$stmt2->execute()){
                die("Execute select error: " . $stmt2->error);
            }
            $res = $stmt2->get_result();
            if ($row = $res->fetch_assoc()) {
                // Actualizamos el objeto Usuario con los valores reales de la BD
                $unUsuario->setIdUsuario((int)$row['id_usuario']);
                $unUsuario->setUsr($row['usr']);
                $unUsuario->setFechaRegistro($row['FechaRegistro']);
                $unUsuario->setPassw($row['passw']); // Limpiamos la contraseña por seguridad y la encriptamos 
                // (Opcional) actualizar otros campos si quieres sincronizar todo
            } else {
                echo "No se pudo recuperar el usuario insertado.";
            }
            $stmt2->close();
            return $unUsuario;
        }

        
    }
?>
