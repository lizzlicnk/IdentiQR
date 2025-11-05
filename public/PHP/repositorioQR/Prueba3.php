<?php
    declare(strict_types=1);

    require 'vendor/autoload.php';

    use Endroid\QrCode\QrCode;
    use Endroid\QrCode\Writer\PngWriter;
    use Endroid\QrCode\Encoding\Encoding;
    use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevel;
    use Endroid\QrCode\Color\Color;

    // Crear el QR
    $qrCode = new QrCode(
        data: 'Este es un ejemplo de creación',
        encoding: new Encoding('UTF-8'),
        //errorCorrectionLevel: new ErrorCorrectionLevel(ErrorCorrectionLevel::Low),
        size: 450,      // tamaño en píxeles
        margin: 45,      // margen alrededor del QR
        foregroundColor: new Color(255, 44, 44),       // color
        backgroundColor: new Color(255, 40, 255)

        /*PARA GENERAR EL QR SE NECESITA ESO. */
        /*
        private string $data,
        private EncodingInterface $encoding = new Encoding('UTF-8'),
        private ErrorCorrectionLevel $errorCorrectionLevel = ErrorCorrectionLevel::Low,
        private int $size = 300,
        private int $margin = 10,
        private RoundBlockSizeMode $roundBlockSizeMode = RoundBlockSizeMode::Margin,
        private ColorInterface $foregroundColor = new Color(0, 0, 0),
        private ColorInterface $backgroundColor = new Color(255, 255, 255),

        */
    );


    // Crear escritor PNG
    $writer = new PngWriter();
    $result = $writer->write($qrCode);

    // Opcional: guardar en archivo
    //$result->saveToFile('qr-code.png');

    // Enviar header y mostrar la imagen directamente
    header('Content-Type: ' . $result->getMimeType());
    echo $result->getString();


    /*EJEMPLO USANDO BUILDER */
    /*
    public function __construct(
        private WriterInterface $writer = new PngWriter(),
        /** @var array<mixed> 
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
    ) {
        */

?>