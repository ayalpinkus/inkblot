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

if ( is_null( $found_post ) && ! $renderall ){
  inkblot_welcome_to_archive();
}
else
{
  $canshow=true;
    
  $lastid = 0;
  if ( ! is_null( $found_post )) {
    $lastid = $found_post->ID;
  }




  $categories = get_the_category();
  $category_id = $categories[0]->cat_ID;

//			while (have_posts()) : the_post();

  $custom_query = new WP_Query( array( 'order' => 'asc', 'cat' => $category_id ) ); 
  while($custom_query->have_posts()) : $custom_query->the_post();

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


	?>
	
</main>

<?php get_sidebar(); get_footer();
