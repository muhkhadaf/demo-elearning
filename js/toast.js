// Toast Notification System
const Toast = {
    container: null,

    init() {
        this.container = document.getElementById('toast-container');
        if (!this.container) {
            this.container = document.createElement('div');
            this.container.id = 'toast-container';
            this.container.className = 'fixed top-4 right-4 z-50 flex flex-col gap-2';
            document.body.appendChild(this.container);
        }
    },

    show(message, type = 'info', title = '', duration = 4000) {
        if (!this.container) this.init();

        const toast = document.createElement('div');
        toast.className = `min-w-[300px] p-4 rounded-xl shadow-lg flex items-start gap-3 animate-slide-in bg-white border-l-4 ${this.getTypeClasses(type)}`;

        const icons = {
            info: '<svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="#3b82f6" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
            success: '<svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="#10b981" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
            warning: '<svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="#f59e0b" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>',
            error: '<svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="#ef4444" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>'
        };

        const defaultTitles = {
            info: 'Informasi',
            success: 'Berhasil',
            warning: 'Peringatan',
            error: 'Error'
        };

        toast.innerHTML = `
            ${icons[type]}
            <div class="flex-1">
                <div class="font-semibold text-sm text-slate-900">${title || defaultTitles[type]}</div>
                <div class="text-sm text-slate-600 mt-0.5">${message}</div>
            </div>
            <button class="text-slate-400 hover:text-slate-600 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        `;

        this.container.appendChild(toast);

        // Close button
        toast.querySelector('button').addEventListener('click', () => {
            this.remove(toast);
        });

        // Auto remove
        if (duration > 0) {
            setTimeout(() => {
                this.remove(toast);
            }, duration);
        }
    },

    remove(toast) {
        toast.style.animation = 'slide-out 0.3s ease-out forwards';
        setTimeout(() => {
            toast.remove();
        }, 300);
    },

    getTypeClasses(type) {
        const classes = {
            info: 'border-blue-500',
            success: 'border-green-500',
            warning: 'border-yellow-500',
            error: 'border-red-500'
        };
        return classes[type] || classes.info;
    },

    info(message, title = '') {
        this.show(message, 'info', title);
    },

    success(message, title = '') {
        this.show(message, 'success', title);
    },

    warning(message, title = '') {
        this.show(message, 'warning', title);
    },

    error(message, title = '') {
        this.show(message, 'error', title);
    }
};

// Add animations
const style = document.createElement('style');
style.textContent = `
    @keyframes slide-in {
        from {
            transform: translateX(400px);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    @keyframes slide-out {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(400px);
            opacity: 0;
        }
    }
    .animate-slide-in {
        animation: slide-in 0.3s ease-out;
    }
`;
document.head.appendChild(style);

// Initialize on load
document.addEventListener('DOMContentLoaded', () => {
    Toast.init();
});
