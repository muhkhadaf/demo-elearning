<?php
require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../config/auth.php';
require_once __DIR__ . '/../models/ClassSubject.php';
require_once __DIR__ . '/../models/Material.php';
require_once __DIR__ . '/../models/Assignment.php';
require_once __DIR__ . '/../models/Submission.php';
class TeacherController {
    public static function handle(): void {
        require_role(['teacher']);
        $action = $_GET['action'] ?? 'dashboard';
        if ($action === 'materials') { self::materials(); return; }
        if ($action === 'assignments') { self::assignments(); return; }
        if ($action === 'submissions') { self::submissions(); return; }
        if ($action === 'students') { self::students(); return; }
        self::dashboard();
    }
    private static function dashboard(): void {
        $list = ClassSubject::forTeacher($_SESSION['user_id']);
        $content = BASE_PATH . '/views/teacher/dashboard.php';
        require BASE_PATH . '/views/layout.php';
    }
    private static function materials(): void {
        $cs_id = (int)($_GET['class_subject_id'] ?? 0);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title'] ?? '');
            $description = trim($_POST['description'] ?? '');
            $file = $_FILES['file'] ?? null;
            if ($cs_id > 0 && $file && $file['error'] === UPLOAD_ERR_OK) {
                $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
                $allowed = ['pdf','ppt','pptx','png','jpg','jpeg','doc','docx','xls','xlsx'];
                if (in_array($ext, $allowed, true)) {
                    $name = 'mat_' . time() . '_' . bin2hex(random_bytes(4)) . '.' . $ext;
                    $dest = UPLOADS_PATH . DIRECTORY_SEPARATOR . 'materials' . DIRECTORY_SEPARATOR . $name;
                    move_uploaded_file($file['tmp_name'], $dest);
                    Material::upload($cs_id, $_SESSION['user_id'], $title, $description, $name);
                }
            }
            header('Location: index.php?page=teacher&action=materials&class_subject_id=' . $cs_id);
            exit;
        }
        $materials = Material::forClassSubject($cs_id);
        $content = BASE_PATH . '/views/teacher/materials.php';
        require BASE_PATH . '/views/layout.php';
    }
    private static function assignments(): void {
        $cs_id = (int)($_GET['class_subject_id'] ?? 0);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title'] ?? '');
            $description = trim($_POST['description'] ?? '');
            $due = trim($_POST['due_date'] ?? '');
            $file = $_FILES['attachment'] ?? null;
            $attachment = null;
            if ($file && $file['error'] === UPLOAD_ERR_OK) {
                $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
                $allowed = ['pdf','ppt','pptx','png','jpg','jpeg','doc','docx','xls','xlsx'];
                if (in_array($ext, $allowed, true)) {
                    $name = 'asg_' . time() . '_' . bin2hex(random_bytes(4)) . '.' . $ext;
                    $dest = UPLOADS_PATH . DIRECTORY_SEPARATOR . 'materials' . DIRECTORY_SEPARATOR . $name;
                    move_uploaded_file($file['tmp_name'], $dest);
                    $attachment = $name;
                }
            }
            if ($cs_id > 0 && $title !== '') { Assignment::create($cs_id, $_SESSION['user_id'], $title, $description, $due, $attachment); }
            header('Location: index.php?page=teacher&action=assignments&class_subject_id=' . $cs_id);
            exit;
        }
        $assignments = Assignment::forClassSubject($cs_id);
        $content = BASE_PATH . '/views/teacher/assignments.php';
        require BASE_PATH . '/views/layout.php';
    }
    private static function submissions(): void {
        $assignment_id = (int)($_GET['assignment_id'] ?? 0);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = (int)($_POST['submission_id'] ?? 0);
            $score = (float)($_POST['score'] ?? 0);
            $feedback = trim($_POST['feedback'] ?? '');
            if ($id > 0) { Submission::grade($id, $score, $feedback); }
            header('Location: index.php?page=teacher&action=submissions&assignment_id=' . $assignment_id);
            exit;
        }
        $subs = Submission::forAssignment($assignment_id);
        $content = BASE_PATH . '/views/teacher/submissions.php';
        require BASE_PATH . '/views/layout.php';
    }
    private static function students(): void {
        require_once __DIR__ . '/../models/ClassStudent.php';
        $cs_id = (int)($_GET['class_subject_id'] ?? 0);
        $class_id = ClassSubject::getClassId($cs_id);
        $students = ClassStudent::listByClass($class_id);
        $content = BASE_PATH . '/views/teacher/students.php';
        require BASE_PATH . '/views/layout.php';
    }
}
?>