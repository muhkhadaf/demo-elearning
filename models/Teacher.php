<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/User.php';
class Teacher {
    public static function create(string $name, string $nip, string $email, string $username, string $password): int {
        $uid = User::create($username, $password, 'teacher');
        $stmt = db()->prepare('INSERT INTO teachers (user_id, name, nip, email) VALUES (?, ?, ?, ?)');
        $stmt->execute([$uid, $name, $nip, $email]);
        return (int)db()->lastInsertId();
    }
    public static function all(): array {
        $stmt = db()->query('SELECT id, user_id, name, nip, email FROM teachers ORDER BY name');
        return $stmt->fetchAll();
    }
    public static function allWithUser(): array {
        $stmt = db()->query('SELECT t.id, t.name, t.nip, t.email, u.username FROM teachers t JOIN users u ON u.id = t.user_id ORDER BY t.name');
        return $stmt->fetchAll();
    }
    public static function count(): int {
        $stmt = db()->query('SELECT COUNT(*) AS c FROM teachers');
        $r = $stmt->fetch();
        return (int)$r['c'];
    }

    public static function update(int $id, string $name, string $nip, string $email, string $username, string $password = ''): void {
        $stmt = db()->prepare('SELECT user_id FROM teachers WHERE id = ?');
        $stmt->execute([$id]);
        $teacher = $stmt->fetch();
        
        if ($teacher) {
            $stmt = db()->prepare('UPDATE teachers SET name = ?, nip = ?, email = ? WHERE id = ?');
            $stmt->execute([$name, $nip, $email, $id]);
            
            $userId = $teacher['user_id'];
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
        $stmt = db()->prepare('SELECT user_id FROM teachers WHERE id = ?');
        $stmt->execute([$id]);
        $teacher = $stmt->fetch();
        
        if ($teacher) {
            $userId = $teacher['user_id'];
            db()->prepare('DELETE FROM teachers WHERE id = ?')->execute([$id]);
            db()->prepare('DELETE FROM users WHERE id = ?')->execute([$userId]);
        }
    }

    public static function find(int $id): ?array {
        $stmt = db()->prepare('SELECT t.*, u.username FROM teachers t JOIN users u ON t.user_id = u.id WHERE t.id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }
}
?>