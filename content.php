<?php
/**
 * Generic content template.
 *
 * For Webcomic-specific content, see `webcomic/content.php`/
 *
 * @package Inkblot
 */
?>

<article role="article" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<?php if (has_post_thumbnail()) : ?>
		
		<div class="post-image"><?php the_post_thumbnail(); ?></div><!-- .post-image -->
		
	<?php endif; ?>
	
	<header class="post-header">
		
		<?php if (is_single()) : ?>
			
			<h1><?php the_title(); ?></h1>
			
		<?php else : ?>
			
			<h2><a href="<?php echo the_permalink() . inkblot_default_query_parameters(__FILE__,__LINE__) ; ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			
		<?php endif; ?>
		
		<div class="post-details">
			
			<?php
				print inkblot_post_datetime();
				
				print inkblot_post_author();
				
				if ( ! post_password_required() and (comments_open() or get_comments_number())) :
					comments_popup_link();
				endif;
				
				edit_post_link(sprintf(__('Edit %1$s', 'inkblot'), '<span class="screen-reader-text">' . get_the_title() . '</span>'));
			?>
			
		</div>
	</header><!-- .post-header -->
	
	<?php if (is_search()) : ?>
		
		<div class="post-excerpt"><?php the_excerpt(); ?></div><!-- .post-excerpt -->
		
	<?php else : ?>
		
		<div class="post-content">
			
			<?php
				the_content();
				
				wp_link_pages(array(
					'before' => sprintf('<nav class="navigation pagination post" role="navigation" aria-label="%s"><div class="nav-links">', __('Post pages navigation', 'inkblot')),
					'after' => '</div></nav>',
					'pagelink' => sprintf('<span class="screen-reader-text">%s</span> %%', __('Page', 'inkblot'))
				));


			?>
			
		</div>
		
	<?php endif; ?>
	
	<footer class="post-footer">

<!-- @@@TODO AYAL no link to archive here maybe...
   <?php if (is_single()) : ?>

<a href="<?php echo home_url('/') . inkblot_default_query_parameters(__FILE__,__LINE__); ?>"><h1>Visit the archive</h1></a>

   <?php endif; ?>
--!>


		<?php


/*
			the_terms(get_the_ID(), 'category', sprintf('<span class="post-categories"><span class="screen-reader-text">%s </span>', __('Categories', 'inkblot')), __(', ', 'inkblot'), '</span>');
			the_tags(sprintf('<span class="post-tags"><span class="screen-reader-text">%s </span>', __('Tags', 'inkblot')), __(', ', 'inkblot'), '</span>');
*/

$allcats = wp_get_object_terms( get_the_ID(),  'category' );
$nrcats=count($allcats);


echo '<span class="post-categories"><span class="screen-reader-text">Categories </span>';
for ($i=0 ; $i<$nrcats ; $i++)
{
  if ($i > 0) {
    echo ', ';
  }
  echo '<a href="' . esc_url( get_term_link( $allcats[$i] )) . inkblot_default_query_parameters(__FILE__,__LINE__) . '" rel="tag">' . $allcats[$i]->name . '</a>';
}
echo '</span>';
echo "<p>";

		?>

		
	</footer><!-- .post-footer -->
	
</article><!-- #post-<?php the_ID(); ?> -->
