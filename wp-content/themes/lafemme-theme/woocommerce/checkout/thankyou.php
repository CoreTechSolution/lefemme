<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="woocommerce-order">

	<?php if ( $order ) : ?>

		<?php if ( $order->has_status( 'failed' ) ) : ?>

			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php _e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce' ); ?></p>

			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
				<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php _e( 'Pay', 'woocommerce' ) ?></a>
				<?php if ( is_user_logged_in() ) : ?>
					<a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button pay"><?php _e( 'My account', 'woocommerce' ); ?></a>
				<?php endif; ?>
			</p>

		<?php else : ?>

			<?php
			/*$order_id = $order->get_order_number();
			$order = new WC_Order( $order_id );
			//$items = $order->get_items();

			$searchZip = $order->get_shipping_postcode();
			$user_query = new WP_User_Query( array( 'role' => 'seller' ) );
			if (!empty($user_query->get_results())) {
				$distance_array = array();
				foreach ( $user_query->get_results() as $user ) {
					$zip = get_user_meta( $user->ID, 'zip', true );
					if ( ! empty( $zip ) ) {
						$level = get_user_meta($user->ID, 'level', true);
						if($level == 'Gold') {
							$distance_data = api_curl_connect( 'https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=' . $searchZip . '&destinations=' . $zip . '&key=AIzaSyAIbrST4XMbdTta08vfp4AFA3gpitVovVQ' );
							if ( $distance_data->status == 'OK' ) {
								if ( $distance_data->rows[0]->elements[0]->status == 'OK' ) {
									$distance = $distance_data->rows[0]->elements[0]->distance->value;
									$distance = $distance / 1000;
									if ( $distance <= 144.841 ) {
										$distance_array[ $user->ID ] = $distance;
									}
								}
							}
						}
					}
				}
				if(empty($distance_array)) {
					foreach ( $user_query->get_results() as $user ) {
						$zip = get_user_meta( $user->ID, 'zip', true );
						if ( ! empty( $zip ) ) {
							$level = get_user_meta($user->ID, 'level', true);
							if($level == 'Silver') {
								$distance_data = api_curl_connect( 'https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=' . $searchZip . '&destinations=' . $zip . '&key=AIzaSyAIbrST4XMbdTta08vfp4AFA3gpitVovVQ' );
								if ( $distance_data->status == 'OK' ) {
									if ( $distance_data->rows[0]->elements[0]->status == 'OK' ) {
										$distance = $distance_data->rows[0]->elements[0]->distance->value;
										$distance = $distance / 1000;
										if ( $distance <= 144.841 ) {
											$distance_array[ $user->ID ] = $distance;
										}
									}
								}
							}
						}
					}
				}
				if(empty($distance_array)) {
					foreach ( $user_query->get_results() as $user ) {
						$zip = get_user_meta( $user->ID, 'zip', true );
						if ( ! empty( $zip ) ) {
							$level = get_user_meta($user->ID, 'level', true);
							if($level == 'Bronze') {
								$distance_data = api_curl_connect( 'https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=' . $searchZip . '&destinations=' . $zip . '&key=AIzaSyAIbrST4XMbdTta08vfp4AFA3gpitVovVQ' );
								if ( $distance_data->status == 'OK' ) {
									if ( $distance_data->rows[0]->elements[0]->status == 'OK' ) {
										$distance = $distance_data->rows[0]->elements[0]->distance->value;
										$distance = $distance / 1000;
										if ( $distance <= 144.841 ) {
											$distance_array[ $user->ID ] = $distance;
										}
									}
								}
							}
						}
					}
				}
				if(empty($distance_array)) {
					foreach ( $user_query->get_results() as $user ) {
						$zip = get_user_meta( $user->ID, 'zip', true );
						if ( ! empty( $zip ) ) {
							$level = get_user_meta($user->ID, 'level', true);
							$distance_data = api_curl_connect( 'https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=' . $searchZip . '&destinations=' . $zip . '&key=AIzaSyAIbrST4XMbdTta08vfp4AFA3gpitVovVQ' );
							if ( $distance_data->status == 'OK' ) {
								if ( $distance_data->rows[0]->elements[0]->status == 'OK' ) {
									$distance = $distance_data->rows[0]->elements[0]->distance->value;
									$distance = $distance / 1000;
									if ( $distance <= 144.841 ) {
										$distance_array[ $user->ID ] = $distance;
									}
								}
							}
						}
					}
				}
				if(!empty($distance_array)) {
					asort($distance_array);
					$i = 0;
					foreach ( $distance_array as $key => $value ) {
						if($i == 0) {
							$seller_id = $key;
						}
						$i++;
					}
				}
			}

			if(!empty($seller_id)) {
				global $wpdb;
				$wpdb->update( $wpdb->prefix . 'dokan_orders', array( 'seller_id' => $seller_id ), array( 'order_id' => $order_id ) );
				$arg = array(
					'ID'          => $order_id,
					'post_author' => $seller_id,
				);
				wp_update_post( $arg );
			}*/
			?>

			<p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', __( 'Thank you. Your order has been received.', 'woocommerce' ), $order ); ?></p>

			<ul class="woocommerce-order-overview woocommerce-thankyou-order-details order_details">

				<li class="woocommerce-order-overview__order order">
					<?php _e( 'Order number:', 'woocommerce' ); ?>
					<strong><?php echo $order->get_order_number(); ?></strong>
				</li>

				<li class="woocommerce-order-overview__date date">
					<?php _e( 'Date:', 'woocommerce' ); ?>
					<strong><?php echo wc_format_datetime( $order->get_date_created() ); ?></strong>
				</li>

				<?php if ( is_user_logged_in() && $order->get_user_id() === get_current_user_id() && $order->get_billing_email() ) : ?>
					<li class="woocommerce-order-overview__email email">
						<?php _e( 'Email:', 'woocommerce' ); ?>
						<strong><?php echo $order->get_billing_email(); ?></strong>
					</li>
				<?php endif; ?>

				<li class="woocommerce-order-overview__total total">
					<?php _e( 'Total:', 'woocommerce' ); ?>
					<strong><?php echo $order->get_formatted_order_total(); ?></strong>
				</li>

				<?php if ( $order->get_payment_method_title() ) : ?>
					<li class="woocommerce-order-overview__payment-method method">
						<?php _e( 'Payment method:', 'woocommerce' ); ?>
						<strong><?php echo wp_kses_post( $order->get_payment_method_title() ); ?></strong>
					</li>
				<?php endif; ?>

			</ul>

		<?php endif; ?>

		<?php do_action( 'woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id() ); ?>
		<?php do_action( 'woocommerce_thankyou', $order->get_id() ); ?>

	<?php else : ?>

		<p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', __( 'Thank you. Your order has been received.', 'woocommerce' ), null ); ?></p>

	<?php endif; ?>

</div>
