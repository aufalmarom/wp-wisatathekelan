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
define('DB_NAME', 'thekelan');

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
define('AUTH_KEY',         '$6IogCm]>({p1pl1O+Y0~Gj_E=?&i| BNDgTMnb1yV4Gnde6W0-M??9(<>k;)Jef');
define('SECURE_AUTH_KEY',  'nDhz})zoF/TPiX3yN-5zjIX-.dlpuCqrdEcHRudkCXJgycB)[{HcD2Uo74Q/}I`t');
define('LOGGED_IN_KEY',    '8rUq,Dm*i9**bC$d#Ai#8#M48~oZDwPdWMn%&LZ.0NZ-F?`m_1t>2O`gsPM%9,:6');
define('NONCE_KEY',        '5!K_HOKvh&>[8Mdj[dUcQ6G^).VmU1r1511,#m2O@g|dYA{ .m*%!Wl?uWb0qv_^');
define('AUTH_SALT',        '>t9q<ZqZnIF>b,+v /zD]iH^%HF%.&;vO)HjrpR5Q*l8.75E]f#fAUm-me(LVRV0');
define('SECURE_AUTH_SALT', 'mC} .dg^:/Z6bo5}eIg4|[o@K#@MC+api^?OtfY7<C!`Al}~ej5`YMys?MW(h=se');
define('LOGGED_IN_SALT',   '4<5hAvkzZz1#>=h*|_~Ax PWt&}_~~A+o[F)&t@`m;B{mF@M[**6&SO!NIutF[3|');
define('NONCE_SALT',       'Wxa^vWzJ.kV@d.TmZ+5Vuk,)|$CjxWE@qY$Bv^cbNFVR;jIVI]m.U6@;q{yD6yHQ');

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
