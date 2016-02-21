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
define('DB_NAME', 'wp');

/** MySQL database username */
define('DB_USER', 'adminiJwiql1');

/** MySQL database password */
define('DB_PASSWORD', 'P(F-6Ix1G45QlgZl');

/** MySQL hostname */
define('DB_HOST', 'wp-kdoshop.rhcloud.com');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'dsj6jnrfc84ylgwobwcauxqo9gu6lgvtg4w1kwv8h0q1aluskrovtxesr68jn6tf');
define('SECURE_AUTH_KEY',  '67hg6fdymyt03cgrgd0y6pyi5uxmb2kdllsocnxzhlkpsok53hvctzksw7pfbvz2');
define('LOGGED_IN_KEY',    'xrzy4wa6arknn2tsgrr0cimhiueicpg9phwglvh7t70wn5fqxp28mevtjticxv3i');
define('NONCE_KEY',        'ja0ljoyxb51wm2yijjmeyqke3yw7asscwyy1mutekzru69vszey0vm1mgj1egvqs');
define('AUTH_SALT',        'kd2xwhobdy8sorcd3pnokyr3eixbps8bxcpeysegbt5fcf8qby4vo2u9lrv7xzub');
define('SECURE_AUTH_SALT', 'k6bihzvhrfif1qfmtadam2if8hg52yg04e4beajphd0rkquoqk13jkvij2yqhtda');
define('LOGGED_IN_SALT',   'oqvfslxgwd5wfssji7inddef4yc6wchnxwvenvo3h8wsh5r8gy0wrsncjyhh3bfe');
define('NONCE_SALT',       'et6ixaxzeqnvtoq19nzxyy0epsqxp2k4u3lhgzw2yr3vlxkvqovijwejtv8ddfwa');

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
