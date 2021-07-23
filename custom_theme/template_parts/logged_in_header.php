<hr>
<div>You are logged in</div>
<?php
 $user_id = get_current_user_id();           //getting user id
 $display_name = get_display_name($user_id);  //getting user name by using user id and calling function 6(*)
?>
<div>User name: <?php   echo $display_name; ?></div>
<div>
  <span><?php /* showing current users gravatar */ echo get_avatar(get_current_user_id(),40); ?></span>
<a href="<?php echo esc_url(wp_logout_url()) ?>">Logout</a>
<a href="<?php echo esc_url(site_url('/my-posts')); ?>">See your own Posts</a>
</div>

<hr>
