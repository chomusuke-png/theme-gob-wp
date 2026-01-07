<?php
/**
 * Template part for displaying results in search pages.
 *
 * @package GobStyleTheme
 */

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