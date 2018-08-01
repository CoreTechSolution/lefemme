<?php
global $user_ID;
if(isset($_POST['submit'])) {
    update_user_meta($user_ID, 'store_bio', sanitize_text_field($_POST['store_bio']));
    if(isset($_FILES['store_image'])) {
        require_once(ABSPATH . "wp-admin" . '/includes/image.php');
        require_once(ABSPATH . "wp-admin" . '/includes/file.php');
        require_once(ABSPATH . "wp-admin" . '/includes/media.php');
        $image = $_FILES['store_image'];
        if ($image['size']) {
            if ( preg_match('/(jpg|jpeg|png|gif)$/', $image['type']) ) {
                $override = array('test_form' => false);
                $file = wp_handle_upload( $image, $override );
                $attachment = array(
                    'post_title' => $image['name'],
                    'post_content' => '',
                    'post_type' => 'attachment',
                    'post_mime_type' => $image['type'],
                    'guid' => $file['url']
                );
                $attach_id = wp_insert_attachment( $attachment,$file[ 'file' ] );
                wp_update_attachment_metadata( $attach_id, wp_generate_attachment_metadata( $attach_id, $file['file'] ) );
                update_user_meta($user_ID, 'store_image', $attach_id);
            } else {
                wp_die('No image was uploaded.');
            }
        }
    }
}
?>
<?php while (have_posts()) : the_post(); ?>
    <h1 style="margin-bottom: 0px;"><?php the_title(); ?></h1>
<?php endwhile; ?>
<hr style="margin: 2px;" /><br />
<form id="" action="" method="POST" class="" enctype="multipart/form-data">
    <h2>Icon & Bio</h2>
    <hr style="margin: 2px;" /><br />
    <div class="section group">
        <div class="col span_10_of_12">
            <label>Store Icon</label>
            <input type="file" name="store_image" />
            <?php $image =  get_user_meta($user_ID, 'store_image', true); ?>
        </div>
        <div class="col span_2_of_12">
            <?php echo wp_get_attachment_image($image, 'thumbnail'); ?>
        </div>
    </div>
    <div class="section group">
        <div class="col span_12_of_12">
            <label>Bio</label>
            <textarea name="store_bio"><?php echo get_user_meta($user_ID, 'store_bio', true); ?></textarea>
        </div>
    </div>
    <div class="section group">
        <div class="col span_12_of_12">
            <input type="submit" name="submit" value="Submit" />
        </div>
    </div>
</form>
<div id="loading" style="text-align: center; display: none;">
    <img src="<?php bloginfo('template_directory'); ?>/images/loading_spinner.gif" />
    <p style="text-align: center;">After clicking this button please be patient as the system is sending out your requests</p>
</div>
<script>
    jQuery(document).ready(function() {
        jQuery("form#addProduct").submit(function(event) {
            jQuery('form#addProduct').hide();
            jQuery('#loading').show();
        });
    });
</script>
