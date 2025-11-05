/* Este archivo funcionara para el uso de JS de los Alumnos*/
//1. Se autoescribira el CORREO
// Espera a que todo el DOM se haya cargado
document.addEventListener("DOMContentLoaded", () => {
    const matriculaInput = document.getElementById("matricula");
    const correoInput = document.getElementById("correo");

    if (matriculaInput && correoInput) {
        matriculaInput.addEventListener("input", () => {
            const matricula = matriculaInput.value.trim();
            if (matricula !== "") {
                correoInput.value = matricula + "@upemor.edu.mx";
            } else {
                correoInput.value = "";
            }
        });
    }
});

/*2. MENSAJES DE NOTIFICACIONES */

function registroAlumno(){
    Swal.fire({
        title: "Registro exitoso",
        text: "Se registro adecuadamente. Su código QR fue enviado al correo registrado.",
        icon: "success",
        timer: 3000,
        showConfirmButton: false
    });
}
