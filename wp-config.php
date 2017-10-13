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
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         '^*:#+N:Q`/UgODOoWvWmVGTah9$kfU^V&xI4G!Nu=}F>ePo},R!;^H!Y;, [ZRI_');
define('SECURE_AUTH_KEY',  '%$fJAO4x#*}Pv<y;-=zzA2b0H`Y<<1f!_)eW9?4m74{pI1(+_Z^yFA7VF0I,-CD5');
define('LOGGED_IN_KEY',    '4RkUL7GKYc%JS(ZQfD*v}GZ$6RZGEL6bRW EiQAU*1Sdh4#LjX*0IR|:[EAnk,L*');
define('NONCE_KEY',        '!PjRI<P#f(4bDnR+_L9(]JtQw1ak:V yYr gm C9@Vjq$$;F-WLF#?}s4%IQ2/a>');
define('AUTH_SALT',        'L|G(1b9lmtapJzDPx/0qq4sr7@,v]5F,9f@H#2gGD>!~>P1))l8j^A|Q>u5a&Wl<');
define('SECURE_AUTH_SALT', '}$jO!{KPF.2{hnks6! /|fS6bDE`_;Sg0spd:`PC]xkFPE0FY9lj1289ehvv=2,P');
define('LOGGED_IN_SALT',   'VF`,llB{ M0~DE+kp+G1XDP}~PwY9%Eorshi&LP)>;C6ZBZcqb#*T9A}%2PJx(bq');
define('NONCE_SALT',       '%c0!orK@74 =Z-IkTl@$elv3 }3Tx`g;?eTDkhND)#nYK=p]rC,}dC_%#W,[AzBX');

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
/* Multisite */
define( 'WP_ALLOW_MULTISITE', true );

define('MULTISITE', true);
define('SUBDOMAIN_INSTALL', false);
define('DOMAIN_CURRENT_SITE', 'localhost');
define('PATH_CURRENT_SITE', '/wordpress/');
define('SITE_ID_CURRENT_SITE', 1);
define('BLOG_ID_CURRENT_SITE', 1);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
