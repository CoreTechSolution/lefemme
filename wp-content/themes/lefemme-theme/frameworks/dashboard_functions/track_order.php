<h1 style="margin-bottom: 0px;"><?php the_title(); ?></h1>
<hr style="margin: 2px;" /><br />
<?php
$order_id = $_GET['oid'];

require TEMPLATEPATH .'/aftership-sdk-php-master/vendor/autoload.php';

$key = '552f9316-dbde-4178-81e3-00e5f75c4cce';

$couriers = new AfterShip\Couriers($key);
$trackings = new AfterShip\Trackings($key);
$last_check_point = new AfterShip\LastCheckPoint($key);

$response = $couriers->get_all();
?>
<table id="productsTable" data-page-size="10">
    <thead>
    <tr>
        <th>Product Title</td>
        <th>Amount</td>
        <th data-sort-ignore="true">Courier</th>
        <th data-sort-ignore="true">Tracking Number</th>
        <th data-sort-ignore="true">Status</th>
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
                if(!empty($track)) {
                    $response1 = $trackings->get_by_id($track, array('title', 'order_id'));
                    //print_r($response1);
                    ?>
                    <tbody>
                    <tr>
                        <td><strong><?php echo get_the_title($id); ?></strong></td>
                        <td>$<?php echo $total = $value * get_post_meta($id, 'auction_price', true); ?></td>
                        <td>
                            <?php
                            $slug = $response1['data']['tracking']['slug'];
                            foreach ($response['data']['couriers'] as $courier) {
                                if ($courier['slug'] == $slug) {
                                    echo $courier['name'];
                                }
                            }
                            ?>
                        </td>
                        <td><?php echo $track; ?></td>
                        <td></td>
                    </tr>
                    </tbody>
                    <?php
                }
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
