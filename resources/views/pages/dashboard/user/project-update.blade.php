<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/jpeg" href="{{ asset('assets/images/project logo.jpeg') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Updates Required | P-FUNDS</title>
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
                <a href="{{ route('user.dashboard') }}" class="nav-item">
                    <i class="fa-solid fa-border-all"></i>
                    Dashboard
                </a>
                <a href="{{ route('user.project-submit-1') }}" class="nav-item">
                    <i class="fa-regular fa-square-plus"></i>
                    Submit Project
                </a>
                <a href="{{ route('user.project-review') }}" class="nav-item">
                    <i class="fa-solid fa-list-check"></i>
                    Project Reviews
                </a>
                <a href="{{ route('user.project-update') }}" class="nav-item active">
                    <i class="fa-solid fa-rotate-right"></i>
                    Project Update
                </a>
                <a href="{{ route('user.profile') }}" class="nav-item">
                    <i class="fa-regular fa-user"></i>
                    Profile
                </a>
            </nav>
            
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
                        <i class="fa-regular fa-message"></i>
                    </button>
                    
                    <div class="user-profile">
                        <div class="user-info">
                            <span class="name" id="display-name">-</span>
                            <span class="role" id="display-role">PROJECT SPONSOR</span>
                        </div>
                        <img src="" alt="Avatar" class="avatar" id="display-avatar">
                    </div>
                </div>
            </header>

            <!-- Summary Cards -->
            <div class="summary-cards">
                <div class="card">
                    <div class="card-title">TOTAL PROJECTS SUBMITTED</div>
                    <div class="card-value" id="stat-total-projects">0</div>
                    <div class="card-trend trend-up">
                        <i class="fa-solid fa-arrow-trend-up"></i> Dynamic count
                    </div>
                    <div class="card-icon icon-blue">
                        <i class="fa-regular fa-file-lines"></i>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-title">PROJECTS REJECTED</div>
                    <div class="card-value pf-dedup-c9e348" id="stat-rejected-projects">0</div>
                    <div class="card-subtitle">Require remediation</div>
                    <div class="card-icon icon-red">
                        <i class="fa-regular fa-circle-xmark"></i>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-title">AWAITING UPDATE</div>
                    <div class="card-value pf-dedup-2a4cda" id="stat-awaiting-update">0</div>
                    <div class="card-subtitle pf-dedup-2a4cda"><i class="fa-regular fa-clock"></i> Requires response</div>
                    <div class="card-icon icon-orange">
                        <i class="fa-solid fa-clipboard-list"></i>
                    </div>
                </div>
            </div>

            <!-- Dashboard Title Area -->
            <div class="dashboard-header">
                <h2>Project Updates Required</h2>
                <p>The following initiatives have been flagged for further refinement or documentation updates. Please review the vetter comments and resubmit for institutional approval.</p>
            </div>

            <!-- Active Remediation Queue Table -->
            <div class="recent-projects">
                <div class="remediation-header">
                    <div class="remediation-title">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        Active Remediation Queue
                    </div>
                    <button class="btn-flagged" id="flagged-count-btn">0 PROJECTS FLAGGED</button>
                </div>
                
                <div class="pf-dedup-df74e8">
                    <table class="remediation-table">
                        <thead>
                            <tr>
                                <th class="pf-dedup-59c8d6">PROJECT NAME</th>
                                <th class="pf-dedup-2af480">SUBMISSION DATE</th>
                                <th class="pf-dedup-2af480">VETTING STAGE</th>
                                <th class="pf-dedup-2af480">FUNDING</th>
                                <th class="pf-dedup-2af480">STATUS</th>
                                <th class="pf-dedup-c8174c">ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody id="remediation-projects-tbody">
                            <!-- Loaded dynamically -->
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                <div class="pagination-container">
                    <a href="#" class="pagination-btn">Previous</a>
                    <a href="#" class="pagination-btn">Next</a>
                </div>
            </div>

        </main>
        
        <!-- Chat Widget Button -->
        <button class="chat-widget chat-widget-override" onclick="toggleGlobalChat()">
            <i class="fa-regular fa-message pf-dedup-fcc53c"></i>
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
        // 1. Protect Route & Load User Profile
        let token = localStorage.getItem('pfunds_token') || localStorage.getItem('auth_token');
        if (!token) {
            window.location.href = "{{ route('logout') }}";
        } else {
            if (!localStorage.getItem('pfunds_token')) localStorage.setItem('pfunds_token', token);
            if (!localStorage.getItem('auth_token')) localStorage.setItem('auth_token', token);
        }

        let userStr = localStorage.getItem('pfunds_user') || localStorage.getItem('user');
        if (userStr) {
            if (!localStorage.getItem('pfunds_user')) localStorage.setItem('pfunds_user', userStr);
            if (!localStorage.getItem('user')) localStorage.setItem('user', userStr);
            try {
                const user = JSON.parse(userStr);
                document.getElementById('display-name').textContent = user.name;
                
                let role = user.role || 'GENERAL USER';
                if (role.toLowerCase() === 'creator' || role.toLowerCase() === 'general') {
                    role = 'PROJECT SPONSOR / CREATOR';
                }
                document.getElementById('display-role').textContent = role.toUpperCase();
                document.getElementById('display-avatar').src = user.avatar_url || `https://ui-avatars.com/api/?name=${encodeURIComponent(user.name)}&background=0D8ABC&color=fff&rounded=true`;
            } catch (e) { console.error("Error parsing user data"); }
        }

        // 2. Fetch projects and populate
        async function fetchRemediationQueue() {
            try {
                const resJson = await apiClient.get('/projects');
                // Laravel paginator wraps the array in data.data
                const projects = (resJson.data && resJson.data.data) ? resJson.data.data : (resJson.data || []);
                
                // Calculations
                const totalCount = projects.length;
                const rejectedCount = projects.filter(p => p.status === 'rejected').length;
                const awaitingCount = projects.filter(p => p.status === 'rejected' || p.status === 'draft' || p.status === 'needs_update' || p.admin_remarks).length;
                
                document.getElementById('stat-total-projects').textContent = String(totalCount).padStart(2, '0');
                document.getElementById('stat-rejected-projects').textContent = String(rejectedCount).padStart(2, '0');
                document.getElementById('stat-awaiting-update').textContent = String(awaitingCount).padStart(2, '0');
                
                // Filter flagged projects for the queue table
                const flaggedProjects = projects.filter(p => p.status === 'rejected' || p.status === 'draft' || p.status === 'needs_update' || p.admin_remarks);
                document.getElementById('flagged-count-btn').textContent = `${flaggedProjects.length} PROJECT${flaggedProjects.length !== 1 ? 'S' : ''} FLAGGED`;
                
                renderTable(flaggedProjects);
                
            } catch (err) {
                console.error("Error loading remediation queue:", err);
                document.getElementById('remediation-projects-tbody').innerHTML = `
                    <tr>
                        <td class="pf-dedup-8558ca" colspan="6">
                            <i class="fa-solid fa-triangle-exclamation"></i> Error loading remediation queue: ${err.message || 'Please check network.'}
                        </td>
                    </tr>
                `;
            }
        }

        function renderTable(flaggedProjects) {
            const tbody = document.getElementById('remediation-projects-tbody');
            if (flaggedProjects.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td class="pf-dedup-fc86ee" colspan="6">
                            No projects currently require remediation. Excellent!
                        </td>
                    </tr>
                `;
                return;
            }

            tbody.innerHTML = flaggedProjects.map(p => {
                const dateStr = new Date(p.created_at).toLocaleDateString('en-US', {
                    month: 'short',
                    day: '2-digit',
                    year: 'numeric'
                });
                
                let stageText = 'Initiation';
                let stageClass = 'stage-initiation';
                
                if (p.status === 'draft') {
                    stageText = 'Draft / Init';
                    stageClass = 'stage-initiation';
                } else if (p.status === 'submitted') {
                    stageText = 'Screening';
                    stageClass = 'stage-deep-vetting';
                } else if (p.status === 'vetting') {
                    stageText = 'Vetting Process';
                    stageClass = 'stage-deep-vetting';
                } else if (p.status === 'needs_update') {
                    stageText = 'Remediation Required';
                    stageClass = 'stage-risk';
                } else if (p.status === 'under_review') {
                    stageText = 'Due Diligence';
                    stageClass = 'stage-final';
                } else if (p.status === 'approved') {
                    stageText = 'Vetted';
                    stageClass = 'stage-final';
                } else if (p.status === 'rejected') {
                    stageText = 'Rejected Stall';
                    stageClass = 'stage-risk';
                }

                // Short snippet of description
                const cleanDesc = (p.description || '').replace(/[#*`_-]/g, '');
                const snippet = cleanDesc.length > 35 ? cleanDesc.slice(0, 35) + '...' : cleanDesc;

                return `
                    <tr>
                        <td>
                            <div class="project-name-col">
                                <span class="project-name-text">${p.title}</span>
                                <span class="project-desc-text">${snippet}</span>
                            </div>
                        </td>
                        <td><div class="project-date-text">${dateStr}</div></td>
                        <td><span class="status-pill ${stageClass}">${stageText}</span></td>
                        <td><div class="project-funding">$${parseFloat(p.budget_amount).toLocaleString(undefined, { minimumFractionDigits: 0 })}</div></td>
                        <td><span class="status-pill status-update">Update Required</span></td>
                        <td class="pf-dedup-13076d">
                            <a class="pf-dedup-b5df23" href="{{ route('user.edit-update') }}?project_id=${p.id}">
                                <i class="fa-regular fa-pen-to-square edit-action pf-dedup-ed1985"></i>
                            </a>
                        </td>
                    </tr>
                `;
            }).join('');
        }

        // Initialize Page
        fetchRemediationQueue();
    </script>
</body>
</html>


