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



$renderall = false;

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


//			while (have_posts()) : the_post();

                        $custom_query = new WP_Query('order=asc'); 
                        while($custom_query->have_posts()) : $custom_query->the_post();

    if ($canshow) {
				(webcomic() and is_a_webcomic())
				? get_template_part('webcomic/content', get_post_type())
				: get_template_part('content', get_post_format());
    }

    $post = get_post( $post );
    $post_name = isset( $post->post_name ) ? $post->post_name : '';
 echo "post name = " . $post_name . ", lastpost=" . $lastpost;
    if ($post_name == $lastpost) {
      if (! is_null( $found_post )) {
	$canshow = $renderall;
      }
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
