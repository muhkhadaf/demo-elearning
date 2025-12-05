// Main Application
const App = {
    init() {
        Router.init();
        this.registerRoutes();
    },

    registerRoutes() {
        // Public routes
        Router.register('/login', () => this.loginPage());
        Router.register('/login-admin', () => this.loginRolePage('admin'));
        Router.register('/login-teacher', () => this.loginRolePage('teacher'));
        Router.register('/login-student', () => this.loginRolePage('student'));

        // Admin routes
        Router.register('/admin', () => this.adminDashboard());
        Router.register('/admin/teachers', () => this.adminTeachers());
        Router.register('/admin/students', () => this.adminStudents());
        Router.register('/admin/classes', () => this.adminClasses());
        Router.register('/admin/subjects', () => this.adminSubjects());

        // Teacher routes
        Router.register('/teacher', () => this.teacherDashboard());
        Router.register('/teacher/materials', (params) => this.teacherMaterials(params));
        Router.register('/teacher/assignments', (params) => this.teacherAssignments(params));

        // Student routes
        Router.register('/student', () => this.studentDashboard());
        Router.register('/student/materials', (params) => this.studentMaterials(params));
        Router.register('/student/assignments', (params) => this.studentAssignments(params));

        // 404
        Router.register('/404', () => this.notFound());
    },

    render(html) {
        document.getElementById('app').innerHTML = html;
    },

    // Login Page
    loginPage() {
        this.render(`
            <div class="min-h-screen flex items-center justify-center py-12 px-4">
                <div class="w-full max-w-4xl space-y-8">
                    <div class="text-center">
                        <h2 class="text-3xl font-bold text-slate-900">Selamat Datang di eLearning</h2>
                        <p class="mt-2 text-slate-600">Silakan pilih peran Anda untuk masuk ke aplikasi</p>
                        <div class="mt-4 inline-block px-6 py-3 bg-gradient-to-r from-amber-500 to-orange-500 text-white rounded-xl shadow-lg">
                            <p class="font-semibold flex items-center justify-center gap-2">
                                <i data-lucide="info" class="w-5 h-5"></i>
                                MODE DEMO AKTIF
                            </p>
                            <p class="text-sm mt-1 opacity-90">Kredensial login akan ditampilkan di halaman login masing-masing role</p>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        ${this.roleCard('Administrator', 'admin', 'shield-check', 'from-slate-700 to-slate-900')}
                        ${this.roleCard('Guru / Pengajar', 'teacher', 'graduation-cap', 'from-indigo-600 to-indigo-800')}
                        ${this.roleCard('Siswa / Murid', 'student', 'users', 'from-emerald-600 to-emerald-800')}
                    </div>
                </div>
            </div>
        `);
    },

    roleCard(title, role, icon, gradient) {
        return `
            <a href="#/login-${role}" class="group relative bg-white rounded-2xl p-8 shadow-sm hover:shadow-xl transition-all duration-300 border border-slate-100 hover:-translate-y-1 overflow-hidden">
                <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                    <i data-lucide="${icon}" class="w-24 h-24 text-slate-900"></i>
                </div>
                <div class="relative z-10">
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br ${gradient} flex items-center justify-center text-white shadow-lg mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i data-lucide="${icon}" class="w-8 h-8"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2">${title}</h3>
                    <p class="text-sm text-slate-500">Masuk sebagai ${title.toLowerCase()}</p>
                    <div class="mt-6 flex items-center text-sm font-medium text-brand-600 group-hover:translate-x-1 transition-transform">
                        Lanjutkan <i data-lucide="arrow-right" class="w-4 h-4 ml-1"></i>
                    </div>
                </div>
            </a>
        `;
    },

    // Login Role Page
    loginRolePage(role) {
        const config = {
            admin: { title: 'Administrator', color: 'slate', icon: 'shield-check', users: [{ u: 'admin', p: 'admin123' }] },
            teacher: { title: 'Guru', color: 'indigo', icon: 'graduation-cap', users: [{ u: 'teacher1', p: 'teacher123' }, { u: 'teacher2', p: 'teacher123' }] },
            student: { title: 'Siswa', color: 'emerald', icon: 'users', users: [{ u: 'student1', p: 'student123' }, { u: 'student2', p: 'student123' }, { u: 'student3', p: 'student123' }] }
        }[role];

        this.render(`
            <div class="min-h-screen flex items-center justify-center py-12 px-4">
                <div class="w-full max-w-md space-y-8 bg-white/80 backdrop-blur-xl p-8 rounded-2xl shadow-xl border border-white/20">
                    <div class="text-center">
                        <a href="#/login" class="inline-flex items-center text-slate-500 hover:text-slate-700 mb-4">
                            <i data-lucide="arrow-left" class="w-4 h-4 mr-1"></i> Kembali
                        </a>
                        <div class="mx-auto w-16 h-16 bg-gradient-to-br from-${config.color}-600 to-${config.color}-800 rounded-2xl flex items-center justify-center text-white shadow-lg mb-6">
                            <i data-lucide="${config.icon}" class="w-8 h-8"></i>
                        </div>
                        <h2 class="text-2xl font-bold text-slate-900">Login ${config.title}</h2>
                        <p class="mt-2 text-sm text-slate-600">Masuk untuk mengakses dashboard</p>
                        
                        <div class="mt-4 p-3 bg-${config.color}-50 border border-${config.color}-200 rounded-lg text-left">
                            <p class="text-xs text-${config.color}-800 font-semibold mb-1">🎯 MODE DEMO</p>
                            ${config.users.map(u => `<p class="text-xs text-${config.color}-700">Username: <code class="bg-${config.color}-100 px-1 rounded">${u.u}</code></p>`).join('')}
                            <p class="text-xs text-${config.color}-700">Password: <code class="bg-${config.color}-100 px-1 rounded">${config.users[0].p}</code></p>
                        </div>
                    </div>

                    <form onsubmit="App.handleLogin(event, '${role}')" class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Username</label>
                            <input type="text" name="username" required class="w-full px-4 py-2 rounded-xl border border-slate-200 focus:border-${config.color}-500 focus:ring-2 focus:ring-${config.color}-200 outline-none transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Password</label>
                            <input type="password" name="password" required class="w-full px-4 py-2 rounded-xl border border-slate-200 focus:border-${config.color}-500 focus:ring-2 focus:ring-${config.color}-200 outline-none transition-all">
                        </div>
                        <button type="submit" class="w-full py-2.5 bg-gradient-to-r from-${config.color}-600 to-${config.color}-800 text-white rounded-xl font-medium shadow-lg transition-all hover:opacity-90">
                            Masuk Sebagai ${config.title}
                        </button>
                    </form>
                </div>
            </div>
        `);
    },

    handleLogin(event, expectedRole) {
        event.preventDefault();
        const form = event.target;
        const username = form.username.value;
        const password = form.password.value;

        const result = Auth.login(username, password);
        
        if (!result.success) {
            Toast.error(result.message);
            return;
        }

        if (result.user.role !== expectedRole) {
            Auth.logout();
            Toast.error(`Akun ini tidak terdaftar sebagai ${expectedRole}`);
            return;
        }

        Toast.success('Login berhasil!');
        setTimeout(() => {
            window.location.hash = `#/${expectedRole}`;
        }, 500);
    },

    // Admin Dashboard
    adminDashboard() {
        if (!Auth.requireRole('admin')) return;
        
        const stats = DemoData.getStats();
        this.render(Components.layout(`
            <div class="space-y-6">
                <h2 class="text-2xl font-bold text-slate-800">Dashboard Admin</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    ${Components.statsCard('Total Guru', stats.teachers, 'users', 'indigo')}
                    ${Components.statsCard('Total Siswa', stats.students, 'user-check', 'emerald')}
                    ${Components.statsCard('Total Kelas', stats.classes, 'school', 'blue')}
                    ${Components.statsCard('Mata Pelajaran', stats.subjects, 'book-open', 'purple')}
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <a href="#/admin/teachers" class="block p-6 bg-white rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition-all">
                        <h3 class="text-lg font-bold text-slate-800 mb-2 flex items-center gap-2">
                            <i data-lucide="users" class="w-5 h-5 text-indigo-500"></i>
                            Kelola Guru
                        </h3>
                        <p class="text-sm text-slate-600">Tambah, edit, atau hapus data guru</p>
                    </a>
                    
                    <a href="#/admin/students" class="block p-6 bg-white rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition-all">
                        <h3 class="text-lg font-bold text-slate-800 mb-2 flex items-center gap-2">
                            <i data-lucide="user-check" class="w-5 h-5 text-emerald-500"></i>
                            Kelola Siswa
                        </h3>
                        <p class="text-sm text-slate-600">Tambah, edit, atau hapus data siswa</p>
                    </a>
                    
                    <a href="#/admin/classes" class="block p-6 bg-white rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition-all">
                        <h3 class="text-lg font-bold text-slate-800 mb-2 flex items-center gap-2">
                            <i data-lucide="school" class="w-5 h-5 text-blue-500"></i>
                            Kelola Kelas
                        </h3>
                        <p class="text-sm text-slate-600">Atur kelas dan wali kelas</p>
                    </a>
                    
                    <a href="#/admin/subjects" class="block p-6 bg-white rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition-all">
                        <h3 class="text-lg font-bold text-slate-800 mb-2 flex items-center gap-2">
                            <i data-lucide="book-open" class="w-5 h-5 text-purple-500"></i>
                            Kelola Mata Pelajaran
                        </h3>
                        <p class="text-sm text-slate-600">Tambah atau edit mata pelajaran</p>
                    </a>
                </div>

                ${Components.card('Informasi Sistem', `
                    <p class="text-slate-600">Selamat datang di panel administrasi eLearning. Gunakan menu di atas untuk mengelola data master dan aktivitas akademik.</p>
                    <p class="text-slate-600 mt-2"><strong>Mode Demo:</strong> Semua operasi CRUD akan disimulasikan dan tidak tersimpan secara permanen.</p>
                `, 'info')}
            </div>
        `));
    },

    // Teacher Dashboard
    teacherDashboard() {
        if (!Auth.requireRole('teacher')) return;
        
        const user = Auth.getCurrentUser();
        const classes = DemoData.getClassSubjectsByTeacherId(user.teacherId);

        this.render(Components.layout(`
            <div class="space-y-6">
                <h2 class="text-2xl font-bold text-slate-800">Dashboard Guru</h2>
                <p class="text-slate-600">Selamat datang, ${user.name}</p>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    ${classes.length > 0 ? classes.map(c => `
                        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 hover:shadow-md transition-all">
                            <h3 class="text-lg font-bold text-slate-800 mb-2">${c.className}</h3>
                            <p class="text-sm text-slate-600 mb-1">${c.subjectName}</p>
                            <p class="text-sm text-slate-500">${c.day}, ${c.startTime} - ${c.endTime}</p>
                            <div class="mt-4 flex gap-2">
                                <a href="#/teacher/materials?id=${c.id}" class="flex-1 text-center px-3 py-2 bg-brand-50 text-brand-700 rounded-lg text-sm font-medium hover:bg-brand-100 transition-colors">
                                    Materi
                                </a>
                                <a href="#/teacher/assignments?id=${c.id}" class="flex-1 text-center px-3 py-2 bg-purple-50 text-purple-700 rounded-lg text-sm font-medium hover:bg-purple-100 transition-colors">
                                    Tugas
                                </a>
                            </div>
                        </div>
                    `).join('') : Components.emptyState('Belum ada jadwal mengajar')}
                </div>
            </div>
        `));
    },

    // Student Dashboard
    studentDashboard() {
        if (!Auth.requireRole('student')) return;
        
        const user = Auth.getCurrentUser();
        const classes = DemoData.getClassSubjectsByStudentId(user.studentId);

        this.render(Components.layout(`
            <div class="space-y-6">
                <h2 class="text-2xl font-bold text-slate-800">Dashboard Siswa</h2>
                <p class="text-slate-600">Selamat datang, ${user.name}</p>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    ${classes.length > 0 ? classes.map(c => `
                        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 hover:shadow-md transition-all">
                            <h3 class="text-lg font-bold text-slate-800 mb-2">${c.subjectName}</h3>
                            <p class="text-sm text-slate-600 mb-1">Guru: ${c.teacherName}</p>
                            <p class="text-sm text-slate-500">${c.day}, ${c.startTime} - ${c.endTime}</p>
                            <div class="mt-4 flex gap-2">
                                <a href="#/student/materials?id=${c.id}" class="flex-1 text-center px-3 py-2 bg-brand-50 text-brand-700 rounded-lg text-sm font-medium hover:bg-brand-100 transition-colors">
                                    Materi
                                </a>
                                <a href="#/student/assignments?id=${c.id}" class="flex-1 text-center px-3 py-2 bg-purple-50 text-purple-700 rounded-lg text-sm font-medium hover:bg-purple-100 transition-colors">
                                    Tugas
                                </a>
                            </div>
                        </div>
                    `).join('') : Components.emptyState('Belum ada mata pelajaran')}
                </div>
            </div>
        `));
    },

    // Simple list pages
    adminTeachers() {
        if (!Auth.requireRole('admin')) return;
        const teachers = DemoData.teachers;
        this.render(Components.layout(`
            <div class="space-y-6">
                <div class="flex items-center justify-between">
                    <h2 class="text-2xl font-bold text-slate-800">Data Guru</h2>
                    <a href="#/admin" class="px-4 py-2 bg-slate-100 text-slate-700 rounded-xl hover:bg-slate-200 transition-colors">Kembali</a>
                </div>
                ${Components.card('Daftar Guru', Components.table(
                    ['Nama', 'NIP', 'Email'],
                    teachers.map(t => [t.name, t.nip, t.email])
                ))}
            </div>
        `));
    },

    adminStudents() {
        if (!Auth.requireRole('admin')) return;
        const students = DemoData.students;
        this.render(Components.layout(`
            <div class="space-y-6">
                <div class="flex items-center justify-between">
                    <h2 class="text-2xl font-bold text-slate-800">Data Siswa</h2>
                    <a href="#/admin" class="px-4 py-2 bg-slate-100 text-slate-700 rounded-xl hover:bg-slate-200 transition-colors">Kembali</a>
                </div>
                ${Components.card('Daftar Siswa', Components.table(
                    ['Nama', 'NIS', 'Email', 'Kelas'],
                    students.map(s => [s.name, s.nis, s.email, DemoData.getClassById(s.classId)?.name || '-'])
                ))}
            </div>
        `));
    },

    adminClasses() {
        if (!Auth.requireRole('admin')) return;
        const classes = DemoData.classes;
        this.render(Components.layout(`
            <div class="space-y-6">
                <div class="flex items-center justify-between">
                    <h2 class="text-2xl font-bold text-slate-800">Data Kelas</h2>
                    <a href="#/admin" class="px-4 py-2 bg-slate-100 text-slate-700 rounded-xl hover:bg-slate-200 transition-colors">Kembali</a>
                </div>
                ${Components.card('Daftar Kelas', Components.table(
                    ['Nama Kelas', 'Tahun Ajaran', 'Wali Kelas'],
                    classes.map(c => [
                        c.name,
                        DemoData.academicYears.find(y => y.id === c.academicYearId)?.label || '-',
                        DemoData.getTeacherById(c.homeroomTeacherId)?.name || '-'
                    ])
                ))}
            </div>
        `));
    },

    adminSubjects() {
        if (!Auth.requireRole('admin')) return;
        const subjects = DemoData.subjects;
        this.render(Components.layout(`
            <div class="space-y-6">
                <div class="flex items-center justify-between">
                    <h2 class="text-2xl font-bold text-slate-800">Mata Pelajaran</h2>
                    <a href="#/admin" class="px-4 py-2 bg-slate-100 text-slate-700 rounded-xl hover:bg-slate-200 transition-colors">Kembali</a>
                </div>
                ${Components.card('Daftar Mata Pelajaran', `
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        ${subjects.map(s => `
                            <div class="p-4 bg-slate-50 rounded-xl border border-slate-200">
                                <p class="font-semibold text-slate-800">${s.name}</p>
                            </div>
                        `).join('')}
                    </div>
                `)}
            </div>
        `));
    },

    teacherMaterials(params) {
        if (!Auth.requireRole('teacher')) return;
        const materials = DemoData.getMaterialsByClassSubjectId(parseInt(params.id));
        this.render(Components.layout(`
            <div class="space-y-6">
                <div class="flex items-center justify-between">
                    <h2 class="text-2xl font-bold text-slate-800">Materi Pembelajaran</h2>
                    <a href="#/teacher" class="px-4 py-2 bg-slate-100 text-slate-700 rounded-xl hover:bg-slate-200 transition-colors">Kembali</a>
                </div>
                ${materials.length > 0 ? materials.map(m => `
                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100">
                        <h3 class="text-lg font-bold text-slate-800 mb-2">${m.title}</h3>
                        <p class="text-sm text-slate-600 mb-2">${m.description}</p>
                        <p class="text-xs text-slate-500">Diupload: ${m.createdAt}</p>
                        <button onclick="Toast.warning('File tidak tersedia di mode demo', 'Mode Demo')" class="mt-3 px-4 py-2 bg-brand-50 text-brand-700 rounded-lg text-sm font-medium hover:bg-brand-100 transition-colors">
                            <i data-lucide="download" class="w-4 h-4 inline-block mr-1"></i>
                            Download
                        </button>
                    </div>
                `).join('') : Components.emptyState('Belum ada materi')}
            </div>
        `));
    },

    teacherAssignments(params) {
        if (!Auth.requireRole('teacher')) return;
        const assignments = DemoData.getAssignmentsByClassSubjectId(parseInt(params.id));
        this.render(Components.layout(`
            <div class="space-y-6">
                <div class="flex items-center justify-between">
                    <h2 class="text-2xl font-bold text-slate-800">Tugas</h2>
                    <a href="#/teacher" class="px-4 py-2 bg-slate-100 text-slate-700 rounded-xl hover:bg-slate-200 transition-colors">Kembali</a>
                </div>
                ${assignments.length > 0 ? assignments.map(a => `
                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100">
                        <h3 class="text-lg font-bold text-slate-800 mb-2">${a.title}</h3>
                        <p class="text-sm text-slate-600 mb-2">${a.description}</p>
                        <p class="text-xs text-slate-500">Tenggat: ${a.dueDate}</p>
                    </div>
                `).join('') : Components.emptyState('Belum ada tugas')}
            </div>
        `));
    },

    studentMaterials(params) {
        if (!Auth.requireRole('student')) return;
        const materials = DemoData.getMaterialsByClassSubjectId(parseInt(params.id));
        this.render(Components.layout(`
            <div class="space-y-6">
                <div class="flex items-center justify-between">
                    <h2 class="text-2xl font-bold text-slate-800">Materi Pembelajaran</h2>
                    <a href="#/student" class="px-4 py-2 bg-slate-100 text-slate-700 rounded-xl hover:bg-slate-200 transition-colors">Kembali</a>
                </div>
                ${materials.length > 0 ? materials.map(m => `
                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100">
                        <h3 class="text-lg font-bold text-slate-800 mb-2">${m.title}</h3>
                        <p class="text-sm text-slate-600 mb-2">${m.description}</p>
                        <button onclick="Toast.warning('File tidak tersedia di mode demo', 'Mode Demo')" class="mt-3 px-4 py-2 bg-brand-50 text-brand-700 rounded-lg text-sm font-medium hover:bg-brand-100 transition-colors">
                            <i data-lucide="download" class="w-4 h-4 inline-block mr-1"></i>
                            Download
                        </button>
                    </div>
                `).join('') : Components.emptyState('Belum ada materi')}
            </div>
        `));
    },

    studentAssignments(params) {
        if (!Auth.requireRole('student')) return;
        const assignments = DemoData.getAssignmentsByClassSubjectId(parseInt(params.id));
        const user = Auth.getCurrentUser();
        const submissions = DemoData.getSubmissionsByStudentId(user.studentId);
        
        this.render(Components.layout(`
            <div class="space-y-6">
                <div class="flex items-center justify-between">
                    <h2 class="text-2xl font-bold text-slate-800">Tugas</h2>
                    <a href="#/student" class="px-4 py-2 bg-slate-100 text-slate-700 rounded-xl hover:bg-slate-200 transition-colors">Kembali</a>
                </div>
                ${assignments.length > 0 ? assignments.map(a => {
                    const submission = submissions.find(s => s.assignmentId === a.id);
                    return `
                        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100">
                            <h3 class="text-lg font-bold text-slate-800 mb-2">${a.title}</h3>
                            <p class="text-sm text-slate-600 mb-2">${a.description}</p>
                            <p class="text-xs text-slate-500 mb-3">Tenggat: ${a.dueDate}</p>
                            ${submission ? `
                                <div class="p-3 bg-green-50 border border-green-200 rounded-lg">
                                    <p class="text-sm text-green-800 font-semibold">✓ Sudah mengumpulkan</p>
                                    ${submission.score ? `<p class="text-sm text-green-700">Nilai: ${submission.score}</p>` : ''}
                                    ${submission.feedback ? `<p class="text-sm text-green-700">Feedback: ${submission.feedback}</p>` : ''}
                                </div>
                            ` : `
                                <button onclick="Toast.info('Upload file berhasil disimulasikan!', 'Mode Demo')" class="px-4 py-2 bg-green-600 text-white rounded-lg text-sm font-medium hover:bg-green-700 transition-colors">
                                    <i data-lucide="upload" class="w-4 h-4 inline-block mr-1"></i>
                                    Kumpulkan Tugas
                                </button>
                            `}
                        </div>
                    `;
                }).join('') : Components.emptyState('Belum ada tugas')}
            </div>
        `));
    },

    notFound() {
        this.render(`
            <div class="min-h-screen flex items-center justify-center">
                <div class="text-center">
                    <h1 class="text-6xl font-bold text-slate-900">404</h1>
                    <p class="text-xl text-slate-600 mt-4">Halaman tidak ditemukan</p>
                    <a href="#/login" class="mt-6 inline-block px-6 py-3 bg-brand-600 text-white rounded-xl hover:bg-brand-700 transition-colors">
                        Kembali ke Login
                    </a>
                </div>
            </div>
        `);
    }
};

// Initialize app when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    App.init();
});
