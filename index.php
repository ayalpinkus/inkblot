



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

If you change $renderall = false; to $renderall = true; in the line below, the code will revert to the default and show everything.

********************************************************/



$renderall = false;

$lastpost = $_GET[lastpost];


$found_post = null;

if ( $lastpost != "") {
  if ( $posts_search = get_posts( array( 
      'name' => $lastpost, 
      'post_type' => 'post',
      'post_status' => 'publish',
      'posts_per_page' => 1
  ) ) ) {
    $found_post = $posts_search[0];
  }
}

if ( is_null( $found_post ) && ! $renderall ){
  if ( $lastpost == "") {
    echo "<h1>Congratulations!</h1>You have come to the right place!<p>This is the archive for the @@@ comic. Please visit @@@Site Here@@@ to subscribe to my newsletter. I will send out a new episode for my webcomic every @@@, and as soon as you receive your first newsletter, you can read the episodes from the start on this website.</p>";
  }
  else
  {
    echo "<p style='font-size:36pt;'>Sorry, the post you are looking for was not found...</p>";
  }
}
else
{
  $canshow=true;

  $custom_query = new WP_Query('order=asc'); 
  if (have_posts()) :
    while($custom_query->have_posts()) : $custom_query->the_post();
    if ($canshow) {
      get_template_part('content', get_post_format());
    }

    $post = get_post( $post );
    $post_name = isset( $post->post_name ) ? $post->post_name : '';
    if ($post_name == $lastpost) {
      if (! is_null( $found_post )) {
	$canshow = $renderall;
      }
    }
    endwhile;
    print inkblot_posts_nav(false, get_theme_mod('paged_navigation', true));
  else :
    get_template_part('content', 'none');
  endif;
}


	?>
	
</main>

<?php get_sidebar(); get_footer();
