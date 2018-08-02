    <?php get_header(); ?>
    <div id="banner">
        <div class="container-fluid">
            <div style="width: 100%;"><?php echo do_shortcode('[rev_slider home]'); ?></div>
        </div>
    </div>
    <div id="our_story">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-12"></div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <h2>Our Story</h2>
                    <p><?php echo get_theme_mod( 'our_story_text' ); ?></p>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12"></div>
            </div>
            <div class="story_quote">
                <div class="row">
                    <div class="col-lg-4 col-md-3 col-sm-12"></div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <h3><?php echo get_theme_mod( 'our_story_quote' ); ?></h3>
                    </div>
                    <div class="col-lg-4 col-md-3 col-sm-12"></div>
                </div>
            </div>
        </div>
    </div>
    <div id="banner">
        <div class="container-fluid">
            <div style="width: 100%;"><?php echo do_shortcode('[rev_slider home_video]'); ?></div>
        </div>
    </div>
    <?php
    $terms = get_terms( array(
	    'taxonomy' => 'product_cat',
	    'hide_empty' => true,
	    'meta_key' => 'featured',
	    'meta_value' => true
    ) );
    if(!empty($terms)) {
        $i = 0;
    ?>
    <div id="products">
        <div class="container">
            <div class="row">
    <?php
	    foreach ( $terms as $term ) {
		    $thumbnail_id = get_woocommerce_term_meta( $term->term_id, 'thumbnail_id', true );
		    if(!empty($thumbnail_id)) {
		        if($i == 0 || $i == 5) {
			        //$thumb = 'img_480_360';
			        $thumb = 'full';
			        $width = '90%';
                } else {
		            //$thumb = 'img_360_450';
		            $thumb = 'full';
			        $width = '70%';
                }
			    ?>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="pro_wrap">
                        <div class="pro_img_wrap">
                            <?php echo wp_get_attachment_image( $thumbnail_id, $thumb ); ?>
                            <div class="view_more_wrap">
                                <a class="view_more" href="<?php echo get_term_link( $term->term_id, 'product_cat' ); ?>">Shop Now</a>
                            </div>
                        </div>
                        <div class="pro_con_wrap" style="width: <?php echo $width; ?>;">
                            <h3><?php echo $term->name; ?></h3>
                            <p><?php echo term_description( $term->term_id, 'product_cat' ); ?></p>
                        </div>
                    </div>
                </div>
			    <?php
                $i++;
		    }
	    }
    ?>
            </div>
        </div>
    </div>
    <?php } ?>
    <?php
/*    $args = array(
	    'post_type' => 'product',
	    'posts_per_page' => 6,
	    'post_status' => 'publish',
	    'tax_query' => array(
		    'taxonomy' => 'product_visibility',
		    'field'    => 'name',
		    'terms'    => 'featured',
		    'operator' => 'IN',
	    ),
    );
    $the_query = new WP_Query( $args );
    if ( $the_query->have_posts() ) :
	    */?><!--
        <div id="products">
            <div class="container">
                <div class="row">
	                <?php /*while ( $the_query->have_posts() ) : $the_query->the_post(); */?>
                    <div class="col-lg-6 col-md-6 col-sm-12">
	                    <div class="pro_wrap">
                            <div class="pro_img_wrap">
                                <a href="<?php /*the_permalink(); */?>"><?php /*the_post_thumbnail('img_360_450') */?></a>
                            </div>
                            <div class="row">
                                <div class="col-lg-7 col-md-7 col-sm-12">
                                    <h3><?php /*the_title(); */?></h3>
                                    <p><?php /*the_excerpt_max_charlength(120); */?></p>
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-12">
                                    <a class="view_more" href="<?php /*the_permalink(); */?>">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
	                <?php /*endwhile; */?>
                </div>
            </div>
        </div>
	    --><?php
/*    endif;
    wp_reset_postdata();
    */?>
    <div id="banner">
        <div class="container-fluid">
            <div style="width: 100%;"><?php echo do_shortcode('[rev_slider slider3]'); ?></div>
        </div>
    </div>
    <div id="blogposts">
        <div class="container">
            <?php
            $args = array(
                'post_type' => 'post',
                'posts_per_page' => 1,
                'post_status' => 'publish',
                /*'meta_key' => 'featured',
                'meta_value' => 1,
                'meta_compare' => '=',*/
                'paged' => 1
            );
            $the_query = new WP_Query( $args );
            if ( $the_query->have_posts() ) :
                while ( $the_query->have_posts() ) : $the_query->the_post();
                    ?>
                    <script>
                        jQuery(document).ready(function(){
                            var slider_<?php echo get_the_ID(); ?> = jQuery('.featured_slider-<?php echo get_the_ID(); ?>').bxSlider({
                                slideWidth: 63,
                                minSlides: 1,
                                maxSlides: 4,
                                slideMargin: 50,
                                pager: false,
                                controls: false,
                                onSliderLoad: function(){
                                    jQuery(".featured_slider").css("visibility", "visible");
                                }
                            });
                            jQuery('.featured_slider_next-<?php echo get_the_ID(); ?> a').click(function(){
                                slider_<?php echo get_the_ID(); ?>.goToNextSlide();
                                return false;
                            });
                            jQuery('.featured_slider_prev-<?php echo get_the_ID(); ?> a').click(function(){
                                slider_<?php echo get_the_ID(); ?>.goToPrevSlide();
                                return false;
                            });
                        })
                    </script>
                    <div class="single_post">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <a class="featured_img" href="<?php the_permalink(); ?>"><?php the_post_thumbnail('blog-big-thumb'); ?></a>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <ul class="details">
                                    <li>BY <?php the_author(); ?></li>
                                    <li><?php the_time('F j, Y'); ?></li>
                                    <li>IN <?php the_category(', ') ?></li>
                                </ul>
                                <h1><?php the_title(); ?></h1>
                                <p><?php the_excerpt_max_charlength(175); ?></p>
                                <?php
                                $pro_assign = get_post_meta( get_the_ID(), 'pro_assign', true );
                                if(!empty($pro_assign)) {
                                    $pro_assign_array = $pro_assign;
                                    ?>
                                    <?php if(!empty($pro_assign_array)) { ?>
                                        <div class="featured">
                                        <h2>featured items</h2>
                                        <div class="featured_slider_wrapper">
                                        <div class="featured_slider_prev featured_slider_prev-<?php echo get_the_ID(); ?>"><a href="#"><img src="<?php bloginfo('template_directory'); ?>/images/featured_slider_prev.png" /></a></div>
                                        <div class="featured_slider_next featured_slider_next-<?php echo get_the_ID(); ?>"><a href="#"><img src="<?php bloginfo('template_directory'); ?>/images/featured_slider_next.png" /></a></div>
                                        <div class="featured_slider-<?php echo get_the_ID(); ?>">
                                            <?php foreach($pro_assign_array as $pro) { ?>
                                                <div><a data-fancybox-type="iframe" href="<?php echo get_the_permalink($pro); ?>?display=iframe" class="fancybox"><?php echo get_the_post_thumbnail($pro, 'product-small-thumb'); ?></a></div>
                                            <?php } ?>
                                        </div>
                                    <?php } ?>
                                    </div>
                                    </div>
                                <?php } ?>
                                <a href="<?php the_permalink(); ?>" class="read_more">Read More</a>
                                <?php get_template_part('social_share'); ?>
                            </div>
                        </div>
                    </div>
                    <?php
                endwhile;
            endif;
            wp_reset_postdata();
            ?>
            <?php
            $args = array(
                'post_type' => 'post',
                'posts_per_page' => 1,
                'post_status' => 'publish',
                /*'meta_key' => 'featured',
                'meta_value' => 1,
                'meta_compare' => '=',*/
                'paged' => 2
            );
            $the_query = new WP_Query( $args );
            if ( $the_query->have_posts() ) :
                while ( $the_query->have_posts() ) : $the_query->the_post();
                    ?>
                    <script>
                        jQuery(document).ready(function(){
                            var slider_<?php echo get_the_ID(); ?> = jQuery('.featured_slider-<?php echo get_the_ID(); ?>').bxSlider({
                                slideWidth: 63,
                                minSlides: 1,
                                maxSlides: 4,
                                slideMargin: 50,
                                pager: false,
                                controls: false,
                                onSliderLoad: function(){
                                    jQuery(".featured_slider").css("visibility", "visible");
                                }
                            });
                            jQuery('.featured_slider_next-<?php echo get_the_ID(); ?> a').click(function(){
                                slider_<?php echo get_the_ID(); ?>.goToNextSlide();
                                return false;
                            });
                            jQuery('.featured_slider_prev-<?php echo get_the_ID(); ?> a').click(function(){
                                slider_<?php echo get_the_ID(); ?>.goToPrevSlide();
                                return false;
                            });
                        })
                    </script>
                    <div class="single_post">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <ul class="details">
                                    <li>BY <?php the_author(); ?></li>
                                    <li><?php the_time('F j, Y'); ?></li>
                                    <li>IN <?php the_category(', ') ?></li>
                                </ul>
                                <h1><?php the_title(); ?></h1>
                                <p><?php the_excerpt_max_charlength(175); ?></p>
                                <?php
                                $pro_assign = get_post_meta( get_the_ID(), 'pro_assign', true );
                                if(!empty($pro_assign)) {
                                    $pro_assign_array = $pro_assign;
                                    ?>
                                    <?php if(!empty($pro_assign_array)) { ?>
                                        <div class="featured">
                                        <h2>featured items</h2>
                                        <div class="featured_slider_wrapper">
                                        <div class="featured_slider_prev featured_slider_prev-<?php echo get_the_ID(); ?>"><a href="#"><img src="<?php bloginfo('template_directory'); ?>/images/featured_slider_prev.png" /></a></div>
                                        <div class="featured_slider_next featured_slider_next-<?php echo get_the_ID(); ?>"><a href="#"><img src="<?php bloginfo('template_directory'); ?>/images/featured_slider_next.png" /></a></div>
                                        <div class="featured_slider-<?php echo get_the_ID(); ?>">
                                            <?php foreach($pro_assign_array as $pro) { ?>
                                                <div><a data-fancybox-type="iframe" href="<?php echo get_the_permalink($pro); ?>?display=iframe" class="fancybox"><?php echo get_the_post_thumbnail($pro, 'product-small-thumb'); ?></a></div>
                                            <?php } ?>
                                        </div>
                                    <?php } ?>
                                    </div>
                                    </div>
                                <?php } ?>
                                <a href="<?php the_permalink(); ?>" class="read_more">Read More</a>
                                <?php get_template_part('social_share'); ?>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <a class="featured_img" href="<?php the_permalink(); ?>"><?php the_post_thumbnail('blog-big-thumb'); ?></a>
                            </div>
                        </div>
                    </div>
                    <?php
                endwhile;
            endif;
            wp_reset_postdata();
            ?>

            <?php
            $args = array(
                'post_type' => 'post',
                'posts_per_page' => 1,
                'post_status' => 'publish',
                /*'meta_key' => 'featured',
                'meta_value' => 1,
                'meta_compare' => '=',*/
                'paged' => 3
            );
            $the_query = new WP_Query( $args );
            if ( $the_query->have_posts() ) :
                while ( $the_query->have_posts() ) : $the_query->the_post();
                    ?>
                    <script>
                        jQuery(document).ready(function(){
                            var slider_<?php echo get_the_ID(); ?> = jQuery('.featured_slider-<?php echo get_the_ID(); ?>').bxSlider({
                                slideWidth: 63,
                                minSlides: 1,
                                maxSlides: 4,
                                slideMargin: 50,
                                pager: false,
                                controls: false,
                                onSliderLoad: function(){
                                    jQuery(".featured_slider").css("visibility", "visible");
                                }
                            });
                            jQuery('.featured_slider_next-<?php echo get_the_ID(); ?> a').click(function(){
                                slider_<?php echo get_the_ID(); ?>.goToNextSlide();
                                return false;
                            });
                            jQuery('.featured_slider_prev-<?php echo get_the_ID(); ?> a').click(function(){
                                slider_<?php echo get_the_ID(); ?>.goToPrevSlide();
                                return false;
                            });
                        })
                    </script>
                    <div class="single_post">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <a class="featured_img" href="<?php the_permalink(); ?>"><?php the_post_thumbnail('blog-big-thumb'); ?></a>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <ul class="details">
                                    <li>BY <?php the_author(); ?></li>
                                    <li><?php the_time('F j, Y'); ?></li>
                                    <li>IN <?php the_category(', ') ?></li>
                                </ul>
                                <h1><?php the_title(); ?></h1>
                                <p><?php the_excerpt_max_charlength(175); ?></p>
                                <?php
                                $pro_assign = get_post_meta( get_the_ID(), 'pro_assign', true );
                                if(!empty($pro_assign)) {
                                    $pro_assign_array = $pro_assign;
                                    ?>
                                    <?php if(!empty($pro_assign_array)) { ?>
                                        <div class="featured">
                                        <h2>featured items</h2>
                                        <div class="featured_slider_wrapper">
                                        <div class="featured_slider_prev featured_slider_prev-<?php echo get_the_ID(); ?>"><a href="#"><img src="<?php bloginfo('template_directory'); ?>/images/featured_slider_prev.png" /></a></div>
                                        <div class="featured_slider_next featured_slider_next-<?php echo get_the_ID(); ?>"><a href="#"><img src="<?php bloginfo('template_directory'); ?>/images/featured_slider_next.png" /></a></div>
                                        <div class="featured_slider-<?php echo get_the_ID(); ?>">
                                            <?php foreach($pro_assign_array as $pro) { ?>
                                                <div><a data-fancybox-type="iframe" href="<?php echo get_the_permalink($pro); ?>?display=iframe" class="fancybox"><?php echo get_the_post_thumbnail($pro, 'product-small-thumb'); ?></a></div>
                                            <?php } ?>
                                        </div>
                                    <?php } ?>
                                    </div>
                                    </div>
                                <?php } ?>
                                <a href="<?php the_permalink(); ?>" class="read_more">Read More</a>
                                <?php get_template_part('social_share'); ?>
                            </div>
                        </div>
                    </div>
                    <?php
                endwhile;
            endif;
            wp_reset_postdata();
            ?>
        </div>
    </div>
<?php get_footer(); ?>