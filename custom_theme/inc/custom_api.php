<?php

add_action('rest_api_init', 'my_custom_api');

function my_custom_api(){
/*
  register_rest_route(arguementA,arguementB,arguementC)

  example example http://localhost/wp-app/wp-json/wp/v2/custom_post/ 

  arguementA -> namespace
   example: http://localhost/wp-app/wp-json/ namespace  /v2 <- part of the namespace, usually verison /custom_post/ 

  arguementB -> route , ending part of url
  example: http://localhost/wp-app/wp-json/wp/v2/ route

   arguementC -> array(
     'methods' => x, <- what to do , usually GET , WP_REST_SERVER::READABLE <-safest for wordpress
     'callback' => y <- function to return data
   )

  */

//"http://localhost/wp-app/wp-json/custom-api/v1/custom_post/"

  register_rest_route('custom-api/v1', 'custom_post',
   array(
     'methods' => WP_REST_SERVER::READABLE,
     'callback' => 'fetch_custom_api_data' //sends also data(1*) we can use
   ));
   }


function fetch_custom_api_data($data/* data(1*) */){



$post_type_results = array();

//wp query to get posts

/*if you want to query multiple post types the
'post_type' => array(postyype1,postyype2,postyype2)
*/

$custom_posts = new WP_Query(array(
  'post_type' => 'custom_post',
  'posts_per_page' => -1 ,
  'post_status' => array('draft','publish','pending','private'),
  'author' => get_current_user_id(),
  /*if you want to be extra carefull, sanitize the input*/
  //'s' => sanitize_text_field($data['search'])    //used for searching
));


//building an array to return and filter our query


while($custom_posts->have_posts()){
$custom_posts->the_post();
//adding data of post in our array

//getting the custom field , and if it is empty make it -> no value
$test;
if(get_post_meta( get_the_id(), 'test', true )!=""){
  $test = get_post_meta( get_the_id(), 'test', true );
  }else{
   $test = "no value";
  }

array_push($post_type_results, array(
  "title" => get_the_title(),
  "id" => get_the_id(),
  "author" => get_the_author(),
  "author_id" => get_the_author_id(),
  "test" => $test,
  'status' => get_post_status(),
));
}



//what to return
return( $post_type_results);
}


