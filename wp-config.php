<?php
require_once( __DIR__ . '/../vendor/autoload.php' );
( new \Dotenv\Dotenv( __DIR__ . '/../' ) )->load();

define( 'DB_NAME', getenv( 'DB_NAME' ) );
define( 'DB_USER', getenv( 'DB_USER' ) );
define( 'DB_PASSWORD', getenv( 'DB_PASSWORD' ) );
define( 'DB_HOST', getenv( 'DB_HOST' ) );
define( 'DB_CHARSET', 'utf8' );
define( 'DB_COLLATE', '' );

// Custom Content Directory
define( 'WP_CONTENT_DIR', dirname( __FILE__ ) . '/wp-content' );
#define( 'WP_SITEURL', '' );
#define( 'WP_HOME', '' );
define( 'COOKIE_DOMAINS', '' );

// Hide errors
ini_set( 'display_errors', 0 );
define( 'WP_DEBUG_DISPLAY', false );
#define( 'SAVEQUERIES', true );
#define( 'WP_DEBUG', true );

// Grab salts: https://api.wordpress.org/secret-key/1.1/salt
define( 'AUTH_KEY',         'put your unique phrase here' );
define( 'SECURE_AUTH_KEY',  'put your unique phrase here' );
define( 'LOGGED_IN_KEY',    'put your unique phrase here' );
define( 'NONCE_KEY',        'put your unique phrase here' );
define( 'AUTH_SALT',        'put your unique phrase here' );
define( 'SECURE_AUTH_SALT', 'put your unique phrase here' );
define( 'LOGGED_IN_SALT',   'put your unique phrase here' );
define( 'NONCE_SALT',       'put your unique phrase here' );

// for multiple installs in the same database
$table_prefix  = getenv( 'DB_PREFIX' );

define( 'WPLANG', '' );

// Load a Memcached config if we have one
if ( file_exists( dirname( __FILE__ ) . '/memcached.php' ) ) {
	$memcached_servers = include( dirname( __FILE__ ) . '/memcached.php' );
}

// Bootstrap WordPress
if ( !defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/wp/' );
}

require_once( ABSPATH . 'wp-settings.php' );
