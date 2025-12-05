<div class="max-w-7xl mx-auto">
  <div class="mb-6 flex items-center justify-between">
    <div>
      <h2 class="text-2xl font-bold text-slate-800">Daftar Siswa</h2>
      <p class="text-slate-500 mt-1">Siswa yang terdaftar dalam kelas ini</p>
    </div>
    <a href="index.php?page=teacher" class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-slate-200 text-slate-700 rounded-xl hover:bg-slate-50 transition-colors">
      <i data-lucide="arrow-left" class="w-4 h-4"></i>
      Kembali
    </a>
  </div>

  <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <?php if (empty($students)): ?>
      <div class="p-12 text-center">
        <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
          <i data-lucide="users" class="w-8 h-8 text-slate-300"></i>
        </div>
        <h3 class="text-lg font-medium text-slate-900">Belum ada siswa</h3>
        <p class="text-slate-500 mt-1">Belum ada siswa yang terdaftar di kelas ini.</p>
      </div>
    <?php else: ?>
      <div class="overflow-x-auto">
        <table class="w-full">
          <thead>
            <tr class="bg-slate-50 border-b border-slate-100">
              <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Nama Siswa</th>
              <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">NIS</th>
              <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Email</th>
              <th class="px-6 py-4 text-right text-xs font-semibold text-slate-500 uppercase tracking-wider">Aksi</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-100">
            <?php foreach ($students as $student): ?>
              <tr class="hover:bg-slate-50 transition-colors">
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-brand-100 text-brand-600 flex items-center justify-center font-bold text-sm">
                      <?= strtoupper(substr($student['name'], 0, 1)) ?>
                    </div>
                    <div class="text-sm font-medium text-slate-900"><?= htmlspecialchars($student['name']) ?></div>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">
                  <?= htmlspecialchars($student['nis'] ?? '-') ?>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">
                  <?= htmlspecialchars($student['email']) ?>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                  <button class="text-slate-400 hover:text-brand-600 transition-colors" title="Detail Siswa">
                    <i data-lucide="more-horizontal" class="w-5 h-5"></i>
                  </button>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php endif; ?>
  </div>
</div>
