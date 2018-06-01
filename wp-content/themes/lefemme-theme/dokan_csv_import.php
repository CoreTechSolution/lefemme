<?php
global $user_ID, $wpdb;
if(isset($_POST['csv_upload'])) {
	if ( isset($_FILES["upload_csv"])) {
		if ($_FILES["upload_csv"]["error"] > 0) {
			echo "<p class='successMsg'>Return Code: " . $_FILES["upload_csv"]["error"] . "</p><br />";

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
					//print_r($csv);
					$i = 0;
					if(!empty($csv)) {
						$k = 0;
						$l = 0;
						foreach ( $csv as $row ) {
							if ( $i != 0 ) {
								if ( ! empty( $row ) ) {
									$product_id = wc_get_product_id_by_sku($row[0]);
									$track = $wpdb->get_row("SELECT id FROM ".$wpdb->prefix."stock WHERE SKU = ".$row[0]);
									if(empty($track)) {
										if(!empty($product_id)) {
											$wpdb->insert( $wpdb->prefix . 'stock', array(
												'SKU'     => $row[0],
												'pro_id' => $product_id,
												'user_id' => $user_ID,
												'stock'   => $row[1]
											) );
											$k++;
										}
                                    } else {
										$wpdb->update( $wpdb->prefix . 'stock', array( 'stock' => $row[1] ), array( 'id' => $track->id ) );
										$l++;
									}
								}
							}
							$i++;
						}
					}
				}
			} else {
				echo "<p class='successMsg'>File uploaded is not CSV</p><br />";
			}
		}
	} else {
		echo "<p class='successMsg'>No file selected</p><br />";
	}

	if($k >= 1) {
		echo '<p class="successMsg">'.$k.' items inserted successfully</p>';
	}
	if($l >= 1) {
		echo '<p class="successMsg">'.$l.' items updated successfully</p>';
	}
}
?>
<h1>Import CSV</h1>
<form method="POST" action="" enctype="multipart/form-data">
	Choose a file from your computer: (Maximum size: 32 MB) <input type="file" name="upload_csv" accept=".csv">
	<br/>
    <input type="submit" name="csv_upload" value="Submit">&nbsp;&nbsp;&nbsp;<a style="margin: 0;" class="custom_button1" href="<?php bloginfo('template_directory'); ?>/Import-Sample.csv">Download Sample CSV</a>
</form>