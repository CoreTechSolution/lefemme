<script type="text/javascript" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" />
<script>
    jQuery(document).ready(function($){
        var table = jQuery('#dataTable').DataTable({});
    });
</script>
<h1>Vendor Management</h1>
<?php
$user_query = new WP_User_Query( array( 'role' => 'seller' ) );

if ( ! empty( $user_query->get_results() ) ) {
	//$i = 1;
	?>
    <div style="text-align: right;"><a class="button button-primary button-large" href="<?php bloginfo('url'); ?>/wp-admin/?page=import-vendor">Import Vendor</a></div>
    <table id="dataTable" class="row-border display compact" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>Vendor Name</th>
            <th>Email</th>
            <th>Company</th>
            <th>Address</th>
            <th>City</th>
            <th>State</th>
            <th>ZIP</th>
            <th>Phone</th>
            <th>Website</th>
            <th>Vedor Level</th>
        </tr>
        </thead>
        <tbody>
		<?php
        foreach ( $user_query->get_results() as $user ) {
            ?>
            <tr>
                <td>
                    <strong><?php echo $user->display_name; ?></strong>
                    <br/>
                    <span><a href="<?php bloginfo('url'); ?>/wp-admin/?page=edit-vendor&uid=<?php echo $user->ID; ?>">Edit</a></span>
                </td>
                <td><?php echo $user->user_email; ?></td>
                <td><?php echo get_user_meta($user->ID, 'company_name', true); ?></td>
                <td><?php echo get_user_meta($user->ID, 'address', true); ?></td>
                <td><?php echo get_user_meta($user->ID, 'city', true); ?></td>
                <td><?php echo get_user_meta($user->ID, 'st', true); ?></td>
                <td><?php echo get_user_meta($user->ID, 'zip', true); ?></td>
                <td><?php echo get_user_meta($user->ID, 'phone', true); ?></td>
                <td><?php echo get_user_meta($user->ID, 'website', true); ?></td>
                <td><?php echo get_user_meta($user->ID, 'level', true); ?></td>
            </tr>
            <?php
        }
		?>
        </tbody>
    </table>
	<?php
} else {
	echo 'No users found.';
}
?>
<style>
    th, td {
        text-align: left;
    }
</style>
