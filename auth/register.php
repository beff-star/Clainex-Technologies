<?php
$pageTitle = 'Register';
require_once __DIR__ . '/../includes/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register_submit'])) {
    $fullName = sanitize($_POST['full_name'] ?? '');
    $username = sanitize($_POST['username'] ?? '');
    $email = sanitize($_POST['email'] ?? '');
    $phone = sanitize($_POST['phone'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';

    $errors = [];

    if ($fullName === '' || strlen($fullName) < 2) {
        $errors[] = 'Full name is required.';
    }
    if ($username === '' || strlen($username) < 3) {
        $errors[] = 'Username must be at least 3 characters.';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Please enter a valid email address.';
    }
    if ($password === '' || strlen($password) < 6) {
        $errors[] = 'Password must be at least 6 characters.';
    }
    if ($password !== $confirmPassword) {
        $errors[] = 'Passwords do not match.';
    }

    if (!empty($errors)) {
        foreach ($errors as $error) {
            flash('error', $error);
        }
        redirect('auth/register.php');
    }

    $pdo = dbConnection();
    if (!$pdo) {
        flash('error', 'Database connection failed. Please try again later.');
        redirect('auth/register.php');
    }

    $stmt = $pdo->prepare('SELECT id FROM users WHERE email = :email OR username = :username LIMIT 1');
    $stmt->execute([':email' => $email, ':username' => $username]);
    if ($stmt->fetch()) {
        flash('error', 'An account with that email or username already exists.');
        redirect('auth/register.php');
    }

    $passwordHash = password_hash($password, PASSWORD_BCRYPT);
    $insert = $pdo->prepare('INSERT INTO users (full_name, username, email, phone, password_hash, role) VALUES (:full_name, :username, :email, :phone, :password_hash, :role)');
    $insert->execute([
        ':full_name' => $fullName,
        ':username' => $username,
        ':email' => $email,
        ':phone' => $phone,
        ':password_hash' => $passwordHash,
        ':role' => 'customer',
    ]);

    flash('success', 'Registration successful. Please log in to continue.');
    redirect('auth/login.php');
}
?>
<section class="auth-hero">
    <div class="container auth-shell">
        <div class="auth-card">
            <div class="auth-header">
                <span class="eyebrow">Create account</span>
                <h1>Register with Clainex</h1>
            </div>

            <form method="post" action="<?= BASE_URL ?>/auth/register.php" class="auth-form" novalidate>
                <input type="hidden" name="register_submit" value="1">

                <div class="form-row two-col">
                    <label>
                        Full Name
                        <input type="text" name="full_name" required>
                    </label>
                    <label>
                        Username
                        <input type="text" name="username" required>
                    </label>
                </div>

                <div class="form-row two-col">
                    <label>
                        Email
                        <input type="email" name="email" required>
                    </label>
                    <label>
                        Phone Number
                        <input type="tel" name="phone">
                    </label>
                </div>

                <div class="form-row two-col">
                    <label>
                        Password
                        <input type="password" name="password" required>
                    </label>
                    <label>
                        Confirm Password
                        <input type="password" name="confirm_password" required>
                    </label>
                </div>

                <button type="submit" class="btn btn-primary full-width">Create Account</button>
            </form>

            <p class="auth-switch">Already have an account? <a href="<?= BASE_URL ?>/auth/login.php">Login here</a></p>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
