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
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'naturligtgottDB' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         '5(%5nbZ1KWEd(ka]nkIa^A|GW@fqN_Zzf8zwcDmHK^Dp}KKKnOLRJ~Ph;-%W9$n]' );
define( 'SECURE_AUTH_KEY',  'dtv.bB4Q=F1 /zc#%BRZByY$$vkNd`hiZ~WO^bm`8272jh>ndDchL4>q~hJh/AAw' );
define( 'LOGGED_IN_KEY',    'p/X8K|zeh.znUb;cFDNLU*8I4fi^FwO3|]GOY6mJl30YV_M v53SmO$GK08xExMP' );
define( 'NONCE_KEY',        'q_:|$l3&l+-5TU.h8j/m<_+4b,CGJ[xcA2OS|)lHzuA c>o3=b_e>oRG$uz^PWp<' );
define( 'AUTH_SALT',        '{ye=P1`;-T`M?-_+$7 @<N:9i{uBw6(/OT17thlpX+])A#dP0^84k`EE2/8WU5PX' );
define( 'SECURE_AUTH_SALT', 'l_|Bc=Wh:JL[Sb:W=6=?%]:~gW(K=d@?)d6DOW5zivgx>VR1kHr|[zLW!H9IzjKU' );
define( 'LOGGED_IN_SALT',   'PT%?<2$-+2cJZc,$W.HXyrn}Gm_B6sRa7Y,_&ZMyp[)N+UI_qwm-?GK_cuz|>LM@' );
define( 'NONCE_SALT',       'PE(+,@f2;1Q/?FJYaMF<b[1:GFZ3q$+E+Qhf|H?P<M-E#Y!#97!es[Dv?4rv+W*/' );

/**#@-*/

/**
 * WordPress database table prefix.
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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
