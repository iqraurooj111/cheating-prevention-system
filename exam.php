<?php
/**
 * Exam Page
 * Main exam interface with questions and timer
 */

require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/functions.php';

// Require login
requireLogin();

// Get questions
$questions = getAllQuestions();

if (empty($questions)) {
    die('No questions available. Please contact administrator.');
}

// Store questions in session for result calculation
$_SESSION['exam_questions'] = $questions;
$_SESSION['exam_start_time'] = time();
$_SESSION['exam_answers'] = [];

$page_title = 'Exam - Exam Monitor';
include __DIR__ . '/templates/header.php';
?>

<div class="exam-container">
    <div class="exam-header">
        <div class="exam-timer">
            <span class="timer-label">Time Remaining:</span>
            <span id="timer" class="timer-display">00:00</span>
        </div>
        <div class="exam-progress">
            <span>Question <span id="currentQuestion">1</span> of <span id="totalQuestions"><?php echo count($questions); ?></span></span>
            <div class="progress-bar">
                <div id="progressFill" class="progress-fill"></div>
            </div>
        </div>
    </div>
    
    <div class="exam-content">
        <div id="questionContainer" class="question-container">
            <!-- Questions will be loaded here by JavaScript -->
        </div>
        
        <div class="exam-actions">
            <button id="nextBtn" class="btn btn-primary">Next Question</button>
            <button id="submitBtn" class="btn btn-danger" style="display: none;">Submit Exam</button>
        </div>
    </div>
</div>

<!-- Cheating Detection Modal -->
<div id="cheatingModal" class="modal" style="display: none;">
    <div class="modal-content error-modal">
        <h2>⚠️ Cheating Detected</h2>
        <p>Your exam has been terminated due to suspicious activity.</p>
        <p>Possible violations:</p>
        <ul>
            <li>Tab switch detected</li>
            <li>Window blur detected</li>
            <li>Fullscreen exit detected</li>
        </ul>
        <p><strong>Your exam status has been marked as "cheated".</strong></p>
        <a href="<?php echo BASE_URL; ?>/result.php?status=cheated" class="btn btn-primary">View Results</a>
    </div>
</div>

<script>
// Pass questions to JavaScript
const examQuestions = <?php echo json_encode($questions); ?>;
const examDuration = 600; // 10 minutes in seconds
</script>
<script src="<?php echo BASE_URL; ?>/assets/js/detection.js"></script>
<script src="<?php echo BASE_URL; ?>/assets/js/exam.js"></script>

<?php include __DIR__ . '/templates/footer.php'; ?>

