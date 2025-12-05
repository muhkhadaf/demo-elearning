<div class="bg-white shadow rounded p-4 hover:shadow-md transition-shadow">
  <div class="text-lg font-semibold mb-3 flex items-center gap-2"><i data-lucide="inbox" class="w-5 h-5 text-brand-700"></i> Submisi</div>
  <table class="min-w-full text-sm" aria-label="Daftar Submisi">
    <thead>
      <tr class="text-left">
        <th class="px-2 py-2">Siswa</th>
        <th class="px-2 py-2">Berkas</th>
        <th class="px-2 py-2">Waktu</th>
        <th class="px-2 py-2">Nilai</th>
        <th class="px-2 py-2">Umpan Balik</th>
        <th class="px-2 py-2">Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($subs as $s): ?>
        <tr class="border-t">
          <td class="px-2 py-2"><?= htmlspecialchars($s['student_name']) ?></td>
          <td class="px-2 py-2"><a class="inline-flex items-center gap-2 px-3 py-1 bg-slate-800 hover:bg-slate-900 text-white rounded transition-colors" target="_blank" href="uploads/submissions/<?= htmlspecialchars($s['file_path']) ?>" aria-label="Unduh">
            <i data-lucide="download" class="w-4 h-4"></i>
            <span>Unduh</span>
          </a></td>
          <td class="px-2 py-2"><?= htmlspecialchars($s['submitted_at']) ?></td>
          <td class="px-2 py-2"><?= htmlspecialchars((string)$s['score']) ?></td>
          <td class="px-2 py-2"><?= htmlspecialchars((string)$s['feedback']) ?></td>
          <td class="px-2 py-2">
            <form method="post" class="flex items-center gap-2" aria-label="Nilai Submisi">
              <input type="hidden" name="submission_id" value="<?= (int)$s['id'] ?>" />
              <input name="score" type="number" step="0.01" class="border border-slate-300 rounded px-2 py-1 w-24 focus:outline-none focus:ring-2 focus:ring-brand-600" placeholder="Nilai" />
              <input name="feedback" class="border border-slate-300 rounded px-2 py-1 focus:outline-none focus:ring-2 focus:ring-brand-600" placeholder="Umpan Balik" />
              <button class="inline-flex items-center gap-2 px-3 py-1 bg-green-600 hover:bg-green-700 text-white rounded transition-colors">
                <i data-lucide="save" class="w-4 h-4"></i>
                <span>Simpan</span>
              </button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>