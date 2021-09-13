<?php
/**
* The Functions Page
* @package WordPress
* @subpackage BFPUltimate
* @since BFPUltimate 1.0.0
**/

/** * Completely Remove jQuery From WordPress */
function my_init() {
    if (!is_admin()) {
        wp_deregister_script('jquery');
        wp_register_script('jquery', false);
    }
}
add_action('init', 'my_init');

/** * Completely Remove jQuery From WordPress Admin Dashboard */
add_action('wp_enqueue_scripts', 'no_more_jquery');
function no_more_jquery(){
    wp_deregister_script('jquery');
}


/* ======= Enqueue Scripts and Styles ======= */

function BFPUltimate_scripts_styles(){
  wp_enqueue_style('BFPUltimate-style', get_stylesheet_uri());
  wp_enqueue_style('BFPUltimate-all', get_template_directory_uri() . '/css/all.css');
  wp_enqueue_style('BFPUltimate-main', get_template_directory_uri() . '/css/general.min.css');
  wp_enqueue_script('BFPUltimate-progress', get_template_directory_uri() . '/js/progress-indicator.min.js','','', false);
  wp_enqueue_script('BFPUltimate-vivus', '//cdn.jsdelivr.net/npm/vivus@latest/dist/vivus.min.js','','', true);
  wp_enqueue_script('BFPUltimate-mainscript', get_template_directory_uri() . '/js/main-javascriptfile.min.js','','', true);
}
add_action('wp_enqueue_scripts', 'BFPUltimate_scripts_styles');

// Remove query string from static files
function remove_query_strings() {
   if(!is_admin()) {
       add_filter('script_loader_src', 'remove_query_strings_split', 15);
       add_filter('style_loader_src', 'remove_query_strings_split', 15);
   }
}

function remove_query_strings_split($src){
   $output = preg_split("/(&ver|\?ver)/", $src);
   return $output[0];
}
add_action('init', 'remove_query_strings');

function BFPUltimate_remove_version(){
  return '';
}
add_filter ('the_generator', 'BFPUltimate_remove_version');

function BFPUltimate_remove_head_links(){
  remove_action ('wp_head', 'rsd_link');
  remove_action ('wp_head', 'wlwmanifest_link');
  remove_action ('wp_head', 'wp_shortlink_wp_head');
  remove_action ('wp_head', 'rest_output_link_wp_head', 10);
  remove_action ('wp_head', 'wp_oembed_add_discovery_links', 10);
  remove_action ('template_redirect', 'rest_output_link_header', 11,0);
}
add_action('init', 'BFPUltimate_remove_head_links');

function disable_emojis(){
  remove_action('wp_head', 'print_emoji_detection_script', 7);
  remove_action('admin_print_scripts', 'print_emoji_detection_script');
  remove_action('wp_print_styles', 'print_emoji_styles');
  remove_action('the_content_feed', 'wp_staticize_emoji');
  remove_action('comment_text_rss', 'wp_staticize_emoji');
  remove_action('wp_mail', 'wp_staticize_emoji_for_email');
  remove_action('tiny_mce_plugins', 'disable_emojis_tinymce');
  remove_action('wp_resource_hints', 'disable_emojis_remove_dns_prefetch',10, 2);
}
add_action('init', 'disable_emojis');
/**
* Filter function to remove the tinymce emoji plugin
*/
function disable_emojis_tinymce($plugins){
  if (is_array($plugins)){
    return array_diff($plugins, array('wpemoji'));
  } else {
    return array();
  }
}

/**---==== Setup ====---**/
function BFPUltimate_setup(){
  add_theme_support('post-thumbnails', array('post'));
  add_theme_support('post-thumbnails', array('page'));
  add_theme_support('post-thumbnails');
  add_image_size('large', 700, '', true);
  add_image_size('medium', 250, '', true);
  add_image_size('small', 120, '', true);
}
add_action('after_setup_theme', 'BFPUltimate_setup');

// Filter except length to 25 words.
// tn custom excerpt length
function tn_custom_excerpt_length( $length ) {
return 25;
}
add_filter( 'excerpt_length', 'tn_custom_excerpt_length', 999 );

/* ======= Enable WebP =======*/
//enable upload for webp image files.
function webp_upload_mimes($existing_mimes) {
    $existing_mimes['webp'] = 'image/webp';
    return $existing_mimes;
}
add_filter('mime_types', 'webp_upload_mimes');

//enable preview / thumbnail for webp image files.
function webp_is_displayable($result, $path) {
    if ($result === false) {
        $displayable_image_types = array( IMAGETYPE_WEBP );
        $info = @getimagesize( $path );

        if (empty($info)) {
            $result = false;
        } elseif (!in_array($info[2], $displayable_image_types)) {
            $result = false;
        } else {
            $result = true;
        }
    }

    return $result;
}
add_filter('file_is_displayable_image', 'webp_is_displayable', 10, 2);

function BFPUltimate_widgets_init(){
  register_sidebar(array(
    'name'          => __('Sidebar', 'BFPUltimate'),
    'id'            => 'widget-area',
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
  ));
}
add_filter('widgets_text', 'do_shortcode');
add_action('widgets_init', 'BFPUltimate_widgets_init');

/* ======= CUSTOM NUMBERED PAGINATION ======= */

function pagination($pages = '', $range = 4){
	$showitems = ($range * 2)+1;
	global $paged;
	if(empty($paged)) $paged = 1;
	if($pages == ''){
		global $wp_query;
		$pages = $wp_query->max_num_pages;
		if(!$pages){
			$pages = 1;
		}
	}
	if(1 != $pages){
		echo "<div class=\"pagination\"><span>Page ".$paged." of ".$pages."</span>";
		if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo; First</a>";
		if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo; Previous</a>";
		
		for ($i=1; $i <= $pages; $i++){
			if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems)){
				echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
			}
		}
		if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">Next &rsaquo;</a>";
		if ($paged < $pages-1 && $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>Last &raquo;</a>";
		echo "</div>\n";
	}
}

/**
 * Add .js script if "Enable threaded comments" is activated in Admin
 * Codex: {@link https://developer.wordpress.org/reference/functions/wp_enqueue_script/}
 */
function BFPUltimate_enqueue_comments_reply() {

    if( is_singular() && comments_open() && ( get_option( 'thread_comments' ) == 1) ) {
        // Load comment-reply.js (into footer)
        wp_enqueue_script( 'comment-reply', '../../wp-includes/js/comment-reply', array(), false, true );
    }
}
add_action(  'wp_enqueue_scripts', 'BFPUltimate_enqueue_comments_reply' );


/* ======= Better Comments ======= */
require_once( get_template_directory() .'/better-comments.php' );

function filter_get_comment_author_url( $url, $id, $comment ) {
    return "";
}
add_filter( 'get_comment_author_url', 'filter_get_comment_author_url', 10, 3);
?>