<?php
/**
 * Salida de CSS Dinámico del Customizer
 */

function gob_customize_css() {
    // Globals
    $c_primary = get_theme_mod('gob_color_primary', '#1A428A');
    $c_secondary = get_theme_mod('gob_color_secondary', '#009B4D');
    $c_danger = get_theme_mod('gob_color_danger', '#D32F2F');
    
    $c_bg = get_theme_mod('gob_color_bg_body', '#F5F5F5');
    $c_text = get_theme_mod('gob_color_text_main', '#333333');
    $c_border = get_theme_mod('gob_color_border_color', '#CCCCCC');

    // Header Main
    $h_bg = get_theme_mod('gob_header_header_bg', '#1A428A');
    $h_branding = get_theme_mod('gob_header_branding_color', '#FFFFFF');
    $h_link = get_theme_mod('gob_header_nav_link', '#FFFFFF');
    $h_hover = get_theme_mod('gob_header_nav_link_hover', 'rgba(255,255,255,0.1)');

    // Header Submenus
    $h_sub_bg = get_theme_mod('gob_header_sub_bg', '#1A428A');
    $h_sub_text = get_theme_mod('gob_header_sub_text', '#FFFFFF');
    $h_sub_hover = get_theme_mod('gob_header_sub_hover_bg', 'rgba(255,255,255,0.15)');

    // Mobile Menu
    $m_icon = get_theme_mod('gob_mobile_toggle_icon', '#FFFFFF');
    $m_bg = get_theme_mod('gob_mobile_menu_bg', '#1A428A');
    $m_link = get_theme_mod('gob_mobile_link_color', '#FFFFFF');
    $m_border = get_theme_mod('gob_mobile_border_color', 'rgba(255,255,255,0.1)');

    // Footer
    $f_bg = get_theme_mod('gob_footer_footer_bg', '#1A428A');
    $f_title = get_theme_mod('gob_footer_footer_title', '#FFFFFF');
    $f_text = get_theme_mod('gob_footer_footer_text', '#CCCCCC');
    $f_link = get_theme_mod('gob_footer_footer_link', '#BBBBBB');
    $f_link_hover = get_theme_mod('gob_footer_footer_link_hover', '#FFFFFF');
    $f_copy = get_theme_mod('gob_footer_footer_copy', '#888888');

    // Home Widgets
    $w_bg = get_theme_mod('gob_widget_bg', '#F5F5F5');
    $w_border = get_theme_mod('gob_widget_border', '#CCCCCC');
    $w_radius = get_theme_mod('gob_widget_radius', '4px');
    $w_title = get_theme_mod('gob_widget_title_color', '#1A428A');
    $w_decor = get_theme_mod('gob_widget_title_decor', '#009B4D');

    // Page Template
    $p_bg = get_theme_mod('gob_page_bg', '#FFFFFF');
    $p_title = get_theme_mod('gob_page_title_color', '#1A428A');
    $p_text = get_theme_mod('gob_page_text_color', '#333333');
    $p_heading = get_theme_mod('gob_page_heading_color', '#1A428A');
    $p_accent = get_theme_mod('gob_page_accent_color', '#009B4D');

    // Back to Top
    $btt_bg = get_theme_mod('gob_backtotop_bg', '#1A428A');
    $btt_color = get_theme_mod('gob_backtotop_color', '#FFFFFF');
    $btt_hover_bg = get_theme_mod('gob_backtotop_hover_bg', '#009B4D');
    $btt_hover_color = get_theme_mod('gob_backtotop_hover_color', '#FFFFFF');

    $hero_pad = get_theme_mod('gob_hero_height', 500); 
    $hero_align_h = get_theme_mod('gob_hero_align_h', 'left');
    $hero_align_v = get_theme_mod('gob_hero_align_v', 'center');

    // --- LÓGICA DE LA CURVA Y TRANSPARENCIA ---
    
    // 1. Obtenemos el color base (Hexadecimal) y la opacidad (0-100)
    $curve_hex = get_theme_mod('gob_hero_text_bg_color', '#ffffff');
    $curve_opacity_val = get_theme_mod('gob_hero_curve_opacity', 90);

    // 2. Convertir HEX a RGB para poder aplicar transparencia
    $curve_hex = str_replace('#', '', $curve_hex);
    if (strlen($curve_hex) == 3) {
        $r = hexdec(substr($curve_hex,0,1).substr($curve_hex,0,1));
        $g = hexdec(substr($curve_hex,1,1).substr($curve_hex,1,1));
        $b = hexdec(substr($curve_hex,2,1).substr($curve_hex,2,1));
    } else {
        $r = hexdec(substr($curve_hex,0,2));
        $g = hexdec(substr($curve_hex,2,2));
        $b = hexdec(substr($curve_hex,4,2));
    }

    // 3. Crear el string RGBA final (Dividimos por 100 para obtener decimal 0.9, 0.5, etc.)
    $curve_alpha = $curve_opacity_val / 100;
    $curve_bg_rgba = "rgba($r, $g, $b, $curve_alpha)";

    // --- LÓGICA DE BORDES (Igual que antes) ---
    $curve_px = get_theme_mod('gob_hero_curve_radius', 100) . 'px';
    $zero_px = '0px';

    $tl = $curve_px; $tr = $curve_px; $br = $curve_px; $bl = $curve_px;

    if ($hero_align_h === 'left') { $tl = $zero_px; $bl = $zero_px; }
    if ($hero_align_h === 'right') { $tr = $zero_px; $br = $zero_px; }
    if ($hero_align_v === 'flex-start') { $tl = $zero_px; $tr = $zero_px; }
    if ($hero_align_v === 'flex-end') { $bl = $zero_px; $br = $zero_px; }

    // Flexbox translation
    $flex_align_h = 'flex-start';
    if ($hero_align_h === 'center') $flex_align_h = 'center';
    if ($hero_align_h === 'right')  $flex_align_h = 'flex-end';
    
    $final_radius = "$tl $tr $br $bl";

    ?>
    <style type="text/css" id="gob-customizer-css">
        :root {
            --color-primary: <?php echo esc_attr($c_primary); ?>;
            --color-secondary: <?php echo esc_attr($c_secondary); ?>;
            --color-danger: <?php echo esc_attr($c_danger); ?>;
            
            --bg-body: <?php echo esc_attr($c_bg); ?>;
            --text-main: <?php echo esc_attr($c_text); ?>;
            --border-color: <?php echo esc_attr($c_border); ?>;
        }

        /* Header Main */
        .site-header .main-header { background-color: <?php echo esc_attr($h_bg); ?> !important; }
        .branding-text .standard-version,
        .branding-text .standard-desc {
            color: <?php echo esc_attr($h_branding); ?> !important;
        }
        .main-navigation li a { color: <?php echo esc_attr($h_link); ?> !important; }
        .main-navigation li a:hover { background-color: <?php echo esc_attr($h_hover); ?> !important; }

        /* Header Submenus */
        @media (min-width: 992px) {
            .main-navigation ul ul { 
                background-color: <?php echo esc_attr($h_sub_bg); ?> !important; 
            }
            .main-navigation ul ul li a { 
                color: <?php echo esc_attr($h_sub_text); ?> !important; 
            }
            .main-navigation ul ul li a:hover { 
                background-color: <?php echo esc_attr($h_sub_hover); ?> !important; 
            }
        }

        /* Mobile Menu */
        .menu-toggle { color: <?php echo esc_attr($m_icon); ?> !important; }
        @media (max-width: 991px) {
            .main-navigation.toggled {
                background-color: <?php echo esc_attr($m_bg); ?> !important;
            }
            .main-navigation.toggled li a {
                color: <?php echo esc_attr($m_link); ?> !important;
                border-bottom-color: <?php echo esc_attr($m_border); ?> !important;
            }
        }

        /* Footer */
        .footer { background-color: <?php echo esc_attr($f_bg); ?> !important; color: <?php echo esc_attr($f_text); ?> !important; }
        .footer-links h3, .footer-widget-title { color: <?php echo esc_attr($f_title); ?> !important; }
        .footer-links a, .footer-widget a { color: <?php echo esc_attr($f_link); ?> !important; }
        .footer-links a:hover, .footer-widget a:hover { color: <?php echo esc_attr($f_link_hover); ?> !important; }
        .footer-copy { color: <?php echo esc_attr($f_copy); ?> !important; }

        /* Hero Section Dinámico */
        .hero-gov-section {
            min-height: <?php echo intval($hero_pad); ?>px !important;
            display: flex !important;
            flex-direction: column !important;
            position: relative;
            
            /* Alineación Vertical del contenedor */
            justify-content: <?php echo esc_attr($hero_align_v); ?> !important; 
            
            /* Alineación Horizontal del contenedor (Items) */
            align-items: <?php echo esc_attr($flex_align_h); ?> !important;
            
            /* Alineación del texto interno */
            text-align: <?php echo esc_attr($hero_align_h); ?> !important;
            
            background-size: cover;
            background-position: center;
        }

        /* Ajuste para el contenedor interno con CURVA */
        .hero-gov-section .container {
            width: 100%;
            max-width: 600px; /* Un poco más ancho para dar aire */
            margin: 0; /* Quitamos márgenes automáticos para que pueda tocar bordes */
            
            /* Estilos dinámicos inyectados */
            border-radius: <?php echo esc_attr($final_radius); ?>;
            background-color: <?php echo $curve_bg_rgba; ?>;
            
            /* Padding extra para que el texto no toque la curva */
            padding: 40px; 
        }

        /* Home Widgets */
        .gob-widget.home-widget {
            background-color: <?php echo esc_attr($w_bg); ?> !important;
            border-color: <?php echo esc_attr($w_border); ?> !important;
            border-radius: <?php echo esc_attr($w_radius); ?> !important;
        }
        .home-widget .widget-title {
            color: <?php echo esc_attr($w_title); ?> !important;
            border-bottom-color: <?php echo esc_attr($w_decor); ?> !important;
        }

        /* Page Template Styles */
        .page-section {
            background-color: <?php echo esc_attr($p_bg); ?> !important;
        }
        .page-title {
            color: <?php echo esc_attr($p_title); ?> !important;
        }
        .page-content {
            color: <?php echo esc_attr($p_text); ?> !important;
        }
        .page-content h1, 
        .page-content h2, 
        .page-content h3, 
        .page-content h4, 
        .page-content h5, 
        .page-content h6 {
            color: <?php echo esc_attr($p_heading); ?> !important;
        }
        .page-content h2 {
            border-left-color: <?php echo esc_attr($p_accent); ?> !important;
        }
        .page-content a {
            color: <?php echo esc_attr($p_accent); ?> !important;
        }

        /* Back to Top */
        #btnTop {
            background-color: <?php echo esc_attr($btt_bg); ?> !important;
            color: <?php echo esc_attr($btt_color); ?> !important;
        }
        #btnTop:hover {
            background-color: <?php echo esc_attr($btt_hover_bg); ?> !important;
            color: <?php echo esc_attr($btt_hover_color); ?> !important;
        }
    </style>
    <?php
}
add_action('wp_head', 'gob_customize_css', 100);