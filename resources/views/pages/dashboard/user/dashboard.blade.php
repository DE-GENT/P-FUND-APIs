<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/jpeg" href="{{ asset('assets/images/project logo.jpeg') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Overview | P-FUNDS</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('dist/styles/index.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/styles/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/styles/user.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    
</head>
<body>
    <div class="dashboard-container">
        
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <img src="{{ asset('assets/images/project logo.jpeg') }}" alt="project-logo">
            </div>
            
            <nav class="sidebar-nav">
                <a href="{{ route('user.dashboard') }}" class="nav-item {{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
                    <i class="fa-solid fa-border-all"></i>
                    Dashboard
                </a>
                <a href="{{ route('user.project-submit-1') }}" class="nav-item {{ request()->routeIs('user.project-submit-*') || request()->routeIs('user.project-confirm') ? 'active' : '' }}">
                    <i class="fa-regular fa-square-plus"></i>
                    Submit Project
                </a>
                <a href="{{ route('user.project-review') }}" class="nav-item {{ request()->routeIs('user.project-review') ? 'active' : '' }}">
                    <i class="fa-solid fa-list-check"></i>
                    Project Reviews
                </a>
                <a href="{{ route('user.project-update') }}" class="nav-item {{ request()->routeIs('user.project-update') || request()->routeIs('user.edit-update') ? 'active' : '' }}">
                    <i class="fa-solid fa-rotate-right"></i>
                    Project Update
                </a>
                <a href="{{ route('user.profile') }}" class="nav-item {{ request()->routeIs('user.profile') ? 'active' : '' }}">
                    <i class="fa-regular fa-user"></i>
                    Profile
                </a>
            </nav>
            <div class="sidebar-footer">
                <a href="{{ route('logout') }}" class="nav-item" id="logout-btn"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a>
            </div>
            
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            
            <!-- Topbar -->
            <header class="dashboard-topbar">
                <div class="search-container">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" placeholder="Search projects...">
                </div>
                
                <div class="topbar-actions">
                    <div class="pf-dedup-eba4ea">
                        <button class="icon-btn pf-dedup-df83b2" onclick="document.getElementById('notif-dropdown').classList.toggle('show')">
                            <i class="fa-regular fa-bell"></i>
                        </button>
                        <div class="pf-dedup-e9c927" id="notif-dropdown">
                            <!-- Dynamically populated by notifications.js -->
                        </div>
                    </div>
                    <button class="icon-btn">
                        <i class="fa-regular fa-circle-question"></i>
                    </button>
                    <button class="icon-btn" id="logout-btn" title="Logout">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    </button>
                    
                    <a href="{{ route('user.profile') }}" style="text-decoration: none; cursor: pointer;" class="user-profile">
                        <div class="user-info">
                            <span class="name" id="display-name">Loading...</span>
                            <span class="role" id="display-role">USER</span>
                        </div>
                        <img src="https://ui-avatars.com/api/?name=User&background=0D8ABC&color=fff&rounded=true" alt="User" class="avatar" id="display-avatar">
                    </a>
                </div>
            </header>

            <!-- Dashboard Title Area -->
            <div class="dashboard-header">
                <h2>Dashboard Overview</h2>
                <p>Monitor your funding applications and communication with vetting officers.</p>
            </div>
            <!-- Summary Cards -->
            <div class="summary-cards">
                <div class="card">
                    <div class="card-title">TOTAL PROJECTS SUBMITTED</div>
                    <div class="card-value" id="stats-submitted">0</div>
                    <div class="card-trend trend-up" id="stats-submitted-sub">
                        <i class="fa-solid fa-arrow-trend-up"></i> Active submissions
                    </div>
                    <div class="card-icon icon-blue">
                        <i class="fa-regular fa-file-lines"></i>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-title">PROJECTS REJECTED</div>
                    <div class="card-value" id="stats-rejected">0</div>
                    <div class="card-subtitle" id="stats-rejected-sub">Requires immediate review</div>
                    <div class="card-icon icon-red">
                        <i class="fa-regular fa-circle-xmark"></i>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-title">AWAITING UPDATE</div>
                    <div class="card-value" id="stats-drafts">0</div>
                    <div class="card-subtitle pf-dedup-2a4cda" id="stats-drafts-sub"><i class="fa-regular fa-clock"></i> Drafts in progress</div>
                    <div class="card-icon icon-orange">
                        <i class="fa-solid fa-clipboard-list"></i>
                    </div>
                </div>
            </div>

            <!-- Dashboard Title Area -->
            <div class="dashboard-header">
                <h2>My Project Submissions</h2>
                <p>Monitor your project submissions and their progress through the institutional review stages.</p>
            </div>

            <!-- Recent Projects Table -->
            <div class="recent-projects">
                <div class="table-responsive">
                    <table class="modern-project-table">
                        <thead>
                            <tr>
                                <th>PROJECT NAME</th>
                                <th>SUBMISSION DATE</th>
                                <th>VETTING STAGE</th>
                                <th>FUNDING REQUESTED</th>
                                <th>STATUS</th>
                            </tr>
                        </thead>
                        <tbody id="projects-table-body">
                            <tr>
                                <td class="pf-dedup-fc86ee" colspan="5">
                                    <i class="fa-solid fa-spinner fa-spin pf-dedup-3abde7"></i>
                                    <p>Loading project dossiers from Sovereign Ledger...</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <div class="modern-table-footer">
                    <div class="showing-text">Showing 1 to 5 of 12 projects</div>
                    <div class="modern-pagination">
                        <a href="#" class="page-arrow"><i class="fa-solid fa-angle-left"></i></a>
                        <a href="#" class="page-num active">1</a>
                        <a href="#" class="page-num">2</a>
                        <a href="#" class="page-num">3</a>
                        <a href="#" class="page-arrow"><i class="fa-solid fa-angle-right"></i></a>
                    </div>
                </div>
            </div>

        </main>
        
        <!-- Chat Widget Button -->
        <button class="chat-widget" onclick="toggleGlobalChat()">
            <i class="fa-solid fa-message"></i>
            <span class="notification-dot pf-dedup-cb4589" id="chat-notif-dot"></span>
        </button>

        <!-- Global Chat Panel -->
        <div class="chat-panel" id="global-chat-panel">
            <div class="chat-header pf-dedup-53da94">
                <div class="pf-dedup-786cae">
                    <i class="fa-solid fa-earth-americas"></i>
                    <h3 class="pf-dedup-117a40">Global Platform Chat</h3>
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
                <button class="pf-dedup-bde3f0" onclick="sendGlobalMessage()">
                    <i class="fa-solid fa-paper-plane"></i>
                </button>
            </div>
        </div>
        
    </div>

    <script src="{{ asset('assets/js/api.js') }}?v=1.0.4"></script>
    <script src="{{ asset('assets/js/notifications.js') }}"></script>
    <script src="{{ asset('assets/js/chat.js') }}?v=1.0.4"></script>
    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            // 1. Protect the route - check if logged in and validate role
            const token = localStorage.getItem('pfunds_token') || localStorage.getItem('auth_token');
            const userStr = localStorage.getItem('pfunds_user') || localStorage.getItem('user');
            
            if (!token || !userStr) {
                window.location.href = "{{ route('logout') }}";
                return;
            } else {
                if (!localStorage.getItem('pfunds_token')) localStorage.setItem('pfunds_token', token);
                if (!localStorage.getItem('auth_token')) localStorage.setItem('auth_token', token);
            }

            const user = JSON.parse(userStr);
            const userRole = (user.role || '').toLowerCase();
            
            if (userRole.startsWith('vetter')) {
                window.location.href = "{{ route('vetter.dashboard') }}";
                return;
            } else if (userRole === 'admin') {
                window.location.href = "{{ route('admin.dashboard') }}";
                return;
            } else if (userRole === 'sponsor') {
                window.location.href = "{{ route('user.dashboard') }}";
                return;
            }

            // 2. Load User Data from Storage
            if (userStr) {
                if (!localStorage.getItem('pfunds_user')) localStorage.setItem('pfunds_user', userStr);
                if (!localStorage.getItem('user')) localStorage.setItem('user', userStr);
                try {
                    const nameDisplay = document.getElementById('display-name');
                    const roleDisplay = document.getElementById('display-role');
                    const avatarImg = document.getElementById('display-avatar');

                    if (nameDisplay) nameDisplay.textContent = user.name;
                    
                    // Format role for display
                    let role = user.role || 'GENERAL USER';
                    if (role.toLowerCase() === 'creator' || role.toLowerCase() === 'general') {
                        role = 'PROJECT SPONSOR / CREATOR';
                    }
                    if (roleDisplay) roleDisplay.textContent = role.toUpperCase();

                    // Load custom avatar or fallback to initials generator
                    if (avatarImg) {
                        avatarImg.src = user.avatar_url || `https://ui-avatars.com/api/?name=${encodeURIComponent(user.name || 'User')}&background=0D8ABC&color=fff&rounded=true`;
                    }
                } catch (e) {
                    console.error("Error parsing user data");
                }
            }

            // Fetch Projects and Populate Stats
            async function loadDashboardData() {
                try {
                    const json = await apiClient.get('/projects');
                    const projects = json.data.data || [];

                    // 1. Calculate Stats
                    let totalSubmitted = 0;
                    let totalRejected = 0;
                    let totalDrafts = 0;
                    let totalNeedsUpdate = 0;

                    projects.forEach(project => {
                        const status = (project.status || '').toLowerCase();
                        if (status === 'draft') {
                            totalDrafts++;
                        } else if (status === 'needs_update') {
                            totalNeedsUpdate++;
                        } else if (status === 'rejected') {
                            totalRejected++;
                            totalSubmitted++; // also count in total submissions
                        } else {
                            totalSubmitted++;
                        }
                    });

                    document.getElementById('stats-submitted').textContent = String(totalSubmitted).padStart(2, '0');
                    document.getElementById('stats-rejected').textContent = String(totalRejected).padStart(2, '0');
                    document.getElementById('stats-drafts').textContent = String(totalDrafts + totalNeedsUpdate).padStart(2, '0');
                    
                    const draftsSub = document.getElementById('stats-drafts-sub');
                    if (draftsSub) {
                        draftsSub.innerHTML = `<i class="fa-regular fa-clock"></i> ${totalDrafts} drafts, ${totalNeedsUpdate} requiring update`;
                    }

                    // 2. Populate Table
                    const tbody = document.getElementById('projects-table-body');
                    tbody.innerHTML = '';

                    if (projects.length === 0) {
                        tbody.innerHTML = `
                            <tr>
                                <td class="pf-dedup-fc86ee" colspan="5">
                                    <i class="fa-regular fa-folder-open pf-dedup-3abde7"></i>
                                    <p>No project dossiers found. Submit a new project to get started!</p>
                                </td>
                            </tr>
                        `;
                        return;
                    }

                    projects.forEach(project => {
                        // Vetting Stage configuration
                        let stageText = 'Initial Screening';
                        let stageBarClass = 'bg-grey';
                        let stagePercent = '20%';

                        const status = (project.status || '').toLowerCase();
                        if (status === 'draft') {
                            stageText = 'Draft / Setup';
                            stageBarClass = 'bg-grey';
                            stagePercent = '10%';
                        } else if (status === 'submitted') {
                            stageText = 'Initial Vetting';
                            stageBarClass = 'bg-blue';
                            stagePercent = '30%';
                        } else if (status === 'vetting') {
                            stageText = 'Vetting Process';
                            stageBarClass = 'bg-orange';
                            stagePercent = '50%';
                        } else if (status === 'needs_update') {
                            stageText = 'Remediation Required';
                            stageBarClass = 'bg-red';
                            stagePercent = '40%';
                        } else if (status === 'under_review') {
                            stageText = 'Due Diligence';
                            stageBarClass = 'bg-orange';
                            stagePercent = '60%';
                        } else if (status === 'approved') {
                            stageText = 'Approved';
                            stageBarClass = 'bg-green';
                            stagePercent = '100%';
                        } else if (status === 'rejected') {
                            stageText = 'Rejected';
                            stageBarClass = 'bg-red';
                            stagePercent = '100%';
                        }

                        // Status Pill configuration
                        let pillClass = 'pill-pending';
                        let statusLabel = 'Submitted';
                        if (status === 'draft') {
                            pillClass = 'pill-update';
                            statusLabel = 'Draft';
                        } else if (status === 'vetting') {
                            pillClass = 'pill-review';
                            statusLabel = 'Vetting';
                        } else if (status === 'needs_update') {
                            pillClass = 'pill-update';
                            statusLabel = 'Needs Update';
                        } else if (status === 'under_review') {
                            pillClass = 'pill-review';
                            statusLabel = 'Under Review';
                        } else if (status === 'approved') {
                            pillClass = 'pill-approved';
                            statusLabel = 'Approved';
                        } else if (status === 'rejected') {
                            pillClass = 'pill-rejected';
                            statusLabel = 'Rejected';
                        }

                        // Format dates
                        const dateObj = project.submitted_at ? new Date(project.submitted_at) : new Date(project.created_at);
                        const formattedDate = dateObj.toLocaleDateString('en-US', {
                            month: 'short',
                            day: 'numeric',
                            year: 'numeric'
                        });

                        // Format Funding
                        const symbolMap = {
                            'USD': '$',
                            'NGN': '₦',
                            'EUR': '€',
                            'GBP': '£'
                        };
                        const currencySymbol = symbolMap[project.budget_currency] || project.budget_currency || '$';
                        const formattedFunding = `${currencySymbol}${parseFloat(project.budget_amount).toLocaleString()}`;

                        // Cleanup description markdown for preview
                        const rawDesc = project.description || '';
                        const cleanDesc = rawDesc
                            .replace(/\*\*[^*]+\*\*/g, '')
                            .replace(/[#*`_-]/g, '')
                            .trim();
                        const previewDesc = cleanDesc.length > 50 ? cleanDesc.substring(0, 50) + '...' : cleanDesc;

                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>
                                <div class="modern-project-name">${escapeHtml(project.title)}</div>
                                <div class="modern-project-sub">${escapeHtml(previewDesc)}</div>
                            </td>
                            <td class="modern-date">${formattedDate}</td>
                            <td class="pf-dedup-4ddbe9">
                                <div class="stage-text">${stageText}</div>
                                <div class="stage-progress">
                                    <div class="progress-bar ${stageBarClass}" style="width: ${stagePercent};"></div>
                                </div>
                            </td>
                            <td class="modern-funding">${formattedFunding}</td>
                            <td><span class="modern-pill ${pillClass}">${statusLabel}</span></td>
                        `;
                        tbody.appendChild(row);
                    });

                } catch (err) {
                    console.error('Error loading dashboard data:', err);
                    const tbody = document.getElementById('projects-table-body');
                    tbody.innerHTML = `
                        <tr>
                            <td class="pf-dedup-2ec2ba" colspan="5">
                                <i class="fa-solid fa-triangle-exclamation pf-dedup-3abde7"></i>
                                <p>Error loading project dossiers: ${err.message || 'Please check your network or try again.'}</p>
                            </td>
                        </tr>
                    `;
                }
            }

            // Helper to escape HTML characters
            function escapeHtml(str) {
                if (!str) return '';
                return str.replace(/&/g, "&amp;")
                          .replace(/</g, "&lt;")
                          .replace(/>/g, "&gt;")
                          .replace(/"/g, "&quot;")
                          .replace(/'/g, "&#039;");
            }

            // Load dashboard on initialization
            await loadDashboardData();

        });
    </script>
</body>
</html>





