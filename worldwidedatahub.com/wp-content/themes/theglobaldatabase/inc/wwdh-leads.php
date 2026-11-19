<?php
/**
 * WWDH lead capture: [wwdh_lead_form] shortcode, submission handler,
 * private "Leads" list in wp-admin and email notification.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* ---------- Leads post type (private, visible in wp-admin only) ---------- */
add_action( 'init', function () {
	register_post_type( 'wwdh_lead', array(
		'labels'          => array(
			'name'          => 'Leads',
			'singular_name' => 'Lead',
			'menu_name'     => 'Leads',
		),
		'public'          => false,
		'show_ui'         => true,
		'show_in_menu'    => true,
		'show_in_rest'    => false,
		'menu_icon'       => 'dashicons-email-alt',
		'menu_position'   => 25,
		'supports'        => array( 'title', 'editor' ),
		'capability_type' => 'post',
		'capabilities'    => array( 'create_posts' => 'do_not_allow' ),
		'map_meta_cap'    => true,
	) );
} );

/* ---------- Shortcode ---------- */
add_shortcode( 'wwdh_lead_form', function ( $atts ) {
	$atts = shortcode_atts( array(
		'country' => '',
		'source'  => '',
		'button'  => 'Get my free sample',
		'title'   => '',
	), $atts, 'wwdh_lead_form' );

	$status = isset( $_GET['lead'] ) ? sanitize_key( $_GET['lead'] ) : '';
	ob_start();
	?>
	<div class="lp-form-card" id="lead-form">
		<?php if ( $atts['title'] ) : ?>
			<h3 class="lp-form-title"><?php echo esc_html( $atts['title'] ); ?></h3>
		<?php endif; ?>
		<?php if ( 'ok' === $status ) : ?>
			<div class="lp-form-msg lp-form-ok" role="status">
				<strong>Thank you!</strong> Your request has been received. We will email your free sample and price within one business day.
			</div>
		<?php elseif ( 'err' === $status ) : ?>
			<div class="lp-form-msg lp-form-err" role="alert">Please enter your name and a valid business email, then try again.</div>
		<?php endif; ?>
		<form class="lp-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
			<input type="hidden" name="action" value="wwdh_lead">
			<?php wp_nonce_field( 'wwdh_lead', 'wwdh_lead_nonce' ); ?>
			<input type="hidden" name="lead_source" value="<?php echo esc_attr( $atts['source'] ? $atts['source'] : get_permalink() ); ?>">
			<input type="hidden" name="lead_referrer" value="" class="lp-ref">
			<input type="hidden" name="lead_utm" value="" class="lp-utm">
			<div class="lp-hp" aria-hidden="true">
				<label>Leave this empty <input type="text" name="website_url" tabindex="-1" autocomplete="off"></label>
			</div>
			<div class="lp-field">
				<label for="lp-name">Full name *</label>
				<input id="lp-name" type="text" name="lead_name" required autocomplete="name" placeholder="Your name">
			</div>
			<div class="lp-field">
				<label for="lp-email">Business email *</label>
				<input id="lp-email" type="email" name="lead_email" required autocomplete="email" placeholder="you@company.com">
			</div>
			<div class="lp-row">
				<div class="lp-field">
					<label for="lp-company">Company</label>
					<input id="lp-company" type="text" name="lead_company" autocomplete="organization" placeholder="Company name">
				</div>
				<div class="lp-field">
					<label for="lp-phone">WhatsApp / phone</label>
					<input id="lp-phone" type="tel" name="lead_phone" autocomplete="tel" placeholder="+">
				</div>
			</div>
			<div class="lp-field">
				<label for="lp-country">Data needed for</label>
				<input id="lp-country" type="text" name="lead_country" value="<?php echo esc_attr( $atts['country'] ); ?>" placeholder="Country / region">
			</div>
			<div class="lp-field">
				<label for="lp-msg">What do you need? <span class="lp-opt">(industry, city, job titles)</span></label>
				<textarea id="lp-msg" name="lead_message" rows="3" placeholder="e.g. Manufacturing companies in Bavaria, managing directors"></textarea>
			</div>
			<button type="submit" class="lp-btn lp-btn-primary lp-btn-block"><?php echo esc_html( $atts['button'] ); ?> <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
			<p class="lp-form-note"><i class="fa fa-lock" aria-hidden="true"></i> No payment needed. We reply within one business day.</p>
		</form>
	</div>
	<?php
	return ob_get_clean();
} );

/* ---------- Submission handler ---------- */
function wwdh_handle_lead() {
	$back = wp_get_referer() ? wp_get_referer() : home_url( '/' );
	$back = remove_query_arg( 'lead', $back );

	if ( ! isset( $_POST['wwdh_lead_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['wwdh_lead_nonce'] ) ), 'wwdh_lead' ) ) {
		wp_safe_redirect( add_query_arg( 'lead', 'err', $back ) . '#lead-form' );
		exit;
	}
	// Honeypot: bots fill hidden fields. Pretend success.
	if ( ! empty( $_POST['website_url'] ) ) {
		wp_safe_redirect( add_query_arg( 'lead', 'ok', $back ) . '#lead-form' );
		exit;
	}

	$f = array();
	foreach ( array( 'lead_name', 'lead_company', 'lead_phone', 'lead_country', 'lead_source', 'lead_referrer', 'lead_utm' ) as $k ) {
		$f[ $k ] = isset( $_POST[ $k ] ) ? sanitize_text_field( wp_unslash( $_POST[ $k ] ) ) : '';
	}
	$f['lead_email']   = isset( $_POST['lead_email'] ) ? sanitize_email( wp_unslash( $_POST['lead_email'] ) ) : '';
	$f['lead_message'] = isset( $_POST['lead_message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['lead_message'] ) ) : '';

	if ( '' === $f['lead_name'] || ! is_email( $f['lead_email'] ) ) {
		wp_safe_redirect( add_query_arg( 'lead', 'err', $back ) . '#lead-form' );
		exit;
	}

	// Simple rate limit: 5 submissions per IP per hour.
	$ip  = isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : '';
	$key = 'wwdh_lead_' . md5( $ip );
	$n   = (int) get_transient( $key );
	if ( $n >= 5 ) {
		wp_safe_redirect( add_query_arg( 'lead', 'ok', $back ) . '#lead-form' );
		exit;
	}
	set_transient( $key, $n + 1, HOUR_IN_SECONDS );

	$body = sprintf(
		"Name: %s\nEmail: %s\nCompany: %s\nPhone/WhatsApp: %s\nData needed for: %s\n\nMessage:\n%s\n\nPage: %s\nReferrer: %s\nUTM: %s\nDate: %s",
		$f['lead_name'], $f['lead_email'], $f['lead_company'], $f['lead_phone'], $f['lead_country'],
		$f['lead_message'], $f['lead_source'], $f['lead_referrer'], $f['lead_utm'], current_time( 'mysql' )
	);

	$id = wp_insert_post( array(
		'post_type'    => 'wwdh_lead',
		'post_status'  => 'private',
		'post_title'   => wp_strip_all_tags( $f['lead_name'] . ' – ' . ( $f['lead_country'] ? $f['lead_country'] : 'General' ) ),
		'post_content' => $body,
	) );
	if ( $id && ! is_wp_error( $id ) ) {
		foreach ( $f as $k => $v ) {
			update_post_meta( $id, $k, $v );
		}
	}

	$to = apply_filters( 'wwdh_lead_recipient', get_option( 'admin_email' ) );
	wp_mail(
		$to,
		'New lead: ' . $f['lead_name'] . ( $f['lead_country'] ? ' (' . $f['lead_country'] . ')' : '' ),
		$body,
		array( 'Reply-To: ' . $f['lead_name'] . ' <' . $f['lead_email'] . '>' )
	);

	wp_safe_redirect( add_query_arg( 'lead', 'ok', $back ) . '#lead-form' );
	exit;
}
add_action( 'admin_post_nopriv_wwdh_lead', 'wwdh_handle_lead' );
add_action( 'admin_post_wwdh_lead', 'wwdh_handle_lead' );

/* Show key fields as columns in wp-admin → Leads */
add_filter( 'manage_wwdh_lead_posts_columns', function ( $c ) {
	return array(
		'cb'           => $c['cb'],
		'title'        => 'Lead',
		'lead_email'   => 'Email',
		'lead_company' => 'Company',
		'lead_source'  => 'Page',
		'date'         => 'Date',
	);
} );
add_action( 'manage_wwdh_lead_posts_custom_column', function ( $col, $id ) {
	$v = get_post_meta( $id, $col, true );
	if ( 'lead_email' === $col ) {
		echo '<a href="mailto:' . esc_attr( $v ) . '">' . esc_html( $v ) . '</a>';
	} elseif ( 'lead_source' === $col ) {
		echo esc_html( wp_parse_url( $v, PHP_URL_PATH ) );
	} else {
		echo esc_html( $v );
	}
}, 10, 2 );
