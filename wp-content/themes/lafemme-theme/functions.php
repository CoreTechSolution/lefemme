<?php
add_theme_support('woocommerce');

function theme_styles() {
	wp_enqueue_style( 'bootstrap_css', get_template_directory_uri() . '/assets/css/bootstrap.min.css' );
	wp_enqueue_style( 'custom-google-fonts', 'https://fonts.googleapis.com/css?family=Montserrat:200,300,400,500,600,700|Open+Sans:300,400,600,700|Raleway:300,400,500,600|Roboto:100,300,400,500,700|Lato:100,300,400,700', false );
	wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css', false );
	wp_enqueue_style( 'main_css', get_stylesheet_uri() );
	wp_enqueue_style( 'fancybox_css', get_template_directory_uri() . '/assets/css/jquery.fancybox.css' );
	wp_enqueue_style( 'slicknav_css', get_template_directory_uri() . '/assets/css/slicknav.css' );
	wp_enqueue_style( 'jquery_bxslider_css', get_template_directory_uri() . '/assets/css/jquery.bxslider.css' );
	wp_enqueue_style( 'animate_css', get_template_directory_uri() . '/assets/css/animate.css' );
	wp_enqueue_style( 'datetimepicker_css', get_template_directory_uri() . '/assets/css/jquery.datetimepicker.css' );

	wp_enqueue_style( 'styleMax1920_css', get_template_directory_uri() . '/assets/css/styleMax1920.css', array(),(mt_rand(10,100)),'only screen and (max-width: 1920px) and (min-width: 1900px)');
	wp_enqueue_style( 'styleMax1680_css', get_template_directory_uri() . '/assets/css/styleMax1680.css', array(),(mt_rand(10,100)),'only screen and (max-width: 1690px) and (min-width: 1650px)');
	wp_enqueue_style( 'styleMax1600_css', get_template_directory_uri() . '/assets/css/styleMax1600.css', array(),(mt_rand(10,100)),'only screen and (max-width: 1620px) and (min-width: 1590px)');
	wp_enqueue_style( 'styleMax1440_css', get_template_directory_uri() . '/assets/css/styleMax1440.css', array(),(mt_rand(10,100)),'only screen and (max-width: 1450px) and (min-width: 1430px)');
	wp_enqueue_style( 'styleMax1280_css', get_template_directory_uri() . '/assets/css/styleMax1280.css', array(),(mt_rand(10,100)),'only screen and (max-width: 1290px) and (min-width: 1270px)');	
	wp_enqueue_style( 'styleMax1024_css', get_template_directory_uri() . '/assets/css/styleMax1024.css', array(),(mt_rand(10,100)),'only screen and (max-width: 1025px) and (min-width: 993px)');
	wp_enqueue_style( 'styleMax992_css', get_template_directory_uri() . '/assets/css/styleMax992.css', array(),(mt_rand(10,100)),'only screen and (max-width: 992px) and (min-width: 769px)');
	wp_enqueue_style( 'styleMax768_css', get_template_directory_uri() . '/assets/css/styleMax768.css', array(),(mt_rand(10,100)),'only screen and (max-width: 768px) and (min-width: 481px)');
	wp_enqueue_style( 'styleMax480_css', get_template_directory_uri() . '/assets/css/styleMax480.css', array(),(mt_rand(10,100)),'only screen and (max-width: 480px) and (min-width: 321px)');
	wp_enqueue_style( 'styleMax320_css', get_template_directory_uri() . '/assets/css/styleMax320.css', array(),(mt_rand(10,100)),'only screen and (max-width: 320px)');
}
add_action( 'wp_enqueue_scripts', 'theme_styles');

function theme_js() {
	global $wp_scripts;
	wp_enqueue_script( 'html5_js', get_template_directory_uri() . '/assets/js/html5.js');
	wp_enqueue_script( 'bootstrap_js', get_template_directory_uri() . '/assets/js/bootstrap.min.js');
	wp_enqueue_script( 'my_custom_js', get_template_directory_uri() . '/assets/js/jquery.fancybox.pack.js');
	wp_enqueue_script( 'fancybox_media_js', get_template_directory_uri() . '/assets/js/helpers/jquery.fancybox-media.js');
	wp_enqueue_script( 'slicknav_js', get_template_directory_uri() . '/assets/js/jquery.slicknav.js');
	wp_enqueue_script( 'jquery_matchHeight_min_js', get_template_directory_uri() . '/assets/js/jquery.matchHeight-min.js');
	wp_enqueue_script( 'jquery_bxslider_min_js', get_template_directory_uri() . '/assets/js/jquery.bxslider.min.js');
	wp_enqueue_script( 'jquery_wow_min_js', get_template_directory_uri() . '/assets/js/wow.min.js');
	wp_enqueue_script( 'jquery_datetimepicker_js', get_template_directory_uri() . '/assets/js/jquery.datetimepicker.js');
	wp_enqueue_script( 'jquery_validate_js', get_template_directory_uri() . '/assets/js/jquery.validate.min.js');
	wp_enqueue_script( 'jquery_additional_js', get_template_directory_uri() . '/assets/js/additional-methods.js');
	wp_enqueue_script( 'jquery_lazy_js', get_template_directory_uri() . '/assets/js/jquery.lazy.min.js');

	wp_enqueue_script( 'theme_script_js', get_template_directory_uri() . '/assets/js/theme.script.js');
	wp_localize_script( 'theme_script_js', 'MyAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
}
add_action( 'wp_enqueue_scripts', 'theme_js');

add_filter('wp_mail_from_name', 'new_mail_from_name'); 
function new_mail_from_name($old) {
	$site_title = get_bloginfo( 'name' );
	return $site_title;
}

register_nav_menus( array(
    'mainmenu' => __( 'Main Menu'),
    'footer_navigation' => __('Footer Navigation')
));

register_sidebar(array('name'=>'Blog Sidebar',
'id' => 'blog_sidebar',
'before_widget' => '<div class="sidebar_content %2$s">',
'after_widget' => '</div>',
'before_title' => '<h2>',
'after_title' => '</h2>',
));

register_sidebar(array('name'=>'Newsletter',
'id' => 'newsletter',
'before_widget' => '<div class="newsletter_wrapper %2$s">',
'after_widget' => '</div>',
'before_title' => '<h3>',
'after_title' => '</h3>',
));
register_sidebar(array('name'=>'Shop Sidebar',
                       'id' => 'shop_sidebar',
                       'before_widget' => '<div class="shop_sidebar">',
                       'after_widget' => '</div></div>',
                       'before_title' => '<h2>',
                       'after_title' => '</h2><div class="shop_sidebar_content">',
));
register_sidebar(array('name'=>'Cart Dropdown',
                       'id' => 'dropdown_cart',
                       'before_widget' => '<div class="dropdown_cart woocommerce">',
                       'after_widget' => '</div>',
                       'before_title' => '<h2 style="display: none;">',
                       'after_title' => '</h2>',
));

function encripted($data){
	$key1 = '644CBEF595BC9';
	$final_data = $key1.'|'.$data;
	$val = base64_encode(base64_encode(base64_encode($final_data)));
	return $val;
}
function decripted($data){
	$val = base64_decode(base64_decode(base64_decode($data)));
	$final_data = explode('|', $val);
	return $final_data[1];
}

add_theme_support( 'post-thumbnails' );

add_image_size( 'blog-big-thumb', 399, 551, array('center', 'top') );
add_image_size( 'blog-small-thumb', 230, 178, array('center', 'top') );

add_image_size( 'pro-thumbnail', 170, 170, array('center', 'top') );
add_image_size( 'img_480_360', 480, 360, array('center', 'top') );
add_image_size( 'img_360_450', 360, 450, array('center', 'top') );

function content($limit, $postid) {
    $post = get_page($postid);
    $fullContent = $post->post_content; 
    $content = explode(' ', $fullContent, $limit);
    if (count($content)>=$limit) {
		array_pop($content);
		$content = implode(" ",$content).'...';
    } else {
		$content = implode(" ",$content);
    }
    $content = preg_replace('/\[.+\]/','', $content);
    $content = str_replace(']]>', ']]&gt;', $content);
    return $content;
}

function excerpt($limit) {
	$excerpt = explode(' ', get_the_excerpt(), $limit);
	if (count($excerpt)>=$limit) {
		array_pop($excerpt);
		$excerpt = implode(" ",$excerpt).'...';
	} else {
		$excerpt = implode(" ",$excerpt);
	}
	$excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
	return $excerpt;
}
if (!current_user_can('administrator')):
	show_admin_bar(false);
endif;
function get_locked_counter(){
	global $wpdb;
	$lock_date = date('Y-m-d H:i:s');
	$ip = $_SERVER['REMOTE_ADDR'];
	$table_name = $wpdb->prefix.'ip_lock';
	$query = "SELECT * FROM $table_name WHERE ip = '".$ip."'";
	$result = $wpdb->get_row($query);
	$start_date = new DateTime($result->locking_time);
	$since_start = $start_date->diff(new DateTime($lock_date));
	$total_min = $since_start->i;
	if($total_min > 10){
		$query2 = "UPDATE $table_name SET attempts = 0 WHERE ip = '".$ip."'";
		$wpdb->query($query2);
		return 0;
	} else {
		return $result->attempts;
	}
}
function update_locked_counter(){
	global $wpdb;
	$lock_date = date('Y-m-d H:i:s');
	$ip = $_SERVER['REMOTE_ADDR'];
	$table_name = $wpdb->prefix.'ip_lock';
	$query = "SELECT * FROM $table_name WHERE ip = '".$ip."'";
	$result = $wpdb->get_row($query);
	$attempts = $result->attempts + 1;
	if($result->ip == $ip){
		$query2 = "UPDATE $table_name SET locking_time = '".$lock_date."', attempts = ".$attempts." WHERE ip = '".$ip."'";
	} else {
		$query2 = "INSERT INTO $table_name (ip, locking_time, attempts) VALUES('".$ip."', '".$lock_date."', '".$attempts."')";
	}
	$result = $wpdb->query($query2);
}
function the_excerpt_max_charlength($charlength) {
	$excerpt = get_the_excerpt();
	$charlength++;
	if ( mb_strlen( $excerpt ) > $charlength ) {
		$subex = mb_substr( $excerpt, 0, $charlength - 5 );
		$exwords = explode( ' ', $subex );
		$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
		if ( $excut < 0 ) {
			echo mb_substr( $subex, 0, $excut );
		} else {
			echo $subex;
		}
		echo '...';
	} else {
		echo $excerpt;
	}
}
function get_the_excerpt_max_charlength($charlength) {
	$excerpt = get_the_excerpt();
	$content = '';
	$charlength++;
	if ( mb_strlen( $excerpt ) > $charlength ) {
		$subex = mb_substr( $excerpt, 0, $charlength - 5 );
		$exwords = explode( ' ', $subex );
		$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
		if ( $excut < 0 ) {
			$content = mb_substr( $subex, 0, $excut );
		} else {
			$content = $subex;
		}
		$content = '...';
	} else {
		$content = $excerpt;
	}
	return $content;
}
function the_excerpt_max_charlength_by_content($charlength, $content) {
	$excerpt = $content;
	$charlength++;
	if ( mb_strlen( $excerpt ) > $charlength ) {
		$subex = mb_substr( $excerpt, 0, $charlength - 5 );
		$exwords = explode( ' ', $subex );
		$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
		if ( $excut < 0 ) {
			echo mb_substr( $subex, 0, $excut );
		} else {
			echo $subex;
		}
		echo '...';
	} else {
		echo $excerpt;
	}
}
add_image_size( 'product-thumb', 400, 400, array('center', 'top') );
add_image_size( 'product-thumb-inner', 280, 385, array('center', 'top') );
add_image_size( 'product-slider-thumb', 183, 250, array('center', 'top') );
add_image_size( 'product-small-thumb', 60, 80, array('center', 'top') );
add_image_size( 'propop-thumb', 250, 250, array('center', 'top') );
add_image_size( 'thumb_349_523', 349, 523, array('center', 'top') );

/**
 * Custom callback for outputting comments
 *
 * @return void
 * @author Keir Whitaker
 */
function bootstrap_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	?>
	<?php if ( $comment->comment_approved == '1' ): ?>
        <li class="media">
        <div class="media-left">
			<?php echo get_avatar( $comment ); ?>
        </div>
        <div class="media-body">
            <h4 class="media-heading">
				<?php comment_author_link() ?>
            </h4>
            <time>
                <a href="#comment-<?php comment_ID() ?>" pubdate>
					<?php comment_date() ?> at <?php comment_time() ?>
                </a>
            </time>
			<?php comment_text() ?>
        </div>
	<?php endif;
}

if (!current_user_can('administrator')):
    show_admin_bar(false);
endif;

function mytheme_setup() {
	update_option('image_default_align', 'center' );
	update_option('image_default_link_type', 'none' );
	update_option('image_default_size', 'large' );
}

function get_user_role($userid){ 
	$user_info = get_userdata($userid);
 	$role = implode(', ', $user_info->roles);
 	return $role;
}

require_once dirname( __FILE__ ) . '/frameworks/tgm/class-tgm-plugin-activation.php';
require_once dirname( __FILE__ ) . '/frameworks/tgm/tgm-activation-config.php';

/*require_once dirname( __FILE__ ) . '/frameworks/redux/ReduxCore/framework.php';
require_once dirname( __FILE__ ) . '/frameworks/redux/admin-config.php';*/

//**********************************************
//
// Usage 
// [grid_section]
// [grid_col size=""]content[/grid_col]
// [/grid_section]
//
//**********************************************

// Don't get run over.
remove_filter( 'the_content', 'wpautop' );
add_filter( 'the_content', 'wpautop' , 12);

/*************************/


//Customizer
/**
 * Create Logo Setting and Upload Control
 */
function your_theme_new_customizer_settings($wp_customize) {
	//$wp_customize->remove_section('woocommerce');
	//$wp_customize->remove_section('front_page');
	$wp_customize->add_section( 'header' , array(
		'title'      => 'Header',
		'priority'   => 30,
	) );
	$wp_customize->add_setting( 'top_header' );
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,'top_header',array(
				'label' => 'Top Header Text',
				'section' => 'header',
				'type' => 'text',
				'settings' => 'top_header',
				'priority'   => 20,
			)
		)
	);
	$wp_customize->add_setting('site_logo');
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize, 'site_logo', array(
				'label' => 'Upload Logo',
				'section' => 'header',
				'description' => 'Site Icons should be at least <strong>145 × 29</strong> pixels.',
				'settings' => 'site_logo',
			)
		)
	);
	$wp_customize->add_section( 'newletter_popup' , array(
		'title'      => 'Newsletter Popup',
		'priority'   => 20,
	) );

	$wp_customize->add_setting('newsletter_image');
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize, 'newsletter_image', array(
				'label' => 'Newsletter Image',
				'section' => 'newletter_popup',
				'description' => '',
				'settings' => 'newsletter_image',
				'priority'   => 10,
			)
		)
	);
	$wp_customize->add_setting( 'newsletter_heading' );
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,'newsletter_heading',array(
				'label' => 'Newsletter Heading Text',
				'section' => 'newletter_popup',
				'type' => 'text',
				'settings' => 'newsletter_heading',
				'priority'   => 20,
			)
		)
	);
	$wp_customize->add_setting( 'newsletter_text' );
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,'newsletter_text',array(
				'label' => 'Newsletter Content',
				'section' => 'newletter_popup',
				'type' => 'textarea',
				'settings' => 'newsletter_text',
				'priority'   => 30,
			)
		)
	);


	$wp_customize->add_section( 'our_story' , array(
		'title'      => 'Our Story',
		'priority'   => 30,
	) );
	$wp_customize->add_setting( 'our_story_text' );
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,'our_story_text',array(
				'label' => 'Our Story Text',
				'section' => 'our_story',
				'type' => 'textarea',
				'settings' => 'our_story_text',
				'priority'   => 20,
			)
		)
	);
	$wp_customize->add_setting( 'our_story_quote' );
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,'our_story_quote',array(
				'label' => 'Our Story Quote',
				'section' => 'our_story',
				'type' => 'text',
				'settings' => 'our_story_quote',
				'priority'   => 30,
			)
		)
	);
	$wp_customize->add_section( 'footer' , array(
		'title'      => 'Footer',
		'priority'   => 120,
	) );
	$wp_customize->add_setting( 'copyright' );
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,'copyright',array(
				'label' => 'Copyright',
				'section' => 'footer',
				'type' => 'text',
				'settings' => 'copyright',
				'priority'   => 20,
			)
		)
	);
	/*$wp_customize->add_setting( 'social' );
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,'social',array(
				'label' => 'Social',
				'section' => 'footer',
				'type' => 'textarea',
				'settings' => 'social',
				'priority'   => 10,
			)
		)
	);*/
}
add_action('customize_register', 'your_theme_new_customizer_settings');

function processURL($url)
{
	$ch = curl_init();
	curl_setopt_array($ch, array(
		CURLOPT_URL => $url,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_SSL_VERIFYPEER => false,
		CURLOPT_SSL_VERIFYHOST => 2
	));

	$result = curl_exec($ch);
	curl_close($ch);
	return $result;
}

function api_curl_connect( $api_url ){
	$connection_c = curl_init(); // initializing
	curl_setopt( $connection_c, CURLOPT_URL, $api_url ); // API URL to connect
	curl_setopt( $connection_c, CURLOPT_RETURNTRANSFER, 1 ); // return the result, do not print
	curl_setopt( $connection_c, CURLOPT_TIMEOUT, 20 );
	$json_return = curl_exec( $connection_c ); // connect and get json data
	curl_close( $connection_c ); // close connection
	return json_decode( $json_return ); // decode and return
}


function jc_nav_menu_items( $items, $args ) {
	if( is_user_logged_in( ) ){
		if($args->theme_location == 'accnav'){
			$items .= '<li id="menu-item-logout" class="menu-item menu-item-logout"><a href="'.wp_logout_url(home_url()).'">'.__('Logout').'</a></li>';
		}
	}
	return $items;
}
add_filter('wp_nav_menu_items','jc_nav_menu_items', 10, 2);


/**
 * Retrieves the thumbnail from a youtube or vimeo video
 * @param - $src: the url of the "player"
 * @return - string
 *
 **/
function get_video_thumbnail( $src ) {
	$url_pieces = explode('/', $src);

	if ( $url_pieces[2] == 'player.vimeo.com' ) { // If Vimeo
		$id = $url_pieces[4];
		$hash = unserialize(file_get_contents('http://vimeo.com/api/v2/video/' . $id . '.php'));
		$thumbnail = $hash[0]['thumbnail_large'];
	} elseif ( $url_pieces[2] == 'www.youtube.com' ) { // If Youtube
		$extract_id = explode('?', $url_pieces[4]);
		$id = $extract_id[0];
		$thumbnail = 'http://img.youtube.com/vi/' . $id . '/mqdefault.jpg';
	}
	return $thumbnail;
}
function get_vimeoid( $url ) {
	$regex = '~
		# Match Vimeo link and embed code
		(?:<iframe [^>]*src=")?         # If iframe match up to first quote of src
		(?:                             # Group vimeo url
				https?:\/\/             # Either http or https
				(?:[\w]+\.)*            # Optional subdomains
				vimeo\.com              # Match vimeo.com
				(?:[\/\w]*\/videos?)?   # Optional video sub directory this handles groups links also
				\/                      # Slash before Id
				([0-9]+)                # $1: VIDEO_ID is numeric
				[^\s]*                  # Not a space
		)                               # End group
		"?                              # Match end quote if part of src
		(?:[^>]*></iframe>)?            # Match the end of the iframe
		(?:<p>.*</p>)?                  # Match any title information stuff
		~ix';

	preg_match( $regex, $url, $matches );

	return $matches[1];
}

function get_the_slug() {

	global $post;

	if ( is_single() || is_page() ) {
		return $post->post_name;
	}
	else {
		return "";
	}

}

function dokan_remove_menu( $menus ) {
	unset($menus['coupon']);
	unset($menus['reviews']);
	unset($menus['withdraw']);
	unset($menus['products']);
	unset($menus['report']);

	return $menus;
}

add_filter( 'dokan_get_dashboard_nav', 'dokan_remove_menu' );

/** Adding Settings extra menu in Settings tabs Dahsboard */

add_filter( 'dokan_get_dashboard_settings_nav', 'dokan_add_settings_menu' );

function dokan_add_settings_menu( $settings_tab ) {
	$settings_tab['csv_import'] = array(
		'title' => __( 'CSV Import', 'dokan'),
		'icon'  => '<i class="fa fa-user"></i>',
		'url'   => dokan_get_navigation_url( 'settings/csv_import' ),
		'pos'   => 32
	);

	unset( $settings_tab['shipping'] );
	unset( $settings_tab['store'] );
	unset( $settings_tab['social'] );
	unset( $settings_tab['seo'] );

	return $settings_tab;
}

add_filter( 'dokan_dashboard_settings_heading_title', 'dokan_load_settings_header', 11, 2 );

function dokan_load_settings_header( $header, $query_vars ) {
	if ( $query_vars == 'csv_import' ) {
		$header = __( 'CSV Import', 'dokan' );
	}

	return $header;
}

add_filter( 'dokan_dashboard_settings_helper_text', 'load_helper', 10, 2 );

function load_helper( $helper_txt, $query_var ) {
	if ( $query_var == 'csv_import' ) {
		$helper_txt = 'CSV Import';
	}

	return $helper_txt;
}

add_action( 'dokan_render_settings_content', 'dokan_render_settings_content', 10 );


function dokan_render_settings_content( $query_vars ) {
	if ( isset( $query_vars['settings'] ) && $query_vars['settings'] == 'csv_import' ) {
		include_once TEMPLATEPATH."/dokan_csv_import.php";
	}
}


add_action('admin_menu', 'vendor_submenu');
function vendor_submenu() {
	add_menu_page( 'Vendor management', 'Vendor management', 'manage_options', 'vendor-management', 'vendor_order_callback', '
dashicons-groups', 55);
	add_submenu_page( '', 'Edit Vendor', 'Edit Vendor', 'manage_options', 'edit-vendor', 'vendor_edit_callback');
	add_submenu_page( '', 'Import Vendor', 'Import Vendor', 'manage_options', 'import-vendor', 'vendor_import_callback');
}
function vendor_order_callback() {
	include_once TEMPLATEPATH."/admin_vendor_management.php";
}
function vendor_edit_callback() {
	include_once TEMPLATEPATH."/admin_vendor_edit.php";
}
function vendor_import_callback() {
	include_once TEMPLATEPATH."/admin_vendor_import_callback.php";
}

add_action('admin_menu', 'add_import_page');

function add_import_page() {
	add_menu_page('Product Import', 'Product Import', 'manage_options', 'import', 'import', 'dashicons-admin-generic',  90 );
	add_submenu_page('import', 'Attach Images', 'Attach Images', 'manage_options', 'attach_img', 'attach_img' );
}
function import() {
	include_once 'admin_csv_import.php';
}
function attach_img() {
	include_once 'admin_csv_attach_img.php';
}

function readCSV($csvFile){
	$file_handle = fopen($csvFile, 'r');
	while (!feof($file_handle) ) {
		$line_of_text[] = fgetcsv($file_handle, 1024);
	}
	fclose($file_handle);
	return $line_of_text;
}

function insert_product_attributes ($post_id, $available_attributes, $variations)
{
	foreach ($available_attributes as $attribute) // Go through each attribute
	{
		$values = array(); // Set up an array to store the current attributes values.

		foreach ($variations as $variation) // Loop each variation in the file
		{
			$attribute_keys = array_keys($variation['attributes']); // Get the keys for the current variations attributes

			foreach ($attribute_keys as $key) // Loop through each key
			{
				if ($key === $attribute) // If this attributes key is the top level attribute add the value to the $values array
				{
					$values[] = $variation['attributes'][$key];
				}
			}
		}

		// Essentially we want to end up with something like this for each attribute:
		// $values would contain: array('small', 'medium', 'medium', 'large');

		$values = array_unique($values); // Filter out duplicate values

		// Store the values to the attribute on the new post, for example without variables:
		// wp_set_object_terms(23, array('small', 'medium', 'large'), 'pa_size');
		wp_set_object_terms($post_id, $values, 'pa_' . $attribute);
	}

	$product_attributes_data = array(); // Setup array to hold our product attributes data

	foreach ($available_attributes as $attribute) // Loop round each attribute
	{
		$product_attributes_data['pa_'.$attribute] = array( // Set this attributes array to a key to using the prefix 'pa'

			'name'         => 'pa_'.$attribute,
			'value'        => '',
			'is_visible'   => '1',
			'is_variation' => '1',
			'is_taxonomy'  => '1'

		);
	}

	update_post_meta($post_id, '_product_attributes', $product_attributes_data); // Attach the above array to the new posts meta data key '_product_attributes'
}

function insert_product_variations ($post_id, $variations)
{
	foreach ($variations as $index => $variation)
	{
		$variation_post = array( // Setup the post data for the variation

			'post_title'  => 'Variation #'.$index.' of '.count($variations).' for product#'. $post_id,
			'post_name'   => 'product-'.$post_id.'-variation-'.$index,
			'post_status' => 'publish',
			'post_parent' => $post_id,
			'post_type'   => 'product_variation',
			'guid'        => home_url() . '/?product_variation=product-' . $post_id . '-variation-' . $index
		);

		$variation_post_id = wp_insert_post($variation_post); // Insert the variation

		foreach ($variation['attributes'] as $attribute => $value) // Loop through the variations attributes
		{
			$attribute_term = get_term_by('name', $value, 'pa_'.$attribute); // We need to insert the slug not the name into the variation post meta

			update_post_meta($variation_post_id, 'attribute_pa_'.$attribute, $attribute_term->slug);
			// Again without variables: update_post_meta(25, 'attribute_pa_size', 'small')
		}

		update_post_meta($variation_post_id, '_price', $variation['price']);
		update_post_meta($variation_post_id, '_regular_price', $variation['price']);
	}
}

function get_user_id_by_display_name( $display_name ) {
	global $wpdb;

	if ( ! $user = $wpdb->get_row( $wpdb->prepare(
		"SELECT 'ID' FROM $wpdb->users WHERE 'display_name' = %s", $display_name
	) ) )
		return false;

	return $user->ID;
}
function get_product_by_sku( $sku ) {

	global $wpdb;

	$product_id = $wpdb->get_var( $wpdb->prepare( "SELECT post_id FROM $wpdb->postmeta WHERE meta_key='_sku' AND meta_value='%s' LIMIT 1", $sku ) );

	if ( $product_id ) return $product_id;

	return null;
}

function get_attachment_id( $url ) {
	$attachment_id = 0;
	$dir = wp_upload_dir();
	if ( false !== strpos( $url, $dir['baseurl'] . '/' ) ) { // Is URL in uploads directory?
		$file = basename( $url );
		$query_args = array(
			'post_type'   => 'attachment',
			'post_status' => 'inherit',
			'fields'      => 'ids',
			'meta_query'  => array(
				array(
					'value'   => $file,
					'compare' => 'LIKE',
					'key'     => '_wp_attachment_metadata',
				),
			)
		);
		$query = new WP_Query( $query_args );
		if ( $query->have_posts() ) {
			foreach ( $query->posts as $post_id ) {
				$meta = wp_get_attachment_metadata( $post_id );
				$original_file       = basename( $meta['file'] );
				$cropped_image_files = wp_list_pluck( $meta['sizes'], 'file' );
				if ( $original_file === $file || in_array( $file, $cropped_image_files ) ) {
					$attachment_id = $post_id;
					break;
				}
			}
		}
	}
	return $attachment_id;
}
add_filter( 'loop_shop_per_page', 'new_loop_shop_per_page', 20 );

function new_loop_shop_per_page( $cols ) {
	$cols = 33;
	return $cols;
}
function filter_plugin_updates( $value ) {
	unset( $value->response['variation-swatches-for-woocommerce/variation-swatches-for-woocommerce.php'] );
	unset( $value->response['advanced-custom-fields-pro/acf.php'] );
	unset( $value->response['woocommerce-gateway-stripe/woocommerce-gateway-stripe.php'] );
	unset( $value->response['dokan-lite/dokan.php'] );
	return $value;
}
add_filter( 'site_transient_update_plugins', 'filter_plugin_updates' );
add_action( 'after_setup_theme', 'lefemme_setup' );

function lefemme_setup() {
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}

function single_delivery_field() {
	global $product;

	/*if ( $product->get_id() !== 1741 ) {
		return;
	}*/

	?>
    <ul class="single_delivery">
        <li><label><input name="single_delivery" type="radio" value="home_delivery"> Home Delivery</label></li>
        <li><label><input name="single_delivery" type="radio" value="in_store_pickup"> In Store Pickup</label></li>
    </ul>
    <div class="loading_icon2" style="text-align: center; display: none;">
        <img src="<?php bloginfo('template_directory'); ?>/images/loading_spinner.gif"/>
    </div>
    <input type="hidden" name="home" value=""/>
    <input type="hidden" name="instore" value=""/>
    <div class="instore_loc_selected"></div>
    <div class="home_loc_selected"></div>
    <div id="fancybox-instore-pickup" style="display: none;">
        <h1>Instore Pickup</h1>
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12">
                <input class="instore_zip form-control" type="text" name="instore_zip"/>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <input class="instore_find btn" type="submit" name="Find" value="Submit"/>
            </div>
        </div>
        <div class="instore_loc">
        </div>
        <div class="loading_icon" style="text-align: center; display: none;">
            <img src="<?php bloginfo('template_directory'); ?>/images/loading_spinner.gif"/>
        </div>
    </div>
    <div id="fancybox-home-delivery" style="display: none;">
        <h1>What’s your zipcode?</h1>
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12">
                <input class="home_zip form-control" type="text" name="home_zip"/>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <input class="home_find btn" type="submit" name="submit" value="Submit"/>
            </div>
        </div>
        <div class="home_loc">
        </div>
        <div class="loading_icon" style="text-align: center; display: none;">
            <img src="<?php bloginfo('template_directory'); ?>/images/loading_spinner.gif"/>
        </div>
    </div>
	<?php
}

add_action( 'woocommerce_before_add_to_cart_button', 'single_delivery_field', 10 );

function single_delivery_to_cart_item( $cart_item_data, $product_id, $variation_id ) {
	$single_delivery = filter_input( INPUT_POST, 'single_delivery' );
	$instore = filter_input( INPUT_POST, 'instore' );
	$home = filter_input( INPUT_POST, 'home' );

	if ( empty( $single_delivery ) ) {
		return $cart_item_data;
	}

	$cart_item_data['single_delivery'] = $single_delivery;
	if($single_delivery == 'home_delivery') {
		$cart_item_data['home'] = $home;
	}
	if($single_delivery == 'in_store_pickup') {
		$cart_item_data['instore'] = $instore;
	}

	return $cart_item_data;
}

add_filter( 'woocommerce_add_cart_item_data', 'single_delivery_to_cart_item', 10, 3 );

function single_delivery_text_cart( $item_data, $cart_item ) {
	if ( empty( $cart_item['single_delivery'] ) ) {
		return $item_data;
	}

	if($cart_item['single_delivery'] == 'home_delivery') {
		$home = $cart_item['home'];
		//$home_data = get_userdata($home);
		$cart_text = 'Home Delivery - Sold by <a href="javascript:void(0);">'.get_user_meta( $home, 'company_name', true ).'</a>';
	}
	if($cart_item['single_delivery'] == 'in_store_pickup') {
		$instore = $cart_item['instore'];
		$instore_data = get_userdata($instore);
		$cart_text = 'In Store Pickup<br/><strong>'.get_user_meta($instore, 'company_name', true).'</strong><br/>'.get_user_meta($instore, 'address', true).'<br/><strong>Phone: </strong>' . get_user_meta( $instore, 'phone', true ) . '<br/>'.get_user_meta($instore, 'city', true).', '.get_user_meta($instore, 'st', true).'<br/>'.get_user_meta($instore, 'zip', true);
	}

	$item_data[] = array(
		'key'     => 'Delivery',
		'value'   => $cart_text,
		'display' => '',
	);

	return $item_data;
}

add_filter( 'woocommerce_get_item_data', 'single_delivery_text_cart', 10, 2 );

function single_delivery_to_order_items( $item, $cart_item_key, $values, $order ) {
	if ( empty( $values['single_delivery'] ) ) {
		return;
	}

	if($values['single_delivery'] == 'home_delivery') {
		$home = $values['home'];
		//$home_data = get_userdata($home);
		$order_value = 'Home Delivery - Sold by <a href="javascript:void(0);">'.get_user_meta( $home, 'company_name', true ).'</a>';
		$item->add_meta_data('Delivery', $order_value);
		$item->add_meta_data('home', $home);
	}
	if($values['single_delivery'] == 'in_store_pickup') {
		$instore = $values['instore'];
		$instore_data = get_userdata($instore);
		$order_value = 'In Store Pickup<br/><strong>'.get_user_meta($instore, 'company_name', true).'</strong><br/>'.get_user_meta($instore, 'address', true).'<br/><strong>Phone: </strong>' . get_user_meta( $instore, 'phone', true ) . '<br/>'.get_user_meta($instore, 'city', true).', '.get_user_meta($instore, 'st', true).'<br/>'.get_user_meta($instore, 'zip', true);

		$item->add_meta_data('Delivery', $order_value);
		$item->add_meta_data('instore', $instore);
	}
}

add_action( 'woocommerce_checkout_create_order_line_item', 'single_delivery_to_order_items', 10, 4 );


add_action('wp_ajax_nopriv_storeName', 'storeName');
add_action( 'wp_ajax_storeName', 'storeName' );

function storeName() {
	$company_name = get_user_meta( $_POST['store_id'], 'company_name', true );
	if(empty($company_name)) {
		$user_data = get_userdata($_POST['store_id']);
		$company_name = $user_data->display_name;
	}
	echo $company_name;
	wp_die();
}


add_action('wp_ajax_nopriv_homeDeliverySearch', 'homeDeliverySearch');
add_action( 'wp_ajax_homeDeliverySearch', 'homeDeliverySearch' );

function homeDeliverySearch() {
	global $wpdb;
	$user_id = $_POST['user_id'];
	$product_id = $_POST['product_id'];
	if(!empty($user_id) || $user_id != 0) {
		$searchZip = get_user_meta( $user_id, 'shipping_postcode', true );
	} else {
		$searchZip = $_POST['searchZip'];
	}
	$user_query = new WP_User_Query( array( 'role' => 'seller' ) );
	$seller_id = 0;
	if (!empty($user_query->get_results())) {
		$seller_array = array();
		foreach ( $user_query->get_results() as $user ) {
			$stock = $wpdb->get_row("SELECT stock FROM ".$wpdb->prefix."stock WHERE pro_id = ".$product_id." AND user_id = ".$user->ID);
			if($stock->stock > 0) {
				array_push($seller_array, $user->ID);
			}
		}
		if(!empty($seller_array)) {
			if(count($seller_array) == 1) {
				$seller_id = $seller_array[0];
			} else {
				$distance_array = array();
				foreach ($seller_array as $seller) {
					$zip = get_user_meta( $seller, 'zip', true );
					if ( ! empty( $zip ) ) {
						$distance_data = api_curl_connect( 'https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=' . $searchZip . '&destinations=' . $zip . '&key=AIzaSyAIbrST4XMbdTta08vfp4AFA3gpitVovVQ' );
						if ( $distance_data->status == 'OK' ) {
							if ( $distance_data->rows[0]->elements[0]->status == 'OK' ) {
								$distance = $distance_data->rows[0]->elements[0]->distance->value;
								$distance_array[ $seller ] = $distance;
							}
						}
					}
				}
				if(!empty($distance_array)) {
					asort($distance_array);
					$i = 0;
					foreach ( $distance_array as $key => $value ) {
						if($i == 0) {
							$seller_id = $key;
						}
						$i++;
					}
				}
			}
		} else {
			$distance_array = array();
			foreach ( $user_query->get_results() as $user ) {
				$zip = get_user_meta( $user->ID, 'zip', true );
				if ( ! empty( $zip ) ) {
					$distance_data = api_curl_connect( 'https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=' . $searchZip . '&destinations=' . $zip . '&key=AIzaSyAIbrST4XMbdTta08vfp4AFA3gpitVovVQ' );
					if ( $distance_data->status == 'OK' ) {
						if ( $distance_data->rows[0]->elements[0]->status == 'OK' ) {
							$distance = $distance_data->rows[0]->elements[0]->distance->value;
							$distance = $distance / 1000;
							if ( $distance <= 144.841 ) {
								$distance_array[ $user->ID ] = $distance;
							}
						}
					}
				}
			}
			if(!empty($distance_array)) {
				asort($distance_array);
				$i = 0;
				foreach ( $distance_array as $key => $value ) {
					if($i == 0) {
						$seller_id = $key;
					}
					$i++;
				}
			} else {
				$level_array = array();
				foreach ( $user_query->get_results() as $user ) {
					$level = get_user_meta($user->ID, 'level', true);
					if($level == 'Gold') {
						array_push($level_array, $user->ID);
					}
				}
				if(empty($level_array)) {
					foreach ( $user_query->get_results() as $user ) {
						$level = get_user_meta($user->ID, 'level', true);
						if($level == 'Silver') {
							array_push($level_array, $user->ID);
						}
					}
				}
				if(empty($level_array)) {
					foreach ( $user_query->get_results() as $user ) {
						$level = get_user_meta($user->ID, 'level', true);
						if($level == 'Bronze') {
							array_push($level_array, $user->ID);
						}
					}
				}
				if(!empty($level_array)) {
					$seller_id = $level_array[0];
				}
			}
		}
	}
	echo $seller_id;
	wp_die();
}

add_action('wp_ajax_nopriv_zipSearch', 'zipSearch');
add_action( 'wp_ajax_zipSearch', 'zipSearch' );

function zipSearch() {
	$searchZip = $_POST['searchZip'];
	$user_query = new WP_User_Query( array( 'role' => 'seller' ) );
	if (!empty($user_query->get_results())) {
		$distance_array = array();
		foreach ($user_query->get_results() as $user) {
			$zip = get_user_meta( $user->ID, 'zip', true );
			if(!empty($zip)) {
				$distance_data = api_curl_connect( 'https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=' . $searchZip . '&destinations=' . $zip . '&key=AIzaSyAIbrST4XMbdTta08vfp4AFA3gpitVovVQ' );
				if ( $distance_data->status == 'OK' ) {
					if($distance_data->rows[0]->elements[0]->status == 'OK') {
						$distance = $distance_data->rows[0]->elements[0]->distance->value;
						$distance = $distance / 1000;
						if ( $distance <= 160.934 ) {
							$distance_array[$user->ID] = $distance;
						}
					}
				}
			}
		}
		asort($distance_array);
		if(!empty($distance_array)) {
			$result = '<table><thead><tr><th>Location</th><th>Distance</th></tr></thead><tbody>';
			foreach ( $distance_array as $key => $value ) {
				$result .= '<tr 
                data-id="' . $key . '" data-address="<strong>' . get_user_meta( $key, 'company_name', true ) . '</strong><br/>' . get_user_meta( $key, 'address', true ) . '<br/><strong>Phone: </strong>' . get_user_meta( $key, 'phone', true ) . '<br/> ' . get_user_meta( $key, 'city', true ) . ', ' . get_user_meta( $key, 'st', true ) . '<br/>' . $zip . '">
                <td>
                <strong>' . get_user_meta( $key, 'company_name', true ) . '</strong>
                <br/>
                ' . get_user_meta( $key, 'address', true ) . '
                <br/>
                <strong>Phone: </strong>' . get_user_meta( $key, 'phone', true ) . '
                <br/> 
                ' . get_user_meta( $key, 'city', true ) . ', 
                ' . get_user_meta( $key, 'st', true ) . '
                <br/>
                ' . get_user_meta( $key, 'zip', true ) . '
                </td>
                <td>
                ' . number_format(($value*0.621371), 2, '.', '') . ' mi
                </td>
                </tr>';
			}
			$result .= '</tbody></table>';
		} else {
			$result = '<p>No Result Found</p>';
		}
	}
	echo $result;
	wp_die();
}

add_action('wp_ajax_nopriv_stateSearch', 'stateSearch');
add_action( 'wp_ajax_stateSearch', 'stateSearch' );

function stateSearch() {
	$country = $_POST['country'];
	global $woocommerce;
	$countries_obj   = new WC_Countries();
	$countries   = $countries_obj->__get('countries');
	if(empty($country)) {
		$default_country = $countries_obj->get_base_country();
	} else {
		$default_country = $country;
	}
	$default_county_states = $countries_obj->get_states( $default_country );
	if(!empty($default_county_states)) {
		echo '<label>State</label>';
		woocommerce_form_field( 'my_state_field', array(
				'type'        => 'select',
				'class'       => array( 'lafemme_drop_state' ),
				'input_class' => array( 'form-control' ),
				'required'    => false,
				//'label'     => __('Select a state'),
				'placeholder' => __( 'Enter something' ),
				'options'     => $default_county_states
			)
		);
	}
	wp_die();
}

add_action( 'admin_post_export_csv', 'export_csv' );

function export_csv()
{
	if ( ! current_user_can( 'manage_options' ) )
		return;

	ini_set('max_execution_time', 0);
	header('Content-Type: application/csv');
	header('Content-Disposition: attachment; filename=example.csv');
	header('Pragma: no-cache');
	$output = fopen('php://output', 'w');

	/*fputcsv($output, array('SKU', 'Colors', 'Sizes'));*/
	//fputcsv($output, array('SKU', 'Colors-Sizes Combinations'));

	$args = array(
		'post_type' => 'product',
		'posts_per_page' => 50,
		'paged' => 7
	);

	$the_query = new WP_Query( $args );
	if ( $the_query->have_posts() ) :
		while ( $the_query->have_posts() ) : $the_query->the_post();
			$product = wc_get_product( get_the_ID() );
			$sku = $product->get_sku();
			$available_variations = $product->get_available_variations();
			if(!empty($available_variations)) {
				//$colors = array();
				//$sizes = array();
				$colors_sizes = array();
				foreach ( $available_variations as $variation ) {
					array_push($colors_sizes, $variation['attributes']['attribute_pa_color'].'-'.$variation['attributes']['attribute_pa_size']);
					//array_push( $colors, $variation['attributes']['attribute_pa_color'] );
					//array_push( $sizes, $variation['attributes']['attribute_pa_size'] );
				}
				//$colors = array_unique($colors);
				//$sizes = array_unique($sizes);
			}
			fputcsv($output, array($sku, implode(';', $colors_sizes)));
		endwhile;
	endif;
	wp_reset_postdata();
}

/*add_action( 'woocommerce_new_order', 'change_order_seller',  1, 1  );
function change_order_seller( $order_id ) {
	$order = new WC_Order( $order_id );
	//$items = $order->get_items();

	$searchZip = $order->get_shipping_postcode();
	$user_query = new WP_User_Query( array( 'role' => 'seller' ) );
	if (!empty($user_query->get_results())) {
		$distance_array = array();
		foreach ( $user_query->get_results() as $user ) {
			$zip = get_user_meta( $user->ID, 'zip', true );
			if ( ! empty( $zip ) ) {
				$level = get_user_meta($user->ID, 'level', true);
				if($level == 'Gold') {
					$distance_data = api_curl_connect( 'https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=' . $searchZip . '&destinations=' . $zip . '&key=AIzaSyAIbrST4XMbdTta08vfp4AFA3gpitVovVQ' );
					if ( $distance_data->status == 'OK' ) {
						if ( $distance_data->rows[0]->elements[0]->status == 'OK' ) {
							$distance = $distance_data->rows[0]->elements[0]->distance->value;
							$distance = $distance / 1000;
							if ( $distance <= 144.841 ) {
								$distance_array[ $user->ID ] = $distance;
							}
						}
					}
				}
			}
		}
		if(empty($distance_array)) {
			foreach ( $user_query->get_results() as $user ) {
				$zip = get_user_meta( $user->ID, 'zip', true );
				if ( ! empty( $zip ) ) {
					$level = get_user_meta($user->ID, 'level', true);
					if($level == 'Silver') {
						$distance_data = api_curl_connect( 'https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=' . $searchZip . '&destinations=' . $zip . '&key=AIzaSyAIbrST4XMbdTta08vfp4AFA3gpitVovVQ' );
						if ( $distance_data->status == 'OK' ) {
							if ( $distance_data->rows[0]->elements[0]->status == 'OK' ) {
								$distance = $distance_data->rows[0]->elements[0]->distance->value;
								$distance = $distance / 1000;
								if ( $distance <= 144.841 ) {
									$distance_array[ $user->ID ] = $distance;
								}
							}
						}
					}
				}
			}
		}
		if(empty($distance_array)) {
			foreach ( $user_query->get_results() as $user ) {
				$zip = get_user_meta( $user->ID, 'zip', true );
				if ( ! empty( $zip ) ) {
					$level = get_user_meta($user->ID, 'level', true);
					if($level == 'Bronze') {
						$distance_data = api_curl_connect( 'https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=' . $searchZip . '&destinations=' . $zip . '&key=AIzaSyAIbrST4XMbdTta08vfp4AFA3gpitVovVQ' );
						if ( $distance_data->status == 'OK' ) {
							if ( $distance_data->rows[0]->elements[0]->status == 'OK' ) {
								$distance = $distance_data->rows[0]->elements[0]->distance->value;
								$distance = $distance / 1000;
								if ( $distance <= 144.841 ) {
									$distance_array[ $user->ID ] = $distance;
								}
							}
						}
					}
				}
			}
		}
		if(empty($distance_array)) {
			foreach ( $user_query->get_results() as $user ) {
				$zip = get_user_meta( $user->ID, 'zip', true );
				if ( ! empty( $zip ) ) {
					$level = get_user_meta($user->ID, 'level', true);
					$distance_data = api_curl_connect( 'https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=' . $searchZip . '&destinations=' . $zip . '&key=AIzaSyAIbrST4XMbdTta08vfp4AFA3gpitVovVQ' );
					if ( $distance_data->status == 'OK' ) {
						if ( $distance_data->rows[0]->elements[0]->status == 'OK' ) {
							$distance = $distance_data->rows[0]->elements[0]->distance->value;
							$distance = $distance / 1000;
							if ( $distance <= 144.841 ) {
								$distance_array[ $user->ID ] = $distance;
							}
						}
					}
				}
			}
		}
		if(!empty($distance_array)) {
			asort($distance_array);
			$i = 0;
			foreach ( $distance_array as $key => $value ) {
				if($i == 0) {
					$seller_id = $key;
				}
				$i++;
			}
		}
	}

	if(!empty($seller_id)) {
		global $wpdb;
		$wpdb->update( $wpdb->prefix . 'dokan_orders', array( 'seller_id' => $seller_id ), array( 'order_id' => $order_id ) );
		$arg = array(
			'ID'          => $order_id,
			'post_author' => $seller_id,
		);
		wp_update_post( $arg );
	}
}*/

/* Fire our meta box setup function on the post editor screen. */
add_action( 'load-post.php', 'product_meta_boxes_setup' );
add_action( 'load-post-new.php', 'product_meta_boxes_setup' );

/* Meta box setup function. */
function product_meta_boxes_setup() {

	/* Add meta boxes on the 'add_meta_boxes' hook. */
	add_action( 'add_meta_boxes', 'add_product_meta_boxes' );

	/* Save post meta on the 'save_post' hook. */
	add_action( 'save_post', 'save_product_class_meta', 10, 2 );
}

/* Create one or more meta boxes to be displayed on the post editor screen. */
function add_product_meta_boxes() {

	add_meta_box(
		'stock-management',      // Unique ID
		esc_html__( 'Stock Management'),    // Title
		'product_class_meta_box',   // Callback function
		'product',         // Admin page (or post type)
		'side',         // Context
		'high'         // Priority
	);
}

/* Display the post meta box. */
function product_class_meta_box( $post ) { ?>

	<?php wp_nonce_field( basename( __FILE__ ), 'product_class_nonce' ); ?>

    <p>
        <label>Stock:</label>
		<?php
		$stock = get_post_meta($post->ID,'var_stock', true);
		if(empty($stock)) {
			$stock = 0;
		}
		?>
        <input type="number" min="0" name="stock" value="<?php echo $stock; ?>" />
    </p>
<?php }

/* Save the meta box's post metadata. */
function save_product_class_meta( $post_id, $post ) {

	/* Verify the nonce before proceeding. */
	if ( !isset( $_POST['product_class_nonce'] ) || !wp_verify_nonce( $_POST['product_class_nonce'], basename( __FILE__ ) ) )
		return $post_id;

	/* Get the post type object. */
	$post_type = get_post_type_object( $post->post_type );

	/* Check if the current user has permission to edit the post. */
	if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
		return $post_id;

	/* Get the posted data and sanitize it for use as an HTML class. */
	$new_meta_value = $_POST['stock'];

	/* Get the meta key. */
	$meta_key = 'var_stock';

	/* Get the meta value of the custom field key. */
	//$meta_value = get_post_meta( $post_id, $meta_key, true );

	/* If a new meta value was added and there was no previous value, add it. */
	if ( $new_meta_value && '' == $new_meta_value ) {
		add_post_meta( $post_id, $meta_key, $new_meta_value, true );

		/* If the new meta value does not match the old value, update it. */
	} else {
		update_post_meta( $post_id, $meta_key, $new_meta_value );
	}
}

function on_order_complete( $ID ) {
	$timestamp = current_time('mysql');
	update_post_meta($ID, 'order_complete_time', $timestamp);
}
add_action(  'woocommerce_order_status_completed',  'on_order_complete', 10, 1 );

add_action('admin_menu', 'order_commission_fee');

function order_commission_fee() {
	add_menu_page(
		__('Order Commission'),
		__('Order Commission'),
		'manage_options',
		'order_commission',
		'order_commission',
		'dashicons-info',
		55
	);
}

function order_commission() {
	if ( $_POST['commission_submit'] == 'Submit' ) {
		update_option('commission', $_POST['commission']);
	}
	$commission = get_option('commission');
	if(empty($commission)) {
		$commission = 0;
	}
	?>
    <h1>Order Commission</h1>
    <form method="POST" action="">
        <input style="padding: 6px; height: auto;" type="number" name="commission" min="0" max="100" value="<?php echo $commission; ?>"/> %
        <input class="button button-primary button-large" type="submit" name="commission_submit" value="Submit"/>
    </form>
	<?php
}

add_action('admin_menu', 'color_export_submenu');
function color_export_submenu() {
	add_menu_page( 'Color Import Export', 'Color Import Export', 'manage_options', 'color-export', 'color_export_callback', '', 95);
	add_submenu_page('');
}
function color_export_callback() {
	include_once TEMPLATEPATH."/admin_color_export.php";
}

add_action( 'admin_post_color_export_csv', 'color_export_csv' );

function color_export_csv()
{
	if ( ! current_user_can( 'manage_options' ) )
		return;

	ini_set('max_execution_time', 0);
	$filename = "color_export_" . date( "Y-m-d" ) . ".csv";
	header('Content-Type: application/csv');
	header('Content-Disposition: attachment; filename='.$filename);
	header('Pragma: no-cache');
	$output = fopen('php://output', 'w');

	$terms = get_terms( array(
		'taxonomy' => 'pa_color',
		'hide_empty' => false,
		'order' => 'ASC',
	) );

	if(!empty($terms)) {
		fputcsv($output, array('Name', 'Slug', 'Color 1', 'Color 2'));
		//$term_array = array(array('Name', 'Color 1', 'Color 2'));

		foreach ( $terms as $term ) {
			$color  = get_term_meta( $term->term_id, 'color', true );
			$color1 = get_term_meta( $term->term_id, 'color1', true );
			//array_push($term_array, array($term->name, $color, $color1));
			fputcsv($output, array($term->name, $term->slug, $color, $color1));
		}
	}
}
function lv2_add_bootstrap_input_classes( $args, $key, $value = null ) {

	// Start field type switch case
	switch ( $args['type'] ) {

		case "select" :  /* Targets all select input type elements, except the country and state select input types */
			$args['class'][] = 'form-group'; // Add a class to the field's html element wrapper - woocommerce input types (fields) are often wrapped within a <p></p> tag
			$args['input_class'] = array('form-control'); // Add a class to the form input itself
			//$args['custom_attributes']['data-plugin'] = 'select2';
			$args['label_class'] = array('control-label');
			$args['custom_attributes'] = array( 'data-plugin' => 'select2', 'data-allow-clear' => 'true', 'aria-hidden' => 'true',  ); // Add custom data attributes to the form input itself
			break;

		case 'country' : /* By default WooCommerce will populate a select with the country names - $args defined for this specific input type targets only the country select element */
			$args['class'][] = 'form-group single-country';
			$args['label_class'] = array('control-label');
			break;

		case "state" : /* By default WooCommerce will populate a select with state names - $args defined for this specific input type targets only the country select element */
			$args['class'][] = 'form-group'; // Add class to the field's html element wrapper
			$args['input_class'] = array('form-control'); // add class to the form input itself
			//$args['custom_attributes']['data-plugin'] = 'select2';
			$args['label_class'] = array('control-label');
			$args['custom_attributes'] = array( 'data-plugin' => 'select2', 'data-allow-clear' => 'true', 'aria-hidden' => 'true',  );
			break;


		case "password" :
		case "text" :
		case "email" :
		case "tel" :
		case "number" :
			$args['class'][] = 'form-group';
			//$args['input_class'][] = 'form-control input-lg'; // will return an array of classes, the same as bellow
			$args['input_class'] = array('form-control');
			$args['label_class'] = array('control-label');
			break;

		case 'textarea' :
			$args['input_class'] = array('form-control');
			$args['label_class'] = array('control-label');
			break;

		case 'checkbox' :
			break;

		case 'radio' :
			break;

		default :
			$args['class'][] = 'form-group';
			$args['input_class'] = array('form-control');
			$args['label_class'] = array('control-label');
			break;
	}

	return $args;
}
add_filter('woocommerce_form_field_args','lv2_add_bootstrap_input_classes',10,3);

/**
 * Change number of related products output
 */
function woo_related_products_limit() {
	global $product;

	$args['posts_per_page'] = 3;
	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'jk_related_products_args' );
function jk_related_products_args( $args ) {
	$args['posts_per_page'] = 3; // 4 related products
	$args['columns'] = 1; // arranged in 2 columns
	return $args;
}
?>