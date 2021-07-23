
<h1><a href="<?php  the_permalink() ?>"><?php the_title(); ?></a></h1>
                <p><?php the_content(); ?></p>
                <!--  displays Author Name with link  -->
                <p><?php echo the_author_posts_link(); ?> </p>
                <!--  outputs only Author Name -> the_author();  -->
 <hr>