<?php
/**
 * @package SmsSend
 * @version 2.0
 */
/*
  Plugin Name: SMSALA International SMS Notifications
  Plugin URI: https://smsala.com/docs/
  Description: Using this plugin you can send custom sms as well as woocommerce order place, cancel, delivery messages etc..
  Author: SMSALA Developer Team
  Version: 2.0
  Author URI: https://www.smsala.com
 */

/*
  This program is free software; you can redistribute it and/or
  modify it under the terms of the GNU General Public License
  as published by the Free Software Foundation; either version 2
  of the License, or (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

  Copyright 2005-2015 Automattic, Inc.
 */

// Make sure we don't expose any info if called directly



if (!function_exists('add_action')) {
    echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
    exit;
}
define('SMS_SEND', '1.0.1');
define('SMS_SEND__MINIMUM_WP_VERSION', '1.0');
define('SMS_SEND__PLUGIN_DIR', plugin_dir_path(__FILE__));
define('SMS_SEND_DELETE_LIMIT', 100000);




register_activation_hook(__FILE__, 'sms_install');

function sms_install() {

    global $wpdb;
    $table_name = $wpdb->prefix . 'options';

    $wpdb->insert(
            $table_name, array(
        'option_name' => "smsala_api_id",
        'option_value' => "xyz",
            )
    );
    $wpdb->insert(
            $table_name, array(
        'option_name' => "smsala_api_password",
        'option_value' => "xyz",
            )
    );
    $wpdb->insert(
            $table_name, array(
        'option_name' => "smsala_sender_id",
        'option_value' => "DEMOSM",
            )
    );
    $wpdb->insert(
            $table_name, array(
        'option_name' => "smsala_sms_type",
        'option_value' => "O",
            )
    );
    $wpdb->insert(
            $table_name, array(
        'option_name' => "smsala_encoding",
        'option_value' => "T",
            )
    );
    $wpdb->insert(
            $table_name, array(
        'option_name' => "smsala_WooCommerce",
        'option_value' => "deactivate",
            )
    );
    $wpdb->insert(
            $table_name, array(
        'option_name' => "smsala_url_key",
        'option_value' => "aHR0cDovL2FwaS5zbXNhbGEuY29tL2FwaS9TZW5kU01T",
            )
    );
    $wpdb->insert(
            $table_name, array(
        'option_name' => "smsala_url_message_status",
        'option_value' => "aHR0cDovL2FwaS5zbXNhbGEuY29tL2FwaS9HZXREZWxpdmVyeVN0YXR1cw==",
            )
    );
    $wpdb->insert(
            $table_name, array(
        'option_name' => "smsala_enabled_wc_checkout_form",
        'option_value' => "0",
            )
    );

    $wpdb->insert(
            $table_name, array(
        'option_name' => "smsala_new_order_place",
        'option_value' => "Order Received We have received your order id {{Order_id}} amounting to Rs.{{Order_total}}.",
            )
    );

    $wpdb->insert(
            $table_name, array(
        'option_name' => "smsala_pending_order",
        'option_value' => "Hello, {{user_name}} Your Order id {{Order_id}} has been pending.",
            )
    );


    $wpdb->insert(
            $table_name, array(
        'option_name' => "smsala_processing_order",
        'option_value' => "Hello, {{user_name}} Your Order id {{Order_id}} has been proceed.",
            )
    );

    $wpdb->insert(
            $table_name, array(
        'option_name' => "smsala_on_hold_order",
        'option_value' => "Hello, {{user_name}} Your Order id {{Order_id}} has been on-hold.",
            )
    );

    $wpdb->insert(
            $table_name, array(
        'option_name' => "smsala_completed_order",
        'option_value' => "Hello, {{user_name}} Your Order id {{Order_id}} has been completed.",
            )
    );
    $wpdb->insert(
            $table_name, array(
        'option_name' => "smsala_cancelled_order",
        'option_value' => "Hello, {{user_name}} Your Order id {{Order_id}} has been cancelled.",
            )
    );

    $wpdb->insert(
            $table_name, array(
        'option_name' => "smsala_failed_order",
        'option_value' => "Hello, {{user_name}} Your Order id {{Order_id}} has been failed.",
            )
    );

    $wpdb->insert(
            $table_name, array(
        'option_name' => "smsala_new_order_place_active_deactive",
        'option_value' => "0",
            )
    );
    $wpdb->insert(
            $table_name, array(
        'option_name' => "smsala_pending_order_active_deactive",
        'option_value' => "0",
            )
    );


    $wpdb->insert(
            $table_name, array(
        'option_name' => "smsala_processing_order_active_deactive",
        'option_value' => "0",
            )
    );

    $wpdb->insert(
            $table_name, array(
        'option_name' => "smsala_on_hold_order_active_deactive",
        'option_value' => "0",
            )
    );

    $wpdb->insert(
            $table_name, array(
        'option_name' => "smsala_completed_order_active_deactive",
        'option_value' => "0",
            )
    );
    $wpdb->insert(
            $table_name, array(
        'option_name' => "smsala_cancelled_order_active_deactive",
        'option_value' => "0",
            )
    );

    $wpdb->insert(
            $table_name, array(
        'option_name' => "smsala_failed_order_active_deactive",
        'option_value' => "0",
            )
    );
    $wpdb->insert(
            $table_name, array(
        'option_name' => "smsala_refunded_order_active_deactive",
        'option_value' => "0",
            )
    );
    $wpdb->insert(
            $table_name, array(
        'option_name' => "smsala_refunded_order",
        'option_value' => "Hello, {{user_name}} Your Order id {{Order_id}} has been refuded amount Rs.{{Order_total}}",
            )
    );

    $wpdb->insert(
            $table_name, array(
        'option_name' => "smsala_checkout_otp",
        'option_value' => "{{OTP}} is your one time password to proceed on bulksmsplans. Do not share your OTP with anyone.",
            )
    );
    global $wpdb;


    $table_name = $wpdb->prefix . "smsala_sms_logs";

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
		id INT(12)  AUTO_INCREMENT PRIMARY KEY,
                request text NOT NULL,
                response text NOT NULL,
                status VARCHAR(255) NOT NULL DEFAULT 'Pending',
                api_call DATETIME NULL DEFAULT NULL
	) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta($sql);
}

register_uninstall_hook(__FILE__, 'uninstall_sms');

function uninstall_sms() {
    global $wpdb;
    $table_name = $wpdb->prefix . "options";
    $where = "'smsala_api_id','smsala_api_password','smsala_sender_id','smsala_sms_type','smsala_encoding,'smsala_url_key','smsala_url_message_status'";
    $sql = "DELETE FROM `$table_name` WHERE `option_name` IN ($where)";
    $wpdb->query($sql);
}

// shot code 
add_shortcode('SMS_SEND_PLUGIN', 'send_sms_shortcode');

function send_sms_shortcode($user_data) {
    global $wpdb;
    $table_name = $wpdb->prefix . "options";
    $where = "'smsala_url_key','smsala_api_id','smsala_api_password','smsala_sender_id','smsala_sms_type','smsala_encoding'";
    $data = $wpdb->get_results("SELECT * from $table_name WHERE `option_name` IN ($where)");
    if (isset($data) && !empty($data)) {

        $msg_data = urlencode($user_data['msg']);

        $url_custom = "";
        $url = "";
        foreach ($data as $key => $get_data) {
            if ($get_data->option_name == "smsala_url_key") {
                $url = base64_decode($get_data->option_value) . "?phonenumber=" . $user_data['phone_number'] . "&textmessage=" . $msg_data;
            } else {
                $url_custom.="&" . trim(str_replace("smsala_", '', $get_data->option_name)) . "=" . $get_data->option_value;
            }
        }
        $full_path_url = $url . $url_custom;

        $response = wp_remote_retrieve_body(wp_remote_get($full_path_url, array('sslverify' => false, 'timeout' => 60)));
        global $wpdb;
        $table_name = $wpdb->prefix . "smsala_sms_logs";
        $wpdb->insert(
                $table_name, array(
            'request' => json_encode($user_data),
            'response' => $response,
                )
        );
        $response = json_decode($response);
        if ($response->status == 200) {
            return 1;
        } else {
            return $response->remarks;
        }
    }
}

function curl_data($url) {

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_SSL_VERIFYPEER => FALSE,
        CURLOPT_CUSTOMREQUEST => "GET",
    ));

    $response = curl_exec($curl);

    curl_close($curl);



    return $response;
}

function sms_send($phone, $msg) {
    $status = do_shortcode("[SMS_SEND_PLUGIN  phone_number='$phone' msg='$msg']");

    return $status;
}

// check woocommerce plugin active or not
if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
//new order
    add_action('woocommerce_new_order', 'order_place_sms', 1, 1);

    function order_place_sms($order_id) {

        if (!$order_id)
            return;


        $order = new WC_Order($order_id);
        $phone = $order->get_billing_phone();
        $name = $order->get_billing_first_name();
        $id = $order->get_id();
        $total = $order->get_total();
        if (isset($phone) && !empty($phone)) {
            $tracking_code = smsala_shipment_tracking($order_id);
            global $wpdb;
            $table_name = $wpdb->prefix . "options";
            $data_active_deactive = $wpdb->get_row("SELECT * from $table_name WHERE `option_name` ='smsala_new_order_place_active_deactive'");
            if (isset($data_active_deactive) && !empty($data_active_deactive)) {
                if ($data_active_deactive->option_value == 1) {
                    $data = $wpdb->get_row("SELECT * from $table_name WHERE `option_name` ='smsala_new_order_place'");
                    if (isset($data->option_value) && !empty($data->option_value)) {

                        $data->option_value = str_replace("{{user_name}}", $name, $data->option_value);
                        $data->option_value = str_replace("{{tracking_code}}", $tracking_code, $data->option_value);
                        $data->option_value = str_replace("{{Order_id}}", $id, $data->option_value);
                        $data->option_value = str_replace("{{Order_total}}", $total, $data->option_value);

                        $msg = $data->option_value;
                    } else {
                        $msg = "Order Received We have received your order id $id amounting to Rs.$total.";
                    }

                    sms_send($phone, $msg);
                }
            }
        }
    }

// order status pending

    add_action('woocommerce_order_status_pending', 'mysite_pending');

    function mysite_pending($order_id) {
        if (!$order_id)
            return;

        $order = new WC_Order($order_id);
        $phone = $order->get_billing_phone();
        $name = $order->get_billing_first_name();
        $id = $order->get_id();
        $total = $order->get_total();

        if (isset($phone) && !empty($phone)) {
            $tracking_code = smsala_shipment_tracking($order_id);
            global $wpdb;
            $table_name = $wpdb->prefix . "options";

            $data_active_deactive = $wpdb->get_row("SELECT * from $table_name WHERE `option_name` ='smsala_pending_order_place_active_deactive'");
            if (isset($data_active_deactive) && !empty($data_active_deactive)) {
                if ($data_active_deactive->option_value == 1) {
                    $data = $wpdb->get_row("SELECT * from $table_name WHERE `option_name` ='smsala_pending_order'");

                    if (isset($data->option_value) && !empty($data->option_value)) {


                        $data->option_value = str_replace("{{user_name}}", $name, $data->option_value);
                        $data->option_value = str_replace("{{tracking_code}}", $tracking_code, $data->option_value);
                        $data->option_value = str_replace("{{Order_id}}", $id, $data->option_value);
                        $data->option_value = str_replace("{{Order_total}}", $total, $data->option_value);

                        $msg = $data->option_value;
                    } else {
                        $msg = "Hello, $name Your Order id $id has been pending.";
                    }

                    sms_send($phone, $msg);
                }
            }
        }
    }

// order status processing
    add_action('woocommerce_order_status_processing', 'mysite_processing');

    function mysite_processing($order_id) {
        if (!$order_id)
            return;

        $order = new WC_Order($order_id);
        $phone = $order->get_billing_phone();
        $name = $order->get_billing_first_name();
        $id = $order->get_id();
        $total = $order->get_total();

        if (isset($phone) && !empty($phone)) {
            $tracking_code = smsala_shipment_tracking($order_id);
            global $wpdb;
            $table_name = $wpdb->prefix . "options";
            $data_active_deactive = $wpdb->get_row("SELECT * from $table_name WHERE `option_name` ='smsala_processing_order_active_deactive'");
            if (isset($data_active_deactive) && !empty($data_active_deactive)) {
                if ($data_active_deactive->option_value == 1) {
                    $data = $wpdb->get_row("SELECT * from $table_name WHERE `option_name` ='smsala_processing_order'");
                    if (isset($data->option_value) && !empty($data->option_value)) {

                        $data->option_value = str_replace("{{user_name}}", $name, $data->option_value);
                        $data->option_value = str_replace("{{tracking_code}}", $tracking_code, $data->option_value);
                        $data->option_value = str_replace("{{Order_id}}", $id, $data->option_value);
                        $data->option_value = str_replace("{{Order_total}}", $total, $data->option_value);

                        $msg = $data->option_value;
                    } else {
                        $msg = "Hello, $name Your Order id $id has been proceed.";
                    }


                    sms_send($phone, $msg);
                }
            }
        }
    }

// order status on-hold
    add_action('woocommerce_order_status_on-hold', 'mysite_hold');

    function mysite_hold($order_id) {
        if (!$order_id)
            return;

        $order = new WC_Order($order_id);
        $phone = $order->get_billing_phone();
        $name = $order->get_billing_first_name();
        $id = $order->get_id();
        $total = $order->get_total();

        if (isset($phone) && !empty($phone)) {
            $tracking_code = smsala_shipment_tracking($order_id);
            global $wpdb;
            $table_name = $wpdb->prefix . "options";

            $data_active_deactive = $wpdb->get_row("SELECT * from $table_name WHERE `option_name` ='smsala_on_hold_order_active_deactive'");
            if (isset($data_active_deactive) && !empty($data_active_deactive)) {
                if ($data_active_deactive->option_value == 1) {
                    $data = $wpdb->get_row("SELECT * from $table_name WHERE `option_name` ='smsala_on_hold_order'");
                    if (isset($data->option_value) && !empty($data->option_value)) {

                        $data->option_value = str_replace("{{user_name}}", $name, $data->option_value);
                        $data->option_value = str_replace("{{tracking_code}}", $tracking_code, $data->option_value);
                        $data->option_value = str_replace("{{Order_id}}", $id, $data->option_value);
                        $data->option_value = str_replace("{{Order_total}}", $total, $data->option_value);

                        $msg = $data->option_value;
                    } else {
                        $msg = "Hello, $name Your Order id $id has been on hold.";
                    }
                    sms_send($phone, $msg);
                }
            }
        }
    }

    function smsala_shipment_tracking($order_id) {

        $shipment_tracking = "";
        $order = new WC_Order($order_id);
        $order_data = $order->get_meta_data();

        if (isset($order_data) && !empty($order_data) && count($order_data)) {
            foreach ($order_data as $order_data_val) {
                if ($order_data_val->key == "_wc_shipment_tracking_items") {
                    $shipment_tracking = end($order_data_val->value)['tracking_number'];
                }
            }
        }
        return $shipment_tracking;
    }

// order status completed
    add_action('woocommerce_order_status_completed', 'mysite_completed');

    function mysite_completed($order_id) {
        if (!$order_id)
            return;

        $order = new WC_Order($order_id);
        $phone = $order->get_billing_phone();
        $name = $order->get_billing_first_name();
        $id = $order->get_id();
        $total = $order->get_total();

        if (isset($phone) && !empty($phone)) {
            $tracking_code = smsala_shipment_tracking($order_id);
            global $wpdb;
            $table_name = $wpdb->prefix . "options";

            $data_active_deactive = $wpdb->get_row("SELECT * from $table_name WHERE `option_name` ='smsala_completed_order_active_deactive'");
            if (isset($data_active_deactive) && !empty($data_active_deactive)) {
                if ($data_active_deactive->option_value == 1) {
                    $data = $wpdb->get_row("SELECT * from $table_name WHERE `option_name` ='smsala_completed_order'");
                    if (isset($data->option_value) && !empty($data->option_value)) {

                        $data->option_value = str_replace("{{user_name}}", $name, $data->option_value);
                        $data->option_value = str_replace("{{tracking_code}}", $tracking_code, $data->option_value);
                        $data->option_value = str_replace("{{Order_id}}", $id, $data->option_value);
                        $data->option_value = str_replace("{{Order_total}}", $total, $data->option_value);

                        $msg = $data->option_value;
                    } else {
                        $msg = "Hello, $name Your Order id $id has been completed.";
                    }
                    sms_send($phone, $msg);
                }
            }
        }
    }

// order status cancelled

    add_action('woocommerce_order_status_cancelled', 'mysite_cancelled');

    function mysite_cancelled($order_id) {
        if (!$order_id)
            return;

        $order = new WC_Order($order_id);

        $phone = $order->get_billing_phone();
        $name = $order->get_billing_first_name();
        $id = $order->get_id();
        $total = $order->get_total();

        if (isset($phone) && !empty($phone)) {
            $tracking_code = smsala_shipment_tracking($order_id);
            global $wpdb;
            $table_name = $wpdb->prefix . "options";

            $data_active_deactive = $wpdb->get_row("SELECT * from $table_name WHERE `option_name` ='smsala_cancelled_order_active_deactive'");
            if (isset($data_active_deactive) && !empty($data_active_deactive)) {
                if ($data_active_deactive->option_value == 1) {
                    $data = $wpdb->get_row("SELECT * from $table_name WHERE `option_name` ='smsala_cancelled_order'");
                    if (isset($data->option_value) && !empty($data->option_value)) {

                        $data->option_value = str_replace("{{user_name}}", $name, $data->option_value);
                        $data->option_value = str_replace("{{tracking_code}}", $tracking_code, $data->option_value);
                        $data->option_value = str_replace("{{Order_id}}", $id, $data->option_value);
                        $data->option_value = str_replace("{{Order_total}}", $total, $data->option_value);

                        $msg = $data->option_value;
                    } else {
                        $msg = "Hello, $name Your Order id $id has been cancelled.";
                    }
                    sms_send($phone, $msg);
                }
            }
        }
    }

// order status failed

    add_action('woocommerce_order_status_failed', 'mysite_failed');

    function mysite_failed($order_id) {
        if (!$order_id)
            return;

        $order = new WC_Order($order_id);
        $phone = $order->get_billing_phone();
        $name = $order->get_billing_first_name();
        $id = $order->get_id();
        $total = $order->get_total();

        if (isset($phone) && !empty($phone)) {
            $tracking_code = smsala_shipment_tracking($order_id);
            global $wpdb;
            $table_name = $wpdb->prefix . "options";
            $data_active_deactive = $wpdb->get_row("SELECT * from $table_name WHERE `option_name` ='smsala_failed_order_active_deactive'");
            if (isset($data_active_deactive) && !empty($data_active_deactive)) {
                if ($data_active_deactive->option_value == 1) {
                    $data = $wpdb->get_row("SELECT * from $table_name WHERE `option_name` ='smsala_failed_order'");
                    if (isset($data->option_value) && !empty($data->option_value)) {

                        $data->option_value = str_replace("{{user_name}}", $name, $data->option_value);
                        $data->option_value = str_replace("{{tracking_code}}", $tracking_code, $data->option_value);
                        $data->option_value = str_replace("{{Order_id}}", $id, $data->option_value);
                        $data->option_value = str_replace("{{Order_total}}", $total, $data->option_value);

                        $msg = $data->option_value;
                    } else {
                        $msg = "Hello, $name Your Order id $id has been failed.";
                    }

                    sms_send($phone, $msg);
                }
            }
        }
    }

// order status refunded

    add_action('woocommerce_order_status_refunded', 'mysite_refunded');

    function mysite_refunded($order_id) {
        if (!$order_id)
            return;

        $order = new WC_Order($order_id);

        $phone = $order->get_billing_phone();
        $name = $order->get_billing_first_name();
        $id = $order->get_id();
        $total = $order->get_total_refunded();

        if (isset($phone) && !empty($phone)) {
            $tracking_code = smsala_shipment_tracking($order_id);
            global $wpdb;
            $table_name = $wpdb->prefix . "options";

            $data_active_deactive = $wpdb->get_row("SELECT * from $table_name WHERE `option_name` ='smsala_refunded_order_active_deactive'");
            if (isset($data_active_deactive) && !empty($data_active_deactive)) {
                if ($data_active_deactive->option_value == 1) {
                    $data = $wpdb->get_row("SELECT * from $table_name WHERE `option_name` ='smsala_refunded_order'");
                    if (isset($data->option_value) && !empty($data->option_value)) {

                        $data->option_value = str_replace("{{user_name}}", $name, $data->option_value);
                        $data->option_value = str_replace("{{tracking_code}}", $tracking_code, $data->option_value);
                        $data->option_value = str_replace("{{Order_id}}", $id, $data->option_value);
                        $data->option_value = str_replace("{{Order_total}}", $total, $data->option_value);

                        $msg = $data->option_value;
                    } else {
                        $msg = "Hello, $name Your Order id $id has been refuded amount Rs.$total";
                    }
                    sms_send($phone, $msg);
                }
            }
        }
    }

}



// add menu admin site
add_action('admin_menu', 'set_menu');

function set_menu() {
// add_menu_page("Send Sms", "Send Sms", 1, "send-sms", "send_sms_from");

    add_menu_page('SMS Notifications', 'SMS Notifications', "", 'send-sms-menu');
    add_submenu_page('send-sms-menu', 'Bulk SMS Settings', 'Bulk SMS Settings', 'manage_options', 'bulk-sms-settings', 'send_sms_from');

    global $wpdb;
    $table_name = $wpdb->prefix . "options";

    $data = $wpdb->get_row("SELECT * from $table_name WHERE `option_name` ='smsala_WooCommerce'");

    if (isset($data->option_value) && !empty($data->option_value) && $data->option_value == "activate") {
        add_submenu_page('send-sms-menu', 'Custom Sms', 'Custom Sms', 'manage_options', 'custom-sms', 'custom_sms');
    }

    add_submenu_page('send-sms-menu', 'History', 'History', 'manage_options', 'sms-history', 'sms_history_data');
    add_submenu_page('send-sms-menu', 'Sms Send', 'Sms Send', 'manage_options', 'custom-sms-send', 'custom_sms_send');
}

function custom_sms() {
    global $wpdb;
    $table_name = $wpdb->prefix . "options";
    $where = "'smsala_enabled_wc_checkout_form','smsala_new_order_place','smsala_pending_order','smsala_processing_order','smsala_on_hold_order','smsala_completed_order','smsala_cancelled_order','smsala_failed_order','smsala_refunded_order','smsala_checkout_otp'";
    $data = $wpdb->get_results("SELECT * from $table_name WHERE `option_name` IN ($where)  ORDER BY `$table_name`.`option_id`  ASC");

    $where2 = "'smsala_failed_order_active_deactive','smsala_refunded_order_active_deactive','smsala_cancelled_order_active_deactive','smsala_completed_order_active_deactive','smsala_on_hold_order_active_deactive','smsala_processing_order_active_deactive','smsala_pending_order_active_deactive','smsala_new_order_place_active_deactive'";
    $data_active = $wpdb->get_results("SELECT * from $table_name WHERE `option_name` IN ($where2)  ORDER BY `$table_name`.`option_id`  ASC");
    ?>
    <style>
        .note_list{
            font-size: 14px;
            font-weight: 500;
        }
        .custom_msg_div
        {
            padding: 1px 17px; 
            background: #fff;
        }


        .head_css_blk
        {
            background: #233141; padding: 26px 22px 64px 22px; margin: 21px 0px;

        }
        .head_css_blk > div
        {

            float: left;
            width: 50%;
        }
        .head_links_blk
        {
            text-align: right; padding-top: 7px;
        }
        .head_links_blk a
        {
            color:#fff;font-size: 18px;
        }
    </style>
    <div id="wpbody-content">
        <div class="wrap">
            <h1>WooCommerce Custom Messages</h1>
            <div  class="head_css_blk">
                <div class="wcs-nux__notice-logo ">
                    <a href="https://www.smsala.com/">
                        <img src="<?= plugin_dir_url(__FILE__) . 'img/logo.png' ?>" />
                    </a>
                </div>
                <div class="head_links_blk">
                    <a href="https://www.smsala.com/" target="_blank">www.smsala.com</a>
                </div>


            </div>
            <div class="custom_msg_div">
                <h3>Note:</h3>
                <ol class="note_list">
                    <li>if you use WooCommerce plugin then below note read.</li>
                    <li>Use <b>{{user_name}}</b> if you need an user name</li>
                    <li>Use <b>{{Order_id}}</b> if you need an order id</li> 
                    <li>Use <b>{{Order_total}}</b> if you need an order total</li>
                    <li>Use <b>Advanced Shipment Tracking for WooCommerce</b> plugin if you need an <b>{{tracking_code}}</b>. <a href="https://wordpress.org/plugins/woo-advanced-shipment-tracking/" target="_black">Click here </a>  for download plugin.</li>
                    <li>If you use OTP value then use <b>{{OTP}}</b></li>
                </ol>
            </div>

            <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>" >

                <table class="form-table">
                    <tbody>
                        <?php
                        if (isset($data) && !empty($data)) {
                            foreach ($data as $data_val) {

                                if ($data_val->option_name == "smsala_enabled_wc_checkout_form") {
                                    ?>
                                    <tr>
                                        <th scope = "row"><label>OTP verification on checkout page</label></th>
                                        <td>
                                            <select name="<?php echo $data_val->option_name ?>">
                                                <option value="0"  <?php echo ( $data_val->option_value == 0) ? "selected" : "" ?>>OFF</option>
                                                <option value="1" <?php echo ( $data_val->option_value == 1) ? "selected" : "" ?>>ON</option>
                                            </select>
                                        </td>

                                    </tr>
                                    <?php
                                } else {
                                    ?>
                                    <tr>
                                        <th scope = "row"><label><?php echo ucwords(str_replace("blk", "", str_replace("_", " ", $data_val->option_name)));
                                    ?></label>
                                        </th>
                                        <td style="width: 32%"><textarea name="<?php echo $data_val->option_name ?>" type="text" placeholder="Enter <?php echo ucfirst(str_replace("_", " ", $data_val->option_name)); ?>" class="regular-text" required ><?php echo $data_val->option_value ?></textarea></td>

                                        <?php
                                        if (isset($data_active) && !empty($data_active)) {
                                            foreach ($data_active as $data_active_data) {
                                                if ($data_val->option_name . "_active_deactive" == $data_active_data->option_name) {
                                                    ?>
                                                    <td>

                                                        <select name="<?php echo $data_active_data->option_name ?>">
                                                            <option value="0"  <?php echo ($data_active_data->option_value == 0) ? "selected" : "" ?>>Deactive </option>
                                                            <option value="1"  <?php echo ($data_active_data->option_value == 1) ? "selected" : "" ?>>Active</option>
                                                        </select>
                                                    </td>

                                                    <?php
                                                }
                                            }
                                        }
                                        ?>

                                    </tr>
                                    <?php
                                }
                            }
                        }
                        ?>
                    </tbody>
                </table>
                <p class="submit">
                    <input type="submit" name="submit" id="submit" class="button button-primary" value="Update Changes">
                </p>
            </form>



        </div>
        <div class="clear"></div>
    </div>
    <?php
}

function sms_history_data() {
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <style>

        .head_css_blk
        {
            background: #233141; padding: 26px 22px 64px 22px; margin: 21px 0px;

        }
        .head_css_blk > div
        {

            float: left;
            width: 50%;
        }
        .head_links_blk
        {
            text-align: right; padding-top: 7px;
        }
        .head_links_blk a
        {
            color:#fff;font-size: 18px;
        }
        .tablenav a
        {
            padding: 8px;
            background: #F1F1F1;
            color: #000;
        }
        .tablenav .current
        {
            padding: 8px;
            background: #008EC2;
            color: #fff;
        }
        .msg_success{
            padding: 5px;
            background: #59BA41;
            color: #fff;
            border-radius: 5px;

        }
        .msg_error{
            padding: 5px;
            background: #DC3232;
            color: #fff;
            border-radius: 5px;

        }
    </style>
    <div id="wpbody-content">
        <div class="wrap">
            <h1>Sms Logs List</h1>
            <?php
            $pagenum = isset($_GET['pagenum']) ? absint($_GET['pagenum']) : 1;
            global $wpdb;
            $get_table_name = $wpdb->prefix . "smsala_sms_logs";
            $limit = 10;
            $offset = ( $pagenum - 1 ) * $limit;
            $total = $wpdb->get_var("SELECT COUNT(id) FROM $get_table_name ");
            $num_of_pages = ceil($total / $limit);
            $questionnaire_data = $wpdb->get_results("SELECT * FROM `$get_table_name` ORDER BY `$get_table_name`.`id` DESC LIMIT $offset, $limit ", OBJECT);
            $rowcount = $wpdb->num_rows;
            ?> 
            <div class="wrap">
                <div  class="head_css_blk">
                    <div class="wcs-nux__notice-logo ">
                        <a href="https://www.smsala.com/">
                        <img src="<?= plugin_dir_url(__FILE__) . 'img/logo.png' ?>" />
                    </a>
                    </div>
                    <div class="head_links_blk">
                        <a href="https://www.smsala.com/" target="_blank">www.smsala.com</a>
                    </div>
                </div>
                <br>
                <table class="wp-list-table widefat fixed striped" style="width: 99%;">
                    <thead>
                        <tr>
                            <th style="width: 5%; text-align: center; "><strong>S.No</strong></th>       
                            <th style="text-align: center; "><strong>Request</strong></th>       
                            <th style="text-align: center; "><strong>Response</strong></th>       
                            <th style="text-align: center;display: none;"><strong>Status</strong></th>      
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($rowcount) {
                            $i = 1;
                            foreach ($questionnaire_data as $key => $singledata) {
                                $json_decode_data = json_decode($singledata->response, true);
                                ?>
                                <tr>
                                    <td style="text-align: center; padding: 14px;" ><?php echo $i++; ?></td>
                                    <td style="text-align: center; padding: 14px;" ><?php echo $singledata->request; ?></td>
                                    <td style="text-align: center; padding: 14px;" ><?php echo $singledata->response; ?></td>
                                    <td  style="text-align: center; padding: 14px;display: none;">
                                        <?php
                                        $status = $singledata->status;
                                        if ($status == "Pending") {
                                            echo "<span class='msg_success' style='background:#F39C12'>" . $status . "</span>";
                                        } elseif ($status == "Delivered" || $status == "Accepted" || $status == "Acknowledged") {
                                            echo "<span class='msg_success'>" . $status . "</span>";
                                        } elseif ($status == "Rejected" || $status == "Failed" || $status == "Undeliverable" || $status == "Expired" || $status == "Unknown") {
                                            echo "<span class='msg_error'>" . $status . "</span>";
                                        } elseif ($status == "DND") {
                                            echo "<span class='msg_error' style='background:#3C8DBC'>" . $status . "</span>";
                                        }
                                        ?>


                                    </td>


                                </tr>

                                <?php
                            }
                        } else {
                            echo "<td colspan='4' align='center'> No details(s) found </td>";
                        }
                        ?>
                    </tbody>            
                    <tfoot>

                        <?php
                        $page_links = paginate_links(array(
                            'base' => add_query_arg('pagenum', '%#%'),
                            'format' => '',
                            'prev_text' => __('&laquo;', 'text-domain'),
                            'next_text' => __('&raquo;', 'text-domain'),
                            'total' => $num_of_pages,
                            'current' => $pagenum
                        ));
                        if ($page_links) {
                            ?>

                            <tr>

                                <td colspan="4"><div class="tablenav tablenav-pages" style="width: 99%;"><div class="tablenav-pages" style="margin: 1em 0"><?php echo $page_links ?></div></div></td>
                            </tr>
                            <?php
                        }
                        ?>

                    </tfoot>        
                </table>
                <script type="text/javascript" >
    $(document).ready(function () {
        var data = {
            action: 'custom_action',
        };
        jQuery.ajax({
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            type: 'post',
            data: data,
        });
    });

                </script>

            </div>
        </div>
        <div class="clear"></div>


    </div>
    <?php
}

add_action('wp_ajax_custom_action', 'custom_action_callback_wp');

function custom_action_callback_wp() {
    global $wpdb;
    $table_name = $wpdb->prefix . "options";
    $data = $wpdb->get_row("SELECT * from $table_name WHERE `option_name` ='smsala_url_message_status'");
    $get_table_name = $wpdb->prefix . "smsala_sms_logs";
    $old_time = date('Y-m-d H:i:s', strtotime('-5 minutes'));
    $questionnaire_data = $wpdb->get_results("SELECT * FROM `$get_table_name` WHERE  `api_call` <= '$old_time' OR `api_call` IS NULL  and `status` IN ('Pending','Accepted') ORDER BY `$get_table_name`.`id` DESC LIMIT 0, 100 ", OBJECT);
    $get_table_name = $wpdb->prefix . "smsala_sms_logs";
    $date = date('Y-m-d H:i:s');
    foreach ($questionnaire_data as $questionnaire_data_val) {
        $wpdb->query($wpdb->prepare("UPDATE `$get_table_name` SET `api_call` = '$date' WHERE `$get_table_name`.`id` = $questionnaire_data_val->id"));
        $json_decode_data = json_decode($questionnaire_data_val->response, true);
        if (is_numeric($json_decode_data['message'])) {
            $full_path_url = base64_decode($data->option_value) . "?message_id=" . $json_decode_data['message'];
            $response = wp_remote_retrieve_body(wp_remote_get($full_path_url));
            $response_data = json_decode($response, true);
            if (isset($response_data['data']['DLRStatus']) && !empty($response_data['data']['DLRStatus'])) {
                $status = $response_data['data']['DLRStatus'];
                global $wpdb;
                $get_table_name = $wpdb->prefix . "smsala_sms_logs";
                $wpdb->query($wpdb->prepare("UPDATE `$get_table_name` SET `status` = '$status' WHERE `$get_table_name`.`id` = $questionnaire_data_val->id"));
            }
        } else {
            global $wpdb;
            $get_table_name = $wpdb->prefix . "smsala_sms_logs";
            $wpdb->query($wpdb->prepare("UPDATE `$get_table_name` SET `status` = 'Failed' WHERE `$get_table_name`.`id` = $questionnaire_data_val->id"));
        }
    }
    exit();
}

// send sms pages from
function send_sms_from() {
    global $wpdb;

    $table_name = $wpdb->prefix . "options";

    $where = "'smsala_api_id','smsala_api_password','smsala_sender_id','smsala_sms_type','smsala_WooCommerce','smsala_encoding'";
    $data = $wpdb->get_results("SELECT * from $table_name WHERE `option_name` IN ($where)");
    ?>
    <style>

        .head_css_blk
        {
            background: #233141; padding: 26px 22px 64px 22px; margin: 21px 0px;

        }
        .head_css_blk > div
        {

            float: left;
            width: 50%;
        }
        .head_links_blk
        {
            text-align: right; padding-top: 7px;
        }
        .head_links_blk a
        {
            color:#fff;font-size: 18px;
        }
    </style>

    <div id="wpbody-content">
        <div class="wrap">
            <h1>Api Settings</h1>    
            <div  class="head_css_blk">
                <div class="wcs-nux__notice-logo ">
                    <a href="https://www.smsala.com/">
                        <img src="<?= plugin_dir_url(__FILE__) . 'img/logo.png' ?>" />
                    </a>
                </div>
                <div class="head_links_blk">
                    <a href="https://www.smsala.com/" target="_blank">www.smsala.com</a>
                </div>
            </div>
            <div class="notice notice-info"> 
                <p><strong>Sign up <a href="https://www.smsala.com/signup" target="_blank">Click</a> To Get Api Credentials.</strong></p>
            </div>
            <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>" >
                <table class="form-table">
                    <tbody>
                        <?php
                        if (isset($data) && !empty($data)) {
                            foreach ($data as $data_val) {
                                if ($data_val->option_name == "smsala_sms_typea") {
                                    ?>
                                    <tr>
                                        <th scope="row"><label >Message Type</label></th>
                                        <td>
                                            <select name="smsala_sms_type" required="">
                                                <option value="">Select Type </option>
                                                <option value="T"  <?php echo (isset($data_val->option_value) && !empty($data_val->option_value)) ? ($data_val->option_value == 1) ? "selected" : "" : "" ?>>Transactional </option>
                                                <option value="O" <?php echo (isset($data_val->option_value) && !empty($data_val->option_value)) ? ($data_val->option_value == 2) ? "selected" : "" : "" ?> >OTP </option>
                                            </select>
                                        </td>
                                    </tr>
                                    <?php
                                } elseif ($data_val->option_name == "smsala_WooCommerce") {
                                    ?>
                                    <tr>
                                        <th scope="row"><label>WooCommerce</label></th>
                                        <td>
                                            <select name="smsala_WooCommerce" required>
                                                <option value="activate" <?php echo (isset($data_val->option_value) && !empty($data_val->option_value)) ? ($data_val->option_value == "activate") ? "selected" : "" : "" ?>>Activate</option>
                                                <option value="deactivate"  <?php echo (isset($data_val->option_value) && !empty($data_val->option_value)) ? ($data_val->option_value == "deactivate") ? "selected" : "" : "" ?>>Deactivate</option>

                                            </select>
                                        </td>
                                    </tr>
                                    <?php
                                } else {
                                    ?>
                                    <tr>
                                        <th scope="row"><label><?php echo ucwords(str_replace('blk', '', str_replace("_", " ", $data_val->option_name))); ?></label></th>
                                        <td><input name="<?php echo $data_val->option_name ?>" type="text" placeholder="Enter <?php echo ucfirst(str_replace("_", " ", $data_val->option_name)); ?>" class="regular-text" required value="<?php echo $data_val->option_value ?>"></td>
                                    </tr>
                                    <?php
                                }
                            }
                        }
                        ?>

                    </tbody>
                </table>

                <p class="submit">
                    <input type="submit" name="submit" id="submit" class="button button-primary" value="Update Changes">

                </p>
            </form>
            <div style="padding: 14px;background: #fff;">
                <h3>Use this shortcode</h3>
                <b>do_shortcode("[SMS_SEND_PLUGIN  phone_number='1234567890' msg='Hello!']");</b>
                <p>This is a one type of sms plugin if you want send message then copy this shortcode and paste on your code and edit phone_number (Type your Number where you want to send message) and edit msg (Write down your message that you want to send a message). Message will be sent where you want to send.</p>
            </div>

        </div>
        <div class="clear"></div>


    </div>
    <?php
}

if (isset($_POST['submit']) && !empty($_POST['submit'])) {
    $saveData = $_POST;

    if (isset($saveData['action']) && !empty($saveData['action']) && $saveData['action'] == "send_sms_form") {
        $phone = $saveData['number'];
        $msg = $saveData['message'];
        $send = sms_send($phone, $msg);
        if ($send == 1) {
            custom_alert_sms('Sent sms has been successfully', 1);
        } else {
            custom_alert_sms($send, 0);
        }
    } else {
        if (isset($saveData) && !empty($saveData)) {
            foreach ($saveData as $key => $saveData_values) {
                global $wpdb;
                $table_name = $wpdb->prefix . "options";
                $wpdb->query("UPDATE `$table_name` SET `option_value` = '$saveData_values' WHERE `option_name` ='$key'");
            }
        }
    }
}

// top msg show
function custom_alert_sms($msg, $type) {
    if ($type) {
        ?>
        <div class="notice notice-success is-dismissible"> 
            <p><strong><?php echo $msg; ?></strong></p>
            <button type="button" class="notice-dismiss">
                <span class="screen-reader-text">Dismiss this .</span>
            </button>
        </div>
        <?php
    } else {
        ?>
        <div class="notice notice-error  is-dismissible"> 
            <p><strong><?php echo $msg; ?></strong></p>
            <button type="button" class="notice-dismiss">
                <span class="screen-reader-text">Dismiss this .</span>
            </button>
        </div>
        <?php
    }
}

function custom_sms_send() {
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <?php
    wp_enqueue_script('my_custom_script', plugin_dir_url(__FILE__) . 'js/bulksmsplans.js', array('jquery'), '1.0');
    ?>
    <style>
        .head_css_blk
        {
            background: #233141; padding: 26px 22px 64px 22px; margin: 21px 0px;

        }
        .head_css_blk > div
        {

            float: left;
            width: 50%;
        }
        .head_links_blk
        {
            text-align: right; padding-top: 7px;
        }
        .head_links_blk a
        {
            color:#fff;font-size: 18px;
        }
    </style>
    <div id="wpbody-content">
        <div class="wrap">
            <h1>Sms Send</h1>
            <div  class="head_css_blk">
                <div class="wcs-nux__notice-logo ">
                    <a href="https://www.smsala.com/">
                        <img src="<?= plugin_dir_url(__FILE__) . 'img/logo.png' ?>" />
                    </a>
                </div>
                <div class="head_links_blk">
                    <a href="https://www.smsala.com/" target="_blank">www.smsala.com</a>
                </div>
            </div>
            <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>"  id="send_sms_form" >
                <table class="form-table">
                    <tbody>
                    <input type="hidden" value="send_sms_form"  name="action">
                    <tr>
                        <th scope="row"><label>Mobile Number </th>
                        <td><input name="number" type="text" placeholder="Enter Number" class="regular-text "  id='txtPhone' required  >  <span id="spnPhoneStatus"></span></td>
                    </tr>
                    <tr>
                        <th scope="row"><label>Message </th>
                        <td>
                            <textarea name="message" type="text" placeholder="Enter Message" class="regular-text" id="message" required  rows="5"></textarea>

                            <div>
                                <div><span id="remaining">160</span>&nbsp;Character<span class="cplural">s</span> Remaining</div>
                                <div>Total&nbsp;<span id="messages">1</span>&nbsp;Message<span class="mplural">s</span>&nbsp;<span id="total">0</span>&nbsp;Character<span class="tplural">s</span></div>
                            </div>
                        </td>

                    </tr>


                    </tbody>
                </table>
                <p class="submit">
                    <input type="submit" name="submit" id="submit" class="button button-primary" value="Send">
                </p>
            </form>

        </div>
        <div class="clear"></div>


    </div>

    <?php
}

add_action('init', 'process_post');

function process_post() {
    global $wpdb;
    $table_name = $wpdb->prefix . "options";
    $where = "'smsala_enabled_wc_checkout_form'";
    $data = $wpdb->get_row("SELECT * from $table_name WHERE `option_name` IN ($where)");
    if (($data->option_value == 1)) {
        add_action('woocommerce_checkout_after_terms_and_conditions', 'woocommerce_checkout_form');

        function woocommerce_checkout_form() {
            ?>
            <div id="smsala_sms" style="display: none">
                <h3 id="smsala_verifysms">SMS Verification <abbr class="required" title="required">*</abbr></h3>
                <div id="smsala_sms_box" style="font-size: 15px; border: 1px solid silver; padding: 5px;">
                    <span id="smsala_sms_info_display">You are required to verify your phone number using SMS verification.  click on the below button to request for an OTP (One Time Password) SMS. <br><br></span>
                    <div id="msg_show" style="margin-bottom: 13px; display: none;"></div>
                    <div id="smsala_sms_otp" style="margin-bottom: 10px;">
                        <input type="hidden" name="smsala_phone_no" value="" id="smsala_phone_no">
                        <input type="text" name="smsala_sms_otp" id="smsala_sms_otp_code" placeholder="Enter OTP numbers"  >
                        <input type="button" name="smsala_submit_otp" id="smsala_submit_otp" value="Submit OTP" style="margin: 7px 0px; border: 1px solid silver;  ">
                        <input type="button" name="resend_otp" id="resend_otp" value="Resend OTP" style="margin: 7px 0px; border: 1px solid silver; ">
                    </div>
                    <input type="button" name="smsala_get_otp" id="smsala_get_otp" value="Request OTP" style="margin: 7px 0px; border: 1px solid silver; display: none;">
                    <input type="hidden" name="smsala_sms_retries" id="smsala_sms_retries" value="1">
                    <input type="hidden" name="smsala_check" id="smsala_check" value="">
                    <input type="hidden" name="smsala_sms_verified" id="smsala_sms_verified" value="">
                </div>
            </div>
            <style>
                input[type=text]:disabled {
                    background: #dddddd;
                }
            </style>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
            <script language="Javascript">
            jQuery(document.body).on("checkout_error", function () {
                var error_text = jQuery(".woocommerce-error").find("li").first().text();
                if (error_text.includes("Please complete the SMS Verification.")) {
                    jQuery("#smsala_sms").show();
                    jQuery('form[name="checkout"]').submit(function (event) {

                        var billing_phone = jQuery("#billing_phone").val();
                        var smsala_phone_no = $("#smsala_phone_no").val();
                        if (smsala_phone_no != billing_phone)
                        {
                            $("#smsala_sms_verified").val("");
                            $("#smsala_sms_otp").hide();
                            $("#smsala_sms_otp_code").val("");
                            $("#smsala_get_otp").show();
                            $("#msg_show").css("margin-bottom", '-22px');

                        }

                        if (jQuery.trim(jQuery("#smsala_sms_verified").val()) == "") {
                            // not yet verified
                            event.preventDefault();
                            event.stopImmediatePropagation();
                            $("#msg_show").show();
                            $("#msg_show").html('<div style="background: #EBA3A3; padding: 7px 20px;"><span style="color: #761919;">Please complete the SMS Verification.</span></div><br>');
                            jQuery("#smsala_sms_otp").focus();

                            document.getElementById("smsala_verifysms").scrollIntoView(true);
                        }
                    });
                }
            });
            jQuery('form[name="checkout"]').submit(function (event) {
                if (jQuery.trim(jQuery("#smsala_sms_retries").val()) == "1") {

                    var billing_phone = jQuery("#billing_phone").val();
                    $("#smsala_phone_no").val(billing_phone);
                    var smsala_phone_no = $("#smsala_phone_no").val();
                    if (smsala_phone_no == billing_phone)
                    {
                        doOTP();
                    } else {
                        $("#smsala_sms_verified").val("");
                    }


                }
                jQuery("#smsala_sms_retries").val("0");
            });
            jQuery("#resend_otp").click(function () {
                if (!confirm("Send OTP to " + jQuery("#smsala_phone_no").val() + "?")) {
                    e.preventDefault();
                } else {
                    doOTP();
                }
            });

            jQuery("#smsala_get_otp").click(function (e) {
                $("#smsala_phone_no").val(jQuery("#billing_phone").val());
                var phone_num = $("#smsala_phone_no").val();
                if (phone_num == "") {
                    alert("Please enter a valid phone number.");
                    jQuery("#billing_phone").focus();
                } else if (!confirm("Send OTP to " + phone_num + "?")) {
                    e.preventDefault();
                } else {
                    doOTP();
                    $("#smsala_sms_otp").show();
                    $("#msg_show").html('');
                    $("#msg_show").hide();
                    $("#smsala_get_otp").hide();
                }
            });
            function doOTP() {

                var phone_num = jQuery("#smsala_phone_no").val();

                var data = {
                    "action": "smsala_wc_sms_action_send",
                    "tel": phone_num
                };
                jQuery.ajax({
                    url: '<?php echo admin_url('admin-ajax.php'); ?>',
                    type: 'post',
                    data: data,
                    success: function (response) {
                        if (response != 0)
                        {
                            $("#smsala_check").val(response);
                        }
                    }
                });
            }
            jQuery("#smsala_submit_otp").click(function (event) {

                var otp = jQuery("#smsala_sms_otp_code").val();

                if (otp != "")
                {

                    var data = {
                        "action": "smsala_wc_sms_action_verify",
                        "otp": otp,
                        "smsala_check": jQuery("#smsala_check").val()
                    };


                    jQuery.ajax({
                        type: "POST",
                        url: '<?php echo admin_url('admin-ajax.php'); ?>',
                        data: data,
                        dataType: "text",
                        success: function (response) {
                            if (response == 0)
                            {
                                $("#msg_show").show();
                                $("#msg_show").html('<div style="background: #EBA3A3; padding: 7px 20px;"><span style="color: #761919;">Please Enter Valid OPT.</span></div> <br>');
                            } else
                            {


                                $("#msg_show").show();
                                $("#msg_show").html('<div style="background: #C6E1C6; padding: 7px 20px;"><span style="color: #5b841b;"> Your number has been successfully verified.</span></div> <br>');
                                $("#smsala_sms_verified").val("YES");
                                $("#smsala_sms_otp").hide();



                            }
                        }
                    });
                }

                else
                {
                    $("#msg_show").show();
                    $("#msg_show").html('<div style="background: #EBA3A3; padding: 7px 20px;"><span style="color: #761919;">Please Enter Valid OPT.</span></div>');
                }
            });
            </script>


            <?php
        }

        add_action('woocommerce_checkout_process', 'woocommerce_checkout_process_sms');

        function woocommerce_checkout_process_sms() {

            if ($_POST['billing_phone'] == $_POST['smsala_phone_no']) {
                if ($_POST['smsala_sms_verified']) {
                    return;
                }
                if (empty($_POST['smsala_phone_no'])) {
                    wc_add_notice(__("Please enter a valid phone number. <a href='#billing_phone_field'>Click here.</a>"), 'error');
                    return FALSE;
                } else {
                    if (!is_numeric($_POST['smsala_phone_no'])) {
                        wc_add_notice(__("Please enter a valid phone number. <a href='#billing_phone_field'>Click here.</a>"), 'error');
                        return FALSE;
                    }
                    wc_add_notice(__("Please complete the SMS Verification. <a href='#smsala_sms'>Click here for verification section.</a>"), 'error');
                    return FALSE;
                }
            } else {
                wc_add_notice(__("Your phone number is invalid please enter valid number <a href='#billing_phone_field'>Click here for verification section.</a>"), 'error');
                return FALSE;
            }
        }

        add_action('wp_ajax_nopriv_smsala_wc_sms_action_verify', 'smsala_wc_sms_action_verify_send');
        add_action('wp_ajax_smsala_wc_sms_action_verify', 'smsala_wc_sms_action_verify_send');

        function smsala_wc_sms_action_verify_send() {
            if (trim($_POST['otp']) == base64_decode($_POST['smsala_check'])) {
                echo"1";
            } else {
                echo "0";
            }
            exit();
        }

        add_action('wp_ajax_nopriv_smsala_wc_sms_action_send', 'smsala_wc_sms_action_send_send');
        add_action('wp_ajax_smsala_wc_sms_action_send', 'smsala_wc_sms_action_send_send');

        function smsala_wc_sms_action_send_send() {

            if (is_numeric(trim($_POST['tel']))) {
                $six_digit_random_number = mt_rand(100000, 999999);
                $phone = trim($_POST['tel']);

                global $wpdb;
                $table_name = $wpdb->prefix . "options";
                $data = $wpdb->get_row("SELECT * from $table_name WHERE `option_name` ='smsala_checkout_otp'");
                if (isset($data->option_value) && !empty($data->option_value)) {
                    $msg = str_replace("{{OTP}}", $six_digit_random_number, $data->option_value);
                } else {
                    $msg = "$six_digit_random_number is your one time password to proceed on bulksmsplans. Do not share your OTP with anyone.";
                }


                sms_send($phone, $msg);
                echo base64_encode($six_digit_random_number);
            } else {
                wc_add_notice(__("Please enter a valid phone number. <a href='#billing_phone_field'>Click here.</a>"), 'error');
                echo 0;
            }
            exit();
        }

    }
}

//do_shortcode("[SMS_SEND_PLUGIN  phone_number='1234567890' msg='Hello!']");