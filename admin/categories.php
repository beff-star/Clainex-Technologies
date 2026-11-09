<?php
$pageTitle = 'Category Management';
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
            <a href="<?= BASE_URL ?>/admin/categories.php" class="active">Categories</a>
            <a href="<?= BASE_URL ?>/admin/reports.php">Reports</a>
            <a href="<?= BASE_URL ?>/admin/settings.php">Settings</a>
            <a href="<?= BASE_URL ?>/auth/logout.php">Logout</a>
        </nav>
    </aside>

    <main class="admin-main">
        <div class="section-heading" style="text-align:left;">
            <span class="eyebrow">Catalog</span>
            <h2>Category management</h2>
        </div>

        <div class="admin-actions" style="margin-bottom:18px;">
            <a href="#" class="btn btn-primary">Add category</a>
        </div>

        <div class="chart-placeholder">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Slug</th>
                        <th>Services</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td>Software solutions</td><td>software-solutions</td><td>18</td><td><a href="#">Edit</a> | <a href="#">Delete</a></td></tr>
                    <tr><td>Cyber security</td><td>cyber-security</td><td>12</td><td><a href="#">Edit</a> | <a href="#">Delete</a></td></tr>
                    <tr><td>Cloud & digital solutions</td><td>cloud-and-digital-solutions</td><td>9</td><td><a href="#">Edit</a> | <a href="#">Delete</a></td></tr>
                </tbody>
            </table>
        </div>
    </main>
</div>
</body>
</html>
