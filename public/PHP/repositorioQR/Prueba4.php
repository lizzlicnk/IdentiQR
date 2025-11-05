<?php
    /*Usando el builder*/ 
    declare(strict_types=1);

    require 'vendor/autoload.php';
    use Endroid\QrCode\Builder\Builder;
    use Endroid\QrCode\Encoding\Encoding;
    use Endroid\QrCode\ErrorCorrectionLevel;
    use Endroid\QrCode\Label\LabelAlignment;
    use Endroid\QrCode\Label\Font\OpenSans;
    use Endroid\QrCode\RoundBlockSizeMode;
    use Endroid\QrCode\Writer\PngWriter;
    use Endroid\QrCode\Color\Color;
    use Endroid\QrCode\Label\Font\Font;
    use Endroid\QrCode\Margin;

        // test_font.php
        $font = __DIR__ . '/vendor/endroid/qr-code/assets/open_sans.ttf';
        if (!file_exists($font)) {
            echo "NO existe la fuente en: $font\n";
            exit;
        }
        if (!function_exists('imagettfbbox')) {
            echo "La función imagettfbbox NO está disponible. Habilita ext-gd / FreeType.\n";
            exit;
        }
        $bbox = @imagettfbbox(12, 0, $font, 'Prueba');
        if ($bbox === false) {
            echo "imagettfbbox devolvió false: no puede abrir la fuente o no hay FreeType.\n";
        } else {
            echo "imagettfbbox OK — la fuente funciona.\n";
            print_r($bbox);
        }


    $builder = new Builder(
        writer: new PngWriter(),
        writerOptions: [],
        validateResult: false,
        data: 'Prueba de contenido del QR',
        encoding: new Encoding('UTF-8'),
        errorCorrectionLevel: ErrorCorrectionLevel::High,
        size: 450,
        margin: 20,
        roundBlockSizeMode: RoundBlockSizeMode::Margin,
        foregroundColor: new Color(128,255,40),
        backgroundColor:new Color(255, 100, 255),
        labelText: "Prueba de etiqueta"
        
        //labelText: '',
        //labelFont: new Font(__DIR__.'/../../assets/open_sans.ttf', 16),
        //labelAlignment: LabelAlignment::Center,
        //labelMargin: new Margin(0, 10, 10, 10),
        //labelTextColor: new Color(0, 0, 0),
        //logoPath: '',
        //logoResizeToWidth: null,
        //logoResizeToHeight: null,
        //logoPunchoutBackground: false,

        /*TODO LO QUE DEBE TENER */
        /*
            private WriterInterface $writer = new PngWriter(),
            /// @var array<mixed> 
            private array $writerOptions = [],
            private bool $validateResult = false,
            // QrCode options
            private string $data = '',
            private EncodingInterface $encoding = new Encoding('UTF-8'),
            private ErrorCorrectionLevel $errorCorrectionLevel = ErrorCorrectionLevel::Low,
            private int $size = 300,
            private int $margin = 10,
            private RoundBlockSizeMode $roundBlockSizeMode = RoundBlockSizeMode::Margin,
            private ColorInterface $foregroundColor = new Color(0, 0, 0),
            private ColorInterface $backgroundColor = new Color(255, 255, 255),
            // Label options
            private string $labelText = '',
            private FontInterface $labelFont = new Font(__DIR__.'/../../assets/open_sans.ttf', 16),
            private LabelAlignment $labelAlignment = LabelAlignment::Center,
            private MarginInterface $labelMargin = new Margin(0, 10, 10, 10),
            private ColorInterface $labelTextColor = new Color(0, 0, 0),
            // Logo options
            private string $logoPath = '',
            private ?int $logoResizeToWidth = null,
            private ?int $logoResizeToHeight = null,
            private bool $logoPunchoutBackground = false,

        */
    );

    $result = $builder->build();

    header('Content-Type: ' . $result->getMimeType());
    echo $result->getString();

?>