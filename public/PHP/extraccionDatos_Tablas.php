<?php
function obtenerExtracurricular($descripcion) {
    // Supongamos que el extracurricular aparece con la palabra "Extracurricular" seguida del nombre entre corchetes.
    // Ejemplo en tu descripción:
    // "…extracurricular> de [Extracurricular] [Básquetbol]. Datos Médicos…"
    
    // Intentamos extraer el texto dentro del segundo par de corchetes []
    // Una forma simple es con preg_match_all para extraer todas las cadenas entre corchetes
    
    preg_match_all('/\[(.*?)\]/', $descripcion, $matches);
    // $matches[1] contendrá todas las coincidencias
    
    // Buscamos si "Extracurricular" está en alguno y tomamos el siguiente
    $arr = $matches[1];
    for ($i=0; $i < count($arr); $i++) {
        if (strtolower($arr[$i]) === 'extracurricular' && isset($arr[$i+1])) {
            return $arr[$i+1]; // Devuelve el nombre del extracurricular (ejemplo: "Básquetbol")
        }
    }
    
    return "No especificado";
}
?>