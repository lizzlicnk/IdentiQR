<?php
// debug_font.php
echo "<pre>";

    // 1) phpinfo check
    echo "PHP version: " . phpversion() . "\n";
    if (function_exists('gd_info')) {
        $gd = gd_info();
        echo "GD enabled: " . ($gd['GD Version'] ?? 'unknown') . "\n";
        echo "FreeType suport: " . ($gd['FreeType Support'] ? 'yes' : 'no') . "\n";
    } else {
        echo "GD not enabled (gd_info not found)\n";
    }

    // 2) path checks
    $font = __DIR__ . '/vendor/endroid/qr-code/assets/open_sans.ttf';
    echo "Font path: $font\n";
    echo "realpath: " . (realpath($font) ?: 'realpath returned false') . "\n";
    echo "file_exists: " . (file_exists($font) ? 'yes' : 'no') . "\n";
    if (file_exists($font)) {
        echo "filesize: " . filesize($font) . " bytes\n";
        echo "is_readable: " . (is_readable($font) ? 'yes' : 'no') . "\n";
    }

    // 3) imagettfbbox test (no silence, to see warning)
    if (function_exists('imagettfbbox')) {
        $bbox = @imagettfbbox(12, 0, $font, 'Prueba');
        var_dump($bbox === false ? 'imagettfbbox returned false' : $bbox);
    } else {
        echo "imagettfbbox not available\n";
    }

    echo "</pre>";
?>