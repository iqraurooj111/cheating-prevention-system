<?php
/**
 * Login Page
 * Handles user authentication
 */

require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/functions.php';

$error = '';

// Redirect if already logged in
if (isLoggedIn()) {
    header('Location: ' . BASE_URL . '/index.php');
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = sanitize($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    
    if (empty($email) || empty($password)) {
        $error = 'Email and password are required.';
    } else {
        // Check user credentials
        $sql = "SELECT id, name, password FROM users WHERE email = '$email'";
        $result = $conn->query($sql);
        
        if ($result && $result->num_rows > 0) {
            $user = $result->fetch_assoc();
            
            if (verifyPassword($password, $user['password'])) {
                // Login successful
                loginUser($user['id'], $user['name']);
                header('Location: ' . BASE_URL . '/index.php');
                exit();
            } else {
                $error = 'Invalid email or password.';
            }
        } else {
            $error = 'Invalid email or password.';
        }
    }
}

$page_title = 'Login - Exam Monitor';
include __DIR__ . '/../templates/header.php';
?>

<div class="container">
    <div class="auth-container">
        <div class="auth-box">
            <h2>Login</h2>
            
            <?php if ($error): ?>
                <div class="alert alert-error"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <form method="POST" action="" class="auth-form">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required 
                           value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                
                <button type="submit" class="btn btn-primary btn-block">Login</button>
            </form>
            
            <p class="text-center mt-3">
                Don't have an account? <a href="<?php echo BASE_URL; ?>/auth/register.php">Register here</a>
            </p>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../templates/footer.php'; ?>

