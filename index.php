<?php
get_header();
?>

<main id="primary" class="site-main">

    <?php get_template_part( 'template-parts/home', 'hero' ); ?>

    <?php if ( is_active_sidebar( 'home-widgets' ) ) : ?>
        <section class="home-widgets-section">
            <div class="container">
                <?php dynamic_sidebar( 'home-widgets' ); ?>
            </div>
        </section>
    <?php endif; ?>

</main>

<?php
get_footer();