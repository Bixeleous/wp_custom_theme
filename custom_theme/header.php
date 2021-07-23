

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
      <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

   <meta charset="<?php bloginfo('charset'); ?>"> <!-- loading title -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
    <?php wp_head(); ?>     <!-- helps wordpress run scripts before opening body -->

</head>
<body <?php body_class(); ?>> <!-- body_class -> gives classes to body according to page  -->


<!-- reducing duplicate code example -->
<?php      title_function( //title_function in functions.php
                array(
                //    'title' => get_the_title(), //if you want custom title , give arguement
                //     'subtitle' => 'testing', //if you want custom subtitle , give arguement
                )
); ?>
<header>
<?php 

if(is_user_logged_in()){
get_template_part('./template_parts/logged_in_header');
 }else{
get_template_part('./template_parts/login_header' );
 }
?>
</header>
