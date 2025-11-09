<?php
// restore.php
require_once '../../config/Connection_BD.php';

// Config
$maxFileSize = 50 * 1024 * 1024; // 50 MB
$uploadDir = __DIR__ . '/uploads';
if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);

// Validar que venga archivo
if (!isset($_FILES['backupFile']) || $_FILES['backupFile']['error'] !== UPLOAD_ERR_OK) {
    die("Error al subir el archivo. Código de error: " . ($_FILES['backupFile']['error'] ?? 'none'));
}

//mysql -u usuario -p -h 127.0.0.1 nombre_base_datos < ~/Downloads/backup20-9-22.sql

$file = $_FILES['backupFile'];
$filename = basename($file['name']);
$ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
if ($ext !== 'sql') {
    die("Solo se permiten archivos .sql");
}
if ($file['size'] > $maxFileSize) {
    die("Archivo demasiado grande. Máximo permitido: " . ($maxFileSize / 1024 / 1024) . " MB");
}

// Mover archivo a carpeta temporal
$targetPath = $uploadDir . '/' . uniqid('restore_', true) . '.sql';
if (!move_uploaded_file($file['tmp_name'], $targetPath)) {
    die("No se pudo guardar el archivo en el servidor.");
}

// Si el usuario pidió usar CLI y está disponible, puedes intentar Opción B (ver abajo)
$useCLI = isset($_POST['use_cli']) && $_POST['use_cli'] == '1';

// Obtener credenciales (usa tu Connection_BD o configura aquí)
$db = new Connection_BD();
$conn = $db->getConnection();
if (!$conn || $conn->connect_error) {
    die("Error en la conexión a BD: " . ($conn->connect_error ?? 'desconocido'));
}

// Opción A: ejecutar con mysqli->multi_query (ideal para archivos razonables)
if (!$useCLI) {
    // Leer el archivo SQL (ten cuidado con archivos enormes)
    $sql = file_get_contents($targetPath);
    if ($sql === false) {
        unlink($targetPath);
        die("No se pudo leer el archivo subido.");
    }

    // Desactivar checks FK temporalmente
    $conn->begin_transaction();
    try {
        $conn->query("SET FOREIGN_KEY_CHECKS=0;");
        // multi_query ejecuta múltiples sentencias separadas por ;
        if ($conn->multi_query($sql)) {
            // recorrer resultados (necesario para vaciar buffer)
            do {
                if ($res = $conn->store_result()) {
                    $res->free();
                }
            } while ($conn->more_results() && $conn->next_result());
            $conn->query("SET FOREIGN_KEY_CHECKS=1;");
            $conn->commit();
            unlink($targetPath);
            echo "Restauración completada correctamente.";
        } else {
            $err = $conn->error;
            $conn->rollback();
            unlink($targetPath);
            die("Error al ejecutar el SQL: " . $err);
        }
    } catch (Exception $e) {
        $conn->rollback();
        unlink($targetPath);
        die("Excepción durante la restauración: " . $e->getMessage());
    }
    $conn->close();
    exit;
}