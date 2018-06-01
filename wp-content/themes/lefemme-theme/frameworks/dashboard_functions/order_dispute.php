<?php
    $order_id = $_GET['oid'];
    if(isset($_POST['submit'])) {
        update_post_meta($order_id, 'order_dispute', $_POST['dispute']);
        header("Location: ".get_bloginfo('url')."/my-orders");
    }
?>
<div>
    <form id="forms" method="POST" action="">
        <label>Dispute Message</label><br/>
        <textarea name="dispute"></textarea><br/>
        <input type="submit" name="submit" value="Submit">
    </form>
</div>
<script>

    jQuery(document).ready(function(){
        jQuery('#forms').validate({
            rules: {
                dispute: {
                    required: true
                },
            },
            messages: {

            }
        })
    });

</script>
