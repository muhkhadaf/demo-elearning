<!DOCTYPE html>
<div class="min-h-[80vh] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-md space-y-8 bg-white/80 backdrop-blur-xl p-8 rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-white/20 relative overflow-hidden">
        
        <!-- Decorative elements -->
        <div class="absolute -top-10 -right-10 w-32 h-32 bg-slate-200 rounded-full blur-3xl opacity-50 pointer-events-none"></div>
        <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-slate-300 rounded-full blur-3xl opacity-50 pointer-events-none"></div>

        <div class="relative">
            <a href="index.php?page=login" class="absolute -top-2 -left-2 p-2 text-slate-400 hover:text-slate-600 transition-colors rounded-full hover:bg-slate-100" title="Kembali ke pemilihan role">
                <i data-lucide="arrow-left" class="w-5 h-5"></i>
            </a>
            
            <div class="mx-auto w-16 h-16 bg-gradient-to-br from-slate-700 to-slate-900 rounded-2xl flex items-center justify-center text-white shadow-lg mb-6 transform rotate-3">
                <i data-lucide="shield-check" class="w-8 h-8"></i>
            </div>
            <h2 class="mt-2 text-center text-2xl font-bold tracking-tight text-slate-900">Login Administrator</h2>
            <p class="mt-2 text-center text-sm text-slate-600">
                Masuk ke panel administrasi
            </p>
        </div>

        <form class="mt-8 space-y-6" method="post" aria-label="Form Login Admin">
            <div class="space-y-5">
                <div>
                    <label for="username" class="block text-sm font-medium text-slate-700 mb-1">Username</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                            <i data-lucide="user" class="w-5 h-5"></i>
                        </div>
                        <input id="username" name="username" type="text" required class="block w-full pl-10 pr-3 py-2.5 border border-slate-200 rounded-xl text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-500/20 focus:border-slate-500 transition-all bg-slate-50/50 focus:bg-white sm:text-sm" placeholder="Masukkan username admin">
                    </div>
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-slate-700 mb-1">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                            <i data-lucide="lock" class="w-5 h-5"></i>
                        </div>
                        <input id="password" name="password" type="password" required class="block w-full pl-10 pr-3 py-2.5 border border-slate-200 rounded-xl text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-500/20 focus:border-slate-500 transition-all bg-slate-50/50 focus:bg-white sm:text-sm" placeholder="Masukkan password">
                    </div>
                </div>
            </div>

            <div>
                <button type="submit" class="group relative w-full flex justify-center py-2.5 px-4 border border-transparent text-sm font-semibold rounded-xl text-white bg-gradient-to-r from-slate-700 to-slate-900 hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-500 shadow-lg transition-all duration-200 hover:-translate-y-0.5">
                    <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                        <i data-lucide="log-in" class="w-5 h-5 text-white/80 group-hover:text-white transition-colors"></i>
                    </span>
                    Masuk Sebagai Admin
                </button>
            </div>
        </form>
    </div>
</div>
