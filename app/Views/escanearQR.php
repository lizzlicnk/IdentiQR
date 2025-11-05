<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Escanear QR - IdentiQR</title>
    <link rel="icon" type="image/jpg" href="/IdentiQR/public/Media/img/Favicon.ico"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .modal-content {
            border-radius: 10px;
        }
        #video {
            width: 100%;
            max-width: 400px;
            border: 2px solid #007bff;
            border-radius: 5px;
        }
        .btn-escanear {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-escanear:hover {
            background-color: #0056b3;
        }
        .datos-qr {
            background-color: #e9ecef;
            padding: 15px;
            border-radius: 5px;
            height: 300px;
            overflow-y: auto;
        }
        .scanner-container {
            display: flex;
            gap: 20px;
        }
        .camera-section, .data-section {
            flex: 1;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Escanear Código QR</h1>
        <div class="text-center">
            <button id="btnEscanear" class="btn-escanear">Escanear QR</button>
        </div>

        <!-- Modal -->
        <div id="modalEscanear" class="modal" style="display: none;">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Escanear QR</h5>
                        <button type="button" class="close" onclick="cerrarModal()">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="scanner-container">
                            <!-- Sección Izquierda: Cámara -->
                            <div class="camera-section">
                                <h6 class="text-center">Cámara</h6>
                                <video id="video"></video>
                                <div id="estado" class="mt-3 text-center"></div>
                            </div>
                            <!-- Sección Derecha: Datos Escaneados -->
                            <div class="data-section">
                                <h6 class="text-center">Datos Escaneados</h6>
                                <div id="datosQR" class="datos-qr">
                                    <p class="text-muted">Apunte la cámara hacia un código QR para escanear automáticamente.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="cerrarModal()">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let scanner = null;
        let video = document.getElementById('video');
        let estado = document.getElementById('estado');
        let datosQR = document.getElementById('datosQR');

        document.getElementById('btnEscanear').addEventListener('click', abrirModal);

        function abrirModal() {
            document.getElementById('modalEscanear').style.display = 'block';
            iniciarScanner();
        }

        function cerrarModal() {
            document.getElementById('modalEscanear').style.display = 'none';
            detenerScanner();
            datosQR.innerHTML = '<p class="text-muted">Apunte la cámara hacia un código QR para escanear automáticamente.</p>';
            estado.innerHTML = '';
        }

        function iniciarScanner() {
            scanner = new Instascan.Scanner({ video: video });

            scanner.addListener('scan', function (content) {
                estado.innerHTML = '<span class="text-success">QR detectado! Cámara desactivada.</span>';
                datosQR.innerHTML = '<h6>Datos del QR:</h6><pre>' + content + '</pre>';
                detenerScanner(); // Detener la cámara después de detectar el QR
            });

            Instascan.Camera.getCameras().then(function (cameras) {
                if (cameras.length > 0) {
                    scanner.start(cameras[0]);
                    estado.innerHTML = 'Cámara activada. Escaneando...';
                } else {
                    estado.innerHTML = '<span class="text-danger">No se encontraron cámaras.</span>';
                }
            }).catch(function (e) {
                estado.innerHTML = '<span class="text-danger">Error al acceder a la cámara: ' + e.message + '</span>';
            });
        }

        function detenerScanner() {
            if (scanner) {
                scanner.stop();
                scanner = null;
            }
        }

        // Cerrar modal al hacer clic fuera
        window.onclick = function(event) {
            if (event.target == document.getElementById('modalEscanear')) {
                cerrarModal();
            }
        }
    </script>
</body>
</html>
