<?php
/*
    Plugin Name: Cryptadium
    Plugin URI: http://cryptadium.com/
    Description: Cryptadium plugin for WooComerce
    Version: 1.0
	  Author: Cryptadium
    Author URI: http://cryptadium.com/
    License: 
    License URI:
*/
namespace Ccore;
if (class_exists( 'WooCommerce' )) {
    class cryptadium_gateway extends \WC_Payment_Gateway {
        var $cptUrl;
        public function __construct() {
            $this->id = 'cryptadium';
            $this->icon = '';
            $this->has_fields = true;
            $this->method_title = __( 'Cryptadium Gateway', 'woocommerce' );
            $this->cptUrl   = add_query_arg( 'wc-api', 'cryptadium_gateway', home_url( '/' ) );
            // Loading the settings.
            $this->init_form_fields();
            $this->init_settings();
            // Set user set variables
            $this->title = $this->get_option( 'title' );
            $this->description = $this->get_option( 'description' );
            $this->merchant_id 			= $this->get_option( 'merchant_id' );
            $this->cpt_secret   = $this->get_option( 'cpt_secret' );
            $this->send_shipping	= $this->get_option( 'send_shipping' );
            $this->debug_email			= $this->get_option( 'debug_email' );
            $this->allow_zero_confirm = $this->get_option( 'allow_zero_confirm' ) == 'yes' ? true : false;
            $this->form_submission_method = $this->get_option( 'form_submission_method' ) == 'yes' ? true : false;
            $this->invoice_prefix	= $this->get_option( 'invoice_prefix', 'WC-' );
            $this->simple_total = $this->get_option( 'simple_total' ) == 'yes' ? true : false;
            // Actions
            add_action( 'woocommerce_update_options_payment_gateways_' . $this->id, array( $this, 'process_admin_options' ) );
            // Payment listener/API hook
            add_action( 'woocommerce_api_cryptadium_gateway', array( $this, 'check_cpt_response' ) );
        }
        /*----------------------------------------------------------
        Initialise Gateway Settings Form Fields. 
        ----------------------------------------------------------*/
        public function init_form_fields(){
            $this->form_fields = array(
                'enabled' => array(
                                'title' => __( 'Enable/Disable', 'woocommerce' ),
                                'type' => 'checkbox',
                                'label' => __( 'Enable Cryptadium', 'woocommerce' ),
                                'default' => 'yes'
                            ),
                'title' => array(
                                'title' => __( 'Title', 'woocommerce' ),
                                'type' => 'text',
                                'description' => __( 'This controls the title which the user sees during checkout.', 'woocommerce' ),
                                'default' => __( 'Cryptadium', 'woocommerce' ),
                                'desc_tip'      => true,
                            ),
                'description' => array(
                                'title' => __( 'Description', 'woocommerce' ),
                                'type' => 'textarea',
                                'description' => __( 'This controls the description which the user sees during checkout.', 'woocommerce' ),
                                'default' => __( 'Pay with cryptocurrencies via Cryptadium. Please note that the exchange rates provided by our currency exchange service are not updated in real time and may differ from the most current market rates. Additionally, all conversions will be processed first to USD and then to USDT, which may result in a higher final price due to multiple conversion steps. We recommend users to carefully review the applicable exchange rates and fees before initiating any transactions. Providing transaction, you accept current exchange rate and fees.', 'woocommerce' )
                            ),
                'merchant_id' => array(
                                'title' => __( 'Merchant ID', 'woocommerce' ),
                                'type' 			=> 'text',
                                'description' => __( 'Please enter your Cryptadium Merchant ID.', 'woocommerce' ),
                                'default' => '',
                            ),
                
                'pcurr' => array(
                                'title' => __( 'Payment currency', 'woocommerce' ),
                                'type' 			=> 'select',
                                'description' => __( 'Please select payment currency.', 'woocommerce' ),
                                'default' => 'BTC',
                                'options' => array(
                                    'AVAX (C-CHAIN)' => 'AVAX (C-CHAIN)',
                                    'ETH' => 'Ether',
                                    'DASH' => 'DASH',
                                    'USDC' => 'USD Coin',
                                    'USDT (TRC20)' => 'Tether USD (OMNI)',
                                    'ETH (TRC20)' => 'Ether (TRC20)',
                                    'TRX' => 'TRON',
                                    'USDC (BEP20)' => 'USD Coin (BEP20)',
                                    'DAI (BEP20)' => 'DAI (BEP20)',
                                    'BNB' => 'BNB',
                                    'BUSD' => 'Binance USD',
                                    'HUSD' => 'Huobi USD',
                                    'USDT' => 'Tether USD (OMNI)',
                                    'DOGE' => 'Dogecoin',
                                    'BTC' => 'Bitcoin',
                                    'HUSD (TRC20)' => 'Huobi USD (TRC20)',
                                    'USDT (BEP20)' => 'Tether USD (OMNI)',
                                    'TUSD' => 'TrueUSD',
                                    'ADA (BEP20)' => 'ADA (BEP20)',
                                    'LTC' => 'Litecoin',
                                    'XRP' => 'Ripple',
                                    'HT (TRC20)' => 'HT (TRC20)',
                                    'BUSD (BEP20)' => 'Binance USD (BEP20)',
                                    'ETH (BEP20)' => 'Ether (BEP20)',
                                    'DAI' => 'DAI',
                                    'USDT (OMNI)' => 'Tether USD (OMNI)',
                                )
                            ),
                'cpt_secret' => array(
                                'title' => __( 'WebHook password', 'woocommerce' ),
                                'type' 			=> 'text',
                                'description' => __( 'Please enter your Cryptadium WebHook password.', 'woocommerce' ),
                                'default' => '',
                            ),
                'simple_total' => array(
                                'title' => __( 'Compatibility Mode', 'woocommerce' ),
                                'type' => 'checkbox',
                                'label' => __( "This may be needed for compatibility with certain addons if the order total isn't correct.", 'woocommerce' ),
                                'default' => ''
                            ),
                'send_shipping' => array(
                                'title' => __( 'Collect Shipping Info?', 'woocommerce' ),
                                'type' => 'checkbox',
                                'label' => __( 'Enable Shipping Information on Checkout page', 'woocommerce' ),
                                'default' => 'yes'
                            ),
                'allow_zero_confirm' => array(
                                'title' => __( 'Enable 1st-confirm payments?', 'woocommerce' ),
                                'type' => 'checkbox',
                                'label' => __( '* WARNING * If this is selected orders will be marked as paid as soon as your buyer\'s payment is detected, but before it is fully confirmed. This can be dangerous if the payment never confirms and is only recommended for digital downloads.', 'woocommerce' ),
                                'default' => ''
                            ),
                'invoice_prefix' => array(
                                'title' => __( 'Invoice Prefix', 'woocommerce' ),
                                'type' => 'text',
                                'description' => __( 'Please enter a prefix for your invoice numbers. If you use your Cryptadium account for multiple stores ensure this prefix is unique.', 'woocommerce' ),
                                'default' => 'WC-',
                                'desc_tip'      => true,
                            ),
                'testing' => array(
                                'title' => __( 'Gateway Testing', 'woocommerce' ),
                                'type' => 'title',
                                'description' => '',
                            ),
                'debug_email' => array(
                                'title' => __( 'Debug Email', 'woocommerce' ),
                                'type' => 'email',
                                'default' => '',
                                'description' => __( 'Send copies of invalid IPNs to this email address.', 'woocommerce' ),
                            )
                );
                
        }

        public function admin_options() {
            ?>
            <h3><?php _e( 'Cryptadium', 'woocommerce' ); ?></h3>
            <p><?php _e( 'Completes checkout via Cryptadium. ', 'woocommerce' ); ?></p>
                <?php if ( true ) : ?>
                <table class="form-table">
                    <?php $this->generate_settings_html(); ?>
                </table>
            <?php else : ?>
                <div class="inline error"><p><strong><?php _e( 'Gateway Disabled', 'woocommerce' ); ?></strong>: <?php _e( 'Cryptadium does not support your store currency.', 'woocommerce' ); ?></p></div>
            <?php
                endif;
        }
       
        /*----------------------------------------------------------
        Initialise Arguments And Check Currency, If Not USD Turn Into USD. 
        ----------------------------------------------------------*/
        function get_cryptadium_args( $order ) {
            global $woocommerce;
            $order_id = $order->get_id();
            if ( in_array( $order->get_billing_country(), array( 'US','CA' ) ) ) {
                $order->set_billing_phone(str_replace( array( '( ', '-', ' ', ' )', '.' ), '', $order->get_billing_phone() ));
            }
            $cryptadium_args = array(
                    'ShopId' 				=> $this->merchant_id,
                    'BillingID' 			=> $order->id,
                    'currency' 		        => $order->get_currency(),
                    'AmountUsd'             => $order->get_total(),
                    'name'      			=> $order->get_billing_first_name(),
                    'lastname'				=> $order->get_billing_last_name(),
                    'email'					=> $order->get_billing_email(),
                    'test'                  => 'True',
                    'Description'           => '',
                    'ReturnInfo'            => 'False',
            );
            if ($cryptadium_args['currency']!=="USD") {
                $req_url = 'https://api.exchangerate-api.com/v4/latest/USD';
                $response_json = file_get_contents($req_url);
                if(false !== $response_json) {
                    $response_object = json_decode($response_json);
                    $base_price = $order->get_total();
                    $cur=$cryptadium_args['currency'];
                    $USD_price = round(($base_price / $response_object->rates->$cur), 12);
                   // $cryptadium_args['Description'] = "bp: ".$base_price." cur: ".$response_object->rates->$cur." usd: ".$USD_price;
                    $cryptadium_args['AmountUsd']=$USD_price;
                    $cryptadium_args['currency'] = $this->get_option( 'pcurr' );

                }
            } else {
                $cryptadium_args['currency'] = $this->get_option( 'pcurr' );
            }
            
            return $cryptadium_args;
        }
        /*----------------------------------------------------------
        URL Generator For Send Info. 
        ----------------------------------------------------------*/
        function generate_cryptadium_url($order) {
            global $woocommerce;
            if ( $order->get_status() != 'completed' && get_post_meta($order->get_id(), 'Cryptadium payment complete', true ) != 'Yes' ) {
                $order->update_status('pending', 'Customer is being redirected to Cryptadium...');
            }
            $cryptadium_adr = "https://dashboard.cryptadium.com/Payment/DetailsWithoutEmail?";

            $cryptadium_args = $this->get_cryptadium_args( $order );
            $cryptadium_adr .= http_build_query( $cryptadium_args, '', '&' );
            return $cryptadium_adr;
        }
        /*----------------------------------------------------------
        Array Generator For Send Info And Send It. 
        ----------------------------------------------------------*/     
        function process_payment( $order_id ) {
            $order          = wc_get_order( $order_id );
            return array(
                'result' 	=> 'success',
                'redirect'	=> $this->generate_cryptadium_url($order),
            );
           
        }
        function _update_order_status($order_id,$status) {
            $order = wc_get_order($order_id);
            if ($status == 'Success')
                $status = "wc-completed";
            if ($status == 'Insufficient')
                $status = "wc-on-hold";
            if ($status == 'Canceled')
                $status = "wc-cancelled";
            $order->set_status($status);
            $order->save();
        }
        /*----------------------------------------------------------
        Check Response From Cryptadium. 
        ----------------------------------------------------------*/  
        function check_cpt_response () {
            $payload = file_get_contents( 'php://input' );
            if ( !empty( $payload ) && $this->validate_webhook( $payload ) ) {
                $data       = json_decode( $payload, true );
                $order_id = $data['BillingID'];
                if ( ! isset( $order_id ) ) {
				    exit;
			    }
                $this->_update_order_status( $order_id, $data['Status'] );
                exit;
            }
        }
        public function validate_webhook( $payload ) {
            $data = json_decode( $payload, true );
            if ( !isset( $data['Signature'] ) ) {
                return false;
            }
            $sig    = $data['Signature'];
            $merchant = $this->get_option( 'merchant_id' );
            $secret = $this->get_option( 'cpt_secret' );
            $sig2 = hash( 'md5', $data['PaymentId'].":".$merchant.":".$data['Email'].":".$data['Currency'].":".$secret );
            if ( $sig === $sig2 ) {
                return true;
            }
            return false;
        }
        public static function log( $message, $level = 'info' ) {
            return call_user_func( self::$log, $message, $level );
        }
    }
} else {
    interface  cryptadium_gateway {
        public function init_form_fields();
        public function admin_options();
        function get_cryptadium_args( $order );
        function generate_cryptadium_url($order);
        function process_payment( $order_id );
        function _update_order_status($order_id,$status);
        function check_cpt_response ();
        public function validate_webhook( $payload );
        public static function log( $message, $level = 'info' );
    }
	add_action( 'admin_notices', 'Ccore\no_woo' );

	function no_woo() {
		$class = 'notice notice-error';
		$message = __( 'Please install or activate woocomerce!', 'sample-text-domain' );
		printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) );
	}
    
}
?>