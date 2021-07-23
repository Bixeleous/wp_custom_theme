
<h2>Title</h2>
<input value="<?php esc_attr(the_title()); //getting the title ?>" >
<br/>
<br/>
<h2>Content</h2>
<textarea class="content" > <?php echo esc_attr(wp_strip_all_tags(get_the_content())) ?> </textarea>
<button data-post_id="<?php echo esc_attr($post->ID) ?>" class="edit_button">Edit</button>
<button data-post_id="<?php echo esc_attr($post->ID) ?>" class="delete_button">delete</button>
<hr>