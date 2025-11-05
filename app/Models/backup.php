<?php
// backup.php — exporta la BD a un .sql (o .txt) usando mysqli y tu Connection_BD

require_once '../../config/Connection_BD.php';
//https://www.forosdelweb.com/f18/como-hacer-respaldo-base-datos-mysql-mediante-php-formlulario-931385/ . LINK DE DONDE SAQUE EL CODIGOs

// Opciones
$nombre = "Backup_IdentiQR.sql"; // archivo a generar
$drop = false;                   // si true incluye DROP TABLE IF EXISTS
$tablas = false;                 // false = todas las tablas
$compresion = false;             // "gz", "bz2" o false

// Obtener conexión desde tu clase
$db = new Connection_BD();
$conn = $db->getConnection();
if (!$conn || $conn->connect_error) {
    die("Error en la conexión: " . ($conn->connect_error ?? 'desconocido'));
}

// Obtener nombre de la base (si no lo tienes)
$bdRow = $conn->query("SELECT DATABASE() AS db");
$bd = ($bdRow && $r = $bdRow->fetch_assoc()) ? $r['db'] : 'unknown';

// Obtener lista de tablas
if (empty($tablas)) {
    $tablas = [];
    $res = $conn->query("SHOW TABLES");
    if (!$res) {
        die("Error al obtener tablas: " . $conn->error);
    }
    while ($row = $res->fetch_row()) {
        $tablas[] = $row[0];
    }
}

// Cabecera del dump
$info['dumpversion'] = "1.1b";
$info['fecha'] = date("d-m-Y");
$info['hora'] = date("h:i:s A");
$info['mysqlver'] = $conn->server_info;
$info['phpver'] = phpversion();

// Representación breve de tablas
$info['tablas'] = implode(";  ", $tablas);

$dump = <<<EOT
# +===================================================================
# |
# | Generado el {$info['fecha']} a las {$info['hora']}
# | Servidor: {$_SERVER['HTTP_HOST']}
# | MySQL Version: {$info['mysqlver']}
# | PHP Version: {$info['phpver']}
# | Base de datos: '{$bd}'
# | Tablas: {$info['tablas']}
# |
# +-------------------------------------------------------------------
EOT;
$dump .= "\n\nSET FOREIGN_KEY_CHECKS=0;\n\n";

foreach ($tablas as $tabla) {
    // DROP TABLE
    if ($drop) {
        $drop_table_query = "DROP TABLE IF EXISTS `{$tabla}`;\n";
    } else {
        $drop_table_query = "# DROP TABLE not specified.\n";
    }

    // CREATE TABLE
    $create_table_query = "";
    $resCreate = $conn->query("SHOW CREATE TABLE `{$tabla}`");
    if ($resCreate && $r = $resCreate->fetch_row()) {
        $create_table_query = $r[1] . ";\n";
    } else {
        $create_table_query = "# Error obteniendo estructura: " . $conn->error . "\n";
    }

    // INSERTs
    $insert_into_query = "";
    $resData = $conn->query("SELECT * FROM `{$tabla}`");
    if ($resData) {
        while ($fila = $resData->fetch_assoc()) {
            $values = [];
            foreach ($fila as $val) {
                if (is_null($val)) {
                    $values[] = "NULL";
                } else {
                    // Escapamos y envolvemos en comillas simples
                    $values[] = "'" . $conn->real_escape_string($val) . "'";
                }
            }
            $insert_into_query .= "INSERT INTO `{$tabla}` VALUES (" . implode(", ", $values) . ");\n";
        }
    } else {
        $insert_into_query = "# Error obteniendo datos: " . $conn->error . "\n";
    }

    $dump .= "\n# | Vaciado de tabla '{$tabla}'\n";
    $dump .= "# +------------------------------------->\n";
    $dump .= $drop_table_query . "\n";
    $dump .= "# | Estructura de la tabla '{$tabla}'\n";
    $dump .= "# +------------------------------------->\n";
    $dump .= $create_table_query . "\n";
    $dump .= "# | Carga de datos de la tabla '{$tabla}'\n";
    $dump .= "# +------------------------------------->\n";
    $dump .= $insert_into_query . "\n";
}

$dump .= "\nSET FOREIGN_KEY_CHECKS=1;\n";

// Envío al navegador (download) o imprimir si headers ya enviados
if (!headers_sent()) {
    header("Pragma: no-cache");
    header("Expires: 0");
    header("Content-Transfer-Encoding: binary");
    switch ($compresion) {
        case "gz":
            header("Content-Disposition: attachment; filename={$nombre}.gz");
            header("Content-type: application/x-gzip");
            echo gzencode($dump, 9);
            break;
        case "bz2":
            header("Content-Disposition: attachment; filename={$nombre}.bz2");
            header("Content-type: application/x-bzip2");
            echo bzcompress($dump, 9);
            break;
        default:
            header("Content-Disposition: attachment; filename={$nombre}");
            header("Content-type: application/sql");
            echo $dump;
    }
} else {
    echo "<b>ATENCION: Probablemente ha ocurrido un error - headers ya fueron enviados</b><br />\n<pre>\n$dump\n</pre>";
}

$conn->close();
exit;
