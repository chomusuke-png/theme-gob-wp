<?php
/**
 * Template part: Home Video Section (Autoplay & Protected)
 */

// 1. Obtener valores del Customizer
$video_id    = get_theme_mod('gob_video_id', '');
$video_url   = wp_get_attachment_url($video_id);
$poster      = get_theme_mod('gob_video_poster', '');

$video_title = get_theme_mod('gob_video_title', '');
$max_width   = get_theme_mod('gob_video_width', '800');

// Si no hay video, salir
if ( ! $video_url ) {
    return;
}
?>

<section class="home-video-section" style="padding: 40px 0; background-color: #fff; border-bottom: 1px solid #ddd;">
    <div class="container" style="text-align: center;">
        
        <?php if ( ! empty($video_title) ) : ?>
            <h2 class="section-title" style="color: var(--color-primary); margin-bottom: 20px; text-transform: uppercase;">
                <?php echo esc_html($video_title); ?>
            </h2>
        <?php endif; ?>

        <div class="video-wrapper" style="max-width: <?php echo esc_attr($max_width); ?>px; margin: 0 auto; position: relative;">
            
            <video 
                controls 
                autoplay 
                muted 
                loop 
                playsinline 
                controlsList="nodownload" 
                oncontextmenu="return false;"
                <?php echo $poster ? 'poster="' . esc_url($poster) . '"' : ''; ?> 
                style="width: 100%; height: auto; display: block; border-radius: 4px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                
                <source src="<?php echo esc_url($video_url); ?>" type="video/mp4">
                Tu navegador no soporta la etiqueta de video.
            </video>

        </div>

    </div>
</section>