<div class="max-w-7xl mx-auto">
  <div class="mb-6 flex items-center justify-between">
    <div>
      <h2 class="text-2xl font-bold text-slate-800">Materi Pembelajaran</h2>
      <p class="text-slate-500 mt-1">Kelola materi pelajaran untuk siswa</p>
    </div>
    <a href="index.php?page=teacher" class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-slate-200 text-slate-700 rounded-xl hover:bg-slate-50 transition-colors">
      <i data-lucide="arrow-left" class="w-4 h-4"></i>
      Kembali
    </a>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Upload Material Form -->
    <div class="lg:col-span-1">
      <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 sticky top-6">
        <h3 class="text-lg font-bold text-slate-800 mb-4 flex items-center gap-2">
          <i data-lucide="upload-cloud" class="w-5 h-5 text-brand-500"></i>
          Upload Materi
        </h3>
        
        <form action="" method="POST" enctype="multipart/form-data" class="space-y-4">
          <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Judul Materi</label>
            <input type="text" name="title" required class="w-full px-4 py-2 rounded-xl border border-slate-200 focus:border-brand-500 focus:ring-2 focus:ring-brand-200 outline-none transition-all">
          </div>
          
          <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Deskripsi</label>
            <textarea name="description" rows="3" required class="w-full px-4 py-2 rounded-xl border border-slate-200 focus:border-brand-500 focus:ring-2 focus:ring-brand-200 outline-none transition-all"></textarea>
          </div>
          
          <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">File Materi</label>
            <div class="relative">
              <input type="file" name="file" required class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-brand-50 file:text-brand-700 hover:file:bg-brand-100 transition-all">
            </div>
            <p class="text-xs text-slate-400 mt-1">PDF, PPT, DOC, IMG (Max 10MB)</p>
          </div>
          
          <button type="submit" class="w-full py-2.5 bg-brand-600 hover:bg-brand-700 text-white rounded-xl font-medium shadow-lg shadow-brand-500/30 transition-all active:scale-95 flex items-center justify-center gap-2">
            <i data-lucide="upload" class="w-4 h-4"></i>
            Upload
          </button>
        </form>
      </div>
    </div>

    <!-- Materials List -->
    <div class="lg:col-span-2 space-y-4">
      <?php if (empty($materials)): ?>
        <div class="bg-white rounded-2xl p-12 text-center border border-dashed border-slate-200">
          <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
            <i data-lucide="folder-open" class="w-8 h-8 text-slate-300"></i>
          </div>
          <h3 class="text-lg font-medium text-slate-900">Belum ada materi</h3>
          <p class="text-slate-500 mt-1">Upload materi pertama Anda menggunakan formulir di samping.</p>
        </div>
      <?php else: ?>
        <?php foreach ($materials as $mat): ?>
          <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 hover:shadow-md transition-all group">
            <div class="flex items-start justify-between mb-4">
              <div class="flex items-start gap-4">
                <div class="p-3 bg-blue-50 text-blue-600 rounded-xl group-hover:scale-110 transition-transform">
                  <i data-lucide="file-text" class="w-6 h-6"></i>
                </div>
                <div>
                  <h4 class="text-lg font-bold text-slate-800 group-hover:text-blue-700 transition-colors">
                    <?= htmlspecialchars($mat['title']) ?>
                  </h4>
                  <p class="text-sm text-slate-500 mt-1 flex items-center gap-2">
                    <i data-lucide="calendar" class="w-3 h-3"></i>
                    Diupload: <?= date('d M Y H:i', strtotime($mat['created_at'])) ?>
                  </p>
                </div>
              </div>
            </div>
            
            <div class="prose prose-sm text-slate-600 mb-4 line-clamp-3">
              <?= nl2br(htmlspecialchars($mat['description'])) ?>
            </div>

            <div class="flex items-center gap-3 p-3 bg-slate-50 rounded-xl border border-slate-100">
              <i data-lucide="file" class="w-4 h-4 text-slate-400"></i>
              <span class="text-sm text-slate-600 truncate flex-1"><?= htmlspecialchars($mat['file_path']) ?></span>
              <a href="uploads/materials/<?= htmlspecialchars($mat['file_path']) ?>" download class="p-2 text-brand-600 hover:bg-brand-50 rounded-lg transition-colors" title="Download">
                <i data-lucide="download" class="w-4 h-4"></i>
              </a>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
</div>
