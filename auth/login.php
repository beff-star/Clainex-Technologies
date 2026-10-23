<?php
$pageTitle = 'Login';
require_once __DIR__ . '/../includes/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login_submit'])) {
    $email = sanitize($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        flash('error', 'Please enter a valid email address.');
        redirect('auth/login.php');
    }

    $pdo = dbConnection();
    if (!$pdo) {
        flash('error', 'Database connection failed. Please try again later.');
        redirect('auth/login.php');
    }

    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email LIMIT 1');
    $stmt->execute([':email' => $email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION['user_id'] = (int) $user['id'];
        $_SESSION['user_name'] = $user['full_name'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_role'] = $user['role'];
        $_SESSION['is_admin'] = $user['role'] === 'admin' ? 1 : 0;

        if (!empty($_POST['remember_me'])) {
            setcookie('clainex_remember_me', $user['email'], time() + 60 * 60 * 24 * 7, '/');
        }

        flash('success', 'Welcome back, ' . $user['full_name'] . '!');

        if ($user['role'] === 'admin') {
            redirect('admin/index.php');
        }

        redirect('index.php');
    }

    flash('error', 'Invalid email or password.');
    redirect('auth/login.php');
}
?>
<section class="auth-hero">
    <div class="container auth-shell">
        <div class="auth-card">
            <div class="auth-header">
                <span class="eyebrow">Welcome back</span>
                <h1>Login to your account</h1>
            </div>

            <form method="post" action="<?= BASE_URL ?>/auth/login.php" class="auth-form">
                <input type="hidden" name="login_submit" value="1">
                <label>
                    Email
                    <input type="email" name="email" required>
                </label>
                <label>
                    Password
                    <input type="password" name="password" required>
                </label>

                <div class="auth-row">
                    <label class="checkbox-row">
                        <input type="checkbox" name="remember_me" value="1">
                        <span>Remember me</span>
                    </label>
                    <a href="<?= BASE_URL ?>/auth/forgot-password.php">Forgot password?</a>
                </div>

                <button type="submit" class="btn btn-primary full-width">Login</button>
            </form>

            <p class="auth-switch">Need an account? <a href="<?= BASE_URL ?>/auth/register.php">Create one</a></p>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
