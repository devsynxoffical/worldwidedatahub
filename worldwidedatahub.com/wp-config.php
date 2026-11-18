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
define( 'DB_NAME', 'i11069752_vlos1' );

/** Database username */
define( 'DB_USER', 'i11069752_vlos1' );

/** Database password */
define( 'DB_PASSWORD', 'O.XFJHHJTka0R5YxWLx40' );

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
define('AUTH_KEY',         '2tFu5RvQpQVsdBDsN9idRBw7Lh6fRd0jfTBlf5rAcGZ96qLnsTLW0NdXp2l499ss');
define('SECURE_AUTH_KEY',  'GJPbBKTEpaSEL9w3InMNNwXqB6jaSaflcJfHdrVQJacdGrML4i0n3eKFlEIr8ggb');
define('LOGGED_IN_KEY',    'CJC4rtg3fTN8Qg7IlvDcoEPB5ZPG1kZuwcf8QZHjnQYpDFSqE3nsYgA0NCDFZgCF');
define('NONCE_KEY',        'RguBlJ6h1IZonJTzJkbvMmOn4OpaNt3L5FwOovmUOk64G45A57pTk9nbRXph0Pl5');
define('AUTH_SALT',        'R0IWjDI0bqbjbGknAoKtmoWpJlAwpXaQDBFvx6HXFQA4RiSETVDwVnue5feMD8iW');
define('SECURE_AUTH_SALT', 'rW3PZgmZxJO3y24qxiw5LroN7SwXIgBJSccg3kREmOp6XyfVAOvRynhmmSPiUTEA');
define('LOGGED_IN_SALT',   'C1kofN8i9cDPTn7aexQGRz0jL2zUqpkWbQBkWBHcw8U8qWpBu7bgHw43bGCaHeNk');
define('NONCE_SALT',       'xstADemA6KjaWSuRQJKaL6Zi7Z28AlS1UWLbHPTrd3HcsKswvCcjPDGkd0FuiblL');

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
$table_prefix = 'yeg5_';

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
