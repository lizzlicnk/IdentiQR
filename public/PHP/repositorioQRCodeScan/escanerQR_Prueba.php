<?php
    require __DIR__ . "/vendor/autoload.php";
    use Zxing\QrReader;
    $imgPrueba = realpath(__DIR__ . '/public/PHP//qr-code-SLAO230036.png');


    if (!file_exists($imgPrueba)) {
        die("Archivo QR no encontrado en: $imgPrueba");
    } else {
        echo "Si existe el archivo \n <br><hr>";
    }

    $qrcode = new QrReader($imgPrueba);
    $text = $qrcode->text(); //return decoded text from QR Code

    echo $text;
?>
