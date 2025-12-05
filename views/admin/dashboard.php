<?php $cards = [
  ['label' => 'Guru', 'value' => (int)$counts['teachers'], 'color' => 'text-indigo-600', 'bg' => 'bg-indigo-50', 'icon' => 'users'],
  ['label' => 'Siswa', 'value' => (int)$counts['students'], 'color' => 'text-emerald-600', 'bg' => 'bg-emerald-50', 'icon' => 'graduation-cap'],
  ['label' => 'Kelas', 'value' => (int)$counts['classes'], 'color' => 'text-blue-600', 'bg' => 'bg-blue-50', 'icon' => 'school'],
  ['label' => 'Mata Pelajaran', 'value' => (int)$counts['subjects'], 'color' => 'text-purple-600', 'bg' => 'bg-purple-50', 'icon' => 'book-open'],
]; ?>

<div class="mb-8">
    <h1 class="text-2xl font-bold text-slate-800 mb-2">Dashboard Admin</h1>
    <p class="text-slate-500">Ringkasan data dan statistik sekolah</p>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
  <?php foreach ($cards as $c): ?>
    <div class="bg-white rounded-2xl p-6 shadow-[0_2px_10px_rgb(0,0,0,0.03)] border border-slate-100 hover:shadow-lg transition-all duration-300">
      <div class="flex items-center justify-between mb-4">
        <div class="p-3 rounded-xl <?= $c['bg'] ?> <?= $c['color'] ?>">
            <i data-lucide="<?= $c['icon'] ?>" class="w-6 h-6"></i>
        </div>
        <span class="text-xs font-medium text-slate-400 bg-slate-50 px-2 py-1 rounded-lg">Total</span>
      </div>
      <div class="text-3xl font-bold text-slate-800 mb-1"><?= (int)$c['value'] ?></div>
      <div class="text-sm text-slate-500 font-medium"><?= htmlspecialchars($c['label']) ?></div>
    </div>
  <?php endforeach; ?>
</div>

<!-- Recent Activity or Quick Actions could go here -->
<div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100">
    <h2 class="text-lg font-bold text-slate-800 mb-4">Informasi Sistem</h2>
    <div class="prose prose-slate">
        <p>Selamat datang di panel administrasi Siakad MDT. Gunakan sidebar di sebelah kiri untuk mengelola data master dan aktivitas akademik.</p>
    </div>
</div>