// Authentication Module - LocalStorage based
const Auth = {
    // Check if user is logged in
    isLoggedIn() {
        return localStorage.getItem('currentUser') !== null;
    },

    // Get current user
    getCurrentUser() {
        const userStr = localStorage.getItem('currentUser');
        return userStr ? JSON.parse(userStr) : null;
    },

    // Login
    login(username, password) {
        const user = DemoData.users[username];
        
        if (!user) {
            return { success: false, message: 'Username tidak ditemukan' };
        }

        if (user.password !== password) {
            return { success: false, message: 'Password salah' };
        }

        // Save to localStorage
        localStorage.setItem('currentUser', JSON.stringify({
            id: user.id,
            username: user.username,
            role: user.role,
            name: user.name,
            teacherId: user.teacherId,
            studentId: user.studentId
        }));

        return { success: true, user: user };
    },

    // Logout
    logout() {
        localStorage.removeItem('currentUser');
        window.location.hash = '#/login';
    },

    // Check role
    hasRole(role) {
        const user = this.getCurrentUser();
        return user && user.role === role;
    },

    // Require authentication
    requireAuth() {
        if (!this.isLoggedIn()) {
            window.location.hash = '#/login';
            return false;
        }
        return true;
    },

    // Require specific role
    requireRole(role) {
        if (!this.requireAuth()) return false;
        
        if (!this.hasRole(role)) {
            Toast.error('Anda tidak memiliki akses ke halaman ini');
            window.location.hash = '#/login';
            return false;
        }
        return true;
    }
};
