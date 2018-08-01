<?php
$action = decripted($_GET['action']);
	if($action == 'registration'){
		echo "<p class='alert alert-info'>Thankyou for registration. Please check your email to activate your account.</p>";
	}
	if($action == 'forgotpassword'){
		echo "<p class='alert alert-info'>Please check your registered email and click on the reset password link.</p>";
	}
    if($action == 'payment'){
		echo "<p class='alert alert-success'>Payment Successfull.</p>";
	}
	if($action == 'resetpassword'){
?>
	<p class='alert alert-success'>Your password updated successfully. Please click here to <a class="alink" href="<?php bloginfo('home'); ?>/log-in">Login</a>.</p>
<?php } ?>