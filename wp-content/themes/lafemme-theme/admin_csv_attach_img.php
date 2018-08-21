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
									// Image Import Function
									$pro_id = get_product_by_sku($row[1]);
									if(!empty($pro_id)) {
										$img_alt = get_post_meta( $pro_id, 'img_alt', true );
										$img_cap = get_post_meta( $pro_id, 'img_cap', true );
										$imgs    = explode( ',', $row[0] );
										if (!has_post_thumbnail( $pro_id )) {
											if (!empty($imgs)) {
												$thumbnail_id = get_attachment_id( 'http://lefemme.cgsthemes.com/wp-content/uploads/2018/03/' . trim( $imgs[0] ) );
												wp_update_post( array(
													'ID'           => $thumbnail_id,
													'post_content' => $img_cap,
													'post_excerpt' => $img_cap,
												) );
												update_post_meta( $thumbnail_id, '_wp_attachment_image_alt', $img_alt );
												set_post_thumbnail( $pro_id, $thumbnail_id );
												$thumb_array = array();
												$l           = 0;
												foreach ( $imgs as $img ) {
													if ( $l > 0 ) {
														$thumbnail_id1 = get_attachment_id( 'http://lefemme.cgsthemes.com/wp-content/uploads/2018/03/' . trim( $img ) );
														array_push( $thumb_array, $thumbnail_id1 );
													}
													$l++;
												}
												update_post_meta( $pro_id, '_product_image_gallery', implode( ',', $thumb_array ) );
											}
										}
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
		echo $k." numbers of product successfully imported.<br />";
	}
}
?>
<h1>Attach images to product</h1>
<form method="POST" action="" enctype="multipart/form-data">
	<input type="file" name="upload_csv" accept=".csv" required />
	<input class="button button-primary button-large" type="submit" name="csv_submit" value="Import">
</form>