<?php

require get_theme_file_path('/inc/custom_api.php');


function custom_theme_rest_api(){
  /*
  register_rest_field(arguementA,arguementB,arguementC);
  arguementA -> post-type - exammple -> 'custom_post'
  arguementB -> field Name property you want to add - example -> 'Author_name'
 
  arguementC -> associative array
  array(
    'get_callback' => function(){
      return 'test';
    }
  )
  */

  //registering a field with name -> custom_field that contains all custom field
  register_rest_field('custom_post','custom_field', array( 
    'get_callback' => function($object){
        $post_id = $object['id']; //get the id of the post object array
        return get_post_meta( $post_id); //return the post meta
    },
    'schema' => null, 
 ));
}



/* function (1*) */
function theme_files(){

/*loading css files*/

/* next line be ommited if you don't put css there */
//wp_enqueue_style('theme_css', get_stylesheet_uri());

//wp_enqueue_style('style_index_css', get_theme_file_uri('/files/index_css.css')); //get_theme_file_uri() -> gets the src-directory of the current theme

//loading build css
wp_enqueue_style('style_index_css', get_theme_file_uri('/build/index.css')); //get_theme_file_uri() -> gets the src-directory of the current theme



/*to load something from external link wp_enqueue_style('name','link')*/

 $url_font_link = '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i'; //roboto font url
 wp_enqueue_style('custom-google-fonts', $url_font_link); //loading roboto font

/*load javascript*/
/*
wp_enqueue_script("arguementA,arguementB,arguementC")
arguementA -> name
arguementB -> file src
arguementC -> array (dependencies) , by default , false - exampe array('jquery')
*/


wp_enqueue_script('javascript_file', get_theme_file_uri('/build/index.js'), 'jquery' , false , true ); 


}


/* function (2*) */
function theme_features(){
 add_theme_support( 'title-tag' ); // enabling wordpress to get some data for title tag
 add_theme_support('post-thumbnails');  // post thumbnail support
}

/* function (4*)  manipulating $query object */ 
function adjust_queries($query){
  /* do this code only if
  A) frontent -> is_admin() = true if in admin dashboard
  B) is_post_type_archive('custom_post') -> only affect custom_post query type
  C) $query->is_main_query() -> query is not a custom query
  */

  /*
  if( !is_admin() AND is_post_type_archive('custom_post') AND $query->is_main_query() ){
  //$query->set('posts_per_page' , '5'); //example
  }
  */
}


/*creating function to reduce duplicate code */
 function title_function($args = NULL){ //$args -> arguements (you can name it whatever you want) , = NULL make arguement optionals

  // php logic here

if(!$args['title']){
$args['title'] = get_bloginfo('name');
 }

if(!$args['subtitle']){
$args['subtitle'] = get_bloginfo('description');
 }

?>

<h1><?php echo $args['title']; ?></h1>
<p><?php echo $args['subtitle']; ?></p>

<?php
 }






//function 6(*) getting user name
 function get_display_name($user_id) {
    if (!$user = get_userdata($user_id))
        return false;
    return $user->data->display_name;
}




//function 7(*) redirect subscriber account out of administrator area
function redirect_to_frontend(){
  $ourCurrentUser = wp_get_current_user(); //getting current user

  if ( (count($ourCurrentUser->roles) == 1) AND (($ourCurrentUser->roles[0]=="subscriber") || ($ourCurrentUser->roles[0]=="custom_user"))){
    wp_redirect(esc_url(get_site_url()));
    exit;
  }
}


//function 8(*) hide wp-admin bar for administrators
function hide_admin_bar(){
  $ourCurrentUser = wp_get_current_user(); //getting current user

  if ( (count($ourCurrentUser->roles) == 1) AND (($ourCurrentUser->roles[0]=="subscriber") || ($ourCurrentUser->roles[0]=="custom_user"))){
    //hide bar
    show_admin_bar(false);
  }
}

//function 9(*)
function new_header_url(){
    return esc_url(site_url('/'));
}

//function 10(*)
function ourLoginCss(){
  wp_enqueue_style('login_form', get_theme_file_uri('/wp_admin/login.css')); //get_theme_file_uri() -> gets the src-directory of the current theme
}


/*
add_action(arguementA,arguementB); 
arguementA -> when to run the function in arguementB
arguementB -> which function to run
*/



add_action( 'wp_enqueue_scripts', 'theme_files' ); //function (1*)  loading css - js
add_action('after_setup_theme', 'theme_features'); //function (2*)  supports to theme - ultity features 
add_action('init', 'custom_post_type');            //function (3*)  creating custom post , function (3*)  is in mu-plugins
add_action('init', 'create_user_role');            //function (6*)  creating custom role , function (6*)  is in mu-plugins
add_action('rest_api_init', 'custom_theme_rest_api');            //funtion (5*) making rest api show custom fields
add_action('pre_get_posts', 'adjust_queries');     //function (4*)  adjusting default wordpress queries
add_action('admin_init' , 'redirect_to_frontend');  //function (7*)  redirecting some user roles to homepage
add_action('wp_loaded' , 'hide_admin_bar');  //function (8*)  redirecting some user roles to homepage


/*
add_filter(arguementA,arguementB); 
arguementA -> filter hook you need
arguementB -> which function to run instead
*/

add_filter('login_headerurl', 'new_header_url'); //function (9*) customizing wordpress login screen

//how to load css in our login screen
add_action('login_enqueue_scripts','ourLoginCss'); //function (10*) loading our custom css file in login screen , by default site css doesn't load there