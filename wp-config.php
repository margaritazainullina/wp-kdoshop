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
define('AUTH_KEY',         '3-||GV{PmLZkj/?X|j~_X1pxIn_qjjZ2R:BXziz+M7;7gB V_pYLIb;A>t<7Up28');
define('SECURE_AUTH_KEY',  'OBH&B9xg<!x[)eiEK5]4D]#$GK`(V|qa.di>6bhZe-x-H#WdKY@3+ Y>)[R>(QwB');
define('LOGGED_IN_KEY',    'N+-!xu=+Yhq&!]*#<DTOLfz%O5YMbUOE0x9D0M@e1Z[4Q5hkKWI1Qw+{.s@+c)I8');
define('NONCE_KEY',        'fhZ6YC)^$ahU5q])[%$CuJuP=/&MhR9]4mtXw1Z6%m#9+?:7j:sLczCFh9=JWzd6');
define('AUTH_SALT',        '+xu<Ig|RL0sVjN<Qa%*8f3$/~%+,p6)+(3PtH`WuyCKni,]5_i5]Q `4SdiWiIb}');
define('SECURE_AUTH_SALT', '-XULl?e*wCRqu0}/>r7d{$,|qV !qt+-=`0!iWX^t<F!A,1`):@%HSO1yV@5(7}-');
define('LOGGED_IN_SALT',   'tTWnT4T|z8Tg:=:Q>ZeO%{O,+|ch<X.-Gn2roms/V]kKV_<+jQ+BS+b+!))Zl(8S');
define('NONCE_SALT',       '6#&8ryR8I!uW% $Q7R-dM[SaPdLwfzuYZOcNW#J`m}1r)^Z-.7ik+rzJx@yh^v1W');
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
