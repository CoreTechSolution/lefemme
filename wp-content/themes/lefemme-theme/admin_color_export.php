<?php
if(isset($_POST['csv_export']) && $_POST['csv_export'] == 'Export') {

}
?>
<h1>Export Colors as CSV</h1>
<form method="POST" action="" enctype="multipart/form-data">
	<!--<input class="button button-primary button-large" type="submit" name="csv_export" value="Export">-->
	<a class="button button-primary button-large" href="<?php echo admin_url( 'admin-post.php?action=color_export_csv' ); ?>">Export</a>
</form>