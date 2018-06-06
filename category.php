<?php
/**
 * Category archive template.
 *
 * For Webcomic-specific archives, see `webcomic/archive.php`.
 *
 * @package Inkblot
 * @see codex.wordpress.org/Template_Hierarchy
 */

get_header(); ?>

<main role="main">
	
	<?php if (have_posts()) : ?>
		
		<header class="page-header">
			<h1><?php single_cat_title(sprintf('<span class="screen-reader-text">%s </span>', __('Posts categoriezed as', 'inkblot'))); ?></h1>
		</header><!-- .page-header -->
		
		<?php if (category_description()) : ?>
			
			<div class="page-content"><?php print category_description(); ?></div><!-- .page-content -->
			
		<?php endif; ?>
		
		<?php



$renderall = inkblot_renderall();

$lastid = inkblot_lastpost_id();

/*@@@TODO remove?
$lastpost = inkblot_lastpost();
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
*/

if ( $lastid < 0 /*@@@TODO removeis_null( $found_post ) */ && ! $renderall ){
  inkblot_welcome_to_archive();
}
else
{
  $canshow=true;
    
/*@@@TODO remove?
  $lastid = 0;
  if ( ! is_null( $found_post )) {
    $lastid = $found_post->ID;
  }
*/




  $categories = get_the_category();
  $category_id = $categories[0]->cat_ID;



//global $wp_query;
//var_dump($wp_query->query_vars);
//var_dump($GLOBALS['wp_query']->query_vars['cat']);
//  global $wp_query;
//  echo "<p>QUERY = " . $GLOBALS['wp_the_query']->query_vars['cat'] . "</p>";


			while (have_posts()) : the_post();

/*
  $custom_query = new WP_Query( array( 'order' => 'asc', 'cat' => $category_id ) ); 
  while($custom_query->have_posts()) : $custom_query->the_post();
*/

    $post = get_post( $post );
    if ($renderall || $post->ID <= $lastid) {
      (webcomic() and is_a_webcomic())
        ? get_template_part('webcomic/content', get_post_type())
        : get_template_part('content', get_post_format());
    }
  endwhile;
		
  print inkblot_posts_nav(false, get_theme_mod('paged_navigation', true));
}

else:
  get_template_part('content', 'none');
endif;

  inkblot_show_afterword();



	?>
	
</main>

<?php get_sidebar(); get_footer();
