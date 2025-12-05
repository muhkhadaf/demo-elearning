<?php
require_once __DIR__ . '/../config/database.php';
class ClassSubject {
    public static function assign(int $class_id, int $subject_id, int $teacher_id, ?string $day = null, ?string $start_time = null, ?string $end_time = null): int {
        $stmt = db()->prepare('INSERT INTO class_subjects (class_id, subject_id, teacher_id, day, start_time, end_time) VALUES (?, ?, ?, ?, ?, ?)');
        $stmt->execute([$class_id, $subject_id, $teacher_id, $day, $start_time, $end_time]);
        return (int)db()->lastInsertId();
    }
    public static function allDetailed(): array {
        $sql = 'SELECT cs.id, c.name AS class_name, s.name AS subject_name, t.name AS teacher_name, cs.day, cs.start_time, cs.end_time 
                FROM class_subjects cs 
                JOIN classes c ON c.id = cs.class_id 
                JOIN subjects s ON s.id = cs.subject_id 
                JOIN teachers t ON t.id = cs.teacher_id 
                ORDER BY FIELD(cs.day, "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"), cs.start_time, c.name';
        $stmt = db()->query($sql);
        return $stmt->fetchAll();
    }
    public static function forTeacher(int $user_id): array {
        $sql = 'SELECT cs.id, c.name AS class_name, s.name AS subject_name, cs.day, cs.start_time, cs.end_time 
                FROM class_subjects cs 
                JOIN classes c ON c.id = cs.class_id 
                JOIN subjects s ON s.id = cs.subject_id 
                JOIN teachers t ON t.id = cs.teacher_id 
                JOIN academic_years ay ON ay.id = c.academic_year_id
                WHERE t.user_id = ? AND ay.is_active = 1 
                ORDER BY FIELD(cs.day, "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"), cs.start_time';
        $stmt = db()->prepare($sql);
        $stmt->execute([$user_id]);
        return $stmt->fetchAll();
    }

    public static function forStudent(int $student_id): array {
        $sql = 'SELECT cs.id, s.name AS subject_name, t.name AS teacher_name, c.name AS class_name, cs.day, cs.start_time, cs.end_time 
                FROM class_subjects cs 
                JOIN subjects s ON s.id = cs.subject_id 
                JOIN teachers t ON t.id = cs.teacher_id
                JOIN classes c ON c.id = cs.class_id
                JOIN class_students cst ON cst.class_id = c.id
                JOIN academic_years ay ON ay.id = c.academic_year_id
                WHERE cst.student_id = ? AND ay.is_active = 1
                ORDER BY FIELD(cs.day, "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"), cs.start_time';
        $stmt = db()->prepare($sql);
        $stmt->execute([$student_id]);
        return $stmt->fetchAll();
    }
    public static function forClass(int $class_id): array {
        $sql = 'SELECT cs.id, s.name AS subject_name, cs.day, cs.start_time, cs.end_time FROM class_subjects cs JOIN subjects s ON s.id = cs.subject_id WHERE cs.class_id = ? ORDER BY FIELD(cs.day, "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"), cs.start_time';
        $stmt = db()->prepare($sql);
        $stmt->execute([$class_id]);
        return $stmt->fetchAll();
    }
    public static function forClassDetailed(int $class_id): array {
        $sql = 'SELECT cs.id, s.name AS subject_name, t.name AS teacher_name, cs.day, cs.start_time, cs.end_time FROM class_subjects cs JOIN subjects s ON s.id = cs.subject_id JOIN teachers t ON t.id = cs.teacher_id WHERE cs.class_id = ? ORDER BY FIELD(cs.day, "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"), cs.start_time';
        $stmt = db()->prepare($sql);
        $stmt->execute([$class_id]);
        return $stmt->fetchAll();
    }
    public static function unassign(int $id): void {
        $stmt = db()->prepare('DELETE FROM class_subjects WHERE id = ?');
        $stmt->execute([$id]);
    }
    public static function getClassId(int $id): int {
        $stmt = db()->prepare('SELECT class_id FROM class_subjects WHERE id = ?');
        $stmt->execute([$id]);
        $r = $stmt->fetch();
        return $r ? (int)$r['class_id'] : 0;
    }
}
?>