<?php get_header(); ?>
<h1>Blog</h1>
     <hr>
       
<?php
        if ( have_posts() ) :
            /* Start the Loop */
            while ( have_posts() ) :
                the_post();
               
/* get_template_part(arguementA, arguementb);
arguement_A -> src - you don't need to include filetype(php)
 arguement_B(1*)-> special
*/
                get_template_part('./template_parts/article' ); 
                
                /*
                arguement_B(1*)
                you can make it dynamic 
                for example -> get_template_part('./template_parts/content' , get_post_type()); 
                and create files like
                content-custom_post_a.php
                content-custom_post_b.php
                */

            endwhile;
        endif;

        ?>

<?php get_footer(); ?>