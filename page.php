<?php

get_header();
?>

<main id="primary" class="site-main">

    <?php
    while ( have_posts() ) :
        the_post();
        ?>
        <section class="page-section">
            <div class="container">
                
                <?php if ( ! get_theme_mod('clach_page_hide_title', false) ) : ?>
                    <header class="page-header">
                        <h1 class="page-title"><?php the_title(); ?></h1>
                    </header>
                <?php endif; ?>

                <div class="page-content">
                    <?php the_content(); ?>
                </div>

            </div>
        </section>
    <?php
    endwhile;
    ?>

</main>

<?php
get_footer();