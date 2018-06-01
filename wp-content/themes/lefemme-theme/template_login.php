<?php /* Template Name: Login Template */ ?>
<?php get_header(); ?>
<div class="inner-page">
	<div class="maincontent">
	    <div class="section group">
            <div class="col span_4_of_12"></div>
	        <div class="col span_4_of_12">
                <div class="loginWrapper">
                    <?php include (TEMPLATEPATH . '/frameworks/authentication_fuctions/login.php'); ?>
                    <br />
                    <div class="section group">
                        <div class="col span_6_of_12">
                            <div style="text-align: left; font-size: 16px;"><a href="<?php bloginfo('url'); ?>/forgot-password">Forgot Password?</a></div>
                        </div>
                        <div class="col span_6_of_12">
                            <div style="text-align: right; font-size: 16px;"><a href="<?php bloginfo('url'); ?>/register">Register</a></div>
                        </div>
                    </div>
                    <br />
                    <?php do_action( 'wordpress_social_login' ); ?>
                </div>                         
	        </div>
            <div class="col span_4_of_12"></div>
	    </div>
	</div>
</div>
<?php get_footer(); ?>