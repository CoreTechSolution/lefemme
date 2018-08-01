<?php ob_start(); ?>
<!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon.png">
    <title>
        <?php
            global $page, $paged;

            wp_title('|', true, 'right');

            bloginfo('name');

            $site_description = get_bloginfo('description', 'display');
            if ($site_description && (is_home() || is_front_page()))
                echo " | $site_description";

            if ($paged >= 2 || $page >= 2)
                echo ' | ' . sprintf(__('Page %s', 'twentyeleven'), max($paged, $page));

        ?>
    </title>
    <?php
        if (is_singular() && get_option('thread_comments'))
            wp_enqueue_script('comment-reply');

        wp_enqueue_script('jquery');
        wp_head();
    ?>
	<?php
	if($_GET['display'] == 'iframe') {
		?>
        <style>
            #myHeader, #header, #footer {
                display: none;
            }
        </style>
		<?php
	}
	?>

    <script>
        function facyIframeClose(url) {
            //parent.jQuery.fancybox.close();
            console.log(url);
            parent.window.location.href = url;
        }
    </script>
</head>
<body <?php body_class(); ?>>
<div id="gallery_upload" style="display: none;">
    <div id="dragAndDropFiles" class="uploadArea">
        <h1>Drop Images Here to Upload into Gallery</h1>
    </div>
    <form name="demoFiler" id="demoFiler" enctype="multipart/form-data">
        <p style="display: none;"><input type="file" name="multiUpload" id="multiUpload" multiple="multiple" /></p>
        <p><input type="submit" name="submitHandler" id="submitHandler" value="Upload" class="buttonUpload" /></p>
    </form>
    <div class="progressBar">
        <div class="status"></div>
    </div>
</div>
<div id="myHeader">
    <?php if ( get_theme_mod( 'top_header' ) ) { ?>
        <div id="top_notice">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <p><?php echo get_theme_mod( 'top_header' ); ?></p>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    <div id="header">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-12">
                    <div class="nav main_nav"><?php wp_nav_menu(array('theme_location' => 'mainmenu')); ?></div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-12">
                    <div class="nav">
                        <ul>
				            <?php if(is_user_logged_in()) { ?>
                                <li><a href="<?php bloginfo('url'); ?>/my-account">Account</a></li>
                                <li><a href="<?php echo esc_url( wp_logout_url( home_url() ) ); ?>">Log Out</a></li>
				            <?php } ?>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-12">
                   <div class="logo">
                       <?php if ( get_theme_mod( 'site_logo' ) ) { ?>
                           <a href="<?php bloginfo('url') ?>"><img src="<?php echo get_theme_mod( 'site_logo' ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"></a>
                       <?php } else { ?>
                           <h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
                           <h3><?php bloginfo( 'description' ); ?></h3>
                       <?php } ?>
                   </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-12">
                    <div class="nav" style="text-align: right">
                        <ul>
				            <?php if(is_user_logged_in()) { ?>
                                <li class="cart_header">
                                    <a title="<?php _e( 'View your shopping cart' ); ?>" href="<?php echo wc_get_cart_url(); ?>">
                                        <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                                        <span>&nbsp;&nbsp;<?php echo sprintf ( _n( '%d item', '%d items', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?> - <?php echo WC()->cart->get_cart_total(); ?></span>
                                    </a>
						            <?php /*if(WC()->cart->get_cart_contents_count() != 0) { */?><!--
							            <?php /*if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('dropdown_cart') ) : */?> <?php /*endif; */?>
						            --><?php /*} */?>
                                </li>
				            <?php } else { ?>
                                <li class="cart_header">
                                    <a title="<?php _e( 'View your shopping cart' ); ?>" href="<?php echo wc_get_cart_url(); ?>">
                                        <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                                        <span>&nbsp;&nbsp;<?php echo sprintf ( _n( '%d item', '%d items', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?><!-- - --><?php /*echo WC()->cart->get_cart_total(); */?></span>
                                    </a>
						            <?php /*if(WC()->cart->get_cart_contents_count() != 0) { */?><!--
							            <?php /*if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('dropdown_cart') ) : */?> <?php /*endif; */?>
						            --><?php /*} */?>
                                </li>
                                <li><a href="<?php bloginfo('url'); ?>/login">Login</a></li>
				            <?php } ?>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12">
                    <form class="nav_search" method="GET" action="<?php bloginfo('url'); ?>">
                        <input type="text" name="s" placeholder="SEARCH" />
                        <input type="submit" value="&#xf002;" />
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="rspnavigation"></div>
</div>