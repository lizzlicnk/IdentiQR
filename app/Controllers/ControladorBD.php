<?php
    require_once __DIR__ . '/../../config/Connection_BD.php';
    require_once __DIR__ . '/../../public/PHP/Alumno.php';
    require_once __DIR__ . '/../Models/ModeloAlumno.php';
    require_once __DIR__ . '/../../public/PHP/codigosQR.php';

    class ControllerBD{
        private $modelBD;

        public function __construct($conn){
            $this->modelDB = new BDModel($conn);
        }

    }

?>