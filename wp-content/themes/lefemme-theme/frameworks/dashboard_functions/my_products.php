<h1 style="margin-bottom: 0px;"><?php the_title(); ?></h1>
<hr style="margin: 2px;" /><br />
<?php if($_GET['deleted'] == 'true') { ?>
<p class="successMsg">Product has been successfully deleted.</p>
<?php } ?>
<p><a class="custom_button" href="<?php bloginfo('url'); ?>/add-product">Add Product</a></p>
<table id="productsTable" data-page-size="10">
<thead>
    <tr>
        <th>SKU</th>
        <th data-sort-ignore="true">Image</th>
        <th>Title</th>
        <th>Category</t>
        <th>Price</th>
        <th>Auction Starting Price</th>
        <th>Status</th>
        <th data-sort-ignore="true">Action</th>
    </tr>
</thead>
<?php
global $user_ID;
$args = array(
    'post_type' => 'product',
    'post_status' => array('pending', 'publish'),
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
        <td><?php echo get_post_meta(get_the_ID(), 'sku', true); ?></td>
        <td style="text-align: center;"><?php the_post_thumbnail('pro-small-thumb'); ?></td>
        <td><?php the_title(); ?></td>
        <td><?php the_taxonomies(','); ?></td>
        <td>$ <?php echo get_post_meta(get_the_ID(), 'price', true); ?></td>
        <td>$ <?php echo get_post_meta(get_the_ID(), 'auction_price', true); ?></td>
        <td><?php echo get_post_status(get_the_ID()); ?></td>
        <td style="font-size: 16px;"><a href="<?php bloginfo('url'); ?>/edit-product?pro_id=<?php echo get_the_ID(); ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;<a href="<?php bloginfo('url'); ?>/delete-product?pro_id=<?php echo get_the_ID(); ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
    </tr>
</tbody>
<?php
endwhile;
?>
    <tfoot>
    <tr>
        <td colspan="8">
            <div class="pagination pagination-centered hide-if-no-paging"></div>
        </td>
    </tr>
    </tfoot>
<?php
endif;
wp_reset_postdata();
?>
</table>
<script>
jQuery(document).ready(function() {
    jQuery('#productsTable').footable();
} );
</script>