<?php
/* function (3*) */
//YOU HAVE TO REBUILD wordpress links after setting custom theme -> Permalinks and SAVE

//To set up single page ui responsible for loading custom post , create file single-custom_post.php
//To set up archive ui responsible for archive page (1*) ,  create file archive-custom_post.php
function custom_post_type(){

/*
register_post_type("arguementA,arguementB")
arguementA -> name
arguementB -> assosiative array that describes custom post type
more info -> https://developer.wordpress.org/reference/functions/register_post_type/
*/

//custom_post -> name on new custom post
register_post_type('custom_post', array(
  /* information about post type */
  'capability_type' => 'the_custom_post', //make it behave like it is not a generic post
  'map_meta_cap' => true, //requiere new capabilitites
'has_archive' => true , //if the post has an archive page (1*)
'public' => true , //makes it visible in admin if true
'show_ui' => true , //show in admin ui
'show_in_rest' => true , //show custom post in rest api
'menu_icon' => 'dashicons-embed-post', //icon in admin -> choose wordpress dashicons
'labels' => array( /* label info in admin */
  'name' => 'User Post', //name 
  'add_new_item' => 'Προσθήκη new User Post', //Προσθήκη 
  'edit_item' => 'Επεξεργασία User Post', // Επεξεργασία άρθρου -> 'Επεξεργασία User Post'
  'all_items' => 'Όλα τα User Posts',   // "προβολή όλων"
  'singular_name' => 'User Post',
),
'rewrite'=> array(
  'slug' => 'custom_posts', // rewritting the slug for the archive page (1*)
),
'supports'  => array( 
  'title',  //supports title
  'editor',  //supports editor
   'excerpt',  //supports excerpt
   'author',  //supports author
   'thumbnail',  //supports thumbnail
   'comments', //supports comments
  //  'revisions', 
   'custom-fields', //supports wp-custom fields
  ),



));

}



//function 6(*), adding new role for wordpress
function create_user_role(){
  /*
  add_role( arguementA, arguementB , arguementC );
  arguementA ->  Unique name of the role
  arguementB -> The name to be displayed
  arguementC -> capabilities - optional
  */
add_role( 'custom_user', 'User');
//getting the role and creating capabilities
$user_capabilities = get_role('custom_user');
//giving bare minimum access so they can enter wordpress backend
$user_capabilities -> add_cap('read'); 
//making them able to edit custom_post_type
$user_capabilities -> add_cap('edit_the_custom_post');
$user_capabilities -> add_cap('edit_the_custom_posts');
//if I want them to also change others
// $user_capabilities -> add_cap('edit_others_custom_post');
// $user_capabilities -> add_cap('edit_others_custom_posts');

$user_capabilities = get_role('administrator');
$user_capabilities -> add_cap('edit_the_custom_post');
$user_capabilities -> add_cap('edit_the_custom_posts');
 $user_capabilities -> add_cap('edit_others_the_custom_post');
$user_capabilities -> add_cap('edit_others_the_custom_posts');
$user_capabilities -> add_cap('edit_others_the_custom_posts');
$user_capabilities -> add_cap('edit_others_the_custom_publish_posts');
 $user_capabilities -> add_cap('publish_others_the_custom_post');
$user_capabilities -> add_cap('publish_others_the_custom_posts');
$user_capabilities -> add_cap('publish_the_custom_post');
$user_capabilities -> add_cap('publish_the_custom_posts');
 $user_capabilities -> add_cap('edit_published_blog');




}
?>