<div class="bg-white shadow rounded p-4 hover:shadow-md transition-shadow">
  <div class="text-lg font-semibold mb-3 flex items-center gap-2"><i data-lucide="file-text" class="w-5 h-5 text-brand-700"></i> Materi</div>
  <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
    <?php foreach ($materials as $m): ?>
      <div class="border rounded p-3">
        <div class="font-semibold"><?= htmlspecialchars($m['title']) ?></div>
        <div class="text-sm text-gray-600"><?= htmlspecialchars($m['description']) ?></div>
        <div class="mt-2">
          <a class="inline-flex items-center gap-2 px-3 py-1 bg-slate-800 hover:bg-slate-900 text-white rounded transition-colors" href="uploads/materials/<?= htmlspecialchars($m['file_path']) ?>" target="_blank" aria-label="Unduh">
            <i data-lucide="download" class="w-4 h-4"></i>
            <span>Unduh</span>
          </a>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>