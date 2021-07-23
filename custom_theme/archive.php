<?php get_header(); ?>

     <hr>

     <h1><?php the_archive_title() ?></h1> <!-- archive title -->
      <p><?php the_archive_description() ?></p>


   <hr>
     
<?php
        if ( have_posts() ) :
            /* Start the Loop */

         
            while ( have_posts() ) :
                the_post();
                ?>
                <h1><a href="<?php  the_permalink() ?>"><?php the_title(); ?></a></h1>
                <p><?php the_content(); ?></p>
                <hr>
                <?php
            endwhile;




        endif;
     
        ?>

<?php get_footer(); ?>