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
                    
                    

                    <a href="{{ route('admin.profile') }}" style="text-decoration: none; cursor: pointer;" class="user-profile pf-dedup-564b7d">
                        <img src="https://ui-avatars.com/api/?name=Admin&background=0a192f&color=fff&rounded=true" alt="Admin" class="avatar" id="display-avatar">
                    </a>
                </div>
            </header>

            <div class="dashboard-header pf-dedup-53896a">
                <h2>Project Tracking</h2>
                <p>Monitor the live vetting status and progression of active projects.</p>
            </div>

            <div class="admin-table-section">
                <div class="admin-table-header">
                    <h3>Active Projects in Vetting Pipeline</h3>
                    <div class="admin-table-actions">
                        <select class="btn-outline pf-dedup-d579cd">
                            <option value="">Status: All Active</option>
                            <option value="l1">Level 1 Review</option>
                            <option value="l2">Level 2 Review</option>
                            <option value="l3">Level 3 Review</option>
                        </select>
                        <button class="btn-dark pf-dedup-83552a">Generate Tracking Report</button>
                    </div>
                </div>
                
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>PROJECT NAME</th>
                            <th>SPONSOR</th>
                            <th>CURRENT VETTING STAGE</th>
                            <th class="pf-dedup-8a63b2">PROGRESS</th>
                            <th>ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="admin-project-cell">
                                    <div class="admin-project-icon pf-dedup-eca18a"><i class="fa-solid fa-compass-drafting"></i></div>
                                    <div class="admin-project-name">Aqua Pure Initiative</div>
                                </div>
                            </td>
                            <td>CleanEarth NGO</td>
                            <td><span class="pill pf-dedup-1089b2">LEVEL 2 (TECHNICAL)</span></td>
                            <td class="pf-dedup-8f7787">
                                <div class="pf-dedup-5c0746">
                                    <div class="pf-dedup-6b1129"></div>
                                </div>
                                <div class="pf-dedup-dde268">66% Completed</div>
                            </td>
                            <td>
                                <div class="table-action-btns">
                                    <button class="action-icon-btn action-more" title="View Full Report"><i class="fa-regular fa-file-lines"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="admin-project-cell">
                                    <div class="admin-project-icon pf-dedup-3c3e97"><i class="fa-solid fa-leaf"></i></div>
                                    <div class="admin-project-name">Green Harbor Hub</div>
                                </div>
                            </td>
                            <td>Oceanic Logistics</td>
                            <td><span class="pill pf-dedup-1fe05c">LEVEL 3 (FINAL)</span></td>
                            <td class="pf-dedup-8f7787">
                                <div class="pf-dedup-5c0746">
                                    <div class="pf-dedup-ad5ceb"></div>
                                </div>
                                <div class="pf-dedup-dde268">90% Completed</div>
                            </td>
                            <td>
                                <div class="table-action-btns">
                                    <button class="action-icon-btn action-more" title="View Full Report"><i class="fa-regular fa-file-lines"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="admin-project-cell">
                                    <div class="admin-project-icon pf-dedup-63c770"><i class="fa-solid fa-heart-pulse"></i></div>
                                    <div class="admin-project-name">MediChain Platform</div>
                                </div>
                            </td>
                            <td>HealthTech Solutions</td>
                            <td><span class="pill pf-dedup-c9e033">LEVEL 1 (SCREENING)</span></td>
                            <td class="pf-dedup-8f7787">
                                <div class="pf-dedup-5c0746">
                                    <div class="pf-dedup-e1ba52"></div>
                                </div>
                                <div class="pf-dedup-dde268">25% Completed</div>
                            </td>
                            <td>
                                <div class="table-action-btns">
                                    <button class="action-icon-btn action-more" title="View Full Report"><i class="fa-regular fa-file-lines"></i></button>
                                </div>
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

        async function fetchTrackingProjects() {
            try {
                const res = await apiClient.get('/admin/projects?status=vetting');
                const projects = Array.isArray(res) ? res : (res.data && Array.isArray(res.data.data) ? res.data.data : (Array.isArray(res.data) ? res.data : []));
                const tbody = document.querySelector('.admin-table tbody');
                tbody.innerHTML = '';
                
                if (projects.length === 0) {
                    tbody.innerHTML = '<tr><td class="pf-dedup-13076d" colspan="5">No active projects in vetting.</td></tr>';
                    return;
                }

                projects.forEach(project => {
                    const row = document.createElement('tr');
                    
                    let totalMilestones = 0;
                    let completedMilestones = 0;

                    if (project.milestones && project.milestones.length > 0) {
                        totalMilestones = project.milestones.length;
                        completedMilestones = project.milestones.filter(m => m.status === 'completed').length;
                    }

                    const progressPercent = totalMilestones > 0 ? Math.round((completedMilestones / totalMilestones) * 100) : 0;

                    let currentLevel = 'Level 1 Review (Screening)';
                    let stageBadge = '<span class="pill pf-dedup-c9e033">LEVEL 1 (SCREENING)</span>';

                    if (project.milestones && project.milestones.length > 0) {
                        const sorted = [...project.milestones].sort((a, b) => a.id - b.id);
                        const firstPending = sorted.find(m => m.status === 'pending');
                        const pendingIndex = sorted.findIndex(m => m.status === 'pending');

                        if (firstPending) {
                            currentLevel = firstPending.title;
                        } else {
                            currentLevel = 'Vetting Complete';
                        }

                        if (pendingIndex === 0) {
                            stageBadge = '<span class="pill pf-dedup-c9e033">LEVEL 1 (SCREENING)</span>';
                        } else if (pendingIndex === 1) {
                            stageBadge = '<span class="pill pf-dedup-1089b2">LEVEL 2 (TECHNICAL)</span>';
                        } else if (pendingIndex === 2) {
                            stageBadge = '<span class="pill pf-dedup-5f58e9">LEVEL 3 (FINAL)</span>';
                        } else {
                            stageBadge = '<span class="pill pf-dedup-1fe05c">APPROVED</span>';
                        }
                    }

                    row.innerHTML = `
                        <td>
                            <div class="pf-dedup-1d2597">${project.title}</div>
                            <div class="pf-dedup-1ef675">${project.category || 'N/A'}</div>
                        </td>
                        <td>
                            <div class="pf-dedup-6e1f62">${project.user ? project.user.name : 'Unknown'}</div>
                        </td>
                        <td>${stageBadge}</td>
                        <td class="pf-dedup-5d90cc">
                            <div class="pf-dedup-76a03a">
                                <span class="pf-dedup-1d2597">${currentLevel}</span>
                                <span>${progressPercent}%</span>
                            </div>
                            <div class="pf-dedup-5c0746">
                                <div style="width: ${progressPercent}%; background-color: #064e3b; height: 100%;"></div>
                            </div>
                        </td>
                        <td>
                            <a href="{{ route('admin.milestones') }}?id=${project.id}" class="btn-dark pf-dedup-5ed951">Manage</a>
                        </td>
                    `;
                    tbody.appendChild(row);
                });
            } catch (err) {
                console.error('Failed to fetch tracking projects', err);
                const tbody = document.querySelector('.admin-table tbody');
                if (tbody) {
                    tbody.innerHTML = `<tr><td class="pf-dedup-41a6e1" colspan="5"><i class="fa-solid fa-triangle-exclamation"></i> Failed to load project tracking: ${err.message || 'Please check connection.'}</td></tr>`;
                }
            }
        }

        document.addEventListener('DOMContentLoaded', fetchTrackingProjects);
    </script>
<script src="{{ asset('assets/js/notifications.js') }}"></script>
    <script src="{{ asset('assets/js/chat.js') }}?v=1.0.4"></script></body>
</html>








