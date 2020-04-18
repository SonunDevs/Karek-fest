<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'karekfest' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '<^Hck 8W-@8/Wd-2c:1SEU0j&QD4ak5xxq^8dxa|5G1.g)S>sAH.GEs|DeP9>4Oa' );
define( 'SECURE_AUTH_KEY',  'Q>613M*zd[<|bA4+n)2!V-y~o)3gib#fD/BgWPVj;VC L<2jhiITyN|l$`!hs)zG' );
define( 'LOGGED_IN_KEY',    'Pnh5Xq&{4`F9ZYwh JFM9LB+duE<^Chyw&wClna>x|r{W56^QLIO~zL~-o^D.DWl' );
define( 'NONCE_KEY',        ':)%?o#R<daL|bBw/U2hG5q2Ab=gi|wU0?S?C5O2~7*H?;Al-ZQQO<{,(Z;5+l0F;' );
define( 'AUTH_SALT',        'KE`gFN4r G~iewGz$ncRs/h5x:`nxa8P.@Q+`_PWlp?lU+-Nh}[G0sFXT/,NEKa(' );
define( 'SECURE_AUTH_SALT', 'f#3:/{d|8;!bf.YBJy83)Zi@=>-0nec`R*K?e#M6B _<p;%s6u.7{3HyTM_mzI8T' );
define( 'LOGGED_IN_SALT',   'T_D%$/,i}t*8N9kYZM40CAm`PKi@ l[}6C6,Ox-h7#8S%a^XFnJi$rrKP(ETfCUy' );
define( 'NONCE_SALT',       'KU4BW y`upB@U +z!V2>*moxn|fh,5`k~%PVo]9/&?z5!8wvXIiycMKL^:>kVeDM' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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
define( 'WP_DEBUG', false );


define('FS_METHOD', 'direct');


/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
