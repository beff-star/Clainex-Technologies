<?php
$pageTitle = 'Admin Dashboard';
require_once __DIR__ . '/../config.php';
if (!isAdmin()) {
    flash('error', 'Access denied. Please login as an admin.');
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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Poppins:wght@500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
</head>
<body>
    <div class="admin-page">
        <aside class="admin-sidebar">
            <a href="<?= BASE_URL ?>/index.php" class="brand brand-logo">
                <img src="<?= BASE_URL ?>/assets/images/logo.jpeg" alt="Clainex Technologies logo" />
                <div>
                    <strong>Clainex</strong>
                    <small>Admin</small>
                </div>
            </a>

            <nav class="admin-menu">
                <a href="<?= BASE_URL ?>/admin/index.php" class="active">Dashboard</a>
                <a href="<?= BASE_URL ?>/admin/services.php">Services</a>
                <a href="<?= BASE_URL ?>/admin/orders.php">Orders</a>
                <a href="<?= BASE_URL ?>/admin/customers.php">Customers</a>
                <a href="<?= BASE_URL ?>/admin/categories.php">Categories</a>
                <a href="<?= BASE_URL ?>/admin/reports.php">Reports</a>
                <a href="<?= BASE_URL ?>/admin/settings.php">Settings</a>
                <a href="<?= BASE_URL ?>/auth/logout.php">Logout</a>
            </nav>
        </aside>

        <main class="admin-main">
            <div class="section-heading" style="text-align:left; margin-bottom:18px;">
                <span class="eyebrow">Overview</span>
                <h2>Dashboard Home</h2>
            </div>

            <div class="stats-cards">
                <div class="stat-box">
                    <strong>126</strong>
                    <span>Total Users</span>
                </div>
                <div class="stat-box">
                    <strong>48</strong>
                    <span>Requests</span>
                </div>
                <div class="stat-box">
                    <strong>KSh 1.7M</strong>
                    <span>Revenue</span>
                </div>
                <div class="stat-box">
                    <strong>16</strong>
                    <span>Pending Orders</span>
                </div>
            </div>

            <div style="display:grid; grid-template-columns: repeat(2, minmax(0,1fr)); gap:24px;">
                <div class="chart-placeholder">
                    <h3>Monthly Sales</h3>
                    <p>Bar chart placeholder for monthly revenue trends.</p>
                    <div style="height:220px; background: linear-gradient(180deg, rgba(214,40,40,0.12), rgba(29,78,216,0.04)); border-radius: 14px; display:flex; align-items:flex-end; justify-content:space-around; padding:18px; gap:12px;">
                        <span style="flex:1; background:#d62828; height:45%; border-radius:10px 10px 0 0;"></span>
                        <span style="flex:1; background:#1d4ed8; height:62%; border-radius:10px 10px 0 0;"></span>
                        <span style="flex:1; background:#d62828; height:58%; border-radius:10px 10px 0 0;"></span>
                        <span style="flex:1; background:#2563eb; height:80%; border-radius:10px 10px 0 0;"></span>
                        <span style="flex:1; background:#d62828; height:70%; border-radius:10px 10px 0 0;"></span>
                    </div>
                </div>

                <div class="chart-placeholder">
                    <h3>Service Performance</h3>
                    <p>Track the most requested service categories.</p>
                    <ul style="padding-left:18px; color:#4b5563; line-height:2;">
                        <li>Custom Software Development: 28%</li>
                        <li>Cyber Security: 23%</li>
                        <li>Cloud & Digital Solutions: 21%</li>
                        <li>AI & Automation: 18%</li>
                    </ul>
                </div>
            </div>

            <div class="chart-placeholder" style="margin-top:24px;">
                <h3>Recent requests</h3>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Customer</th>
                            <th>Service</th>
                            <th>Status</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Jane W.</td>
                            <td>Cyber Security Assessment</td>
                            <td><span class="tag pending">Pending</span></td>
                            <td>KSh 140,000</td>
                        </tr>
                        <tr>
                            <td>David M.</td>
                            <td>Custom Software Development</td>
                            <td><span class="tag success">Approved</span></td>
                            <td>KSh 1,200,000</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>
