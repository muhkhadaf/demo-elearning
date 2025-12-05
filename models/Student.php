<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/User.php';
class Student {
    public static function create(string $name, string $nis, string $email, string $username, string $password): int {
        $uid = User::create($username, $password, 'student');
        $stmt = db()->prepare('INSERT INTO students (user_id, name, nis, email) VALUES (?, ?, ?, ?)');
        $stmt->execute([$uid, $name, $nis, $email]);
        return (int)db()->lastInsertId();
    }
    public static function all(): array {
        $stmt = db()->query('SELECT id, user_id, name, nis, email FROM students ORDER BY name');
        return $stmt->fetchAll();
    }
    public static function allWithUser(): array {
        $stmt = db()->query('SELECT s.id, s.name, s.nis, s.email, u.username FROM students s JOIN users u ON u.id = s.user_id ORDER BY s.name');
        return $stmt->fetchAll();
    }
    public static function count(): int {
        $stmt = db()->query('SELECT COUNT(*) AS c FROM students');
        $r = $stmt->fetch();
        return (int)$r['c'];
    }

    public static function update(int $id, string $name, string $nis, string $email, string $username, string $password = ''): void {
        $stmt = db()->prepare('SELECT user_id FROM students WHERE id = ?');
        $stmt->execute([$id]);
        $student = $stmt->fetch();
        
        if ($student) {
            $stmt = db()->prepare('UPDATE students SET name = ?, nis = ?, email = ? WHERE id = ?');
            $stmt->execute([$name, $nis, $email, $id]);
            
            $userId = $student['user_id'];
            if ($password !== '') {
                $hash = password_hash($password, PASSWORD_BCRYPT);
                $stmt = db()->prepare('UPDATE users SET username = ?, password_hash = ? WHERE id = ?');
                $stmt->execute([$username, $hash, $userId]);
            } else {
                $stmt = db()->prepare('UPDATE users SET username = ? WHERE id = ?');
                $stmt->execute([$username, $userId]);
            }
        }
    }

    public static function delete(int $id): void {
        $stmt = db()->prepare('SELECT user_id FROM students WHERE id = ?');
        $stmt->execute([$id]);
        $student = $stmt->fetch();
        
        if ($student) {
            $userId = $student['user_id'];
            db()->prepare('DELETE FROM students WHERE id = ?')->execute([$id]);
            db()->prepare('DELETE FROM users WHERE id = ?')->execute([$userId]);
        }
    }

    public static function find(int $id): ?array {
        $stmt = db()->prepare('SELECT s.*, u.username FROM students s JOIN users u ON s.user_id = u.id WHERE s.id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }
}
?>