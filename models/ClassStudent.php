<?php
require_once __DIR__ . '/../config/database.php';
class ClassStudent {
    public static function add(int $class_id, int $student_id): void {
        $stmt = db()->prepare('INSERT IGNORE INTO class_students (class_id, student_id) VALUES (?, ?)');
        $stmt->execute([$class_id, $student_id]);
    }
    public static function classIdForStudent(int $user_id): ?int {
        $sql = 'SELECT cs.class_id 
                FROM class_students cs 
                JOIN students s ON s.id = cs.student_id 
                JOIN classes c ON c.id = cs.class_id
                JOIN academic_years ay ON ay.id = c.academic_year_id
                WHERE s.user_id = ? AND ay.is_active = 1 
                LIMIT 1';
        $stmt = db()->prepare($sql);
        $stmt->execute([$user_id]);
        $r = $stmt->fetch();
        return $r ? (int)$r['class_id'] : null;
    }
    public static function listByClass(int $class_id): array {
        $sql = 'SELECT s.id, s.name, s.nis, s.email FROM class_students cs JOIN students s ON s.id = cs.student_id WHERE cs.class_id = ? ORDER BY s.name';
        $stmt = db()->prepare($sql);
        $stmt->execute([$class_id]);
        return $stmt->fetchAll();
    }
    public static function remove(int $class_id, int $student_id): void {
        $stmt = db()->prepare('DELETE FROM class_students WHERE class_id = ? AND student_id = ?');
        $stmt->execute([$class_id, $student_id]);
    }
}
?>