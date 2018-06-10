<?php
/**
 * Single post template.
 *
 * For single Webcomic posts, see `webcomic/single.php`.
 *
 * @package Inkblot
 * @see https://codex.wordpress.org/Template_Hierarchy
 */

get_header(); ?>

<main role="main">
	
	<?php
		while (have_posts()) : the_post();
			get_template_part('content', get_post_format());



inkblot_insert_story_child_categories();

$prev_post = get_previous_post();
$next_post = get_next_post();
/*
if ($next_post != null) {
  echo "<p>next post id is " . $next_post->ID . ", lastpost=" . inkblot_lastpost_id() . "<p>";
}
*/

//if (!current_user_can('administrator')) {
  if ($next_post->ID > inkblot_lastpost_id()) {
    $next_post = null;
  }
//}



  echo '	<nav class="navigation pagination" role="navigation">';
  echo '		<h2 class="screen-reader-text">Post navigation</h2>';

  if ($prev_post != null) {

    echo '<a class="inkblot-ace-arrow-container" href="' . get_permalink($prev_post->ID) . inkblot_default_query_parameters(__FILE__,__LINE__) . '" rel="prev"><div class="inkblot-ace-arrow-button" ><div class="arrow-left"></div> <div class="arrow-left"></div></div></a>';

  }
  else {
    echo '<div class="inkblot-ace-arrow-container">' . '<div class="inkblot-ace-arrow-button-disabled" ><div class="arrow-left"></div> <div class="arrow-left"></div></div>' . '</div>';
  }

//  echo '<div class="inkblot-ace-arrow-container"></div>' ;
//  echo '<div class="inkblot-ace-arrow-container"></div>' ;




/*
$refererislist = true;
if (strpos( $_SERVER['HTTP_REFERER'], 'index.php' ) !== false) {
  if (strpos( $_SERVER['HTTP_REFERER'], '/category/' ) == false && 
      strpos( $_SERVER['HTTP_REFERER'], '/author/' ) == false) {
    $refererislist = false;
  }
}
*/

//  $referer = $_GET['referer']; // $_SERVER['HTTP_REFERER']
  $referer = $_GET['referer']; // $_SERVER['HTTP_REFERER']

//echo '<p>referer = ' . $_SERVER['HTTP_REFERER'] . '<p>';
//echo '<p>referer = ' . $_GET['referer'] . '<p>';
//echo '<p>referer = ' . $referer . '<p>';

  if ($_GET['lastpost'] != "" && $referer != "") {

    echo '<a class="inkblot-ace-arrow-container" href="' . $referer  . inkblot_default_query_parameters(__FILE__,__LINE__) . '" rel="prev"><div class="inkblot-ace-arrow-button" >STORY MODE</div></a>';

  }
  else {
    echo '<div class="inkblot-ace-arrow-container">' . '</div>';
  }




  if ($next_post != null) {
    echo '<a class="inkblot-ace-arrow-container" href="' . get_permalink($next_post->ID) . inkblot_default_query_parameters(__FILE__,__LINE__) . '" rel="next"><div class="inkblot-ace-arrow-button" ><div class="arrow-right"></div> <div class="arrow-right"></div></div></a>';
  }
  else {
    echo '<div class="inkblot-ace-arrow-container">' . '<div class="inkblot-ace-arrow-button-disabled" ><div class="arrow-right"></div> <div class="arrow-right"></div></div>' . '</div>';
  }
  echo '	</nav>';

/*
  echo '	<nav class="navigation post-navigation" role="navigation">';
  echo '		<h2 class="screen-reader-text">Post navigation</h2>';
  echo '		<div class="nav-links">';
  if ($prev_post != null) {
    echo '<div class="nav-previous"><a href="' . get_permalink($prev_post->ID) . inkblot_default_query_parameters(__FILE__,__LINE__) . '" rel="prev"><span class="screen-reader-text">Previous post:  </span>' . get_the_title( $prev_post ) . '</a></div>';
  }

  if ($next_post != null) {
    echo '<div class="nav-next"><a href="' . get_permalink($next_post->ID) . inkblot_default_query_parameters(__FILE__,__LINE__) . '" rel="next"><span class="screen-reader-text">Next post:  </span>' . get_the_title( $next_post ) . '</a></div>';
  }
  echo '</div>';
  echo '	</nav>';
*/





/*		
			the_post_navigation(array(
				'next_text' => sprintf('<span class="screen-reader-text">%s </span>%%title', __('Next post: ', 'inkblot')),
				'prev_text' => sprintf('<span class="screen-reader-text">%s </span>%%title', __('Previous post: ', 'inkblot'))
			));
*/


			
			comments_template();
		endwhile;


	?>
	
</main>

<?php get_sidebar(); get_footer();
