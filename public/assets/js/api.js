// LocalStorage isolation wrapper to prevent session/role clashing across tabs
(function() {
    const originalGetItem = Storage.prototype.getItem;
    const originalSetItem = Storage.prototype.setItem;
    const originalRemoveItem = Storage.prototype.removeItem;
    const originalClear = Storage.prototype.clear;

    function getPortalPrefix() {
        const path = window.location.pathname.toLowerCase();
        if (/\/dashboard\/admin(\/|$)/.test(path)) return 'admin_';
        if (/\/dashboard\/sponsor(\/|$)/.test(path)) return 'sponsor_';
        if (/\/dashboard\/vetter(\/|$)/.test(path)) return 'vetter_';
        if (/\/dashboard\/user(\/|$)/.test(path)) return 'user_';
        return '';
    }

    const authKeys = ['pfunds_token', 'pfunds_user', 'auth_token', 'user', 'user_email'];

    // Copy generic keys to prefixed keys on load if they exist (migrating after login redirection)
    const prefix = getPortalPrefix();
    if (prefix) {
        const genericToken = originalGetItem.call(localStorage, 'pfunds_token') || originalGetItem.call(localStorage, 'auth_token');
        const genericUser = originalGetItem.call(localStorage, 'pfunds_user') || originalGetItem.call(localStorage, 'user');
        
        let migrated = false;
        if (genericToken) {
            originalSetItem.call(localStorage, prefix + 'pfunds_token', genericToken);
            originalSetItem.call(localStorage, prefix + 'auth_token', genericToken);
            migrated = true;
        }
        if (genericUser) {
            originalSetItem.call(localStorage, prefix + 'pfunds_user', genericUser);
            originalSetItem.call(localStorage, prefix + 'user', genericUser);
            migrated = true;
        }
        
        // Remove generic keys so other roles/tabs don't inherit them on next login
        if (migrated) {
            authKeys.forEach(key => originalRemoveItem.call(localStorage, key));
        }
    }

    // Self-healing session validation to clear any polluted local storage state
    if (prefix) {
        const activeUserStr = originalGetItem.call(localStorage, prefix + 'pfunds_user') || originalGetItem.call(localStorage, prefix + 'user');
        if (activeUserStr) {
            try {
                const activeUser = JSON.parse(activeUserStr);
                const role = (activeUser.role || '').toLowerCase();
                let invalid = false;
                
                if (prefix === 'admin_' && role !== 'admin') invalid = true;
                if (prefix === 'sponsor_' && role !== 'sponsor') invalid = true;
                if (prefix === 'vetter_' && !role.startsWith('vetter')) invalid = true;
                if (prefix === 'user_' && role !== 'creator' && role !== 'general') invalid = true;
                
                if (invalid) {
                    console.warn(`Local storage pollution detected for role: ${role} on prefix: ${prefix}. Clearing session.`);
                    authKeys.forEach(key => originalRemoveItem.call(localStorage, prefix + key));
                    window.location.href = '/auth/login';
                }
            } catch (e) {
                console.error("Error parsing user for validation", e);
            }
        }
    }

    Storage.prototype.getItem = function(key) {
        const pref = getPortalPrefix();
        if (pref && authKeys.includes(key)) {
            return originalGetItem.call(this, pref + key);
        }
        return originalGetItem.call(this, key);
    };

    Storage.prototype.setItem = function(key, value) {
        const pref = getPortalPrefix();
        if (pref && authKeys.includes(key)) {
            return originalSetItem.call(this, pref + key, value);
        }
        return originalSetItem.call(this, key, value);
    };

    Storage.prototype.removeItem = function(key) {
        const pref = getPortalPrefix();
        if (pref && authKeys.includes(key)) {
            return originalRemoveItem.call(this, pref + key);
        }
        return originalRemoveItem.call(this, key);
    };

    Storage.prototype.clear = function() {
        const pref = getPortalPrefix();
        if (pref) {
            const keysToRemove = [];
            for (let i = 0; i < this.length; i++) {
                const key = this.key(i);
                if (key && key.startsWith(pref)) {
                    keysToRemove.push(key);
                }
            }
            keysToRemove.forEach(k => originalRemoveItem.call(this, k));
        } else {
            originalClear.call(this);
        }
    };
})();

const API_BASE_URL = window.location.origin + '/api/v1';

const apiClient = {
    async request(endpoint, options = {}) {
        const token = localStorage.getItem('pfunds_token') || localStorage.getItem('auth_token');

        const headers = {
            'Accept': 'application/json',
            ...options.headers
        };

        if (token) {
            headers['Authorization'] = `Bearer ${token}`;
        }

        if (options.body && options.body instanceof FormData) {
            // Let the browser set the boundary for FormData
        } else {
            headers['Content-Type'] = 'application/json';
        }

        const config = {
            ...options,
            headers
        };

        try {
            const response = await fetch(`${API_BASE_URL}${endpoint}`, config);

            if (response.status === 401) {
                // Token expired or unauthorized
                localStorage.removeItem('pfunds_token');
                localStorage.removeItem('pfunds_user');
                localStorage.removeItem('auth_token');
                localStorage.removeItem('user');
                localStorage.removeItem('user_email');
                window.location.href = '/auth/login';
                throw new Error('Session expired. Please login again.');
            }

            let data = {};
            const contentType = response.headers.get('content-type');
            if (contentType && contentType.includes('application/json')) {
                data = await response.json();
            } else {
                const text = await response.text();
                data = { message: text || response.statusText };
            }

            if (!response.ok) {
                const err = new Error(data.message || 'An error occurred during the request.');
                err.status = response.status;
                throw err;
            }

            return data;
        } catch (error) {
            console.error('API Request Error:', error);
            throw error;
        }
    },

    get(endpoint, options = {}) {
        return this.request(endpoint, { method: 'GET', ...options });
    },

    post(endpoint, body, options = {}) {
        const processedBody = body instanceof FormData ? body : JSON.stringify(body);
        return this.request(endpoint, { method: 'POST', body: processedBody, ...options });
    },

    put(endpoint, body, options = {}) {
        const processedBody = body instanceof FormData ? body : JSON.stringify(body);
        return this.request(endpoint, { method: 'PUT', body: processedBody, ...options });
    },

    delete(endpoint, options = {}) {
        return this.request(endpoint, { method: 'DELETE', ...options });
    }
};

function logoutUser() {
    localStorage.removeItem('pfunds_token');
    localStorage.removeItem('pfunds_user');
    localStorage.removeItem('auth_token');
    localStorage.removeItem('user');
    localStorage.removeItem('user_email');
    window.location.href = '/logout';
}

// Add responsive toggler controls dynamically on load
function initResponsiveLayout() {
    const topbar = document.querySelector('.dashboard-topbar, .header-top');
    const sidebar = document.querySelector('.sidebar');

    if (topbar && sidebar) {
        // Prevent duplicate toggler injection if already initialized
        if (topbar.querySelector('.mobile-toggle-btn')) return;

        // 1. Create a hamburger icon button for mobile
        const toggleBtn = document.createElement('button');
        toggleBtn.className = 'mobile-toggle-btn';
        toggleBtn.innerHTML = '<i class="fa-solid fa-bars"></i>';
        toggleBtn.setAttribute('aria-label', 'Toggle navigation menu');
        
        // Locate brand-logo or heading in topbar
        const logoOrHeading = topbar.querySelector('.brand-logo') || topbar.querySelector('h1, h2, h3');
        if (logoOrHeading) {
            topbar.insertBefore(toggleBtn, logoOrHeading);
        } else {
            topbar.prepend(toggleBtn);
        }

        // 2. Create overlay backdrop
        let overlay = document.querySelector('.sidebar-overlay');
        if (!overlay) {
            overlay = document.createElement('div');
            overlay.className = 'sidebar-overlay';
            document.body.appendChild(overlay);
        }

        // 3. Toggle sidebar click handlers
        toggleBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            sidebar.classList.add('active');
            overlay.classList.add('active');
            document.body.classList.add('sidebar-open');
        });

        // 4. Create close button inside sidebar header/top
        let closeBtn = sidebar.querySelector('.sidebar-close-btn');
        if (!closeBtn) {
            closeBtn = document.createElement('button');
            closeBtn.className = 'sidebar-close-btn';
            closeBtn.innerHTML = '<i class="fa-solid fa-xmark"></i>';
            closeBtn.setAttribute('aria-label', 'Close menu');
            
            // Add to sidebar header/identity
            const sidebarHeader = sidebar.querySelector('.sidebar-header') || sidebar;
            sidebarHeader.style.position = 'relative'; // Ensure button coordinates are relative to this header
            sidebarHeader.appendChild(closeBtn);
        }

        closeBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
            document.body.classList.remove('sidebar-open');
        });

        // 5. Dismiss when clicking outside (on the overlay)
        overlay.addEventListener('click', () => {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
            document.body.classList.remove('sidebar-open');
        });
    }
}

function initGlobalLogout() {
    const logoutBtns = Array.from(document.querySelectorAll('a, button, [id*="logout"]'))
        .filter(el => {
            const txt = el.textContent.trim().toLowerCase();
            return txt === 'logout' || txt.includes('log out') || el.id === 'logout-btn' || el.title?.toLowerCase() === 'logout';
        });
    logoutBtns.forEach(btn => {
        if (btn.dataset.logoutBound) return;
        btn.dataset.logoutBound = "true";
        btn.addEventListener('click', (e) => {
            if (confirm('Are you sure you want to log out?')) {
                // If it is an anchor with a valid href (not #), let it navigate naturally.
                // Otherwise, perform manual redirection to the /logout web route.
                const href = btn.getAttribute('href');
                if (btn.tagName.toLowerCase() === 'a' && href && href !== '#') {
                    // Let navigation proceed naturally
                } else {
                    e.preventDefault();
                    window.location.href = '/logout';
                }
            } else {
                e.preventDefault();
                e.stopPropagation();
            }
        });
    });
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => {
        initResponsiveLayout();
        initGlobalLogout();
    });
} else {
    initResponsiveLayout();
    initGlobalLogout();
}
