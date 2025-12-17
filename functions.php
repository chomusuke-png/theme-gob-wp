<?php
/**
 * CLACH Theme Functions and Definitions
 */

if ( ! defined( '_S_VERSION' ) ) {
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Setup del Tema
 */
function clach_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'custom-logo', array(
		'height'      => 80,
		'width'       => 250,
		'flex-height' => true,
		'flex-width'  => true,
	) );

	register_nav_menus( array(
		'menu-1' => esc_html__( 'Menú Principal (Cabecera)', 'clach' ),
	) );
}
add_action( 'after_setup_theme', 'clach_setup' );

/**
 * Registro de Widgets (Sidebars)
 */
function clach_widgets_init() {
    // 1. Zona Home (NUEVA)
    register_sidebar(array(
        'name'          => esc_html__('Widgets Inicio', 'clach'),
        'id'            => 'home-widgets',
        'description'   => esc_html__('Área principal para widgets en la portada (debajo de las tarjetas).', 'clach'),
        'before_widget' => '<div id="%1$s" class="clach-widget home-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));

    // 2. Zonas Footer (Existentes)
    $footer_widgets_count = 3;
    for ($i = 1; $i <= $footer_widgets_count; $i++) {
        register_sidebar(array(
            'name'          => esc_html__("Footer Widget $i", 'clach'),
            'id'            => "footer-widget-$i",
            'description'   => esc_html__("Área para la columna $i del footer.", 'clach'),
            'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="footer-widget-title">',
            'after_title'   => '</h4>',
        ));
    }
}
add_action( 'widgets_init', 'clach_widgets_init' );

/**
 * Carga de Scripts y Estilos
 * Se actualiza para incluir los estilos de layout de página.
 */
function clach_scripts() {
    $theme_version = _S_VERSION;
    $uri = get_template_directory_uri();

    wp_enqueue_style( 'clach-vars', $uri . '/assets/css/base/variables.css', array(), $theme_version );
    wp_enqueue_style( 'clach-global', $uri . '/assets/css/base/global.css', array('clach-vars'), $theme_version );
    
    // Layouts
    wp_enqueue_style( 'clach-header', $uri . '/assets/css/layout/header.css', array('clach-global'), $theme_version );
    wp_enqueue_style( 'clach-footer', $uri . '/assets/css/layout/footer.css', array('clach-global'), $theme_version );
    wp_enqueue_style( 'clach-page', $uri . '/assets/css/layout/page.css', array('clach-global'), $theme_version );

    // Módulos
    wp_enqueue_style( 'clach-hero', $uri . '/assets/css/modules/hero.css', array('clach-global'), $theme_version );
    wp_enqueue_style( 'clach-cards', $uri . '/assets/css/modules/cards.css', array('clach-global'), $theme_version );
    wp_enqueue_style( 'clach-home-widgets', $uri . '/assets/css/modules/home-widgets.css', array('clach-global'), $theme_version );
    wp_enqueue_style( 'clach-back-to-top', $uri . '/assets/css/modules/back-to-top.css', array('clach-global'), $theme_version );
    if ( is_404() ) {
        wp_enqueue_style( 'clach-404', $uri . '/assets/css/modules/error-404.css', array('clach-global'), $theme_version );
    }

    // Librerías Externas
    wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css', array(), '6.5.0' );

    // Estilo Principal (Style.css)
    wp_enqueue_style( 'clach-style', get_stylesheet_uri(), array('clach-global'), $theme_version );

    // Scripts JS
    wp_enqueue_script( 'clach-search-js', $uri . '/assets/js/search.js', array(), $theme_version, true );
    wp_enqueue_script( 'clach-main-js', $uri . '/assets/js/main.js', array(), $theme_version, true );
}
add_action( 'wp_enqueue_scripts', 'clach_scripts' );

/**
 * Customizer
 * Carga la lógica para el repetidor de enlaces del footer.
 */
require get_template_directory() . '/includes/customizer.php';