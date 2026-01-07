<?php
/**
 * The template for displaying search results pages.
 *
 * @package GobStyleTheme
 */

get_header();
?>

<main id="primary" class="site-main">

    <section class="page-section search-results-section">
        <div class="container">

            <?php if ( have_posts() ) : ?>

                <header class="page-header mb-4">
                    <h1 class="page-title">
                        <?php
                        printf( esc_html__( 'Resultados de búsqueda para: "%s"', 'gob' ), '<span class="search-query-highlight">' . get_search_query() . '</span>' );
                        ?>
                    </h1>
                    <div class="search-meta text-light">
                        <?php echo $wp_query->found_posts; ?> coincidencias encontradas
                    </div>
                </header>

                <div class="search-list">
                    <?php
                    while ( have_posts() ) :
                        the_post();
                        get_template_part( 'template-parts/content', 'search' );
                    endwhile;
                    ?>
                </div>

                <div class="pagination-wrapper">
                    <?php
                    the_posts_pagination( array(
                        'prev_text' => __( '<i class="fas fa-chevron-left"></i> Anterior', 'gob' ),
                        'next_text' => __( 'Siguiente <i class="fas fa-chevron-right"></i>', 'gob' ),
                        'screen_reader_text' => __( 'Navegación de resultados', 'gob' )
                    ) );
                    ?>
                </div>

            <?php else : ?>

                <?php get_template_part( 'template-parts/content', 'none' ); ?>

            <?php endif; ?>

        </div>
    </section>

</main>

<?php
get_footer();