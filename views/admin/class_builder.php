<div class="space-y-6">
  <div class="bg-white shadow rounded p-4 hover:shadow-md transition-shadow">
    <div class="text-lg font-semibold mb-3 flex items-center gap-2"><i data-lucide="settings" class="w-5 h-5 text-brand-700"></i> Tahun Ajaran & Kelas</div>
    <form method="get" class="grid grid-cols-1 md:grid-cols-3 gap-3">
      <input type="hidden" name="page" value="admin" />
      <input type="hidden" name="resource" value="class_builder" />
      <div>
        <label class="block text-sm mb-1">Tahun Ajaran</label>
        <select name="academic_year_id" class="w-full border rounded px-3 py-2">
          <?php foreach ($years as $y): ?>
            <option value="<?= (int)$y['id'] ?>" <?= (int)$y['id']===$selected_year_id?'selected':'' ?> ><?= htmlspecialchars($y['label']) ?><?= (int)$y['is_active']===1?' (Aktif)':'' ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div>
        <label class="block text-sm mb-1">Kelas</label>
        <select name="class_id" class="w-full border rounded px-3 py-2">
          <?php foreach ($classes as $c): ?>
            <option value="<?= (int)$c['id'] ?>" <?= (int)$c['id']===$selected_class_id?'selected':'' ?> ><?= htmlspecialchars($c['name']) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="flex items-end">
        <button class="inline-flex items-center gap-2 px-4 py-2 bg-brand-600 hover:bg-brand-700 text-white rounded transition-colors"><i data-lucide="check-circle" class="w-4 h-4"></i><span>Terapkan</span></button>
      </div>
    </form>
    <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
      <form method="post" class="space-y-3" aria-label="Tambah Kelas">
        <input type="hidden" name="action" value="create_class" />
        <input type="hidden" name="academic_year_id" value="<?= (int)$selected_year_id ?>" />
        <div>
          <label class="block text-sm mb-1">Tambah Kelas</label>
          <input name="name" class="w-full border rounded px-3 py-2" placeholder="Kelas Baru" required />
        </div>
        <div>
          <label class="block text-sm mb-1">Wali Kelas (opsional)</label>
          <select name="homeroom_teacher_id" class="w-full border rounded px-3 py-2">
            <option value="">Tidak ada</option>
            <?php foreach ($teachers as $t): ?>
              <option value="<?= (int)$t['id'] ?>"><?= htmlspecialchars($t['name']) ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <button class="inline-flex items-center gap-2 px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded transition-colors"><i data-lucide="plus" class="w-4 h-4"></i><span>Buat Kelas</span></button>
      </form>
      <form method="post" class="space-y-3" aria-label="Ubah Wali Kelas">
        <input type="hidden" name="action" value="update_homeroom" />
        <input type="hidden" name="academic_year_id" value="<?= (int)$selected_year_id ?>" />
        <input type="hidden" name="class_id" value="<?= (int)$selected_class_id ?>" />
        <div>
          <label class="block text-sm mb-1">Ubah Wali Kelas</label>
          <select name="homeroom_teacher_id" class="w-full border rounded px-3 py-2">
            <option value="">Tidak ada</option>
            <?php foreach ($teachers as $t): ?>
              <option value="<?= (int)$t['id'] ?>"><?= htmlspecialchars($t['name']) ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <button class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded transition-colors"><i data-lucide="save" class="w-4 h-4"></i><span>Simpan</span></button>
      </form>
    </div>
  </div>

  <div class="bg-white shadow rounded p-4 hover:shadow-md transition-shadow">
    <div class="text-lg font-semibold mb-3 flex items-center gap-2"><i data-lucide="users" class="w-5 h-5 text-brand-700"></i> Siswa di Kelas</div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div>
        <div class="text-sm text-gray-600 mb-2">Terdaftar</div>
        <div class="space-y-2">
          <?php foreach ($students_in_class as $s): ?>
            <div class="flex items-center justify-between border rounded px-3 py-2">
              <div>
                <div class="font-medium"><?= htmlspecialchars($s['name']) ?></div>
                <div class="text-xs text-gray-500"><?= htmlspecialchars($s['email'] ?? '') ?></div>
              </div>
              <form method="post" aria-label="Hapus Siswa">
                <input type="hidden" name="action" value="remove_student" />
                <input type="hidden" name="academic_year_id" value="<?= (int)$selected_year_id ?>" />
                <input type="hidden" name="class_id" value="<?= (int)$selected_class_id ?>" />
                <input type="hidden" name="student_id" value="<?= (int)$s['id'] ?>" />
                <button class="inline-flex items-center gap-2 px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded transition-colors" data-confirm="Hapus siswa dari kelas?">
                  <i data-lucide="trash-2" class="w-4 h-4"></i>
                  <span>Hapus</span>
                </button>
              </form>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
      <div>
        <div class="text-sm text-gray-600 mb-2">Tambah Siswa</div>
        <form method="post" class="flex items-end gap-2" aria-label="Tambah Siswa">
          <input type="hidden" name="action" value="add_student" />
          <input type="hidden" name="academic_year_id" value="<?= (int)$selected_year_id ?>" />
          <input type="hidden" name="class_id" value="<?= (int)$selected_class_id ?>" />
          <div class="flex-1">
            <label class="block text-sm mb-1">Pilih Siswa</label>
            <select name="student_id" class="w-full border rounded px-3 py-2" required>
              <?php foreach ($students_available as $s): ?>
                <option value="<?= (int)$s['id'] ?>"><?= htmlspecialchars($s['name']) ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <button class="inline-flex items-center gap-2 px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded transition-colors"><i data-lucide="user-plus" class="w-4 h-4"></i><span>Tambah</span></button>
        </form>
      </div>
    </div>
  </div>

  <div class="bg-white shadow rounded p-4 hover:shadow-md transition-shadow">
    <div class="text-lg font-semibold mb-3 flex items-center gap-2"><i data-lucide="chalkboard" class="w-5 h-5 text-brand-700"></i> Pelajaran & Guru Pengampu</div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div>
        <div class="text-sm text-gray-600 mb-2">Daftar Pengampu</div>
        <table class="min-w-full text-sm">
          <thead>
            <tr class="text-left">
              <th class="px-2 py-2">Mata Pelajaran</th>
              <th class="px-2 py-2">Guru</th>
              <th class="px-2 py-2">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($assignments as $a): ?>
              <tr class="border-t">
                <td class="px-2 py-2"><?= htmlspecialchars($a['subject_name']) ?></td>
                <td class="px-2 py-2"><?= htmlspecialchars($a['teacher_name']) ?></td>
                <td class="px-2 py-2">
                  <form method="post" aria-label="Hapus Pengampu">
                    <input type="hidden" name="action" value="remove_assignment" />
                    <input type="hidden" name="academic_year_id" value="<?= (int)$selected_year_id ?>" />
                    <input type="hidden" name="class_id" value="<?= (int)$selected_class_id ?>" />
                    <input type="hidden" name="class_subject_id" value="<?= (int)$a['id'] ?>" />
                    <button class="inline-flex items-center gap-2 px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded transition-colors" data-confirm="Hapus pengampu?">
                      <i data-lucide="trash-2" class="w-4 h-4"></i>
                      <span>Hapus</span>
                    </button>
                  </form>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <div>
        <div class="text-sm text-gray-600 mb-2">Tambah Pengampu</div>
        <form method="post" class="space-y-3" aria-label="Tambah Pengampu">
          <input type="hidden" name="action" value="add_assignment" />
          <input type="hidden" name="academic_year_id" value="<?= (int)$selected_year_id ?>" />
          <input type="hidden" name="class_id" value="<?= (int)$selected_class_id ?>" />
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
          <button class="inline-flex items-center gap-2 px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded transition-colors"><i data-lucide="plus" class="w-4 h-4"></i><span>Tambah</span></button>
        </form>
      </div>
    </div>
  </div>
</div>