<?php
/**
 * Template part: Hero Section (Home Banner)
 * Muestra un banner principal con título, bajada y botón de llamada a la acción.
 * * @package GobStyleTheme
 */

// Obtener valores del Customizer
$hero_title    = get_theme_mod('gob_hero_title', 'Bienvenido al Portal');
$hero_subtitle = get_theme_mod('gob_hero_subtitle', 'Esta es la descripción principal del sitio.');
$btn_text      = get_theme_mod('gob_hero_btn_text', 'Ver Más');
$btn_url       = get_theme_mod('gob_hero_btn_url', '#');
$bg_image      = get_theme_mod('gob_hero_bg_image', '');

// Estilo inline para el fondo si existe imagen
$style_attr = '';
if ( $bg_image ) {
    $style_attr = 'style="background-image: url(' . esc_url($bg_image) . '); background-size: cover; background-position: center;"';
}
?>

<section class="hero-gov-section" <?php echo $style_attr; ?>>
    <div class="container">
        
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