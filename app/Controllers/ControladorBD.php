<?php
    require_once __DIR__ . '/../../config/Connection_BD.php';
    require_once __DIR__ . '/../Models/ModeloBD.php';

    class ControllerBD{
        private $modelBD;
        public function __construct($conn){
            $this->modelBD = new BDModel($conn);
        }

        /*FUNCIÓN PARA LA GENERACIÓN DEL BACKUP DE LA BASE DE DATOS */
        public function backupDBs(){

            //Validamos que se haya mandado
            //if(isset($_POST[''])){
            $backup = $this->modelBD->backupDBs();
            //}

            if($backup && file_exists($backup)){
                $nombreArch = basename($backup);
                header("Content-disposition: attachment; filename =".$nombreArch); //Vamos a crear un archivo NUEVO
                //Descargar el archivo y no ejecutarlo
                header("Content-type: MIME");
                //Leer el contenido del archivo y guardarlo
                readfile(__DIR__ . '/../../config/Backups/' . $nombreArch); //Busca el archivo dentro del directorio

                // Opcional: Eliminar archivo después de descargar para no llenar servidor
                // unlink($backup); 
                exit;
            }
        }
        /*FUNCIÓN PARA LA GENERACIÓN DEL RESTORE DE LA BASE DE DATOS */
        public function restoreDBs(){
            $statusAlert = null; // Variable para controlar la alerta en la vista
            /* NOTA. CONSIDERAR QUE EL Archivo cargado se solicitará */
            // Configuración
            $tamanoMaximoArch = 50 * 1024 * 1024; // 50 MB
            $uploadDir = realpath(__DIR__ . '/../../config/Uploads');
            // Si el directorio no existe, se crea
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            // 1. Validar que se haya subido un archivo sin errores
            if (!isset($_FILES['backupFile']) || $_FILES['backupFile']['error'] !== UPLOAD_ERR_OK) {
                $errorCodigo = $_FILES['backupFile']['error'] ?? 'desconocido';
                $statusAlert = 'restore_error::Error al subir archivo (Código ' . ($_FILES['backupFile']['error'] ?? 'desc') . ')';
                $this->cargarVista($statusAlert);
                return; // Detener ejecución
            }

            $file = $_FILES['backupFile'];
            $filename = basename($file['name']);
            $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION)); 
            
            // 2. Valida que la extensión sea .sql
            if ($ext !== 'sql') {
                $statusAlert = 'restore_error::Solo se permiten archivos .sql';
                $this->cargarVista($statusAlert);
                return;
            }

            // 3. Valida el tamaño (Max 50MB)
            if ($file['size'] > $tamanoMaximoArch) {
                $maxMB = $tamanoMaximoArch / 1024 / 1024;
                $statusAlert = 'restore_error::El archivo excede el límite de 50MB';
                $this->cargarVista($statusAlert);
                return;
            }

            //4. Mover archivo a la carpeta de uploads con nombre único
            $carpetaSistemaUpload = $uploadDir . '/' . uniqid('restore_', true) . '.sql';
            
            if (!move_uploaded_file($file['tmp_name'], $carpetaSistemaUpload)) {
                $statusAlert = 'restore_error::No se pudo guardar el archivo temporal';
                $this->cargarVista($statusAlert);
                return;
            }

            // 5. Llamar al modelo para realizar la restauración
            // IMPORTANTE: El modelo ahora devuelve TRUE (éxito) o un STRING (error)
            $restore = $this->modelBD->restoreDBs($carpetaSistemaUpload);

            // 6. Eliminar el archivo SQL temporal después de usarlo (Limpieza)
            if (file_exists($carpetaSistemaUpload)) {
                unlink($carpetaSistemaUpload);
            }

            // 7. Gestionar la respuesta
            if ($restore === true) {
                // ÉXITO: Redirigir a la vista principal o mostrar mensaje
                $statusAlert = 'restore_success';
            } else {
                // ERROR: Mostrar el mensaje detallado que vino del modelo
                // Escapamos comillas simples para que no rompa el JS alert
                //$errorMsg = addslashes($restore);
                $statusAlert = 'restore_error::' . $restore;
            }
            $this->cargarVista($statusAlert);
        }

        // Método auxiliar para cargar la vista y evitar repetir código
        private function cargarVista($statusAlert = null) {
            // Incluimos la vista principal del administrador
            include_once __DIR__ . '/../Views/GestionesAdministradorG.php';
        }

    }

?>