<?php
require_once __DIR__ . '/../config/database.php';
class SchoolClass {
    public static function create(string $name, int $academic_year_id, int $homeroom_teacher_id): int {
        $stmt = db()->prepare('INSERT INTO classes (name, academic_year_id, homeroom_teacher_id) VALUES (?, ?, ?)');
        $stmt->execute([$name, $academic_year_id, $homeroom_teacher_id ?: null]);
        return (int)db()->lastInsertId();
    }
    public static function all(): array {
        $stmt = db()->query('SELECT id, name, academic_year_id, homeroom_teacher_id FROM classes ORDER BY name');
        return $stmt->fetchAll();
    }
    public static function byYear(int $academic_year_id): array {
        $stmt = db()->prepare('SELECT id, name, academic_year_id, homeroom_teacher_id FROM classes WHERE academic_year_id = ? ORDER BY name');
        $stmt->execute([$academic_year_id]);
        return $stmt->fetchAll();
    }
    public static function allWithYearTeacher(): array {
        $sql = 'SELECT c.id, c.name, ay.label AS year_label, t.name AS homeroom_name FROM classes c JOIN academic_years ay ON ay.id = c.academic_year_id LEFT JOIN teachers t ON t.id = c.homeroom_teacher_id ORDER BY c.name';
        $stmt = db()->query($sql);
        return $stmt->fetchAll();
    }
    public static function byYearDetailed(int $academic_year_id): array {
        $sql = 'SELECT c.id, c.name, ay.label AS year_label, t.name AS homeroom_name FROM classes c JOIN academic_years ay ON ay.id = c.academic_year_id LEFT JOIN teachers t ON t.id = c.homeroom_teacher_id WHERE c.academic_year_id = ? ORDER BY c.name';
        $stmt = db()->prepare($sql);
        $stmt->execute([$academic_year_id]);
        return $stmt->fetchAll();
    }
    public static function count(): int {
        $stmt = db()->query('SELECT COUNT(*) AS c FROM classes');
        $r = $stmt->fetch();
        return (int)$r['c'];
    }
    public static function updateHomeroom(int $class_id, ?int $teacher_id): void {
        $stmt = db()->prepare('UPDATE classes SET homeroom_teacher_id = ? WHERE id = ?');
        $stmt->execute([$teacher_id ?: null, $class_id]);
    }

    public static function update(int $id, string $name, int $year_id, int $homeroom_id): void {
        $stmt = db()->prepare('UPDATE classes SET name = ?, academic_year_id = ?, homeroom_teacher_id = ? WHERE id = ?');
        $stmt->execute([$name, $year_id, $homeroom_id ?: null, $id]);
    }

    public static function delete(int $id): void {
        $stmt = db()->prepare('DELETE FROM classes WHERE id = ?');
        $stmt->execute([$id]);
    }

    public static function find(int $id): ?array {
        $stmt = db()->prepare('SELECT * FROM classes WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }
}
?>