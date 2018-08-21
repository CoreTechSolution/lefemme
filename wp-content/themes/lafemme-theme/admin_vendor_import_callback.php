<?php
if(isset($_POST['csv_submit']) && $_POST['csv_submit'] == 'Import') {
	if ( isset($_FILES["upload_csv"])) {
		if ($_FILES["upload_csv"]["error"] > 0) {
			echo "Return Code: " . $_FILES["upload_csv"]["error"] . "<br />";

		}
		else {
			$name = $_FILES['upload_csv']['name'];
			$ext = strtolower(end(explode('.', $_FILES['upload_csv']['name'])));
			$type = $_FILES['upload_csv']['type'];
			$tmpName = $_FILES['upload_csv']['tmp_name'];

			if($ext === 'csv'){
				$file1 = $_FILES['upload_csv'];
				$date = date('Ymd');
				$time = time();
				$file_name = preg_replace("/[\s]+/", "", $file1['name']);
				$filename = $date.'_'.$time.'_'.($file_name);
				$upload_dir = wp_upload_dir();
				$uploaddir = $upload_dir['basedir'].'/csv/';
				$file = $uploaddir . $filename;
				if (move_uploaded_file($file1['tmp_name'], $file)) {
					$csv = readCSV($file);
					$i = 0;
					if(!empty($csv)) {
						$k = 0;
						foreach ( $csv as $row ) {
							if ( $i != 0 ) {
								if ( ! empty( $row ) ) {
									if(!email_exists($row[8])) {
										$temp_pass = wp_generate_password();
										$new_user_id = wp_insert_user(
											array(
												'user_login'      => $row[8],
												'user_pass'       => $temp_pass,
												'user_email'      => $row[8],
												'first_name'      => $row[1],
												'last_name'       => $row[0],
												'role'            => 'seller',
												'user_nicename'   => $row[8],
												'user_registered' => date( 'Y-m-d H:i:s' )
											)
										);

										if(!empty($new_user_id)) {
											$k++;
										}

										add_user_meta( $new_user_id, 'dokan_store_name', $row[2] );
										add_user_meta( $new_user_id, 'company_name', $row[2] );
										add_user_meta( $new_user_id, 'address', $row[3] );
										add_user_meta( $new_user_id, 'city', $row[4] );
										add_user_meta( $new_user_id, 'st', $row[5] );
										add_user_meta( $new_user_id, 'zip', $row[6] );
										add_user_meta( $new_user_id, 'phone', $row[7] );
										add_user_meta( $new_user_id, 'phone', $row[7] );
										add_user_meta( $new_user_id, 'website', $row[9] );

										global $wpdb;
										$user_status = 1;
										if(!empty($new_user_id)) {
											$wpdb->update( $wpdb->users, array( 'user_status' => $user_status ), array( 'ID' => $new_user_id ) );
											update_user_meta( $new_user_id, 'pwd', $temp_pass );
											if ( $new_user_id != 1 ) {
												$admin_name = get_bloginfo( 'name' );
												// mail to user
												$to1      = $row[8];
												$from1    = "no-reply@" . $_SERVER['HTTP_HOST'];
												$headers1 = 'From: ' . $from1 . "\r\n";
												$headers1 .= "Reply-To: " . get_option( 'admin_email' ) . "\r\n";
												$headers1 .= "MIME-Version: 1.0\n";
												$headers1 .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
												$subject1 = "Thank you for joinning";
												$msg1     = 'Welcome to ' . get_bloginfo( 'name' ) . '.<br /><br />Thank you for joining.<br /><br />Please note login details.<br /><br /><table><tr><th>Username: </th><td>' . $row[8] . '</td></tr><tr><th>Password: </th><td>' . $temp_pass . '</td></tr></table><br><br>Regards,<br>' . $admin_name;

												wp_mail( $to1, $subject1, $msg1, $headers1 );
											}
										}
									} else {
										/*global $wpdb;
										$user_status = 1;
										$user = get_user_by('email', $row[8]);
										$pwd1 = get_user_meta($user->ID, 'pwd', true);
										if(empty($pwd1)) {
											$wpdb->update( $wpdb->users, array( 'user_status' => $user_status ), array( 'ID' => $user->ID ) );
											$pwd = wp_generate_password();
											update_user_meta( $user->ID, 'pwd', $pwd );
											wp_set_password( $pwd, $user->ID );
											if ( $user->ID != 1 ) {
												$admin_name = get_bloginfo( 'name' );
												// mail to user
												$to1      = $row[8];
												$from1    = "no-reply@" . $_SERVER['HTTP_HOST'];
												$headers1 = 'From: ' . $from1 . "\r\n";
												$headers1 .= "Reply-To: " . get_option( 'admin_email' ) . "\r\n";
												$headers1 .= "MIME-Version: 1.0\n";
												$headers1 .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
												$subject1 = "Thank you for joinning";
												$msg1     = 'Welcome to ' . get_bloginfo( 'name' ) . '.<br /><br />Thank you for joining.<br /><br />Please note login details.<br /><br /><table><tr><th>Username: </th><td>' . $user->user_login . '</td></tr><tr><th>Password: </th><td>' . $pwd . '</td></tr></table><br><br>Regards,<br>' . $admin_name;

												wp_mail( $to1, $subject1, $msg1, $headers1 );
											}
										}*/
                                    }
								}
							}
							$i++;
						}
					}
				}
			} else {
				echo "File uploaded is not CSV<br />";
			}
		}
	} else {
		echo "No file selected<br />";
	}

	if($k >= 1) {
		echo $k." numbers of Vendor successfully imported.<br />";
	}
}
?>
<h1>Import Vendor</h1>
<form method="POST" action="" enctype="multipart/form-data">
	<input type="file" name="upload_csv" accept=".csv" required />
	<input class="button button-primary button-large" type="submit" name="csv_submit" value="Import">
</form>