<?php
get_header();
?>

<main id="primary" class="site-main">

    <div class="container">
        <?php get_template_part( 'template-parts/home', 'hero' ); ?>

        <?php if ( is_active_sidebar( 'home-widgets' ) ) : ?>
            <section class="home-widgets-section">
                <?php dynamic_sidebar( 'home-widgets' ); ?>
            </section>
        <?php endif; ?>
    </div>

</main>

<?php
get_footer();