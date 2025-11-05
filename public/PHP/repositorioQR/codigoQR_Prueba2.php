<?php
    // codigoQR_Prueba.php
    // Prueba de generación de código QR con Endroid\QrCode
        require 'vendor/autoload.php';
        use Endroid\QrCode\QrCode;

        use Endroid\QrCode\Writer\PngWriter;

        use Endroid\QrCode\Builder\Builder;
        use Endroid\QrCode\Encoding\Encoding;
        use Endroid\QrCode\ErrorCorrectionLevel;
        use Endroid\QrCode\Label\LabelAlignment;
        use Endroid\QrCode\Label\Font\OpenSans;
        use Endroid\QrCode\RoundBlockSizeMode;
        use Endroid\QrCode\Color\Color;

        //echo "Hello. This is a test of Endroid\QrCode\n";
        /**Prueba viendo el video:  https://youtu.be/8xPWPGxL7Xk?si=EJTDjFQYXx64pwcd*/
        /*
        $qr_code = new QrCode("Prueba de QR con Endroid\QrCode");
        $writer = new PngWriter();
        $result = $writer->write($qr_code);
        // Enviar el header correcto
        header('Content-Type: '.$result->getMimeType());// Indica que es una imagen PNG
        echo $result->getString(); // Muestra el texto del código QR
        */
        
        //Usando la versión del builder correcto para v6.0
        // Crear el builder
        /*$builder = new Builder();

        // Configurar QR
        $result = $builder
            ->writer(new PngWriter())
            ->data('Prueba de QR con Endroid\QrCode')
            ->encoding(new Encoding('UTF-8'))
            ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
            ->size(600)
            ->margin(10)
            ->build();
        // Mostrar en navegador
        header('Content-Type: ' . $result->getMimeType());
        echo $result->getString();
        */

        //PRUEBA SIN USAR CONSTRUCTOR - BUILDER
        $writer = new PngWriter();

        // Create QR code
        $qrCode = new QrCode(
            data: 'Life is too short to be generating QR codes',
            encoding: new Encoding('UTF-8'),
            errorCorrectionLevel: ErrorCorrectionLevel::Low,
            size: 300,
            margin: 10,
            roundBlockSizeMode: RoundBlockSizeMode::Margin,
            foregroundColor: new Color(0, 0, 0),
            backgroundColor: new Color(255, 255, 255)
        );

        $result = $writer->write($qrCode);

        // Enviar el header correcto
        header('Content-Type: ' . $result->getMimeType());

        // Imprimir la imagen directamente
        echo $result->getString();
        /*
        // Crear QR
        $qrCode = new QrCode("Prueba de QR con Endroid\QrCode");

        $writer = new PngWriter();
        $result = $writer->write($qrCode);

        // Enviar el header correcto
        header('Content-Type: ' . $result->getMimeType());

        // Imprimir la imagen directamente
        echo $result->getString();
        */
        /*
            $text = "Hola";
            QrCode::create("Hey there!"); // Crea un código QR con el texto "Hello, World!"
            $qr_code = QrCode::create($text); 
            $writer = new PngWriter;
            $result = $writer->write($qr_code);

            echo $result->getString(); // Muestra el código QR en formato base64
        */
        /* ==================== DEBUG PREVIO ==================== */
        /*$fuente = new OpenSans(20); // tamaño 20
        $rutaTTF = $fuente->getPath(); // obtiene la ruta del TTF
        $fuentePath = realpath(($fuente->getPath()));
        echo "Prueba FreeType: " . $rutaTTF . "\n";
        echo "Prueba realpath: " . $fuentePath . "\n";

        $letra = new OpenSans(20); 
        echo "<br>Tamaño de la fuente: " . $letra->getPath() . "\n";
        /************************************* */

        /*$builder = new Builder(
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
?>