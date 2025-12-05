<div class="flex items-start gap-6">
  <div class="w-full md:w-1/3 bg-white shadow rounded p-4 hover:shadow-md transition-shadow sticky top-24">
    <div class="text-lg font-semibold mb-3 flex items-center gap-2">
        <i data-lucide="<?= isset($edit) ? 'edit' : 'plus-circle' ?>" class="w-5 h-5 text-brand-700"></i> 
        <?= isset($edit) ? 'Edit Tahun Ajaran' : 'Tambah Tahun Ajaran' ?>
    </div>
    
    <form method="post" class="space-y-4">
      <?php if (isset($edit)): ?>
        <input type="hidden" name="id" value="<?= $edit['id'] ?>">
      <?php endif; ?>
      
      <div>
        <label class="block text-sm font-medium text-slate-700 mb-1">Label Tahun Ajaran</label>
        <input name="label" value="<?= isset($edit) ? htmlspecialchars($edit['label']) : '' ?>" class="w-full border border-slate-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all" required placeholder="Contoh: 2023/2024" />
      </div>
      
      <div class="flex items-center gap-2">
        <input type="checkbox" name="is_active" id="is_active" value="1" <?= (isset($edit) && $edit['is_active']) ? 'checked' : '' ?> class="rounded text-brand-600 focus:ring-brand-500">
        <label for="is_active" class="text-sm text-slate-700">Set sebagai Aktif</label>
      </div>
      
      <div class="flex gap-2">
          <button type="submit" class="flex-1 inline-flex justify-center items-center gap-2 px-4 py-2 bg-brand-600 hover:bg-brand-700 text-white rounded-lg transition-colors shadow-sm">
            <i data-lucide="save" class="w-4 h-4"></i>
            <span><?= isset($edit) ? 'Update' : 'Simpan' ?></span>
          </button>
          
          <?php if (isset($edit)): ?>
            <a href="index.php?page=admin&resource=academic_years" class="inline-flex justify-center items-center gap-2 px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-lg transition-colors">
                Batal
            </a>
          <?php endif; ?>
      </div>
    </form>
  </div>

  <div class="w-full md:w-2/3 bg-white shadow rounded-lg overflow-hidden border border-slate-200">
    <div class="p-4 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
        <div class="text-lg font-semibold flex items-center gap-2 text-slate-800">
            <i data-lucide="calendar" class="w-5 h-5 text-brand-600"></i> Daftar Tahun Ajaran
        </div>
        <span class="text-xs font-medium px-2.5 py-0.5 rounded-full bg-brand-100 text-brand-800">
            Total: <?= count($years) ?>
        </span>
    </div>
    
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm text-left">
          <thead class="bg-slate-50 text-slate-500 font-medium border-b border-slate-200">
            <tr>
              <th class="px-4 py-3 w-16 text-center">#</th>
              <th class="px-4 py-3">Tahun Ajaran</th>
              <th class="px-4 py-3 text-center">Status</th>
              <th class="px-4 py-3 w-32 text-center">Aksi</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-100">
            <?php if (empty($years)): ?>
                <tr>
                    <td colspan="4" class="px-4 py-8 text-center text-slate-400 italic">Belum ada data tahun ajaran</td>
                </tr>
            <?php else: ?>
                <?php foreach ($years as $i => $y): ?>
                  <tr class="hover:bg-slate-50/50 transition-colors group <?= $y['is_active'] ? 'bg-brand-50/30' : '' ?>">
                    <td class="px-4 py-3 text-center text-slate-500"><?= $i + 1 ?></td>
                    <td class="px-4 py-3 font-medium text-slate-900"><?= htmlspecialchars($y['label']) ?></td>
                    <td class="px-4 py-3 text-center">
                        <?php if ($y['is_active']): ?>
                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <i data-lucide="check-circle" class="w-3 h-3"></i> Aktif
                            </span>
                        <?php else: ?>
                            <form method="post" class="inline">
                                <input type="hidden" name="set_active_id" value="<?= $y['id'] ?>">
                                <button type="submit" class="text-xs text-slate-400 hover:text-brand-600 hover:underline">Set Aktif</button>
                            </form>
                        <?php endif; ?>
                    </td>
                    <td class="px-4 py-3 text-center">
                        <div class="flex items-center justify-center gap-2 opacity-60 group-hover:opacity-100 transition-opacity">
                            <a href="index.php?page=admin&resource=academic_years&action=edit&id=<?= $y['id'] ?>" class="p-1.5 text-blue-600 hover:bg-blue-50 rounded-md transition-colors" title="Edit">
                                <i data-lucide="edit-2" class="w-4 h-4"></i>
                            </a>
                            <a href="index.php?page=admin&resource=academic_years&action=delete&id=<?= $y['id'] ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus tahun ajaran ini?')" class="p-1.5 text-red-600 hover:bg-red-50 rounded-md transition-colors" title="Hapus">
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