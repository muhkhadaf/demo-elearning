<?php
require_once __DIR__ . '/../config/database.php';
class Submission {
    public static function submit(int $assignment_id, int $student_user_id, string $file_path): int {
        $sql = 'INSERT INTO submissions (assignment_id, student_id, file_path, submitted_at) VALUES (?, (SELECT s.id FROM students s WHERE s.user_id = ?), ?, NOW()) ON DUPLICATE KEY UPDATE file_path = VALUES(file_path), submitted_at = VALUES(submitted_at)';
        $stmt = db()->prepare($sql);
        $stmt->execute([$assignment_id, $student_user_id, $file_path]);
        return (int)db()->lastInsertId();
    }
    public static function forAssignment(int $assignment_id): array {
        $sql = 'SELECT sub.id, sub.file_path, sub.submitted_at, sub.score, sub.feedback, st.name AS student_name FROM submissions sub JOIN students st ON st.id = sub.student_id WHERE sub.assignment_id = ? ORDER BY sub.submitted_at DESC';
        $stmt = db()->prepare($sql);
        $stmt->execute([$assignment_id]);
        return $stmt->fetchAll();
    }
    public static function grade(int $submission_id, float $score, string $feedback): void {
        $stmt = db()->prepare('UPDATE submissions SET score = ?, feedback = ? WHERE id = ?');
        $stmt->execute([$score, $feedback, $submission_id]);
    }
    public static function forStudentAssignments(int $student_user_id): array {
        $sql = 'SELECT sb.assignment_id, sb.file_path, sb.score, sb.feedback FROM submissions sb JOIN students s ON s.id = sb.student_id WHERE s.user_id = ?';
        $stmt = db()->prepare($sql);
        $stmt->execute([$student_user_id]);
        $rows = $stmt->fetchAll();
        $out = [];
        foreach ($rows as $r) { $out[(int)$r['assignment_id']] = $r; }
        return $out;
    }
}
?>