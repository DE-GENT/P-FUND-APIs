<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/jpeg" href="{{ asset('assets/images/project logo.jpeg') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Settings | P-FUNDS</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('dist/styles/index.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/styles/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/styles/user.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    

    
</head>
<body>
    <div class="dashboard-container">
        
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <img src="{{ asset('assets/images/project logo.jpeg') }}" alt="project-logo">
            </div>
            <nav class="sidebar-nav">
                <a href="{{ route('user.dashboard') }}" class="nav-item {{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
                    <i class="fa-solid fa-border-all"></i> Dashboard
                </a>
                <a href="{{ route('user.project-submit-1') }}" class="nav-item {{ request()->routeIs('user.project-submit-*') || request()->routeIs('user.project-confirm') ? 'active' : '' }}">
                    <i class="fa-regular fa-square-plus"></i> Submit Project
                </a>
                <a href="{{ route('user.project-review') }}" class="nav-item {{ request()->routeIs('user.project-review') ? 'active' : '' }}">
                    <i class="fa-solid fa-list-check"></i> Project Reviews
                </a>
                <a href="{{ route('user.project-update') }}" class="nav-item {{ request()->routeIs('user.project-update') || request()->routeIs('user.edit-update') ? 'active' : '' }}">
                    <i class="fa-solid fa-rotate-right"></i> Project Update
                </a>
                <a href="{{ route('user.profile') }}" class="nav-item {{ request()->routeIs('user.profile') ? 'active' : '' }}">
                    <i class="fa-regular fa-user"></i> Profile
                </a>
            </nav>
            <div class="sidebar-footer">
                <a href="{{ route('logout') }}" class="nav-item" id="logout-btn"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">

            <!-- Topbar -->
            <header class="dashboard-topbar">
                <div class="search-container">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" placeholder="Search projects...">
                </div>
                <div class="topbar-actions">
                    <div class="pf-dedup-eba4ea">
                        <button id="notif-bell-btn" class="icon-btn pf-dedup-df83b2" onclick="document.getElementById('notif-dropdown').classList.toggle('show')">
                            <i class="fa-regular fa-bell"></i>
                            <span class="pf-dedup-b7b53a" id="notif-badge">0</span>
                        </button>
                        <div class="pf-dedup-e9c927" id="notif-dropdown">
                            <!-- Dynamically populated by notifications.js -->
                        </div>
                    </div>
                    <button class="icon-btn" id="logout-btn" title="Logout">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    </button>
                    <a href="{{ route('user.profile') }}" class="user-profile" style="text-decoration: none;">
                        <div class="user-info">
                            <span class="name" id="display-name">Loading...</span>
                            <span class="role" id="display-role">USER</span>
                        </div>
                        <img src="" alt="Avatar" class="avatar" id="display-avatar">
                    </a>
                </div>
            </header>

            <!-- Profile Hero Banner -->
            <div class="profile-hero">
                <div class="hero-avatar-wrap" onclick="document.getElementById('hero-avatar-input').click()" title="Click to change photo">
                    <img src="" alt="Avatar" class="hero-avatar" id="hero-avatar">
                    <div class="avatar-overlay">
                        <i class="fa-solid fa-camera"></i>
                        Change
                    </div>
                    <div class="hero-verified-badge pf-dedup-cb4589" id="hero-verified">
                        <i class="fa-solid fa-check"></i>
                    </div>
                    <input class="pf-dedup-cb4589" type="file" id="hero-avatar-input" accept="image/jpeg,image/png,image/webp">
                </div>
                <div class="hero-info">
                    <div class="hero-name" id="hero-name">Loading...</div>
                    <div class="hero-role" id="hero-role">PROJECT SPONSOR / CREATOR</div>
                    <div class="hero-badges">
                        <span class="hero-badge"><i class="fa-solid fa-briefcase"></i> <span id="hero-specialty">—</span></span>
                        <span class="hero-badge pf-dedup-cb4589" id="hero-edu-badge"><i class="fa-solid fa-graduation-cap"></i> <span id="hero-edu">—</span></span>
                        <span class="hero-badge"><i class="fa-regular fa-calendar"></i> Member since <span id="hero-since">—</span></span>
                    </div>
                </div>
                <div class="hero-stats">
                    <div class="hero-stat">
                        <div class="hero-stat-val" id="hero-projects">0</div>
                        <div class="hero-stat-lbl">Projects</div>
                    </div>
                </div>
            </div>

            <!-- Tab Navigation -->
            <div class="profile-tabs">
                <button class="profile-tab active" data-tab="personal">
                    <i class="fa-regular fa-user"></i> Personal Info
                </button>
                <button class="profile-tab" data-tab="notifications">
                    <i class="fa-regular fa-bell"></i> Notifications
                    <span class="pf-dedup-c5e88c" id="tab-notif-count"></span>
                </button>
                <button class="profile-tab" data-tab="security">
                    <i class="fa-solid fa-shield-halved"></i> Security
                </button>
            </div>

            <!-- ═══ TAB: PERSONAL INFO ═══ -->
            <div class="tab-panel active" id="panel-personal">

                <!-- Profile Picture Card -->
                <div class="pcard">
                    <div class="pcard-title"><i class="fa-solid fa-camera"></i> Profile Picture</div>
                    <div class="avatar-card" id="avatar-drop-zone">
                        <img src="" alt="Preview" class="avatar-preview" id="avatar-preview-img">
                        <div class="avatar-card-info">
                            <h4>Upload a profile photo</h4>
                            <p>JPG, PNG or WebP — max 2MB. Shown across the platform.</p>
                            <button class="btn-upload-avatar" onclick="document.getElementById('avatar-file-input').click()">
                                <i class="fa-solid fa-arrow-up-from-bracket"></i> Choose Photo
                            </button>
                            <input class="pf-dedup-cb4589" type="file" id="avatar-file-input" accept="image/jpeg,image/png,image/webp">
                            <div class="avatar-upload-status pf-dedup-cb4589" id="avatar-status"></div>
                        </div>
                    </div>
                </div>

                <!-- Basic Info Card -->
                <div class="pcard">
                    <div class="pcard-title"><i class="fa-regular fa-id-card"></i> Basic Information</div>
                    <div class="form-grid-2 pf-dedup-be2540">
                        <div class="fg">
                            <label>Full Name</label>
                            <input type="text" id="p-name" placeholder="Your full name">
                        </div>
                        <div class="fg">
                            <label>Email Address</label>
                            <input type="email" id="p-email" readonly>
                        </div>
                        <div class="fg">
                            <label>Phone Number</label>
                            <input type="tel" id="p-phone" placeholder="+1 234 567 8900">
                        </div>
                        <div class="fg">
                            <label>Nationality</label>
                            <input type="text" id="p-nationality" placeholder="e.g. Nigerian">
                        </div>
                    </div>
                    <div class="fg pf-dedup-be2540">
                        <label>Address</label>
                        <input type="text" id="p-address" placeholder="Street, City, Country">
                    </div>
                    <div class="form-grid-2">
                        <div class="fg">
                            <label>Field of Specialty</label>
                            <input type="text" id="p-specialty" placeholder="e.g. Renewable Energy, Fintech">
                        </div>
                        <div class="fg">
                            <label>Education Level</label>
                            <select id="p-education">
                                <option value="">— Select —</option>
                                <option value="bachelors">Bachelor's Degree</option>
                                <option value="masters">Master's Degree</option>
                                <option value="phd">PhD / Doctorate</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-footer-actions">
                        <button class="btn-primary-sm" id="btn-save-profile">
                            <i class="fa-solid fa-floppy-disk"></i> Save Profile
                        </button>
                    </div>
                </div>

                <!-- Account Meta Card -->
                <div class="pcard">
                    <div class="pcard-title"><i class="fa-solid fa-circle-info"></i> Account Details</div>
                    <div class="form-grid-3">
                        <div class="fg">
                            <label>Account Role</label>
                            <input type="text" id="p-role-display" readonly>
                        </div>
                        <div class="fg">
                            <label>Email Verified</label>
                            <input type="text" id="p-verified-display" readonly>
                        </div>
                        <div class="fg">
                            <label>Member Since</label>
                            <input type="text" id="p-since-display" readonly>
                        </div>
                    </div>
                </div>

            </div>

            <!-- ═══ TAB: NOTIFICATIONS ═══ -->
            <div class="tab-panel" id="panel-notifications">
                <div class="pcard">
                    <div class="notif-filter-row">
                        <div class="notif-filter-tabs">
                            <button class="notif-ftab active" data-nfilter="all">All</button>
                            <button class="notif-ftab" data-nfilter="unread">Unread</button>
                            <button class="notif-ftab" data-nfilter="project">Projects</button>
                            <button class="notif-ftab" data-nfilter="system">System</button>
                        </div>
                        <button class="mark-all-btn" id="mark-all-read">
                            <i class="fa-solid fa-check-double"></i> Mark all read
                        </button>
                    </div>
                    <div class="notif-list" id="notif-list">
                        <!-- Notifications rendered here -->
                    </div>
                </div>
            </div>

            <!-- ═══ TAB: SECURITY ═══ -->
            <div class="tab-panel" id="panel-security">

                <!-- Change Password Card -->
                <div class="pcard">
                    <div class="pcard-title"><i class="fa-solid fa-lock"></i> Change Password</div>
                    <div class="fg pf-dedup-8e8697">
                        <label>Current Password</label>
                        <input type="password" id="pw-current" placeholder="Enter your current password">
                    </div>
                    <div class="form-grid-2">
                        <div class="fg">
                            <label>New Password</label>
                            <input type="password" id="pw-new" placeholder="Min 8 characters" oninput="checkStrength(this.value)">
                            <div class="strength-bar"><div class="strength-fill" id="strength-fill"></div></div>
                            <span class="pf-dedup-1ef675" id="strength-label">Password strength</span>
                        </div>
                        <div class="fg">
                            <label>Confirm New Password</label>
                            <input type="password" id="pw-confirm" placeholder="Repeat new password">
                        </div>
                    </div>
                    <div class="pf-dedup-4ab20f">
                        <i class="fa-solid fa-circle-info pf-dedup-f005b8"></i>
                        <span>All other active sessions will be logged out when you change your password.</span>
                    </div>
                    <div class="card-footer-actions">
                        <button class="btn-danger-sm" id="btn-change-password">
                            <i class="fa-solid fa-key"></i> Update Password
                        </button>
                    </div>
                </div>

                <!-- Security Overview Card -->
                <div class="pcard">
                    <div class="pcard-title"><i class="fa-solid fa-shield-halved"></i> Security Overview</div>
                    <div class="security-item">
                        <div>
                            <div class="security-label">Email Verification</div>
                            <div class="security-sub">Your account email is verified</div>
                        </div>
                        <div class="security-status status-ok" id="sec-email-status">
                            <i class="fa-solid fa-circle-check"></i> Checking...
                        </div>
                    </div>
                    <div class="security-item">
                        <div>
                            <div class="security-label">Active Session</div>
                            <div class="security-sub" id="sec-session-sub">Current device session</div>
                        </div>
                        <div class="security-status status-ok">
                            <i class="fa-solid fa-circle-check"></i> Active
                        </div>
                    </div>
                    <div class="security-item">
                        <div>
                            <div class="security-label">Account Role</div>
                            <div class="security-sub">Access level assigned to your account</div>
                        </div>
                        <div class="security-status status-ok" id="sec-role-display">
                            <i class="fa-solid fa-user-shield"></i> —
                        </div>
                    </div>
                </div>

            </div>

        </main>
    </div>

    <!-- Toast Notification -->
    <div class="toast" id="toast">
        <i class="fa-solid fa-circle-check"></i>
        <span id="toast-msg">Changes saved</span>
    </div>

    <script src="{{ asset('assets/js/api.js') }}?v=1.0.4"></script>
    <script src="{{ asset('assets/js/notifications.js') }}"></script>
    <script>
        /* ════════════════════════════════════════
           INIT & AUTH GUARD
        ════════════════════════════════════════ */
        let token = localStorage.getItem('pfunds_token') || localStorage.getItem('auth_token');
        if (!token) {
            window.location.href = "{{ route('logout') }}";
        } else {
            // Synchronize tokens if one is missing
            if (!localStorage.getItem('pfunds_token')) localStorage.setItem('pfunds_token', token);
            if (!localStorage.getItem('auth_token')) localStorage.setItem('auth_token', token);
        }

        let userStr = localStorage.getItem('pfunds_user') || localStorage.getItem('user');
        if (userStr) {
            if (!localStorage.getItem('pfunds_user')) localStorage.setItem('pfunds_user', userStr);
            if (!localStorage.getItem('user')) localStorage.setItem('user', userStr);
        }

        let userData = null;

        /* ════════════════════════════════════════
           TOAST HELPER
        ════════════════════════════════════════ */
        function showToast(msg, type = 'success') {
            const t = document.getElementById('toast');
            const icon = t.querySelector('i');
            document.getElementById('toast-msg').textContent = msg;
            t.className = `toast ${type}`;
            icon.className = type === 'success' ? 'fa-solid fa-circle-check' : 'fa-solid fa-circle-xmark';
            t.classList.add('show');
            setTimeout(() => t.classList.remove('show'), 3500);
        }

        /* ════════════════════════════════════════
           FETCH PROFILE FROM API
        ════════════════════════════════════════ */
        async function loadProfile() {
            try {
                const json = await apiClient.get('/me');
                userData = json.data;
                populateUI(userData);
            } catch (err) {
                showToast(err.message || 'Failed to load profile data.', 'error');
            }
        }

        function populateUI(u) {
            // Prefer the stored avatar from server; fall back to generated initials avatar
            const fallbackAvatar = `https://ui-avatars.com/api/?name=${encodeURIComponent(u.name)}&background=0D8ABC&color=fff&rounded=true&size=128`;
            const avatarUrl = u.avatar_url || fallbackAvatar;
            const since = new Date(u.created_at).toLocaleDateString('en-US', { month: 'long', year: 'numeric' });
            const roleLabel = (u.role === 'creator' || !u.role) ? 'Project Sponsor / Creator' : (u.role || 'User');
            const eduMap = { bachelors: "Bachelor's", masters: "Master's", phd: "PhD" };

            // Topbar
            document.getElementById('display-name').textContent = u.name;
            document.getElementById('display-role').textContent = roleLabel.toUpperCase();
            document.getElementById('display-avatar').src = avatarUrl;

            // Hero + avatar card preview
            document.getElementById('hero-avatar').src = avatarUrl;
            const previewEl = document.getElementById('avatar-preview-img');
            if (previewEl) previewEl.src = avatarUrl;
            document.getElementById('hero-name').textContent = u.name;
            document.getElementById('hero-role').textContent = roleLabel.toUpperCase();
            document.getElementById('hero-specialty').textContent = u.field_of_specialty || 'Not specified';
            document.getElementById('hero-projects').textContent = u.projects_count || 0;
            document.getElementById('hero-since').textContent = since;
            if (u.email_verified_at) document.getElementById('hero-verified').style.display = 'flex';
            if (u.education_level) {
                document.getElementById('hero-edu').textContent = eduMap[u.education_level] || u.education_level;
                document.getElementById('hero-edu-badge').style.display = 'flex';
            }

            // Personal Info form
            document.getElementById('p-name').value = u.name || '';
            document.getElementById('p-email').value = u.email || '';
            document.getElementById('p-phone').value = u.phone || '';
            document.getElementById('p-nationality').value = u.nationality || '';
            document.getElementById('p-address').value = u.address || '';
            document.getElementById('p-specialty').value = u.field_of_specialty || '';
            document.getElementById('p-education').value = u.education_level || '';

            // Account details
            document.getElementById('p-role-display').value = roleLabel;
            document.getElementById('p-verified-display').value = u.email_verified_at ? '✓ Verified' : '✗ Not Verified';
            document.getElementById('p-since-display').value = since;

            // Security tab
            document.getElementById('sec-email-status').innerHTML = u.email_verified_at
                ? '<i class="fa-solid fa-circle-check"></i> Verified'
                : '<i class="fa-solid fa-circle-xmark pf-dedup-c9e348"></i> Not Verified';
            document.getElementById('sec-email-status').className = `security-status ${u.email_verified_at ? 'status-ok' : 'status-warn'}`;
            document.getElementById('sec-role-display').innerHTML = `<i class="fa-solid fa-user-shield"></i> ${roleLabel}`;

            const syncedUser = { id: u.id, name: u.name, role: u.role, email: u.email, avatar_url: u.avatar_url };
            localStorage.setItem('user', JSON.stringify(syncedUser));
            localStorage.setItem('pfunds_user', JSON.stringify(syncedUser));
        }

        /* ════════════════════════════════════════
           SAVE PROFILE
        ════════════════════════════════════════ */
        document.getElementById('btn-save-profile').addEventListener('click', async () => {
            const btn = document.getElementById('btn-save-profile');
            btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Saving...';
            btn.disabled = true;

            try {
                const json = await apiClient.put('/me', {
                    name:               document.getElementById('p-name').value.trim(),
                    phone:              document.getElementById('p-phone').value.trim() || null,
                    nationality:        document.getElementById('p-nationality').value.trim() || null,
                    address:            document.getElementById('p-address').value.trim() || null,
                    field_of_specialty: document.getElementById('p-specialty').value.trim() || null,
                    education_level:    document.getElementById('p-education').value || null,
                });

                userData = json.data;
                populateUI(userData);
                showToast('Profile updated successfully!', 'success');
            } catch (err) {
                showToast(err.message || 'Update failed', 'error');
            } finally {
                btn.innerHTML = '<i class="fa-solid fa-floppy-disk"></i> Save Profile';
                btn.disabled = false;
            }
        });

        /* ════════════════════════════════════════
           PASSWORD STRENGTH
        ════════════════════════════════════════ */
        function checkStrength(val) {
            const fill = document.getElementById('strength-fill');
            const lbl = document.getElementById('strength-label');
            let score = 0;
            if (val.length >= 8) score++;
            if (/[A-Z]/.test(val)) score++;
            if (/[0-9]/.test(val)) score++;
            if (/[^A-Za-z0-9]/.test(val)) score++;

            const map = [
                { w: '0%', c: '#e2e8f0', t: 'Too short' },
                { w: '25%', c: '#ef4444', t: 'Weak' },
                { w: '50%', c: '#f59e0b', t: 'Fair' },
                { w: '75%', c: '#3b82f6', t: 'Good' },
                { w: '100%', c: '#22c55e', t: 'Strong' },
            ];
            const s = map[score];
            fill.style.width = s.w;
            fill.style.background = s.c;
            lbl.textContent = s.t;
        }

        /* ════════════════════════════════════════
           CHANGE PASSWORD
        ════════════════════════════════════════ */
        document.getElementById('btn-change-password').addEventListener('click', async () => {
            const current = document.getElementById('pw-current').value;
            const newPw = document.getElementById('pw-new').value;
            const confirm = document.getElementById('pw-confirm').value;

            if (!current || !newPw || !confirm) {
                showToast('Please fill in all password fields.', 'error'); return;
            }
            if (newPw !== confirm) {
                showToast('New passwords do not match.', 'error'); return;
            }

            const btn = document.getElementById('btn-change-password');
            btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Updating...';
            btn.disabled = true;

            try {
                const json = await apiClient.put('/me/password', {
                    current_password:      current,
                    password:              newPw,
                    password_confirmation: confirm
                });

                document.getElementById('pw-current').value = '';
                document.getElementById('pw-new').value = '';
                document.getElementById('pw-confirm').value = '';
                checkStrength('');
                showToast('Password changed! Other sessions have been logged out.', 'success');
            } catch (err) {
                showToast(err.message || 'Password change failed', 'error');
            } finally {
                btn.innerHTML = '<i class="fa-solid fa-key"></i> Update Password';
                btn.disabled = false;
            }
        });

        /* ════════════════════════════════════════
           NOTIFICATIONS (client-side from project data)
        ════════════════════════════════════════ */
        let allNotifications = [];
        let activeNFilter = 'all';

        async function loadNotifications() {
            // Build notifications from live project data
            try {
                const json = await apiClient.get('/projects');
                const projects = (json.data && json.data.data) ? json.data.data : [];

                allNotifications = [];

                projects.forEach(p => {
                    const created = new Date(p.created_at);
                    if (p.status === 'rejected' || p.admin_remarks) {
                        allNotifications.push({
                            id: `reject-${p.id}`,
                            type: 'project',
                            icon: 'red',
                            iconClass: 'fa-solid fa-circle-xmark',
                            title: `Action Required: "${p.title}"`,
                            desc: p.admin_remarks || 'Your project dossier was rejected. Please review and resubmit.',
                            time: p.reviewed_at ? timeAgo(new Date(p.reviewed_at)) : timeAgo(created),
                            read: false
                        });
                    }
                    if (p.status === 'approved') {
                        allNotifications.push({
                            id: `approved-${p.id}`,
                            type: 'project',
                            icon: 'green',
                            iconClass: 'fa-solid fa-circle-check',
                            title: `Approved: "${p.title}"`,
                            desc: 'Your project has been vetted and approved for funding consideration.',
                            time: p.reviewed_at ? timeAgo(new Date(p.reviewed_at)) : timeAgo(created),
                            read: true
                        });
                    }
                    if (p.status === 'under_review') {
                        allNotifications.push({
                            id: `review-${p.id}`,
                            type: 'project',
                            icon: 'blue',
                            iconClass: 'fa-solid fa-magnifying-glass',
                            title: `Under Review: "${p.title}"`,
                            desc: 'Vetting officers are currently reviewing your project dossier.',
                            time: timeAgo(created),
                            read: true
                        });
                    }
                    if (p.status === 'submitted') {
                        allNotifications.push({
                            id: `submitted-${p.id}`,
                            type: 'project',
                            icon: 'blue',
                            iconClass: 'fa-solid fa-paper-plane',
                            title: `Submitted: "${p.title}"`,
                            desc: 'Your project dossier was successfully submitted and is awaiting initial screening.',
                            time: timeAgo(new Date(p.submitted_at || p.created_at)),
                            read: true
                        });
                    }
                });

                // Always add a welcome system notification
                allNotifications.push({
                    id: 'sys-welcome',
                    type: 'system',
                    icon: 'purple',
                    iconClass: 'fa-solid fa-bell',
                    title: 'Welcome to P-FUNDS',
                    desc: 'Your investor account is set up. Begin by submitting your first project dossier.',
                    time: 'On registration',
                    read: true
                });

                const unread = allNotifications.filter(n => !n.read).length;
                if (unread > 0) {
                    const badge = document.getElementById('notif-badge');
                    if (badge) {
                        badge.textContent = unread;
                        badge.style.display = 'flex';
                    }
                    const tabCount = document.getElementById('tab-notif-count');
                    if (tabCount) {
                        tabCount.textContent = unread;
                        tabCount.style.display = 'inline-block';
                    }
                }

                renderNotifications();
            } catch {
                // silent fail for notifications
            }
        }

        function renderNotifications() {
            const list = document.getElementById('notif-list');
            let visible = allNotifications;
            if (activeNFilter === 'unread') visible = allNotifications.filter(n => !n.read);
            if (activeNFilter === 'project') visible = allNotifications.filter(n => n.type === 'project');
            if (activeNFilter === 'system') visible = allNotifications.filter(n => n.type === 'system');

            if (visible.length === 0) {
                list.innerHTML = `<div class="notif-empty"><i class="fa-regular fa-bell-slash"></i>No notifications here.</div>`;
                return;
            }

            list.innerHTML = visible.map(n => `
                <div class="notif-item ${n.read ? '' : 'unread'}" id="notif-${n.id}" onclick="markRead('${n.id}')">
                    <div class="notif-icon ${n.icon}"><i class="${n.iconClass}"></i></div>
                    <div class="notif-body">
                        <div class="notif-title">${n.title}</div>
                        <div class="notif-desc">${n.desc}</div>
                        <div class="notif-time"><i class="fa-regular fa-clock"></i> ${n.time}</div>
                    </div>
                    ${!n.read ? '<div class="notif-dot"></div>' : ''}
                </div>
            `).join('');
        }

        function markRead(id) {
            const n = allNotifications.find(x => x.id === id);
            if (n) n.read = true;
            renderNotifications();
            updateUnreadCount();
        }

        document.getElementById('mark-all-read').addEventListener('click', () => {
            allNotifications.forEach(n => n.read = true);
            renderNotifications();
            updateUnreadCount();
            showToast('All notifications marked as read.', 'success');
        });

        function updateUnreadCount() {
            const unread = allNotifications.filter(n => !n.read).length;
            const badge = document.getElementById('notif-badge');
            if (badge) {
                badge.textContent = unread;
                badge.style.display = unread > 0 ? 'flex' : 'none';
            }
            const tabCount = document.getElementById('tab-notif-count');
            if (tabCount) {
                tabCount.textContent = unread;
                tabCount.style.display = unread > 0 ? 'inline-block' : 'none';
            }
        }

        // Notification filter tabs
        document.querySelectorAll('.notif-ftab').forEach(btn => {
            btn.addEventListener('click', () => {
                document.querySelectorAll('.notif-ftab').forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                activeNFilter = btn.dataset.nfilter;
                renderNotifications();
            });
        });

        // Bell button scrolls to notifications tab
        const bellBtn = document.getElementById('notif-bell-btn');
        if (bellBtn) {
            bellBtn.addEventListener('click', () => {
                switchTab('notifications');
            });
        }

        /* ════════════════════════════════════════
           TAB SWITCHING
        ════════════════════════════════════════ */
        function switchTab(name) {
            document.querySelectorAll('.profile-tab').forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.tab-panel').forEach(p => p.classList.remove('active'));
            document.querySelector(`[data-tab="${name}"]`).classList.add('active');
            document.getElementById(`panel-${name}`).classList.add('active');
        }

        document.querySelectorAll('.profile-tab').forEach(tab => {
            tab.addEventListener('click', () => switchTab(tab.dataset.tab));
        });

        /* ════════════════════════════════════════
           LOGOUT
        ════════════════════════════════════════ */
        function logout() {
            logoutUser();
        }

        /* ════════════════════════════════════════
           TIME AGO HELPER
        ════════════════════════════════════════ */
        function timeAgo(date) {
            const secs = Math.floor((Date.now() - date) / 1000);
            if (secs < 60) return 'Just now';
            if (secs < 3600) return `${Math.floor(secs / 60)}m ago`;
            if (secs < 86400) return `${Math.floor(secs / 3600)}h ago`;
            if (secs < 2592000) return `${Math.floor(secs / 86400)}d ago`;
            return date.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
        }

        /* ════════════════════════════════════════
           INIT
        ════════════════════════════════════════ */
        loadProfile();
        loadNotifications();

        /* ════════════════════════════════════════
           AVATAR UPLOAD LOGIC
        ════════════════════════════════════════ */
        function getDefaultAvatar(name) {
            return `https://ui-avatars.com/api/?name=${encodeURIComponent(name || 'U')}&background=0D8ABC&color=fff&rounded=true&size=128`;
        }

        async function uploadAvatar(file) {
            if (!file) return;
            if (file.size > 2 * 1024 * 1024) {
                showToast('Image must be under 2MB.', 'error'); return;
            }

            // Instant local preview
            const reader = new FileReader();
            reader.onload = e => {
                const src = e.target.result;
                document.getElementById('hero-avatar').src = src;
                document.getElementById('avatar-preview-img').src = src;
                document.getElementById('display-avatar').src = src;
            };
            reader.readAsDataURL(file);

            // Show status
            const statusEl = document.getElementById('avatar-status');
            statusEl.style.display = 'flex';
            statusEl.innerHTML = `<i class="fa-solid fa-spinner fa-spin pf-dedup-94796f"></i> Uploading...`;

            const formData = new FormData();
            formData.append('avatar', file);

            try {
                const json = await apiClient.post('/me/avatar', formData);

                // Update with real URL
                const url = json.data.avatar_url;
                document.getElementById('hero-avatar').src = url;
                document.getElementById('avatar-preview-img').src = url;
                document.getElementById('display-avatar').src = url;

                // Sync with localStorage
                if (userData) {
                    userData.avatar_url = url;
                    const syncedUser = {
                        id: userData.id,
                        name: userData.name,
                        role: userData.role,
                        email: userData.email,
                        avatar_url: url
                    };
                    localStorage.setItem('user', JSON.stringify(syncedUser));
                    localStorage.setItem('pfunds_user', JSON.stringify(syncedUser));
                }

                statusEl.innerHTML = `<i class="fa-solid fa-circle-check pf-dedup-ec9cae"></i> Photo updated!`;
                showToast('Profile picture updated!', 'success');

                setTimeout(() => { statusEl.style.display = 'none'; }, 3000);
            } catch (err) {
                statusEl.innerHTML = `<i class="fa-solid fa-circle-xmark pf-dedup-c9e348"></i> ${err.message}`;
                showToast(err.message, 'error');
            }
        }

        // Card file input
        document.getElementById('avatar-file-input').addEventListener('change', e => {
            uploadAvatar(e.target.files[0]);
            e.target.value = '';
        });

        // Hero avatar click input
        document.getElementById('hero-avatar-input').addEventListener('change', e => {
            uploadAvatar(e.target.files[0]);
            e.target.value = '';
        });

        // Drag & drop on avatar card
        const dropZone = document.getElementById('avatar-drop-zone');
        dropZone.addEventListener('dragover', e => { e.preventDefault(); dropZone.style.borderColor = '#0ea5e9'; });
        dropZone.addEventListener('dragleave', () => { dropZone.style.borderColor = '#7dd3fc'; });
        dropZone.addEventListener('drop', e => {
            e.preventDefault();
            dropZone.style.borderColor = '#7dd3fc';
            const file = e.dataTransfer.files[0];
            if (file && file.type.startsWith('image/')) uploadAvatar(file);
        });

        // Update populateUI to handle avatar_url from API
        const _origPopulate = populateUI;
        // Override to set avatar preview too
        const origFetchProfile = loadProfile;
        // Patch: set avatar preview img when profile loads
        const _patchAvatarPreview = () => {
            const pi = document.getElementById('avatar-preview-img');
            const ha = document.getElementById('hero-avatar');
            if (pi && ha && ha.src) pi.src = ha.src;
        };
        // Run patch after profile loads with slight delay
        setTimeout(_patchAvatarPreview, 1500);
    </script>

    <!-- Global Chat Panel -->
    <div class="chat-panel" id="global-chat-panel">
        <div class="chat-header pf-dedup-53da94">
            <div class="pf-dedup-786cae">
                <i class="fa-solid fa-earth-americas"></i>
                <h3 class="pf-dedup-117a40">Global Platform Chat</h3>
            </div>
            <button class="icon-btn pf-dedup-043b8c" onclick="toggleGlobalChat()">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
        <div class="chat-messages pf-dedup-2a2823" id="global-chat-messages">
            <!-- Messages will be populated here -->
            <div class="pf-dedup-4c1a26">
                Welcome to the Global Chat.<br>All roles can interact here.
            </div>
        </div>
        <div class="chat-input pf-dedup-d466b1">
            <input class="pf-dedup-cc838c" type="text" id="global-chat-input" placeholder="Type a message...">
            <button class="pf-dedup-bde3f0" onclick="sendGlobalMessage()">
                <i class="fa-solid fa-paper-plane"></i>
            </button>
        </div>
    </div>
    
    <!-- Chat Widget Button -->
    <button class="chat-widget chat-widget-override" onclick="toggleGlobalChat()">
        <i class="fa-regular fa-message pf-dedup-fcc53c"></i>
        <span class="notification-dot pf-dedup-cb4589" id="chat-notif-dot"></span>
    </button>

    <script src="{{ asset('assets/js/chat.js') }}?v=1.0.4"></script>
</body>
</html>

