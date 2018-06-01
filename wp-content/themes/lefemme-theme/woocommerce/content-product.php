<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>
<div class="col span_4_of_12 pro_<?php echo get_the_ID(); ?> matchheight">
	<?php
	/**
	 * woocommerce_before_shop_loop_item hook.
	 *
	 * @hooked woocommerce_template_loop_product_link_open - 10
	 */
	//do_action( 'woocommerce_before_shop_loop_item' );

	/**
	 * woocommerce_before_shop_loop_item_title hook.
	 *
	 * @hooked woocommerce_show_product_loop_sale_flash - 10
	 * @hooked woocommerce_template_loop_product_thumbnail - 10
	 */
	//do_action( 'woocommerce_before_shop_loop_item_title' );
	//do_action( 'woocommerce_before_single_product_summary' );

	/**
	 * woocommerce_shop_loop_item_title hook.
	 *
	 * @hooked woocommerce_template_loop_product_title - 10
	 */
	//do_action( 'woocommerce_shop_loop_item_title' );

	/**
	 * woocommerce_after_shop_loop_item_title hook.
	 *
	 * @hooked woocommerce_template_loop_rating - 5
	 * @hooked woocommerce_template_loop_price - 10
	 */
	//do_action( 'woocommerce_after_shop_loop_item_title' );

	/**
	 * woocommerce_after_shop_loop_item hook.
	 *
	 * @hooked woocommerce_template_loop_product_link_close - 5
	 * @hooked woocommerce_template_loop_add_to_cart - 10
	 */
	/*remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
	do_action( 'woocommerce_after_shop_loop_item' );


	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
	//remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
    do_action( 'woocommerce_single_product_summary' );*/
	?>
    <div class="pro_img_wrapper">
        <a href="<?php the_permalink(); ?>">
            <?php
                global $product;

                $available_variations = $product->get_available_variations();
            ?>
            <div class="pro_variation_slider">
                <div>
                    <div class="pro_img_slider" data-id="<?php echo get_the_ID(); ?>">
                        <?php if(has_post_thumbnail()) { ?>
                            <div><?php the_post_thumbnail( 'thumb_349_523' ); ?></div>
                        <?php
                        } else {
                        ?>
                            <div><?php echo wc_placeholder_img('thumb_349_523'); ?></div>
                        <?php
                        }
			            $attachment_ids = $product->get_gallery_image_ids();
			            foreach( $attachment_ids as $attachment_id ) {
				            echo '<div>'.wp_get_attachment_image($attachment_id, 'thumb_349_523').'</div>';
			            }
			            ?>
                    </div>
                </div>
            </div>
        </a>
        <div class="pro_hover">
            <a data-fancybox-type="iframe" href="<?php the_permalink(); ?>?display=iframe" class="fancybox">Quick View</a>
        </div>
    </div>
    <?php
        //print_r($available_variations);
        $colors = array();
        foreach($available_variations as $key => $variation) {
            array_push($colors, $variation['attributes']['attribute_pa_color']);
        }
        $colors = array_values(array_unique($colors));
    ?>
    <div id="variation_dots_<?php echo get_the_ID(); ?>">
        <ul class="variation_dots">
            <?php
            foreach($colors as $key => $color) {
                $term_obj  = get_term_by('slug', $color, 'pa_color');
                $term_id   = $term_obj->term_id;
                $color = get_term_meta( $term_id, 'color', true );
                //list( $r, $g, $b ) = sscanf( $color, "#%02x%02x%02x" );
	            $another_color_check = get_term_meta($term_id, 'another_color_check', true);
	            $color1 = get_term_meta($term_id, 'color1', true);
                ?>
                <?php if($another_color_check == 1) { ?>
                    <li><a title="<?php echo $term_obj->name; ?>" style="background-color: <?php echo $color; ?>; background-image:
                                -webkit-linear-gradient(30deg, <?php echo $color; ?> 50%, <?php echo $color1; ?> 50%);" href="javascript:void(0);" data-slide-index="<?php echo $key; ?>"></a></li>
                <?php } else { ?>
                    <li><a title="<?php echo $term_obj->name; ?>" style="background-color: <?php echo $color; ?>;" href="javascript:void(0);" data-slide-index="<?php echo $key; ?>"></a></li>
                <?php } ?>
                <?php
            }
            ?>
        </ul>
    </div>
    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
	<?php
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
	//remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
	do_action( 'woocommerce_single_product_summary' );
    ?>
</div>
