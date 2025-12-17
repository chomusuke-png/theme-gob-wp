<?php
/**
 * Template Name: Página Estándar
 * Description: Plantilla principal para la visualización de páginas estáticas (Page).
 *
 * @package Clach_Theme
 * @since 1.0.0
 */

get_header();
?>

<main id="primary" class="site-main">

    <?php
    while ( have_posts() ) :
        the_post();
        ?>
        <section class="page-section">
            <div class="container">
                
                <header class="page-header">
                    <h1 class="page-title"><?php the_title(); ?></h1>
                </header>

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