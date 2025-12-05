<?php
require_once __DIR__ . '/../config/database.php';
class Assignment {
    public static function create(int $class_subject_id, int $teacher_user_id, string $title, string $description, string $due_date, ?string $attachment_path): int {
        $sql = 'INSERT INTO assignments (class_subject_id, teacher_id, title, description, due_date, attachment_path, created_at) VALUES (?, (SELECT t.id FROM teachers t WHERE t.user_id = ?), ?, ?, ?, ?, NOW())';
        $stmt = db()->prepare($sql);
        $stmt->execute([$class_subject_id, $teacher_user_id, $title, $description, $due_date !== '' ? $due_date : null, $attachment_path]);
        return (int)db()->lastInsertId();
    }
    public static function forClassSubject(int $class_subject_id): array {
        $stmt = db()->prepare('SELECT id, title, description, due_date, attachment_path, created_at FROM assignments WHERE class_subject_id = ? ORDER BY created_at DESC');
        $stmt->execute([$class_subject_id]);
        return $stmt->fetchAll();
    }
}
?>