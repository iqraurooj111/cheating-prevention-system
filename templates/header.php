<?php
/**
 * Header Template
 * Common header for all pages
 */
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/auth.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title : 'Online Exam Monitoring System'; ?></title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/style.css">
</head>
<body>
    <header class="main-header">
        <div class="container">
            <div class="header-content">
                <h1 class="logo">
                    <a href="<?php echo BASE_URL; ?>/index.php">Exam Monitor</a>
                </h1>
                <nav class="main-nav">
                    <ul>
                        <li><a href="<?php echo BASE_URL; ?>/index.php">Home</a></li>
                        <li><a href="<?php echo BASE_URL; ?>/rules.php">Rules</a></li>
                        <li><a href="<?php echo BASE_URL; ?>/learning.php">Learning</a></li>
                        <li><a href="<?php echo BASE_URL; ?>/courses.php">Courses</a></li>
                        <?php if (isLoggedIn()): ?>
                            <li><a href="<?php echo BASE_URL; ?>/start-exam.php">Start Exam</a></li>
                            <li><a href="<?php echo BASE_URL; ?>/result.php">Results</a></li>
                            <li><span class="user-name"><?php echo htmlspecialchars(getUserName()); ?></span></li>
                            <li><a href="<?php echo BASE_URL; ?>/auth/logout.php">Logout</a></li>
                        <?php else: ?>
                            <li><a href="<?php echo BASE_URL; ?>/auth/login.php">Login</a></li>
                            <li><a href="<?php echo BASE_URL; ?>/auth/register.php">Register</a></li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
    <main class="main-content">

