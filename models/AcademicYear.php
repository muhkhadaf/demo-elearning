<?php
require_once __DIR__ . '/../config/database.php';
class AcademicYear {
    public static function create(string $label, bool $active): int {
        if ($active) { self::clearActive(); }
        $stmt = db()->prepare('INSERT INTO academic_years (label, is_active) VALUES (?, ?)');
        $stmt->execute([$label, $active ? 1 : 0]);
        return (int)db()->lastInsertId();
    }
    public static function setActive(int $id): void {
        self::clearActive();
        $stmt = db()->prepare('UPDATE academic_years SET is_active = 1 WHERE id = ?');
        $stmt->execute([$id]);
    }
    private static function clearActive(): void {
        db()->exec('UPDATE academic_years SET is_active = 0');
    }
    public static function all(): array {
        $stmt = db()->query('SELECT id, label, is_active FROM academic_years ORDER BY id DESC');
        return $stmt->fetchAll();
    }
    public static function activeId(): ?int {
        $stmt = db()->query('SELECT id FROM academic_years WHERE is_active = 1 LIMIT 1');
        $r = $stmt->fetch();
        return $r ? (int)$r['id'] : null;
    }
    public static function update(int $id, string $label, bool $is_active): void {
        $stmt = db()->prepare('UPDATE academic_years SET label = ?, is_active = ? WHERE id = ?');
        $stmt->execute([$label, $is_active ? 1 : 0, $id]);
        if ($is_active) {
            self::setActive($id);
        }
    }

    public static function delete(int $id): void {
        $stmt = db()->prepare('DELETE FROM academic_years WHERE id = ?');
        $stmt->execute([$id]);
    }

    public static function find(int $id): ?array {
        $stmt = db()->prepare('SELECT * FROM academic_years WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }
}
?>