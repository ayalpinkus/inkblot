<?php
/**
 * Inkblot theme functions.
 *
 * @package Inkblot
 */

/**
 * Set the content width.
 *
 * @var integer
 */
if ( ! isset($content_width)) {
	$content_width = get_theme_mod('content_width', 640);
}

require_once get_template_directory() . '/_/php/tags.php';
require_once get_template_directory() . '/_/php/walker-nav-dropdown.php';
require_once get_template_directory() . '/_/php/walker-page-dropdown.php';



if (is_admin() or is_customize_preview()) {
	require_once get_template_directory() . '/_/php/admin.php';
}

add_action('after_switch_theme', 'inkblot_after_switch_theme');
add_action('customize_preview_init', 'inkblot_customize_preview_init');
add_action('wp_head', 'inkblot_wp_head', 0);
add_action('wp_loaded', 'inkblot_wp_loaded', 0);
add_action('widgets_init', 'inkblot_widgets_init');
add_action('wp_enqueue_scripts', 'inkblot_wp_enqueue_scripts');
add_action('after_setup_theme', 'inkblot_after_setup_theme');
add_action('wp_footer', 'inkblot_wp_footer');

add_filter('body_class', 'inkblot_body_class', 10, 2);
add_filter('excerpt_more', 'inkblot_excerpt_more');
add_filter('the_content_more_link', 'inkblot_the_content_more_link');



add_action( 'pre_get_posts', 'inkblot_default_query' );

if ( ! function_exists('inkblot_default_query')) :
function inkblot_default_query( $query ) {
  $query->set( 'order', 'asc' );
  if (!is_admin()) {
    if (!isset( $query->query_vars[ 'inkblotcustom' ] ) && !is_category()) {
      $query->set( 'cat', inkblot_content_category() );
    }
  }
}
endif;


if ( ! function_exists('inkblot_after_switch_theme')) :
/**
 * Activation hook.
 */
function inkblot_after_switch_theme() {
	$content = get_theme_mod('content');
	
	if ($content and in_array($content, array(
		'two-column-left',
		'two-column-right',
		'three-column-left',
		'three-column-right',
		'three-column-center'
	))) {
		set_theme_mod('content', str_replace(array('-left', '-right', '-center'), array(' content-left', ' content-right', ' content-center'), $content));
	}
	
	if (get_theme_mod('uninstall')) {
		remove_theme_mods();
	}
}
endif;

if ( ! function_exists('inkblot_customize_preview_init')) :
/**
 * Enqueue dynamic preview script.
 */
function inkblot_customize_preview_init() {
	wp_register_script('automattic-color', get_template_directory_uri() . '/_/js/color.js');
	wp_enqueue_script('inkblot-customize-script', get_template_directory_uri() . '/_/js/customize.js', array('jquery', 'customize-preview', 'underscore', 'automattic-color'), '', true);
}
endif;

if ( ! function_exists('inkblot_wp_head')) :
/**
 * Render the <head> portion of the page.
 *
 * @uses inkblot_page_description()
 */
function inkblot_wp_head() { ?>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="description" content="<?php inkblot_page_description(); ?>">
	
	<?php if (get_theme_mod('responsive_width', 0) or is_customize_preview()) : ?>
		
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1">
		
	<?php endif; ?>
	
	<?php if (get_theme_mod('favicon')) : ?>
		
		<link rel="icon" href="<?php print get_theme_mod('favicon'); ?>">
		<link rel="apple-touch-icon" href="<?php print get_theme_mod('favicon'); ?>">
		<link rel="msapplication-TileImage" href="<?php print get_theme_mod('favicon'); ?>">
		
	<?php endif; ?>
	
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
	<?php
}
endif;

if ( ! function_exists('inkblot_wp_loaded')) :
/**
 * Generate theme modification stylesheet.
 */
function inkblot_wp_loaded() {
	if (isset($_GET['inkblot-mods'])) {
		header('Content-Type: text/css');
		
		require_once get_template_directory() . '/_/php/style.php';
		
		exit;
	}
}
endif;

if ( ! function_exists('inkblot_widgets_init')) :
/**
 * Register widgetized areas.
 */
function inkblot_widgets_init() {
	$sidebars = require get_template_directory() . '/_/php/sidebars.php';
	
	foreach ($sidebars as $id => $sidebar) {
		register_sidebar(array(
			'id' => 'sidebar-' . $id,
			'name' => $sidebar[0],
			'description' => $sidebar[1],
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h2>',
			'after_title' => '</h2>'
		));
	}
}
endif;

if ( ! function_exists('inkblot_wp_enqueue_scripts')) :
/**
 * Enqueue scripts and stylesheets.
 */
function inkblot_wp_enqueue_scripts() {
	wp_enqueue_style('inkblot-theme', get_stylesheet_uri());
	
	wp_add_inline_style('inkblot-theme', require get_template_directory() . '/_/php/style.php');
	
	if (get_theme_mod('font') or get_theme_mod('header_font') or get_theme_mod('page_font') or get_theme_mod('title_font') or get_theme_mod('trim_font')) {
		$fonts = array_filter(array(
			get_theme_mod('font'),
			get_theme_mod('header_font'),
			get_theme_mod('page_font'),
			get_theme_mod('title_font'),
			get_theme_mod('trim_font')
		));
		
		wp_enqueue_style('inkblot-font', add_query_arg(array('family' => implode('|', $fonts)), "https://fonts.googleapis.com/css"));
	}
	
	wp_enqueue_script('inkblot-script', get_template_directory_uri() . '/_/js/script.js', array('jquery'), '', true);
	
	if (is_singular() and comments_open() and get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
endif;

if ( ! function_exists('inkblot_after_setup_theme')) :
/**
 * Setup theme features.
 *
 * @uses Inkblot::$dir
 */
function inkblot_after_setup_theme() {
	load_theme_textdomain('inkblot', get_template_directory() . '/_/l10n');
	
	add_editor_style(get_stylesheet_uri());
	
	if (get_theme_mod('font') or get_theme_mod('page_font') or get_theme_mod('title_font')) {
		foreach (array_filter(array(
			get_theme_mod('font'),
			get_theme_mod('page_font'),
			get_theme_mod('title_font')
		)) as $font) {
			add_editor_style(add_query_arg(array('family' => $font), "https://fonts.googleapis.com/css"));
		}
	}
	
	add_editor_style(add_query_arg(array('inkblot-mods' => 'editor'), home_url('/') . inkblot_default_query_parameters(__FILE__,__LINE__)));
	
	add_filter('use_default_gallery_style', '__return_false');
	add_filter('show_recent_comments_widget_style', '__return_false');
	
	add_theme_support('menus');
	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');
	add_theme_support('automatic-feed-links');
	add_theme_support('html5', array('caption', 'comment-list', 'comment-form', 'gallery', 'search-form'));
	add_theme_support('post-formats', array('aside', 'audio', 'chat', 'gallery', 'image', 'link', 'status', 'quote', 'video'));
	add_theme_support('custom-background', array(
		'default-color' => 'ffffff',
		'wp-head-callback' => '__return_false'
	));
	add_theme_support('custom-header', array(
		'width' => get_theme_mod('header_width', 960),
		'height' => get_theme_mod('header_height', 240),
		'flex-width' => true,
		'flex-height' => true,
		'wp-head-callback' => '__return_false',
		'default-text-color' => '222',
		'admin-head-callback' => 'inkblot_admin_head',
		'admin-preview-callback' => 'inkblot_admin_head_preview'
	));
	
	register_nav_menu('primary', __('Primary Menu', 'inkblot'));
	
	set_post_thumbnail_size(get_theme_mod('post_thumbnail_width', 144), get_theme_mod('post_thumbnail_height', 144));
}
endif;

if ( ! function_exists('inkblot_wp_footer')) :
/**
 * Add a customization element to the bottom of the page.
 *
 * This element has a number of data attributes that are used to keep things
 * consistent while customizing the theme.
 */
function inkblot_wp_footer() {
	if (is_customize_preview()) :
		$mod = require get_template_directory() . '/_/php/mods.php'; ?>
		
		<wbr class="inkblot"
			<?php foreach ($mod as $key => $default) : ?>
				
				data-<?php print str_replace('_', '-', $key); ?>="<?php print get_theme_mod($key, $default); ?>"
				
			<?php endforeach; ?>
		>
		<?php
	endif;
}
endif;

if ( ! function_exists('inkblot_body_class')) :
/**
 * Add the content class to the body tag.
 *
 * Also adds Webcomic-specific classes for easier styling.
 *
 * @param array $classes Array of body classes.
 * @param mixed $class Additional classes passed to `body_class()`.
 * @return array
 */
function inkblot_body_class($classes, $class) {
	$classes[] = get_theme_mod('content', 'one-column');
	
	if (get_theme_mod('responsive_width', 0) or is_customize_preview()) {
		$classes[] = 'responsive';
	}
	
	if (webcomic()) {
	  if (is_webcomic_collection()) {
		  $classes[] = 'post-type-archive-webcomic';
	  }

	  if (function_exists('is_webcomic_storyline')) {
	    if (is_webcomic_storyline()) {
	      $classes[] = 'tax-webcomic_storyline';
	    }
	  }

	  if (function_exists('is_webcomic_character')) {
	    if (is_webcomic_character()) {
	      $classes[] = 'tax-webcomic_character';
	    }
	  }
	}
	
	return $classes;
}
endif;

if ( ! function_exists('inkblot_excerpt_more')) :
/**
 * Return a more accessible read more link.
 *
 * @return string
 */
function inkblot_excerpt_more() {
	return '&#8230; <a href="' . get_permalink()  . inkblot_default_query_parameters(__FILE__,__LINE__) . '" class="more-link">' . sprintf(__('Continue reading %1$s', 'inkblot'), '<span class="screen-reader-text">' . get_the_title() . '</span>') . '</a>';
}
endif;

if ( ! function_exists('inkblot_the_content_more_link')) :
/**
 * Return a more accessible read more link.
 *
 * @return string
 */
function inkblot_the_content_more_link() {
	return '<a href="' . get_permalink() . inkblot_default_query_parameters(__FILE__,__LINE__) . '" class="more-link">' . sprintf(__('Continue reading %1$s', 'inkblot'), '<span class="screen-reader-text">' . get_the_title() . '</span>') . '</a>';
}
endif;




if ( ! function_exists('inkblot_renderall')) :
function inkblot_renderall() {
  $renderall = false;
/*
  if( current_user_can('administrator')) {
    $renderall = true;
    echo "<div style='display:block; clear:both; background:#f8f8f8; min-height:1in; font-size:24pt; padding-bottom:0.25in; padding-top:0.25in;'><b>NOTE:</b> you are logged in as administrator of this site, and the administrator can see all posts. You you may see something that is different from what regular visitors see.<hr></div><p style='clear:both;'>";
  }
*/
  return $renderall;
}
endif;











if ( ! function_exists('inkblot_welcome_to_archive')) :
function inkblot_welcome_to_archive() {
  $lastpost = inkblot_lastpost();
//  if ( $lastpost == "") {
    $custom_query = new WP_Query(array ('order' => 'asc' , 'cat' => inkblot_welcome_category(), 'inkblotcustom' => 'true' )); 
    if ($custom_query->have_posts()) :
      while($custom_query->have_posts()) : $custom_query->the_post();
	get_template_part('content', get_post_format());
      endwhile;
      //print inkblot_posts_nav(false, get_theme_mod('paged_navigation', true));
    else :
      echo "<h1>Welcome!</h1>To the maintainer of this site: you can create posts filed under the category 'welcome' and they will show here instead of this text.<p>You can also file posts under the category 'afterword' to specify a call to action to be placed below lists of posts.<p>Posts filed under the category 'story' will be included in the lists of posts. You can, of you want, also add these posts to categories that are sub-categories of the 'story' category. These sub-categories could represent chapters.<p>Visitors can not see posts by default. If you go to the admin area, and click on the permalink of a post, you can share the url in the url bar of the browser, and people will be able to see all posts upto that post.<p>This theme is meant to be used as an archive for a newsletter, allowing people to see all posts upto a specified point.<p>";
    endif;
/*
  }
  else
  {
    echo "<p style='font-size:36pt;'>Sorry, the post you are looking for was not found...</p>";
  }
*/
}
endif;



if ( ! function_exists('inkblot_content_category')) :
function inkblot_content_category() {
  return get_cat_ID('story');
}
endif;


if ( ! function_exists('inkblot_welcome_category')) :
function inkblot_welcome_category() {
  return get_cat_ID('welcome');
}
endif;


if ( ! function_exists('inkblot_afterword_category')) :
function inkblot_afterword_category() {
  return get_cat_ID('afterword');
}
endif;

if ( ! function_exists('inkblot_show_afterword')) :
function inkblot_show_afterword() {
  $custom_query = new WP_Query(array ('order' => 'asc' , 'cat' => inkblot_afterword_category(), 'inkblotcustom' => 'true' )); 
  if ($custom_query->have_posts()) :
    while($custom_query->have_posts()) : $custom_query->the_post();
      get_template_part('content', get_post_format());
    endwhile;
//    print inkblot_posts_nav(false, get_theme_mod('paged_navigation', true));
  else :
    echo "<h1>THE END</h1>";
    echo "<h2>To the maintainer of this site: you can add posts filed under the category 'afterword', and it will show here instead of this text.</h2>";
  endif;
}
endif;







if ( ! function_exists('inkblot_referer')) :
function inkblot_referer() {
  $referer = '';
  if (array_key_exists ( 'referer' , $_GET )) {
    $referer = urldecode( $_GET['referer'] ); 
    $referer = str_replace('<', '', $referer);
    $referer = str_replace('>', '', $referer);
    if (strlen($referer) > 0) {
      if ($referer[0] != '/') {
	$referer='';
      }
    }
  }
  return $referer;
}
endif;







if ( ! function_exists('inkblot_lastpost')) :
function inkblot_lastpost() {
  $lastpost = "";
  if (array_key_exists ( 'lastpost' , $_GET )) {
    $lastpost = $_GET['lastpost'];
    $lastpost = str_replace('<', '', $lastpost);
    $lastpost = str_replace('>', '', $lastpost);
  }
  return $lastpost;
}
endif;

if ( ! function_exists('inkblot_lastpost_id')) :
function inkblot_lastpost_id() {
  $lastpost = inkblot_lastpost();

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
  return $lastid;
}
endif;













if ( ! function_exists('inkblot_insert_story_child_categories')) :
function inkblot_insert_story_child_categories() {
//  echo "<br>";

  $allcats = wp_get_object_terms( get_the_ID(),  'category' );
  $nrcats=count($allcats);
  echo '<span class="post-categories"><span class="screen-reader-text">Categories </span>';
  $j=0;
  $parentcat = inkblot_content_category();

  for ($i=0 ; $i<$nrcats ; $i++) {
    if (cat_is_ancestor_of( $parentcat, $allcats[$i] )) {
      if ($j > 0) {
        echo ', ';
      }
      $j = $j + 1;
      echo '<a href="' . esc_url( get_term_link( $allcats[$i] )) . inkblot_default_query_parameters(__FILE__,__LINE__) . '" rel="tag">' . $allcats[$i]->name . '</a>';
    }
  }
  echo '</span>';

//  echo "<br>";
}
endif;




if ( ! function_exists('inkblot_list_all_content_child_categories')) :
function inkblot_list_all_content_child_categories() {


  $allcats = get_categories(array('child_of' => inkblot_content_category(), 'hide_empty' => 0));
  $nrcats=count($allcats);

  for ($i=0 ; $i<$nrcats ; $i++) {
    if ($i > 0) {
      echo ', ';
    }
    echo '<a href="' . esc_url( get_term_link( $allcats[$i] )) . inkblot_default_query_parameters(__FILE__,__LINE__) . '" rel="tag">' . $allcats[$i]->name . '</a>';
  }



}
endif;






add_filter( 'comment_post_redirect', 'inkblot_redirect_comments', 10,2 );
function inkblot_redirect_comments( $location, $commentdata ) {

  return wp_get_referer() . inkblot_default_query_parameters(__FILE__,__LINE__);
/*
  if(!isset($commentdata) || empty($commentdata->comment_post_ID) ){
    return $location;
  }
  $post_id = $commentdata->comment_post_ID;
  if('my-custom-post' == get_post_type($post_id)){
    return wp_get_referer()."#comment-".$commentdata->comment_ID;
  }
  return $location;
*/
}






function wpb_disable_feed() {
wp_die( __('No feed available because this is an archive you should only be able to access if you have the right link. Please visit our <a href="'. get_bloginfo('url') .'">homepage</a> for more information.') );
}
 
add_action('do_feed', 'wpb_disable_feed', 1);
add_action('do_feed_rdf', 'wpb_disable_feed', 1);
add_action('do_feed_rss', 'wpb_disable_feed', 1);
add_action('do_feed_rss2', 'wpb_disable_feed', 1);
add_action('do_feed_atom', 'wpb_disable_feed', 1);
add_action('do_feed_rss_comments', 'wpb_disable_feed', 1);
add_action('do_feed_rss2_comments', 'wpb_disable_feed', 1);
add_action('do_feed_atom_comments', 'wpb_disable_feed', 1);


