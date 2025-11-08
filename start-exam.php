<?php
/**
 * Start Exam Page
 * Pre-exam setup and instructions
 */

require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/functions.php';

// Require login
requireLogin();

$page_title = 'Start Exam - Exam Monitor';
include __DIR__ . '/templates/header.php';
?>

<div class="container">
    <section class="start-exam-section">
        <h1>Ready to Start Your Exam?</h1>
        
        <div class="exam-info-card">
            <h2>Exam Information</h2>
            <ul class="exam-details">
                <li><strong>Total Questions:</strong> 10</li>
                <li><strong>Question Type:</strong> Multiple Choice (4 options each)</li>
                <li><strong>Navigation:</strong> One question at a time, forward only</li>
                <li><strong>Timer:</strong> Countdown timer will be displayed</li>
            </ul>
        </div>
        
        <div class="warning-card">
            <h3>⚠️ Important Instructions</h3>
            <ol>
                <li>You <strong>MUST</strong> enter fullscreen mode before starting</li>
                <li>Do <strong>NOT</strong> switch tabs or minimize the window</li>
                <li>Do <strong>NOT</strong> exit fullscreen mode during the exam</li>
                <li>Any violation will result in immediate exam termination</li>
                <li>Make sure you have read the <a href="<?php echo BASE_URL; ?>/rules.php">exam rules</a></li>
            </ol>
        </div>
        
        <div class="start-exam-actions">
            <button id="startExamBtn" class="btn btn-primary btn-large">Enter Fullscreen & Start Exam</button>
            <a href="<?php echo BASE_URL; ?>/rules.php" class="btn btn-secondary">Review Rules</a>
        </div>
    </section>
</div>

<script>
document.getElementById('startExamBtn').addEventListener('click', function() {
    // Request fullscreen
    const elem = document.documentElement;
    
    if (elem.requestFullscreen) {
        elem.requestFullscreen().then(() => {
            // Redirect to exam page after fullscreen is entered
            window.location.href = '<?php echo BASE_URL; ?>/exam.php';
        }).catch((err) => {
            alert('Please allow fullscreen mode to continue.');
        });
    } else if (elem.webkitRequestFullscreen) {
        elem.webkitRequestFullscreen();
    } else if (elem.msRequestFullscreen) {
        elem.msRequestFullscreen();
    } else {
        alert('Fullscreen is not supported in your browser.');
    }
});
</script>

<?php include __DIR__ . '/templates/footer.php'; ?>

