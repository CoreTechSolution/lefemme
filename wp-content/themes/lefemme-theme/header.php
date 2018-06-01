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
<!-- Responsive and mobile friendly stuff -->
	<meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php
/*
* Print the <title> tag based on what is being viewed.
*/
global $page, $paged;

wp_title('', true, 'right');

// Add the blog name.
if (is_home() || is_front_page())
    bloginfo('name');

// Add the blog description for the home/front page.
$site_description = get_bloginfo('description', 'display');
if ($site_description && (is_home() || is_front_page()))
    echo " | $site_description";

// Add a page number if necessary:
/*if ($paged >= 2 || $page >= 2)
    echo ' | ' . sprintf(__('Page %s', 'twentyeleven'), max($paged, $page));
*/
?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<!-- Responsive Stylesheets -->
<link rel="stylesheet" media="all" href="<?php bloginfo('template_directory'); ?>/css/commoncssloader.css" />

<link rel="stylesheet" media="only screen and (max-width: 1024px) and (min-width: 769px)" href="<?php bloginfo('template_directory'); ?>/css/1024.css">
<link rel="stylesheet" media="only screen and (max-width: 768px) and (min-width: 481px)" href="<?php bloginfo('template_directory'); ?>/css/768.css">
<link rel="stylesheet" media="only screen and (max-width: 480px)" href="<?php bloginfo('template_directory'); ?>/css/480.css">
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>?ver=<?php echo(mt_rand(10,100)); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->

<!-- Custom Responsive Stylesheets -->
<link rel="stylesheet" media="only screen and (max-width: 1024px) and (min-width: 993px)" href="<?php bloginfo('template_directory'); ?>/css/mediaquerycss/styleMax1024.css?ver=<?php echo(mt_rand(10,100)); ?>">
<link rel="stylesheet" media="only screen and (max-width: 992px) and (min-width: 769px)" href="<?php bloginfo('template_directory'); ?>/css/mediaquerycss/styleMax992.css?ver=<?php echo(mt_rand(10,100)); ?>">
<link rel="stylesheet" media="only screen and (max-width: 768px) and (min-width: 481px)" href="<?php bloginfo('template_directory'); ?>/css/mediaquerycss/styleMax768.css?ver=<?php echo(mt_rand(10,100)); ?>">
<link rel="stylesheet" media="only screen and (max-width: 480px)" href="<?php bloginfo('template_directory'); ?>/css/mediaquerycss/styleMax480.css?ver=<?php echo(mt_rand(10,100)); ?>">

<?php
/* We add some JavaScript to pages with the comment form
* to support sites with threaded comments (when in use).
*/
/*(if (is_singular() && get_option('thread_comments'))
    wp_enqueue_script('comment-reply');*/

/* Always have wp_head() just before the closing </head>
* tag of your theme, or you will break many plugins, which
* generally use this hook to add elements to <head> such
* as styles, scripts, and meta tags.
*/
wp_enqueue_script('jquery');
wp_head();
?>
    <?php
    if(is_singular('product')) {
        $focuskw = get_post_meta(get_the_ID(), '_yoast_wpseo_focuskw', true);
        echo '<!-- This site is optimized with the Yoast SEO plugin v7.4.2 - https://yoast.com/wordpress/plugins/seo/ -->';
        echo '<meta name="keywords" content="'.$focuskw.'">';
    }
    ?>

<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/jquery.fancybox.css" />
<script src="<?php bloginfo('template_directory'); ?>/js/jquery.fancybox.pack.js"></script>

<script src="<?php bloginfo('template_directory'); ?>/js/modernizr-2.8.2-min.js"></script>
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/slicknav.css" />
<script src="<?php bloginfo('template_directory'); ?>/js/jquery.slicknav.js"></script>

<script>
	jQuery(function(){
		jQuery('.nav').slicknav({
		  prependTo:'#rspnavigation',
          label:''
		});
	});
</script>
<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery(".fancybox").fancybox({

		});
		jQuery(".fancybox_video").fancybox({
          helpers: {
              title : {
                  type : 'float'
              }
          },
          openEffect	: 'none',
		  closeEffect	: 'none'
		});
        jQuery(".fancybox_login_popup").fancybox({
            maxWidth: 700,
            maxHeight: 300,
            autoSize: false
		});
        jQuery(".gallery_img").fancybox({
          helpers: {
              title : {
                  type : 'float'
              }
          },
          openEffect	: 'none',
		  closeEffect	: 'none'
        });
        jQuery(".fancybox_gallery").fancybox({
            maxWidth: 600,
            maxHeight: 280,
            autoSize: false
		});
        jQuery(".product_img").fancybox({
            helpers: {
              title : {
                  type : 'float'
              },
            },
            maxWidth: 500,
            autoWidth: false
        });
	});
    jQuery(document).ready(function() {
        jQuery('#link_id').trigger('click');
	});
</script>
    <script src="<?php bloginfo('template_directory'); ?>/js/jquery.matchHeight-min.js"></script>
    <script src="<?php bloginfo('template_directory'); ?>/js/jquery.validate.min.js"></script>
    <script src="<?php bloginfo('template_directory'); ?>/js/additional-methods.js"></script>

<script type="text/javascript">
jQuery(function($){
    $('.matchheight').matchHeight();
});
</script>


<script>
function validateEmail(p1, p2) {
    if (p1.value != p2.value || p1.value == '' || p2.value == '') {
        p2.setCustomValidity('Email does not match');
    } else {
        p2.setCustomValidity('');
    }
}
</script>

<script>
function validatePass(p1, p2) {
    if (p1.value != p2.value || p1.value == '' || p2.value == '') {
        p2.setCustomValidity('Password does not match');
    } else {
        p2.setCustomValidity('');
    }
}
</script>

    <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/jquery.bxslider.css">
    <script src="<?php bloginfo('template_directory'); ?>/js/jquery.bxslider.min.js"></script>

<script>
jQuery(document).ready(function(){
    jQuery('.bxslider').bxSlider({
    });
    var pro_slider = jQuery('.pro_slider').bxSlider({
        slideWidth: 185,
        minSlides: 2,
        maxSlides: 6,
        slideMargin: 15,
        pager: false,
        controls: false,
        onSliderLoad: function(){
            jQuery(".pro_slider").css("visibility", "visible");
        }
    });
    jQuery('.pro_slider_next a').click(function(){
      pro_slider.goToNextSlide();
      return false;
    });
    jQuery('.pro_slider_prev a').click(function(){
      pro_slider.goToPrevSlide();
      return false;
    });

    jQuery('.pro_img_slider').each(function() {
        var this_element = jQuery(this);
        var id = this_element.attr('data-id');
        var pager = '#variation_dots_'+id+' .variation_dots';
        var this_bx = this_element.bxSlider({
            auto: false,
            speed: 200,
            pause: 1000,
            pager: false,
            controls: false,
            pagerCustom: pager
        });
        this_bx.mouseenter(function() {
            this_bx.startAuto();
        }).mouseleave(function() {
            this_bx.stopAuto();
            this_bx.goToSlide(0);
        });
    });

});
</script>

<script>
    function facyIframeClose(url) {
        //parent.jQuery.fancybox.close();
        console.log(url);
        parent.window.location.href = url;
   }
</script>

<script type="text/javascript">
    jQuery(function() {
    jQuery(".nav #mega-menu-wrap-mainmenu li.mega-menu-item-has-children").children("a").attr('href', "javascript:void(0)");
    });
</script>
<link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css' />

<!--<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=true&libraries=places"></script>-->

<?php
/*wp_register_script("jquery.placepicker.js", "//internationalprom.com/wp-content/themes/internationalprom-theme/js/jquery.placepicker.js");
wp_enqueue_script("jquery.placepicker.js");*/
?>
<script src="<?php bloginfo('template_directory'); ?>/js/jquery.placepicker.js"></script>

<script>

  jQuery(document).ready(function() {

    // Basic usage
    jQuery(".placepicker").placepicker();

    // Advanced usage
    jQuery("#advanced-placepicker").each(function() {
      var target = this;
      var collapse = jQuery(this).parents('.form-group').next('.collapse');
      var map = collapse.find('.another-map-class');

      var placepicker = jQuery(this).placepicker({
        map: map.get(0),
        placeChanged: function(place) {
          console.log("place changed: ", place.formatted_address, this.getLocation());
        }
      }).data('placepicker');
    });

  }); // END document.ready

</script>
<!-- DateTimePicker -->
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/jquery.datetimepicker.css" />
<script src="<?php bloginfo('template_directory'); ?>/js/jquery.datetimepicker.js"></script>


<?php if(is_singular()) { ?>
<?php while (have_posts()) : the_post(); ?>
<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' ); ?>
<meta property="og:url" content="<?php echo get_the_permalink(get_the_ID()); ?>"/>
<meta property="og:title" content="<?php echo get_the_title(get_the_ID()); ?>"/>
<meta property="og:content" content="<?php echo get_the_excerpt(); ?>"/>
<meta property="og:image" content="<?php echo $thumb[0]; ?>"/>
<?php endwhile; ?>
<?php } ?>
</head>
<body <?php body_class(); ?>>
<?php if(is_home()) { ?>
<?php if(!isset($_COOKIE['newsletter'])) { ?>
<?php setcookie('newsletter', 1, time() + (86400 * 30), "/"); ?>
<!--<a href="#inline" style="display: none;" id="link_id" class="fancybox">Pop Up</a>
<div id="inline" style="display: none;">
    <?php
        /*$args = array(
            'page_id' => 179,
            'post_status' => 'publish'
        );
        $the_query = new WP_Query( $args );
        if ( $the_query->have_posts() ) :
        while ( $the_query->have_posts() ) : $the_query->the_post();
    ?>
        <div class="section group">
            <div class="col span_7_of_12">
                <?php the_content(); ?>
                <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Newsletter') ) : ?> <?php endif; ?>
            </div>
            <div class="col span_5_of_12">
                <?php the_post_thumbnail('full') ?>
            </div>
        </div>
        <div class="social_nav">
            <ul>
                <li><a href="<?php echo get_option('facebook'); ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
                <li><a href="<?php echo get_option('twitter'); ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
                <li><a href="<?php echo get_option('instagram'); ?>" target="_blank"><i class="fa fa-instagram"></i></a></li>
                <li><a href="<?php echo get_option('pinterest'); ?>" target="_blank"><i class="fa fa-pinterest"></i></a></li>
                <li><a href="<?php echo get_option('linkedin'); ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                <li><a href="<?php echo get_option('rss'); ?>" target="_blank"><i class="fa fa-rss"></i></a></li>
            </ul>
        </div>
    <?php
        endwhile;
        endif;
        wp_reset_postdata();*/
    ?> 
</div>-->
<?php } ?>
<?php } ?>
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
<div id="header">
	<div class="maincontent noPadding">
	    <div class="section group">
	        <div class="col span_3_of_12">
                <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Logo') ) : ?> <?php endif; ?>
	        </div>
            <div class="col span_9_of_12">
                <div class="social_nav">
                    <ul>
                        <li><a href="<?php echo get_option('facebook'); ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="<?php echo get_option('twitter'); ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="<?php echo get_option('instagram'); ?>" target="_blank"><i class="fa fa-instagram"></i></a></li>
                        <li><a href="<?php echo get_option('pinterest'); ?>" target="_blank"><i class="fa fa-pinterest"></i></a></li>
                        <li><a href="<?php echo get_option('linkedin'); ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                        <li><a href="<?php echo get_option('rss'); ?>" target="_blank"><i class="fa fa-rss"></i></a></li>
                    </ul>
                </div>
                <div class="nav_acc">
                    <ul>
		                <?php if(is_user_logged_in()) { ?>
                            <li><a href="<?php bloginfo('url'); ?>/my-account">My Account</a></li>
                            <li class="cart_header"><a title="<?php _e( 'View your shopping cart' ); ?>" href="<?php echo wc_get_cart_url(); ?>"><i class="fa fa-shopping-bag" aria-hidden="true"></i>&nbsp;&nbsp;<?php echo sprintf ( _n( '%d item', '%d items', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?> - <?php echo WC()->cart->get_cart_total(); ?></a>
                                <?php if(WC()->cart->get_cart_contents_count() != 0) { ?>
	                            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('dropdown_cart') ) : ?> <?php endif; ?>
                                <?php } ?>
                            </li>
                            <li><a href="<?php echo esc_url( wp_logout_url( home_url() ) ); ?>">Log Out</a></li>
		                <?php } else { ?>
                            <li><a href="<?php bloginfo('url'); ?>/login">Sign In</a></li>
		                <?php } ?>
                    </ul>
                </div>
                <div class="nav_wrapper">
                    <div class="section group">
                        <div class="col span_10_of_12">
                            <div class="nav"><?php wp_nav_menu(array('theme_location' => 'mainmenu')); ?></div>
                            <div id="rspnavigation"></div>
                        </div>
                        <div class="col span_2_of_12">
                            <form class="nav_search" method="GET" action="<?php bloginfo('url'); ?>">
                                <input type="text" name="s" placeholder="SEARCH" />
                                <input type="submit" value="&#xf002;" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
	    </div>
	</div>
</div>