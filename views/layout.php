<?php
require_once BASE_PATH . '/config/auth.php';
$u = current_user();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<script>
  tailwind.config = {
    theme: {
      extend: {
        fontFamily: { poppins: ['Poppins','ui-sans-serif','system-ui','sans-serif'] },
        colors: {
          brand: {
            50: '#f0fdfa',
            100: '#ccfbf1',
            200: '#99f6e4',
            300: '#5eead4',
            400: '#2dd4bf',
            500: '#14b8a6',
            600: '#0d9488',
            700: '#0f766e',
            800: '#115e59',
            900: '#134e4a',
            950: '#042f2e',
          },
          accent: {600:'#059669'}
        }
      }
    }
  }
</script>
<title>Aplikasi Manajemen Tugas & Jadwal</title>
</head>
<body class="bg-slate-50 min-h-screen font-poppins text-slate-900 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]">
<header class="bg-white/80 backdrop-blur-md shadow-sm sticky top-0 z-40 border-b border-slate-200/60" aria-label="Header">
  <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">
    <div class="flex items-center gap-3">
      <a id="backButton" aria-label="Kembali" href="#" data-role="<?= $u['role'] ?? '' ?>" class="inline-flex items-center gap-1 text-slate-500 hover:text-brand-600 transition-colors p-1 rounded-full hover:bg-brand-50">
        <i data-lucide="arrow-left" class="w-5 h-5"></i>
        <span class="sr-only">Kembali</span>
      </a>
      <a href="index.php?page=<?= $u && $u['role'] ? htmlspecialchars($u['role']) : 'login' ?>" class="flex items-center gap-2 group">
        <div class="w-8 h-8 bg-gradient-to-br from-brand-500 to-brand-700 rounded-lg flex items-center justify-center text-white shadow-lg shadow-brand-500/30 group-hover:scale-105 transition-transform">
            <i data-lucide="layout-grid" class="w-5 h-5"></i>
        </div>
        <span class="text-lg md:text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-brand-700 to-brand-500">Siakad MDT</span>
      </a>
    </div>
    <div class="flex items-center gap-4">
      <?php if ($u): ?>
        <div class="hidden sm:flex items-center gap-3 px-3 py-1.5 bg-slate-100/50 rounded-full border border-slate-200/60">
          <div class="w-8 h-8 rounded-full bg-brand-100 text-brand-700 flex items-center justify-center">
            <i data-lucide="user" class="w-4 h-4"></i>
          </div>
          <div class="flex flex-col leading-none mr-2">
             <span class="text-sm font-semibold text-slate-700"><?= htmlspecialchars($u['username']) ?></span>
             <span class="text-xs text-slate-500 capitalize"><?= htmlspecialchars($u['role']) ?></span>
          </div>
        </div>
        <a href="index.php?page=logout" class="inline-flex items-center gap-2 px-4 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 hover:text-red-700 focus:outline-none focus:ring-2 focus:ring-red-400 transition-all font-medium text-sm" aria-label="Keluar">
          <i data-lucide="log-out" class="w-4 h-4"></i>
          <span class="hidden sm:inline">Keluar</span>
        </a>
      <?php endif; ?>
    </div>
  </div>
</header>
<?php if ($u && $u['role'] === 'admin'): ?>
  <div class="flex pt-0">
    <aside class="w-64 fixed inset-y-0 left-0 top-[65px] bg-white border-r border-slate-200 hidden md:block overflow-y-auto pb-20 z-30">
      <nav class="p-4 space-y-1">
        <?php
        $menu = [
            ['url' => 'index.php?page=admin', 'icon' => 'layout-dashboard', 'label' => 'Dashboard'],
            ['url' => 'index.php?page=admin&resource=academic_years', 'icon' => 'calendar', 'label' => 'Tahun Ajaran'],
            ['url' => 'index.php?page=admin&resource=classes', 'icon' => 'school', 'label' => 'Data Kelas'],
            ['url' => 'index.php?page=admin&resource=subjects', 'icon' => 'book-open', 'label' => 'Mata Pelajaran'],
            ['url' => 'index.php?page=admin&resource=teachers', 'icon' => 'users', 'label' => 'Data Guru'],
            ['url' => 'index.php?page=admin&resource=students', 'icon' => 'user-plus', 'label' => 'Data Siswa'],
            ['url' => 'index.php?page=admin&resource=teaching_assignments', 'icon' => 'clipboard-list', 'label' => 'Pengampu Mapel'],
            ['url' => 'index.php?page=admin&resource=class_builder', 'icon' => 'wrench', 'label' => 'Pembuat Kelas'],
            ['url' => 'index.php?page=admin&resource=class_roster', 'icon' => 'list', 'label' => 'Daftar Kelas'],
        ];
        $currentUrl = 'index.php?' . $_SERVER['QUERY_STRING'];
        ?>
        <?php foreach ($menu as $item): ?>
          <?php $isActive = strpos($currentUrl, $item['url']) !== false || ($item['url'] === 'index.php?page=admin' && $currentUrl === 'index.php?page=admin'); ?>
          <a href="<?= $item['url'] ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-200 <?= $isActive ? 'bg-brand-50 text-brand-700 font-medium shadow-sm' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' ?>">
            <i data-lucide="<?= $item['icon'] ?>" class="w-5 h-5 <?= $isActive ? 'text-brand-600' : 'text-slate-400' ?>"></i>
            <span><?= $item['label'] ?></span>
          </a>
        <?php endforeach; ?>
      </nav>
    </aside>
    <main class="flex-1 ml-0 md:ml-64 p-6 min-h-[calc(100vh-65px)]">
      <?php if (isset($error) && $error): ?>
        <div class="mb-4 flex items-center gap-2 p-3 bg-red-100 text-red-700 rounded-lg border border-red-200" role="alert">
          <i data-lucide="alert-circle" class="w-5 h-5"></i>
          <span><?= htmlspecialchars($error) ?></span>
        </div>
      <?php endif; ?>
      <?php require $content; ?>
    </main>
  </div>
<?php else: ?>
  <main class="max-w-7xl mx-auto px-4 py-6">
    <?php if (isset($error) && $error): ?>
      <div class="mb-4 flex items-center gap-2 p-3 bg-red-100 text-red-700 rounded" role="alert">
        <i data-lucide="alert-circle" class="w-4 h-4"></i>
        <span><?= htmlspecialchars($error) ?></span>
      </div>
    <?php endif; ?>
    <?php require $content; ?>
  </main>
<?php endif; ?>
<script src="https://unpkg.com/lucide@latest"></script>
<script src="js/app.js"></script>
</body>
</html>