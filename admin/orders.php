<?php
$pageTitle = 'Order Management';
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
            <a href="<?= BASE_URL ?>/admin/orders.php" class="active">Orders</a>
            <a href="<?= BASE_URL ?>/admin/customers.php">Customers</a>
            <a href="<?= BASE_URL ?>/admin/categories.php">Categories</a>
            <a href="<?= BASE_URL ?>/admin/reports.php">Reports</a>
            <a href="<?= BASE_URL ?>/admin/settings.php">Settings</a>
            <a href="<?= BASE_URL ?>/auth/logout.php">Logout</a>
        </nav>
    </aside>

    <main class="admin-main">
        <div class="section-heading" style="text-align:left;">
            <span class="eyebrow">Operations</span>
            <h2>Request management</h2>
        </div>

        <div class="chart-placeholder">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Service</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>#CLX-1042</td>
                        <td>Jane W.</td>
                        <td>Cyber Security Assessment</td>
                        <td><span class="tag pending">In Review</span></td>
                        <td class="admin-actions"><a href="#">Update</a> <a href="#">Print</a></td>
                    </tr>
                    <tr>
                        <td>#CLX-1045</td>
                        <td>David M.</td>
                        <td>Custom Software Development</td>
                        <td><span class="tag success">Completed</span></td>
                        <td class="admin-actions"><a href="#">Update</a> <a href="#">Print</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
</div>
</body>
</html>
