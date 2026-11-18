<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'i11069752_kgiw1' );

/** Database username */
define( 'DB_USER', 'i11069752_kgiw1' );

/** Database password */
define( 'DB_PASSWORD', 'I.ki6EyYZhiZpKjLD0947' );

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
define( 'AUTH_KEY',          'Zf/0~j7W>JU<5<lvsohPrNwWLcVsP7zOv.3,L]s7{*U3`H~%9))A%9X;&Eqt.+r*' );
define( 'SECURE_AUTH_KEY',   'tfEH5=zLD<3OtV97c]Te63g<-a}[[&Gk$CC;7@oxus9pY69|)usW* QuMIxv@d0)' );
define( 'LOGGED_IN_KEY',     '9yYppi%>Ny!kF5o?ma@%BjVLEz-_@4wt&6 iqu%n/m0qE(|{S!Ij1$UTg%N}n,IK' );
define( 'NONCE_KEY',         'Ot#tIC,*|!/wwSXf(Y%F-fLUg,(Gr~w x!2)#Q4t7!$m$Oe,Z%uTL8[Cp#BvC~Ym' );
define( 'AUTH_SALT',         '+NS=o)^ 7|EgAn$i[aB6-BJ&--R=Dcab&23[AEXk4yTv)yqi^j|yFvvw5GN*E1Hg' );
define( 'SECURE_AUTH_SALT',  'Ke0yM,&+,hxXz>9gS(2TEQ~;BL^bl+/^I}c*(FvF=EG%858`$mRpT0]!mKCL~5o<' );
define( 'LOGGED_IN_SALT',    'Y)6C3|b8`]Y_~pBQPz_e6Aful3yjDplLBs>|n|<rDD<qr2$J6]Z+Ve5%ovqgzTo{' );
define( 'NONCE_SALT',        'e6IHYuHm0%wUXS.x,d6rjv#8A&-v?D)=k<`|m +._n`@z{-@yuuF|porj65@z8:J' );
define( 'WP_CACHE_KEY_SALT', '<fTUA>N9*_5QENRY*CKO;8ZS:V#T&I%Y7=oa:(fCn x=[JQG-j?#op;}NWijE{3J' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'njn_';


/* Add any custom values between this line and the "stop editing" line. */



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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'FS_METHOD', 'direct' );
define( 'COOKIEHASH', '4e5174f3e29a7795e471dd1342ad92a5' );
define( 'WP_AUTO_UPDATE_CORE', false );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';