<div class="flex items-start gap-6">
  <div class="w-full md:w-1/3 bg-white shadow rounded p-4 hover:shadow-md transition-shadow sticky top-24">
    <div class="text-lg font-semibold mb-3 flex items-center gap-2">
        <i data-lucide="<?= isset($edit) ? 'edit' : 'plus-circle' ?>" class="w-5 h-5 text-brand-700"></i> 
        <?= isset($edit) ? 'Edit Mata Pelajaran' : 'Tambah Mata Pelajaran' ?>
    </div>
    
    <form method="post" class="space-y-4">
      <?php if (isset($edit)): ?>
        <input type="hidden" name="id" value="<?= $edit['id'] ?>">
      <?php endif; ?>
      
      <div>
        <label class="block text-sm font-medium text-slate-700 mb-1">Nama Mata Pelajaran</label>
        <input name="name" value="<?= isset($edit) ? htmlspecialchars($edit['name']) : '' ?>" class="w-full border border-slate-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all" required placeholder="Contoh: Matematika" />
      </div>
      
      <div class="flex gap-2">
          <button type="submit" class="flex-1 inline-flex justify-center items-center gap-2 px-4 py-2 bg-brand-600 hover:bg-brand-700 text-white rounded-lg transition-colors shadow-sm">
            <i data-lucide="save" class="w-4 h-4"></i>
            <span><?= isset($edit) ? 'Update' : 'Simpan' ?></span>
          </button>
          
          <?php if (isset($edit)): ?>
            <a href="index.php?page=admin&resource=subjects" class="inline-flex justify-center items-center gap-2 px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-lg transition-colors">
                Batal
            </a>
          <?php endif; ?>
      </div>
    </form>
  </div>

  <div class="w-full md:w-2/3 bg-white shadow rounded-lg overflow-hidden border border-slate-200">
    <div class="p-4 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
        <div class="text-lg font-semibold flex items-center gap-2 text-slate-800">
            <i data-lucide="list" class="w-5 h-5 text-brand-600"></i> Daftar Mata Pelajaran
        </div>
        <span class="text-xs font-medium px-2.5 py-0.5 rounded-full bg-brand-100 text-brand-800">
            Total: <?= count($subjects) ?>
        </span>
    </div>
    
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm text-left">
          <thead class="bg-slate-50 text-slate-500 font-medium border-b border-slate-200">
            <tr>
              <th class="px-4 py-3 w-16 text-center">#</th>
              <th class="px-4 py-3">Nama Mata Pelajaran</th>
              <th class="px-4 py-3 w-32 text-center">Aksi</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-100">
            <?php if (empty($subjects)): ?>
                <tr>
                    <td colspan="3" class="px-4 py-8 text-center text-slate-400 italic">Belum ada data mata pelajaran</td>
                </tr>
            <?php else: ?>
                <?php foreach ($subjects as $i => $s): ?>
                  <tr class="hover:bg-slate-50/50 transition-colors group">
                    <td class="px-4 py-3 text-center text-slate-500"><?= $i + 1 ?></td>
                    <td class="px-4 py-3 font-medium text-slate-900"><?= htmlspecialchars($s['name']) ?></td>
                    <td class="px-4 py-3 text-center">
                        <div class="flex items-center justify-center gap-2 opacity-60 group-hover:opacity-100 transition-opacity">
                            <a href="index.php?page=admin&resource=subjects&action=edit&id=<?= $s['id'] ?>" class="p-1.5 text-blue-600 hover:bg-blue-50 rounded-md transition-colors" title="Edit">
                                <i data-lucide="edit-2" class="w-4 h-4"></i>
                            </a>
                            <a href="index.php?page=admin&resource=subjects&action=delete&id=<?= $s['id'] ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus mata pelajaran ini?')" class="p-1.5 text-red-600 hover:bg-red-50 rounded-md transition-colors" title="Hapus">
                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                            </a>
                        </div>
                    </td>
                  </tr>
                <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
    </div>
  </div>
</div>