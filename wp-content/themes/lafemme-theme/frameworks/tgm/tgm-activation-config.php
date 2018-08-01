<?php
add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );
function my_theme_register_required_plugins() {
	$plugins = array(
		array(
		'name'      => 'WP-PageNavi',
				'slug'      => 'wp-pagenavi',
				'required'  => false,
			),
		array(
				'name'      => 'Wp Pagenavi Style',
				'slug'      => 'wp-pagenavi-style',
				'required'  => false,
			),
		array(
			'name'      => 'Advanced Custom Fields',
			'slug'      => 'advanced-custom-fields',
			'required'  => false,
		),
		array(
			'name'      => 'All In One WP Security',
			'slug'      => 'all-in-one-wp-security-and-firewall',
			'required'  => false,
		),
		array(
			'name'      => 'Newsletter',
			'slug'      => 'newsletter',
			'required'  => false,
		),
		array(
			'name'      => 'Shortcodes Ultimate',
			'slug'      => 'shortcodes-ultimate',
			'required'  => false,
		),
		array(
			'name'      => 'Contact Form 7',
			'slug'      => 'contact-form-7',
			'required'  => false,
		),
		array(
			'name'      => 'All in One SEO Pack',
			'slug'      => 'all-in-one-seo-pack',
			'required'  => false,
		),
		array(
			'name'      => 'Google Analytics',
			'slug'      => 'googleanalytics',
			'required'  => false,
		),
		array(
			'name'      => 'WP-SpamShield Anti-Spam',
			'slug'      => 'wp-spamshield',
			'required'  => false,
		),
		array(
			'name'      => 'Sucuri Security - Auditing, Malware Scanner and Security Hardening',
			'slug'      => 'sucuri-scanner',
			'required'  => false,
		),
		array(
			'name'      => 'WP Migrate DB',
			'slug'      => 'wp-migrate-db',
			'required'  => false,
		),
		array(
			'name'      => 'WP-DBManager',
			'slug'      => 'wp-dbmanager',
			'required'  => false,
		),
		array(
			'name'      => 'Custom Post Type Maker',
			'slug'      => 'custom-post-type-maker',
			'required'  => false,
		),
		array(
			'name'      => 'Admin Columns',
			'slug'      => 'codepress-admin-columns',
			'required'  => false,
		),
		array(
			'name'      => 'Image Widget',
			'slug'      => 'image-widget',
			'required'  => false,
		),
		array(
			'name'      => 'Regenerate Thumbnails',
			'slug'      => 'regenerate-thumbnails',
			'required'  => false,
		),
		array(
			'name'      => 'WP Mail SMTP',
			'slug'      => 'wp-mail-smtp',
			'required'  => false,
		),
		array(
			'name'      => 'WP Custom Widget area',
			'slug'      => 'wp-custom-widget-area',
			'required'  => false,
		),
		array(
			'name'      => 'Black Studio Tinymce Widget',
			'slug'      => 'black-studio-tinymce-widget',
			'required'  => false,
		),
		array(
			'name'      => 'If Menu',
			'slug'      => 'if-menu',
			'required'  => false,
		),
		array(
			'name'      => 'UpdraftPlus WordPress Backup Plugin',
			'slug'      => 'updraftplus',
			'required'  => false,
		),
		array(
			'name'      => 'HTML5 Responsive FAQ',
			'slug'      => 'html5-responsive-faq',
			'required'  => false,
		),
		array(
			'name'      => 'Categories Images',
			'slug'      => 'categories-images',
			'required'  => false,
		),
		array(
			'name'      => 'MailChimp for WordPress',
			'slug'      => 'mailchimp-for-wp',
			'required'  => false,
		),
		array(
			'name'      => 'Post Type Switcher',
			'slug'      => 'post-type-switcher',
			'required'  => false,
		),
		array(
			'name'      => 'FV Top Level Categories',
			'slug'      => 'fv-top-level-cats',
			'required'  => false,
		),
		array(
			'name'      => 'WP Google Map Plugin',
			'slug'      => 'wp-google-map-plugin',
			'required'  => false,
		),
		array(
			'name'      => 'Instagram Feed',
			'slug'      => 'instagram-feed',
			'required'  => false,
		),
		array(
			'name'      => 'Twitter Feed',
			'slug'      => 'wd-twitter-feed',
			'required'  => false,
		),
		array(
			'name'      => 'Custom Facebook Feed',
			'slug'      => 'custom-facebook-feed',
			'required'  => false,
		),
		array(
			'name'      => 'Social Media Share Buttons and Social Icons (Ultimate Sharing)',
			'slug'      => 'ultimate-social-media-icons',
			'required'  => false,
		),
		array(
			'name'      => 'Better Search Replace',
			'slug'      => 'better-search-replace',
			'required'  => false,
		),
		array(
			'name'      => 'Import external attachments',
			'slug'      => 'import-external-attachments',
			'required'  => false,
		)
	);
	
	$config = array(
		'id'           => 'tgmpa',
		'default_path' => '',
		'menu'         => 'tgmpa-install-plugins',
		'parent_slug'  => 'themes.php',
		'capability'   => 'edit_theme_options',
		'has_notices'  => true,
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => false,
		'message'      => '',
	);
	tgmpa( $plugins, $config );
}
?>