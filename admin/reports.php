<?php
$pageTitle = 'Reports';
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
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
</head>
<body>
<div class="admin-page">
    <aside class="admin-sidebar">
        <a href="<?= BASE_URL ?>/index.php" class="brand brand-logo">
            <img src="<?= BASE_URL ?>/assets/images/logo.jpeg" alt="Clainex Technologies logo" />
            <div><strong>Clainex</strong><small>Admin</small></div>
        </a>
        <nav class="admin-menu">
            <a href="<?= BASE_URL ?>/admin/index.php">Dashboard</a>
            <a href="<?= BASE_URL ?>/admin/services.php">Services</a>
            <a href="<?= BASE_URL ?>/admin/orders.php">Orders</a>
            <a href="<?= BASE_URL ?>/admin/customers.php">Customers</a>
            <a href="<?= BASE_URL ?>/admin/categories.php">Categories</a>
            <a href="<?= BASE_URL ?>/admin/reports.php" class="active">Reports</a>
            <a href="<?= BASE_URL ?>/admin/settings.php">Settings</a>
            <a href="<?= BASE_URL ?>/auth/logout.php">Logout</a>
        </nav>
    </aside>

    <main class="admin-main">
        <div class="section-heading" style="text-align:left;">
            <span class="eyebrow">Analytics</span>
            <h2>Sales and performance reports</h2>
        </div>

        <div class="stats-cards">
            <div class="stat-box"><strong>Daily</strong><span>KSh 180K</span></div>
            <div class="stat-box"><strong>Weekly</strong><span>KSh 760K</span></div>
            <div class="stat-box"><strong>Monthly</strong><span>KSh 1.7M</span></div>
            <div class="stat-box"><strong>Annual</strong><span>KSh 20M</span></div>
        </div>
    </main>
</div>
</body>
</html>
