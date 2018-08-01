<h1 style="margin-bottom: 0px;"><?php the_title(); ?></h1>
<hr style="margin: 2px;" /><br />
<table id="productsTable" data-page-size="10">
<thead>
    <tr>
        <th>Title</td>
        <th>Total</td>
        <th>Status</td>
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
global $user_ID;
$args = array(
    'post_type' => 'order',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'author' => $user_ID
);
$the_query = new WP_Query( $args );
if ( $the_query->have_posts() ) :
?>
<?php
while ( $the_query->have_posts() ) : $the_query->the_post();
?>
<tbody>
    <tr>
        <td><strong><?php the_title(); ?></strong></td>
        <td>$<?php echo get_post_meta(get_the_ID(), 'order_total', true); ?></td>
        <td><?php echo get_post_meta(get_the_ID(), 'status', true); ?></td>
        <td style="font-size: 16px;">
            <a title="Track Order" href="<?php bloginfo('url'); ?>/track-order/?oid=<?php echo get_the_ID(); ?>"><i class="fa fa-truck" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
            <a title="Order Dispute" href="<?php bloginfo('url'); ?>/order-dispute/?oid=<?php echo get_the_ID(); ?>"><i class="fa fa-exclamation" aria-hidden="true"></i></a>
        </td>
    </tr>
</tbody>
<?php
endwhile;
endif;
wp_reset_postdata();
?>
</table>
<script>
jQuery(document).ready(function() {
    jQuery('#productsTable').footable();
} );
</script>