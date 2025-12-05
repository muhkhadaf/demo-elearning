<?php
$roleConfig = [
    'admin' => ['title' => 'Administrator', 'color' => 'from-slate-700 to-slate-900', 'icon' => 'shield-check', 'bg' => 'bg-slate-50', 'link' => 'index.php?page=login_admin'],
    'teacher' => ['title' => 'Guru / Pengajar', 'color' => 'from-indigo-600 to-indigo-800', 'icon' => 'graduation-cap', 'bg' => 'bg-indigo-50', 'link' => 'index.php?page=login_teacher'],
    'student' => ['title' => 'Siswa / Murid', 'color' => 'from-emerald-600 to-emerald-800', 'icon' => 'users', 'bg' => 'bg-emerald-50', 'link' => 'index.php?page=login_student'],
];
?>

<!DOCTYPE html>
<div class="min-h-[80vh] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <!-- Role Selection Screen -->
    <div class="w-full max-w-4xl space-y-8">
        <div class="text-center">
            <h2 class="text-3xl font-bold text-slate-900">Selamat Datang di Siakad MDT</h2>
            <p class="mt-2 text-slate-600">Silakan pilih peran Anda untuk masuk ke aplikasi</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
            <?php foreach ($roleConfig as $key => $cfg): ?>
            <a href="<?= $cfg['link'] ?>" class="group relative bg-white rounded-2xl p-8 shadow-sm hover:shadow-xl transition-all duration-300 border border-slate-100 hover:-translate-y-1 overflow-hidden">
                <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                    <i data-lucide="<?= $cfg['icon'] ?>" class="w-24 h-24 text-slate-900"></i>
                </div>
                
                <div class="relative z-10">
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br <?= $cfg['color'] ?> flex items-center justify-center text-white shadow-lg mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i data-lucide="<?= $cfg['icon'] ?>" class="w-8 h-8"></i>
                    </div>
                    
                    <h3 class="text-xl font-bold text-slate-900 mb-2"><?= $cfg['title'] ?></h3>
                    <p class="text-sm text-slate-500">Masuk sebagai <?= strtolower($cfg['title']) ?></p>
                    
                    <div class="mt-6 flex items-center text-sm font-medium text-brand-600 group-hover:translate-x-1 transition-transform">
                        Lanjutkan <i data-lucide="arrow-right" class="w-4 h-4 ml-1"></i>
                    </div>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>