<div class="max-w-7xl mx-auto">
  <div class="mb-6 flex items-center justify-between">
    <div>
      <h2 class="text-2xl font-bold text-slate-800">Tugas Kelas</h2>
      <p class="text-slate-500 mt-1">Kelola tugas untuk siswa</p>
    </div>
    <a href="index.php?page=teacher" class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-slate-200 text-slate-700 rounded-xl hover:bg-slate-50 transition-colors">
      <i data-lucide="arrow-left" class="w-4 h-4"></i>
      Kembali
    </a>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Create Assignment Form -->
    <div class="lg:col-span-1">
      <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 sticky top-6">
        <h3 class="text-lg font-bold text-slate-800 mb-4 flex items-center gap-2">
          <i data-lucide="plus-circle" class="w-5 h-5 text-brand-500"></i>
          Buat Tugas Baru
        </h3>
        
        <form action="" method="POST" enctype="multipart/form-data" class="space-y-4">
          <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Judul Tugas</label>
            <input type="text" name="title" required class="w-full px-4 py-2 rounded-xl border border-slate-200 focus:border-brand-500 focus:ring-2 focus:ring-brand-200 outline-none transition-all">
          </div>
          
          <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Deskripsi</label>
            <textarea name="description" rows="3" required class="w-full px-4 py-2 rounded-xl border border-slate-200 focus:border-brand-500 focus:ring-2 focus:ring-brand-200 outline-none transition-all"></textarea>
          </div>

          <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Tenggat Waktu</label>
            <input type="datetime-local" name="due_date" required class="w-full px-4 py-2 rounded-xl border border-slate-200 focus:border-brand-500 focus:ring-2 focus:ring-brand-200 outline-none transition-all">
          </div>
          
          <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">File Lampiran (Opsional)</label>
            <div class="relative">
              <input type="file" name="attachment" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-brand-50 file:text-brand-700 hover:file:bg-brand-100 transition-all">
            </div>
            <p class="text-xs text-slate-400 mt-1">PDF, PPT, DOC, IMG (Max 10MB)</p>
          </div>
          
          <button type="submit" class="w-full py-2.5 bg-brand-600 hover:bg-brand-700 text-white rounded-xl font-medium shadow-lg shadow-brand-500/30 transition-all active:scale-95 flex items-center justify-center gap-2">
            <i data-lucide="send" class="w-4 h-4"></i>
            Publikasikan Tugas
          </button>
        </form>
      </div>
    </div>

    <!-- Assignments List -->
    <div class="lg:col-span-2 space-y-4">
      <?php if (empty($assignments)): ?>
        <div class="bg-white rounded-2xl p-12 text-center border border-dashed border-slate-200">
          <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
            <i data-lucide="clipboard-list" class="w-8 h-8 text-slate-300"></i>
          </div>
          <h3 class="text-lg font-medium text-slate-900">Belum ada tugas</h3>
          <p class="text-slate-500 mt-1">Mulai buat tugas pertama Anda menggunakan formulir di samping.</p>
        </div>
      <?php else: ?>
        <?php foreach ($assignments as $asg): ?>
          <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 hover:shadow-md transition-all group">
            <div class="flex items-start justify-between mb-4">
              <div class="flex items-start gap-4">
                <div class="p-3 bg-purple-50 text-purple-600 rounded-xl group-hover:scale-110 transition-transform">
                  <i data-lucide="file-text" class="w-6 h-6"></i>
                </div>
                <div>
                  <h4 class="text-lg font-bold text-slate-800 group-hover:text-purple-700 transition-colors">
                    <?= htmlspecialchars($asg['title']) ?>
                  </h4>
                  <p class="text-sm text-slate-500 mt-1 flex items-center gap-2">
                    <i data-lucide="clock" class="w-3 h-3"></i>
                    Tenggat: <?= date('d M Y H:i', strtotime($asg['due_date'])) ?>
                  </p>
                </div>
              </div>
              <div class="flex gap-2">
                <a href="index.php?page=teacher&action=submissions&assignment_id=<?= $asg['id'] ?>" class="px-3 py-1.5 bg-purple-50 text-purple-700 rounded-lg text-sm font-medium hover:bg-purple-100 transition-colors">
                  Lihat Pengumpulan
                </a>
              </div>
            </div>
            
            <div class="prose prose-sm text-slate-600 mb-4 line-clamp-3">
              <?= nl2br(htmlspecialchars($asg['description'])) ?>
            </div>

            <?php if ($asg['attachment_path']): ?>
              <div class="flex items-center gap-3 p-3 bg-slate-50 rounded-xl border border-slate-100">
                <i data-lucide="paperclip" class="w-4 h-4 text-slate-400"></i>
                <span class="text-sm text-slate-600 truncate flex-1"><?= htmlspecialchars($asg['attachment_path']) ?></span>
                <a href="uploads/materials/<?= htmlspecialchars($asg['attachment_path']) ?>" download class="p-2 text-brand-600 hover:bg-brand-50 rounded-lg transition-colors" title="Download">
                  <i data-lucide="download" class="w-4 h-4"></i>
                </a>
              </div>
            <?php endif; ?>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
</div>
