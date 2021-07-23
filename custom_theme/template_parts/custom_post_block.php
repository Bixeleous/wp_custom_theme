

<h3><a href="<?php the_permalink() ?>"><?php esc_attr(the_title()); //getting the title ?></a></h3> 
<p class="content" > <?php  esc_attr(the_content()) ?> </p>
<button class="custom_post_button" id="<?php echo esc_attr($post->ID) ?>" >show info</button>
<hr>