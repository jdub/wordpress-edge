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

define('DB_NAME', $_SERVER['DB_NAME']);
define('DB_USER', $_SERVER['DB_USER']);
define('DB_PASSWORD', $_SERVER['DB_PASSWORD']);
define('DB_HOST', $_SERVER['DB_HOST']);

define('MYSQL_SSL_CA', $_SERVER['LAMBDA_TASK_ROOT'] . '/lib/rds-combined-ca-bundle.pem');
define('MYSQL_CLIENT_FLAGS', MYSQLI_CLIENT_SSL);

define('WP_HOME', 'https://' . $_SERVER['DOMAIN']);
define('WP_SITEURL', 'https://' . $_SERVER['DOMAIN']);

define('FORCE_SSL_ADMIN', true);
define('FORCE_SSL_LOGIN', true);

define('S3_UPLOADS_USE_INSTANCE_PROFILE', false);
define('S3_UPLOADS_BUCKET', $_SERVER['BUCKET']);
define('S3_UPLOADS_REGION', $_SERVER['AWS_REGION']);
define('S3_UPLOADS_BUCKET_URL', $_SERVER['BUCKET_URL']);
define('UPLOADS', 'wp-content/wp-content/uploads');
define('S3_UPLOADS_HTTP_CACHE_CONTROL', 'public, max-age=31536000');

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
define('AUTH_KEY',         '@zVf~>n(y0V+Fyg`;_>L]+P:o|6|F&[Lo9-Ah85R%gfuk=2A?+h2/cP&7&}-qv9i');
define('SECURE_AUTH_KEY',  'K&paK)D++YO6S;|MkTI.6B2Wv5-#6V~B+@.k|y|-Tx4$wuy5{JZ9bKY}-xFUF15(');
define('LOGGED_IN_KEY',    'AlMEdWLGo2s9)KGO kRPm$z[`Gn4yMK1:z @*BZ&ruJ~a~,wdRz9^033[S7<h$@R');
define('NONCE_KEY',        'bqd{oq,&1q0)o W|PTw.Z;LUH+A#ncg`6A&Cqp+JlbRmjJN?Qo{7ndUqxI`tX43F');
define('AUTH_SALT',        '=WlX@lmSGP>@pZO4ZI-K|Q:fl8G~23/F/^[P-b+~t5%)*cb!IVmE2V[Mt+m`nq}~');
define('SECURE_AUTH_SALT', 'MmW~Ty.`T]uO[<Ha?I&iWnnX*CZ1pyJOx(U|X,0!RE66~}my5.h#?C+?DZVd1Gu7');
define('LOGGED_IN_SALT',   '@4oug*~(~2v$nj#d_JF1mm+]!S-Qg)[Sz@Cv[FPx?EQ[+ETfi/B{M6qit~[K%15^');
define('NONCE_SALT',       'F(e`KpXKa O5a!$.Lp~Jjnb15;%II2 ji1[G/6A}&3P>1BWy HV_>@cY2f@+GW#@');

/**#@-*/

/** Disable things we don't want in ANY environment **/
define('DISALLOW_FILE_EDIT', true);
define('DISALLOW_FILE_MODS', true);

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
