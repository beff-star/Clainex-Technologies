<?php
$pageTitle = 'Services Management';
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
            <a href="<?= BASE_URL ?>/admin/services.php" class="active">Services</a>
            <a href="<?= BASE_URL ?>/admin/orders.php">Orders</a>
            <a href="<?= BASE_URL ?>/admin/customers.php">Customers</a>
            <a href="<?= BASE_URL ?>/admin/categories.php">Categories</a>
            <a href="<?= BASE_URL ?>/admin/reports.php">Reports</a>
            <a href="<?= BASE_URL ?>/admin/settings.php">Settings</a>
            <a href="<?= BASE_URL ?>/auth/logout.php">Logout</a>
        </nav>
    </aside>

    <main class="admin-main">
        <div class="section-heading" style="text-align:left;">
            <span class="eyebrow">Catalog</span>
            <h2>Service management</h2>
        </div>

        <div class="admin-actions" style="margin-bottom:18px;">
            <a href="#" class="btn btn-primary">Add service</a>
            <a href="#" class="btn btn-secondary">Upload image</a>
        </div>

        <div class="chart-placeholder">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Service</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>AI & Automation</td>
                        <td>AI</td>
                        <td>KSh 175,000</td>
                        <td><span class="tag success">Active</span></td>
                        <td><span class="admin-actions"><a href="#">Edit</a> <a href="#">Delete</a></span></td>
                    </tr>
                    <tr>
                        <td>Cyber Security Assessment</td>
                        <td>Cyber security</td>
                        <td>KSh 140,000</td>
                        <td><span class="tag pending">Draft</span></td>
                        <td><span class="admin-actions"><a href="#">Edit</a> <a href="#">Delete</a></span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
</div>
</body>
</html>
