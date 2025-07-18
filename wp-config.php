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
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',          'u1C}F.+*uT:n%OL^+CFEBGPX$^[{1$>*r+A+)hpa#{S%U=P-G2!>j,(hRV/d0|Lt' );
define( 'SECURE_AUTH_KEY',   '|&:3;SC4`8FOESy]1R(&[*>R]5>1/^VL:) 5sfP9yN*eMJ-&]26)O j%DX&|2l_T' );
define( 'LOGGED_IN_KEY',     '(WWASEtu$~QccT2gtoC%~eX;,h|_:gKp6$9X7H:V U;I3,d _;8?HJC5@<lyn7N#' );
define( 'NONCE_KEY',         'A&ofm`w^amwHcQR`bk?A/ x>]h:9pp0@gbBc[0/mC,aGiemc(;kv>p+&9y`kY{qi' );
define( 'AUTH_SALT',         ';Hmu7zd,uQUqLWZ,^/WVp>,f!*r~6yoI+Lf:bO;;WA/3KS?kQJ$=N@cLcu+WJs%>' );
define( 'SECURE_AUTH_SALT',  'U6;=cS(sbWS~ulX K8GS~ 8P>7}vd^fd,G!r+pMT&d;qh[$6UeiI^)tP9|RQ{ )M' );
define( 'LOGGED_IN_SALT',    '.N=qz|)1>?4`+Fr1,wYIP;[2(]GoZ^V8E&(z,dabCqv,])FW.x!e1,.%D:1#9^ 7' );
define( 'NONCE_SALT',        '1+D#6SMba) 8P_hj$?B}N`|QI ?j0<gESfX1,(>E1*+2.~$WV?T~aELZy*{3zsn8' );
define( 'WP_CACHE_KEY_SALT', '&&t6.O}+T2CGC(QB,.x?%ac:?[`f==X*=u@K;)SF<23+cr/ro<5A3|HBgC5v_(~8' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


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

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
