<?php /* Template Name: Reset Password Template */ ?>
<?php get_header(); ?>
    <div class="inner-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-12"></div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="loginWrapper">
						<?php include (TEMPLATEPATH . '/frameworks/authentication_fuctions/resetpassword.php'); ?>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12"></div>
            </div>
        </div>
    </div>
<?php get_footer(); ?>