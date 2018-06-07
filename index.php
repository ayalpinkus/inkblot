
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<?php
/**
 * The main template file.
 *
 * If you're using Webcomic you'll want to look at `webcomic/home.php`.
 *
 * @package Inkblot
 * @see https://codex.wordpress.org/Template_Hierarchy
 */

get_header(); ?>

<main role="main">
	
	<?php

/*******************************************************

The following modifications require the viewr to pass ?lastpost=<post_name> in the url, and all posts from the post with that post name up to the first post will be shown.

If a post with post_name lastpost does not exist, no posts are shown.
This is designed to be an archive for webcomics, designed so that only people who know the link can read it up to that point.

when logged in as admin, you will see all posts.

********************************************************/



$renderall = inkblot_renderall();




/*@@@TODO remove?
$lastpost = inkblot_lastpost();
$found_post = null;
$lastid = -1;

if ( $lastpost != "") {
  if ( $posts_search = get_posts( array( 
      'name' => $lastpost, 
      'post_type' => 'post',
      'post_status' => 'publish',
      'posts_per_page' => 1
  ) ) ) {
    $found_post = $posts_search[0];
    $lastid = $found_post->ID;
  }
}
*/

$lastid = inkblot_lastpost_id();


if ( $lastid < 0 && ! $renderall ){
//  inkblot_w elcome_to_archive();
}
else
{
  $canshow=true;
  

  if (have_posts()) :
    while (have_posts()) : the_post();

/*
  $custom_query = new WP_Query(array ('order' => 'asc' , 'cat' => inkblot_content_category() )); 
  if (have_posts()) :
    while($custom_query->have_posts()) : $custom_query->the_post();
*/

    $post = get_post( $post );
    if ($renderall || $post->ID <= $lastid) {
      get_template_part('content', get_post_format());
    }
    endwhile;
    print inkblot_posts_nav(false, get_theme_mod('paged_navigation', true));
  else :
    get_template_part('content', 'none');
  endif;

  inkblot_show_afterword();
}


	?>
	
</main>

<?php get_sidebar(); get_footer();
