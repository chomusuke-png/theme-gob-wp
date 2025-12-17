document.addEventListener('DOMContentLoaded', function() {
    
    // =============== BOTÓN VOLVER ARRIBA ===============
    const btnTop = document.getElementById("btnTop");

    if (btnTop) {
        // Mostrar/Ocultar al hacer scroll
        window.addEventListener("scroll", () => {
            if (window.scrollY > 120) {
                btnTop.style.display = "flex";
            } else {
                btnTop.style.display = "none";
            }
        });

        // Acción de click (Scroll suave)
        btnTop.addEventListener("click", () => {
            window.scrollTo({ top: 0, behavior: "smooth" });
        });
    }

});