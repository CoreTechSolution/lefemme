<?php
/**
 * Dokan Settings Payment Template
 *
 * @since 2.2.2 Insert action before payment settings form
 *
 * @package dokan
 */
do_action( 'dokan_payment_settings_before_form', $current_user, $profile_info ); ?>

<form method="post" id="payment-form"  action="" class="dokan-form-horizontal">

    <?php wp_nonce_field( 'dokan_payment_settings_nonce' ); ?>

    <?php /*foreach ( $methods as $method_key ) {
        $method = dokan_withdraw_get_method( $method_key );
        */?><!--
        <fieldset class="payment-field-<?php /*echo $method_key; */?>">
            <div class="dokan-form-group">
                <label class="dokan-w3 dokan-control-label" for="dokan_setting"><?php /*echo $method['title'] */?></label>
                <div class="dokan-w6">
                    <?php /*if ( is_callable( $method['callback'] ) ) {
                        call_user_func( $method['callback'], $profile_info );
                    } */?>
                </div>
            </div>
        </fieldset>
    --><?php /*} */?>
    <?php if(is_plugin_active('woocommerce/woocommerce.php') && is_plugin_active('woocommerce-gateway-stripe/woocommerce-gateway-stripe.php')) { ?>
    <fieldset class="payment-field-stripe-connect">
        <div class="dokan-form-group">
            <label class="dokan-w3 dokan-control-label" for="dokan_setting"></label>
            <div class="dokan-w12">
	            <?php
	            global $user_ID;

	            require_once(TEMPLATEPATH.'/stripe-php/config.php');

	            session_start();
	            if (isset($_GET['code']) && $_SESSION['state'] == decripted($_GET['state'])) { // Redirect w/ code
		            $code = $_GET['code'];

		            $token_request_body = array(
			            'grant_type' => 'authorization_code',
			            'client_id' => 'ca_AQUs1uvoGvoqst7cmZavAlqPQ2LaUl8w',
			            'code' => $code,
			            'client_secret' => $stripe['secret_key']
		            );

		            $req = curl_init('https://connect.stripe.com/oauth/token');
		            curl_setopt($req, CURLOPT_RETURNTRANSFER, true);
		            curl_setopt($req, CURLOPT_POST, true );
		            curl_setopt($req, CURLOPT_POSTFIELDS, http_build_query($token_request_body));

		            // TODO: Additional error handling
		            $respCode = curl_getinfo($req, CURLINFO_HTTP_CODE);
		            $resp = json_decode(curl_exec($req), true);
		            curl_close($req);

		            //echo $resp['access_token'];
		            update_user_meta( $user_ID, 'stripe_resp', json_encode($resp) );
	            } else if (isset($_GET['error'])) { // Error
		            echo $_GET['error_description'];
	            } else { // Show OAuth link
		            /*$authorize_request_body = array(
						'response_type' => 'code',
						'scope' => 'read_write',
						'client_id' => ''
					);

					$url = AUTHORIZE_URI . '?' . http_build_query($authorize_request_body);
					echo "<a href='$url'>Connect with Stripe</a>";*/
	            }
	            $stripe_resp = get_user_meta($user_ID, 'stripe_resp', true);
	            if(empty($stripe_resp)) {
		            $not_connected = 1;
	            }

	            $redirect_uri = get_bloginfo('url').'/dashboard/settings/payment/';
	            $state = rand(1, 1000);
	            $state_enc = encripted($state);
	            session_start();
	            $_SESSION['state'] = $state;
	            ?>
	            <?php if($not_connected == 1) { ?>
                    <a href="https://connect.stripe.com/oauth/authorize?response_type=code&client_id=ca_AQUs1uvoGvoqst7cmZavAlqPQ2LaUl8w&scope=read_write&redirect_uri=<?php echo urlencode($redirect_uri); ?>&state=<?php echo $state_enc; ?>"><img src="<?php bloginfo('template_directory'); ?>/images/stripe-blue-on-light.png" /></a>
	            <?php } else { ?>
                    <p class="successMsg">Connected with stripe</p>
	            <?php } ?>
            </div> <!-- .dokan-w6 -->
        </div>
    </fieldset>
    <?php } ?>
    <?php
    /**
     * @since 2.2.2 Insert action on botton of payment settings form
     */
    //do_action( 'dokan_payment_settings_form_bottom', $current_user, $profile_info ); ?>

    <!--<div class="dokan-form-group">

        <div class="dokan-w4 ajax_prev dokan-text-left" style="margin-left:24%;">
            <input type="submit" name="dokan_update_payment_settings" class="dokan-btn dokan-btn-danger dokan-btn-theme" value="<?php /*esc_attr_e( 'Update Settings', 'dokan-lite' ); */?>">
        </div>
    </div>-->

</form>

<?php
/**
 * @since 2.2.2 Insert action after social settings form
 */
do_action( 'dokan_payment_settings_after_form', $current_user, $profile_info ); ?>
