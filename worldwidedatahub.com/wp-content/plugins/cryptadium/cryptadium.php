<?php
/*
    Plugin Name: Cryptadium
    Plugin URI: http://cryptadium.com/
    Description: Cryptadium plugin for WooComerce
    Version: 1.0
	  Author: Cryptadium
    Author URI: http://cryptadium.com/
    License: http://cryptadium.com/
    License URI: http://cryptadium.com/
*/

namespace Ccore;

  if ( !defined('ABSPATH') ) {
    exit;
  }

  /* Defining constants */

  DEFINE(__NAMESPACE__.'\CmAdress',realpath(plugin_dir_path( __FILE__ )));
  DEFINE(__NAMESPACE__.'\CmUrl',plugin_dir_url(__FILE__));
  DEFINE(__NAMESPACE__.'\errors',array());

  /* Add loader */

  spl_autoload_register( 'Ccore\cryptadium_autoloader' );

  function cryptadium_autoloader( $class_name ) {
    if (strpos($class_name, 'Ccore') !== false) {
      $classes_dir = CmAdress.DIRECTORY_SEPARATOR;
      $class_file = str_replace('Ccore_','', $class_name).'.php';
      require_once $classes_dir . str_replace('\\','/', $class_file);
    }
  }

  /* Add debug */

  $Cdebug = new Ccore_debug(true);

  /* Add gateway */

  add_action( 'plugins_loaded', __NAMESPACE__.'\init_cryptadium_gateway' );

  function init_cryptadium_gateway() {
    require_once CmAdress.DIRECTORY_SEPARATOR.'Ccore'.DIRECTORY_SEPARATOR.'cryptadium_gateway.php';
  }

  add_filter( 'woocommerce_payment_gateways', __NAMESPACE__.'\add_cryptadium_gateway_class' );
  function add_cryptadium_gateway_class( $gateways ) {
    $gateways[] = __NAMESPACE__.'\cryptadium_gateway';
    return $gateways;
  }




  /* Write debug to file */
  $Cdebug->writeLogToFile();
?>