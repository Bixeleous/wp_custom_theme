<?php get_header(); ?> <!-- gets header -->
    <!-- <h1>front-page.php</h1> -->
      
    <!-- adding images using  get_theme_file_uri('image path') -->
   <!-- <div id="hero"  style="background-image: url('<?php // echo get_theme_file_uri('/images/test-image-1.jpg') ?>);" >    </div> -->
   <!-- <img src="<?php // echo get_theme_file_uri('/images/test-image-1.jpg') ?>">  -->

<?php
if ( have_posts() ) :/* Start the Loop */
while ( have_posts() ) : //wordpress loop - loop per post loaded on page
the_post(); //getting the post
?>

<h1><?php the_title(); //getting the title?></h1> 
<p><?php the_content(); //getting the content?></p>
<hr>
<?php
endwhile;
endif;?>


<!-- custom Query -->
<h2>Most Recent Custom Posts</h2>
<!--  custom Query loop -->
<?php



//creating a new instance of wordpress query based on "template" WP_Query

$home_page_Query_custom_post = new WP_Query(array(
'posts_per_page' => 4, //how many pages to bring
'post_type' => "custom_post", //'post-type' => "post" by default
//'category_name' => "test-category", //what category to bring


'post_type' => "custom_post",

//ordering which posts 
 //'orderby' => 'title', //- default 'post date'
 
 /*order Ascending or Descending , Default 'DESC' , other option 'ASC','rand','comment_count',
 order => 'meta_value'
'meta_key' = 'keyname'

Below some examples
 */

//'order' => 'ASC' 
/*
'orderby'   => 'meta_value_num', //meta_value_num and meta_value
'meta_key'  => 'test', //custom field we want
*/

//filtering the query ,  bring restults if KEY(1*) OPERATOR(1*) VALUE(1*), example test>2
/* 
'meta-query' => array(
    array(
        'key' => KEY(1*),
        'compare' => OPERATOR(1*),
        'value' => VALUE(1*),
    )
)
*/

/*
'orderby' => 'meta_value_num', //meta_value_num and meta_value
'meta_key'  => 'test', //custom field we want
'meta_query' => array(
    array(
        'key' => 'test', //key
        'compare' => '=', //comparison
        'value'   => '3', //value compare to key
        'type' => 'numeric', //type comparison
    )
)
*/
)); 


while ( $home_page_Query_custom_post->have_posts() ) : //wordpress loop - loop per post loaded on page
$home_page_Query_custom_post->the_post();
get_template_part('./template_parts/custom_post_block_normal' ); 
?>



   

<?php

endwhile;
    echo paginate_links(); //support pagination

wp_reset_postdata(); //cleaning up, after using custom query - setting back default variables 
?>

<!--get_post_type_archive_link( string $post_type )-->
<p><a href="<?php echo get_post_type_archive_link( 'custom_post') ?>">Read all user Posts</a></p>
  




<?php get_footer(); ?> <!-- gets footer -->