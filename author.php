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

<p style="display:block; clear:both;"> </p>
		
		<?php





if ( $lastid < 0 && ! $renderall ){
  inkblot_welcome_to_archive();
}
else
{

  $canshow=true;


  $lastid = inkblot_lastpost_id();


//  if (have_posts()) :
    while (have_posts()) : the_post();


/*
  $custom_query = new WP_Query(array ('order' => 'asc' , 'cat' => inkblot_content_category() )); 
  while($custom_query->have_posts()) : $custom_query->the_post();
*/

    $post = get_post( $post );
    if ($renderall || $post->ID <= $lastid) {
      echo '<a href="' . get_permalink($post->ID) . inkblot_default_query_parameters(__FILE__,__LINE__) . '">';
      (webcomic() and is_a_webcomic())
      ? get_template_part('webcomic/content', get_post_type())
      : get_template_part('content', get_post_format());
      echo "</a>";
    }    
  endwhile;
  print inkblot_posts_nav(false, get_theme_mod('paged_navigation', true));
}


else:
  get_template_part('content', 'none');
endif;


  inkblot_list_all_content_child_categories();
  inkblot_show_afterword();

	?>
	
</main>

<?php get_sidebar(); get_footer();
