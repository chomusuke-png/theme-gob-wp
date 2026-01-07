<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @package GobStyleTheme
 */

?>

<section id="post-<?php the_ID(); ?>" <?php post_class('page-section'); ?>>
    <div class="container">
        
        <?php if ( ! get_theme_mod('gob_page_hide_title', false) ) : ?>
            <header class="page-header">
                <h1 class="page-title"><?php the_title(); ?></h1>
            </header>
        <?php endif; ?>

        <div class="page-content">
            <?php the_content(); ?>
        </div>

    </div>
</section>