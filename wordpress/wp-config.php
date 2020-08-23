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
define( 'DB_NAME', 'aiock' );

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
define( 'AUTH_KEY',         ' $1g:Li94q{me>oD0r4!d#(oDtdR:kTxdI#{Fys~h]BGwNekC1<Y.oAtv%6JYd%F' );
define( 'SECURE_AUTH_KEY',  'V=:K4P6xR{Bi]DiybXC[r#{P|MeMZXp*8nQYJm[fxm(RU_ZN3)~phm~ bb-(n6#S' );
define( 'LOGGED_IN_KEY',    ']46rDwDv%a^`gR9Fc,FR^zR4NSoqO(2Y6H_@QZFBC%J?>2D,9a<KoA 46/c&G2an' );
define( 'NONCE_KEY',        'P[{Dc+.*2^1%!R8CzXHCxn&h;#ep^Hlx0l8=|tI,{%_Ejf<~[Qkf{-SxZk|VU~bP' );
define( 'AUTH_SALT',        '>@p7L_O1H&aN1a|uG#1?(l1km))Bsy^ee/cg!f2Vifq8|Pd.D*52$!q,GGp8>.Au' );
define( 'SECURE_AUTH_SALT', '!E7Zp*mR=wps]`.y2(`ZL[&U3L$lqb5$f}*[pAu1e;#QODyNS4(HQH@YJ3j/J_,L' );
define( 'LOGGED_IN_SALT',   '[a0_61DeQExVbzzvDT93t^fq6R[!RN,?/M?AX2P<CzD93nVK%BKQO*up0 /V+z -' );
define( 'NONCE_SALT',       'BF6axYyei(y1?|:hxN:6z|bl(+94-tw|K>_scGa 494-YgC-$u!gL=*-a)MD{[J>' );

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
