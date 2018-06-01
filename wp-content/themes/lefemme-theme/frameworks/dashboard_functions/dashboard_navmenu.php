<?php /*$user_role = get_user_role($user_ID); */?><!--
<?php /*$redirect = get_bloginfo('url').'/log-in'; */?>
<div class="dashboard">
    <div class="profileImgage">
        <?php /*echo get_avatar( $user_ID, 96 ); */?>
        <?php /*$user_date = get_userdata($user_ID); */?>
    </div>
    <div class="user_title"><?php /*echo $user_date->display_name;  */?></div>
    <div class="myaccountMenu <?php /*echo $user_role; */?>">
        <ul>
            <li><a href="<?php /*bloginfo('url'); */?>/my-account"><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</a></li>
            <li><a href="<?php /*bloginfo('url'); */?>/my-profile"><i class="fa fa-user" aria-hidden="true"></i> My Profile</a></li>
            <li><a href="<?php /*bloginfo('url'); */?>/store-profile"><i class="fa fa-archive" aria-hidden="true"></i> Store Profile</a></li>
            <li><a href="<?php /*bloginfo('url'); */?>/orders-to-deliver"><i class="fa fa-shopping-cart" aria-hidden="true"></i></i> Orders to Deliver</a></li>
            <li><a href="<?php /*bloginfo('url'); */?>/my-orders"><i class="fa fa-shopping-cart" aria-hidden="true"></i></i> My Orders</a></li>
            <li><a href="<?php /*bloginfo('url'); */?>/my-products"><i class="fa fa-shopping-bag" aria-hidden="true"></i> My Products</a></li>
            <li><a href="<?php /*bloginfo('url'); */?>/message"><i class="fa fa-shopping-bag" aria-hidden="true"></i> My Messages</a></li>
            <li><a href="<?php /*echo wp_logout_url( $redirect ); */?>"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a></li>
        </ul>
    </div>
</div>-->
<?php
/**
 * My Account navigation
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/navigation.php.
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
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

do_action( 'woocommerce_before_account_navigation' );
?>
<?php $redirect = get_bloginfo('url').'/log-in'; ?>
<nav class="woocommerce-MyAccount-navigation">
    <ul>
        <?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
            <?php if($label != "Logout") { ?>
                <li class="<?php echo wc_get_account_menu_item_classes( $endpoint ); ?>">
                    <a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"><?php echo esc_html( $label ); ?></a>
                </li>
            <?php } ?>
        <?php endforeach; ?>
        <!--<li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--store-profile<?php /*if(is_page('store-profile')) { echo ' is-active'; } */?>"><a href="<?php /*bloginfo('url'); */?>/store-profile">Store Profile</a></li>
        <li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--orders-to-deliver<?php /*if(is_page('orders-to-deliver')) { echo ' is-active'; } */?>"><a href="<?php /*bloginfo('url'); */?>/orders-to-deliver">Orders to Deliver</a></li>
        <li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--my-products<?php /*if(is_page('my-products')) { echo ' is-active'; } */?>"><a href="<?php /*bloginfo('url'); */?>/my-products">My Products</a></li>
        <li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--my-payments<?php /*if(is_page('payment')) { echo ' is-active'; } */?>"><a href="<?php /*bloginfo('url'); */?>/payment">Payment</a></li>-->
        <li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--my-messages<?php if(is_page('message')) { echo ' is-active'; } ?>"><a href="<?php bloginfo('url'); ?>/message">My Messages</a></li>
        <li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--customer-logout"><a href="<?php echo wp_logout_url( $redirect ); ?>">Logout</a></li>
    </ul>
</nav>
<?php if(!is_page('my-account')) { ?>
<script>
    jQuery(document).ready(function() {
        jQuery('.woocommerce-MyAccount-navigation-link--dashboard').removeClass('is-active');
    });
</script>
<?php } ?>
<?php do_action( 'woocommerce_after_account_navigation' ); ?>
