<?php
$pageTitle = 'Customer Management';
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
            <a href="<?= BASE_URL ?>/admin/customers.php" class="active">Customers</a>
            <a href="<?= BASE_URL ?>/admin/categories.php">Categories</a>
            <a href="<?= BASE_URL ?>/admin/reports.php">Reports</a>
            <a href="<?= BASE_URL ?>/admin/settings.php">Settings</a>
            <a href="<?= BASE_URL ?>/auth/logout.php">Logout</a>
        </nav>
    </aside>

    <main class="admin-main">
        <div class="section-heading" style="text-align:left;">
            <span class="eyebrow">Customer data</span>
            <h2>Customer management</h2>
        </div>

        <div class="chart-placeholder">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Jane W.</td>
                        <td>jane@example.com</td>
                        <td>+254700100001</td>
                        <td><span class="tag success">Active</span></td>
                        <td><a href="#">Suspend</a></td>
                    </tr>
                    <tr>
                        <td>David M.</td>
                        <td>david@example.com</td>
                        <td>+254700100002</td>
                        <td><span class="tag pending">Pending</span></td>
                        <td><a href="#">Delete</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
</div>
</body>
</html>
