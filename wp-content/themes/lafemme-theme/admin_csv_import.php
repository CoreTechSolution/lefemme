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
									$pro_id = get_product_by_sku($row[0]);
									if(empty($pro_id)) {
										$user_id = get_user_id_by_display_name( $row[7] );
										$post    = array(
											'post_author'  => $user_id,
											'post_content' => $row[5],
											'post_excerpt' => $row[4],
											'post_status'  => "publish",
											'post_title'   => $row[3],
											'post_parent'  => '',
											'post_type'    => "product",
										);

										$post_id = wp_insert_post( $post, $wp_error );
										if ( $post_id ) {
											$k ++;
											//$attach_id = get_post_meta($product->parent_id, "_thumbnail_id", true);
											//add_post_meta($post_id, '_thumbnail_id', $attach_id);
										}

										$cats = explode( ';', $row[8] );

										foreach ( $cats as $cat ) {
											wp_set_object_terms( $post_id, trim( $cat ), 'product_cat', true );
										}

										wp_set_object_terms( $post_id, 'variable', 'product_type' );

										update_post_meta( $post_id, '_visibility', 'visible' );
										update_post_meta( $post_id, '_stock_status', 'instock' );
										update_post_meta( $post_id, 'total_sales', '0' );
										update_post_meta( $post_id, '_downloadable', 'no' );
										update_post_meta( $post_id, '_virtual', 'no' );
										update_post_meta( $post_id, '_regular_price', $row[6] );
										update_post_meta( $post_id, '_sale_price', $row[6] );
										update_post_meta( $post_id, '_purchase_note', "" );
										update_post_meta( $post_id, '_featured', "no" );
										update_post_meta( $post_id, '_weight', "" );
										update_post_meta( $post_id, '_length', "" );
										update_post_meta( $post_id, '_width', "" );
										update_post_meta( $post_id, '_height', "" );
										update_post_meta( $post_id, '_sku', $row[0] );
										update_post_meta( $post_id, '_sale_price_dates_from', "" );
										update_post_meta( $post_id, '_sale_price_dates_to', "" );
										update_post_meta( $post_id, '_price', "1" );
										update_post_meta( $post_id, '_sold_individually', "" );
										update_post_meta( $post_id, '_manage_stock', "yes" );
										update_post_meta( $post_id, '_backorders', "no" );
										update_post_meta( $post_id, '_stock', 1 );
										//update_post_meta( $post_id, '_product_image_gallery', '');

										update_post_meta( $post_id, '_yoast_wpseo_title', $row[11] );
										update_post_meta( $post_id, '_yoast_wpseo_metadesc', $row[12] );

										$keywords = $row[13] . ', ' . $row[14] . ', ' . $row[15] . ', ' . $row[16] . ', ' . $row[17] . ', ' . $row[18] . ', ' . $row[19] . ', ' . $row[20] . ', ' . $row[21] . ', ' . $row[22];

										update_post_meta( $post_id, '_yoast_wpseo_focuskw', $keywords );
										update_post_meta( $post_id, '_yoast_wpseo_focuskw_text_input', $keywords );


										update_post_meta( $post_id, 'img_alt', $row[9] );
										update_post_meta( $post_id, 'img_cap', $row[10] );

										$available_attributes = array( 'color', 'size' );
										$variations           = array();

										$colors = explode( ',', $row[1] );
										$sizes  = explode( ',', $row[2] );

										foreach ( $colors as $color ) {
											foreach ( $sizes as $size ) {
												$variation_array = array(
													'attributes' => array(
														'color' => trim( $color ),
														'size'  => trim( strval( $size ) )
													),
													'price'      => $row[6]
												);
												array_push( $variations, $variation_array );
											}
										}

										insert_product_attributes( $post_id, $available_attributes, $variations );
										insert_product_variations( $post_id, $variations );
									}

									// Image Import Function
									/*$pro_id = get_product_by_sku($row[1]);
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
									}*/
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
<h1>Import CSV file</h1>
<form method="POST" action="" enctype="multipart/form-data">
	<input type="file" name="upload_csv" accept=".csv" required />
	<input class="button button-primary button-large" type="submit" name="csv_submit" value="Import">
    <br/>
    <a class="button button-primary button-large" href="<?php echo admin_url( 'admin-post.php?action=export_csv' ); ?>">Export Products</a>
    <br/>
    <?php
    /*$product = wc_get_product( 50624 );
    $sku = $product->get_sku();
    $available_variations = $product->get_available_variations();
    if(!empty($available_variations)) {
        foreach ( $available_variations as $variation ) {
            echo $variation['attributes']['attribute_pa_color'].'-'.$variation['attributes']['attribute_pa_size'];
            echo '<br/>';
        }
    }*/
    ?>
</form>