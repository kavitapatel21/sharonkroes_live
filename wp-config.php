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
define( 'DB_NAME', 'sharonkroes-live' );

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
define( 'AUTH_KEY',         'Q|3y.x3<Q}eo#>6mfV^UtO5Fo5gorQVEnphJXmu&tY ~QsKqgh+$6a#jUn}*}cb,' );
define( 'SECURE_AUTH_KEY',  'h(? GoKdWG-ChE>/rwVFW:%^K5Vsm[UQ=^c6TNT)Rf4g+#75k6%k`8zru0g_<M==' );
define( 'LOGGED_IN_KEY',    'eSY~SmbQ&~/v&ayZr(^B?&cUZG==b=np:r/4W6z{svJFLPQEPrf-^fKaE(&c(0s~' );
define( 'NONCE_KEY',        'zE(]AKbToL4Lnuo.r^{!,CklKm,W#vqNtlY}VL6XCzcM@(Yg2 *kMJI)|Z~Gln5v' );
define( 'AUTH_SALT',        'j<;>a*3[}.hD{v]]i3h:E/NSdLTOVEZVg0e>[cI^>6`lPus}Vl0I#r`wgR;-&_t+' );
define( 'SECURE_AUTH_SALT', '*EJw$I(z(d].{{8gBh$Vw2nfx+p|iL9|$-i!Ak[~JYot6}jNIppEu)Qa<mWNC7PE' );
define( 'LOGGED_IN_SALT',   'Mf#QK^D+Nh#`h[OTq5F}[+ML}1Ow[:unlL1{Ev~*DZ=_rr@4=yC>;^4j^$esS#S>' );
define( 'NONCE_SALT',       '}NR0.J|89#al%v-WzAn[i#Yi!c%!g25XjLY &6/ zdM]^hb>H`InCy@15Im>n_M)' );

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
ini_set('display_errors','Off');
ini_set('error_reporting', E_ALL );
define('WP_DEBUG_DISPLAY', false);

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
