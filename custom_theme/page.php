<?php get_header(); ?>
  <h1>Page.php</h1>
     <hr>
<?php
        if ( have_posts() ) :
            /* Start the Loop */
            while ( have_posts() ) :
                the_post();
                ?>
                <h1><?php the_title(); ?></h1>
                <p><?php the_content(); ?></p>
                <hr>
                <?php
            endwhile;
        endif;

        ?>

<?php get_footer(); ?>