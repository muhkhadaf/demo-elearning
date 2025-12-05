<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
  <?php foreach ($list as $row): ?>
    <div class="bg-white shadow rounded p-4 hover:shadow-md transition-shadow">
      <div class="text-lg font-semibold flex items-center gap-2"><i data-lucide="book-open" class="w-5 h-5 text-brand-700"></i> <?= htmlspecialchars($row['subject_name']) ?></div>
      <div class="mt-3 flex gap-2">
        <a href="index.php?page=student&action=materials&class_subject_id=<?= (int)$row['id'] ?>" class="inline-flex items-center gap-2 px-3 py-2 bg-brand-600 hover:bg-brand-700 text-white rounded transition-colors"><i data-lucide="file-text" class="w-4 h-4"></i><span>Materi</span></a>
        <a href="index.php?page=student&action=assignments&class_subject_id=<?= (int)$row['id'] ?>" class="inline-flex items-center gap-2 px-3 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded transition-colors"><i data-lucide="clipboard-list" class="w-4 h-4"></i><span>Tugas</span></a>
    </div>
    </div>
  <?php endforeach; ?>
</div>