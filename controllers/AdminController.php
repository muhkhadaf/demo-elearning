<?php
require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../config/auth.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Teacher.php';
require_once __DIR__ . '/../models/Student.php';
require_once __DIR__ . '/../models/AcademicYear.php';
require_once __DIR__ . '/../models/SchoolClass.php';
require_once __DIR__ . '/../models/Subject.php';
require_once __DIR__ . '/../models/ClassStudent.php';
require_once __DIR__ . '/../models/ClassSubject.php';
class AdminController {
    public static function handle(): void {
        require_role(['admin']);
        $resource = $_GET['resource'] ?? 'dashboard';
        if ($resource === 'academic_years') { self::academic_years(); return; }
        if ($resource === 'classes') { self::classes(); return; }
        if ($resource === 'subjects') { self::subjects(); return; }
        if ($resource === 'teachers') { self::teachers(); return; }
        if ($resource === 'students') { self::students(); return; }
        if ($resource === 'teaching_assignments') { self::teaching_assignments(); return; }
        if ($resource === 'class_builder') { self::class_builder(); return; }
        if ($resource === 'class_roster') { self::class_roster(); return; }
        self::dashboard();
    }
    private static function dashboard(): void {
        $counts = [
            'teachers' => Teacher::count(),
            'students' => Student::count(),
            'classes' => SchoolClass::count(),
            'subjects' => Subject::count(),
        ];
        $content = BASE_PATH . '/views/admin/dashboard.php';
        require BASE_PATH . '/views/layout.php';
    }
    private static function academic_years(): void {
        $edit = null;

        if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
            AcademicYear::delete((int)$_GET['id']);
            header('Location: index.php?page=admin&resource=academic_years');
            exit;
        }

        if (isset($_GET['action']) && $_GET['action'] === 'edit' && isset($_GET['id'])) {
            $edit = AcademicYear::find((int)$_GET['id']);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['set_active_id'])) { 
                AcademicYear::setActive((int)$_POST['set_active_id']);
                header('Location: index.php?page=admin&resource=academic_years');
                exit;
            }

            $label = trim($_POST['label'] ?? '');
            $active = isset($_POST['is_active']) ? 1 : 0;
            $id = (int)($_POST['id'] ?? 0);

            if ($label !== '') { 
                if ($id > 0) {
                    AcademicYear::update($id, $label, $active === 1);
                } else {
                    AcademicYear::create($label, $active === 1); 
                }
            }
            header('Location: index.php?page=admin&resource=academic_years');
            exit;
        }
        $years = AcademicYear::all();
        $content = BASE_PATH . '/views/admin/academic_years.php';
        require BASE_PATH . '/views/layout.php';
    }
    private static function classes(): void {
        $edit = null;

        if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
            SchoolClass::delete((int)$_GET['id']);
            header('Location: index.php?page=admin&resource=classes');
            exit;
        }

        if (isset($_GET['action']) && $_GET['action'] === 'edit' && isset($_GET['id'])) {
            $edit = SchoolClass::find((int)$_GET['id']);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $year_id = (int)($_POST['academic_year_id'] ?? 0);
            $wali = (int)($_POST['homeroom_teacher_id'] ?? 0);
            $id = (int)($_POST['id'] ?? 0);

            if ($name !== '' && $year_id > 0) { 
                if ($id > 0) {
                    SchoolClass::update($id, $name, $year_id, $wali);
                } else {
                    SchoolClass::create($name, $year_id, $wali); 
                }
            }
            header('Location: index.php?page=admin&resource=classes');
            exit;
        }
        $years = AcademicYear::all();
        $teachers = Teacher::all();
        $classes = SchoolClass::allWithYearTeacher();
        $content = BASE_PATH . '/views/admin/classes.php';
        require BASE_PATH . '/views/layout.php';
    }
    private static function subjects(): void {
        $edit = null;
        
        if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
            Subject::delete((int)$_GET['id']);
            header('Location: index.php?page=admin&resource=subjects');
            exit;
        }

        if (isset($_GET['action']) && $_GET['action'] === 'edit' && isset($_GET['id'])) {
            $edit = Subject::find((int)$_GET['id']);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $id = (int)($_POST['id'] ?? 0);
            
            if ($name !== '') {
                if ($id > 0) {
                    Subject::update($id, $name);
                } else {
                    Subject::create($name);
                }
            }
            header('Location: index.php?page=admin&resource=subjects');
            exit;
        }
        
        $subjects = Subject::all();
        $content = BASE_PATH . '/views/admin/subjects.php';
        require BASE_PATH . '/views/layout.php';
    }
    private static function teachers(): void {
        $edit = null;

        if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
            Teacher::delete((int)$_GET['id']);
            header('Location: index.php?page=admin&resource=teachers');
            exit;
        }

        if (isset($_GET['action']) && $_GET['action'] === 'edit' && isset($_GET['id'])) {
            $edit = Teacher::find((int)$_GET['id']);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $nip = trim($_POST['nip'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $username = trim($_POST['username'] ?? '');
            $password = trim($_POST['password'] ?? '');
            $id = (int)($_POST['id'] ?? 0);

            if ($name !== '' && $username !== '') { 
                if ($id > 0) {
                    Teacher::update($id, $name, $nip, $email, $username, $password);
                } else {
                    if ($password !== '') {
                        Teacher::create($name, $nip, $email, $username, $password);
                    }
                }
            }
            header('Location: index.php?page=admin&resource=teachers');
            exit;
        }
        $teachers = Teacher::allWithUser();
        $content = BASE_PATH . '/views/admin/teachers.php';
        require BASE_PATH . '/views/layout.php';
    }
    private static function students(): void {
        $edit = null;

        if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
            Student::delete((int)$_GET['id']);
            header('Location: index.php?page=admin&resource=students');
            exit;
        }

        if (isset($_GET['action']) && $_GET['action'] === 'edit' && isset($_GET['id'])) {
            $edit = Student::find((int)$_GET['id']);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $nis = trim($_POST['nis'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $username = trim($_POST['username'] ?? '');
            $password = trim($_POST['password'] ?? '');
            $class_id = (int)($_POST['class_id'] ?? 0);
            $id = (int)($_POST['id'] ?? 0);

            if ($name !== '' && $username !== '') { 
                if ($id > 0) {
                    Student::update($id, $name, $nis, $email, $username, $password);
                    // Handle class assignment update if needed (simplified for now)
                    if ($class_id > 0) {
                        // Remove old assignment and add new one, or update existing
                        // For simplicity, we'll just add if not exists, but ideally we should manage this better
                        // Current ClassStudent model might need update
                        ClassStudent::add($class_id, $id); 
                    }
                } else {
                    if ($password !== '') {
                        $sid = Student::create($name, $nis, $email, $username, $password);
                        if ($class_id > 0) { ClassStudent::add($class_id, $sid); }
                    }
                }
            }
            header('Location: index.php?page=admin&resource=students');
            exit;
        }
        $students = Student::allWithUser();
        $classes = SchoolClass::all();
        $content = BASE_PATH . '/views/admin/students.php';
        require BASE_PATH . '/views/layout.php';
    }
    private static function teaching_assignments(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $class_id = (int)($_POST['class_id'] ?? 0);
            $subject_id = (int)($_POST['subject_id'] ?? 0);
            $teacher_id = (int)($_POST['teacher_id'] ?? 0);
            $day = $_POST['day'] ?? null;
            $start = $_POST['start_time'] ?? null;
            $end = $_POST['end_time'] ?? null;
            if ($class_id > 0 && $subject_id > 0 && $teacher_id > 0) { ClassSubject::assign($class_id, $subject_id, $teacher_id, $day, $start, $end); }
            header('Location: index.php?page=admin&resource=teaching_assignments');
            exit;
        }
        $classes = SchoolClass::all();
        $subjects = Subject::all();
        $teachers = Teacher::all();
        $assignments = ClassSubject::allDetailed();
        $content = BASE_PATH . '/views/admin/teaching_assignments.php';
        require BASE_PATH . '/views/layout.php';
    }
    private static function class_builder(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'] ?? '';
            $year_id = (int)($_POST['academic_year_id'] ?? 0);
            $class_id = (int)($_POST['class_id'] ?? 0);
            if ($action === 'create_class') {
                $name = trim($_POST['name'] ?? '');
                $homeroom = (int)($_POST['homeroom_teacher_id'] ?? 0);
                if ($name !== '' && $year_id > 0) { $class_id = SchoolClass::create($name, $year_id, $homeroom); }
                header('Location: index.php?page=admin&resource=class_builder&academic_year_id=' . $year_id . '&class_id=' . $class_id);
                exit;
            }
            if ($action === 'update_homeroom') {
                $homeroom = (int)($_POST['homeroom_teacher_id'] ?? 0);
                if ($class_id > 0) { SchoolClass::updateHomeroom($class_id, $homeroom ?: null); }
                header('Location: index.php?page=admin&resource=class_builder&academic_year_id=' . $year_id . '&class_id=' . $class_id);
                exit;
            }
            if ($action === 'add_student') {
                $student_id = (int)($_POST['student_id'] ?? 0);
                if ($class_id > 0 && $student_id > 0) { ClassStudent::add($class_id, $student_id); }
                header('Location: index.php?page=admin&resource=class_builder&academic_year_id=' . $year_id . '&class_id=' . $class_id);
                exit;
            }
            if ($action === 'remove_student') {
                $student_id = (int)($_POST['student_id'] ?? 0);
                if ($class_id > 0 && $student_id > 0) { ClassStudent::remove($class_id, $student_id); }
                header('Location: index.php?page=admin&resource=class_builder&academic_year_id=' . $year_id . '&class_id=' . $class_id);
                exit;
            }
            if ($action === 'add_assignment') {
                $subject_id = (int)($_POST['subject_id'] ?? 0);
                $teacher_id = (int)($_POST['teacher_id'] ?? 0);
                $day = $_POST['day'] ?? null;
                $start = $_POST['start_time'] ?? null;
                $end = $_POST['end_time'] ?? null;
                if ($class_id > 0 && $subject_id > 0 && $teacher_id > 0) { ClassSubject::assign($class_id, $subject_id, $teacher_id, $day, $start, $end); }
                header('Location: index.php?page=admin&resource=class_builder&academic_year_id=' . $year_id . '&class_id=' . $class_id);
                exit;
            }
            if ($action === 'remove_assignment') {
                $id = (int)($_POST['class_subject_id'] ?? 0);
                if ($id > 0) { ClassSubject::unassign($id); }
                header('Location: index.php?page=admin&resource=class_builder&academic_year_id=' . $year_id . '&class_id=' . $class_id);
                exit;
            }
        }
        $years = AcademicYear::all();
        $selected_year_id = isset($_GET['academic_year_id']) ? (int)$_GET['academic_year_id'] : (AcademicYear::activeId() ?? (count($years) ? (int)$years[0]['id'] : 0));
        $classes = $selected_year_id ? SchoolClass::byYear($selected_year_id) : [];
        $selected_class_id = isset($_GET['class_id']) ? (int)$_GET['class_id'] : (count($classes) ? (int)$classes[0]['id'] : 0);
        $teachers = Teacher::all();
        $students_all = Student::all();
        $students_in_class = $selected_class_id ? ClassStudent::listByClass($selected_class_id) : [];
        $assigned_ids = array_map(fn($s) => (int)$s['id'], $students_in_class);
        $students_available = array_values(array_filter($students_all, fn($s) => !in_array((int)$s['id'], $assigned_ids, true)));
        $subjects = Subject::all();
        $assignments = $selected_class_id ? ClassSubject::forClassDetailed($selected_class_id) : [];
        $content = BASE_PATH . '/views/admin/class_builder.php';
        require BASE_PATH . '/views/layout.php';
    }
    private static function class_roster(): void {
        $years = AcademicYear::all();
        $selected_year_id = isset($_GET['academic_year_id']) ? (int)$_GET['academic_year_id'] : (AcademicYear::activeId() ?? 0);
        $classes = $selected_year_id ? SchoolClass::byYearDetailed($selected_year_id) : SchoolClass::allWithYearTeacher();
        $rosters = [];
        foreach ($classes as $c) {
            $rosters[] = [
                'class' => $c,
                'students' => ClassStudent::listByClass((int)$c['id'])
            ];
        }
        $content = BASE_PATH . '/views/admin/class_roster.php';
        require BASE_PATH . '/views/layout.php';
    }
}
?>