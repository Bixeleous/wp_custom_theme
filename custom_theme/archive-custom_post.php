<?php get_header(); ?>
<h1>Custom Posts</h1>
     <hr>
       
<?php

/* tweaking worpress default query */




        if ( have_posts() ) :
            /* Start the Loop */
            while ( have_posts() ) :
                the_post();
              

          get_template_part('./template_parts/custom_post_block_normal' ); 
                
               
              
           
            endwhile;

    echo paginate_links(); //support pagination

        endif;
     
        ?>

<?php get_footer(); ?>