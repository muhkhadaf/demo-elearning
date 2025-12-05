<?php
require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../config/auth.php';
require_once __DIR__ . '/../models/ClassSubject.php';
require_once __DIR__ . '/../models/Material.php';
require_once __DIR__ . '/../models/Assignment.php';
require_once __DIR__ . '/../models/Submission.php';
require_once __DIR__ . '/../models/ClassStudent.php';
class StudentController {
    public static function handle(): void {
        require_role(['student']);
        $action = $_GET['action'] ?? 'dashboard';
        if ($action === 'subjects') { self::subjects(); return; }
        if ($action === 'materials') { self::materials(); return; }
        if ($action === 'assignments') { self::assignments(); return; }
        self::dashboard();
    }
    private static function dashboard(): void {
        // Get student ID from user_id
        $stmt = db()->prepare('SELECT id FROM students WHERE user_id = ?');
        $stmt->execute([$_SESSION['user_id']]);
        $student = $stmt->fetch();
        $student_id = $student ? (int)$student['id'] : 0;
        
        $list = $student_id ? ClassSubject::forStudent($student_id) : [];
        $content = BASE_PATH . '/views/student/dashboard.php';
        require BASE_PATH . '/views/layout.php';
    }
    private static function subjects(): void {
        $class_id = ClassStudent::classIdForStudent($_SESSION['user_id']);
        $list = $class_id ? ClassSubject::forClass($class_id) : [];
        $content = BASE_PATH . '/views/student/subjects.php';
        require BASE_PATH . '/views/layout.php';
    }
    private static function materials(): void {
        $cs_id = (int)($_GET['class_subject_id'] ?? 0);
        $materials = Material::forClassSubject($cs_id);
        $content = BASE_PATH . '/views/student/materials.php';
        require BASE_PATH . '/views/layout.php';
    }
    private static function assignments(): void {
        $cs_id = (int)($_GET['class_subject_id'] ?? 0);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $assignment_id = (int)($_POST['assignment_id'] ?? 0);
            $file = $_FILES['file'] ?? null;
            if ($assignment_id > 0 && $file && $file['error'] === UPLOAD_ERR_OK) {
                $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
                $allowed = ['pdf','ppt','pptx','png','jpg','jpeg','doc','docx','xls','xlsx','zip'];
                if (in_array($ext, $allowed, true)) {
                    $name = 'sub_' . time() . '_' . bin2hex(random_bytes(4)) . '.' . $ext;
                    $dest = UPLOADS_PATH . DIRECTORY_SEPARATOR . 'submissions' . DIRECTORY_SEPARATOR . $name;
                    move_uploaded_file($file['tmp_name'], $dest);
                    Submission::submit($assignment_id, $_SESSION['user_id'], $name);
                }
            }
            header('Location: index.php?page=student&action=assignments&class_subject_id=' . $cs_id);
            exit;
        }
        $assignments = Assignment::forClassSubject($cs_id);
        $subsByMe = Submission::forStudentAssignments($_SESSION['user_id']);
        $content = BASE_PATH . '/views/student/assignments.php';
        require BASE_PATH . '/views/layout.php';
    }
}
?>