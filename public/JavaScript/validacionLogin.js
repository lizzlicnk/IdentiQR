// validacionLogin.js
document.addEventListener("DOMContentLoaded", () => {
    // -------------------------------------------------------
    // 1. GESTIÓN DE ALERTAS (SweetAlert)
    // -------------------------------------------------------
    const statusInput = document.getElementById("loginStatus");

    if (statusInput && statusInput.value === 'error_credenciales') {
        Swal.fire({
            title: 'Acceso Denegado',
            text: 'Las credenciales ingresadas NO SON VÁLIDAS. Intente nuevamente.',
            icon: 'error',
            confirmButtonText: 'Reintentar',
            confirmButtonColor: '#d33',
            background: '#f8f9fa',
            backdrop: `
                rgba(0,0,123,0.4)
            `
        });
    }

    // -------------------------------------------------------
    // 2. BLOQUEO DEL BOTÓN "ATRÁS" (Historial)
    // -------------------------------------------------------
    // Esto evita que el usuario regrese a la sesión anterior si ya cerró sesión
    // o si está en el login.
    
    window.history.pushState(null, "", window.location.href);
    window.onpopstate = function () {
        window.history.pushState(null, "", window.location.href);
        // Opcional: Mostrar mensaje si intentan regresar
        // Swal.fire('Acción no permitida', 'Debes iniciar sesión.', 'warning');
    };
});