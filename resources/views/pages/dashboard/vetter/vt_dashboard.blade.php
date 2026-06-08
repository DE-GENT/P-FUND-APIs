<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/jpeg" href="{{ asset('assets/images/project logo.jpeg') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vetter Dashboard | P-FUNDS</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('dist/styles/index.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/styles/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/styles/vetter.css') }}">
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
            <div class="role-name">Vetter Portal</div>
            <div class="role-subtitle">REVIEW AUTHORITY</div>
        </div>
        <nav class="sidebar-nav">
            <a href="{{ route('vetter.dashboard') }}" class="nav-item {{ request()->routeIs('vetter.dashboard') ? 'active' : '' }}"><i class="fa-solid fa-border-all"></i> Dashboard</a>
            <a href="{{ route('vetter.queue') }}" class="nav-item {{ request()->routeIs('vetter.queue') ? 'active' : '' }}"><i class="fa-solid fa-layer-group"></i> Vetting Queue</a>
            <a href="{{ route('vetter.deliverables') }}" class="nav-item {{ request()->routeIs('vetter.deliverables') ? 'active' : '' }}"><i class="fa-solid fa-file-circle-check"></i> Deliverables</a>
            <a href="{{ route('vetter.profile') }}" class="nav-item {{ request()->routeIs('vetter.profile') ? 'active' : '' }}"><i class="fa-regular fa-circle-user"></i> Profile</a>
        </nav>
        <div class="sidebar-footer pf-dedup-56115e">
            <nav class="sidebar-nav pf-dedup-53896a">
                <a href="{{ route('logout') }}" class="nav-item" id="logout-btn">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i> Logout
                </a>
            </nav>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="main-content">

        <!-- Topbar -->
        <header class="dashboard-topbar">
            <div class="brand-logo pf-dedup-e7d181">Vetter Portal</div>
            <div class="topbar-actions">
                <div class="search-container">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" placeholder="Search projects..." id="search-input">
                </div>
                <div class="pf-dedup-c451fd">
                    <button class="icon-btn" onclick="document.getElementById('notif-dropdown').classList.toggle('show')">
                        <i class="fa-regular fa-bell"></i>
                    </button>
                    <div class="pf-dedup-d685f1" id="notif-dropdown"></div>
                </div>
                
                <a href="{{ route('vetter.profile') }}" style="text-decoration: none; cursor: pointer;" class="user-profile pf-dedup-564b7d">
                    <img src="https://ui-avatars.com/api/?name=Vetter&background=7c3aed&color=fff&rounded=true" alt="Vetter" class="avatar" id="display-avatar">
                    <span class="pf-dedup-edc65a" id="header-name">Vetter</span>
                </a>
            </div>
        </header>

        <div class="pf-dedup-e60e80">

            <!-- Welcome Banner -->
            <div class="pf-dedup-c193e1">
                <div>
                    <h2 class="pf-dedup-a30d09">Welcome back, <span id="welcome-name">Vetter</span> 👋</h2>
                    <p class="pf-dedup-20ca4f">You have <strong id="pending-count">—</strong> projects awaiting your vetting review.</p>
                </div>
                <a class="pf-dedup-21dcf0" href="{{ route('vetter.queue') }}">View Queue →</a>
            </div>

            <!-- Stats Grid -->
            <div class="stats-grid">
                <div class="stat-card purple">
                    <div class="stat-icon purple"><i class="fa-solid fa-layer-group"></i></div>
                    <div class="stat-value" id="stat-vetting">—</div>
                    <div class="stat-label">Projects in Vetting</div>
                </div>
                <div class="stat-card amber">
                    <div class="stat-icon amber"><i class="fa-solid fa-hourglass-half"></i></div>
                    <div class="stat-value" id="stat-pending-ms">—</div>
                    <div class="stat-label">Pending Milestones</div>
                </div>
                <div class="stat-card green">
                    <div class="stat-icon green"><i class="fa-solid fa-circle-check"></i></div>
                    <div class="stat-value" id="stat-done-ms">—</div>
                    <div class="stat-label">Completed Milestones</div>
                </div>
                <div class="stat-card blue">
                    <div class="stat-icon blue"><i class="fa-solid fa-trophy"></i></div>
                    <div class="stat-value" id="stat-approved">—</div>
                    <div class="stat-label">Fully Approved Projects</div>
                </div>
            </div>

            <!-- Recent Vetting Queue -->
            <div class="section-card">
                <div class="section-header">
                    <span class="section-title"><i class="fa-solid fa-layer-group pf-dedup-ad7151"></i>Vetting Queue — Recent</span>
                    <a class="pf-dedup-97ff9c" href="{{ route('vetter.queue') }}">View all →</a>
                </div>
                <table class="project-table">
                    <thead>
                        <tr>
                            <th>Project</th>
                            <th>Submitted By</th>
                            <th>Category</th>
                            <th>Budget</th>
                            <th>Milestones</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="queue-tbody">
                        <tr><td colspan="6" class="empty-state"><i class="fa-solid fa-spinner fa-spin"></i>Loading queue...</td></tr>
                    </tbody>
                </table>
            </div>

        </div>
    </main>
</div>

<!-- Chat Widget -->
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
    document.getElementById('welcome-name').textContent = user.name.split(' ')[0];
    document.getElementById('display-avatar').src = user.avatar_url ||
        `https://ui-avatars.com/api/?name=${encodeURIComponent(user.name)}&background=7c3aed&color=fff&rounded=true`;

    try {
        // Load stats
        const stats = await apiClient.get('/vetter/stats');
        document.getElementById('stat-vetting').textContent    = stats.vetting_projects ?? 0;
        document.getElementById('stat-pending-ms').textContent = stats.pending_milestones ?? 0;
        document.getElementById('stat-done-ms').textContent    = stats.completed_milestones ?? 0;
        document.getElementById('stat-approved').textContent   = stats.completed_projects ?? 0;
        document.getElementById('pending-count').textContent   = stats.vetting_projects ?? 0;

        // Load recent queue
        const projects = await apiClient.get('/vetter/projects');
        const list = Array.isArray(projects) ? projects : (projects.data || []);
        renderQueue(list.slice(0, 5));
    } catch (err) {
        console.error('Dashboard load failed:', err);
    }

    // Logout
});

function renderQueue(projects) {
    const tbody = document.getElementById('queue-tbody');
    if (projects.length === 0) {
        tbody.innerHTML = `<tr><td colspan="6"><div class="empty-state"><i class="fa-solid fa-inbox"></i>No projects in the vetting queue.</div></td></tr>`;
        return;
    }
    tbody.innerHTML = projects.map(p => {
        const done    = (p.milestones || []).filter(m => m.status === 'completed').length;
        const total   = (p.milestones || []).length || 3;
        const dots    = Array.from({ length: total }, (_, i) => `<div class="ms-dot ${i < done ? 'done' : 'pending'}"></div>`).join('');
        const budget  = parseFloat(p.budget_amount || 0).toLocaleString();
        return `<tr>
            <td>
                <div class="pf-dedup-2a68b4">${p.title}</div>
                <div class="pf-dedup-b26cdf">${p.category || 'General'}</div>
            </td>
            <td>${p.user ? p.user.name : '—'}</td>
            <td><span class="pill pill-vetting">${p.category || 'N/A'}</span></td>
            <td>${budget} CFA</td>
            <td>
                <div class="milestone-bar">${dots}</div>
                <div class="pf-dedup-59e05d">${done}/${total} done</div>
            </td>
            <td><a href="{{ route('vetter.queue') }}" class="btn-primary pf-dedup-46bc1d">Review</a></td>
        </tr>`;
    }).join('');
}
</script>
</body>
</html>
