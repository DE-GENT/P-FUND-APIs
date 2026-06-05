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
                <h2>System Activity Logs</h2>
                <p>Audit trail of all administrative and vetting actions across the platform.</p>
            </div>

            <div class="admin-table-section">
                <div class="admin-table-header">
                    <h3>Recent Platform Events</h3>
                    <div class="admin-table-actions">
                        <input type="date" class="btn-outline pf-dedup-035243">
                        <select class="btn-outline pf-dedup-d579cd">
                            <option value="">Event Type: All</option>
                            <option value="auth">Authentication</option>
                            <option value="vetting">Vetting Decisions</option>
                            <option value="admin">Admin Actions</option>
                        </select>
                        <button class="btn-dark pf-dedup-83552a">Export CSV</button>
                    </div>
                </div>
                
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>TIMESTAMP</th>
                            <th>USER / ACTOR</th>
                            <th>EVENT ACTION</th>
                            <th>TARGET DETAILS</th>
                            <th>IP ADDRESS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="pf-dedup-253ab5">Oct 25, 2023 <br> 14:32:05 UTC</td>
                            <td>
                                <div class="pf-dedup-1e29ee">System Admin</div>
                                <div class="pf-dedup-1ef675">admin_01@p-funds.com</div>
                            </td>
                            <td><span class="pill pill-approved">PROJECT ACCEPTED</span></td>
                            <td class="pf-dedup-6e1f62">Accepted 'Aurora Infrastructure' to Vetting Level 1. Allocated 7 days.</td>
                            <td class="pf-dedup-4c522b">192.168.1.45</td>
                        </tr>
                        <tr>
                            <td class="pf-dedup-253ab5">Oct 25, 2023 <br> 12:15:22 UTC</td>
                            <td>
                                <div class="pf-dedup-1e29ee">Bamum Bismark</div>
                                <div class="pf-dedup-1ef675">bamum@p-funds.com</div>
                            </td>
                            <td><span class="pill pill-pending pf-dedup-c9e033">VETTING SUBMITTED</span></td>
                            <td class="pf-dedup-6e1f62">Submitted Level 1 Review for 'MediChain Platform'. Recommendation: Proceed.</td>
                            <td class="pf-dedup-4c522b">203.0.113.82</td>
                        </tr>
                        <tr>
                            <td class="pf-dedup-253ab5">Oct 25, 2023 <br> 09:05:11 UTC</td>
                            <td>
                                <div class="pf-dedup-1e29ee">System Admin</div>
                                <div class="pf-dedup-1ef675">admin_01@p-funds.com</div>
                            </td>
                            <td><span class="pill pill-rejected">ACCOUNT SUSPENDED</span></td>
                            <td class="pf-dedup-6e1f62">Suspended Vetter account 'invest_vetter_09'. Reason: Inactivity.</td>
                            <td class="pf-dedup-4c522b">192.168.1.45</td>
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

        async function fetchActivityLogs() {
            try {
                const res = await apiClient.get('/admin/activity-logs');
                const logs = res.data || res;
                const tbody = document.querySelector('.admin-table tbody');
                tbody.innerHTML = '';
                
                if (logs.length === 0) {
                    tbody.innerHTML = '<tr><td class="pf-dedup-13076d" colspan="5">No activity recorded yet.</td></tr>';
                    return;
                }

                logs.forEach(log => {
                    const row = document.createElement('tr');
                    
                    let pillClass = 'background-color: #f1f5f9; color: #475569;';
                    if (log.action.includes('CREATED')) pillClass = 'background-color: #dcfce7; color: #166534;';
                    if (log.action.includes('SUSPEND') || log.action.includes('REJECT')) pillClass = 'background-color: #fee2e2; color: #991b1b;';
                    if (log.action.includes('VETTING') || log.action.includes('UPDATED')) pillClass = 'background-color: #e0f2fe; color: #0369a1;';

                    row.innerHTML = `
                        <td class="pf-dedup-253ab5">${new Date(log.created_at).toLocaleString()}</td>
                        <td>
                            <div class="pf-dedup-1e29ee">${log.user ? log.user.name : 'System'}</div>
                            <div class="pf-dedup-1ef675">${log.user ? log.user.email : ''}</div>
                        </td>
                        <td><span class="pill" style="${pillClass}">${log.action}</span></td>
                        <td class="pf-dedup-6e1f62">${log.details}</td>
                        <td class="pf-dedup-4c522b">${log.ip_address || 'N/A'}</td>
                    `;
                    tbody.appendChild(row);
                });
            } catch (err) {
                console.error('Failed to fetch activity logs', err);
                let message = 'Failed to load activity logs. Ensure the API is running.';
                if (err.status === 403) {
                    message = 'Access Denied. You do not have permission to view system activity logs.';
                } else if (err.status === 401) {
                    message = 'Session expired. Please log in again.';
                    localStorage.removeItem('pfunds_token');
                    localStorage.removeItem('pfunds_user');
                    window.location.href = "{{ route('logout') }}";
                    return;
                }
                const tbody = document.querySelector('.admin-table tbody');
                if (tbody) {
                    tbody.innerHTML = `<tr><td class="pf-dedup-41a6e1" colspan="5"><i class="fa-solid fa-triangle-exclamation"></i> ${message}</td></tr>`;
                }
            }
        }

        document.addEventListener('DOMContentLoaded', fetchActivityLogs);
    </script>
<script src="{{ asset('assets/js/notifications.js') }}"></script>
    <script src="{{ asset('assets/js/chat.js') }}?v=1.0.4"></script></body>
</html>








