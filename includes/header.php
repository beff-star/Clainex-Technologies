<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/functions.php';

$flash = getFlash();
$user = currentUser();
$cartCount = count(getCartItems());
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Clainex Technologies delivers software solutions, IT infrastructure, cybersecurity, AI, data science, and cloud transformation services.">
    <meta name="keywords" content="Clainex Technologies, software solutions, IT infrastructure, cyber security, AI, cloud services, digital solutions">
    <meta name="author" content="Clainex Technologies">
    <meta property="og:title" content="Clainex Technologies | Turning Ideas Into Digital Solutions">
    <meta property="og:description" content="Reliable technology services for software, infrastructure, cybersecurity, AI, data analytics and cloud transformation.">
    <meta property="og:type" content="website">
    <meta name="twitter:card" content="summary_large_image">
    <link rel="canonical" href="<?= BASE_URL ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Poppins:wght@500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
    <title><?= isset($pageTitle) ? e($pageTitle) . ' | ' : '' ?><?= SITE_NAME ?></title>
</head>
<body>
    <header class="site-header">
        <div class="container nav-wrapper">
            <a href="<?= BASE_URL ?>/index.php" class="brand brand-logo" aria-label="Clainex home page">
                <img src="<?= BASE_URL ?>/assets/images/logo.jpeg" alt="Clainex Technologies logo" />
                <div>
                    <strong>Clainex</strong>
                    <small>Technologies</small>
                </div>
            </a>

            <button class="nav-toggle" aria-label="Toggle navigation" aria-expanded="false">
                <span></span>
                <span></span>
                <span></span>
            </button>

            <nav class="main-nav">
                <a href="<?= BASE_URL ?>/index.php">Home</a>
                <a href="<?= BASE_URL ?>/about.php">About</a>
                <a href="<?= BASE_URL ?>/request.php">Services</a>
                <a href="<?= BASE_URL ?>/contact.php">Contact</a>
                <a href="<?= BASE_URL ?>/cart.php">Cart <span class="cart-badge"><?= $cartCount ?></span></a>
            </nav>

            <div class="nav-actions">
                <div class="search-box">
                    <i class="fa fa-search"></i>
                    <input type="search" placeholder="Search services..." aria-label="Search services">
                </div>

                <?php if ($user): ?>
                    <div class="user-menu">
                        <span class="user-name"><?= e($user['name']) ?></span>
                        <div class="dropdown-menu">
                            <a href="<?= BASE_URL ?>/profile.php">Profile</a>
                            <a href="<?= BASE_URL ?>/auth/logout.php">Logout</a>
                        </div>
                    </div>
                <?php else: ?>
                    <a href="<?= BASE_URL ?>/auth/login.php" class="btn btn-outline">Login</a>
                    <a href="<?= BASE_URL ?>/auth/register.php" class="btn btn-primary">Register</a>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <?php if ($flash): ?>
        <div class="toast toast-<?= e($flash['type']) ?>" role="alert">
            <?= e($flash['message']) ?>
        </div>
    <?php endif; ?>

    <main>
