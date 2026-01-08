<?php
/**
 * Template part: Hero Section (Home Banner)
 */

// 1. Obtener valores
$hero_title    = get_theme_mod('gob_hero_title', 'Bienvenido al Portal');
$hero_subtitle = get_theme_mod('gob_hero_subtitle', 'Esta es la descripción principal del sitio.');
$btn_text      = get_theme_mod('gob_hero_btn_text', 'Ver Más');
$btn_url       = get_theme_mod('gob_hero_btn_url', '#');
$bg_image      = get_theme_mod('gob_hero_bg_image', '');

// Nuevos valores de Overlay
$ov_color      = get_theme_mod('gob_hero_overlay_color', '#ffffff');
$ov_opacity    = get_theme_mod('gob_hero_overlay_opacity', 0) / 100; // Convertimos 50 a 0.5

// Estilo del fondo
$style_attr = '';
if ( $bg_image ) {
    $style_attr = 'style="background-image: url(' . esc_url($bg_image) . '); background-size: cover; background-position: center; position: relative;"';
} else {
    $style_attr = 'style="position: relative;"';
}
?>

<section class="hero-gov-section" <?php echo $style_attr; ?>>
    
    <div class="hero-overlay" style="
        position: absolute; 
        top: 0; left: 0; width: 100%; height: 100%; 
        background-color: <?php echo esc_attr($ov_color); ?>; 
        opacity: <?php echo esc_attr($ov_opacity); ?>;
        pointer-events: none; /* Permite hacer clic a través de la capa */
    "></div>

    <div class="container" style="position: relative; z-index: 2;">
        
        <?php if ( $hero_title ) : ?>
            <h1 class="hero-title"><?php echo esc_html($hero_title); ?></h1>
        <?php endif; ?>

        <?php if ( $hero_subtitle ) : ?>
            <p class="hero-subtitle"><?php echo esc_html($hero_subtitle); ?></p>
        <?php endif; ?>

        <?php if ( $btn_text && $btn_url ) : ?>
            <div class="hero-actions">
                <a href="<?php echo esc_url($btn_url); ?>" class="gov-btn">
                    <?php echo esc_html($btn_text); ?>
                </a>
            </div>
        <?php endif; ?>

    </div>
</section>