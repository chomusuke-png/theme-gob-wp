<?php
if ( ! defined( '_S_VERSION' ) ) {
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Setup del Tema
 */
function gob_setup() {
	add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-logo', array(
		'height'      => 80,
		'width'       => 250,
		'flex-height' => true,
		'flex-width'  => true,
	) );

	register_nav_menus( array(
		'menu-1' => esc_html__( 'Menú Principal (Cabecera)', 'gob' ),
	) );
}
add_action( 'after_setup_theme', 'gob_setup' );

/**
 * Registro de Widgets (Sidebars)
 */
function gob_widgets_init() {
    // 1. Zona Home
    register_sidebar(array(
        'name'          => esc_html__('Widgets Inicio', 'gob'),
        'id'            => 'home-widgets',
        'description'   => esc_html__('Área principal para widgets en la portada (debajo de las tarjetas).', 'gob'),
        'before_widget' => '<div id="%1$s" class="gob-widget home-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));

    // 2. Zona Topbar (Banderitas)
    register_sidebar(array(
        'name'          => esc_html__('Barra Superior (Derecha)', 'gob'),
        'id'            => 'topbar-widget',
        'description'   => esc_html__('Ideal para widgets de idiomas o redes sociales.', 'gob'),
        'before_widget' => '<div id="%1$s" class="topbar-widget-item %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<span class="screen-reader-text">',
        'after_title'   => '</span>',
    ));

    // 3. Zona Footer (ÚNICA)
    register_sidebar(array(
        'name'          => esc_html__("Footer Principal", 'gob'),
        'id'            => "footer-widget-main",
        'description'   => esc_html__("Área única central del pie de página.", 'gob'),
        'before_widget' => '<div id="%1$s" class="footer-widget single-column-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="footer-widget-title">',
        'after_title'   => '</h4>',
    ));
}
add_action( 'widgets_init', 'gob_widgets_init' );

/**
 * Carga de Scripts y Estilos
 */
function gob_scripts() {
    $theme_version = _S_VERSION;
    $uri = get_template_directory_uri();

    wp_enqueue_style( 'gob-vars', $uri . '/assets/css/base/variables.css', array(), $theme_version );
    wp_enqueue_style( 'gob-global', $uri . '/assets/css/base/global.css', array('gob-vars'), $theme_version );
    
    // Layouts
    wp_enqueue_style( 'gob-header', $uri . '/assets/css/layout/header.css', array('gob-global'), $theme_version );
    wp_enqueue_style( 'gob-footer', $uri . '/assets/css/layout/footer.css', array('gob-global'), $theme_version );
    

    // Módulos
    wp_enqueue_style( 'gob-hero', $uri . '/assets/css/modules/hero.css', array('gob-global'), $theme_version );
    wp_enqueue_style( 'gob-cards', $uri . '/assets/css/modules/cards.css', array('gob-global'), $theme_version );
    wp_enqueue_style( 'gob-home-widgets', $uri . '/assets/css/modules/home-widgets.css', array('gob-global'), $theme_version );
    wp_enqueue_style( 'gob-back-to-top', $uri . '/assets/css/modules/back-to-top.css', array('gob-global'), $theme_version );
    if ( is_404() ) {
        wp_enqueue_style( 'gob-404', $uri . '/assets/css/modules/error-404.css', array('gob-global'), $theme_version );
    }

    // Pages
    if ( is_search() || is_archive() ) {
        wp_enqueue_style( 'gob-archive', $uri . '/assets/css/pages/archive.css', array('gob-global'), $theme_version );
    }
    wp_enqueue_style( 'gob-page', $uri . '/assets/css/pages/page.css', array('gob-global'), $theme_version );
    if ( is_single() ) {
        wp_enqueue_style( 'gob-single', $uri . '/assets/css/pages/single.css', array('gob-global'), $theme_version );
    }

    // Librerías Externas
    wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css', array(), '6.5.0' );

    // Estilo Principal (Style.css)
    wp_enqueue_style( 'gob-style', get_stylesheet_uri(), array('gob-global'), $theme_version );

    // Scripts JS
    wp_enqueue_script( 'gob-search-js', $uri . '/assets/js/search.js', array(), $theme_version, true );
    wp_enqueue_script( 'gob-main-js', $uri . '/assets/js/main.js', array(), $theme_version, true );
}
add_action( 'wp_enqueue_scripts', 'gob_scripts' );

/**
 * Customizer
 */
require get_template_directory() . '/includes/customizer.php';

function gob_add_search_to_menu($items, $args) {
    if ($args->theme_location === 'menu-1') {
        $search_item = '
        <li class="menu-item search-trigger-item">
            <a href="#" id="menu-search-btn" aria-label="Abrir buscador">
                <i class="fas fa-search"></i>
            </a>
            <div class="header-search-dropdown" id="header-search-dropdown">
                <form role="search" method="get" class="header-search-form" action="' . esc_url(home_url('/')) . '">
                    <input type="search" class="search-field" placeholder="Buscar..." value="' . get_search_query() . '" name="s" />
                    <button type="submit" class="search-submit"><i class="fas fa-arrow-right"></i></button>
                </form>
            </div>
        </li>';
        
        return $items . $search_item;
    }
    return $items;
}
add_filter('wp_nav_menu_items', 'gob_add_search_to_menu', 10, 2);