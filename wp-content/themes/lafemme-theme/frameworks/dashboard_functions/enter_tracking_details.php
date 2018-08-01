<h1 style="margin-bottom: 0px;"><?php the_title(); ?></h1>
<hr style="margin: 2px;" /><br />
<?php
$order_id = $_GET['order_id'];

require TEMPLATEPATH .'/aftership-sdk-php-master/vendor/autoload.php';

$key = '552f9316-dbde-4178-81e3-00e5f75c4cce';

$couriers = new AfterShip\Couriers($key);
$trackings = new AfterShip\Trackings($key);
$last_check_point = new AfterShip\LastCheckPoint($key);

$response = $couriers->get_all();

if(isset($_POST['submit'])) {
    $tracking_info = array(
        'slug'    => $_POST['courier'],
        'title'   => 'Miki Tracking for '.$_POST['pro_id'],
    );
    $tracking_num = $_POST['tracking_num'];
    $response = $trackings->create($tracking_num, $tracking_info);

    $order_tracking = json_decode(get_post_meta($order_id, 'tracking_details', true));
    if(!empty($order_tracking)) {
        $order_tracking[$_POST['pro_id']] = $response['data']['tracking']['id'];
    } else {
        $order_tracking == array();
        $order_tracking[$_POST['pro_id']] = $response['data']['tracking']['id'];
    }
    update_post_meta($order_id, 'tracking_details', json_encode($order_tracking));
    //print_r($response);
?>
    <p class="successMsg">Tracking Added</p>
<?php } ?>
<table id="productsTable" data-page-size="10">
    <thead>
    <tr>
        <th>Product Title</td>
        <th>Amount</td>
        <th data-sort-ignore="true">Couriers List</th>
        <th data-sort-ignore="true">Tracking Number</th>
        <th data-sort-ignore="true">Submit</th>
    </tr>
    </thead>
    <tfoot>
    <tr>
        <td colspan="5">
            <div class="pagination pagination-centered hide-if-no-paging"></div>
        </td>
    </tr>
    </tfoot>
    <?php
    global $user_ID;
    $order_details = json_decode(get_post_meta($order_id, 'order_details', true));
    $order_tracking = json_decode(get_post_meta($order_id, 'tracking_details', true), true);
    if(!empty($order_details)) {
        foreach($order_details as $id=>$value) {
            $author_id = get_post_field('post_author', $id);
            if ($author_id == $user_ID) {
                $track = $order_tracking[$id];
                $response1 = $trackings->get_by_id($track, array('title','order_id'));
            ?>
            <tbody>
            <form method="POST" action="">
            <tr>
                <td><strong><?php echo get_the_title($id); ?></strong></td>
                <td>$<?php echo $total = $value*get_post_meta($id, 'auction_price', true); ?></td>
                <td>
                    <select name="courier"<?php if(!empty($track)) { ?> disabled="disabled"<?php } ?>>
                        <?php
                        $slug = $response1['data']['tracking']['slug'];
                        foreach($response['data']['couriers'] as $courier) {
                            if($courier['slug'] == $slug) {
                                echo '<option selected="selected" value="' . $courier['slug'] . '">' . $courier['name'] . '</option>';
                            } else {
                                echo '<option value="' . $courier['slug'] . '">' . $courier['name'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                </td>
                <td>
                    <input type="text" name="tracking_num"<?php if(!empty($track)) { ?> disabled="disabled"<?php } ?> value="<?php echo $track; ?>">
                    <input type="hidden" name="pro_id" value="<?php echo $id; ?>">
                </td>
                <td><input type="submit" name="submit"<?php if(!empty($track)) { ?> disabled="disabled"<?php } ?> value="Submit"></td>
            </tr>
            </form>
            </tbody>
            <?php
            }
        }
    }
    ?>
</table>
<script>
    jQuery(document).ready(function() {
        jQuery('#productsTable').footable();
    } );
</script>