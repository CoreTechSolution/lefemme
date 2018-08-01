<?php ob_start(); ?>
<?php
if(is_user_logged_in()) {
    header('Location: '.get_bloginfo('home').'/my-account');
}
session_start();
session_destroy();
if(isset($_POST['login'])){
    global $wpdb;
    $username = $wpdb->escape($_POST['loginid']);
	$pwd = $wpdb->escape($_POST['user_pwd']);
	$user_status = $wpdb->get_row($wpdb->prepare("SELECT * FROM $wpdb->users WHERE user_login = %s", $username));
	if(!empty($user_status)) {
		if ( $user_status->user_status == 1 ) {
			$login_data                  = array();
			$login_data['user_login']    = $username;
			$login_data['user_password'] = $pwd;
			$login_data['remember']      = 'false';
			$user_verify                 = wp_signon( $login_data, true );
			if ( is_wp_error( $user_verify ) ) {
				$user_verify->get_error_message();
				$errorCode = 1;
			} else {
				/*global $user_ID;
				if(!empty($_SESSION) && !empty($user_ID)){
					foreach ($_SESSION as $key=>$val){
						if(!update_user_meta( $user_ID, $key, $val )){
							add_user_meta( $user_ID, $key, $val, true );
						}
					}
				}*/
				$user_details = get_user_by( 'ID', $user_status->ID );
				if ( $user_details->roles[0] == 'seller' ) {
					header( 'Location: ' . dokan_get_navigation_url( 'dashboard' ) );
				} else {
					header( 'Location: ' . get_bloginfo( 'home' ) . '/my-account' );
				}
			}
			//exit();
		} else {
			$errorCode = 2; // invalid login details
		}
	} else {
		$errorCode = 3; // No account found
    }
}
?>
<?php if($errorCode == 1){ ?>
    <div class="woocommerce"><div class="woocommerce-error">Incorrect login details...Please try again.</div></div>
<?php } ?>
<?php if($errorCode == 2){ ?>
    <div class="woocommerce"><div class="woocommerce-info">Your account is not activated...Please check your mail and activate your account.</div></div>
<?php } ?>
<?php if($errorCode == 3){ ?>
    <div class="woocommerce"><div class="woocommerce-info">No account found with this email id.</div></div>
<?php } ?>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <h2>Welcome Back</h2>
            <form id="forms" method="post" action="">
                <div class="form-group">
                    <input class="form-control" type="text" name="loginid" placeholder="Email Address" />
                </div>
                <div class="form-group">
                    <input class="form-control" type="password" name="user_pwd" placeholder="Password" />
                </div>
                <div class="form-group">
                    <input class="btn" type="submit" name="login" value="Login" />
                </div>
                <div class="form-group" style="text-align: left; font-size: 16px;">
                    <a href="<?php bloginfo('url'); ?>/forgot-password">Forgot Password?</a>
                </div>
            </form>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <h2>I'm new here...</h2>
            <div><a class="btn" href="<?php bloginfo('url'); ?>/register">Register</a></div>
        </div>
    </div>
<script>
    jQuery(document).ready(function(){
        jQuery('#forms').validate({
            rules: {
                loginid: {
                    required: true
                },
                user_pwd: {
                    required: true
                }
            },
            messages: {
                
            }
        })
    });
</script>