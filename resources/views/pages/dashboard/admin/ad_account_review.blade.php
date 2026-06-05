<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/jpeg" href="{{ asset('assets/images/project logo.jpeg') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Institutional Dashboard | The Sovereign Ledger</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('dist/styles/index.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/styles/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/styles/admin.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
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
                <a href="{{ route('admin.dashboard') }}" class="nav-item active"><i class="fa-solid fa-border-all"></i> Dashboard</a>
                
                <div class="nav-group">
                    <div class="nav-group-header" onclick="this.parentElement.classList.toggle('expanded')">
                        <div class="pf-dedup-e2f701">
                            <i class="fa-solid fa-users icon"></i> Account Management
                        </div>
                        <i class="fa-solid fa-chevron-right chevron"></i>
                    </div>
                    <div class="sub-nav">
                        <a href="{{ route('admin.account-create') }}" class="sub-nav-item">Create Account</a>
                        <a href="{{ route('admin.account-review') }}" class="sub-nav-item">View Accounts</a>
                        <a href="{{ route('admin.role-assignment') }}" class="sub-nav-item">Role Assignments</a>
                        <a href="{{ route('admin.activity-logs') }}" class="sub-nav-item">Activity Logs</a>
                    </div>
                </div>

                <div class="nav-group">
                    <div class="nav-group-header" onclick="this.parentElement.classList.toggle('expanded')">
                        <div class="pf-dedup-e2f701">
                            <i class="fa-solid fa-folder-tree icon"></i> Project Management
                        </div>
                        <i class="fa-solid fa-chevron-right chevron"></i>
                    </div>
                    <div class="sub-nav">
                        <a href="{{ route('admin.project-review') }}" class="sub-nav-item">Pending Approval</a>
                        <a href="{{ route('admin.rejected-projects') }}" class="sub-nav-item">Rejected Projects</a>
                        <a href="{{ route('admin.project-tracking') }}" class="sub-nav-item">Project Tracking</a>
                        <a href="{{ route('admin.milestones') }}" class="sub-nav-item">Milestone Updates</a>
                    </div>
                </div>

                <a href="{{ route('admin.activity-logs') }}" class="nav-item"><i class="fa-regular fa-eye"></i> System Oversight</a>
                <a href="{{ route('admin.profile') }}" class="nav-item"><i class="fa-regular fa-circle-user"></i> Profile</a>
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
                    <div class="search-container">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="text" placeholder="Search institutional records...">
                    </div>
                    
                    <div class="pf-dedup-c451fd">
                        <button class="icon-btn" onclick="document.getElementById('notif-dropdown').classList.toggle('show')">
                            <i class="fa-regular fa-bell"></i>
                        </button>
                        <div class="pf-dedup-d685f1" id="notif-dropdown">
                            <div class="pf-dedup-df761f">Notifications</div>
                            <div class="pf-dedup-944892">
                                No new notifications
                            </div>
                        </div>
                    </div>
                    
                    <button class="icon-btn" onclick="alert('Settings modal coming soon!')">
                        <i class="fa-solid fa-gear"></i>
                    </button>
                    
                    

                    <div class="user-profile pf-dedup-564b7d">
                        <img src="https://ui-avatars.com/api/?name=Admin&background=0a192f&color=fff&rounded=true" alt="Admin" class="avatar" id="display-avatar">
                    </div>
                </div>
            </header>

            <div class="dashboard-header pf-dedup-53896a">
                <h2>Account Review</h2>
                <p>Manage and monitor all active and suspended institutional accounts.</p>
            </div>

            <div class="admin-table-section">
                <div class="admin-table-header">
                    <h3>Registered Accounts</h3>
                    <div class="admin-table-actions">
                        <select id="role-filter" onchange="fetchUsers()" class="btn-outline pf-dedup-d579cd">
                            <option value="">Filter by Role: All</option>
                            <option value="vetter">Vetter</option>
                            <option value="sponsor">Sponsor</option>
                            <option value="admin">Admin</option>
                        </select>
                        <button class="btn-dark pf-dedup-83552a">Export List</button>
                    </div>
                </div>
                
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>PROFILE</th>
                            <th>NAME</th>
                            <th>ROLE</th>
                            <th>STATUS</th>
                            <th>ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody id="users-table-body">
                        <!-- Dynamically populated via API -->
                        <tr><td class="pf-dedup-17f595" colspan="5"><i class="fa-solid fa-circle-notch fa-spin"></i> Loading accounts...</td></tr>
                    </tbody>
                </table>
                <div class="table-footer" id="table-footer">
                    Showing 0 registered accounts
                </div>
            </div>

        </main>
        
                <!-- Chat Widget Button -->
        <button class="chat-widget" onclick="toggleGlobalChat()">
            <i class="fa-solid fa-message"></i>
            <span class="notification-dot pf-dedup-cb4589" id="chat-notif-dot"></span>
        </button>
        
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

        // Set avatar dynamically from localStorage if present
        if (userStr) {
            try {
                const user = JSON.parse(userStr);
                const dispAvatarEl = document.getElementById('display-avatar');
                if (dispAvatarEl) {
                    dispAvatarEl.src = user.avatar_url || `https://ui-avatars.com/api/?name=${encodeURIComponent(user.name || 'Admin')}&background=064e3b&color=fff&rounded=true`;
                }
            } catch (e) {
                console.error("Error loading user profile", e);
            }
        }

        async function fetchUsers() {
            try {
                const roleFilter = document.getElementById('role-filter').value;
                const endpoint = roleFilter ? `/admin/users?role=${roleFilter}` : '/admin/users';
                const res = await apiClient.get(endpoint);
                const users = Array.isArray(res) ? res : (res.data || []);
                const tbody = document.getElementById('users-table-body');
                
                tbody.innerHTML = '';
                
                if (users.length === 0) {
                    tbody.innerHTML = '<tr><td class="pf-dedup-13076d" colspan="5">No accounts found.</td></tr>';
                    return;
                }

                users.forEach(u => {
                    let roleDisplay = '';
                    if (u.role === 'admin') roleDisplay = '<span class="pill pf-dedup-8b7832">ADMIN</span>';
                    else if (u.role === 'sponsor') roleDisplay = '<span class="pill pf-dedup-5a2e92">SPONSOR</span>';
                    else if (u.role && u.role.startsWith('vetter')) {
                        let lvl = u.role.split('_')[1] || u.vetter_level || '1';
                        roleDisplay = `<span class="pill pf-dedup-8b7832">VETTER (L${lvl})</span>`;
                    } else roleDisplay = `<span class="pill pf-dedup-56ac88">${u.role ? u.role.toUpperCase() : ''}</span>`;

                    const statusPill = u.is_active 
                        ? `<span class="pill pill-approved">ACTIVE</span>` 
                        : `<span class="pill pill-rejected">SUSPENDED</span>`;
                    
                    const suspendBtn = u.is_active
                        ? `<button class="action-icon-btn action-reject" title="Suspend" onclick="toggleSuspend(${u.id})"><i class="fa-solid fa-ban"></i></button>`
                        : `<button class="action-icon-btn action-approve" title="Reactivate" onclick="toggleSuspend(${u.id})"><i class="fa-solid fa-rotate-left"></i></button>`;

                    const row = `
                        <tr>
                            <td>
                                <img class="pf-dedup-1ca509" src="https://ui-avatars.com/api/?name=${encodeURIComponent(u.name)}&background=064e3b&color=fff&rounded=true" alt="User">
                            </td>
                            <td>${u.name}<br><small class="pf-dedup-d2abea">${u.email}</small></td>
                            <td>${roleDisplay}</td>
                            <td>${statusPill}</td>
                            <td>
                                <div class="table-action-btns">
                                    <button class="action-icon-btn action-more" title="Edit"><i class="fa-solid fa-pen"></i></button>
                                    ${suspendBtn}
                                </div>
                            </td>
                        </tr>
                    `;
                    tbody.insertAdjacentHTML('beforeend', row);
                });

                document.getElementById('table-footer').innerText = `Showing ${users.length} registered accounts`;
            } catch (err) {
                console.error("Failed to load accounts:", err);
                let message = 'Failed to load accounts. Ensure the API is running.';
                if (err.status === 403) {
                    message = 'Access Denied. You do not have permission to view registered accounts.';
                } else if (err.status === 401) {
                    message = 'Session expired. Please log in again.';
                    localStorage.removeItem('pfunds_token');
                    localStorage.removeItem('pfunds_user');
                    window.location.href = "{{ route('logout') }}";
                    return;
                }
                document.getElementById('users-table-body').innerHTML = `<tr><td class="pf-dedup-41a6e1" colspan="5"><i class="fa-solid fa-triangle-exclamation"></i> ${message}</td></tr>`;
            }
        }

        async function toggleSuspend(userId) {
            try {
                await apiClient.post(`/admin/users/${userId}/suspend`, {});
                await fetchUsers(); // Refresh the list
            } catch (err) {
                alert('Failed to toggle suspension: ' + err.message);
            }
        }

        document.addEventListener('DOMContentLoaded', fetchUsers);
    </script>
<script src="{{ asset('assets/js/notifications.js') }}"></script>
    <script src="{{ asset('assets/js/chat.js') }}?v=1.0.4"></script></body>
</html>










