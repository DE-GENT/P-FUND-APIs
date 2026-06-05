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
                <h2>Role Assignments</h2>
                <p>Modify privileges and institutional tier assignments for active users.</p>
            </div>

            <div class="admin-table-section pf-dedup-10efee">
                <div class="admin-table-header">
                    <h3>Current Role Allocations</h3>
                    <div class="admin-table-actions">
                        <div class="search-container pf-dedup-cb0b02">
                            <i class="fa-solid fa-magnifying-glass pf-dedup-8cd4ae"></i>
                            <input class="pf-dedup-7a7c90" type="text" placeholder="Search by name or email...">
                        </div>
                    </div>
                </div>
                
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>USER PROFILE</th>
                            <th>CURRENT ROLE TIER</th>
                            <th>MODIFY ROLE</th>
                            <th>ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="pf-dedup-cbd12c">
                                    <img class="pf-dedup-1ca509" src="https://ui-avatars.com/api/?name=Bamum+Bismark&background=0a192f&color=fff&rounded=true" alt="User">
                                    <div>
                                        <div class="pf-dedup-1d2597">Bamum Bismark</div>
                                        <div class="pf-dedup-1ef675">bamum@p-funds.com</div>
                                    </div>
                                </div>
                            </td>
                            <td><span class="pill pf-dedup-8b7832">VETTER (L1)</span></td>
                            <td>
                                <select class="pf-dedup-c61bdc">
                                    <option value="vetter_1" selected>Vetter Level 1</option>
                                    <option value="vetter_2">Vetter Level 2</option>
                                    <option value="vetter_3">Vetter Level 3</option>
                                    <option value="sponsor">Sponsor</option>
                                </select>
                            </td>
                            <td>
                                <button class="btn-dark pf-dedup-44c466">Save Changes</button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="pf-dedup-cbd12c">
                                    <img class="pf-dedup-1ca509" src="https://ui-avatars.com/api/?name=Tech+Ventures&background=0a192f&color=fff&rounded=true" alt="User">
                                    <div>
                                        <div class="pf-dedup-1d2597">Tech Ventures Ltd</div>
                                        <div class="pf-dedup-1ef675">investments@techventures.io</div>
                                    </div>
                                </div>
                            </td>
                            <td><span class="pill pf-dedup-5a2e92">SPONSOR</span></td>
                            <td>
                                <select class="pf-dedup-c61bdc">
                                    <option value="vetter_1">Vetter Level 1</option>
                                    <option value="vetter_2">Vetter Level 2</option>
                                    <option value="vetter_3">Vetter Level 3</option>
                                    <option value="sponsor" selected>Sponsor</option>
                                </select>
                            </td>
                            <td>
                                <button class="btn-dark pf-dedup-44c466" disabled style="opacity: 0.5;">No Changes</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </main>
        
        <!-- Global Chat Panel -->
        <div class="chat-panel" id="global-chat-panel">
            <div class="chat-header pf-dedup-0feb65">
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
                <button class="pf-dedup-70512e" onclick="sendGlobalMessage()">
                    <i class="fa-solid fa-paper-plane"></i>
                </button>
            </div>
        </div>
        
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
                const res = await apiClient.get('/admin/users');
                const users = res.data || res;
                const tbody = document.querySelector('.admin-table tbody');
                tbody.innerHTML = '';
                
                users.forEach(user => {
                    const row = document.createElement('tr');
                    
                    // Format role display
                    let roleDisplay = user.role.toUpperCase();
                    if (user.role.startsWith('vetter')) {
                        let lvl = user.role.split('_')[1] || '1';
                        roleDisplay = `VETTER (L${lvl})`;
                    }
                    let rolePillClass = 'background-color: #f1f5f9; color: #475569;'; // Default grey
                    if (user.role.startsWith('vetter')) rolePillClass = 'background-color: #e0f2fe; color: #0369a1;';
                    if (user.role === 'sponsor') rolePillClass = 'background-color: #fffbeb; color: #b45309;';
                    if (user.role === 'admin') rolePillClass = 'background-color: #dcfce7; color: #166534;';

                    row.innerHTML = `
                        <td>
                            <div class="pf-dedup-cbd12c">
                                <img class="pf-dedup-1ca509" src="https://ui-avatars.com/api/?name=${encodeURIComponent(user.name)}&background=0a192f&color=fff&rounded=true" alt="User">
                                <div>
                                    <div class="pf-dedup-1d2597">${user.name}</div>
                                    <div class="pf-dedup-1ef675">${user.email}</div>
                                </div>
                            </div>
                        </td>
                        <td><span class="pill" style="${rolePillClass}">${roleDisplay}</span></td>
                        <td>
                            <select class="pf-dedup-c61bdc" id="role-select-${user.id}" onchange="enableSaveBtn(${user.id})">
                                <option value="vetter" ${user.role === 'vetter' ? 'selected' : ''}>Vetter</option>
                                <option value="vetter_1" ${user.role === 'vetter_1' ? 'selected' : ''}>Vetter Level 1</option>
                                <option value="vetter_2" ${user.role === 'vetter_2' ? 'selected' : ''}>Vetter Level 2</option>
                                <option value="vetter_3" ${user.role === 'vetter_3' ? 'selected' : ''}>Vetter Level 3</option>
                                <option value="sponsor" ${user.role === 'sponsor' ? 'selected' : ''}>Sponsor</option>
                                <option value="admin" ${user.role === 'admin' ? 'selected' : ''}>Sovereign Admin</option>
                            </select>
                        </td>
                        <td>
                            <button id="save-btn-${user.id}" class="btn-dark pf-dedup-56fd1b" disabled onclick="updateRole(${user.id})">No Changes</button>
                        </td>
                    `;
                    tbody.appendChild(row);
                });
            } catch (err) {
                console.error("Failed to load users for role assignments:", err);
                let message = 'Failed to load users. Ensure the API is running.';
                if (err.status === 403) {
                    message = 'Access Denied. You do not have permission to modify role assignments.';
                } else if (err.status === 401) {
                    message = 'Session expired. Please log in again.';
                    localStorage.removeItem('pfunds_token');
                    localStorage.removeItem('pfunds_user');
                    window.location.href = "{{ route('logout') }}";
                    return;
                }
                const tbody = document.querySelector('.admin-table tbody');
                if (tbody) {
                    tbody.innerHTML = `<tr><td class="pf-dedup-41a6e1" colspan="4"><i class="fa-solid fa-triangle-exclamation"></i> ${message}</td></tr>`;
                }
            }
        }

        function enableSaveBtn(userId) {
            const btn = document.getElementById(`save-btn-${userId}`);
            btn.disabled = false;
            btn.style.opacity = '1';
            btn.textContent = 'Save Changes';
        }

        async function updateRole(userId) {
            const select = document.getElementById(`role-select-${userId}`);
            const btn = document.getElementById(`save-btn-${userId}`);
            const newRole = select.value;
            
            btn.textContent = 'Saving...';
            btn.disabled = true;

            try {
                await apiClient.put(`/admin/users/${userId}/role`, { role: newRole });
                alert('Role updated successfully.');
                fetchUsers(); // Refresh to update pill
            } catch (err) {
                alert('Error: ' + err.message);
                btn.textContent = 'Save Changes';
                btn.disabled = false;
            }
        }

        document.addEventListener('DOMContentLoaded', fetchUsers);
    </script>
<script src="{{ asset('assets/js/notifications.js') }}"></script>
    <script src="{{ asset('assets/js/chat.js') }}?v=1.0.4"></script></body>
</html>








