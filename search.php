<?php
/**
 * The template for displaying search results pages
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
                        /* translators: %s: search query. */
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
                        ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class('search-entry'); ?>>
                            <h2 class="entry-title">
                                <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
                            </h2>

                            <?php if ( 'post' === get_post_type() ) : ?>
                            <div class="entry-meta">
                                <span class="posted-on"><i class="far fa-calendar-alt"></i> <?php echo get_the_date(); ?></span>
                            </div>
                            <?php endif; ?>

                            <div class="entry-summary">
                                <?php the_excerpt(); ?>
                            </div>
                            
                            <a href="<?php the_permalink(); ?>" class="btn-read-more">Leer más <i class="fas fa-arrow-right"></i></a>
                        </article>
                        <?php
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

                <div class="no-results not-found">
                    <header class="page-header">
                        <h1 class="page-title"><?php esc_html_e( 'No se encontraron resultados', 'gob' ); ?></h1>
                    </header>

                    <div class="page-content">
                        <p><?php esc_html_e( 'Lo sentimos, pero no hay nada que coincida con tus términos de búsqueda. Por favor intenta de nuevo con palabras clave diferentes.', 'gob' ); ?></p>
                        <div class="search-box-404" style="max-width: 500px; margin-top: 20px;">
                            <?php get_search_form(); ?>
                        </div>
                    </div>
                </div>

            <?php endif; ?>

        </div>
    </section>

</main>

<?php
get_footer();