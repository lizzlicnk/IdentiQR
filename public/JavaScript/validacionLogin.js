// validacionLogin.js
document.addEventListener("DOMContentLoaded", () => {
    const mensajeError = document.getElementById("mensajeError");

    if (mensajeError) {
        // Si existe el elemento con mensaje de error, muestra alerta
        alert("Las credenciales NO SON VÁLIDAS. Intente nuevamente.");
    }
});