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
                <h2>Milestone Updates for <span id="project-title">Loading...</span></h2>
                <p>Track project deliverables and release authorized funding tranches.</p>
            </div>

            <div class="admin-table-section">
                <div class="admin-table-header">
                    <h3>Recent Milestone Submissions</h3>
                    <div class="admin-table-actions">
                        <select class="btn-outline pf-dedup-d579cd">
                            <option value="">Status: Pending Validation</option>
                            <option value="approved">Approved</option>
                            <option value="rejected">Needs Revision</option>
                        </select>
                    </div>
                </div>
                
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>PROJECT / MILESTONE</th>
                            <th>SPONSOR</th>
                            <th>SUBMITTED DATE</th>
                            <th>REQUESTED FUNDS</th>
                            <th>ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="admin-project-cell">
                                    <div class="admin-project-icon pf-dedup-eca18a"><i class="fa-solid fa-flag-checkered"></i></div>
                                    <div class="admin-project-name">Aurora Infrastructure<br><span class="pf-dedup-c25576">Phase 1: Site Acquisition & Legal Clearance</span></div>
                                </div>
                            </td>
                            <td>Tech Corp Innovations</td>
                            <td>Oct 25, 2023</td>
                            <td class="pf-dedup-35b45b">$350,000</td>
                            <td>
                                <div class="table-action-btns">
                                    <button class="action-icon-btn action-more" title="View Evidence"><i class="fa-solid fa-paperclip"></i></button>
                                    <button class="action-icon-btn action-approve" title="Validate & Release Funds"><i class="fa-solid fa-money-bill-transfer"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="admin-project-cell">
                                    <div class="admin-project-icon pf-dedup-63c770"><i class="fa-solid fa-flag-checkered"></i></div>
                                    <div class="admin-project-name">MediChain Platform<br><span class="pf-dedup-c25576">Alpha Prototype Deployment</span></div>
                                </div>
                            </td>
                            <td>HealthTech Solutions</td>
                            <td>Oct 24, 2023</td>
                            <td class="pf-dedup-35b45b">$120,000</td>
                            <td>
                                <div class="table-action-btns">
                                    <button class="action-icon-btn action-more" title="View Evidence"><i class="fa-solid fa-paperclip"></i></button>
                                    <button class="action-icon-btn action-approve" title="Validate & Release Funds"><i class="fa-solid fa-money-bill-transfer"></i></button>
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

        async function fetchProjectMilestones() {
            const urlParams = new URLSearchParams(window.location.search);
            const projectId = urlParams.get('id');

            if (!projectId) {
                const titleEl = document.getElementById('project-title');
                if (titleEl) titleEl.textContent = 'Select a Project';
                document.querySelector('.admin-table tbody').innerHTML = '<tr><td class="pf-dedup-350e61" colspan="5"><i class="fa-solid fa-circle-info pf-dedup-7377ba"></i> No project ID provided in URL. Please manage milestones from Project Tracking.</td></tr>';
                return;
            }

            try {
                const res = await apiClient.get(`/admin/projects/${projectId}`);
                const project = res.data || res;
                
                document.getElementById('project-title').textContent = project.title;

                const tbody = document.querySelector('.admin-table tbody');
                tbody.innerHTML = '';
                
                if (!project.milestones || project.milestones.length === 0) {
                    tbody.innerHTML = '<tr><td class="pf-dedup-350e61" colspan="5">No milestones found for this project.</td></tr>';
                    return;
                }

                project.milestones.forEach((milestone, idx) => {
                    const row = document.createElement('tr');
                    
                    let statusPill = milestone.status === 'completed' 
                        ? '<span class="pill pf-dedup-1fe05c">Completed</span>'
                        : '<span class="pill pf-dedup-c31e91">Pending</span>';

                    row.innerHTML = `
                        <td class="pf-dedup-253ab5">Phase ${idx + 1}</td>
                        <td class="pf-dedup-1d2597">${milestone.title}</td>
                        <td>${statusPill}</td>
                        <td>
                            <select class="pf-dedup-4b7af7" onchange="updateMilestone(${milestone.id}, this.value)">
                                <option value="pending" ${milestone.status === 'pending' ? 'selected' : ''}>Mark Pending</option>
                                <option value="completed" ${milestone.status === 'completed' ? 'selected' : ''}>Mark Completed</option>
                            </select>
                        </td>
                    `;
                    tbody.appendChild(row);
                });
            } catch (err) {
                console.error('Failed to fetch project milestone updates:', err);
                let message = 'Failed to load project milestones. Ensure the API is running.';
                if (err.status === 403) {
                    message = 'Access Denied. You do not have permission to view project milestone details.';
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

        async function updateMilestone(milestoneId, status) {
            try {
                await apiClient.put(`/admin/milestones/${milestoneId}`, { status });
                alert('Milestone updated successfully');
                fetchProjectMilestones();
            } catch (err) {
                alert('Error: ' + err.message);
            }
        }

        document.addEventListener('DOMContentLoaded', fetchProjectMilestones);
    </script>
<script src="{{ asset('assets/js/notifications.js') }}"></script>
    <script src="{{ asset('assets/js/chat.js') }}?v=1.0.4"></script></body>
</html>








