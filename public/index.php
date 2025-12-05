<?php
require_once __DIR__ . '/../config/app.php';
$page = $_GET['page'] ?? 'login';
if ($page === 'login') { require_once BASE_PATH . '/controllers/AuthController.php'; AuthController::index(); exit; }
if ($page === 'login_admin') { require_once BASE_PATH . '/controllers/AuthController.php'; AuthController::loginAdmin(); exit; }
if ($page === 'login_teacher') { require_once BASE_PATH . '/controllers/AuthController.php'; AuthController::loginTeacher(); exit; }
if ($page === 'login_student') { require_once BASE_PATH . '/controllers/AuthController.php'; AuthController::loginStudent(); exit; }
if ($page === 'logout') { require_once BASE_PATH . '/controllers/AuthController.php'; AuthController::logout(); exit; }
if ($page === 'admin') { require_once BASE_PATH . '/controllers/AdminController.php'; AdminController::handle(); exit; }
if ($page === 'teacher') { require_once BASE_PATH . '/controllers/TeacherController.php'; TeacherController::handle(); exit; }
if ($page === 'student') { require_once BASE_PATH . '/controllers/StudentController.php'; StudentController::handle(); exit; }
header('Location: index.php?page=login');
?>