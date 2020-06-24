<?php

// Error reporting for production
error_reporting(1);
ini_set('display_errors', '1');

// Timezone
date_default_timezone_set('Europe/Berlin');

// Settings
$settings = [];

// Path settings
$settings['root'] = dirname(__DIR__);
$settings['temp'] = $settings['root'] . '/tmp';
$settings['public'] = $settings['root'] . '/public';

// Error Handling Middleware settings
$settings['error'] = [

    // Should be set to false in production
    'display_error_details' => true,

    // Parameter is passed to the default ErrorHandler
    // View in rendered output by enabling the "displayErrorDetails" setting.
    // For the console and unit tests we also disable it
    'log_errors' => true,

    // Display error details in error log
    'log_error_details' => true,
];

$settings['twig'] = [
    // Template paths
    'paths' => [
        __DIR__ . '/../templates',
    ],
    // Twig environment options
    'options' => [
        // Should be set to true in production
        'cache_enabled' => false,
        'cache_path' => __DIR__ . '/../tmp/twig',
    ],
];

$settings['session'] = [
    'name' => 'webapp',
    'cache_expire' => 0,
];

// $settings['db'] = [
//     'driver' => 'mysql',
//     'host' => 'localhost',
//     'username' => 'root',
//     'database' => 'feedz',
//     'password' => 'root',
//     'charset' => 'utf8mb4',
//     'collation' => 'utf8mb4_unicode_ci',
//     'flags' => [
//         // Turn off persistent connections
//         PDO::ATTR_PERSISTENT => false,
//         // Enable exceptions
//         PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
//         // Emulate prepared statements
//         PDO::ATTR_EMULATE_PREPARES => true,
//         // Set default fetch mode to array
//         PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
//     ],
// ];

$settings['db'] = [
    'driver' => \Cake\Database\Driver\Mysql::class,
    'host' => 'localhost',
    'encoding' => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    // Enable identifier quoting
    'quoteIdentifiers' => true,
    // Set to null to use MySQL servers timezone
    'timezone' => null,
    // Disable meta data cache
    'cacheMetadata' => false,
    // Disable query logging
    'log' => false,
    // PDO options
    'flags' => [
        // Turn off persistent connections
        PDO::ATTR_PERSISTENT => false,
        // Enable exceptions
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        // Emulate prepared statements
        PDO::ATTR_EMULATE_PREPARES => true,
        // Set default fetch mode to array
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ],
];

return $settings;
