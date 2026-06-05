<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/jpeg" href="{{ asset('assets/images/project logo.jpeg') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vetter Profile | P-FUNDS</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('dist/styles/index.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/styles/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/styles/vetter.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
</head>
<body>
<div class="dashboard-container">
    <aside class="sidebar">
        <div class="sidebar-header">
            <img class="pf-dedup-fffde0" src="{{ asset('assets/images/project logo.jpeg') }}" alt="P-FUNDS Logo">
        </div>
        <div class="sidebar-identity">
            <div class="role-name pf-dedup-4eb23a">Vetter Portal</div>
            <div class="role-subtitle pf-dedup-0c6e55">REVIEW AUTHORITY</div>
        </div>
        <nav class="sidebar-nav">
            <a href="{{ route('vetter.dashboard') }}" class="nav-item"><i class="fa-solid fa-border-all"></i> Dashboard</a>
            <a href="{{ route('vetter.queue') }}" class="nav-item"><i class="fa-solid fa-layer-group"></i> Vetting Queue</a>
            <a href="{{ route('vetter.deliverables') }}" class="nav-item"><i class="fa-solid fa-file-circle-check"></i> Deliverables</a>
            <a href="{{ route('vetter.profile') }}" class="nav-item active"><i class="fa-regular fa-circle-user"></i> Profile</a>
        </nav>
        <div class="sidebar-footer pf-dedup-56115e">
            <nav class="sidebar-nav pf-dedup-53896a">
                <a href="{{ route('logout') }}" class="nav-item" id="logout-btn"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a>
            </nav>
        </div>
    </aside>

    <main class="main-content">
        <header class="dashboard-topbar">
            <div class="brand-logo pf-dedup-e7d181">My Profile</div>
            <div class="topbar-actions">
                <div class="pf-dedup-c451fd">
                    <button class="icon-btn" onclick="document.getElementById('notif-dropdown').classList.toggle('show')">
                        <i class="fa-regular fa-bell"></i>
                    </button>
                    <div class="pf-dedup-d685f1" id="notif-dropdown"></div>
                </div>
                <div class="user-profile pf-dedup-564b7d">
                    <img src="https://ui-avatars.com/api/?name=Vetter&background=7c3aed&color=fff&rounded=true" alt="Vetter" class="avatar" id="display-avatar">
                    <span class="pf-dedup-edc65a" id="header-name">Vetter</span>
                </div>
            </div>
        </header>

        <div class="profile-grid">
            <!-- Avatar card -->
            <div>
                <div class="profile-avatar-card">
                    <div class="profile-avatar-ring">
                        <img src="https://ui-avatars.com/api/?name=Vetter&background=7c3aed&color=fff" id="avatar-img" alt="Avatar">
                    </div>
                    <div class="profile-name" id="prof-name">—</div>
                    <div class="profile-role">Vetter</div>
                    <div class="profile-email" id="prof-email">—</div>

                    <div class="profile-stat">
                        <div class="profile-stat-val" id="stat-milestones">—</div>
                        <div class="profile-stat-lbl">Milestones Reviewed</div>
                    </div>
                </div>
            </div>

            <!-- Edit form -->
            <div class="form-card">
                <h3>Edit Profile Information</h3>
                <div class="form-row">
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" id="input-name" placeholder="Full name">
                    </div>
                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" id="input-email" placeholder="Email" disabled>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="text" id="input-phone" placeholder="e.g. +234 800 000 0000">
                    </div>
                    <div class="form-group">
                        <label>Role</label>
                        <input type="text" id="input-role" value="Vetter" disabled>
                    </div>
                </div>
                <div class="form-group pf-dedup-37d30b">
                    <label>Address</label>
                    <input type="text" id="input-address" placeholder="Your address">
                </div>
                <div class="pf-dedup-b95a4c">
                    <button class="btn-save" id="save-btn" onclick="saveProfile()">Save Changes</button>
                </div>

                <div class="pf-dedup-b974b3">
                    <h3 class="pf-dedup-e3727f">Change Password</h3>
                    <div class="form-row">
                        <div class="form-group">
                            <label>New Password</label>
                            <input type="password" id="input-password" placeholder="Min 8 characters">
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" id="input-confirm" placeholder="Repeat password">
                        </div>
                    </div>
                    <div class="pf-dedup-b95a4c">
                        <button class="btn-save" onclick="changePassword()">Update Password</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<!-- Chat -->
<button class="chat-widget" onclick="toggleGlobalChat()">
    <i class="fa-solid fa-message"></i>
    <span class="notification-dot pf-dedup-cb4589" id="chat-notif-dot"></span>
</button>
<!-- Chat Panel -->
<div class="chat-panel" id="global-chat-panel">
    <div class="chat-header pf-dedup-6f024a">
        <div class="pf-dedup-786cae">
            <i class="fa-solid fa-earth-americas"></i>
            <h3 class="pf-dedup-6d676d">Global Platform Chat</h3>
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
        <button class="pf-dedup-48783f" onclick="sendGlobalMessage()">
            <i class="fa-solid fa-paper-plane"></i>
        </button>
    </div>
</div>

<script src="{{ asset('assets/js/api.js') }}?v=1.0.4"></script>
<script src="{{ asset('assets/js/notifications.js') }}"></script>
<script src="{{ asset('assets/js/chat.js') }}?v=1.0.4"></script>
<script>
document.addEventListener('DOMContentLoaded', async () => {
    // Auth and Role check
    const token = localStorage.getItem('pfunds_token') || localStorage.getItem('auth_token');
    const userStr = localStorage.getItem('pfunds_user') || localStorage.getItem('user');
    if (!token || !userStr) { 
        window.location.href = "{{ route('logout') }}"; 
        return; 
    }

    const user = JSON.parse(userStr);
    const userRole = (user.role || '').toLowerCase();
    
    // Ensure the user has a Vetter role
    if (!userRole.startsWith('vetter')) {
        alert('Access Denied: You do not have permission to access the Vetter Portal.');
        if (userRole === 'admin') {
            window.location.href = "{{ route('admin.dashboard') }}";
        } else if (userRole === 'sponsor') {
            window.location.href = "{{ route('sponsor.dashboard') }}";
        } else {
            window.location.href = "{{ route('user.dashboard') }}";
        }
        return;
    }

    // Set avatar/name from user data
    document.getElementById('header-name').textContent = user.name;
    document.getElementById('prof-name').textContent   = user.name;
    document.getElementById('prof-email').textContent  = user.email;
    document.getElementById('input-name').value    = user.name || '';
    document.getElementById('input-email').value   = user.email || '';
    document.getElementById('input-phone').value   = user.phone || '';
    document.getElementById('input-address').value = user.address || '';
    const avatar = user.avatar_url || `https://ui-avatars.com/api/?name=${encodeURIComponent(user.name)}&background=7c3aed&color=fff&rounded=true`;
    document.getElementById('avatar-img').src    = avatar;
    document.getElementById('display-avatar').src = avatar;

    // Load stats
    try {
        const stats = await apiClient.get('/vetter/stats');
        document.getElementById('stat-milestones').textContent = stats.completed_milestones ?? '—';
    } catch (e) {}

});

async function saveProfile() {
    const btn = document.getElementById('save-btn');
    btn.textContent = 'Saving...'; btn.disabled = true;
    try {
        const res = await apiClient.put('/me', {
            name:    document.getElementById('input-name').value,
            phone:   document.getElementById('input-phone').value,
            address: document.getElementById('input-address').value,
        });
        const updated = res.data || res;
        const userStr = localStorage.getItem('pfunds_user');
        if (userStr) {
            let user = JSON.parse(userStr);
            user = { ...user, ...updated };
            localStorage.setItem('pfunds_user', JSON.stringify(user));
            document.getElementById('prof-name').textContent = user.name;
            document.getElementById('header-name').textContent = user.name;
        }
        alert('Profile updated successfully!');
    } catch (err) {
        alert('Failed: ' + err.message);
    } finally {
        btn.textContent = 'Save Changes'; btn.disabled = false;
    }
}

async function changePassword() {
    const pw  = document.getElementById('input-password').value;
    const cpw = document.getElementById('input-confirm').value;
    if (!pw) { alert('Please enter a new password.'); return; }
    if (pw !== cpw) { alert('Passwords do not match.'); return; }
    try {
        await apiClient.put('/me/password', { password: pw, password_confirmation: cpw });
        alert('Password changed successfully!');
        document.getElementById('input-password').value = '';
        document.getElementById('input-confirm').value  = '';
    } catch (err) {
        alert('Failed: ' + err.message);
    }
}
</script>
</body>
</html>
