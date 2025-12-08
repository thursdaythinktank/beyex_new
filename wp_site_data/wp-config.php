<?php
define( 'WP_CACHE', true );
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
define( 'DB_NAME', 'u867043172_beyex' );

/** Database username */
define( 'DB_USER', 'u867043172_beyex_user' );

/** Database password */
define( 'DB_PASSWORD', 'r=1WUiQ&6' );

/** Database hostname */
define( 'DB_HOST', '127.0.0.1' );

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
define( 'AUTH_KEY',          'S0tgl D#:e,XaGR)EN({lmu{str=ChCFL/( IAJ!j]A/5N}kNX&&{9jHxulxM_~m' );
define( 'SECURE_AUTH_KEY',   'Zs.d0i.[%4I6S$*j;IbduyqmU&~Y2AuM3jtDyS@E~9w`U0tFZ@3DWGNlCHy}Ja|J' );
define( 'LOGGED_IN_KEY',     'j2G|=Tizj|_u-`CO;=rDySWtQsI+H*$u7g$dhkR&U`47-/z_kIp(yX(Jz>eH s,c' );
define( 'NONCE_KEY',         '4 [?XFChYfsd$PNpe989@r[.B0!,=-j*^{if7N@wJIghD/:mz1T#aQk*)tKzh4U&' );
define( 'AUTH_SALT',         'q_,+QGD)tXpb%1M/Ki~-l,+ 6T?TU|O1&s) ,spU+uRn,F? Y!Lj9lbLh2Q#xXGm' );
define( 'SECURE_AUTH_SALT',  '.w8qg)*`fRuZm&]W^J6k{?a.a+s5i,p`KH0/>F eM{:pr%)AUiG8r^;$l2/v,PLH' );
define( 'LOGGED_IN_SALT',    '_f6DWrwWM-FRQ4NL:8H/S<nw-LesS`C~jD*/o9rI8_(LyI/q.N0wm)L[Bam{O80=' );
define( 'NONCE_SALT',        '5Zit{R3zJyq2p*k<Dbr=%|l$_@ta?b!E%G@e_TD_y^PbaDNE44)^o9A2iCru45&6' );
define( 'WP_CACHE_KEY_SALT', '7>CosTUvz3@,l24Ly%WyC&J.Q jAu5-xx-4/3&dpm^NY,/Af3ywzXHwK:J|ijhoy' );


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

define( 'FS_METHOD', 'direct' );
define( 'COOKIEHASH', '29997927760938fac7752745a666dbaa' );
define( 'WP_AUTO_UPDATE_CORE', 'minor' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
