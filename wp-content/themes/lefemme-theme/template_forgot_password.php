<?php /* Template Name: Forgot Password Template */ ?>
<?php get_header(); ?>
<div class="inner-page">
	<div class="maincontent">
	    <div class="section group">
            <div class="col span_4_of_12"></div>
	        <div class="col span_4_of_12">
                <div class="loginWrapper">
                    <?php include (TEMPLATEPATH . '/frameworks/authentication_fuctions/forgotpassword.php'); ?>
                </div>                         
	        </div>
            <div class="col span_4_of_12"></div>
	    </div>
	</div>
</div>
<?php get_footer(); ?>