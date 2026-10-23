<?php
$pageTitle = 'Profile';
require_once __DIR__ . '/includes/header.php';

if (!isLoggedIn()) {
    flash('error', 'Please login to update your profile.');
    redirect('auth/login.php');
}

$user = currentUser();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
    $fullName = sanitize($_POST['full_name'] ?? '');
    $phone = sanitize($_POST['phone'] ?? '');

    $pdo = dbConnection();
    if ($pdo) {
        $stmt = $pdo->prepare('UPDATE users SET full_name = :full_name, phone = :phone, updated_at = NOW() WHERE id = :id');
        $stmt->execute([
            ':full_name' => $fullName,
            ':phone' => $phone,
            ':id' => $user['id'],
        ]);
        $_SESSION['user_name'] = $fullName;
        flash('success', 'Profile updated successfully.');
    }

    redirect('profile.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_password'])) {
    $currentPassword = $_POST['current_password'] ?? '';
    $newPassword = $_POST['new_password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';

    if ($newPassword !== $confirmPassword) {
        flash('error', 'New passwords do not match.');
        redirect('profile.php');
    }

    $pdo = dbConnection();
    if ($pdo) {
        $stmt = $pdo->prepare('SELECT password_hash FROM users WHERE id = :id LIMIT 1');
        $stmt->execute([':id' => $user['id']]);
        $record = $stmt->fetch();

        if ($record && password_verify($currentPassword, $record['password_hash'])) {
            $hash = password_hash($newPassword, PASSWORD_BCRYPT);
            $stmt = $pdo->prepare('UPDATE users SET password_hash = :hash, updated_at = NOW() WHERE id = :id');
            $stmt->execute([':hash' => $hash, ':id' => $user['id']]);
            flash('success', 'Password changed successfully.');
        } else {
            flash('error', 'Current password is incorrect.');
        }
    }

    redirect('profile.php');
}

$pdo = dbConnection();
if ($pdo) {
    $stmt = $pdo->prepare('SELECT full_name, email, phone FROM users WHERE id = :id LIMIT 1');
    $stmt->execute([':id' => $user['id']]);
    $profile = $stmt->fetch();
}
?>
<section class="page-hero inner-page-hero">
    <div class="container small-container">
        <span class="eyebrow">Your account</span>
        <h1>Account profile</h1>
    </div>
</section>

<section class="section">
    <div class="container profile-grid">
        <div class="profile-card">
            <h3>Update profile</h3>
            <form method="post" action="<?= BASE_URL ?>/profile.php" class="auth-form">
                <input type="hidden" name="update_profile" value="1">
                <label>
                    Full name
                    <input type="text" name="full_name" value="<?= e($profile['full_name'] ?? $user['name']) ?>" required>
                </label>
                <label>
                    Email
                    <input type="email" value="<?= e($profile['email'] ?? $user['email']) ?>" disabled>
                </label>
                <label>
                    Phone Number
                    <input type="tel" name="phone" value="<?= e($profile['phone'] ?? '') ?>">
                </label>
                <button type="submit" class="btn btn-primary full-width">Update profile</button>
            </form>
        </div>

        <div class="profile-card">
            <h3>Change password</h3>
            <form method="post" action="<?= BASE_URL ?>/profile.php" class="auth-form">
                <input type="hidden" name="change_password" value="1">
                <label>
                    Current password
                    <input type="password" name="current_password" required>
                </label>
                <label>
                    New password
                    <input type="password" name="new_password" required>
                </label>
                <label>
                    Confirm new password
                    <input type="password" name="confirm_password" required>
                </label>
                <button type="submit" class="btn btn-secondary full-width">Change password</button>
            </form>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
