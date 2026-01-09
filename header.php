<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <?php 
    $meta_desc = get_theme_mod('gob_meta_description', ''); 
    
    if ( ! empty( $meta_desc ) ) : ?>
        <meta name="description" content="<?php echo esc_attr( $meta_desc ); ?>">
    <?php endif; 
    ?>

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header id="masthead" class="site-header">
    
    <div class="top-bar">
        <div class="container">
            <span class="org-name">
                <?php echo esc_html(get_theme_mod('gob_topbar_text', 'Centro de Certificación Halal de Chile')); ?>
            </span>
            
            <div class="top-links">
                <?php if ( is_active_sidebar( 'topbar-widget' ) ) : ?>
                    <?php dynamic_sidebar( 'topbar-widget' ); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="main-header">
        <div class="container flex-header">
            
            <div class="site-branding">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                    <?php 
                        $custom_logo_id = get_theme_mod( 'custom_logo' );
                        $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
                        
                        if ( has_custom_logo() ) {
                            echo '<img src="' . esc_url( $logo[0] ) . '" alt="' . get_bloginfo( 'name' ) . '" class="gov-logo">';
                        } else {
                            echo '<h1 class="site-title">' . get_bloginfo( 'name' ) . '</h1>';
                        }
                    ?>
                </a>
                
                <div class="branding-text">
                    <span class="standard-version">
                        <?php echo esc_html(get_theme_mod('gob_branding_version', '')); ?>
                    </span>
                    <span class="standard-desc">
                        <?php echo esc_html(get_theme_mod('gob_branding_desc', '')); ?>
                    </span>
                </div>
            </div>

            <button id="menu-toggle" class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                <i class="fas fa-bars"></i>
            </button>

            <nav id="site-navigation" class="main-navigation">
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'menu-1',
                    'menu_id'        => 'primary-menu',
                    'container'      => false,
                    'menu_class'     => 'nav-menu gov-style',
                ) );
                ?>
            </nav>
        </div>
    </div>
</header>