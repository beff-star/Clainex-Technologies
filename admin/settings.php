<?php
$pageTitle = 'Settings';
require_once __DIR__ . '/../config.php';
if (!isAdmin()) {
    redirect('auth/login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($pageTitle) ?> | Clainex Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Michroma&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
</head>
<body>
<div class="admin-page">
    <aside class="admin-sidebar">
        <a href="<?= BASE_URL ?>/index.php" class="brand brand-logo">
            <img src="<?= BASE_URL ?>/assets/images/logo-mark.jpeg" alt="Clainex logo emblem" />
            <span class="brand-wordmark">
                <strong>Claine<span class="brand-accent-x">x</span></strong>
                <small>Technologies</small>
            </span>
        </a>
        <nav class="admin-menu">
            <a href="<?= BASE_URL ?>/admin/index.php">Dashboard</a>
            <a href="<?= BASE_URL ?>/admin/services.php">Services</a>
            <a href="<?= BASE_URL ?>/admin/orders.php">Orders</a>
            <a href="<?= BASE_URL ?>/admin/customers.php">Customers</a>
            <a href="<?= BASE_URL ?>/admin/categories.php">Categories</a>
            <a href="<?= BASE_URL ?>/admin/reports.php">Reports</a>
            <a href="<?= BASE_URL ?>/admin/settings.php" class="active">Settings</a>
            <a href="<?= BASE_URL ?>/auth/logout.php">Logout</a>
        </nav>
    </aside>

    <main class="admin-main">
        <div class="section-heading" style="text-align:left;">
            <span class="eyebrow">Configuration</span>
            <h2>Website settings</h2>
        </div>

        <div class="chart-placeholder">
            <form class="auth-form">
                <label>Website Name <input type="text" value="Clainex Technologies"></label>
                <label>Contact Email <input type="email" value="info@clainextechnologies.co.ke"></label>
                <label>Phone <input type="text" value="+254 014 2843509"></label>
                <button type="submit" class="btn btn-primary">Save settings</button>
            </form>
        </div>
    </main>
</div>
</body>
</html>
