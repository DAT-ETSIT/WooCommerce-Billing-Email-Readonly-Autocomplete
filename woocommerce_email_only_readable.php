<?php
/*
Plugin Name: WooCommerce Billing Email Readonly
Description: Plugin that makes the billing email field readonly in WooCommerce checkout.
Version: 1.0
Author: Álvaro Rosado González
Author URI: https://github.com/aLVaRoZz01/
*/

add_filter( 'woocommerce_checkout_fields', 'make_billing_email_readonly', 9999 );

function make_billing_email_readonly( $fields ) {
    $fields['billing']['billing_email']['custom_attributes'] = array( 'readonly' => 'readonly' );
    
    return $fields;
}
?>
