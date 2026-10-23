<?php
$pageTitle = 'Forgot Password';
require_once __DIR__ . '/../includes/header.php';
?>
<section class="auth-hero">
    <div class="container auth-shell">
        <div class="auth-card">
            <div class="auth-header">
                <span class="eyebrow">Reset account</span>
                <h1>Forgot your password?</h1>
            </div>
            <form method="post" action="#" class="auth-form">
                <label>
                    Email address
                    <input type="email" name="email" placeholder="Enter your email" required>
                </label>
                <button type="submit" class="btn btn-primary full-width">Send reset link</button>
            </form>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
