<?php
require_once __DIR__ . '/../config/database.php';
class Material {
    public static function upload(int $class_subject_id, int $teacher_user_id, string $title, string $description, string $file_path): int {
        $sql = 'INSERT INTO materials (class_subject_id, teacher_id, title, description, file_path, created_at) VALUES (?, (SELECT t.id FROM teachers t WHERE t.user_id = ?), ?, ?, ?, NOW())';
        $stmt = db()->prepare($sql);
        $stmt->execute([$class_subject_id, $teacher_user_id, $title, $description, $file_path]);
        return (int)db()->lastInsertId();
    }
    public static function forClassSubject(int $class_subject_id): array {
        $stmt = db()->prepare('SELECT id, title, description, file_path, created_at FROM materials WHERE class_subject_id = ? ORDER BY created_at DESC');
        $stmt->execute([$class_subject_id]);
        return $stmt->fetchAll();
    }
}
?>