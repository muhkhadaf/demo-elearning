<div class="max-w-7xl mx-auto">
  <div class="mb-6">
    <h2 class="text-2xl font-bold text-slate-800">Kelas Saya</h2>
    <p class="text-slate-500 mt-1">Kelola materi dan tugas untuk setiap kelas</p>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <?php if (empty($list)): ?>
      <div class="col-span-full flex flex-col items-center justify-center py-12 text-center bg-white rounded-2xl border border-slate-200 border-dashed">
        <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mb-4">
          <i data-lucide="calendar-off" class="w-8 h-8 text-slate-400"></i>
        </div>
        <h3 class="text-lg font-medium text-slate-900 mb-1">Tidak Ada Jadwal Aktif</h3>
        <p class="text-slate-500 max-w-md mx-auto">
          Anda belum memiliki jadwal mengajar untuk tahun ajaran aktif saat ini. Silakan hubungi administrator jika ini adalah kesalahan.
        </p>
      </div>
    <?php else: ?>
      <?php foreach ($list as $row): ?>
        <div class="group bg-gradient-to-br from-white to-slate-50 rounded-2xl p-6 shadow-sm hover:shadow-2xl transition-all duration-300 border border-slate-100 hover:border-brand-200 hover:-translate-y-1">
          <!-- Header with Icon -->
          <div class="flex items-start justify-between mb-4">
            <div class="p-3 bg-gradient-to-br from-brand-500 to-brand-600 rounded-xl shadow-lg shadow-brand-500/30 group-hover:scale-110 transition-transform">
              <i data-lucide="graduation-cap" class="w-6 h-6 text-white"></i>
            </div>
            <span class="px-3 py-1 text-xs font-medium bg-green-100 text-green-700 rounded-full">Aktif</span>
          </div>
          
          <!-- Class Info -->
          <div class="mb-6">
            <h3 class="text-lg font-bold text-slate-800 mb-2 group-hover:text-brand-700 transition-colors flex items-center gap-2">
              <i data-lucide="school" class="w-5 h-5"></i>
              <?= htmlspecialchars($row['class_name']) ?>
            </h3>
            <div class="space-y-1">
              <p class="text-sm text-slate-600 flex items-center gap-2">
                <i data-lucide="book-open" class="w-4 h-4 text-brand-500"></i>
                <?= htmlspecialchars($row['subject_name']) ?>
              </p>
              <?php if (!empty($row['day'])): ?>
                <p class="text-sm text-slate-500 flex items-center gap-2">
                  <i data-lucide="clock" class="w-4 h-4 text-blue-500"></i>
                  <span><?= htmlspecialchars($row['day']) ?>, <?= substr($row['start_time'], 0, 5) ?> - <?= substr($row['end_time'], 0, 5) ?></span>
                </p>
              <?php endif; ?>
            </div>
          </div>
          
          <!-- Action Buttons -->
          <div class="flex gap-2">
            <a href="index.php?page=teacher&action=materials&class_subject_id=<?= (int)$row['id'] ?>" class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-white border border-slate-200 text-slate-700 hover:border-brand-500 hover:text-brand-600 rounded-xl transition-all text-sm font-medium shadow-sm hover:shadow group/btn">
              <i data-lucide="file-text" class="w-4 h-4 group-hover/btn:scale-110 transition-transform"></i>
              <span>Materi</span>
            </a>
            <a href="index.php?page=teacher&action=assignments&class_subject_id=<?= (int)$row['id'] ?>" class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 text-white rounded-xl transition-all text-sm font-medium shadow-lg shadow-purple-500/30 group/btn">
              <i data-lucide="clipboard-list" class="w-4 h-4 group-hover/btn:scale-110 transition-transform"></i>
              <span>Tugas</span>
            </a>
          </div>
          <div class="mt-2">
               <a href="index.php?page=teacher&action=students&class_subject_id=<?= (int)$row['id'] ?>" class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-slate-50 border border-slate-200 text-slate-600 hover:bg-slate-100 hover:text-slate-800 rounded-xl transition-all text-sm font-medium shadow-sm hover:shadow">
                  <i data-lucide="users" class="w-4 h-4"></i>
                  <span>Lihat Siswa</span>
               </a>
          </div>
        </div>
      <?php foreach ($list as $row): ?>
        <div class="group bg-gradient-to-br from-white to-slate-50 rounded-2xl p-6 shadow-sm hover:shadow-2xl transition-all duration-300 border border-slate-100 hover:border-brand-200 hover:-translate-y-1">
          <!-- Header with Icon -->
          <div class="flex items-start justify-between mb-4">
            <div class="p-3 bg-gradient-to-br from-brand-500 to-brand-600 rounded-xl shadow-lg shadow-brand-500/30 group-hover:scale-110 transition-transform">
              <i data-lucide="graduation-cap" class="w-6 h-6 text-white"></i>
            </div>
            <span class="px-3 py-1 text-xs font-medium bg-green-100 text-green-700 rounded-full">Aktif</span>
          </div>
          
          <!-- Class Info -->
          <div class="mb-6">
            <h3 class="text-lg font-bold text-slate-800 mb-2 group-hover:text-brand-700 transition-colors flex items-center gap-2">
              <i data-lucide="school" class="w-5 h-5"></i>
              <?= htmlspecialchars($row['class_name']) ?>
            </h3>
            <div class="space-y-1">
              <p class="text-sm text-slate-600 flex items-center gap-2">
                <i data-lucide="book-open" class="w-4 h-4 text-brand-500"></i>
                <?= htmlspecialchars($row['subject_name']) ?>
              </p>
              <?php if (!empty($row['day'])): ?>
                <p class="text-sm text-slate-500 flex items-center gap-2">
                  <i data-lucide="clock" class="w-4 h-4 text-blue-500"></i>
                  <span><?= htmlspecialchars($row['day']) ?>, <?= substr($row['start_time'], 0, 5) ?> - <?= substr($row['end_time'], 0, 5) ?></span>
                </p>
              <?php endif; ?>
            </div>
          </div>
          
          <!-- Action Buttons -->
          <div class="flex gap-2">
            <a href="index.php?page=teacher&action=materials&class_subject_id=<?= (int)$row['id'] ?>" class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-white border border-slate-200 text-slate-700 hover:border-brand-500 hover:text-brand-600 rounded-xl transition-all text-sm font-medium shadow-sm hover:shadow group/btn">
              <i data-lucide="file-text" class="w-4 h-4 group-hover/btn:scale-110 transition-transform"></i>
              <span>Materi</span>
            </a>
            <a href="index.php?page=teacher&action=assignments&class_subject_id=<?= (int)$row['id'] ?>" class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 text-white rounded-xl transition-all text-sm font-medium shadow-lg shadow-purple-500/30 group/btn">
              <i data-lucide="clipboard-list" class="w-4 h-4 group-hover/btn:scale-110 transition-transform"></i>
              <span>Tugas</span>
            </a>
          </div>
          <div class="mt-2">
               <a href="index.php?page=teacher&action=students&class_subject_id=<?= (int)$row['id'] ?>" class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-slate-50 border border-slate-200 text-slate-600 hover:bg-slate-100 hover:text-slate-800 rounded-xl transition-all text-sm font-medium shadow-sm hover:shadow">
                  <i data-lucide="users" class="w-4 h-4"></i>
                  <span>Lihat Siswa</span>
               </a>
          </div>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</div>