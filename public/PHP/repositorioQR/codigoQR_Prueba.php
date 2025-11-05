<?php
    // codigoQR_Prueba.php
    // Prueba de generación de código QR con Endroid\QrCode
    require_once __DIR__ . '/vendor/autoload.php';
    use Endroid\QrCode\Builder\Builder;
    use Endroid\QrCode\Encoding\Encoding;
    use Endroid\QrCode\ErrorCorrectionLevel;
    use Endroid\QrCode\Label\LabelAlignment;
    use Endroid\QrCode\Label\Font\OpenSans;
    use Endroid\QrCode\RoundBlockSizeMode;
    use Endroid\QrCode\Writer\PngWriter;
    use Endroid\QrCode\Color\Color;
    use Endroid\QrCode\Logo\Logo;

    $builder = new Builder(
        writer: new PngWriter(),
        writerOptions: [],
        validateResult: false,
        data: 'Prueba de contenido del QR',
        encoding: new Encoding('UTF-8'),
        errorCorrectionLevel: ErrorCorrectionLevel::High,   // aquí veremos si existe la constante y que el nivel de protección sea complicado
        size: 450,
        margin: 25,
        roundBlockSizeMode: RoundBlockSizeMode::Margin,
        logoPath: 'Logo.png',
        
        logoResizeToWidth: 200,
        //logoPunchoutBackground: true,

        foregroundColor: new Color(205,92,92),
        backgroundColor:new Color(250, 234, 230),
        labelText: 'Este es el primer QR-PRUEBA',
        labelFont: new OpenSans(15),
        labelAlignment: LabelAlignment::Center
    );

    $result = $builder->build();

    // Output QR al navegador
    header('Content-Type: ' . $result->getMimeType());
    echo $result->getString();

    //$result->saveToFile("qr-code.png"); //Esto lo tendría que mandar a correo

    exit;
        // Código de generación de QR
        /*
            $builder = new Builder(
            writer: new PngWriter(),
            writerOptions: [],
            validateResult: false,
            data: 'Custom QR code contents',
            encoding: new Encoding('UTF-8'),
            errorCorrectionLevel: ErrorCorrectionLevel::High,
            size: 300,
            margin: 10,
            roundBlockSizeMode: RoundBlockSizeMode::Margin,
            logoPath: __DIR__.'/assets/bender.png',
            logoResizeToWidth: 50,
            logoPunchoutBackground: true,
            labelText: 'This is the label',
            labelFont: new OpenSans(20),
            labelAlignment: LabelAlignment::Center
        );

        $result = $builder->build();
        */

        /* PRUEBA
            // Test rápido para diagnosticar
            require __DIR__ . '/vendor/autoload.php'; // <-- asegúrate que este path es correcto

            echo "imagettfbbox exists? " . (function_exists('imagettfbbox') ? "SI existe\n" : "NO\n");
            echo "<br><br>";
            if (function_exists('gd_info')) {
                $gd = gd_info();
                echo "GD Version: " . ($gd['GD Version'] ?? 'unknown') . "\n";
                echo "<br>FreeType Support: " . (!empty($gd['FreeType Support']) ? "SI\n" : "NO\n");
            } else {
                echo "gd_info() NO disponible\n";
            }

            $fontPath = (new \Endroid\QrCode\Label\Font\OpenSans())->getPath();
            echo "<br>OpenSans getPath() => $fontPath\n";
            echo "<br>realpath => " . (realpath($fontPath) ?: 'false') . "\n";
            echo "<br>file_exists => " . (file_exists($fontPath) ? "SI\n" : "NO\n");
            echo "<br>is_readable => " . (is_readable($fontPath) ? "SI\n" : "NO\n");

            // Mostrar open_basedir si existe (puede limitar acceso a archivos en Windows)
            echo "<br>open_basedir => " . (ini_get('open_basedir') ?: 'none') . "\n";

            exit;
        */


        
        /*
        declare(strict_types=1);

        require __DIR__ . '/vendor/autoload.php';

        use Endroid\QrCode\Builder\Builder;
        use Endroid\QrCode\Writer\PngWriter;
        use Endroid\QrCode\Encoding\Encoding;
        use Endroid\QrCode\ErrorCorrectionLevel;
        use Endroid\QrCode\Label\LabelAlignment;
        use Endroid\QrCode\Label\Font\Font;
        use Endroid\QrCode\RoundBlockSizeMode;

        // Verificaciones (opcional)
        if (!function_exists('imagettfbbox')) {
            die("Error: imagettfbbox() NO existe. Habilita GD/FreeType en php.ini.\n");
        }
        if (!class_exists(Builder::class)) {
            die("Error: Autoload NO cargó Endroid\\QrCode. Verifica vendor/autoload.php\n");
        }

        // Ruta absoluta a la fuente
        $fontCandidate = __DIR__ . '/vendor/endroid/qr-code/assets/open_sans.ttf';
        $fontPath = realpath($fontCandidate);
        if ($fontPath === false || !is_readable($fontPath)) {
            die("Error: No se encontró o no es legible la fuente: $fontCandidate\n");
        }

        // prepara writer y font
        $writer = new PngWriter();
        $font = new Font($fontPath, 14);

        // Si tu versión de Builder usa el constructor (como en tu vendor), usa esto:
        $builder = new Builder(
            writer: $writer,
            writerOptions: [],
            validateResult: false,
            data: 'https://ejemplo.local/hola',
            encoding: new Encoding('UTF-8'),
            errorCorrectionLevel: ErrorCorrectionLevel::high(), // puede variar por versión
            size: 300,
            margin: 10,
            roundBlockSizeMode: RoundBlockSizeMode::Margin,
            logoPath: null,
            logoResizeToWidth: null,
            logoPunchoutBackground: false,
            labelText: 'Mi QR - Prueba',
            labelFont: $font,
            labelAlignment: LabelAlignment::Center
        );

        // Construir y obtener resultado
        $result = $builder->build();

        // Enviar al navegador
        header('Content-Type: ' . $result->getMimeType());
        echo $result->getString();
        exit;
        */

?>