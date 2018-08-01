<?php /* Template Name: Quick View Product */ ?>
<?php get_header('shop'); ?>
	<div class="col-lg-12 col-md-12 col-sm-12">
		<div class="woocommerce">
			<?php
			$args = array(
				'p' => $_GET['pro_id'],
				'post_type' => 'product',
				'post_status' => 'publish'
			);
			$the_query = new WP_Query( $args );
			if ( $the_query->have_posts() ) :
				while ( $the_query->have_posts() ) : $the_query->the_post();
					global $product;
					global $woocommerce;
					?>
					<div id="product-<?php the_ID(); ?>" <?php post_class(); ?>>

						<?php
						/**
						 * woocommerce_before_single_product_summary hook.
						 *
						 * @hooked woocommerce_show_product_sale_flash - 10
						 * @hooked woocommerce_show_product_images - 20
						 */
						do_action( 'woocommerce_before_single_product_summary' );
						?>

						<div class="summary entry-summary">

							<?php
							/**
							 * woocommerce_single_product_summary hook.
							 *
							 * @hooked woocommerce_template_single_title - 5
							 * @hooked woocommerce_template_single_rating - 10
							 * @hooked woocommerce_template_single_price - 10
							 * @hooked woocommerce_template_single_excerpt - 20
							 * @hooked woocommerce_template_single_add_to_cart - 30
							 * @hooked woocommerce_template_single_meta - 40
							 * @hooked woocommerce_template_single_sharing - 50
							 * @hooked WC_Structured_Data::generate_product_data() - 60
							 */
							do_action( 'woocommerce_single_product_summary' );
							?>

						</div><!-- .summary -->

						<?php
						/**
						 * woocommerce_after_single_product_summary hook.
						 *
						 * @hooked woocommerce_output_product_data_tabs - 10
						 * @hooked woocommerce_upsell_display - 15
						 * @hooked woocommerce_output_related_products - 20
						 */
						do_action( 'woocommerce_after_single_product_summary' );
						?>

					</div><!-- #product-<?php the_ID(); ?> -->
					<?php
				endwhile;
			endif;
			//wp_reset_postdata();
			?>
		</div>
	</div>
<style>
	#header, #footer, #copyright {
		display: none;
	}
</style>
<?php get_footer('shop'); ?>