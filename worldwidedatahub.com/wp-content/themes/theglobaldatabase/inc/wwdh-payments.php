<?php
/**
 * WWDH payments: Stripe only (24 Nov 2026, owner request).
 *
 * PayPal returned PAYEE_ACCOUNT_RESTRICTED, so every payment method except
 * Stripe is paused on the storefront. Plugin settings in wp-admin are not
 * changed; set WWDH_STRIPE_ONLY to false (or delete this file's require in
 * functions.php) to restore all enabled methods.
 *
 * Stripe gateway ids: 'stripe' and 'stripe_*' (WooCommerce Stripe Gateway
 * and Payment Plugins for Stripe both use this prefix).
 * Safety net: if no Stripe gateway is enabled, checkout falls back to the
 * other enabled methods except PayPal, and wp-admin shows a warning, so the
 * shop is never left with no way to pay.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'WWDH_STRIPE_ONLY' ) ) {
	define( 'WWDH_STRIPE_ONLY', true );
}

if ( ! WWDH_STRIPE_ONLY ) {
	return;
}

/*
 * Stripe wallets removed (owner, 24 Nov): Google Pay, Apple Pay, browser
 * Payment Request, Amazon Pay. Stripe Link stays ON (owner, 25 Nov): it is
 * Stripe's own one-click checkout and recent successful orders used it.
 */
function wwdh_is_wallet_gateway( $id ) {
	return in_array( (string) $id, array( 'stripe_googlepay', 'stripe_applepay', 'stripe_payment_request', 'stripe_amazonpay' ), true );
}

function wwdh_is_stripe_gateway( $id ) {
	$id = (string) $id;
	if ( wwdh_is_wallet_gateway( $id ) ) {
		return false;
	}
	return 'stripe' === $id || 0 === strpos( $id, 'stripe_' );
}

/* Payment Plugins for Stripe: no express buttons on product pages at all. */
add_filter( 'wc_stripe_product_payment_methods', function () {
	return array();
}, 999 );

/* Cart, mini-cart and checkout express section: Link only (wallets removed). */
foreach ( array( 'wc_stripe_cart_payment_methods', 'wc_stripe_mini_cart_payment_methods', 'wc_stripe_express_payment_methods' ) as $wwdh_hook ) {
	add_filter( $wwdh_hook, function ( $gateways ) {
		return array_filter( (array) $gateways, function ( $id ) {
			return ! wwdh_is_wallet_gateway( $id );
		}, ARRAY_FILTER_USE_KEY );
	}, 999 );
}
unset( $wwdh_hook );

/* WooCommerce Stripe Gateway (official): hide its express buttons on product pages. */
add_filter( 'wc_stripe_hide_payment_request_on_product_page', '__return_true' );

function wwdh_is_paypal_gateway( $id ) {
	$id = (string) $id;
	return 0 === strpos( $id, 'ppcp' ) || in_array( $id, array( 'paypal', 'ppec_paypal' ), true );
}

/* Checkout: only Stripe (fallback: everything except PayPal). */
add_filter( 'woocommerce_available_payment_gateways', function ( $gateways ) {
	if ( is_admin() && ! wp_doing_ajax() ) {
		return $gateways;
	}
	$stripe = array_filter( (array) $gateways, 'wwdh_is_stripe_gateway', ARRAY_FILTER_USE_KEY );
	if ( ! empty( $stripe ) ) {
		if ( get_option( 'wwdh_stripe_missing' ) ) {
			delete_option( 'wwdh_stripe_missing' );
		}
		return $stripe;
	}
	if ( ! get_option( 'wwdh_stripe_missing' ) ) {
		update_option( 'wwdh_stripe_missing', time(), false );
	}
	return array_filter( (array) $gateways, function ( $id ) {
		return ! wwdh_is_paypal_gateway( $id );
	}, ARRAY_FILTER_USE_KEY );
}, 999 );

/* Server-side guard: refuse orders placed with a paused method. */
add_action( 'woocommerce_after_checkout_validation', function ( $data, $errors ) {
	$method = isset( $data['payment_method'] ) ? (string) $data['payment_method'] : '';
	if ( '' === $method ) {
		return;
	}
	$available = WC()->payment_gateways() ? WC()->payment_gateways()->get_available_payment_gateways() : array();
	if ( ! isset( $available[ $method ] ) ) {
		$errors->add( 'payment', 'This payment method is currently unavailable. Please pay by card.' );
	}
}, 10, 2 );

/* PayPal Payments: hide its buttons everywhere (incl. its Google/Apple Pay). */
add_filter( 'woocommerce_paypal_payments_buttons_disabled', '__return_true' );
add_filter( 'woocommerce_paypal_payments_product_buttons_disabled', '__return_true' );

/* Hide non-Stripe express buttons (PayPal, PayPal-Google/Apple Pay, WooPayments). */
add_action( 'wp_head', function () {
	echo '<style id="wwdh-stripe-only">'
		. '#ppc-button-ppcp-gateway,#ppc-button-minicart,.ppc-button-wrapper,'
		. '#ppc-button-googlepay-container,#ppc-button-googlepay-container-minicart,'
		. '#ppc-button-applepay-container,#ppc-button-applepay-container-minicart,'
		. '#ppcp-messages,.ppcp-messages,.ppcp-button-apm,'
		. '#wcpay-express-checkout-element,#wcpay-express-checkout-button-separator,'
		. '.wcpay-express-checkout-wrapper,#wcpay-payment-request-wrapper,'
		. '.wc-stripe-product-checkout-container,'
		. '.wc-stripe-payment-request-container,#wc-stripe-express-checkout-element,'
		. '#wc-stripe-express-checkout-button-separator,'
		. '.payment_method_stripe_googlepay,.payment_method_stripe_applepay,.payment_method_stripe_payment_request,.payment_method_stripe_amazonpay,'
		. '.banner_payment_method_stripe_googlepay,.banner_payment_method_stripe_applepay,.banner_payment_method_stripe_payment_request,.banner_payment_method_stripe_amazonpay'
		. '{display:none!important}</style>' . "\n";
}, 99 );

/* wp-admin warning when Stripe is not available. */
add_action( 'admin_notices', function () {
	if ( ! current_user_can( 'manage_woocommerce' ) || ! get_option( 'wwdh_stripe_missing' ) ) {
		return;
	}
	echo '<div class="notice notice-error"><p><strong>Stripe-only checkout:</strong> no Stripe payment method is enabled, '
		. 'so checkout is falling back to the other enabled methods (PayPal stays hidden). '
		. 'Enable Stripe in WooCommerce &rarr; Settings &rarr; Payments.</p></div>';
} );

/*
 * Product pages: no express payment buttons (Google Pay / Apple Pay / Link
 * from Payment Plugins for Stripe, or Stripe's own express checkout).
 * Customers use Add to cart -> checkout -> card form. Owner request 24 Nov.
 */
add_action( 'woocommerce_before_add_to_cart_button', function () {
	if ( function_exists( 'wc_stripe_get_container' ) && class_exists( '\PaymentPlugins\Stripe\Checkout\ExpressCheckoutRenderer' ) ) {
		$renderer = wc_stripe_get_container()->get( \PaymentPlugins\Stripe\Checkout\ExpressCheckoutRenderer::class );
		remove_action( 'woocommerce_after_add_to_cart_button', array( $renderer, 'render_product_buttons' ) );
		remove_action( 'woocommerce_before_add_to_cart_button', array( $renderer, 'render_product_buttons' ) );
	}
	remove_action( 'woocommerce_after_add_to_cart_button', array( 'WC_Stripe_Field_Manager', 'output_product_checkout_fields' ) );
	remove_action( 'woocommerce_before_add_to_cart_button', array( 'WC_Stripe_Field_Manager', 'output_product_checkout_fields' ) );
}, 0 );
add_filter( 'wc_stripe_hide_payment_request_on_product_page', '__return_true' );
add_action( 'wp_head', function () {
	if ( function_exists( 'is_product' ) && is_product() ) {
		echo '<style id="wwdh-no-product-express">.wc-stripe-product-checkout-container,#wc-stripe-express-checkout-element,#wc-stripe-express-checkout-button-separator{display:none!important}</style>' . "\n";
	}
}, 99 );
