<?php
require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../config/auth.php';
class AuthController {
    public static function index(): void {
        $content = BASE_PATH . '/views/auth/login.php';
        require BASE_PATH . '/views/layout.php';
    }

    private static function handleLogin(string $role, string $viewPath): void {
        // Ensure admin account exists if logging in as admin
        if ($role === 'admin') {
            $stmt = db()->query("SELECT COUNT(*) AS c FROM users WHERE role = 'admin'");
            $r = $stmt->fetch();
            if ((int)$r['c'] === 0) {
                $hash = password_hash('admin123', PASSWORD_BCRYPT);
                $s = db()->prepare('INSERT INTO users (username, password_hash, role) VALUES (?, ?, ?)');
                $s->execute(['admin', $hash, 'admin']);
            }
        }

        $error = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $password = trim($_POST['password'] ?? '');

            if (login($username, $password)) {
                $userRole = $_SESSION['role'] ?? '';
                
                if ($userRole !== $role) {
                    logout();
                    $error = 'Akun ini tidak terdaftar sebagai ' . ucfirst($role);
                } else {
                    header('Location: index.php?page=' . $role);
                    exit;
                }
            } else {
                $error = 'Username atau password salah';
            }
        }
        
        $content = BASE_PATH . $viewPath;
        require BASE_PATH . '/views/layout.php';
    }

    public static function loginAdmin(): void {
        self::handleLogin('admin', '/views/auth/login_admin.php');
    }

    public static function loginTeacher(): void {
        self::handleLogin('teacher', '/views/auth/login_teacher.php');
    }

    public static function loginStudent(): void {
        self::handleLogin('student', '/views/auth/login_student.php');
    }
    public static function logout(): void {
        logout();
        header('Location: index.php?page=login');
        exit;
    }
}
?>