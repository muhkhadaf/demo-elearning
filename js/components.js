// Reusable UI Components
const Components = {
    // Layout wrapper
    layout(content, showDemoBanner = true) {
        const user = Auth.getCurrentUser();
        return `
            ${showDemoBanner ? `
            <div class="bg-gradient-to-r from-amber-500 to-orange-500 text-white py-2 px-4 text-center text-sm font-medium shadow-lg">
                <i data-lucide="info" class="w-4 h-4 inline-block mr-1"></i>
                MODE DEMO - Data bersifat statis dan tidak akan tersimpan secara permanen
            </div>
            ` : ''}
            
            <header class="bg-white/80 backdrop-blur-md shadow-sm sticky top-0 z-40 border-b border-slate-200/60">
                <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <a href="#/${user?.role || 'login'}" class="flex items-center gap-2 group">
                            <div class="w-8 h-8 bg-gradient-to-br from-brand-500 to-brand-700 rounded-lg flex items-center justify-center text-white shadow-lg shadow-brand-500/30 group-hover:scale-105 transition-transform">
                                <i data-lucide="layout-grid" class="w-5 h-5"></i>
                            </div>
                            <span class="text-lg md:text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-brand-700 to-brand-500">eLearning</span>
                        </a>
                    </div>
                    ${user ? `
                    <div class="flex items-center gap-4">
                        <div class="hidden sm:flex items-center gap-3 px-3 py-1.5 bg-slate-100/50 rounded-full border border-slate-200/60">
                            <div class="w-8 h-8 rounded-full bg-brand-100 text-brand-700 flex items-center justify-center">
                                <i data-lucide="user" class="w-4 h-4"></i>
                            </div>
                            <div class="flex flex-col leading-none mr-2">
                                <span class="text-sm font-semibold text-slate-700">${user.name}</span>
                                <span class="text-xs text-slate-500 capitalize">${user.role}</span>
                            </div>
                        </div>
                        <button onclick="Auth.logout()" class="inline-flex items-center gap-2 px-4 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 hover:text-red-700 transition-all font-medium text-sm">
                            <i data-lucide="log-out" class="w-4 h-4"></i>
                            <span class="hidden sm:inline">Keluar</span>
                        </button>
                    </div>
                    ` : ''}
                </div>
            </header>
            
            <main class="max-w-7xl mx-auto px-4 py-6">
                ${content}
            </main>
        `;
    },

    // Card component
    card(title, content, icon = 'file-text') {
        return `
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 hover:shadow-md transition-all">
                <h3 class="text-lg font-bold text-slate-800 mb-4 flex items-center gap-2">
                    <i data-lucide="${icon}" class="w-5 h-5 text-brand-500"></i>
                    ${title}
                </h3>
                ${content}
            </div>
        `;
    },

    // Stats card
    statsCard(label, value, icon, color = 'brand') {
        return `
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 hover:shadow-md transition-all">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-slate-500 mb-1">${label}</p>
                        <p class="text-3xl font-bold text-slate-900">${value}</p>
                    </div>
                    <div class="w-12 h-12 bg-${color}-100 rounded-xl flex items-center justify-center">
                        <i data-lucide="${icon}" class="w-6 h-6 text-${color}-600"></i>
                    </div>
                </div>
            </div>
        `;
    },

    // Empty state
    emptyState(message, icon = 'folder-open') {
        return `
            <div class="bg-white rounded-2xl p-12 text-center border border-dashed border-slate-200">
                <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i data-lucide="${icon}" class="w-8 h-8 text-slate-300"></i>
                </div>
                <h3 class="text-lg font-medium text-slate-900">Tidak ada data</h3>
                <p class="text-slate-500 mt-1">${message}</p>
            </div>
        `;
    },

    // Loading spinner
    loading() {
        return `
            <div class="flex items-center justify-center py-12">
                <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-brand-600"></div>
            </div>
        `;
    },

    // Button
    button(text, onclick, type = 'primary', icon = null) {
        const colors = {
            primary: 'bg-brand-600 hover:bg-brand-700 text-white',
            secondary: 'bg-slate-100 hover:bg-slate-200 text-slate-700',
            danger: 'bg-red-600 hover:bg-red-700 text-white'
        };
        return `
            <button onclick="${onclick}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl font-medium transition-all ${colors[type]}">
                ${icon ? `<i data-lucide="${icon}" class="w-4 h-4"></i>` : ''}
                ${text}
            </button>
        `;
    },

    // Table
    table(headers, rows) {
        return `
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-slate-50 border-b border-slate-200">
                        <tr>
                            ${headers.map(h => `<th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">${h}</th>`).join('')}
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-200">
                        ${rows.map(row => `
                            <tr class="hover:bg-slate-50 transition-colors">
                                ${row.map(cell => `<td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900">${cell}</td>`).join('')}
                            </tr>
                        `).join('')}
                    </tbody>
                </table>
            </div>
        `;
    }
};
