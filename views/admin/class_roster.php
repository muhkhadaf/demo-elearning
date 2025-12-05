<div class="space-y-6">
  <div class="bg-white shadow rounded p-4 hover:shadow-md transition-shadow">
    <div class="text-lg font-semibold mb-3 flex items-center gap-2"><i data-lucide="list" class="w-5 h-5 text-brand-700"></i> Daftar Kelas & Siswa</div>
    <form method="get" class="flex items-end gap-3">
      <input type="hidden" name="page" value="admin" />
      <input type="hidden" name="resource" value="class_roster" />
      <div>
        <label class="block text-sm mb-1">Tahun Ajaran</label>
        <select name="academic_year_id" class="w-64 border rounded px-3 py-2">
          <option value="">Semua Tahun</option>
          <?php foreach ($years as $y): ?>
            <option value="<?= (int)$y['id'] ?>" <?= isset($_GET['academic_year_id']) && (int)$_GET['academic_year_id']===(int)$y['id'] ? 'selected':'' ?>><?= htmlspecialchars($y['label']) ?><?= (int)$y['is_active']===1?' (Aktif)':'' ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <button class="inline-flex items-center gap-2 px-4 py-2 bg-brand-600 hover:bg-brand-700 text-white rounded transition-colors"><i data-lucide="check-circle" class="w-4 h-4"></i><span>Terapkan</span></button>
    </form>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <?php foreach ($rosters as $r): $c=$r['class']; $students=$r['students']; ?>
      <div class="bg-white shadow rounded p-4 hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between">
          <div>
            <div class="text-lg font-semibold flex items-center gap-2"><i data-lucide="school" class="w-5 h-5 text-brand-700"></i> <?= htmlspecialchars($c['name']) ?></div>
            <div class="text-sm text-gray-600 flex items-center gap-2"><i data-lucide="calendar" class="w-4 h-4"></i> Tahun: <?= htmlspecialchars($c['year_label'] ?? '') ?></div>
            <div class="text-sm text-gray-600 flex items-center gap-2"><i data-lucide="user" class="w-4 h-4"></i> Wali Kelas: <?= htmlspecialchars($c['homeroom_name'] ?? '—') ?></div>
          </div>
          <div class="text-xs bg-gray-100 px-2 py-1 rounded inline-flex items-center gap-1"><i data-lucide="users" class="w-4 h-4"></i> Siswa: <?= (int)count($students) ?></div>
        </div>
        <div class="mt-3 space-y-2 max-h-72 overflow-auto">
          <?php if (count($students) === 0): ?>
            <div class="text-sm text-gray-500">Belum ada siswa.</div>
          <?php else: ?>
            <?php foreach ($students as $s): ?>
              <div class="flex items-center justify-between border rounded px-3 py-2">
                <div>
                  <div class="font-medium flex items-center gap-2"><i data-lucide="user" class="w-4 h-4"></i> <?= htmlspecialchars($s['name']) ?></div>
                  <div class="text-xs text-gray-500"><?= htmlspecialchars($s['email'] ?? '') ?></div>
                </div>
              </div>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>