<?php ob_start(); ?>
<?php
global $options;
if(isset($_POST['register'])){
    global $wpdb;
    if(email_exists($_POST['email_address'])){
        $errorCode = 1;
    } else {
        $new_user_id = wp_insert_user(
            array(
                'user_login'		=> $_POST['email_address'],
                'user_pass'			=> $_POST['pwd1'],
                'user_email'		=> $_POST['email_address'],
                'first_name'		=> $_POST['fname'],
                'last_name'         => $_POST['lname'],
                'role'              => $_POST['acc_type'],
                'user_registered'	=> date('Y-m-d H:i:s')
            )
        );
        /*add_user_meta($new_user_id,'phone', $_POST['phone']);
        add_user_meta($new_user_id,'city', $_POST['city']);
        add_user_meta($new_user_id,'state', $_POST['state']);
        add_user_meta($new_user_id,'zipcode', $_POST['zipcode']);
        add_user_meta($new_user_id,'country', $_POST['country']);
        add_user_meta($new_user_id,'paypal_email', $_POST['paypal_email']);
	    add_user_meta($new_user_id, 'item_sold', 0);
	    add_user_meta($new_user_id, 'membership', 'none');*/

        update_user_meta( $new_user_id, 'first_name', sanitize_text_field( $_POST['fname'] ) );
        update_user_meta( $new_user_id, 'last_name', sanitize_text_field( $_POST['lname'] ) );

        update_user_meta( $new_user_id, 'billing_first_name', sanitize_text_field( $_POST['fname'] ) );
        update_user_meta( $new_user_id, 'billing_last_name', sanitize_text_field( $_POST['lname'] ) );
        /*update_user_meta( $new_user_id, 'billing_phone', sanitize_text_field( $_POST['phone'] ) );
        update_user_meta( $new_user_id, 'billing_country', sanitize_text_field( $_POST['country'] ) );
        update_user_meta( $new_user_id, 'billing_city', sanitize_text_field( $_POST['city'] ) );
        update_user_meta( $new_user_id, 'billing_state', sanitize_text_field( $_POST['state'] ) );
        update_user_meta( $new_user_id, 'billing_postcode', sanitize_text_field( $_POST['zipcode'] ) );
        update_user_meta( $new_user_id, 'billing_address', sanitize_text_field( $_POST['address'] ) );*/

        update_user_meta( $new_user_id, 'shipping_first_name', sanitize_text_field( $_POST['fname'] ) );
        update_user_meta( $new_user_id, 'shipping_last_name', sanitize_text_field( $_POST['lname'] ) );
        /*update_user_meta( $new_user_id, 'shipping_phone', sanitize_text_field( $_POST['phone'] ) );
        update_user_meta( $new_user_id, 'shipping_country', sanitize_text_field( $_POST['country'] ) );
        update_user_meta( $new_user_id, 'shipping_city', sanitize_text_field( $_POST['city'] ) );
        update_user_meta( $new_user_id, 'shipping_state', sanitize_text_field( $_POST['state'] ) );
        update_user_meta( $new_user_id, 'shipping_postcode', sanitize_text_field( $_POST['zipcode'] ) );
        update_user_meta( $new_user_id, 'shipping_address', sanitize_text_field( $_POST['address'] ) );*/
        
        $key = $wpdb->get_var($wpdb->prepare("SELECT user_activation_key FROM $wpdb->users WHERE user_login = %s", $_POST['email_address']));
        if(empty($key)) {
    	    $key = wp_generate_password(20, false);
    		$wpdb->update($wpdb->users, array('user_activation_key' => $key), array('user_login' => $_POST['email_address']));
        }
        $admin_name = get_bloginfo('name');
        // mail to user
        $to1 = $_POST['email_address'];
    	$from1 = get_option('admin_email');
    	$headers1 = 'From: '.$from1. "\r\n";
        $headers1 .= "Reply-To: ".get_option('admin_email')."\r\n";
        $headers1 .= "MIME-Version: 1.0\n"; 
        $headers1 .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
    	$subject1 = "Activate your account"; 
        $msg1 = 'Activation Link :<a href="'.get_site_url().'/activation?key='.$key.'" target="_blank">'.get_site_url().'/activation?key='.$key.'</a>';

        wp_mail( $to1, $subject1, $msg1, $headers1 );
        
        // Mail to admin
        
        $to = get_option('admin_email');
    	$from = get_option('admin_email');
    	$headers = 'From: '.$from . "\r\n";
        $headers .= "Reply-To: ".get_option('admin_email')."\r\n";
        $headers .= "MIME-Version: 1.0\n"; 
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
    	$subject = "New User registered"; 
        /*$msg ='<strong>New User registered</strong><br><br><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="45%"><strong>Name : </strong></td>
                    <td>'.$_POST['fname'].' '.$_POST['lname'].'</td>
                  </tr>
                  <tr>
                    <td><strong>Phone Number : </strong></td>
                    <td>'.$_POST['phone'].'</td>
                  </tr>
                  <tr>
                    <td><strong>Email : </strong></td>
                    <td>'.$_POST['email_address'].'</td>
                  </tr>
                  <tr>
                    <td><strong>City : </strong></td>
                    <td>'.$_POST['city'].'</td>
                  </tr>
                  <tr>
                    <td><strong>State : </strong></td>
                    <td>'.$_POST['state'].'</td>
                  </tr>
                  <tr>
                    <td><strong>Country : </strong></td>
                    <td>'.$_POST['country'].'</td>
                  </tr>
                  <tr>
                    <td><strong>ZIP : </strong></td>
                    <td>'.$_POST['zipcode'].'</td>
                  </tr>
                </table><br><br>Regards,<br>'.$admin_name;*/
	    $msg ='<strong>New User registered</strong><br><br><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="45%"><strong>Name : </strong></td>
                    <td>'.$_POST['fname'].' '.$_POST['lname'].'</td>
                  </tr>
                  <tr>
                    <td><strong>Email : </strong></td>
                    <td>'.$_POST['email_address'].'</td>
                  </tr>
                </table><br><br>Regards,<br>'.$admin_name;
    	wp_mail( $to, $subject, $msg, $headers );
        header("Location: ".get_bloginfo('home')."/thank-you/?action=".encripted('registration'));
    }
}
?>
    <h2>I'm new here...</h2>
    <?php if($errorCode == 1){ ?>
        <div class="woocommerce"><div class="woocommerce-error">Email ID already present. Please use different Email ID.</div></div>
    <?php }?>
    <form id="forms" action="" method="post">
        <div class="form-group">
            <!--<label>First Name <span>*</span></label>-->
            <input class="form-control" type="text" name="fname" value="" placeholder="First Name *" />
        </div>
        <div class="form-group">
            <!--<label>Last Name <span>*</span></label>-->
            <input class="form-control" type="text" name="lname" value="" placeholder="Last Name *" />
        </div>
        <div class="form-group">
            <!--<label>Email Address <span>*</span></label>-->
            <input class="form-control" type="text" name="email_address" value="" placeholder="Email Address *" />
        </div>
        <!--<div class="form-group">
            <label>Phone</label>
            <p><input class="form-control" type="text" name="phone" value="" /></p>
        </div>-->
        <div class="form-group">
            <!--<label>Password <span>*</span></label>-->
            <input class="form-control" id="pwd1" type="password" name="pwd1" placeholder="Password *" />
            <!--<strong>Tips: </strong>Your password length should be minimum 8 character and it must contain lowercase, uppercase, numerics and special characters.-->
        </div>
        <div class="form-group">
            <!--<label>Confirm Password <span>*</span></label>-->
            <p><input class="form-control" id="pwd2" type="password" name="pwd2" placeholder="Confirm Password *" /></p>
        </div>
        <!--<div class="form-group">
            <label>City <span>*</span></label>
            <p><input class="form-control" type="text" name="city" value="" /></p>
        </div>
        <div class="form-group">
            <label>Country <span>*</span></label>
		    <?php
/*		    global $woocommerce;
		    $countries_obj   = new WC_Countries();
		    $countries   = $countries_obj->__get('countries');
		    $default_country = $countries_obj->get_base_country();

		    woocommerce_form_field('country', array(
			    'type'        => 'select',
			    'class'       => array( 'lafemme_drop_country' ),
			    'input_class' => array( 'form-control' ),
			    'required'    => false,
			    //'label'     => __('Select a country'),
			    'placeholder' => __('Enter something'),
			    'options'     => $countries
		    ), $default_country
		    );
		    */?>
        </div>
        <div id="state" class="form-group">
		    <?php /*$default_county_states = $countries_obj->get_states( $default_country ); */?>
		    <?php /*if(!empty($default_county_states)) { */?>
                <label>State</label>
			    <?php
/*			    woocommerce_form_field('state', array(
					    'type'        => 'select',
					    'class'       => array( 'lafemme_drop_state' ),
					    'input_class' => array( 'form-control' ),
					    'required'    => false,
					    //'label'     => __('Select a state'),
					    'placeholder' => __('Enter something'),
					    'options'     => $default_county_states
				    )
			    );
			    */?>
		    <?php /*} */?>
        </div>
        <div class="form-group">
            <label>Postcode / Zip</label>
            <p><input class="form-control" type="text" name="zipcode" value="" /></p>
        </div>
        <div class="form-group">
            <label>Address</label>
            <p><input class="form-control" type="text" name="address" value="" /></p>
        </div>-->
        <div class="form-group">
            <!--<label>Accout Type</label>-->
            <select class="form-control required" name="acc_type">
                <option>Accout Type</option>
                <option value="seller">Seller</option>
                <option value="customer">Customer</option>
            </select>
        </div>
        <!--<div class="form-group">
            <label>Paypal Email</label>
            <p><input type="text" name="paypal_email" value="" /></p>
        </div>-->
        <div class="form-group">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <input class="btn" type="submit" name="register" value="Register" />
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <p style="text-align: center; margin-top: 12px;">Already have an account?</p>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div style="text-align: right;"><a class="btn" href="<?php bloginfo('url'); ?>/login">Login</a></div>
                </div>
            </div>
        </div>
    </form>
<script>
jQuery(document).ready(function(){
    jQuery('#forms').validate({
        rules: {
            fname: {
                required: true
            },
            lname: {
                required: true
            },
            email_address: {
                required: true,
                email: true
            },
            pwd1: {
                required: true,
                minlength: 8,
                hasLower: true,
                hasUpper: true,
                hasDigital: true,
                hasSpecial: true,
            },
            acc_type: {
                required: true,
            }
            /*pwd2:{
                required: true,
                minlength: 8,
                equalTo: '#pwd1'
            },
            country:{
                required: true
            },
            city:{
                required: true
            },
            address:{
                required: true
            },*/
            /*paypal_email:{
                required: true
            }*/
        },
        messages: {
            
        }
    })
});
</script>