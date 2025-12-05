<?php
require_once __DIR__ . '/database.php';
function login(string $username, string $password): bool {
    $stmt = db()->prepare('SELECT id, username, password_hash, role FROM users WHERE username = ? LIMIT 1');
    $stmt->execute([$username]);
    $user = $stmt->fetch();
    if (!$user) { return false; }
    if (!password_verify($password, $user['password_hash'])) { return false; }
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['role'] = $user['role'];
    return true;
}
function logout(): void {
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    }
    session_destroy();
}
function require_role(array $roles): void {
    if (!isset($_SESSION['user_id']) || !in_array($_SESSION['role'], $roles, true)) {
        header('Location: index.php?page=login');
        exit;
    }
}
function current_user(): ?array {
    if (!isset($_SESSION['user_id'])) { return null; }
    $stmt = db()->prepare('SELECT id, username, role FROM users WHERE id = ?');
    $stmt->execute([$_SESSION['user_id']]);
    $u = $stmt->fetch();
    return $u ?: null;
}
?>