<?php
require_once __DIR__ . '/../config/database.php';
class User {
    public static function create(string $username, string $password, string $role): int {
        $hash = password_hash($password, PASSWORD_BCRYPT);
        $stmt = db()->prepare('INSERT INTO users (username, password_hash, role) VALUES (?, ?, ?)');
        $stmt->execute([$username, $hash, $role]);
        return (int)db()->lastInsertId();
    }
    public static function count(): int {
        $stmt = db()->query('SELECT COUNT(*) AS c FROM users');
        $r = $stmt->fetch();
        return (int)$r['c'];
    }
}
?>