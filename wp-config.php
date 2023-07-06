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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'pluginwp' );

/** Database username */
define( 'DB_USER', 'adminPluginWP' );

/** Database password */
define( 'DB_PASSWORD', '12345' );

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
define( 'AUTH_KEY',         '6H@egxPY7Z (VZ{PG@^_fxFCjXP>IFI +x}TCD+Gn#-4OX!k&[@tTT]tp4.-:U;<' );
define( 'SECURE_AUTH_KEY',  'VS[R~7K>LZ|z,hobFzET g&(I38:|#tV;YrfcxJgUFDa5EEgFpWHBijPBR_XYQmP' );
define( 'LOGGED_IN_KEY',    '2VR+YdW !KzaC<MN+{KFWe+*-9A%<PzJb%%ajnB1g!GA+C^@>O5poY}RM0t0d=/^' );
define( 'NONCE_KEY',        'Kl3Jvu=uYTeLh3V-R4!ojwgC [-PnVy?Pbp_?)scVGm_=O5E|/5mc|RQ0).OP}-^' );
define( 'AUTH_SALT',        '1X^u(KC@Ayc={k$ ZGk+=!97vY9EP&ui>mbQpH!vOOX;gQ{B+F8.#Q9NLa11d{Bz' );
define( 'SECURE_AUTH_SALT', 'yq;vYu[$UGamg(`R;<R)vxqFK&uI3MJ|]i>qF3r:{usHJ.+Lz!Rs(M6#T:^bY(6&' );
define( 'LOGGED_IN_SALT',   '5WDV%Lh;<;4hTFD8HHnY[WwX(A7u;1f7b)zIi*D`&I4a/,LT,+wX<JkF[6;rT8w=' );
define( 'NONCE_SALT',       'H:iZ!SG!C8lPGQiEXLJS*@?DMb,rnrbbBSewF{u(C wmG3&l2_@rGo3 Ci$FVM{a' );

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', true );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
