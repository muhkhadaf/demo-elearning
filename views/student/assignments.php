<div class="bg-white shadow rounded p-4 hover:shadow-md transition-shadow">
  <div class="text-lg font-semibold mb-3 flex items-center gap-2"><i data-lucide="clipboard-list" class="w-5 h-5 text-brand-700"></i> Tugas</div>
  <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
    <?php foreach ($assignments as $a): ?>
      <div class="border rounded p-3">
        <div class="font-semibold"><?= htmlspecialchars($a['title']) ?></div>
        <div class="text-sm text-gray-600"><?= htmlspecialchars($a['description']) ?></div>
        <div class="mt-2 text-sm">Due: <?= htmlspecialchars($a['due_date'] ?? '') ?></div>
        <div class="mt-2 flex gap-2">
          <?php if (!empty($a['attachment_path'])): ?>
            <a class="inline-flex items-center gap-2 px-3 py-1 bg-slate-800 hover:bg-slate-900 text-white rounded transition-colors" href="uploads/materials/<?= htmlspecialchars($a['attachment_path']) ?>" target="_blank" aria-label="Lampiran">
              <i data-lucide="paperclip" class="w-4 h-4"></i>
              <span>Lampiran</span>
            </a>
          <?php endif; ?>
        </div>
        <div class="mt-3">
          <?php $sub = $subsByMe[$a['id']] ?? null; ?>
          <?php if ($sub): ?>
            <div class="text-sm">Sudah mengumpulkan</div>
            <div class="text-sm">Nilai: <?= htmlspecialchars((string)($sub['score'] ?? '')) ?></div>
            <div class="text-sm">Umpan Balik: <?= htmlspecialchars((string)($sub['feedback'] ?? '')) ?></div>
          <?php else: ?>
            <form method="post" enctype="multipart/form-data" class="flex items-center gap-2" aria-label="Kirim Tugas">
              <input type="hidden" name="assignment_id" value="<?= (int)$a['id'] ?>" />
              <input type="file" name="file" class="border border-slate-300 rounded px-2 py-1 focus:outline-none focus:ring-2 focus:ring-brand-600" required />
              <button class="inline-flex items-center gap-2 px-3 py-1 bg-green-600 hover:bg-green-700 text-white rounded transition-colors">
                <i data-lucide="send" class="w-4 h-4"></i>
                <span>Kirim</span>
              </button>
            </form>
          <?php endif; ?>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>