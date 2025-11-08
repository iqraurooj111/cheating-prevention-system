<?php
/**
 * Database Connection File
 * Handles MySQL database connection
 */

// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'exam_monitoring_system');

// Create connection
try {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    // Check connection
    if ($conn->connect_error) {
        // If database doesn't exist, show helpful message
        if ($conn->connect_errno == 1049) {
            die("Database not found. Please run <a href='" . (isset($_SERVER['REQUEST_URI']) ? dirname($_SERVER['REQUEST_URI']) : '') . "/setup_database.php'>setup_database.php</a> to create the database.");
        }
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Set charset to utf8mb4
    $conn->set_charset("utf8mb4");
    
} catch (Exception $e) {
    die("Database connection error: " . $e->getMessage());
}
?>

