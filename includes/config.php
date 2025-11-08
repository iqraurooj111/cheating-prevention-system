<?php
/**
 * Configuration File
 * Handles base path and URL configuration
 */

// Get the base path dynamically
// Find the project root by looking for index.php
$script_name = $_SERVER['SCRIPT_NAME'];
$script_dir = str_replace('\\', '/', dirname($script_name));

// Remove /auth, /includes, /templates, etc. to get project root
$base_path = $script_dir;
if (strpos($base_path, '/auth') !== false) {
    $base_path = str_replace('/auth', '', $base_path);
}
if (strpos($base_path, '/includes') !== false) {
    $base_path = str_replace('/includes', '', $base_path);
}
if (strpos($base_path, '/templates') !== false) {
    $base_path = str_replace('/templates', '', $base_path);
}

// Remove trailing slash if not root
if ($base_path !== '/') {
    $base_path = rtrim($base_path, '/');
}

// Define base URL
if (!defined('BASE_URL')) {
    define('BASE_URL', $base_path);
}
if (!defined('BASE_PATH')) {
    define('BASE_PATH', $base_path);
}

