



      <h3><a href="<?php the_permalink() ?>"><?php esc_attr(the_title()); //getting the title ?></a></h3>
      <p><?php the_excerpt(); ?></p>
      <!--  displays Author Name with link  -->
      <p><?php echo the_author_posts_link(); ?> </p>

<hr>