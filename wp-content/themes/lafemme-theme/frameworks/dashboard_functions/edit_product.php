<?php
    $pro_id = $_GET['pro_id'];
    if(isset($_POST['update_product'])) {
        global $user_ID;
        $post = array(
            'ID' => $pro_id,
            'post_title' => sanitize_text_field($_POST['title']),
            'post_content' => $_POST['description'],
            'post_type' => 'product',
            'post_status' => 'pending',
            'post_author' => $user_ID                                
        ); 
        $new_product = wp_update_post( $post );
        update_post_meta($new_product, 'sku', sanitize_text_field($_POST['sku']));
        wp_set_post_terms( $new_product, $_POST['cat'], 'product_cat' );
        update_post_meta($new_product, 'condition', sanitize_text_field($_POST['condition']));
        wp_set_post_terms( $new_product, $_POST['brand'], 'pro_brand' );
        update_post_meta($new_product, 'material', sanitize_text_field($_POST['material']));
        update_post_meta($new_product, 'size', sanitize_text_field($_POST['size']));
        update_post_meta($new_product, 'color', sanitize_text_field($_POST['color']));
        update_post_meta($new_product, 'quantity', sanitize_text_field($_POST['quantity']));
        update_post_meta($new_product, 'auction_price', sanitize_text_field($_POST['auction_price']));
        update_post_meta($new_product, 'price', sanitize_text_field($_POST['price']));
        update_post_meta($new_product, 'off', sanitize_text_field($_POST['off']));
        update_post_meta($new_product, 'shipping_price', sanitize_text_field($_POST['shipping_price']));
        update_post_meta($new_product, 'shipping_from', sanitize_text_field($_POST['shipping_from']));
        update_post_meta($new_product, 'shipping_weight', sanitize_text_field($_POST['shipping_weight']));
        update_post_meta($new_product, 'days_process', sanitize_text_field($_POST['days_process']));
        update_post_meta($new_product, 'days_deliver', sanitize_text_field($_POST['days_deliver']));
        require_once(ABSPATH . "wp-admin" . '/includes/image.php');
        require_once(ABSPATH . "wp-admin" . '/includes/file.php');
        require_once(ABSPATH . "wp-admin" . '/includes/media.php');
        if(!empty($_FILES) && isset($_FILES['images'])) {
            $img_vid_array = array();
            $file_ary = reArrayFiles($_FILES['images']);
            $i = 0;
            foreach($file_ary as $image) {                  
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
                        $attach_id = wp_insert_attachment( $attachment, $file[ 'file' ], $new_product );
                        if($i == 0) {
                            $featured_image = $attach_id;
                        }
                        wp_update_attachment_metadata( $attach_id, wp_generate_attachment_metadata( $attach_id, $file['file'] ) );   
                        array_push($img_vid_array, $attach_id);
                        //set_post_thumbnail( $new_product , $attach_id);     
                    } else {      
                        wp_die('No image was uploaded.');     
                    }   
                }
                $i++;
            }
            if(!empty($img_vid_array)){
                $img_vid = implode(',', $img_vid_array);
                set_post_thumbnail( $new_product , $featured_image );
                update_post_meta($new_product, '_product_image_gallery', $img_vid);
                //update_field('image_gallery', $img_vid_array, $new_product);
            }
        }
?>
    <p class="successMsg">Product Updated</p>
    <!--<script>
        parent.closeFancyboxAndRedirectToUrl();
    </script>-->
<?php
    }
?>
<?php while (have_posts()) : the_post(); ?>
<h1 style="margin-bottom: 0px;"><?php the_title(); ?></h1>
<?php endwhile; ?> 
<hr style="margin: 2px;" /><br />
<form id="addProduct" action="" method="POST" class="" enctype="multipart/form-data">
    <h2>Basic Information</h2>
    <hr style="margin: 2px;" /><br />
    <div class="section group">
        <div class="col span_3_of_12">
            <p><label>SKU <span class="required">*</span></label></p>
        </div>
        <div class="col span_9_of_12">
            <p><input type="text" name="sku" value="<?php echo get_post_meta($pro_id, 'sku', true); ?>" /></p>
        </div>
    </div>
    <div class="section group">
        <div class="col span_3_of_12">
            <p><label>Title <span class="required">*</span></label></p>
        </div>
        <div class="col span_9_of_12">
            <p><input type="text" name="title" value="<?php echo get_the_title($pro_id); ?>" /></p>
        </div>
    </div>
    <div class="section group">
        <div class="col span_3_of_12">
            <p><label>Description <span class="required">*</span></label></p>
        </div>
        <div class="col span_9_of_12">
            <p><textarea name="description"><?php echo content(0, $pro_id); ?></textarea></p>
        </div>
    </div>
    <div class="section group">
        <div class="col span_3_of_12">
            <p><label>Title <span class="required">*</span></label></p>
        </div>
        <div class="col span_9_of_12">
            <p><input type="text" name="title" value="<?php echo get_the_title($pro_id); ?>" /></p>
        </div>
    </div>
    <div class="section group">
        <div class="col span_3_of_12">
            <p><label>Product Category <span class="required">*</span></label></p>
        </div>
        <div class="col span_9_of_12">
            <p>
                <select name="cat" class="required">
                    <option value="">Select Product Category</option>
                    <?php
                        $taxonomy = 'product_cat';
                        $tax_terms = get_terms($taxonomy, array(
                            'hide_empty' => 0,
                            'parent' => 0,
                            'orderby' => 'slug',                                                        
                        ));
                        $term_array = wp_get_post_terms($pro_id, 'product_cat');
                    ?>
                    <?php
                        if(!empty($term_array)) {
                            $tax_terms_a = array();
                            foreach ($term_array as $post_term) {
                                array_push($tax_terms_a, $post_term->term_id);
                            }
                        }
                        foreach ($tax_terms as $tax_term) {
                            if (in_array($tax_term->term_id, $tax_terms_a)) {
                                echo '<option selected="selected" value="' . $tax_term->term_id . '">' . $tax_term->name . '</option>';
                            } else {
                                echo '<option value="' . $tax_term->term_id . '">' . $tax_term->name . '</option>';
                            }
                            /*
                            echo '<optgroup label="'.$tax_term->name.'">';
                            $terms = get_terms($taxonomy, array('parent' => $tax_term->term_id, 'orderby' => 'slug', 'hide_empty' => 0));
                            foreach ($terms as $term) {
                                echo '<option value="'.$term->term_id.'">'.$term->name.'</option>';
                            }
                            echo '</optgroup>';
                            */
                        }
                    ?>
                </select>
            </p>
        </div>
    </div>
    <div class="section group">
        <div class="col span_3_of_12">
            <p><label>Product Condition <span class="required">*</span></label></p>
        </div>
        <div class="col span_9_of_12">
            <p>
                <select name="condition" class="required">
                    <option value="">Select a condition</option>
                    <option value="New">New</option>
                    <option value="New with Tags">New with Tags</option>
                    <option value="New with Defects">New with Defects</option>
                    <option value="Used - Excellent">Used - Excellent</option>
                    <option value="Used - Good">Used - Good</option>
                    <option value="Used - Fair">Used - Fair</option>
                    <option value="Refurbished - Manufacturer">Refurbished - Manufacturer</option>
                    <option value="Refurbished - Seller">Refurbished - Seller</option></select>
                </select>
            </p>
            <script>
                jQuery(document).ready(function() {
                   jQuery("select[name='condition']").val("<?php echo get_post_meta($pro_id, 'condition', true); ?>"); 
                });
            </script>
        </div>
    </div>
    <div class="section group">
        <div class="col span_3_of_12">
            <p><label>Brand <span class="required">*</span></label></p>
        </div>
        <div class="col span_9_of_12">
            <p>
                <select name="brand" class="required">
                    <option value="">Select Brand</option>
                    <?php
                        $taxonomy = 'pro_brand';
                        $tax_terms = get_terms($taxonomy, array(
                            'hide_empty' => 0,
                            'parent' => 0,
                            'orderby' => 'slug',                                                        
                        ));
                        $term_array = wp_get_post_terms($pro_id, 'pro_brand');
                    ?>
                    <?php
                        foreach ($tax_terms as $tax_term) {
                            foreach($term_array as $post_term) {
                                if($post_term->term_id == $tax_term->term_id) {
                                    echo '<option selected="selected" value="'.$tax_term->term_id.'">'.$tax_term->name.'</option>';
                                } else {
                                    echo '<option value="'.$tax_term->term_id.'">'.$tax_term->name.'</option>';  
                                }   
                            }
                            /*
                            echo '<optgroup label="'.$tax_term->name.'">';
                            $terms = get_terms($taxonomy, array('parent' => $tax_term->term_id, 'orderby' => 'slug', 'hide_empty' => 0));
                            foreach ($terms as $term) {
                                echo '<option value="'.$term->term_id.'">'.$term->name.'</option>';
                            }
                            echo '</optgroup>';
                            */
                        }
                    ?>
                </select>
            </p>
        </div>
    </div>
    <div class="section group">
        <div class="col span_3_of_12">
            <p><label>Product Material</label></p>
        </div>
        <div class="col span_9_of_12">
            <p><input type="text" name="material" value="<?php echo get_post_meta($pro_id, 'material', true); ?>" /></p>
        </div>
    </div>
    <h2>Sizes & Colors (Product Variations)</h2>
    <hr style="margin: 2px;" /><br />
    <div class="section group">
        <div class="col span_4_of_12">
            <p><label>Size <span class="required">*</span></label></p>
            <p>
                <select name="size" class="required">
                    <option value="">Select Size</option>
                    <option value="No Size">No Size</option>
                    <option disabled="disabled" value=""></option>
                    <option disabled="disabled" value="Accessories Sizes:">Accessories Sizes:</option>
                    <option value="Small">Small</option>
                    <option value="Medium">Medium</option>
                    <option value="Large">Large</option>
                    <option value="Extra Large">Extra Large</option>
                    <option disabled="disabled" value=""></option>
                    <option disabled="disabled" value="Apparel Sizes:">Apparel Sizes:</option>
                    <option value="XS">XS</option>
                    <option value="S">S</option>
                    <option value="M">M</option>
                    <option value="L">L</option>
                    <option value="XL">XL</option>
                    <option value="XXL">XXL</option>
                    <option value="XXXL">XXXL</option>
                    <option value="1x">1x</option>
                    <option value="2x">2x</option>
                    <option value="3x">3x</option>
                    <option value="4x">4x</option>
                    <option value="0">0</option>
                    <option value="2">2</option>
                    <option value="4">4</option>
                    <option value="6">6</option>
                    <option value="8">8</option>
                    <option value="10">10</option>
                    <option value="12">12</option>
                    <option value="14">14</option>
                    <option value="16">16</option>
                    <option value="18">18</option>
                    <option value="20">20</option>
                    <option value="22">22</option>
                    <option value="24">24</option>
                    <option value="26">26</option>
                    <option value="28">28</option>
                    <option value="30">30</option>
                    <option disabled="disabled" value=""></option>
                    <option disabled="disabled" value="Beauty Sizes:">Beauty Sizes:</option>
                    <option value="Full">Full</option>
                    <option value="Travel">Travel</option>
                    <option value="Deluxe Sample">Deluxe Sample</option>
                    <option value="Sample">Sample</option>
                    <option value="Tester">Tester</option>
                    <option value="Palette">Palette</option>
                    <option value="Set">Set</option>
                    <option value="Mini">Mini</option>
                    <option disabled="disabled" value=""></option>
                    <option disabled="disabled" value="Shoes Sizes:">Shoes Sizes:</option>
                    <option value="5">5</option>
                    <option value="5.5">5.5</option>
                    <option value="6">6</option>
                    <option value="6.5">6.5</option>
                    <option value="7">7</option>
                    <option value="7.5">7.5</option>
                    <option value="8">8</option>
                    <option value="8.5">8.5</option>
                    <option value="9">9</option>
                    <option value="9.5">9.5</option>
                    <option value="10">10</option>
                    <option value="10.5">10.5</option>
                    <option value="11">11</option>
                    <option value="11.5">11.5</option>
                    <option value="12">12</option>
                    <option disabled="disabled" value=""></option>
                    <option disabled="disabled" value="Rings Sizes:">Rings Sizes:</option>
                    <option value="4">4</option>
                    <option value="4.5">4.5</option>
                    <option value="5">5</option>
                    <option value="5.5">5.5</option>
                    <option value="6">6</option>
                    <option value="6.5">6.5</option>
                    <option value="7">7</option>
                    <option value="7.5">7.5</option>
                    <option value="8">8</option>
                    <option value="8.5">8.5</option>
                    <option value="9">9</option>
                    <option value="9.5">9.5</option>
                    <option value="10">10</option>
                    <option value="10.5">10.5</option>
                    <option value="11">11</option>
                    <option value="11.5">11.5</option>
                    <option value="12">12</option>
                    <option value="12.5">12.5</option>
                    <option value="13">13</option>
                    <option value="13.5">13.5</option>
                    <option value="14">14</option>
                    <option disabled="disabled" value=""></option>
                    <option disabled="disabled" value="Necklaces Sizes:">Necklaces Sizes:</option>
                    <option value="Extra Short (<16&quot;)">Extra Short (&lt;16")</option>
                    <option value="Short (16&quot;-20&quot;)">Short (16"-20")</option>
                    <option value="Medium (20&quot;-24&quot;)">Medium (20"-24")</option>
                    <option value="Long (24&quot;-28&quot;)">Long (24"-28")</option>
                    <option value="Extra Long(28&quot;+)">Extra Long(28"+)</option>
                    <option disabled="disabled" value=""></option>
                    <option disabled="disabled" value="Baby Apparel Sizes:">Baby Apparel Sizes:</option>
                    <option value="Preemie (P)">Preemie (P)</option>
                    <option value="Newborn (NB)">Newborn (NB)</option>
                    <option value="0/3">0/3</option>
                    <option value="3M">3M</option>
                    <option value="3/6">3/6</option>
                    <option value="6M">6M</option>
                    <option value="6/9">6/9</option>
                    <option value="9M">9M</option>
                    <option value="12M">12M</option>
                    <option value="18M">18M</option>
                    <option value="24M">24M</option>
                    <option disabled="disabled" value=""></option>
                    <option disabled="disabled" value="Toddler Apparel Sizes:">Toddler Apparel Sizes:</option>
                    <option value="2T">2T</option>
                    <option value="3T">3T</option>
                    <option value="4T">4T</option>
                    <option value="5T">5T</option>
                    <option disabled="disabled" value=""></option>
                    <option disabled="disabled" value="Kids/Youth Apparel Sizes:">Kids/Youth Apparel Sizes:</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="6X">6X</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="10">10</option>
                    <option value="12">12</option>
                    <option value="14">14</option>
                    <option value="16">16</option>
                    <option value="18">18</option>
                    <option value="XS">XS</option>
                    <option value="S">S</option>
                    <option value="M">M</option>
                    <option value="L">L</option>
                    <option value="XL">XL</option>
                    <option disabled="disabled" value=""></option>
                    <option disabled="disabled" value="Baby Shoes Sizes:">Baby Shoes Sizes:</option>
                    <option value="0">0</option>
                    <option value="0.5">0.5</option>
                    <option value="1">1</option>
                    <option value="1.5">1.5</option>
                    <option value="2">2</option>
                    <option value="2.5">2.5</option>
                    <option value="3">3</option>
                    <option value="3.5">3.5</option>
                    <option value="4">4</option>
                    <option value="4.5">4.5</option>
                    <option value="5">5</option>
                    <option value="5.5">5.5</option>
                    <option value="6">6</option>
                    <option value="6.5">6.5</option>
                    <option value="7">7</option>
                    <option disabled="disabled" value=""></option>
                    <option disabled="disabled" value="Toddler Shoes Sizes:">Toddler Shoes Sizes:</option>
                    <option value="7.5">7.5</option>
                    <option value="8">8</option>
                    <option value="8.5">8.5</option>
                    <option value="9">9</option>
                    <option value="9.5">9.5</option>
                    <option value="10">10</option>
                    <option value="10.5">10.5</option>
                    <option value="11">11</option>
                    <option value="11.5">11.5</option>
                    <option value="12">12</option>
                    <option disabled="disabled" value=""></option>
                    <option disabled="disabled" value="Kids/Youth Shoes Sizes:">Kids/Youth Shoes Sizes:</option>
                    <option value="12.5">12.5</option>
                    <option value="13">13</option>
                    <option value="13.5">13.5</option>
                    <option value="1Y">1Y</option>
                    <option value="1.5Y">1.5Y</option>
                    <option value="2Y">2Y</option>
                    <option value="2.5Y">2.5Y</option>
                    <option value="3Y">3Y</option>
                    <option value="3.5Y">3.5Y</option>
                    <option value="4Y">4Y</option>
                    <option value="4.5Y">4.5Y</option>
                    <option value="5Y">5Y</option>
                    <option value="5.5Y">5.5Y</option>
                    <option value="6Y">6Y</option>
                    <option value="6.5Y">6.5Y</option>
                    <option value="7Y">7Y</option>
                </select>
            </p>
            <script>
                jQuery(document).ready(function() {
                   jQuery("select[name='size']").val("<?php echo get_post_meta($pro_id, 'size', true); ?>"); 
                });
            </script>
        </div>
        <div class="col span_4_of_12">
            <p><label>Color <span class="required">*</span></label></p>
            <p>
                <select name="color" class="required">
                    <option value="">Select Color</option>
                    <option value="No Color">No Color</option>
                    <option value="Custom Color">Custom Color</option>
                    <option value="Red">Red</option>
                    <option value="Orange">Orange</option>
                    <option value="Yellow">Yellow</option>
                    <option value="Green">Green</option>
                    <option value="Blue">Blue</option>
                    <option value="Purple">Purple</option>
                    <option value="Black">Black</option>
                    <option value="White">White</option>
                    <option value="Gray">Gray</option>
                    <option value="Pink">Pink</option>
                    <option value="Brown">Brown</option>
                    <option value="Silver">Silver</option>
                    <option value="Gold">Gold</option>
                    <option value="Clear">Clear</option>
                </select>
            </p>
            <script>
                jQuery(document).ready(function() {
                   jQuery("select[name='color']").val("<?php echo get_post_meta($pro_id, 'color', true); ?>"); 
                });
            </script>
        </div>
        <div class="col span_4_of_12">
            <p><label>Quantity <span class="required">*</span></label></p>
            <p><input type="text" name="quantity" value="<?php echo get_post_meta($pro_id, 'quantity', true); ?>" /></p>
        </div>
    </div>
    <h2>Pricing</h2>
    <hr style="margin-bottom: 2px;" /><br />    
    <div class="section group">
        <div class="col span_3_of_12">
            <p><label>Auction Starting Price ($) <span class="required">*</span></label></p>
        </div>
        <div class="col span_9_of_12">
            <p><input type="text" name="auction_price" value="<?php echo get_post_meta($pro_id, 'auction_price', true); ?>" /></p>
        </div>
    </div> 
    <div class="section group">
        <div class="col span_3_of_12">
            <p><label>Retail Price ($) <span class="required">*</span></label></p>
        </div>
        <div class="col span_9_of_12">
            <p><input type="text" name="price" value="<?php echo get_post_meta($pro_id, 'price', true); ?>" /></p>
        </div>
    </div>
    <div class="section group">
        <div class="col span_3_of_12">
            <p><label>Off (%)</label></p>
        </div>
        <div class="col span_9_of_12">
            <p><input type="text" name="off" value="<?php echo get_post_meta($pro_id, 'off', true); ?>" /></p>
        </div>
    </div>
    <h2>Order Processing & Shipping</h2>
    <hr style="margin-bottom: 2px;" /><br />
    <div class="section group">
        <div class="col span_3_of_12">
            <p><label>Shipping Price ($) <span class="required">*</span></label></p>
        </div>
        <div class="col span_9_of_12">
            <p><input type="text" name="shipping_price" value="<?php echo get_post_meta($pro_id, 'shipping_price', true); ?>" /></p>
        </div>
    </div>
    <div class="section group">
        <div class="col span_3_of_12">
            <p><label>Shipping From <span class="required">*</span></label></p>
        </div>
        <div class="col span_9_of_12">
            <p><input type="text" name="shipping_from" value="<?php echo get_post_meta($pro_id, 'shipping_from', true); ?>" /></p>
        </div>
    </div>
    <div class="section group">
        <div class="col span_3_of_12">
            <p><label>Shipping Weight <span class="required">*</span></label></p>
        </div>
        <div class="col span_9_of_12">
            <p><input type="text" name="shipping_weight" value="<?php echo get_post_meta($pro_id, 'shipping_weight', true); ?>" /></p>
        </div>
    </div>  
    <div class="section group">
        <div class="col span_3_of_12">
            <p><label>Days to Process order <span class="required">*</span></label></p>
        </div>
        <div class="col span_9_of_12">
            <p><input type="text" name="days_process" value="<?php echo get_post_meta($pro_id, 'days_process', true); ?>" /></p>
        </div>
    </div>
    <div class="section group">
        <div class="col span_3_of_12">
            <p><label>Days to Deliver <span class="required">*</span></label></p>
        </div>
        <div class="col span_9_of_12">
            <p><input type="text" name="days_deliver" value="<?php echo get_post_meta($pro_id, 'days_deliver', true); ?>" /></p>
        </div>
    </div>
    <h2>Images</h2> 
    <hr style="margin-bottom: 2px;" /><br />
    <div class="section group">
        <div class="col span_12_of_12">
            <input id="filer_input" type="file" name="images[]" multiple="" />
        </div>
    </div>
    <div class="section group">
        <div class="col span_12_of_12">
            <input type="submit" name="update_product" value="Update Product" />
        </div>
    </div>
</form>
<div id="loading" style="text-align: center; display: none;">
    <img src="<?php bloginfo('template_directory'); ?>/images/loading_spinner.gif" />
    <p style="text-align: center;">After clicking this button please be patient as the system is sending out your requests</p>
</div>
<!--<script>
    jQuery(document).ready(function() {
        jQuery("form#addProduct").submit(function(event) {
            jQuery('form#addProduct').hide();
            jQuery('#loading').show();
        });
    });
</script>-->
<script>
jQuery(document).ready(function() {
     jQuery('#filer_input').filer({
        changeInput: '<div class="jFiler-input-dragDrop"><div class="jFiler-input-inner"><div class="jFiler-input-icon"><i class="icon-jfi-folder"></i></div><div class="jFiler-input-text"><h3>Click on this box</h3> <span style="display:inline-block; margin: 15px 0">or</span></div><a class="jFiler-input-choose-btn blue">Browse Files</a></div></div>',
        showThumbs: true,
        theme: "dragdropbox",
        templates: {
            box: '<ul class="jFiler-items-list jFiler-items-grid"></ul>',
            item: '<li class="jFiler-item">\
                        <div class="jFiler-item-container">\
                            <div class="jFiler-item-inner">\
                                <div class="jFiler-item-thumb">\
                                    <div class="jFiler-item-status"></div>\
                                    <div class="jFiler-item-info">\
                                        <span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
                                        <span class="jFiler-item-others">{{fi-size2}}</span>\
                                    </div>\
                                    {{fi-image}}\
                                </div>\
                                <div class="jFiler-item-assets jFiler-row">\
                                    <ul class="list-inline pull-left"></ul>\
                                    <ul class="list-inline pull-right">\
                                        <li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
                                    </ul>\
                                </div>\
                            </div>\
                        </div>\
                    </li>',
            itemAppend: '<li class="jFiler-item">\
                            <div class="jFiler-item-container">\
                                <div class="jFiler-item-inner">\
                                    <div class="jFiler-item-thumb">\
                                        <div class="jFiler-item-status"></div>\
                                        <div class="jFiler-item-info">\
                                            <span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
                                            <span class="jFiler-item-others">{{fi-size2}}</span>\
                                        </div>\
                                        {{fi-image}}\
                                    </div>\
                                    <div class="jFiler-item-assets jFiler-row">\
                                        <ul class="list-inline pull-left">\
                                            <li><span class="jFiler-item-others">{{fi-icon}}</span></li>\
                                        </ul>\
                                        <ul class="list-inline pull-right">\
                                            <li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
                                        </ul>\
                                    </div>\
                                </div>\
                            </div>\
                        </li>',
            itemAppendToEnd: false,
            removeConfirmation: true,
            _selectors: {
                list: '.jFiler-items-list',
                item: '.jFiler-item',
                remove: '.jFiler-item-trash-action'
            }
        },
        addMore: true,
        files: [
            <?php
                $images = get_field('image_gallery', $pro_id);
                //print_r($images);
                if( $images ){
            ?>  
            <?php foreach( $images as $image ): ?>
            <?php
                $image_url = wp_get_attachment_url($image);
                $image_meta = get_attached_file($image);
                $file_size = filesize($image_meta);
                $path_info = pathinfo($image_url);
            ?>
            {
                name: "<?php echo get_the_title($image); ?>",
                size: <?php echo $file_size; ?>,
                type: "image/<?php echo $path_info['extension']; ?>",
                file: "<?php echo $image_url; ?>"
            },
            <?php endforeach; ?>
            <?php } ?>
        ]
     });       
});
</script>

<script>
jQuery(document).ready(function(){
    jQuery('#addProduct').validate({
        submitHandler: function(form) {
            jQuery('form#addProduct').hide();
            jQuery('#loading').show();
            form.submit();
        },
        invalidHandler: function(event, validator) {
        },
        rules: {
            sku: {
                required: true
            },
            title: {
                required: true
            },
            description: {
                required: true
            },
            cat: {
                required: true
            },
            condition: {
                required: true
            },
            brand: {
                required: true
            },
            quantity: {
                required: true,
                number: true
            },
            auction_price: {
                required: true,
                number: true
            },
            price: {
                required: true,
                number: true
            },
            income: {
                number: true,
                min: 0,
                max: 100,
            },
            shipping_price: {
                required: true,
                number: true
            },
            shipping_from: {
                required: true
            },
            shipping_weight: {
                required: true,
                number: true
            },
            days_process: {
                required: true,
                number: true
            },
            days_deliver: {
                required: true,
                number: true
            },
            images: {
               required: true
            }
        },
        messages: {
            
        }
    })
});
</script>