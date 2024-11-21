<?php

// TEST JIRA AGAIN
// Checking PHP Version
if (version_compare(PHP_VERSION, '5.4', '<')) {
    throw new Exception('PHP version >= 5.4 required');
}

// Check PHP Curl & json decode capabilities.
if (!function_exists('curl_init') || !function_exists('curl_exec')) {
    throw new Exception('Paycon Library needs the CURL PHP extension.');
}
if (!function_exists('json_decode')) {
    throw new Exception('Paycon Library needs the JSON PHP extension.');
}

// Configurations
require_once 'lib/Config.php';

// Paydia API Resources
require_once 'lib/Service.php';
require_once 'lib/Auth.php';
require_once 'lib/Mpm.php';
require_once 'lib/Balance.php';
require_once 'lib/CustomerTopup.php';
require_once 'lib/TransferToBank.php';

// Utils
require_once 'lib/Util.php';
