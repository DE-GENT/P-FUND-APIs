<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/jpeg" href="{{ asset('assets/images/project logo.jpeg') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Settings - P-FUNDS</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('dist/styles/index.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/styles/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/styles/admin.css') }}">
    
</head>
<body>

    <div class="dashboard-container">
                <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <img class="pf-dedup-fffde0" src="{{ asset('assets/images/project logo.jpeg') }}" alt="P-FUNDS Logo">
            </div>
            
            <div class="sidebar-identity">
                <div class="role-name pf-dedup-3eb549">Sovereign Admin</div>
                <div class="role-subtitle">INSTITUTIONAL ACCESS</div>
            </div>

            <nav class="sidebar-nav">
                <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><i class="fa-solid fa-border-all"></i> Dashboard</a>
                
                <div class="nav-group {{ request()->routeIs('admin.account-create') || request()->routeIs('admin.account-review') || request()->routeIs('admin.role-assignment') || request()->routeIs('admin.activity-logs') ? 'expanded' : '' }}">
                    <div class="nav-group-header" onclick="this.parentElement.classList.toggle('expanded')">
                        <div class="pf-dedup-e2f701">
                            <i class="fa-solid fa-users icon"></i> Account Management
                        </div>
                        <i class="fa-solid fa-chevron-right chevron"></i>
                    </div>
                    <div class="sub-nav">
                        <a href="{{ route('admin.account-create') }}" class="sub-nav-item {{ request()->routeIs('admin.account-create') ? 'active' : '' }}">Create Account</a>
                        <a href="{{ route('admin.account-review') }}" class="sub-nav-item {{ request()->routeIs('admin.account-review') ? 'active' : '' }}">View Accounts</a>
                        <a href="{{ route('admin.role-assignment') }}" class="sub-nav-item {{ request()->routeIs('admin.role-assignment') ? 'active' : '' }}">Role Assignments</a>
                        <a href="{{ route('admin.activity-logs') }}" class="sub-nav-item {{ request()->routeIs('admin.activity-logs') ? 'active' : '' }}">Activity Logs</a>
                    </div>
                </div>

                <div class="nav-group {{ request()->routeIs('admin.project-review') || request()->routeIs('admin.rejected-projects') || request()->routeIs('admin.project-tracking') || request()->routeIs('admin.milestones') ? 'expanded' : '' }}">
                    <div class="nav-group-header" onclick="this.parentElement.classList.toggle('expanded')">
                        <div class="pf-dedup-e2f701">
                            <i class="fa-solid fa-folder-tree icon"></i> Project Management
                        </div>
                        <i class="fa-solid fa-chevron-right chevron"></i>
                    </div>
                    <div class="sub-nav">
                        <a href="{{ route('admin.project-review') }}" class="sub-nav-item {{ request()->routeIs('admin.project-review') ? 'active' : '' }}">Pending Approval</a>
                        <a href="{{ route('admin.rejected-projects') }}" class="sub-nav-item {{ request()->routeIs('admin.rejected-projects') ? 'active' : '' }}">Rejected Projects</a>
                        <a href="{{ route('admin.project-tracking') }}" class="sub-nav-item {{ request()->routeIs('admin.project-tracking') ? 'active' : '' }}">Project Tracking</a>
                        <a href="{{ route('admin.milestones') }}" class="sub-nav-item {{ request()->routeIs('admin.milestones') ? 'active' : '' }}">Milestone Updates</a>
                    </div>
                </div>

                <a href="{{ route('admin.activity-logs') }}" class="nav-item {{ request()->routeIs('admin.activity-logs') ? 'active' : '' }}"><i class="fa-regular fa-eye"></i> System Oversight</a>
                <a href="{{ route('admin.profile') }}" class="nav-item {{ request()->routeIs('admin.profile') ? 'active' : '' }}"><i class="fa-regular fa-circle-user"></i> Profile</a>
            </nav>

            <div class="sidebar-footer pf-dedup-56115e">
                <nav class="sidebar-nav pf-dedup-53896a">
                    <a href="#" class="nav-item">
                        <i class="fa-solid fa-shield-halved"></i> Security Logs
                    </a>
                    <a href="{{ route('logout') }}" class="nav-item">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i> Logout
                    </a>
                </nav>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
        <!-- Topbar -->
        <header class="dashboard-topbar">
            <div class="brand-logo">The Sovereign Ledger</div>
            
            <div class="topbar-actions">
                <a href="{{ route('admin.profile') }}" style="text-decoration: none; cursor: pointer;" class="user-profile">
                    <div class="pf-dedup-f6e3d7" style="text-align: right; margin-right: 10px;">
                        <div class="pf-dedup-d8427f" id="header-name" style="font-weight: 700; color: #0f172a; font-size: 14px;">Admin User</div>
                        <div class="pf-dedup-8ba16d" style="font-size: 10px; color: #64748b; text-transform: uppercase;">Sovereign Admin</div>
                    </div>
                    <img id="display-avatar" src="https://ui-avatars.com/api/?name=Admin&background=064e3b&color=fff&rounded=true" alt="Profile" class="avatar">
                </a>
            </div>
        </header>

        <div class="content-area">
            
            <div class="profile-card">
                <div class="profile-header">
                    <div class="profile-avatar" id="main-avatar">A</div>
                    <div class="profile-info">
                        <h2 id="main-name">Loading...</h2>
                        <p id="main-email">loading@p-funds.com</p>
                    </div>
                </div>
                
                <div class="profile-body">
                    <form id="profile-form">
                        <div class="pf-dedup-a75c23">
                            <div class="form-group pf-dedup-da5cd6">
                                <label>Full Name</label>
                                <input type="text" id="profile-name" required>
                            </div>
                            <div class="form-group pf-dedup-da5cd6">
                                <label>Email Address</label>
                                <input class="pf-dedup-811669" type="email" id="profile-email" required disabled>
                            </div>
                        </div>

                        <div class="pf-dedup-a75c23">
                            <div class="form-group pf-dedup-da5cd6">
                                <label>Phone Number</label>
                                <input type="text" id="profile-phone" placeholder="+1 234 567 8900">
                            </div>
                            <div class="form-group pf-dedup-da5cd6">
                                <label>Role</label>
                                <input class="pf-dedup-1219cb" type="text" id="profile-role" disabled>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" id="profile-address" placeholder="123 Main St">
                        </div>

                        <div class="pf-dedup-e03159">
                            <button type="button" class="btn-dark" onclick="updateProfile()" id="save-btn">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        </main>
    </div>

    <!-- Global Chat Integration -->
            <!-- Chat Widget Button -->
        <button class="chat-widget" onclick="toggleGlobalChat()">
            <i class="fa-solid fa-message"></i>
            <span class="notification-dot pf-dedup-cb4589" id="chat-notif-dot"></span>
        </button>

    <div class="global-chat-panel" id="global-chat-panel">
        <div class="chat-header">
            <span>Global Chat</span>
            <i class="fas fa-times pf-dedup-b202c6" onclick="toggleGlobalChat()"></i>
        </div>
        <div class="chat-messages" id="global-chat-messages">
            <!-- Messages inserted here via JS -->
        </div>
        <div class="chat-input-area">
            <input type="text" id="global-chat-input" placeholder="Type a message...">
            <button onclick="sendGlobalMessage()">
                <i class="fas fa-paper-plane"></i>
            </button>
        </div>
    </div>

    <script src="{{ asset('assets/js/api.js') }}?v=1.0.4"></script>
    <script>
        // Protect the route - check if logged in and admin
        if (!localStorage.getItem('pfunds_token') && localStorage.getItem('auth_token')) {
            localStorage.setItem('pfunds_token', localStorage.getItem('auth_token'));
        }
        if (!localStorage.getItem('pfunds_user') && localStorage.getItem('user')) {
            localStorage.setItem('pfunds_user', localStorage.getItem('user'));
        }
        const token = localStorage.getItem('pfunds_token');
        const userStr = localStorage.getItem('pfunds_user');
        let isAdmin = false;
        if (userStr) {
            try {
                const user = JSON.parse(userStr);
                if (user && user.role === 'admin') {
                    isAdmin = true;
                }
            } catch (e) {
                console.error("Error parsing user info", e);
            }
        }
        if (!token || !isAdmin) {
            window.location.href = "{{ route('logout') }}";
        }

        document.addEventListener('DOMContentLoaded', () => {
            if (userStr) {
                const user = JSON.parse(userStr);
                
                // Update UI Headers
                document.getElementById('header-name').textContent = user.name;
                const initials = user.name.charAt(0).toUpperCase();
                document.getElementById('main-avatar').textContent = initials;
                document.getElementById('main-name').textContent = user.name;
                document.getElementById('main-email').textContent = user.email;

                // Set image avatars
                const avatarUrl = user.avatar_url || `https://ui-avatars.com/api/?name=${encodeURIComponent(user.name)}&background=064e3b&color=fff&rounded=true`;
                document.getElementById('display-avatar').src = avatarUrl;

                // Populate form
                document.getElementById('profile-name').value = user.name || '';
                document.getElementById('profile-email').value = user.email || '';
                document.getElementById('profile-phone').value = user.phone || '';
                document.getElementById('profile-role').value = user.role || '';
                document.getElementById('profile-address').value = user.address || '';
            }
        });

        async function updateProfile() {
            const btn = document.getElementById('save-btn');
            btn.textContent = 'Saving...';
            btn.disabled = true;

            const payload = {
                name: document.getElementById('profile-name').value,
                phone: document.getElementById('profile-phone').value,
                address: document.getElementById('profile-address').value
            };

            try {
                const res = await apiClient.put('/me', payload);
                alert('Profile updated successfully!');
                
                // Update local storage
                const userStr = localStorage.getItem('pfunds_user');
                if (userStr) {
                    let user = JSON.parse(userStr);
                    user = { ...user, ...(res.data || res) };
                    localStorage.setItem('pfunds_user', JSON.stringify(user));
                    
                    // Refresh simple UI elements
                    document.getElementById('header-name').textContent = user.name;
                    document.getElementById('main-name').textContent = user.name;
                }
            } catch (err) {
                alert('Failed to update profile: ' + err.message);
            } finally {
                btn.textContent = 'Save Changes';
                btn.disabled = false;
            }
        }
    </script>
    <script src="{{ asset('assets/js/notifications.js') }}"></script>
    <script src="{{ asset('assets/js/chat.js') }}?v=1.0.4"></script>
</body>
</html>








