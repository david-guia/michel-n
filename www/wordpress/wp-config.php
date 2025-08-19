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
define( 'DB_NAME', 'chouetqchenove21' );

/** Database username */
define( 'DB_USER', 'chouetqchenove21' );

/** Database password */
define( 'DB_PASSWORD', 'uX8QJ5N64yybz5' );

/** Database hostname */
define( 'DB_HOST', 'chouetqchenove21.mysql.db' );

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
define( 'AUTH_KEY',         'l1>}P<`7gwG<4zn  7`@p){=x542vW_+hK,4h_ag6,~6Z9L .*5Fe@k&?mpy<wex' );
define( 'SECURE_AUTH_KEY',  'Mia6ir~c|ZHKrGBAK[z_l_[0~h@WJ**WQ6u}qNHQn#$DMNpRLi+z3W0~uQc8fsiD' );
define( 'LOGGED_IN_KEY',    'r4H9n^[^kQbAy@5d$e7{i<J]fli>{.m(v7]c=#ev[sGBOT|7Rl~U56|$yt)UCe@s' );
define( 'NONCE_KEY',        'fb:90:h1V$ip+n[I l,,S-p`.R9f3Vd5^b ^p_0O&/|wt;}izD)8Dmy%@eD-8>ZN' );
define( 'AUTH_SALT',        '9(WrnLU[!<@~i$l{!_{dd#r2eM&A=X?hb(g%f@uzQ?FPhbF3zOPVCQ6=q?V|r+2A' );
define( 'SECURE_AUTH_SALT', '7$sd8AJY|Xn$eal$_AmF:ms}3`x?yr-^}vQ1qa&AI*sn.l+d{U6+4az[2(@2V)U,' );
define( 'LOGGED_IN_SALT',   'SiXZ*Q*DmMU)K9-hW:AGu0@<,8;oP4y,~%An^([OVMzu6g8:G@CzXe$W*34LsG)a' );
define( 'NONCE_SALT',       '9B(,%&t^=H;`Kct8q|a!yaWweTG,kJ0ujQLs;s59E~Qs51Zlyn,XO4UO(H9)yJ~l' );

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
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
