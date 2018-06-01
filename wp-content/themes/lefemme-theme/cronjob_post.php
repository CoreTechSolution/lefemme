<?php /* Template Name: Cronjob Post */ ?>
<?php

require_once ("php-graph-sdk-5.4/src/Facebook/autoload.php");
$fb = new Facebook\Facebook( [
	'app_id'                => get_option( 'FACEBOOK_APP_ID' ), // Replace {app-id} with your app id
	'app_secret'            => get_option( 'FACEBOOK_APP_SECRET' ),
	'default_graph_version' => 'v2.2',
] );
require_once ("twitteroauth-master/autoload.php");
use Abraham\TwitterOAuth\TwitterOAuth;

$tz = get_option('timezone_string');
date_default_timezone_set($tz);
$current_date = date('Y-m-d');
$current_time = date('g:i A');
$post_args = array(
	'post_type' => 'cal_post_event',
	'post_status' => 'publish',
	'posts_per_page' => -1,
	'meta_query' => array(
		array(
			'key' => 'event_date',
			'value' => $current_date,
			'compare' => '='
		),
		'relation' => 'AND',
		array(
			'key' => 'event_time',
			'value' => $current_time,
			'compare' => 'LIKE'
		)
	)
);

$cal_post_event_data = new WP_Query($post_args);

if($cal_post_event_data->have_posts()){
	while($cal_post_event_data->have_posts()) : $cal_post_event_data->the_post();
		$cal_post_event_id = get_the_ID();
		$post_author_id = get_post_field( 'post_author', $cal_post_event_id );
		$type = get_post_meta($cal_post_event_id, 'type', true);
		$event_image = get_post_meta(get_the_ID(), 'event_image', true);
		$text = wp_strip_all_tags(get_the_content());
		switch ($type) {
			case "facebook":
				$facebook_access_token = get_user_meta($post_author_id, 'facebook_access_token', TRUE);
				if (!empty($facebook_access_token)) {
					if(!empty($event_image)) {
						$data = [
							'message' => $text,
							'source'  => $fb->fileToUpload( $event_image ),
						];

						try {
							// Returns a `Facebook\FacebookResponse` object
							$response = $fb->post( '/me/photos', $data, $facebook_access_token );
						} catch ( Facebook\Exceptions\FacebookResponseException $e ) {
							echo 'Graph returned an error: ' . $e->getMessage();
							exit;
						} catch ( Facebook\Exceptions\FacebookSDKException $e ) {
							echo 'Facebook SDK returned an error: ' . $e->getMessage();
							exit;
						}

						$graphNode = $response->getGraphNode();

						$res  = $fb->post( '/me/feed', array(
							'message'           => $text,
							'attached_media[0]' => '{"media_fbid":"' . $graphNode['id'] . '"}',
						), $facebook_access_token );
						$post = $res->getGraphObject();
					} else {
						$res  = $fb->post( '/me/feed', array(
							'message'           => wp_strip_all_tags(get_the_content())
						), $facebook_access_token );
						$post = $res->getGraphObject();
					}
				}
				break;
			case "twitter":
				$twitter_access_token = get_user_meta($post_author_id, 'twitter_access_token', TRUE);
				if (!empty($twitter_access_token)) {
					$twitter_access_token = get_user_meta($post_author_id, 'twitter_access_token', TRUE);
					$twitter_token_secret = get_user_meta($post_author_id, 'twitter_token_secret', TRUE);
					$connection = new TwitterOAuth(get_option('TWITTER_CONSUMER_KEY'), get_option('TWITTER_CONSUMER_SECRET'), $twitter_access_token, $twitter_token_secret);
					if(!empty($event_image)) {
						$media1 = $connection->upload('media/upload', ['media' => $event_image]);
						$parameters = [
							'status' => $text,
							'media_ids' => implode(',', [$media1->media_id_string, $media2->media_id_string])
						];
						$result = $connection->post('statuses/update', $parameters);
					} else {
						$result = $connection->post("statuses/update", ["status" => $text]);
					}
					print_r($result);
				}
				break;
			case "pinterest":
				$pinterest_access_token = get_user_meta($post_author_id, 'pinterest_access_token', true);
				if (!empty($pinterest_access_token)) {
					$board = get_post_meta($cal_post_event_id, 'pinboard', true);
					/*if(empty($board)) {
						$board = 'internationalprom';
					}
					$ch = curl_init( 'https://api.pinterest.com/v1/me/search/boards/?query='.$board.'&access_token=' . $pinterest_access_token . '&fields=id' );
					curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

					$result = json_decode( curl_exec( $ch ) );
					if ( ! empty( $result->data ) ) {
						$board = $result->data[0]->id;
					} else {
						$ch = curl_init( 'https://api.pinterest.com/v1/boards/?access_token=' . $pinterest_access_token . '&fields=id' );
						curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, "POST" );
						curl_setopt( $ch, CURLOPT_POSTFIELDS, array(
								'name' => 'internationalprom'
							)
						);
						curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

						$result1 = json_decode( curl_exec( $ch ) );
						$board   = $result->data[0]->id;
					}*/
					if ( ! empty( $board ) ) {
						$ch = curl_init( 'https://api.pinterest.com/v1/pins/?access_token=' . $pinterest_access_token . '&fields=id' );
						curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, "POST" );
						curl_setopt( $ch, CURLOPT_POSTFIELDS, array(
								'board'     => $board,
								'note'      => $text,
								'image_url' => $event_image,
							)
						);
						curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

						$result1 = curl_exec( $ch );
					}
				}
				break;
			case "store_event":
				break;
			case "email":
				$istilist_email = get_user_meta($post_author_id, 'istilist_email', true);
				$istilist_password = get_user_meta($post_author_id, 'istilist_password', true);
				if (!empty($istilist_email) && !empty($istilist_password)) {
					$result = api_curl_connect('http://istilist.com/api/authorize/get_user_id/?email='.$istilist_email.'&password='.$istilist_password);
					$user_id = $result->user_id;
					if(!empty($user_id)) {
						$result1 = api_curl_connect( 'http://istilist.com/api/get_author_posts/?id=' . $user_id . '&post_type=shopper&count=-1' );
						foreach($result1->posts as $post) {
							foreach($post->custom_fields->customer_email as $customer_email) {
								$user_date = get_userdata($post_author_id);
								$user_name = $user_date->display_name;
								$from = $user_date->user_email;
								$subject = get_the_title();
								$headers = "From: $user_name <$from>\r\n";
								$headers .= 'Reply-to: ' . $user_email . "\r\n";
								$headers .= "MIME-Version: 1.0\n";
								$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
								$msg = get_the_content();
								wp_mail($customer_email, $subject, $msg, $headers);
							}
						}
					}
				}
				break;
			case "sms":
				$istilist_email = get_user_meta($post_author_id, 'istilist_email', true);
				$istilist_password = get_user_meta($post_author_id, 'istilist_password', true);
				if (!empty($istilist_email) && !empty($istilist_password)) {
					$result = api_curl_connect('http://istilist.com/api/authorize/get_user_id/?email='.$istilist_email.'&password='.md5('123456'));
					$user_id = $result->user_id;
					if(!empty($user_id)) {
						$result1 = api_curl_connect( 'http://istilist.com/api/get_author_posts/?id=' . $user_id . '&post_type=shopper&count=-1' );
						require TEMPLATEPATH . "/twilio-php-master/Services/Twilio.php";
						$AccountSid = "ACdb92d82faf7befbb1538a208224133a4";
						$AuthToken = "1859b70bd4b570f6c8ff702b1ffd005d";
						$client = new Services_Twilio($AccountSid, $AuthToken);
						foreach($result1->posts as $post) {
							foreach($post->custom_fields->customer_phone as $customer_phone) {
								/*$user_date = get_userdata($post_author_id);
								$user_name = $user_date->display_name;
								$from = $user_date->user_email;
								$subject = get_the_title();*/
								if(!empty($customer_phone)) {
									$msg = $text;
									try {
										$message = $client->account->messages->sendMessage(
											"+1 865-240-0405 ", // From a valid Twilio number
											$customer_phone, // Text this number
											$msg
										);
									} catch (Exception $e) {
										echo $customer_phone.'is not a valid phone Number';
									}
								}
							}
						}
					}
				}
				break;
			default:
		}
	endwhile;
}
//wp_reset_post_data();
