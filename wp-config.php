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
define('DB_NAME', 'kalimanah');

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
define('AUTH_KEY',         'jB`TW>0?FFJ!;dUDbR[=<|H5PYT^l5V}6-&$ 1Sw)PuF0B@%y!_=>{)!U1x#-mto');
define('SECURE_AUTH_KEY',  'VhbjQT>FEFb]TgC.qhr|jdi8+0mqH-S4h]9fhz(,G>oL_dH?e:9R[UpZYNhv}I3]');
define('LOGGED_IN_KEY',    '(~YNr~@rk]R;vWA]Gu v43)r[ky ,kG7}SO07XtGa$xEr#VK.1?GLu;T}1MpvPv^');
define('NONCE_KEY',        '?APY0,E9zSBa=_cka0Wl>c{WlU2NmzX9cN*GU Z>[/th83|kvNZTq UFvNLfnsy:');
define('AUTH_SALT',        'D}|hGVAYLEBmFF*PYOG% Ym?)N$(~re-s4RryOLKOc%|4,W7R=bXF?hFLi@{3kHZ');
define('SECURE_AUTH_SALT', '<Ur,AKro@CZ[3!eIOWQ<FN-|nXH#u(7*40&[H~R-y,oEpF_(QYwdmEz_uQJxJxB(');
define('LOGGED_IN_SALT',   ';stQsdfuIYfHQ=?I2ZjmS1.J/~zpB<+@02FZ}_m7bN:+[RL2*m[V}@T<O;,V^)6T');
define('NONCE_SALT',       'd6`Y>zXEX4`Bw7B6B~3]a=4Re7w_OTLDE]rb),GdF>x(cBGSwH+c@z8St TU?Ob<');

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
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
