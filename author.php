<?php
/**
 * Author archive template.
 *
 * For Webcomic-specific archives, see `webcomic/archive.php`.
 *
 * @package Inkblot
 * @see codex.wordpress.org/Template_Hierarchy
 */

get_header(); ?>

<main role="main">


        <?php $renderall = inkblot_renderall(); ?>

	<?php if (have_posts()) : ?>

		<header class="page-header">
			<h1><?php printf(__('<span class="screen-reader-text">%s </span>%s'), __('Posts authored by', 'inkblot'), apply_filters('the_author', get_the_author_meta('display_name'))); ?></h1>
		</header><!-- .page-header -->

		
		<?php if (get_avatar(get_the_author_meta('user_email'))) : ?>
			
			<div class="page-image"><?php print get_avatar(get_the_author_meta('user_email'), 128); ?></div><!-- .page-image -->
			
		<?php endif; ?>
		
		<?php if (get_the_author_meta('description')) : ?>
			
			<div class="page-content"><?php the_author_meta('description'); ?></div><!-- .page-content -->
			
		<?php endif; ?>
		
		<?php


$lastpost = $_GET['lastpost'];

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




  $custom_query = new WP_Query(array ('order' => 'asc' , 'cat' => inkblot_content_category() )); 
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


  inkblot_show_afterword();

	?>
	
</main>

<?php get_sidebar(); get_footer();
