<?php
/**
 * Learning Page
 * Educational content about what's learned from the exam
 */

require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/auth.php';

$page_title = 'Learning - Exam Monitor';
include __DIR__ . '/templates/header.php';
?>

<div class="container">
    <section class="learning-section">
        <h1>What You'll Learn</h1>
        
        <div class="learning-content">
            <div class="learning-card">
                <h2>📚 Web Development Fundamentals</h2>
                <p>This exam covers essential web development concepts that form the foundation of modern web applications.</p>
            </div>
            
            <div class="learning-card">
                <h3>HTML (HyperText Markup Language)</h3>
                <ul>
                    <li>Understanding HTML structure and syntax</li>
                    <li>HTML tags and their purposes</li>
                    <li>Creating semantic and accessible web pages</li>
                    <li>Form elements and input types</li>
                </ul>
            </div>
            
            <div class="learning-card">
                <h3>CSS (Cascading Style Sheets)</h3>
                <ul>
                    <li>Styling web pages with CSS</li>
                    <li>CSS properties and selectors</li>
                    <li>Layout techniques (Flexbox, Grid)</li>
                    <li>Responsive design principles</li>
                    <li>Color, typography, and spacing</li>
                </ul>
            </div>
            
            <div class="learning-card">
                <h3>JavaScript</h3>
                <ul>
                    <li>JavaScript fundamentals and syntax</li>
                    <li>Variables, data types, and operators</li>
                    <li>Functions and control structures</li>
                    <li>DOM manipulation</li>
                    <li>Event handling and listeners</li>
                    <li>Array methods and object manipulation</li>
                </ul>
            </div>
            
            <div class="learning-card">
                <h3>PHP (Server-Side Scripting)</h3>
                <ul>
                    <li>PHP basics and syntax</li>
                    <li>Server-side processing</li>
                    <li>Form handling and validation</li>
                    <li>Session management</li>
                    <li>Database interactions</li>
                </ul>
            </div>
            
            <div class="learning-card">
                <h3>SQL (Database Management)</h3>
                <ul>
                    <li>Database concepts and design</li>
                    <li>SQL queries (SELECT, INSERT, UPDATE, DELETE)</li>
                    <li>Table relationships and joins</li>
                    <li>Data integrity and constraints</li>
                </ul>
            </div>
            
            <div class="learning-card highlight">
                <h3>🎯 Exam Benefits</h3>
                <p>By taking this exam, you will:</p>
                <ul>
                    <li>Test your understanding of web development concepts</li>
                    <li>Identify areas that need improvement</li>
                    <li>Gain confidence in your technical knowledge</li>
                    <li>Receive immediate feedback on your performance</li>
                    <li>Track your progress over time</li>
                </ul>
            </div>
        </div>
        
        <div class="learning-actions">
            <a href="<?php echo BASE_URL; ?>/courses.php" class="btn btn-primary">Explore Courses</a>
            <?php if (isLoggedIn()): ?>
                <a href="<?php echo BASE_URL; ?>/start-exam.php" class="btn btn-secondary">Take Exam</a>
            <?php endif; ?>
        </div>
    </section>
</div>

<?php include __DIR__ . '/templates/footer.php'; ?>

