<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'i11069752_zetg1' );

/** Database username */
define( 'DB_USER', 'i11069752_zetg1' );

/** Database password */
define( 'DB_PASSWORD', 'J.sZDfROqgA9h24CgVb06' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'aRHbF90Ehg2r3idvsbKLAwVTvGyHVEcE3XokqgILUhZkRnoiXOMCvB8Zo79UvWpc');
define('SECURE_AUTH_KEY',  'YCquAkiN69G74kjid3ZIPN3ChwDMSsLnGT7BaF6ilCnZgZQfBxmsCvuS8douXL7I');
define('LOGGED_IN_KEY',    'js8UIPZ1hDN4S7fBV80Ve1miu1msnkYPoYZLaM8HU0n8JhljZDycOC32BuhrvgbG');
define('NONCE_KEY',        'ycVbr2AS7IC44arDwhzH9BXIMgvQgDN3quFendHggo8bhlAgxRCFfTxZRnDMdYah');
define('AUTH_SALT',        'bfP9HjAYtwycKJwA5hDSISU8kSG6wT1BvAwpDw8l9W3Hj6h7YxcfJDUCEXxnsPFf');
define('SECURE_AUTH_SALT', 'aDh4r5T3yYlaMenQmazUjTz6jZUBwvIfognpw2dGIGpNnyHcIjbqGtQFf2pnzV9U');
define('LOGGED_IN_SALT',   'pbMvhZczxqqMvtb35TEoREmyobwo8zQf1jMa9UUqJ27LM2vrzsuPpJ0Yu3yRAxZw');
define('NONCE_SALT',       'OSfv6hgUnS7HW9hHhVGUAdUs3L7ycFNIMU16TGk75IAFDKnkMXxwMkhM6WbevHFT');

/**
 * Other customizations.
 */
define('WP_TEMP_DIR',dirname(__FILE__).'/wp-content/uploads');


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'tnvp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
