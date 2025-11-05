<!--
//Archivo que contiene la conexion a la BD
?
Creadores.
Barreto Basave Lizbeth
Sanchez Luna Alexis Sebastian
-->
<?php
    class Alumno
    {
        private string $matricula;
        private string $nombre;
        private string $apePat;
        private string $apeMat;
        private string $fechaNac;
        private string $feIngreso;
        private ?string $correo;
        private string $direccion;
        private string $telefono;
        private string $ciudad;
        private string $estado;
        private string $genero;
        private int $idCarrera;
        private ?string $qrHash;

        public function __construct(
            string $matricula,
            string $nombre,
            string $apePat,
            string $apeMat,
            string $fechaNac,
            string $feIngreso,
            ?string $correo,
            string $direccion,
            string $telefono,
            string $ciudad,
            string $estado,
            int $idCarrera,
            ?string $qrHash = null,
            string $genero = "Otro"
        ) {
            $this->matricula = $matricula;
            $this->nombre = $nombre;
            $this->apePat = $apePat;
            $this->apeMat = $apeMat;
            $this->fechaNac = $fechaNac;
            $this->feIngreso = $feIngreso;
            $this->correo = $correo;
            $this->direccion = $direccion;
            $this->telefono = $telefono;
            $this->ciudad = $ciudad;
            $this->estado = $estado;
            $this->genero = $genero;
            $this->idCarrera = $idCarrera;
            $this->qrHash = $qrHash;
        }

        // Getters y setters
        public function getMatricula(): string { return $this->matricula; }
        public function setMatricula(string $matricula): void { $this->matricula = $matricula; }

        public function getNombre(): string { return $this->nombre; }
        public function setNombre(string $nombre): void { $this->nombre = $nombre; }

        public function getApePat(): string { return $this->apePat; }
        public function setApePat(string $apePat): void { $this->apePat = $apePat; }

        public function getApeMat(): string { return $this->apeMat; }
        public function setApeMat(string $apeMat): void { $this->apeMat = $apeMat; }

        public function getFechaNac(): string { return $this->fechaNac; }
        public function setFechaNac(string $fechaNac): void { $this->fechaNac = $fechaNac; }

        public function getFeIngreso(): string { return $this->feIngreso; }
        public function setFeIngreso(string $feIngreso): void { $this->feIngreso = $feIngreso; }

        public function getCorreo(): ?string { return $this->correo; }
        public function setCorreo(?string $correo): void { $this->correo = $correo; }

        public function getDireccion(): string { return $this->direccion; }
        public function setDireccion(string $direccion): void { $this->direccion = $direccion; }

        public function getTelefono(): string { return $this->telefono; }
        public function setTelefono(string $telefono): void { $this->telefono = $telefono; }

        public function getCiudad(): string { return $this->ciudad; }
        public function setCiudad(string $ciudad): void { $this->ciudad = $ciudad; }

        public function getEstado(): string { return $this->estado; }
        public function setEstado(string $estado): void { $this->estado = $estado; }

        public function getGenero(): string { return $this->genero; }
        public function setGenero(string $genero): void { $this->genero = $genero; }

        public function getIdCarrera(): int { return $this->idCarrera; }
        public function setIdCarrera(int $idCarrera): void { $this->idCarrera = $idCarrera; }

        public function getQRHash(): ?string { return $this->qrHash; }
        public function setQRHash(?string $qrHash): void { $this->qrHash = $qrHash; }


        /*  METODO PARA RECUPERAR INFO - PRUEBA (2025-10-01 09:12pm) */
        public function recuperarDatosQR(): string {
            date_default_timezone_set('America/Mexico_City'); // Ajusta tu zona horaria
            return "Matricula: {$this->matricula}\n" .
                "Nombre: {$this->nombre} {$this->apePat} {$this->apeMat}\n" .
                "Carrera ID: {$this->idCarrera}\n" .
                "Correo: {$this->correo}\n-----------\n" .
                //"Teléfono: {$this->telefono}\n-----------\n" .
                "Expedicion QR: " . date("Y-m-d") . "\n";
        }

        /*METODO DE PUEDA PARA RECUPERAR LOS DATOS QR COMPLETOS. 2025-10-04 11:22pm */
        public function recuperarDatosCompletosQR(InformacionMedica $infoMedica): string {
            return "Matrícula: {$this->matricula}\n" .
                "Nombre: {$this->nombre} {$this->apePat} {$this->apeMat}\n" .
                "Fecha de Nacimiento: {$this->fechaNac}\n" .
                "Ingreso: {$this->feIngreso}\n" .
                "Correo: {$this->correo}\n" .
                "Teléfono: {$this->telefono}\n" .
                "Dirección: {$this->direccion}, {$this->ciudad}, {$this->estado}\n" .
                "Género: {$this->genero}\n" .
                "Carrera ID: {$this->idCarrera}\n" .
                "Tipo de Sangre: {$infoMedica->getTipoSangre()}\n" .
                "Alergias: {$infoMedica->getAlergias()}\n" .
                "Contacto de Emergencia: {$infoMedica->getContactoEmergencia()}". 
                "Expedición QR: {" . date("Y-m-d") . "\n}";
        }


    }
?>

<?php
    class InformacionMedica{
        private ?int $idInfoM;
        private string $Matricula; //Este sera nuestra Foreign Key
        private string $tipoSangre;
        private ?string $alergias;
        private ?string $contactoEmergencia;

        public function __construct(
            string $Matricula,
            string $tipoSangre = "O+",
            ?string $alergias = "Sin_Alergias",
            ?string $contactoEmergencia = null,
            ?int $idInfoM = null
        ) {
            $this->Matricula = $Matricula;
            $this->tipoSangre = $tipoSangre;
            $this->alergias = $alergias ?? "Sin_Alergias";
            $this->contactoEmergencia = $contactoEmergencia;
            $this->idInfoM = $idInfoM;
        }

        // Getters / setters
        public function getIdInfoM(): ?int { return $this->idInfoM; }
        public function getMatricula(): string { return $this->Matricula; }
        public function getTipoSangre(): string { return $this->tipoSangre; }
        public function getAlergias(): ?string { return $this->alergias; }
        public function getContactoEmergencia(): ?string { return $this->contactoEmergencia; }

        public function setTipoSangre(string $t): void { $this->tipoSangre = $t; }
        public function setAlergias(?string $a): void { $this->alergias = $a; }
        public function setContactoEmergencia(?string $c): void { $this->contactoEmergencia = $c; }
    }
?>