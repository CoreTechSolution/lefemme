<?php
add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );
function my_theme_register_required_plugins() {
	$plugins = array(
		array(
				'name'      => 'WP-PageNavi',
				'slug'      => 'wp-pagenavi',
				'required'  => true,
				'force_activation'   => true,
			),
		array(
				'name'      => 'Wp Pagenavi Style',
				'slug'      => 'wp-pagenavi-style',
				'required'  => true,
				'force_activation'   => true,
			),
		array(
			'name'      => 'Advanced Custom Fields',
			'slug'      => 'advanced-custom-fields',
			'required'  => false,
		),
		array(
			'name'      => 'All In One WP Security',
			'slug'      => 'all-in-one-wp-security-and-firewall',
			'required'  => true,
			'force_activation'   => true,
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
			'required'  => true,
			'force_activation'   => true,
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
			'required'  => true,
			'force_activation'   => true,
		),
		array(
			'name'      => 'Sucuri Security - Auditing, Malware Scanner and Security Hardening',
			'slug'      => 'sucuri-scanner',
			'required'  => true,
			'force_activation'   => true,
		),
		array(
			'name'      => 'WP Migrate DB',
			'slug'      => 'wp-migrate-db',
			'required'  => true,
			'force_activation'   => true,
		),
		array(
			'name'      => 'WP-DBManager',
			'slug'      => 'wp-dbmanager',
			'required'  => true,
			'force_activation'   => true,
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