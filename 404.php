<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Clach_Theme
 * @since 1.0.0
 */

get_header();
?>

<main id="primary" class="site-main">

    <section class="error-404 not-found">
        <div class="container">
            <header class="page-header">
                <h1 class="page-title">404</h1>
                <h2 class="page-subtitle">Documento o página no encontrada</h2>
            </header>

            <div class="page-content">
                <p>Lo sentimos, no pudimos encontrar lo que buscabas. Puede que el enlace esté roto o la página haya sido movida.</p>
                
                <div class="error-actions">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn-home">Volver al Inicio</a>
                </div>
            </div>
        </div>
    </section>

</main>

<?php
get_footer();