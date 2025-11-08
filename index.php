<?php
/**
 * Home Page
 * Landing page with introduction and navigation
 */

require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/auth.php';

$page_title = 'Home - Online Exam Monitoring System';
include __DIR__ . '/templates/header.php';
?>

<div class="container">
    <section class="hero-section">
        <h1>Welcome to Online Exam Monitoring System</h1>
        <p class="lead">A secure and comprehensive platform for conducting online examinations with advanced cheating detection.</p>
        
        <?php if (!isLoggedIn()): ?>
            <div class="hero-actions">
                <a href="<?php echo BASE_URL; ?>/auth/login.php" class="btn btn-primary btn-large">Login</a>
                <a href="<?php echo BASE_URL; ?>/auth/register.php" class="btn btn-secondary btn-large">Register</a>
            </div>
        <?php else: ?>
            <div class="hero-actions">
                <a href="<?php echo BASE_URL; ?>/start-exam.php" class="btn btn-primary btn-large">Start Exam</a>
                <a href="<?php echo BASE_URL; ?>/rules.php" class="btn btn-secondary btn-large">View Rules</a>
            </div>
        <?php endif; ?>
    </section>
    
    <section class="features-section">
        <h2>Key Features</h2>
        <div class="features-grid">
            <div class="feature-card">
                <h3>🔒 Secure Authentication</h3>
                <p>User registration and login system with secure password hashing.</p>
            </div>
            <div class="feature-card">
                <h3>🛡️ Cheating Detection</h3>
                <p>Advanced monitoring detects tab switches, window blur, and fullscreen exits.</p>
            </div>
            <div class="feature-card">
                <h3>⏱️ Timer Management</h3>
                <p>Real-time countdown timer to track exam duration.</p>
            </div>
            <div class="feature-card">
                <h3>📊 Result Tracking</h3>
                <p>Comprehensive result storage with score calculation and status tracking.</p>
            </div>
            <div class="feature-card">
                <h3>📚 Course Content</h3>
                <p>Access to web development courses and learning materials.</p>
            </div>
            <div class="feature-card">
                <h3>📱 Responsive Design</h3>
                <p>Works seamlessly on desktop, tablet, and mobile devices.</p>
            </div>
        </div>
    </section>
    
    <section class="info-section">
        <h2>How It Works</h2>
        <ol class="steps-list">
            <li>Register or login to your account</li>
            <li>Read and understand the exam rules</li>
            <li>Start the exam and enter fullscreen mode</li>
            <li>Answer 10 questions with multiple choice options</li>
            <li>Submit your exam and view your results</li>
        </ol>
    </section>
</div>

<?php include __DIR__ . '/templates/footer.php'; ?>

