<?php
require_once __DIR__ . '/../config/database.php';
class Subject {
    public static function create(string $name): int {
        $stmt = db()->prepare('INSERT INTO subjects (name) VALUES (?)');
        $stmt->execute([$name]);
        return (int)db()->lastInsertId();
    }
    public static function all(): array {
        $stmt = db()->query('SELECT id, name FROM subjects ORDER BY name');
        return $stmt->fetchAll();
    }
    public static function update(int $id, string $name): void {
        $stmt = db()->prepare('UPDATE subjects SET name = ? WHERE id = ?');
        $stmt->execute([$name, $id]);
    }

    public static function delete(int $id): void {
        $stmt = db()->prepare('DELETE FROM subjects WHERE id = ?');
        $stmt->execute([$id]);
    }

    public static function find(int $id): ?array {
        $stmt = db()->prepare('SELECT * FROM subjects WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }

    public static function count(): int {
        $stmt = db()->query('SELECT COUNT(*) AS c FROM subjects');
        $r = $stmt->fetch();
        return (int)$r['c'];
    }
}
?>