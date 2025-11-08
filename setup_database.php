<?php
/**
 * Database Setup Script
 * Creates database and tables
 */

// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');

// Connect without selecting database
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Read SQL file
$sql_file = __DIR__ . '/db/database.sql';
if (!file_exists($sql_file)) {
    die("SQL file not found: $sql_file");
}

$sql = file_get_contents($sql_file);

// Execute SQL queries
if ($conn->multi_query($sql)) {
    do {
        // Store first result set
        if ($result = $conn->store_result()) {
            $result->free();
        }
    } while ($conn->next_result());
    
    echo "<h2>Database setup successful!</h2>";
    echo "<p>The database 'exam_monitoring_system' has been created with all tables and sample data.</p>";
    echo "<p><a href='index.php'>Go to Homepage</a></p>";
} else {
    echo "<h2>Error setting up database:</h2>";
    echo "<p>" . $conn->error . "</p>";
}

$conn->close();
?>

