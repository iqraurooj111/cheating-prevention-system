<?php
/**
 * Authentication Functions
 * Handles user authentication and session management
 */

session_start();

/**
 * Check if user is logged in
 */
function isLoggedIn() {
    return isset($_SESSION['user_id']) && isset($_SESSION['user_name']);
}

/**
 * Require login - redirect to login page if not logged in
 */
function requireLogin() {
    if (!isLoggedIn()) {
        require_once __DIR__ . '/config.php';
        header('Location: ' . BASE_URL . '/auth/login.php');
        exit();
    }
}

/**
 * Get current user ID
 */
function getUserId() {
    return isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
}

/**
 * Get current user name
 */
function getUserName() {
    return isset($_SESSION['user_name']) ? $_SESSION['user_name'] : null;
}

/**
 * Login user
 */
function loginUser($user_id, $user_name) {
    $_SESSION['user_id'] = $user_id;
    $_SESSION['user_name'] = $user_name;
}

/**
 * Logout user
 */
function logoutUser() {
    session_unset();
    session_destroy();
}

/**
 * Hash password
 */
function hashPassword($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}

/**
 * Verify password
 */
function verifyPassword($password, $hash) {
    return password_verify($password, $hash);
}
?>

