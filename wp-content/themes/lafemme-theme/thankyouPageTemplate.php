<?php /* Template Name: Thank You Template */ ?>
<?php get_header(); ?>
<div class="inner-page">
	<div class="container">
	    <!--<div class="row">
	        <div class="col-lg-12 col-md-12 col-sm-12">
                <h1><span><?php /*the_title(); */?></span></h1>
	        </div>
	    </div>-->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <?php
					$action = decripted($_GET['action']);
					if($action == 'registration'){
						echo "<p class='alert alert-info'>Please check your mail to complete your registration ptocess.<br />if email does not appear in your inbox 
please check your spam folder</p>";
					}
					if($action == 'forgotpassword'){
						echo "<p class='alert alert-info'>Please check your registered email and click on the reset password link.</p>";
					}
					if($action == 'resetpassword'){
                ?>
					<p class='alert alert-success'>Your password updated successfully. Please click here to <a class="alink" href="<?php bloginfo('home'); ?>/sign-in">Login</a>.</p>
				<?php } ?>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>