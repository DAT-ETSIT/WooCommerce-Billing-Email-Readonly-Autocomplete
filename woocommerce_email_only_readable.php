<?php
/*
Plugin Name: WooCommerce Billing Email Readonly & Autocomplete
Description: Plugin that makes the billing email field readonly, autocompletes fields from user meta, and hides company name in WooCommerce checkout.
Version: 1.1
Author: Álvaro Rosado González
Author URI: https://github.com/aLVaRoZz01/
*/

add_filter( 'woocommerce_checkout_fields', 'customize_checkout_fields', 9999 );

function customize_checkout_fields( $fields ) {
    // Make the billing email readonly
    $fields['billing']['billing_email']['custom_attributes'] = array( 'readonly' => 'readonly' );

    // Get current user data
    $user_id = get_current_user_id();
    if ( $user_id ) {
        // Get metadata for given_name and family_name
        $given_name = get_user_meta( $user_id, 'given_name', true );
        $family_name = get_user_meta( $user_id, 'family_name', true );

        // Set defaults if metadata exists
        if ( !empty( $given_name ) ) {
            $fields['billing']['billing_first_name']['default'] = $given_name;
        }
        if ( !empty( $family_name ) ) {
            $fields['billing']['billing_last_name']['default'] = $family_name;
        }
    }

    // Autocomplete other fields with static values (you can customize these)
    $fields['billing']['billing_address_1']['default'] = 'Avenida Complutense, 30'; // Dirección de la calle
    $fields['billing']['billing_postcode']['default'] = '208040';       // Código postal
    $fields['billing']['billing_city']['default'] = 'Madrid';         // Población
    $fields['billing']['billing_state']['default'] = 'Madrid';       // Provincia

    // Hide and disable company name field
    $fields['billing']['billing_company']['required'] = false;
    $fields['billing']['billing_company']['class'] = array('hidden'); // Ocultar con CSS
    $fields['billing']['billing_company']['custom_attributes'] = array( 'disabled' => 'disabled' ); // Deshabilitar

    return $fields;
}
?>
