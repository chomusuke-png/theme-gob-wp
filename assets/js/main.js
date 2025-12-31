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

    // =============== SEARCHBAR (TOGGLE) ===============
    const searchBtn = document.getElementById('menu-search-btn');
    const searchDropdown = document.getElementById('header-search-dropdown');

    if (searchBtn && searchDropdown) {
        
        // Toggle al hacer click en el icono
        searchBtn.addEventListener('click', function(e) {
            e.preventDefault();
            searchDropdown.classList.toggle('active');
            
            // Auto-focus al input cuando se abre
            if (searchDropdown.classList.contains('active')) {
                const input = searchDropdown.querySelector('input');
                if (input) setTimeout(() => input.focus(), 100);
            }
        });

        // Cerrar si se hace click fuera del contenedor
        document.addEventListener('click', function(e) {
            if (!searchBtn.contains(e.target) && !searchDropdown.contains(e.target)) {
                searchDropdown.classList.remove('active');
            }
        });
    }

});