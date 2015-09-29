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
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         'NN&Y3+Nlj7>`A,lJE*1=FIe[Bp4G]P4{Kt]&kn>94xLu6S4]-Mm=([Kf@H9<|cLp');
define('SECURE_AUTH_KEY',  'm[+mY/Vu&_8*G<Jic]w.v3F5Pemf4`O#t+zxJ-T3P]sB|/9}Ns,{fVs|Rc#x@bx3');
define('LOGGED_IN_KEY',    'T}Zca}F;]2C}}<@:OSJ-D0}uwyu%bh$EBT0v>|;@oPGOzd{Jn-WfwXSB/;[K(Vkh');
define('NONCE_KEY',        'm$ax*bAt8>#4N!ZjKf6B-K/|LgK1z2R<?yEfw)bWJ]d0bpl{t;Lm#rj9PU1._sF!');
define('AUTH_SALT',        '?4F-0LdV76Oq-]$R d>+Plg9 ;V %^U{I%~PFaz,(O<S%>je:z}OgXivpvR-n+ij');
define('SECURE_AUTH_SALT', '2_Ei:}gwJqEA&#l[06`F+M%&AS)s}fW6eEMYS-|d|;z`r%L=^eMrmV+=qC$b<)df');
define('LOGGED_IN_SALT',   'R2iI.|~Z#k0=EdBC,1j) w.)HlZ5,m@go<Up/yY>|&)L}|YYfAISFWYZ5ii3Iec/');
define('NONCE_SALT',       'K4o]DtTC7[.<jt.C1(L-=-dDTP+u>V)y]0kdiU5Xi8P-j&12`BS)B2JAla|wojZ ');
define('WP_MEMORY_LIMIT', '128M');
define( 'WP_DEBUG', true );
define('WPLANG', 'fr_FR');
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
