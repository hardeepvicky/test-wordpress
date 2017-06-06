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
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'test_wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'password');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'Z|-)7j}`!0V#a[:1JJR+LWY<2K,U5|HT3,VlqU(BC? ST6_}s6)NJU+P|6mVB_CK');
define('SECURE_AUTH_KEY',  'E*W4QwHDBI1>%T)R>AZSO]sN#6N8o$ur.;;AcP/NL-9=)]|2bUMZdG<)Z8;Vsb0N');
define('LOGGED_IN_KEY',    'Yfv4P;^:g1Xb~eP8;jkMIj[us}d/pU<Ea;o`cXasEXpzASaH*8}8L}mfWRe?=&ur');
define('NONCE_KEY',        '4}<nZRHb/BRnc6UhTtjO,!xl~MTb}>!6p]wsJq+(C`z&6B:8`5#bI$ag_R/RpT?1');
define('AUTH_SALT',        '? U @W.SRP1Y%7=5v#<tL(nxNfFoBb*O6$zFwy[P!iiwqrKetn/QsV/Is~WsVIWN');
define('SECURE_AUTH_SALT', 'Eth41XRGMF8(i-;w#T6/v>|(o=-Rm?FL$04-5f-nBn)zaY$= /OutY;SZm}[!0EB');
define('LOGGED_IN_SALT',   'XF1[YR IS{_gFbaGg 41FYOq_s3-{R$kcQctYF3L0Xg9=[^V<`n![XR<P}#(DAtd');
define('NONCE_SALT',       'Fz.@qUI-GX{iJ],mc7h(5ofQ^II84$Lw*];yV7o<uDlx7pC^vXi*d*Rwhyf{~R$d');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
