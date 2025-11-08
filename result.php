<?php
/**
 * Result Page
 * Displays exam results and statistics
 */

require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/functions.php';

// Require login
requireLogin();

$user_id = getUserId();
$status = $_GET['status'] ?? 'completed';

// Handle result submission from exam
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_result'])) {
    $score = (int)($_POST['score'] ?? 0);
    $total_questions = (int)($_POST['total_questions'] ?? 0);
    $time_taken = (int)($_POST['time_taken'] ?? 0);
    $result_status = sanitize($_POST['status'] ?? 'completed');
    
    // Save result
    if (saveResult($user_id, $score, $total_questions, $time_taken, $result_status)) {
        // Clear exam session data
        unset($_SESSION['exam_questions']);
        unset($_SESSION['exam_start_time']);
        unset($_SESSION['exam_answers']);
        
        $success = true;
    } else {
        $error = 'Failed to save result.';
    }
}

// Get user results
$user_results = getUserResults($user_id);
$user_stats = getUserStats($user_id);

$page_title = 'Results - Exam Monitor';
include __DIR__ . '/templates/header.php';
?>

<div class="container">
    <section class="results-section">
        <h1>Your Exam Results</h1>
        
        <?php if (isset($success)): ?>
            <div class="alert alert-success">Result saved successfully!</div>
        <?php endif; ?>
        
        <?php if ($status === 'cheated'): ?>
            <div class="alert alert-error">
                <h3>⚠️ Exam Terminated</h3>
                <p>Your exam was terminated due to cheating detection. The result has been marked as "cheated".</p>
            </div>
        <?php endif; ?>
        
        <?php if ($user_stats): ?>
            <div class="stats-grid">
                <div class="stat-card">
                    <h3>Total Attempts</h3>
                    <p class="stat-value"><?php echo $user_stats['total_attempts']; ?></p>
                </div>
                <div class="stat-card">
                    <h3>Average Score</h3>
                    <p class="stat-value"><?php echo number_format($user_stats['average_score'], 1); ?>%</p>
                </div>
                <div class="stat-card">
                    <h3>Highest Score</h3>
                    <p class="stat-value"><?php echo $user_stats['highest_score']; ?>%</p>
                </div>
                <div class="stat-card">
                    <h3>Cheated Attempts</h3>
                    <p class="stat-value"><?php echo $user_stats['cheated_count']; ?></p>
                </div>
            </div>
        <?php endif; ?>
        
        <div class="results-table-container">
            <h2>Exam History</h2>
            <?php if (!empty($user_results)): ?>
                <table class="results-table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Score</th>
                            <th>Total Questions</th>
                            <th>Time Taken</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($user_results as $result): ?>
                            <tr class="<?php echo $result['status'] === 'cheated' ? 'cheated-row' : ''; ?>">
                                <td><?php echo date('Y-m-d H:i:s', strtotime($result['created_at'])); ?></td>
                                <td><?php echo $result['score']; ?>/<?php echo $result['total_questions']; ?> <?php echo $result['total_questions'] > 0 ? '(' . round(($result['score'] / $result['total_questions']) * 100) . '%)' : '(N/A)'; ?></td>
                                <td><?php echo $result['total_questions']; ?></td>
                                <td><?php echo gmdate('i:s', $result['time_taken']); ?></td>
                                <td>
                                    <span class="status-badge status-<?php echo $result['status']; ?>">
                                        <?php echo ucfirst($result['status']); ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="no-results">No exam results yet. <a href="<?php echo BASE_URL; ?>/start-exam.php">Take your first exam</a>!</p>
            <?php endif; ?>
        </div>
        
        <div class="results-actions">
            <a href="<?php echo BASE_URL; ?>/start-exam.php" class="btn btn-primary">Take Another Exam</a>
            <a href="<?php echo BASE_URL; ?>/index.php" class="btn btn-secondary">Back to Home</a>
        </div>
    </section>
</div>

<?php include __DIR__ . '/templates/footer.php'; ?>

