<div class="flex items-start gap-6">
  <div class="w-full md:w-1/2 bg-white shadow rounded p-4 hover:shadow-md transition-shadow">
    <div class="text-lg font-semibold mb-3 flex items-center gap-2"><i data-lucide="chalkboard" class="w-5 h-5 text-brand-700"></i> Tetapkan Mata Pelajaran ke Kelas</div>
    <form method="post" class="space-y-3">
      <div>
        <label class="block text-sm mb-1">Kelas</label>
        <select name="class_id" class="w-full border rounded px-3 py-2" required>
          <?php foreach ($classes as $c): ?>
            <option value="<?= (int)$c['id'] ?>"><?= htmlspecialchars($c['name']) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div>
        <label class="block text-sm mb-1">Mata Pelajaran</label>
        <select name="subject_id" class="w-full border rounded px-3 py-2" required>
          <?php foreach ($subjects as $s): ?>
            <option value="<?= (int)$s['id'] ?>"><?= htmlspecialchars($s['name']) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div>
        <label class="block text-sm mb-1">Guru</label>
        <select name="teacher_id" class="w-full border rounded px-3 py-2" required>
          <?php foreach ($teachers as $t): ?>
            <option value="<?= (int)$t['id'] ?>"><?= htmlspecialchars($t['name']) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="grid grid-cols-3 gap-3">
        <div>
          <label class="block text-sm mb-1">Hari</label>
          <select name="day" class="w-full border rounded px-3 py-2">
            <option value="">Pilih Hari</option>
            <option value="Senin">Senin</option>
            <option value="Selasa">Selasa</option>
            <option value="Rabu">Rabu</option>
            <option value="Kamis">Kamis</option>
            <option value="Jumat">Jumat</option>
            <option value="Sabtu">Sabtu</option>
          </select>
        </div>
        <div>
          <label class="block text-sm mb-1">Jam Mulai</label>
          <input type="time" name="start_time" class="w-full border rounded px-3 py-2">
        </div>
        <div>
          <label class="block text-sm mb-1">Jam Selesai</label>
          <input type="time" name="end_time" class="w-full border rounded px-3 py-2">
        </div>
      </div>
      <button class="inline-flex items-center gap-2 px-4 py-2 bg-brand-600 hover:bg-brand-700 text-white rounded transition-colors"><i data-lucide="check-circle" class="w-4 h-4"></i><span>Tetapkan</span></button>
    </form>
  </div>
  <div class="w-full md:w-1/2 bg-white shadow rounded p-4 hover:shadow-md transition-shadow">
    <div class="text-lg font-semibold mb-3 flex items-center gap-2"><i data-lucide="list" class="w-5 h-5 text-brand-700"></i> Daftar Pengampu</div>
    <table class="min-w-full text-sm">
      <thead>
        <tr class="text-left">
          <th class="px-2 py-2">Kelas</th>
          <th class="px-2 py-2">Mata Pelajaran</th>
          <th class="px-2 py-2">Guru</th>
          <th class="px-2 py-2">Jadwal</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($assignments as $a): ?>
          <tr class="border-t">
            <td class="px-2 py-2"><?= htmlspecialchars($a['class_name']) ?></td>
            <td class="px-2 py-2"><?= htmlspecialchars($a['subject_name']) ?></td>
            <td class="px-2 py-2"><?= htmlspecialchars($a['teacher_name']) ?></td>
            <td class="px-2 py-2">
              <?php if (!empty($a['day'])): ?>
                <span class="px-2 py-0.5 bg-blue-50 text-blue-700 rounded text-xs font-medium">
                  <?= htmlspecialchars($a['day']) ?>, <?= substr($a['start_time'], 0, 5) ?> - <?= substr($a['end_time'], 0, 5) ?>
                </span>
              <?php else: ?>
                <span class="text-gray-400">-</span>
              <?php endif; ?>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>