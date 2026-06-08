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
                <h2>Pending Project Approval</h2>
                <p>Review newly submitted projects and allocate vetting time frames.</p>
            </div>

            <div class="admin-table-section">
                <div class="admin-table-header">
                    <h3>Projects Awaiting Primary Approval</h3>
                </div>
                
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>PROJECT NAME</th>
                            <th>CREATOR / SPONSOR</th>
                            <th>FUNDING REQ.</th>
                            <th>SUBMISSION DATE</th>
                            <th>ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody id="projects-table-body">
                        <!-- Dynamically populated via API -->
                        <tr><td class="pf-dedup-17f595" colspan="5"><i class="fa-solid fa-circle-notch fa-spin"></i> Loading pending projects...</td></tr>
                    </tbody>
                </table>
            </div>

            <!-- Documents Modal -->
            <div class="pf-dedup-ae54ef" id="docs-modal">
                <div class="pf-dedup-a0a810">
                    <div class="pf-dedup-622f6b">
                        <div>
                            <div class="pf-dedup-57ae16"><i class="fa-solid fa-folder-open pf-dedup-d10994"></i>Project Files</div>
                            <div class="pf-dedup-d044c4" id="docs-modal-project"></div>
                        </div>
                        <button class="pf-dedup-7b5594" onclick="closeDocModal()"><i class="fa-solid fa-xmark"></i></button>
                    </div>
                    <div class="pf-dedup-ca8e2e" id="docs-modal-body">
                        <div class="pf-dedup-66751c"><i class="fa-solid fa-spinner fa-spin"></i> Loading files...</div>
                    </div>
                </div>
            </div>

            <!-- Time Allocation Modal -->
            <div class="pf-dedup-1a1b6d" id="allocation-modal">
                <div class="pf-dedup-0f5895">
                    <div class="pf-dedup-654257">
                        <h3 class="pf-dedup-1386d5">Allocate Vetting Duration</h3>
                        <button class="pf-dedup-0155c6" onclick="closeTimeAllocationModal()"><i class="fa-solid fa-xmark"></i></button>
                    </div>
                    
                    <p class="pf-dedup-2cb61d">
                        You are pushing <strong id="modal-project-name">Project</strong> to the vetting queue. Define the timeline limits for vetters to complete their reviews.
                    </p>

                    <div class="pf-dedup-9ab9be">
                        <label class="pf-dedup-034617">Level 1 Vetting (Days)</label>
                        <input class="pf-dedup-9d728a" type="number" id="l1_duration" min="1" value="7">
                    </div>
                    
                    <div class="pf-dedup-9ab9be">
                        <label class="pf-dedup-034617">Level 2 Vetting (Days)</label>
                        <input class="pf-dedup-9d728a" type="number" id="l2_duration" min="1" value="14">
                    </div>

                    <div class="pf-dedup-e1b245">
                        <label class="pf-dedup-034617">Level 3 Vetting (Days)</label>
                        <input class="pf-dedup-9d728a" type="number" id="l3_duration" min="1" value="7">
                    </div>

                    <div class="pf-dedup-d012df">
                        <button class="btn-outline" onclick="closeTimeAllocationModal()">Cancel</button>
                        <button class="btn-dark pf-dedup-83552a" onclick="confirmAllocation()">Confirm & Push to Vetting</button>
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

        let pendingProjects = [];
        let selectedProjectId = null;

        async function fetchPendingProjects() {
            try {
                const res = await apiClient.get('/admin/projects');
                const allProjects = Array.isArray(res) ? res : (res.data && Array.isArray(res.data.data) ? res.data.data : (Array.isArray(res.data) ? res.data : []));
                // Filter only pending/submitted projects
                pendingProjects = allProjects.filter(p => p.status === 'pending' || p.status === 'submitted');
                
                const tbody = document.getElementById('projects-table-body');
                tbody.innerHTML = '';
                
                if (pendingProjects.length === 0) {
                    tbody.innerHTML = '<tr><td class="pf-dedup-17f595" colspan="5">No projects currently awaiting review.</td></tr>';
                    return;
                }

                pendingProjects.forEach(p => {
                    const row = `
                        <tr>
                            <td>
                                <div class="admin-project-cell">
                                    <div class="admin-project-icon pf-dedup-eca18a"><i class="fa-solid fa-compass-drafting"></i></div>
                                    <div class="admin-project-name">${p.title}<br><span class="pf-dedup-c25576">${p.category || 'General'}</span></div>
                                </div>
                            </td>
                            <td>${p.user ? p.user.name : 'Unknown'}</td>
                            <td>${parseFloat(p.budget_amount).toLocaleString()} CFA</td>
                            <td>${new Date(p.submitted_at || p.created_at).toLocaleDateString()}</td>
                            <td>
                                <div class="table-action-btns">
                                    <button class="action-icon-btn action-more pf-dedup-5efc21" title="View Documents" onclick="openDocModal(${p.id}, '${p.title.replace(/'/g, "\'")}')"><i class="fa-solid fa-file-pdf"></i></button>
                                    <button class="action-icon-btn action-approve" title="Accept to Vetting" onclick="openTimeAllocationModal(${p.id}, '${p.title.replace(/'/g, "\'")}')"><i class="fa-solid fa-check"></i></button>
                                    <button class="action-icon-btn action-reject" title="Reject" onclick="rejectProject(${p.id})"><i class="fa-solid fa-xmark"></i></button>
                                </div>
                            </td>
                        </tr>
                    `;
                    tbody.insertAdjacentHTML('beforeend', row);
                });

            } catch (error) {
                console.error(error);
                document.getElementById('projects-table-body').innerHTML = `<tr><td class="pf-dedup-41a6e1" colspan="5"><i class="fa-solid fa-triangle-exclamation"></i> Error loading pending projects: ${error.message || 'Please check connection.'}</td></tr>`;
            }
        }

        function openTimeAllocationModal(projectId, projectName) {
            selectedProjectId = projectId;
            document.getElementById('modal-project-name').textContent = projectName;
            document.getElementById('allocation-modal').style.display = 'flex';
        }

        function closeTimeAllocationModal() {
            selectedProjectId = null;
            document.getElementById('allocation-modal').style.display = 'none';
        }

        async function confirmAllocation() {
            if (!selectedProjectId) return;
            
            const l1 = parseInt(document.getElementById('l1_duration').value);
            const l2 = parseInt(document.getElementById('l2_duration').value);
            const l3 = parseInt(document.getElementById('l3_duration').value);

            try {
                await apiClient.post(`/admin/projects/${selectedProjectId}/review`, {
                    status: 'vetting',
                    l1_duration: l1,
                    l2_duration: l2,
                    l3_duration: l3
                });
                
                alert('Project successfully pushed to vetting queue.');
                closeTimeAllocationModal();
                fetchPendingProjects(); // refresh table
            } catch (err) {
                alert('Error: ' + err.message);
            }
        }

        async function rejectProject(projectId) {
            if (!confirm('Are you sure you want to completely reject this project submission?')) return;
            
            try {
                await apiClient.post(`/admin/projects/${projectId}/review`, {
                    status: 'rejected'
                });
                alert('Project rejected.');
                fetchPendingProjects();
            } catch (err) {
                alert('Error: ' + err.message);
            }
        }

        document.addEventListener('DOMContentLoaded', fetchPendingProjects);

        // ── Document Modal ────────────────────────────────────────────
        function openDocModal(projectId, projectName) {
            document.getElementById('docs-modal').style.display = 'flex';
            document.getElementById('docs-modal-project').textContent = projectName;
            document.getElementById('docs-modal-body').innerHTML =
                '<div class="pf-dedup-66751c"><i class="fa-solid fa-spinner fa-spin"></i> Loading files...</div>';
            loadDocFiles(projectId);
        }

        function closeDocModal() {
            document.getElementById('docs-modal').style.display = 'none';
        }

        async function loadDocFiles(projectId) {
            const body = document.getElementById('docs-modal-body');
            try {
                const res  = await apiClient.get(`/projects/${projectId}/all-documents`);
                const data = res.data || res;
                const docs  = data.documents    || [];
                const deliv = data.deliverables || [];

                const fileTypeIcon = (name) => {
                    const ext = (name || '').split('.').pop().toLowerCase();
                    if (ext === 'pdf')                          return { icon: 'fa-file-pdf',   bg: '#fee2e2', color: '#dc2626' };
                    if (['doc','docx'].includes(ext))           return { icon: 'fa-file-word',  bg: '#dbeafe', color: '#2563eb' };
                    if (['jpg','jpeg','png','gif'].includes(ext)) return { icon: 'fa-file-image', bg: '#d1fae5', color: '#059669' };
                    return { icon: 'fa-file', bg: '#ede9fe', color: '#7c3aed' };
                };

                const buildRow = (f, label) => {
                    const ft   = fileTypeIcon(f.name || f.title || '');
                    const size = f.size ? (f.size > 1048576 ? (f.size/1048576).toFixed(1)+' MB' : (f.size/1024).toFixed(0)+' KB') : '';
                    const dl   = f.download_url
                        ? `<button class="pf-dedup-1a83e3" onclick="downloadFile('${f.download_url}','${(f.name||f.title||'file').replace(/'/g,"\'")}',this)">
                               <i class="fa-solid fa-download"></i> Open</button>`
                        : `<span class="pf-dedup-4b0af8">No file</span>`;
                    return `<div class="pf-dedup-44a5b9">
                        <div style="width:36px;height:36px;border-radius:8px;background:${ft.bg};color:${ft.color};display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <i class="fa-solid ${ft.icon}"></i></div>
                        <div class="pf-dedup-89bd09">
                            <div class="pf-dedup-c02f77">${f.name || f.title || 'Unnamed'}</div>
                            <div class="pf-dedup-b26cdf">${label} ${size ? '· '+size : ''}</div>
                        </div>
                        ${dl}
                    </div>`;
                };

                let html = '';
                html += `<div class="pf-dedup-c2208b">
                    <i class="fa-solid fa-file-alt pf-dedup-332b21"></i>Proposal Documents (${docs.length})</div>`;
                html += docs.length ? docs.map(d => buildRow(d, 'Proposal')).join('') : '<p class="pf-dedup-b6b503">No documents uploaded.</p>';

                html += `<div class="pf-dedup-38f306">
                    <i class="fa-solid fa-paper-plane pf-dedup-be1238"></i>Deliverables (${deliv.length})</div>`;
                html += deliv.length ? deliv.map(d => buildRow(d, 'Deliverable')).join('') : '<p class="pf-dedup-b6b503">No deliverables submitted.</p>';

                body.innerHTML = html;
            } catch (err) {
                body.innerHTML = `<p class="pf-dedup-4b9fe3">Failed to load files: ${err.message}</p>`;
            }
        }

        function downloadFile(url, filename, btn) {
            btn.disabled = true;
            btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Opening...';
            const token = localStorage.getItem('pfunds_token');
            fetch(url, { headers: { 'Authorization': 'Bearer ' + token, 'Accept': '*/*' } })
                .then(r => r.blob())
                .then(blob => {
                    const bUrl = URL.createObjectURL(blob);
                    window.open(bUrl, '_blank');
                    btn.disabled = false;
                    btn.innerHTML = '<i class="fa-solid fa-download"></i> Open';
                })
                .catch(() => {
                    alert('Could not open file.');
                    btn.disabled = false;
                    btn.innerHTML = '<i class="fa-solid fa-download"></i> Open';
                });
        }

    </script>
<script src="{{ asset('assets/js/notifications.js') }}"></script>
    <script src="{{ asset('assets/js/chat.js') }}?v=1.0.4"></script></body>
</html>










