<?php
/* Template Name: Process Sub Order */
require_once(TEMPLATEPATH.'/stripe-php/config.php');
$commission = get_option('commission');
if(empty($commission)) {
	$commission = 0;
}
$args = array(
	'post_type'   => 'shop_order',
	'post_status' => 'wc-completed',
	'posts_per_page' => -1
);
$the_query = new WP_Query($args);

if ( $the_query->have_posts() ) {
	while ( $the_query->have_posts() ) : $the_query->the_post();
		$order_complete_time = get_post_meta( get_the_ID(), 'order_complete_time', true );
		if ( ! empty( $order_complete_time ) ) {
			if ( time() - strtotime( $order_complete_time ) < 60 * 60 * 72 ) {
				$parent     = get_the_ID();
				$args1      = array(
					'post_type'      => 'shop_order',
					'post_parent'    => $parent,
					'post_status'    => 'wc-completed',
					'posts_per_page' => - 1
				);
				$the_query1 = new WP_Query( $args1 );

				if ( $the_query1->have_posts() ) {
					while ( $the_query1->have_posts() ) : $the_query1->the_post();
						$paid_to_vendor = get_post_meta(get_the_ID(), 'paid_to_vendor', true);
						if($paid_to_vendor != 1) {
							global $post;
							$author_id      = $post->post_author;
							$order          = wc_get_order( get_the_ID() );
							$order_data     = $order->get_data();
							$total          = $order_data['total'];
							$stripe_resp    = json_decode( get_user_meta( $author_id, 'stripe_resp', true ) );
							$stripe_user_id = $stripe_resp->stripe_user_id;
							if ( ! empty( $stripe_user_id ) ) {
								$group = "PAYMENT TO " . get_user_meta( $author_id, 'company_name', true );
								if($commission != 0) {
									$total = $total - ( ( $total * $commission ) / 100 );
								}

								$transfer = \Stripe\Transfer::create( array(
									"amount"         => $total * 100,
									"currency"       => "usd",
									"destination"    => $stripe_user_id,
									"transfer_group" => $group
								) );

								update_post_meta( get_the_ID(), 'paid_to_vendor', 1 );
							}
						}
					endwhile;
				} else {
					$paid_to_vendor = get_post_meta(get_the_ID(), 'paid_to_vendor', true);
					if($paid_to_vendor != 1) {
						global $post;
						$author_id      = $post->post_author;
						$order          = wc_get_order( get_the_ID() );
						$order_data     = $order->get_data();
						$total          = $order_data['total'];
						$stripe_resp    = json_decode( get_user_meta( $author_id, 'stripe_resp', true ) );
						$stripe_user_id = $stripe_resp->stripe_user_id;
						if ( ! empty( $stripe_user_id ) ) {
							$group = "PAYMENT TO " . get_user_meta( $author_id, 'company_name', true );
							if($commission != 0) {
								$total = $total - ( ( $total * $commission ) / 100 );
							}

							$transfer = \Stripe\Transfer::create( array(
								"amount"         => $total * 100,
								"currency"       => "usd",
								"destination"    => $stripe_user_id,
								"transfer_group" => $group
							) );

							update_post_meta( get_the_ID(), 'paid_to_vendor', 1 );
						}
					}
				}
			}
		}
	endwhile;
}