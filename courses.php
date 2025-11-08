<?php
/**
 * Courses Page
 * Web development course listings
 */

require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/auth.php';

$page_title = 'Courses - Exam Monitor';
include __DIR__ . '/templates/header.php';
?>

<div class="container">
    <section class="courses-section">
        <h1>Web Development Courses</h1>
        <p class="lead">Explore our comprehensive web development course offerings</p>
        
        <div class="courses-grid">
            <div class="course-card">
                <div class="course-icon">🌐</div>
                <h3>HTML Fundamentals</h3>
                <p>Learn the building blocks of web pages. Master HTML5 semantic elements, forms, and accessibility.</p>
                <ul class="course-topics">
                    <li>HTML Structure</li>
                    <li>Semantic HTML5</li>
                    <li>Forms & Inputs</li>
                    <li>Accessibility</li>
                </ul>
                <div class="course-level">Beginner</div>
            </div>
            
            <div class="course-card">
                <div class="course-icon">🎨</div>
                <h3>CSS Styling</h3>
                <p>Create beautiful and responsive web designs. Learn CSS3, Flexbox, Grid, and modern layout techniques.</p>
                <ul class="course-topics">
                    <li>CSS Basics</li>
                    <li>Flexbox & Grid</li>
                    <li>Responsive Design</li>
                    <li>Animations</li>
                </ul>
                <div class="course-level">Beginner</div>
            </div>
            
            <div class="course-card">
                <div class="course-icon">⚡</div>
                <h3>JavaScript Essentials</h3>
                <p>Master JavaScript programming. Learn variables, functions, DOM manipulation, and event handling.</p>
                <ul class="course-topics">
                    <li>JS Fundamentals</li>
                    <li>DOM Manipulation</li>
                    <li>Event Handling</li>
                    <li>ES6+ Features</li>
                </ul>
                <div class="course-level">Intermediate</div>
            </div>
            
            <div class="course-card">
                <div class="course-icon">🔧</div>
                <h3>PHP Backend Development</h3>
                <p>Build server-side applications with PHP. Learn form handling, sessions, and database integration.</p>
                <ul class="course-topics">
                    <li>PHP Basics</li>
                    <li>Form Processing</li>
                    <li>Session Management</li>
                    <li>Security Best Practices</li>
                </ul>
                <div class="course-level">Intermediate</div>
            </div>
            
            <div class="course-card">
                <div class="course-icon">🗄️</div>
                <h3>MySQL Database</h3>
                <p>Master database design and SQL queries. Learn to create, manage, and query relational databases.</p>
                <ul class="course-topics">
                    <li>Database Design</li>
                    <li>SQL Queries</li>
                    <li>Relationships</li>
                    <li>Optimization</li>
                </ul>
                <div class="course-level">Intermediate</div>
            </div>
            
            <div class="course-card">
                <div class="course-icon">🚀</div>
                <h3>Full Stack Development</h3>
                <p>Combine all technologies to build complete web applications. Frontend, backend, and database integration.</p>
                <ul class="course-topics">
                    <li>Project Architecture</li>
                    <li>API Development</li>
                    <li>Authentication</li>
                    <li>Deployment</li>
                </ul>
                <div class="course-level">Advanced</div>
            </div>
        </div>
        
        <div class="courses-actions">
            <a href="<?php echo BASE_URL; ?>/learning.php" class="btn btn-primary">Learn More</a>
            <?php if (isLoggedIn()): ?>
                <a href="<?php echo BASE_URL; ?>/start-exam.php" class="btn btn-secondary">Test Your Knowledge</a>
            <?php else: ?>
                <a href="<?php echo BASE_URL; ?>/auth/register.php" class="btn btn-secondary">Get Started</a>
            <?php endif; ?>
        </div>
    </section>
</div>

<?php include __DIR__ . '/templates/footer.php'; ?>

