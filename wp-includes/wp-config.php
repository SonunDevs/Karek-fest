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
define( 'AUTH_KEY',         'DZ]HTqWb~Gc(ZOTP,h~r_M{waakOtFD&T]%n8/^`Z/w<>,3si-@rIE:/7<`4fIqY' );
define( 'SECURE_AUTH_KEY',  '<t!d2qQ2FQE|a-L]S/1>~$/=yOqqOy3me@czd*>@]V4I?Fyk12YF$WB6]_(*joBs' );
define( 'LOGGED_IN_KEY',    'BzZzKDHnP_DILBC9rIwy|ledgP;*hEStQD&]v@o`J</3K+,M9nOy@I*0f^m4 h9`' );
define( 'NONCE_KEY',        'G m>HN+C9;+{$GqCGb-c@l$?{FimS-:cBFC[cfepMdPqIk-A[Dmd(mBmd|m9|M[U' );
define( 'AUTH_SALT',        '`wy`NUF}Sn^PYOiB11Z/gxl&6+%rT;_r3mD|n@]G,)JLCnxZAQv}9C}_3V(5v)2i' );
define( 'SECURE_AUTH_SALT', 'O=!)D@n0Ys)vJ;^b5)Ei{@m#aeaa1SC]Wv+@ekAMKu]6Pon)Na/6*qg#LC:|w^fP' );
define( 'LOGGED_IN_SALT',   'c@6v82,?q9uc*})6[#$y.)H3&7QZ#>mcVtr|C/OLg/~vu?mE tl;H3e%jfeCzQ8D' );
define( 'NONCE_SALT',       ')RDbgGleiETQhTf3i>Y}JLN.Ka#?]Dm0ESR`8V!yLjLKW5MDR2;]^l+hJe?p,5HB' );

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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

