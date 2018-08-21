<?php
if(isset($_POST['color_import_submit'])) {
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
					$tax = 'pa_color';
					$csv = readCSV($file);
					$i = 0;
					if(!empty($csv)) {
						$k = 0;
						foreach ( $csv as $row ) {
							if ( $i != 0 ) {
								if ( ! empty( $row ) ) {
									$name = $row[0];
									$slug = $row[1];
									$term = wp_insert_term( $name, $tax, array( 'slug' => $slug ) );
									if ( is_wp_error( $term ) ) {
										$term->get_error_message();
									} else {
										$term = get_term_by( 'id', $term['term_id'], $tax );
										update_term_meta( $term->term_id, 'color', $row[2] );
										update_term_meta( $term->term_id, 'color1', $row[3] );
										update_term_meta( $term->term_id, 'another_color_check', 1 );
										$k++;
									}
								    $i++;
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
		echo $k." numbers of colors successfully imported.<br />";
	}
}
?>
<div class="metabox-holder">
    <div class="meta-box-sortables ui-sortable">
        <div id="esb_cie_product_product_tag" class="postbox">

            <!-- settings box title -->
            <h3 class="hndle">
                <span style="vertical-align: top;">Export Colors as CSV</span>
            </h3>

            <div class="inside">
                <!-- Export into file Start -->
                <table class="form-table esb-cie-form-table">
                    <tbody><tr>
                        <td colspan="2" valign="top" scope="row">
                            <strong>Export into file</strong>
                        </td>
                    </tr>

                    </tbody>
                </table>

                <p>
                    <a class="button button-primary button-large" href="<?php echo admin_url( 'admin-post.php?action=color_export_csv' ); ?>">Export</a>
                </p>
                <!-- Export into file End -->
                <!-- Import from file Start -->
                <table class="form-table esb-cie-form-table">
                    <tbody><tr>
                        <td colspan="2" valign="top" scope="row">
                            <strong>Import from file</strong>
                        </td>
                    </tr>

                    </tbody>
                </table>

                <form method="POST" action="" enctype="multipart/form-data">
                    <p>
                        <input type="file" name="upload_csv" accept=".csv">
                        <input type="submit" name="color_import_submit" class="button-secondary" value="Import From CSV">
                    </p>
                </form>
                <!-- Import from file End -->

            </div><!-- .inside -->

        </div><!-- #settings -->
    </div><!-- .meta-box-sortables ui-sortable -->
</div>