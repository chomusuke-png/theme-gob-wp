document.addEventListener('DOMContentLoaded', function() {
    
    // =============== BOTÓN VOLVER ARRIBA ===============
    const btnTop = document.getElementById("btnTop");

    if (btnTop) {
        window.addEventListener("scroll", () => {
            if (window.scrollY > 120) {
                btnTop.style.display = "flex";
            } else {
                btnTop.style.display = "none";
            }
        });

        btnTop.addEventListener("click", () => {
            window.scrollTo({ top: 0, behavior: "smooth" });
        });
    }

    // =============== MENÚ MÓVIL (TOGGLE) ===============
    const menuToggle = document.getElementById('menu-toggle');
    const siteNavigation = document.getElementById('site-navigation');

    if (menuToggle && siteNavigation) {
        menuToggle.addEventListener('click', function() {
            // Alternar clase .toggled en el contenedor del menú
            siteNavigation.classList.toggle('toggled');
            
            // Actualizar aria-expanded para accesibilidad
            const expanded = menuToggle.getAttribute('aria-expanded') === 'true' || false;
            menuToggle.setAttribute('aria-expanded', !expanded);
            
            // Cambiar icono (opcional) de hamburguesa a X
            const icon = menuToggle.querySelector('i');
            if(icon) {
                if(siteNavigation.classList.contains('toggled')) {
                    icon.classList.remove('fa-bars');
                    icon.classList.add('fa-times');
                } else {
                    icon.classList.remove('fa-times');
                    icon.classList.add('fa-bars');
                }
            }
        });
    }

});