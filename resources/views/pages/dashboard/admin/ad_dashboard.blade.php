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
                            <div class="pf-dedup-c1c580">Notifications</div>
                            <div class="pf-dedup-944892">
                                No new notifications
                            </div>
                        </div>
                    </div>
                    
                    <button class="icon-btn" onclick="alert('Settings modal coming soon!')">
                        <i class="fa-solid fa-gear"></i>
                    </button>
                    
                    

                    <a href="{{ route('admin.profile') }}" style="text-decoration: none; cursor: pointer;" class="user-profile pf-dedup-564b7d">
                        <img src="https://ui-avatars.com/api/?name=Admin&background=0a192f&color=fff&rounded=true" alt="Admin" class="avatar" id="display-avatar">
                    </a>
                </div>
            </header>

            <div class="dashboard-header pf-dedup-53896a">
                <h2>Institutional Dashboard</h2>
                <p>Overview of ledger performance and vetting operations.</p>
            </div>

            <!-- 5 Summary Cards -->
            <div class="admin-summary-cards">
                <div class="admin-card">
                    <div class="admin-card-header">
                        <div class="admin-card-icon icon-blue-light"><i class="fa-regular fa-id-card"></i></div>
                        <div class="admin-card-badge badge-green">+12%</div>
                    </div>
                    <div class="admin-card-title">TOTAL VETTERS</div>
                    <div class="admin-card-value">1,284</div>
                </div>
                
                <div class="admin-card">
                    <div class="admin-card-header">
                        <div class="admin-card-icon icon-green-light"><i class="fa-solid fa-clipboard-check"></i></div>
                        <div class="admin-card-badge badge-red">PRIORITY</div>
                    </div>
                    <div class="admin-card-title">PENDING PROJECTS</div>
                    <div class="admin-card-value">42</div>
                </div>

                <div class="admin-card">
                    <div class="admin-card-header">
                        <div class="admin-card-icon icon-teal-light"><i class="fa-regular fa-building"></i></div>
                    </div>
                    <div class="admin-card-title">INSTITUTIONAL SPONSORS</div>
                    <div class="admin-card-value">156</div>
                </div>

                <div class="admin-card">
                    <div class="admin-card-header">
                        <div class="admin-card-icon icon-red-light"><i class="fa-solid fa-circle-exclamation"></i></div>
                    </div>
                    <div class="admin-card-title">REJECTED / AWAITING</div>
                    <div class="admin-card-value">18</div>
                </div>

                <div class="admin-card">
                    <div class="admin-card-header">
                        <div class="admin-card-icon icon-green-light"><i class="fa-regular fa-circle-check"></i></div>
                    </div>
                    <div class="admin-card-title">APPROVED PROJECTS</div>
                    <div class="admin-card-value">204</div>
                </div>
            </div>

            <!-- Recent Project Submissions -->
            <div class="admin-table-section">
                <div class="admin-table-header">
                    <h3>Recent Project Submissions</h3>
                    <div class="admin-table-actions">
                        <button class="btn-outline">Export Ledger</button>
                        <button class="btn-dark">View All Archives</button>
                    </div>
                </div>
                
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>PROJECT NAME</th>
                            <th>DESCRIPTION</th>
                            <th>SUBMISSION DATE</th>
                            <th>STATUS</th>
                            <th>ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="admin-project-cell">
                                    <div class="admin-project-icon pf-dedup-eca18a"><i class="fa-solid fa-compass-drafting"></i></div>
                                    <div class="admin-project-name">Aurora<br>Infrastructure</div>
                                </div>
                            </td>
                            <td class="admin-project-desc">Next-generation urban grid modernization u...</td>
                            <td class="admin-project-date">Oct 24, 2023</td>
                            <td><span class="pill pill-pending">PENDING</span></td>
                            <td>
                                <div class="table-action-btns">
                                    <button class="action-icon-btn action-approve"><i class="fa-solid fa-check"></i></button>
                                    <button class="action-icon-btn action-reject"><i class="fa-solid fa-xmark"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="admin-project-cell">
                                    <div class="admin-project-icon pf-dedup-3c3e97"><i class="fa-solid fa-leaf"></i></div>
                                    <div class="admin-project-name">Green Harbor<br>Hub</div>
                                </div>
                            </td>
                            <td class="admin-project-desc">Maritime decarbonization project focused o...</td>
                            <td class="admin-project-date">Oct 22, 2023</td>
                            <td><span class="pill pill-approved">APPROVED</span></td>
                            <td>
                                <div class="table-action-btns">
                                    <button class="action-icon-btn action-more"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="admin-project-cell">
                                    <div class="admin-project-icon pf-dedup-d08dd9"><i class="fa-solid fa-money-bill-wave"></i></div>
                                    <div class="admin-project-name">Centurion<br>Fintech</div>
                                </div>
                            </td>
                            <td class="admin-project-desc">Decentralized lending protocol for micro-SM...</td>
                            <td class="admin-project-date">Oct 20, 2023</td>
                            <td><span class="pill pill-rejected">REJECTED</span></td>
                            <td>
                                <div class="table-action-btns">
                                    <button class="action-icon-btn action-history"><i class="fa-solid fa-clock-rotate-left"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="admin-project-cell">
                                    <div class="admin-project-icon pf-dedup-a7c381"><i class="fa-solid fa-satellite"></i></div>
                                    <div class="admin-project-name">Stratosphere<br>Data</div>
                                </div>
                            </td>
                            <td class="admin-project-desc">Low-earth orbit satellite constellation for ag...</td>
                            <td class="admin-project-date">Oct 19, 2023</td>
                            <td><span class="pill pill-pending">PENDING</span></td>
                            <td>
                                <div class="table-action-btns">
                                    <button class="action-icon-btn action-approve"><i class="fa-solid fa-check"></i></button>
                                    <button class="action-icon-btn action-reject"><i class="fa-solid fa-xmark"></i></button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="table-footer">
                    Showing 4 of 258 entries in the Ledger
                </div>
            </div>

            <!-- Bottom Widgets -->
            <div class="admin-bottom-widgets">
                <!-- Vetting Summary -->
                <div class="vetting-summary-widget">
                    <h3>Quarterly Vetting Summary</h3>
                    <p>Efficiency in vetting has increased by 24% following the implementation of Sovereign AI automated document verification modules. This has reduced the average response time from 12 days to 3.4 days for primary review cycles.</p>
                    <button class="btn-white">Download Annual Report</button>
                </div>

                <!-- Status Distribution -->
                <div class="status-distribution-widget">
                    <h3>Vetter Status Distribution</h3>
                    
                    <div class="distribution-item">
                        <div class="distribution-header">
                            <span class="label">Verified Active</span>
                            <span class="value">842</span>
                        </div>
                        <div class="distribution-bar-bg">
                            <div class="distribution-bar-fill fill-green"></div>
                        </div>
                    </div>

                    <div class="distribution-item">
                        <div class="distribution-header">
                            <span class="label">In Probation</span>
                            <span class="value">312</span>
                        </div>
                        <div class="distribution-bar-bg">
                            <div class="distribution-bar-fill fill-blue"></div>
                        </div>
                    </div>

                    <div class="distribution-item">
                        <div class="distribution-header">
                            <span class="label">Suspended</span>
                            <span class="value">130</span>
                        </div>
                        <div class="distribution-bar-bg">
                            <div class="distribution-bar-fill fill-red"></div>
                        </div>
                    </div>
                </div>
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

        async function fetchDashboardStats() {
            try {
                // Fetch projects and users concurrently
                const [projectsRes, usersRes] = await Promise.all([
                    apiClient.get('/admin/projects?status=all'),
                    apiClient.get('/admin/users')
                ]);

                const projects = Array.isArray(projectsRes) ? projectsRes : (projectsRes.data && Array.isArray(projectsRes.data.data) ? projectsRes.data.data : (Array.isArray(projectsRes.data) ? projectsRes.data : []));
                const users = Array.isArray(usersRes) ? usersRes : (usersRes.data || []);

                // Calculate User Stats
                const totalVetters = users.filter(u => u.role && u.role.startsWith('vetter')).length;
                const totalSponsors = users.filter(u => u.role === 'sponsor').length;

                // Calculate Project Stats
                const pendingProjects = projects.filter(p => p.status === 'submitted' || p.status === 'pending' || p.status === 'vetting').length;
                const rejectedProjects = projects.filter(p => p.status === 'rejected').length;
                const approvedProjects = projects.filter(p => p.status === 'approved').length;

                // Update UI Cards
                document.querySelectorAll('.admin-card-value')[0].textContent = totalVetters;
                document.querySelectorAll('.admin-card-value')[1].textContent = pendingProjects;
                document.querySelectorAll('.admin-card-value')[2].textContent = totalSponsors;
                document.querySelectorAll('.admin-card-value')[3].textContent = rejectedProjects;
                document.querySelectorAll('.admin-card-value')[4].textContent = approvedProjects;

                // Update Recent Submissions Table
                const tbody = document.querySelector('.admin-table tbody');
                tbody.innerHTML = '';

                // Take top 4 recent projects
                const recentProjects = projects.slice(0, 4);
                
                if (recentProjects.length === 0) {
                    tbody.innerHTML = '<tr><td class="pf-dedup-13076d" colspan="5">No projects found in the ledger.</td></tr>';
                } else {
                    recentProjects.forEach(project => {
                        const row = document.createElement('tr');
                        
                        let statusPill = `<span class="pill pf-dedup-8b7832">${project.status.toUpperCase()}</span>`;
                        if (project.status === 'approved') statusPill = `<span class="pill pill-approved pf-dedup-1fe05c">APPROVED</span>`;
                        if (project.status === 'rejected') statusPill = `<span class="pill pill-rejected pf-dedup-38e67a">REJECTED</span>`;
                        if (project.status === 'submitted' || project.status === 'vetting') statusPill = `<span class="pill pill-pending pf-dedup-f96db8">PENDING</span>`;

                        row.innerHTML = `
                            <td>
                                <div class="admin-project-cell pf-dedup-786cae">
                                    <div class="admin-project-icon pf-dedup-ea9dfc">
                                        <i class="fa-solid fa-folder-open"></i>
                                    </div>
                                    <div class="admin-project-name pf-dedup-1e29ee">${project.title}</div>
                                </div>
                            </td>
                            <td class="admin-project-desc pf-dedup-6e69b4">
                                ${project.description || 'No description available'}
                            </td>
                            <td class="admin-project-date pf-dedup-253ab5">${new Date(project.created_at).toLocaleDateString()}</td>
                            <td>${statusPill}</td>
                            <td>
                                <div class="table-action-btns pf-dedup-cfb7cc">
                                    <a href="{{ route('admin.project-review') }}" class="action-icon-btn pf-dedup-450fbb"><i class="fa-solid fa-eye"></i></a>
                                </div>
                            </td>
                        `;
                        tbody.appendChild(row);
                    });
                }
                
                // Update footer count
                document.querySelector('.table-footer').textContent = `Showing ${recentProjects.length} of ${projects.length} entries in the Ledger`;

            } catch (err) {
                console.error("Failed to fetch dashboard stats:", err);
                // Update UI Cards to error indicators
                document.querySelectorAll('.admin-card-value').forEach(el => el.textContent = '—');
                
                let message = 'Failed to load ledger data. Ensure the API is running.';
                if (err.status === 403) {
                    message = 'Access Denied. You do not have permission to view the Admin dashboard.';
                } else if (err.status === 401) {
                    message = 'Session expired. Please log in again.';
                    // Clear tokens and redirect
                    localStorage.removeItem('pfunds_token');
                    localStorage.removeItem('pfunds_user');
                    window.location.href = "{{ route('logout') }}";
                    return;
                }
                
                const tbody = document.querySelector('.admin-table tbody');
                if (tbody) {
                    tbody.innerHTML = `<tr><td class="pf-dedup-41a6e1" colspan="5"><i class="fa-solid fa-triangle-exclamation"></i> ${message}</td></tr>`;
                }
                
                const footer = document.querySelector('.table-footer');
                if (footer) {
                    footer.textContent = 'Error loading ledger';
                }
            }
        }

        document.addEventListener('DOMContentLoaded', fetchDashboardStats);
    </script>
<script src="{{ asset('assets/js/notifications.js') }}"></script>
    <script src="{{ asset('assets/js/chat.js') }}?v=1.0.4"></script></body>
</html>








