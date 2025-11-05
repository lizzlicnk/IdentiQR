<?php
    
    #Prueba para ver si se realiza la conexión a la base de datos - Usando la clase Connection_BD.php
    /*
    require 'Connection_BD.php';

    $conn = new Connection_BD();
    $db = $conn->getConnection();

    if ($db) {
        echo "✅ Conexión exitosa a la base de datos";
    } else {
        echo "❌ No se pudo conectar a la base de datos";
    }
    */
    

    #Prueba para ver si se realiza la conexión a la base de datos - Usando la clase Controlador.php     
    /*
    require __DIR__ . '/../../Controlador/Controlador.php';

    $unControlador = new Controlador();
    $d = $unControlador->getDB();

    if ($d) {
        echo "✅ Conexión exitosa a la base de datos desde el controlador";
    } else {
        echo "❌ No se pudo conectar a la base de datos desde el controlador";
    }
    */

    #Prueba para ver si se realiza el login - Usando la clase Controlador.php
    require __DIR__ . '/../../Controllers/Controlador.php';
    $unControlador = new Controlador();

    // Datos de prueba
    $usr = "alexissanchezluna5@gmail.com"; #Usando este NO DEJA (NO EXISTE - MODIFICAR EL CALL)
    $usr2 = "ALSAA2025CF";
    $pw = "27Deoctubre*";

    if ($unControlador->loginUsuario($usr, $pw)) {
        echo "✅ Usuario logueado correctamente";
    } else {
        echo "❌ Usuario o contraseña incorrectos";
    }
    
?>
