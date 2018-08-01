<div id="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="footer_nav"><?php wp_nav_menu(array('theme_location' => 'footer_navigation')); ?></div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
		        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('newsletter') ) : ?> <?php endif; ?>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="footer_social_nav">
                    <ul>
                        <li><a href="<?php echo get_option('facebook'); ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="<?php echo get_option('instagram'); ?>" target="_blank"><i class="fa fa-instagram"></i></a></li>
                        <li><a href="<?php echo get_option('pinterest'); ?>" target="_blank"><i class="fa fa-pinterest"></i></a></li>
                        <li><a href="<?php echo get_option('twitter'); ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="<?php echo get_option('linkedin'); ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                    </ul>
                    <div class="copyright"><p><?php echo get_theme_mod( 'copyright' ); ?></p></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php if(is_home()) { ?>
    <script>
        jQuery(document).ready(function() {
            jQuery('a.fancybox_popup').trigger('click');
        });
    </script>
    <a class="fancybox_popup" style="display: none;" href="#popup"></a>
    <div id="popup" style="display: none; width: 97%;">
        <div class="newsletter_wrapper1">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
			        <?php if ( get_theme_mod( 'newsletter_image' ) ) { ?>
                        <img src="<?php echo get_theme_mod( 'newsletter_image' ); ?>" />
			        <?php } ?>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="newsletter_content_wrap">
				        <?php if ( get_theme_mod( 'newsletter_heading' ) ) { ?>
                            <h2><?php echo get_theme_mod( 'newsletter_heading' ); ?></h2>
				        <?php } ?>
                        <div class="newsletter_content">
                            <?php if ( get_theme_mod( 'newsletter_text' ) ) { ?>
                                <p><?php echo do_shortcode(get_theme_mod( 'newsletter_text' )); ?></p>
                            <?php } ?>
                        </div>
	                    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('newsletter') ) : ?> <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<?php wp_footer(); ?>
</body>
</html>