jQuery(function($){
    $('.matchheight').matchHeight();
});
jQuery(document).ready(function() {
    jQuery(".fancybox").fancybox({

    });
    jQuery('#datetimepicker').datetimepicker({
        timepicker:false,
        format:'m/d/Y'
    });
});
jQuery(document).ready(function() {
    jQuery('.external-events li a').each(function () {
        jQuery(this).data('event', {
            title: jQuery(this).data('type'),
            stick: true
        });

        jQuery(this).draggable({
            zIndex: 999,
            revert: true,
            revertDuration: 0
        });

    });
});

jQuery(document).ready(function() {
    jQuery('.single_add_to_cart_button').hide();
    jQuery('input[name="single_delivery"]').on('change', function() {
        if(jQuery(this).val() == 'in_store_pickup') {
            jQuery('.single_add_to_cart_button').hide();
            jQuery.fancybox([
                {
                    href: '#fancybox-instore-pickup',
                    maxWidth    : 450,
                    minHeight   : 150,
                    fitToView   : false,
                    autoSize    : true,
                    autoScale   : true,
                    openEffect  : 'fade',
                    closeEffect : 'fade',
                    //scrolling   : false,
                },
            ]);
        } else {
            if(jQuery(this).val() == 'home_delivery') {
                //jQuery('.single_add_to_cart_button').show();
                var user_ID = jQuery('input[name="user_ID"]').val();
                var product_ID = jQuery('input[name="product_ID"]').val();
                if(user_ID != 0) {
                    jQuery('.single_add_to_cart_button').hide();
                    jQuery('ul.single_delivery').hide();
                    jQuery('.loading_icon2').show();
                    jQuery.ajax({
                        type: "post",
                        url: MyAjax.ajaxurl,
                        data: {action: "homeDeliverySearch", user_id: user_ID, product_id: product_ID},
                        success: function (response) {
                            jQuery('input[name="home"]').val(response);
                            jQuery('input[name="instore"]').val('');
                            jQuery('ul.single_delivery').show();
                            jQuery('.loading_icon2').hide();
                            jQuery.ajax({
                                type: "post",
                                url: MyAjax.ajaxurl,
                                data: {action: "storeName", store_id: response},
                                success: function (response) {
                                    jQuery('.home_loc_selected').html('<p><span class="details">Sold by <a href="javascript:void(0);">'+response+'</a></span></p>');
                                    jQuery('.instore_loc_selected').html('');
                                }
                            });
                            jQuery('.single_add_to_cart_button').show();
                        }
                    });
                } else {
                    jQuery.fancybox([
                        {
                            href: '#fancybox-home-delivery',
                            maxWidth: 450,
                            minHeight: 150,
                            fitToView: false,
                            autoSize: true,
                            autoScale: true,
                            openEffect: 'fade',
                            closeEffect: 'fade',
                            //scrolling   : false,
                        },
                    ]);
                    /*jQuery('.single_add_to_cart_button').on('click', function (e) {
                        if (!jQuery('.single_add_to_cart_button').hasClass('disabled')) {
                            if (jQuery('input[name="home"]').val() == '') {
                                e.preventDefault();
                                jQuery.fancybox([
                                    {
                                        href: '#fancybox-home-delivery',
                                        maxWidth: 350,
                                        minHeight: 400,
                                        fitToView: false,
                                        autoSize: true,
                                        autoScale: true,
                                        openEffect: 'fade',
                                        closeEffect: 'fade',
                                        //scrolling   : false,
                                    },
                                ]);
                            }
                        }
                    });*/
                }
            }
        }
    });
    jQuery('.home_find').on('click', function(e) {
        e.preventDefault();
        jQuery.fancybox.close();
        jQuery('.instore_loc').html('');
        jQuery('.home_loc').html('');
        jQuery('ul.single_delivery').hide();
        jQuery('.loading_icon2').show();
        var product_ID = jQuery('input[name="product_ID"]').val();
        var searchZip = jQuery('.home_zip').val();
        jQuery.ajax({
            type: "post",
            url: MyAjax.ajaxurl,
            data: {action: "homeDeliverySearch", product_id: product_ID, searchZip: searchZip},
            success: function (response) {
                jQuery('input[name="home"]').val(response);
                jQuery('input[name="instore"]').val('');
                jQuery('ul.single_delivery').show();
                jQuery('.loading_icon2').hide();
                jQuery.ajax({
                    type: "post",
                    url: MyAjax.ajaxurl,
                    data: {action: "storeName", store_id: response},
                    success: function (response) {
                        jQuery('.home_loc_selected').html('<p><span class="details">Sold by <a href="javascript:void(0);">'+response+'</a></span></p>');
                        jQuery('.instore_loc_selected').html('');
                    }
                });
                jQuery('.single_add_to_cart_button').show();
            }
        });
        /*jQuery.ajax({
            type : "post",
            url : MyAjax.ajaxurl,
            data : {action: "zipSearch", searchZip: searchZip},
            success: function(response) {
                jQuery('.home_loc').html(response);
                jQuery('.loading_icon').hide();
                jQuery('.home_loc tbody tr').on('click', function() {
                    var home_loc_id = jQuery(this).attr('data-id');
                    jQuery('input[name="home"]').val(home_loc_id);
                    jQuery('input[name="instore"]').val('');
                    jQuery.ajax({
                        type: "post",
                        url: MyAjax.ajaxurl,
                        data: {action: "storeName", store_id: home_loc_id},
                        success: function (response) {
                            jQuery('.home_loc_selected').html('<p><span class="details">Sold by <a href="javascript:void(0);">'+response+'</a></span></p>');
                            jQuery('.instore_loc_selected').html('');
                        }
                    });
                    jQuery.fancybox.close();
                    jQuery('.single_add_to_cart_button').show();
                });
            }
        });*/
    });
    jQuery('.instore_find').on('click', function(e) {
        e.preventDefault();
        jQuery('.instore_loc').html('');
        jQuery('.home_loc').html('');
        jQuery.fancybox([
            {
                href: '#fancybox-instore-pickup',
                maxWidth    : 450,
                minHeight   : 400,
                fitToView   : false,
                autoSize    : true,
                autoScale   : true,
                openEffect  : 'fade',
                closeEffect : 'fade',
                scrolling   : false,
            },
        ]);
        jQuery('.loading_icon').show();
        var searchZip = jQuery('.instore_zip').val();
        jQuery.ajax({
            type : "post",
            url : MyAjax.ajaxurl,
            data : {action: "zipSearch", searchZip: searchZip},
            success: function(response) {
                jQuery('.instore_loc').html(response);
                jQuery.fancybox([
                    {
                        href: '#fancybox-instore-pickup',
                        maxWidth    : 450,
                        minHeight   : 350,
                        fitToView   : false,
                        autoSize    : true,
                        autoScale   : true,
                        openEffect  : 'fade',
                        closeEffect : 'fade',
                        //scrolling   : false,
                    },
                ]);
                jQuery('.loading_icon').hide();
                jQuery('.instore_loc tbody tr').on('click', function() {
                    var instore_loc_id = jQuery(this).attr('data-id');
                    var instore_loc_address = jQuery(this).attr('data-address');
                    jQuery('input[name="instore"]').val(instore_loc_id);
                    jQuery('input[name="home"]').val('');
                    jQuery('.instore_loc_selected').html('<p>'+instore_loc_address+'</p>');
                    jQuery('.home_loc_selected').html('');
                    jQuery.fancybox.close();
                    jQuery('.single_add_to_cart_button').show();
                });
            }
        });
    });
});

jQuery(document).ready(function() {
    jQuery('.lafemme_drop_country select#country').on('change', function(){
        var country = jQuery('.lafemme_drop_country select#country').val();
        jQuery.ajax({
            type : "post",
            url : MyAjax.ajaxurl,
            data : {action: "stateSearch", country: country},
            success: function(response) {
                jQuery('#state').html(response);
            }
        });
    });
});