<?php
    global $wpdb, $user_ID;
	if (empty($user_ID)) {
		if(isset($_POST['sendid'])){
			$user_login = $_POST['userid'];
			$user_data = $wpdb->get_row($wpdb->prepare("SELECT ID, user_login, user_activation_key FROM $wpdb->users WHERE user_email = %s", $_POST['userid']));
            $encripted_email = encripted($_POST['userid']);
			if(!empty($user_data)){
                $subject = "Reset Password";
				$from = "no-reply@".$_SERVER['HTTP_HOST'];
            	$headers1 = 'From: '.$from. "\r\n";
                $headers1 .= "Reply-To: ".get_option('admin_email')."\r\n";
                $headers1 .= "MIME-Version: 1.0\n"; 
                $headers1 .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        
                $useremail = $_POST['userid'];
                $reseturl = get_bloginfo('url');
				$emailmsg = "Please click on the following link to reset your password <a href='$reseturl/reset-password/?action=$encripted_email'>Reset Password</a>";
                
                if(wp_mail( $_POST['userid'], $subject, $emailmsg, $headers1 )){
                    echo 'Please check your registered email and click on the reset password link.';
				    header("Location: ".get_bloginfo('home')."/thank-you/?action=".encripted('forgotpassword'));
                } else {
                    echo 'can not send mail';
                }
			}
		}
	} else {
	   echo 'some thing is wrong';
		//header('Location:'.get_bloginfo('home').'/forgot-password');
	}
?>
<div class="commonForm">
    <h2 style="text-align: center;">Forgot Password</h2>
    <form id="forms" method="post" action="">
        <div>
            <label>Registered Email Address</label>
            <input type="text" name="userid" />
        </div>
        <div><input type="submit" name="sendid" value="Send Request" class="fullwidthBtn"></div>
    </form>
</div>
<script>
jQuery(document).ready(function(){
    jQuery('#forms').validate({
        rules: {
            userid: {
                required: true,
                email: true
            }
        },
        messages: {
            
        }
    })
});
</script>