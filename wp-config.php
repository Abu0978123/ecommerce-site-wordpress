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
define( 'DB_NAME', 'ecommerce' );

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
define( 'AUTH_KEY',         '-Mu*SqdB0s1` ?IQ}nhU&x-`w9f=.s?UxkBA%K?~dx%yi*#b`Kjs_k_4#izP1LEa' );
define( 'SECURE_AUTH_KEY',  'Vyogr>G+VuPF$nPy-+o{Gn`cZ;KrUiB/Nez7r7pjy:A6WsC9:5<MFxTzTTp{{#DF' );
define( 'LOGGED_IN_KEY',    '$V*Ub:L-Bj1eKa7)*R^kuu#Ng&$zJry&^.[d()EaXPOp?E6~nMz{E/h8Z?d,XZ/A' );
define( 'NONCE_KEY',        'Id]c?lMF)pC8|[.)BMzko}0>!h/Yggik<]!8ykL%)0FC:%!s98C;xkC.KJqv9cv<' );
define( 'AUTH_SALT',        '!9L;ram(o]?KZ(c,Z@Z<q4_5>j+)ut%x][1BXOT1;>F=498~^Zk2P;MMVxjZw~^x' );
define( 'SECURE_AUTH_SALT', 'JJ*dJD|aXt5&Si?;{#nSU`gV[l>k].svhEH[T?g7;0sq :f==N:DuL eDT_hwbol' );
define( 'LOGGED_IN_SALT',   '6MlDx,+DBep] $GsM~[adLLAZ ^m;Ro0jkP*O.oE&S>[#CLQJd9ecljm#muf[+4;' );
define( 'NONCE_SALT',       'iR9M]0P2@bUs<vN$Cuqy`UCFkJ(BPM-i(lu8,)e+d*iT?w!mV jxje1R3,4Dx3#>' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_commerce';

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
