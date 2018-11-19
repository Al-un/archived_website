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
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'wordpress');

/** MySQL database password */
define('DB_PASSWORD', 'toto');

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
define('AUTH_KEY',         '9zD7f0liZs[@->2B+m.OD__aOdbKgVXnHD.l<-,$C/{2p.Hn[4l0qt(:J!jI8AhW');
define('SECURE_AUTH_KEY',  '{-V:{LmpWBN-C7fSIqt6W0Wi_yCb>|ke!j}mo>-`t(M?erB|M$Z=W(bz-B(v8Tfv');
define('LOGGED_IN_KEY',    'qn5a:W}7d99qKJ-mh`%?;C_+Ev%FeIK5e^`Shh?pl7 n=WcH|l4BAjf*xV+3>c?G');
define('NONCE_KEY',        ';||O@1<}Cx-xz%T<ap>k]vl)J95h?b[uYX-7hI=ux-V~^!VCF/2OHVt:Ip1u%NI;');
define('AUTH_SALT',        '(5jtR&v>wHsZ|+y4 *o9XTN-^8Pf#=|4iV?t?6%tt-]](AtI[$F^oA9{`mb72<zS');
define('SECURE_AUTH_SALT', '7oX~|M{>#eroxF:b)_&L=.H#O.M9@]%Ih[8;lf5O W!=,Ss`g|@~n %4M Ma=Gq1');
define('LOGGED_IN_SALT',   '`N5yZuy=/Rjk-o;/B]i C(eho](=+/.3H?},Qq0rFo+Vru/4QXicy=*utRU7L|Dy');
define('NONCE_SALT',       'y^-^LLhr}rZpI)Rvw2B-b=^6yLO+->.%_G8I-YcEzR~ss`+1b[Uly(!#g!X^8fA0');

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
