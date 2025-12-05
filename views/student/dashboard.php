<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
  <?php if (empty($list)): ?>
    <div class="col-span-full flex flex-col items-center justify-center py-12 text-center bg-white rounded-2xl border border-slate-200 border-dashed">
      <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mb-4">
        <i data-lucide="calendar-off" class="w-8 h-8 text-slate-400"></i>
      </div>
      <h3 class="text-lg font-medium text-slate-900 mb-1">Tidak Ada Jadwal Aktif</h3>
      <p class="text-slate-500 max-w-md mx-auto">
        Anda belum terdaftar dalam kelas manapun untuk tahun ajaran aktif saat ini. Silahkan hubungi admin atau guru yang mengajar Anda untuk mendaftarkan Anda ke dalam kelas.
      </p>
    </div>
  <?php else: ?>
    <?php foreach ($list as $row): ?>
      <div class="group bg-white rounded-2xl p-6 shadow-sm hover:shadow-xl transition-all duration-300 border border-slate-100 hover:-translate-y-1">
        <div class="flex items-start justify-between mb-4">
          <div class="p-3 bg-brand-50 rounded-xl group-hover:bg-brand-100 transition-colors">
              <i data-lucide="book-open" class="w-6 h-6 text-brand-600"></i>
          </div>
          <span class="px-3 py-1 text-xs font-medium bg-slate-100 text-slate-600 rounded-full">Active</span>
        </div>
        
        <h3 class="text-lg font-bold text-slate-800 mb-1 group-hover:text-brand-700 transition-colors"><?= htmlspecialchars($row['subject_name']) ?></h3>
      
      <!-- Teacher Name & Schedule -->
      <div class="mb-4 space-y-1">
        <div class="flex items-center gap-2 text-sm text-slate-500">
          <i data-lucide="user" class="w-4 h-4"></i>
          <span><?= htmlspecialchars($row['teacher_name'] ?? 'No Teacher') ?></span>
        </div>
        <?php if (!empty($row['day'])): ?>
          <div class="flex items-center gap-2 text-sm text-slate-500">
            <i data-lucide="clock" class="w-4 h-4 text-blue-500"></i>
            <span><?= htmlspecialchars($row['day']) ?>, <?= substr($row['start_time'], 0, 5) ?> - <?= substr($row['end_time'], 0, 5) ?></span>
          </div>
        <?php endif; ?>
      </div>
        
        <div class="flex gap-3">
          <a href="index.php?page=student&action=materials&class_subject_id=<?= (int)$row['id'] ?>" class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-white border border-slate-200 text-slate-700 hover:border-brand-500 hover:text-brand-600 rounded-xl transition-all text-sm font-medium shadow-sm hover:shadow">
              <i data-lucide="file-text" class="w-4 h-4"></i>
              <span>Materi</span>
          </a>
          <a href="index.php?page=student&action=assignments&class_subject_id=<?= (int)$row['id'] ?>" class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-brand-600 hover:bg-brand-700 text-white rounded-xl transition-all text-sm font-medium shadow-lg shadow-brand-500/20">
              <i data-lucide="clipboard-list" class="w-4 h-4"></i>
              <span>Tugas</span>
          </a>
        </div>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>
</div>