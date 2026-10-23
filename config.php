<?php
session_start();
date_default_timezone_set('Africa/Nairobi');

// Website configuration
const SITE_NAME = 'Clainex Technologies';
const SITE_TAGLINE = 'Turning Ideas Into Digital Solutions';
const BASE_URL = 'http://localhost/clainex';

// Database configuration
const DB_HOST = 'localhost';
const DB_NAME = 'clainex_db';
const DB_USER = 'root';
const DB_PASS = '';

function dbConnection(): ?PDO
{
    try {
        $pdo = new PDO(
            'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4',
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
