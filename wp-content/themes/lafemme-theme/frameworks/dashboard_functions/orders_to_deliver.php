<h1 style="margin-bottom: 0px;"><?php the_title(); ?></h1>
<hr style="margin: 2px;" /><br />
<?php
global $user_ID;
$args = array(
    'post_type' => 'order',
    'post_status' => 'publish',
    'posts_per_page' => -1,
);
$the_query = new WP_Query( $args );
if ( $the_query->have_posts() ) {
    ?>
    <table id="productsTable" data-page-size="10">
        <thead>
        <tr>
            <th>Title
            </td>
            <th>Total
            </td>
            <th>Status
            </td>
            <th data-sort-ignore="true">Action</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <td colspan="4">
                <div class="pagination pagination-centered hide-if-no-paging"></div>
            </td>
        </tr>
        </tfoot>
        <?php
        while ($the_query->have_posts()) : $the_query->the_post();
            $order_details = json_decode(get_post_meta(get_the_ID(), 'order_details', true));
            if (!empty($order_details)) {
                $i = 0;
                foreach ($order_details as $id => $value) {
                    $author_id = get_post_field('post_author', $id);
                    if ($author_id == $user_ID) {
                        $i++;
                    }
                }
            }
            if ($i > 0) {
                ?>
                <tbody>
                <tr>
                    <td><strong><?php the_title(); ?></strong></td>
                    <td>$<?php echo get_post_meta(get_the_ID(), 'order_total', true); ?></td>
                    <td><?php echo get_post_meta(get_the_ID(), 'status', true); ?></td>
                    <td style="font-size: 16px;">
                        <a title="Track Order"
                           href="<?php bloginfo('url'); ?>/enter-tracking-details/?order_id=<?php echo get_the_ID(); ?>"><i
                                class="fa fa-truck" aria-hidden="true"></i>&nbsp;&nbsp; Enter Tracking Details</a>
                    </td>
                </tr>
                </tbody>
                <?php
            }
        endwhile;
        ?>
    </table>
    <?php
} else {
    echo '<p class="warningMsg">No orders yet.</p>';
}
wp_reset_postdata();
?>
<script>
    jQuery(document).ready(function() {
        jQuery('#productsTable').footable();
    } );
</script>