<?php
$environment = getenv('APP_ENV');
define('APP_ENV', $environment !== false && $environment !== '' ? $environment : 'development');

ini_set('session.use_strict_mode', '1');
ini_set('session.use_only_cookies', '1');
session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'secure' => APP_ENV === 'production' || (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off'),
    'httponly' => true,
    'samesite' => 'Lax',
]);
session_start();
date_default_timezone_set('Africa/Nairobi');

// Website configuration
const SITE_NAME = 'Clainex Technologies';
const SITE_TAGLINE = 'Turning Ideas Into Digital Solutions';

$siteUrl = getenv('SITE_URL');
if ($siteUrl === false || $siteUrl === '') {
    $siteUrl = APP_ENV === 'production'
        ? 'https://clainextechnologies.co.ke'
        : 'http://localhost/Clainex-Technologies';
}
define('BASE_URL', rtrim($siteUrl, '/'));

function environmentValue(string $name, string $developmentDefault): string
{
    $value = getenv($name);

    if ($value !== false) {
        return $value;
    }

    return APP_ENV === 'production' ? '' : $developmentDefault;
}

// Database configuration
define('DB_HOST', environmentValue('DB_HOST', 'localhost'));
define('DB_NAME', environmentValue('DB_NAME', 'clainex_db'));
define('DB_USER', environmentValue('DB_USER', 'root'));
define('DB_PASS', environmentValue('DB_PASS', ''));
define('DB_PORT', getenv('DB_PORT') ?: '3306');

function dbConnection(): ?PDO
{
    if (DB_HOST === '' || DB_NAME === '' || DB_USER === '' || (APP_ENV === 'production' && DB_PASS === '')) {
        error_log('Database connection failed: required production database environment variables are missing.');
        return null;
    }

    try {
        $pdo = new PDO(
            'mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME . ';charset=utf8mb4',
            DB_USER,
            DB_PASS,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]
        );
        return $pdo;
    } catch (PDOException $e) {
        error_log('Database connection failed: ' . $e->getMessage());
        return null;
    }
}

function sanitize($value): string
{
    return trim(strip_tags((string) $value));
}

function e($value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function redirect($path): void
{
    header('Location: ' . BASE_URL . '/' . ltrim($path, '/'));
    exit;
}

function csrfToken(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['csrf_token'];
}

function verifyCsrf(string $token): bool
{
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

function flash(string $type, string $message): void
{
    $_SESSION['flash'] = ['type' => $type, 'message' => $message];
}

function getFlash(): ?array
{
    if (!empty($_SESSION['flash'])) {
        $flash = $_SESSION['flash'];
        unset($_SESSION['flash']);
        return $flash;
    }

    return null;
}

function isLoggedIn(): bool
{
    return !empty($_SESSION['user_id']);
}

function isAdmin(): bool
{
    return !empty($_SESSION['is_admin']) && $_SESSION['is_admin'] === 1;
}

function currentUser(): ?array
{
    if (empty($_SESSION['user_id'])) {
        return null;
    }

    return [
        'id' => $_SESSION['user_id'],
        'name' => $_SESSION['user_name'] ?? '',
        'email' => $_SESSION['user_email'] ?? '',
        'role' => $_SESSION['user_role'] ?? 'customer',
    ];
}
