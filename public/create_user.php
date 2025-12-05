<?php
require_once __DIR__ . '/../config/app.php';
require_once BASE_PATH . '/models/User.php';
require_once BASE_PATH . '/models/Teacher.php';
require_once BASE_PATH . '/models/Student.php';
$ip = $_SERVER['REMOTE_ADDR'] ?? '';
if (!in_array($ip, ['127.0.0.1','::1'], true)) { header('Location: index.php?page=login'); exit; }
$msg = null; $err = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $role = trim($_POST['role'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    try {
        if ($role === 'admin') {
            User::create($username, $password, 'admin');
            $msg = 'Admin created: ' . htmlspecialchars($username);
        } elseif ($role === 'teacher') {
            $tid = Teacher::create($name, $email, $username, $password);
            $msg = 'Teacher created: ' . htmlspecialchars($name) . ' (' . htmlspecialchars($username) . ')';
        } elseif ($role === 'student') {
            $sid = Student::create($name, $email, $username, $password);
            $msg = 'Student created: ' . htmlspecialchars($name) . ' (' . htmlspecialchars($username) . ')';
        } else {
            $err = 'Invalid role';
        }
    } catch (Throwable $e) {
        $err = 'Error: ' . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<script src="https://cdn.tailwindcss.com"></script>
<title>Create User</title>
</head>
<body class="bg-gray-50 min-h-screen">
<div class="max-w-md mx-auto mt-10 bg-white shadow rounded p-6">
  <div class="text-2xl font-semibold mb-4">Create User (Local)</div>
  <?php if ($msg): ?><div class="mb-3 p-3 bg-green-100 text-green-700 rounded"><?= $msg ?></div><?php endif; ?>
  <?php if ($err): ?><div class="mb-3 p-3 bg-red-100 text-red-700 rounded"><?= htmlspecialchars($err) ?></div><?php endif; ?>
  <form method="post" class="space-y-3">
    <div>
      <label class="block text-sm mb-1">Role</label>
      <select name="role" class="w-full border rounded px-3 py-2" required>
        <option value="admin">Admin</option>
        <option value="teacher">Teacher</option>
        <option value="student">Student</option>
      </select>
    </div>
    <div>
      <label class="block text-sm mb-1">Username</label>
      <input name="username" class="w-full border rounded px-3 py-2" required />
    </div>
    <div>
      <label class="block text-sm mb-1">Password</label>
      <input name="password" type="password" class="w-full border rounded px-3 py-2" required />
    </div>
    <div>
      <label class="block text-sm mb-1">Name (Teacher/Student)</label>
      <input name="name" class="w-full border rounded px-3 py-2" />
    </div>
    <div>
      <label class="block text-sm mb-1">Email (Teacher/Student)</label>
      <input name="email" type="email" class="w-full border rounded px-3 py-2" />
    </div>
    <div class="flex gap-2">
      <button class="px-4 py-2 bg-blue-600 text-white rounded">Create</button>
      <a href="index.php?page=login" class="px-4 py-2 bg-gray-200 rounded">Back</a>
    </div>
  </form>
</div>
</body>
</html>