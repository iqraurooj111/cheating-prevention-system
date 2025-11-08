<?php
/**
 * Rules Page
 * Displays exam rules and regulations
 */

require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/auth.php';

$page_title = 'Exam Rules - Exam Monitor';
include __DIR__ . '/templates/header.php';
?>

<div class="container">
    <section class="rules-section">
        <h1>Exam Rules and Regulations</h1>
        
        <div class="rules-content">
            <div class="rule-card important">
                <h3>⚠️ Important: Cheating Detection</h3>
                <p>The system actively monitors your exam session. Any of the following actions will result in immediate exam termination:</p>
                <ul>
                    <li>Switching to another browser tab</li>
                    <li>Minimizing the browser window</li>
                    <li>Exiting fullscreen mode</li>
                    <li>Opening developer tools (F12)</li>
                </ul>
            </div>
            
            <div class="rule-card">
                <h3>📋 General Rules</h3>
                <ol>
                    <li>You must be logged in to take the exam</li>
                    <li>The exam consists of 10 multiple-choice questions</li>
                    <li>Each question has 4 options (A, B, C, D)</li>
                    <li>You can only select one answer per question</li>
                    <li>You can navigate between questions using the "Next" button</li>
                    <li>Once you move to the next question, you cannot go back</li>
                </ol>
            </div>
            
            <div class="rule-card">
                <h3>⏱️ Time Management</h3>
                <ul>
                    <li>A countdown timer will be displayed during the exam</li>
                    <li>The timer shows the remaining time for the entire exam</li>
                    <li>If time runs out, the exam will be automatically submitted</li>
                    <li>Time taken will be recorded with your results</li>
                </ul>
            </div>
            
            <div class="rule-card">
                <h3>🖥️ Technical Requirements</h3>
                <ul>
                    <li>You must enter fullscreen mode before starting the exam</li>
                    <li>Ensure you have a stable internet connection</li>
                    <li>Do not refresh the page during the exam</li>
                    <li>Use a modern browser (Chrome, Firefox, Edge, Safari)</li>
                </ul>
            </div>
            
            <div class="rule-card">
                <h3>✅ Submission</h3>
                <ul>
                    <li>Review your answers before final submission</li>
                    <li>Click "Submit Exam" when you are ready</li>
                    <li>Your score will be calculated automatically</li>
                    <li>Results will be saved with status "completed" or "cheated"</li>
                </ul>
            </div>
        </div>
        
        <?php if (isLoggedIn()): ?>
            <div class="rules-actions">
                <a href="<?php echo BASE_URL; ?>/start-exam.php" class="btn btn-primary btn-large">I Understand - Proceed to Exam</a>
            </div>
        <?php else: ?>
            <div class="rules-actions">
                <p class="alert alert-info">Please <a href="<?php echo BASE_URL; ?>/auth/login.php">login</a> to proceed with the exam.</p>
            </div>
        <?php endif; ?>
    </section>
</div>

<?php include __DIR__ . '/templates/footer.php'; ?>

