<?php
class BDModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    /*PARA LLAMAR A LOS MÉTODOS DEL BACKUP */
    public function backupDBs() {
        $conn = $this->conn;
        date_default_timezone_set('America/Mexico_City');
        $fechaHora = date('Y-m-d_H-i-s');
        $nombre = "Backup_IdentiQR_" . $fechaHora;
        $fileName = $nombre . ".sql";
        $drop = true;

        if (!$conn || $conn->connect_error) return false;

        $bdRow = $conn->query("SELECT DATABASE() AS db");
        $bd = ($bdRow && $r = $bdRow->fetch_assoc()) ? $r['db'] : 'unknown';

        $tablas = [];
        $funciones = [];
        $procedimientos = [];
        $triggers = [];

        $res = $conn->query("SHOW TABLES");
        while ($row = $res->fetch_row()) $tablas[] = $row[0];

        $resFunc = $conn->query("SHOW FUNCTION STATUS WHERE Db = DATABASE()");
        if ($resFunc) while ($row = $resFunc->fetch_assoc()) $funciones[] = $row['Name'];

        $resProc = $conn->query("SHOW PROCEDURE STATUS WHERE Db = DATABASE()");
        if ($resProc) while ($row = $resProc->fetch_assoc()) $procedimientos[] = $row['Name'];

        $resTrig = $conn->query("SHOW TRIGGERS");
        if ($resTrig) while ($row = $resTrig->fetch_assoc()) $triggers[] = $row['Trigger'];

        $info['fecha'] = date("d-m-Y");
        $info['hora'] = date("h:i:s A");
        $info['mysqlver'] = $conn->server_info;
        $info['phpver'] = phpversion();
        // Representación breve de tablas, funciones, procedimientos y triggers
        $info['tablas'] = implode(";  ", $tablas);

        //PODRÁ CAMBIAR EL <<<EOT EOT; >>>
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
        $dump .= "SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";\n\n";

        //$dump = "-- Generado el {$info['fecha']} a las {$info['hora']}\n";
        //$dump .= "-- Servidor:  {$info['mysqlver']}\n";
        //$dump .= "SET FOREIGN_KEY_CHECKS=0;\n";
        //$dump .= "SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";\n\n";

        // Tablas
        foreach ($tablas as $tabla) {
            if ($drop) $dump .= "DROP TABLE IF EXISTS `{$tabla}`;\n";
            $resCreate = $conn->query("SHOW CREATE TABLE `{$tabla}`");
            if ($resCreate && $r = $resCreate->fetch_row()) $dump .= $r[1] . ";\n\n";

            $resData = $conn->query("SELECT * FROM `{$tabla}`");
            if ($resData) {
                while ($fila = $resData->fetch_assoc()) {
                    $values = [];
                    foreach ($fila as $val) {
                        $values[] = is_null($val) ? "NULL" : "'" . $conn->real_escape_string($val) . "'";
                    }
                    $dump .= "INSERT INTO `{$tabla}` VALUES (" . implode(", ", $values) . ");\n";
                }
            }
            $dump .= "\n";
        }

        // Rutinas con DELIMITER correcto
        foreach ($funciones as $funcion) {
            if ($drop) $dump .= "DROP FUNCTION IF EXISTS `{$funcion}`;\n";
            $resCreate = $conn->query("SHOW CREATE FUNCTION `{$funcion}`");
            if ($resCreate && $r = $resCreate->fetch_row()) $dump .= "DELIMITER //\n" . $r[2] . "//\nDELIMITER ;\n\n";
        }

        foreach ($procedimientos as $proc) {
            if ($drop) $dump .= "DROP PROCEDURE IF EXISTS `{$proc}`;\n";
            $resCreate = $conn->query("SHOW CREATE PROCEDURE `{$proc}`");
            if ($resCreate && $r = $resCreate->fetch_row()) $dump .= "DELIMITER //\n" . $r[2] . "//\nDELIMITER ;\n\n";
        }

        foreach ($triggers as $trigger) {
            if ($drop) $dump .= "DROP TRIGGER IF EXISTS `{$trigger}`;\n";
            $resCreate = $conn->query("SHOW CREATE TRIGGER `{$trigger}`");
            if ($resCreate && $r = $resCreate->fetch_row()) $dump .= "DELIMITER //\n" . $r[2] . "//\nDELIMITER ;\n\n";
        }

        $dump .= "SET FOREIGN_KEY_CHECKS=1;\n";

        $filePath = __DIR__ . '/../../config/Backups/' . $fileName;
        if (!file_exists(dirname($filePath))) mkdir(dirname($filePath), 0777, true);
        $success = file_put_contents($filePath, $dump);
        
        return $success ? $filePath : false;
    }

    /*PARA LLAMAR A LOS MÉTODOS DEL RESTORE */
    public function restoreDBs($ruta) {
        $conn = $this->conn;
        $lines = file($ruta);
        
        if ($lines === false) return "Error: No se pudo leer el archivo SQL.";

        $conn->query("SET FOREIGN_KEY_CHECKS=0");
        
        $current_query = "";
        $delimiter = ";";
        
        foreach ($lines as $line) {
            $trimLine = trim($line);

            // Solo ignoramos líneas vacías y comentarios de una sola línea (-- o #)
            // Los comentarios /* ... */ se deben enviar a MySQL para evitar romper bloques.
            if (empty($trimLine) || strpos($trimLine, "--") === 0 || strpos($trimLine, "#") === 0) {
                continue;
            }

            // Detectar cambio de DELIMITER
            if (preg_match('/^DELIMITER\s+(\S+)/i', $trimLine, $matches)) {
                $delimiter = $matches[1]; 
                continue;
            }

            $current_query .= $line;

            // Verificar si termina con el delimitador actual
            if (preg_match('/' . preg_quote($delimiter, '/') . '\s*$/', $trimLine)) {
                $sqlToRun = substr(trim($current_query), 0, -strlen($delimiter));

                if (!empty(trim($sqlToRun))) {
                    try {
                        $conn->query($sqlToRun);
                    } catch (mysqli_sql_exception $e) {
                        // Capturamos el error para mostrarlo bonito y reactivar FK
                        $conn->query("SET FOREIGN_KEY_CHECKS=1");
                        return "Error SQL en restauración: " . $e->getMessage();
                    }
                }
                $current_query = ""; 
            }
        }

        $conn->query("SET FOREIGN_KEY_CHECKS=1");
        //return "Restauración exitosa :D";
        return true;
    }
}
?>