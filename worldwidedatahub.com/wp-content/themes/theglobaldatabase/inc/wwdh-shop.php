<?php
/**
 * WWDH shop tweaks.
 * The data-file fields list used to sit on every product page under the
 * add-to-cart button. It now shows on the checkout page, right above the
 * payment methods, so buyers see what the file contains when they pay.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function wwdh_data_fields() {
	return array( 'First Name', 'Business Name', 'Address', 'State', 'Email ID', 'Phone No.', 'Fax', 'Website' );
}

add_action( 'woocommerce_review_order_before_payment', function () {
	echo '<div class="wwdh-fields-box">';
	echo '<h4>What&rsquo;s included in your data file</h4>';
	echo '<ul>';
	foreach ( wwdh_data_fields() as $field ) {
		echo '<li>' . esc_html( $field ) . '</li>';
	}
	echo '</ul>';
	echo '<p class="wwdh-fields-note">After payment you will receive an instant download link by email.</p>';
	echo '</div>';
} );

add_action( 'wp_head', function () {
	if ( ! function_exists( 'is_checkout' ) || ! is_checkout() ) {
		return;
	}
	echo '<style>.wwdh-fields-box{border:1px solid #e5e7eb;border-radius:8px;background:#fafafa;padding:16px 18px;margin:0 0 20px}'
		. '.wwdh-fields-box h4{font-size:16px;margin:0 0 10px;color:#0b1a3a}'
		. '.wwdh-fields-box ul{list-style:none;margin:0;padding:0;display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:6px 16px}'
		. '.wwdh-fields-box li{position:relative;padding-left:20px;color:#fc6543;font-size:14px}'
		. '.wwdh-fields-box li:before{content:"\2713";position:absolute;left:0;color:#fc6543;font-weight:700}'
		. '.wwdh-fields-note{margin:12px 0 0;font-size:13px;color:#555}'
		. '@media(min-width:768px){.wwdh-fields-box ul{grid-template-columns:repeat(4,minmax(0,1fr))}}</style>' . "\n";
} );
