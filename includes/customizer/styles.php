<?php
/**
 * Salida de CSS Dinámico del Customizer
 */

function clach_customize_css() {
    // Globals
    $c_blue = get_theme_mod('clach_color_nhla_blue', '#1A428A');
    $c_green = get_theme_mod('clach_color_nhla_green', '#009B4D');
    $c_red = get_theme_mod('clach_color_nhla_red', '#D32F2F');
    $c_bg = get_theme_mod('clach_color_bg_body', '#F5F5F5');
    $c_text = get_theme_mod('clach_color_text_main', '#333333');
    $c_border = get_theme_mod('clach_color_border_color', '#CCCCCC');

    // Header
    $h_bg = get_theme_mod('clach_header_header_bg', '#1A428A');
    $h_link = get_theme_mod('clach_header_nav_link', '#FFFFFF');
    $h_hover = get_theme_mod('clach_header_nav_link_hover', 'rgba(255,255,255,0.1)');

    // Footer
    $f_bg = get_theme_mod('clach_footer_footer_bg', '#1A428A');
    $f_title = get_theme_mod('clach_footer_footer_title', '#FFFFFF');
    $f_text = get_theme_mod('clach_footer_footer_text', '#CCCCCC');
    $f_link = get_theme_mod('clach_footer_footer_link', '#BBBBBB');
    $f_link_hover = get_theme_mod('clach_footer_footer_link_hover', '#FFFFFF');
    $f_copy = get_theme_mod('clach_footer_footer_copy', '#888888');

    // Home Widgets
    $w_bg = get_theme_mod('clach_widget_bg', '#F5F5F5');
    $w_border = get_theme_mod('clach_widget_border', '#CCCCCC');
    $w_radius = get_theme_mod('clach_widget_radius', '4px');
    $w_title = get_theme_mod('clach_widget_title_color', '#1A428A');
    $w_decor = get_theme_mod('clach_widget_title_decor', '#009B4D');

    // Back to Top
    $btt_bg = get_theme_mod('clach_backtotop_bg', '#1A428A');
    $btt_color = get_theme_mod('clach_backtotop_color', '#FFFFFF');
    $btt_hover_bg = get_theme_mod('clach_backtotop_hover_bg', '#009B4D');
    $btt_hover_color = get_theme_mod('clach_backtotop_hover_color', '#FFFFFF');

    ?>
    <style type="text/css" id="clach-customizer-css">
        :root {
            --nhla-blue: <?php echo esc_attr($c_blue); ?>;
            --nhla-green: <?php echo esc_attr($c_green); ?>;
            --nhla-red: <?php echo esc_attr($c_red); ?>;
            --bg-body: <?php echo esc_attr($c_bg); ?>;
            --text-main: <?php echo esc_attr($c_text); ?>;
            --border-color: <?php echo esc_attr($c_border); ?>;
        }

        /* Header */
        .site-header .main-header { background-color: <?php echo esc_attr($h_bg); ?> !important; }
        .main-navigation li a { color: <?php echo esc_attr($h_link); ?> !important; }
        .main-navigation li a:hover { background-color: <?php echo esc_attr($h_hover); ?> !important; }

        /* Footer */
        .footer { background-color: <?php echo esc_attr($f_bg); ?> !important; color: <?php echo esc_attr($f_text); ?> !important; }
        .footer-links h3, .footer-widget-title { color: <?php echo esc_attr($f_title); ?> !important; }
        .footer-links a, .footer-widget a { color: <?php echo esc_attr($f_link); ?> !important; }
        .footer-links a:hover, .footer-widget a:hover { color: <?php echo esc_attr($f_link_hover); ?> !important; }
        .footer-copy { color: <?php echo esc_attr($f_copy); ?> !important; }

        /* Home Widgets */
        .clach-widget.home-widget {
            background-color: <?php echo esc_attr($w_bg); ?> !important;
            border-color: <?php echo esc_attr($w_border); ?> !important;
            border-radius: <?php echo esc_attr($w_radius); ?> !important;
        }
        .home-widget .widget-title {
            color: <?php echo esc_attr($w_title); ?> !important;
            border-bottom-color: <?php echo esc_attr($w_decor); ?> !important;
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
add_action('wp_head', 'clach_customize_css', 100);