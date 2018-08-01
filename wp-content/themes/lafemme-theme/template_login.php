<?php /* Template Name: Login Template */ ?>
<?php get_header(); ?>
<div class="inner-page">
	<div class="container">
	    <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-12"></div>
	        <div class="col-lg-8 col-md-8 col-sm-12">
                <div class="loginWrapper">
                    <?php include (TEMPLATEPATH . '/frameworks/authentication_fuctions/login.php'); ?>
                    <!--<br />
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div style="text-align: left; font-size: 16px;"><a href="<?php /*bloginfo('url'); */?>/forgot-password">Forgot Password?</a></div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div style="text-align: right; font-size: 16px;"><a href="<?php /*bloginfo('url'); */?>/register">Register</a></div>
                        </div>
                    </div>-->
                    <br />
                </div>                         
	        </div>
            <div class="col-lg-2 col-md-2 col-sm-12"></div>
	    </div>
	</div>
</div>
<?php get_footer(); ?>