<?php
/**
 * Template part for displaying a message that posts cannot be found.
 *
 * @package GobStyleTheme
 */

?>

<div class="no-results not-found">
    <header class="page-header">
        <h1 class="page-title"><?php esc_html_e( 'No se encontraron resultados', 'gob' ); ?></h1>
    </header>

    <div class="page-content">
        <?php if ( is_search() ) : ?>
            <p><?php esc_html_e( 'Lo sentimos, pero no hay nada que coincida con tus términos de búsqueda. Por favor intenta de nuevo con palabras clave diferentes.', 'gob' ); ?></p>
            <div class="search-box-404" style="max-width: 500px; margin-top: 20px;">
                <?php get_search_form(); ?>
            </div>
        <?php else : ?>
            <p><?php esc_html_e( 'Parece que no podemos encontrar lo que buscas.', 'gob' ); ?></p>
        <?php endif; ?>
    </div>
</div>