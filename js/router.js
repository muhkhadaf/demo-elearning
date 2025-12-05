// Client-side Router
const Router = {
    routes: {},
    
    init() {
        window.addEventListener('hashchange', () => this.handleRoute());
        window.addEventListener('load', () => this.handleRoute());
    },

    register(path, handler) {
        this.routes[path] = handler;
    },

    handleRoute() {
        const hash = window.location.hash.slice(1) || '/login';
        const [path, ...params] = hash.split('?');
        
        const handler = this.routes[path] || this.routes['/404'];
        if (handler) {
            const queryParams = this.parseQuery(params.join('?'));
            handler(queryParams);
            
            // Reinitialize Lucide icons after content change
            setTimeout(() => {
                if (window.lucide) lucide.createIcons();
            }, 100);
        }
    },

    parseQuery(queryString) {
        const params = {};
        if (!queryString) return params;
        
        queryString.split('&').forEach(param => {
            const [key, value] = param.split('=');
            params[key] = decodeURIComponent(value);
        });
        return params;
    },

    navigate(path) {
        window.location.hash = path;
    }
};
