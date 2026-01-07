<?php
/**
 * Template part for displaying single posts.
 *
 * @package GobStyleTheme
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('page-section gov-single-article'); ?>>
    <div class="container">
        
        <header class="entry-header">
            <div class="entry-meta">
                <span class="posted-on">
                    <i class="far fa-calendar-alt"></i> <?php echo get_the_date(); ?>
                </span>
                <?php if ( has_category() ) : ?>
                    <span class="cat-links">
                        <i class="far fa-folder-open"></i> <?php the_category(', '); ?>
                    </span>
                <?php endif; ?>
            </div>

            <h1 class="entry-title"><?php the_title(); ?></h1>
            
            <div class="entry-divider"></div>
        </header>

        <div class="entry-content page-content">
            <?php
            the_content();

            wp_link_pages( array(
                'before' => '<div class="page-links">' . esc_html__( 'Páginas:', 'gob' ),
                'after'  => '</div>',
            ) );
            ?>
        </div>

        <footer class="entry-footer">
            <?php
            the_post_navigation( array(
                'prev_text' => '<span class="nav-label">' . esc_html__( 'Anterior', 'gob' ) . '</span><span class="nav-title">%title</span>',
                'next_text' => '<span class="nav-label">' . esc_html__( 'Siguiente', 'gob' ) . '</span><span class="nav-title">%title</span>',
            ) );
            ?>
        </footer>

    </div>
</article>