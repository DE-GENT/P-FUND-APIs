<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/jpeg" href="{{ asset('assets/images/project logo.jpeg') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Portfolio | P-FUNDS</title>
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
                <a href="{{ route('user.project-review') }}" class="nav-item active">
                    <i class="fa-solid fa-list-check"></i>
                    Project Reviews
                </a>
                <a href="{{ route('user.project-update') }}" class="nav-item">
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
        <main class="main-content pf-dedup-61b5d7">
            
            <!-- Topbar with The Sovereign Ledger -->
            <header class="dashboard-topbar pf-dedup-daae84">
                <div class="topbar-brand pf-dedup-037cc8">
                    The Sovereign Ledger
                </div>
                
                <div class="search-container pf-dedup-2d351a">
                    <i class="fa-solid fa-magnifying-glass pf-dedup-8cd4ae"></i>
                    <input class="pf-dedup-1eb224" type="text" placeholder="Search project dossier...">
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
                    <a href="{{ route('user.profile') }}" style="text-decoration: none; cursor: pointer;" class="user-profile">
                        <div class="user-info">
                            <span class="name" id="display-name">-</span>
                            <span class="role" id="display-role">PROJECT SPONSOR</span>
                        </div>
                        <img src="" alt="Avatar" class="avatar pf-dedup-610601" id="display-avatar">
                    </a>
                </div>
            </header>

            <div class="portfolio-header">
                <div class="portfolio-title-section">
                    <h2>Project Portfolio</h2>
                    <p>Track your submitted project dossiers, monitor their vetting stages, and manage action-required updates.</p>
                </div>
                <div class="portfolio-actions">
                    <button class="btn-outline-action" id="logout-btn"><i class="fa-solid fa-right-from-bracket"></i> Logout</button>
                </div>
            </div>

            <!-- Summary Cards -->
            <div class="portfolio-cards-grid">
                <!-- Card 1 -->
                <div class="portfolio-card dark-blue-card">
                    <div class="card-bg-icon"><i class="fa-solid fa-book-open"></i></div>
                    <div class="p-card-label">TOTAL PORTFOLIO VALUE</div>
                    <div class="p-card-value" id="stat-portfolio-value">$0.00</div>
                    <div class="p-card-trend trend-up">
                        <i class="fa-solid fa-arrow-trend-up"></i> Live Dynamic Total
                    </div>
                </div>
                
                <!-- Card 2 -->
                <div class="portfolio-card light-card">
                    <div class="card-bg-icon"><i class="fa-solid fa-building"></i></div>
                    <div class="p-card-label">ACTIVE VETTING DOSSIERS</div>
                    <div class="p-card-value pf-dedup-c6bb03" id="stat-active-dossiers">0 Projects</div>
                    <div class="p-card-trend trend-neutral">
                        <i class="fa-solid fa-chart-line"></i> Vetting pipeline
                    </div>
                </div>
                
                <!-- Card 3 -->
                <div class="portfolio-card light-card">
                    <div class="card-bg-icon"><i class="fa-solid fa-shield-halved"></i></div>
                    <div class="p-card-label">SYSTEM INTEGRITY STATUS</div>
                    <div class="p-card-value pf-dedup-29fb9d">Vetted: Clear</div>
                    <div class="p-card-trend trend-neutral">
                        <i class="fa-solid fa-clock-rotate-left"></i> Security sync active
                    </div>
                </div>
            </div>

            <!-- Action Required Section -->
            <div class="section-divider">
                <div class="red-dot"></div> ACTION REQUIRED: PROJECT UPDATES
            </div>

            <div class="action-cards-grid" id="action-required-container">
                <div class="pf-dedup-32bfa1">Scanning for flagged dossiers...</div>
            </div>

            <!-- Table Section -->
            <div class="portfolio-table-card">
                <div class="ptable-header">
                    <div class="ptable-tabs-wrapper">
                        <div class="ptable-title">MY PROJECT DOSSIERS</div>
                        <div class="ptable-tabs" id="filter-tabs">
                            <a href="javascript:void(0)" class="ptab active" data-status="all">View All</a>
                            <a href="javascript:void(0)" class="ptab" data-status="approved">Approved</a>
                            <a href="javascript:void(0)" class="ptab" data-status="under_review">Under Review</a>
                            <a href="javascript:void(0)" class="ptab" data-status="rejected">Rejected</a>
                        </div>
                    </div>
                    <div class="ptable-count" id="table-count-label">Showing 0 dossiers</div>
                </div>
                
                <div class="table-responsive">
                    <table class="portfolio-table">
                        <thead>
                            <tr>
                                <th>PROJECT NAME</th>
                                <th>SUBMISSION DATE</th>
                                <th>VETTING STAGE</th>
                                <th>AMOUNT OF FUNDING</th>
                                <th>STATUS</th>
                                <th>ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody id="review-projects-tbody">
                            <!-- Dynamically loaded -->
                        </tbody>
                    </table>
                </div>
                
                <div class="ptable-footer">
                    <div class="row-density">
                        Row density: 
                        <select>
                            <option>Comfortable</option>
                            <option>Compact</option>
                        </select>
                    </div>
                    
                    <div class="ptable-pagination">
                        <span class="page-info">Page 1 of 6</span>
                        <div class="page-controls">
                            <button class="page-btn"><i class="fa-solid fa-angle-left"></i></button>
                            <button class="page-btn"><i class="fa-solid fa-angle-right"></i></button>
                        </div>
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
        // 1. Protect Route & Load User Profile
        let token = localStorage.getItem('pfunds_token') || localStorage.getItem('auth_token');
        if (!token) {
            window.location.href = "{{ route('logout') }}";
        } else {
            // Synchronize tokens if one is missing
            if (!localStorage.getItem('pfunds_token')) localStorage.setItem('pfunds_token', token);
            if (!localStorage.getItem('auth_token')) localStorage.setItem('auth_token', token);
        }

        let userStr = localStorage.getItem('pfunds_user') || localStorage.getItem('user');
        if (userStr) {
            // Synchronize user if one is missing
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

        // Logout Logic
        // 2. Fetch Projects and Populate UI
        let allProjects = [];
        let activeFilter = 'all';

        async function fetchPortfolio() {
            try {
                const resJson = await apiClient.get('/projects');
                // Laravel paginator wraps the array in data.data
                allProjects = (resJson.data && resJson.data.data) ? resJson.data.data : (resJson.data || []);
                
                updateStats();
                renderActionRequired();
                renderTable();
            } catch (err) {
                console.error("Error loading portfolio:", err);
                document.getElementById('review-projects-tbody').innerHTML = `
                    <tr>
                        <td class="pf-dedup-8558ca" colspan="6">
                            <i class="fa-solid fa-triangle-exclamation"></i> Error loading project portfolio: ${err.message || 'Please check connection.'}
                        </td>
                    </tr>
                `;
            }
        }

        function updateStats() {
            // Portfolio Total Value
            const totalVal = allProjects.reduce((sum, p) => sum + parseFloat(p.budget_amount || 0), 0);
            document.getElementById('stat-portfolio-value').textContent = `$${totalVal.toLocaleString(undefined, { maximumFractionDigits: 0 })}`;
            
            // Active Dossiers
            const activeCount = allProjects.filter(p => p.status !== 'rejected').length;
            document.getElementById('stat-active-dossiers').textContent = `${activeCount} Project${activeCount !== 1 ? 's' : ''}`;
        }

        function renderActionRequired() {
            const container = document.getElementById('action-required-container');
            // Action is required for rejected projects or drafts with admin remarks
            const flaggedProjects = allProjects.filter(p => p.status === 'rejected' || p.admin_remarks);
            
            if (flaggedProjects.length === 0) {
                container.innerHTML = `
                    <div class="pf-dedup-d93354">
                        <i class="fa-solid fa-circle-check pf-dedup-da6e5d"></i>
                        <span>No actions pending. All submitted project dossiers are in good standing.</span>
                    </div>
                `;
                return;
            }

            container.innerHTML = flaggedProjects.map(p => {
                const remarks = p.admin_remarks || "Dossier review halted. Please update details or upload missing credentials.";
                const badgeText = p.status === 'rejected' ? "REJECTED BY VETTER" : "REMARKS ADDED";
                return `
                    <div class="alert-card">
                        <div class="alert-icon pf-dedup-936c62">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                        </div>
                        <div class="alert-content">
                            <div class="alert-header-row">
                                <h3 class="alert-title">${p.title}</h3>
                                <span class="alert-badge pf-dedup-1f60c8">${badgeText}</span>
                            </div>
                            <p class="alert-desc">${remarks}</p>
                            <div class="alert-footer">
                                <a href="{{ route('user.project-update') }}" class="alert-link">Update Project Dossier</a>
                                <span class="alert-deadline">Action Required</span>
                            </div>
                        </div>
                    </div>
                `;
            }).join('');
        }

        function renderTable() {
            const tbody = document.getElementById('review-projects-tbody');
            const countLabel = document.getElementById('table-count-label');
            
            let filtered = allProjects;
            if (activeFilter !== 'all') {
                if (activeFilter === 'under_review') {
                    // Include both 'submitted' and 'under_review' for Review tab
                    filtered = allProjects.filter(p => p.status === 'under_review' || p.status === 'submitted');
                } else {
                    filtered = allProjects.filter(p => p.status === activeFilter);
                }
            }
            
            countLabel.textContent = `Showing ${filtered.length} of ${allProjects.length} dossier${allProjects.length !== 1 ? 's' : ''}`;
            
            if (filtered.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td class="pf-dedup-fc86ee" colspan="6">
                            No projects found matching the filter.
                        </td>
                    </tr>
                `;
                return;
            }

            tbody.innerHTML = filtered.map(p => {
                const dateStr = new Date(p.created_at).toLocaleDateString('en-US', {
                    month: 'short',
                    day: '2-digit',
                    year: 'numeric'
                });
                
                // Stage indicator styles
                let stageBarClass = 'bg-blue';
                let stageText = 'L1 Draft';
                let statusPillClass = 'pill-pending';
                let statusLabel = p.status.toUpperCase();

                if (p.status === 'draft') {
                    stageBarClass = 'bg-blue';
                    stageText = 'L1 Initiation';
                    statusPillClass = 'pill-review';
                    statusLabel = 'DRAFT';
                } else if (p.status === 'submitted') {
                    stageBarClass = 'bg-blue';
                    stageText = 'L2 Screening';
                    statusPillClass = 'pill-pending';
                } else if (p.status === 'under_review') {
                    stageBarClass = 'bg-blue';
                    stageText = 'L4 Due Diligence';
                    statusPillClass = 'pill-review';
                    statusLabel = 'UNDER REVIEW';
                } else if (p.status === 'approved') {
                    stageBarClass = 'bg-green';
                    stageText = 'L7 Vetted';
                    statusPillClass = 'pill-approved';
                } else if (p.status === 'rejected') {
                    stageBarClass = 'bg-red';
                    stageText = 'L3 Stall';
                    statusPillClass = 'pill-rejected';
                }

                // Short snippet of description
                const cleanDesc = (p.description || '').replace(/[#*`_-]/g, ''); // strip markdown chars
                const snippet = cleanDesc.length > 35 ? cleanDesc.slice(0, 35) + '...' : cleanDesc;

                return `
                    <tr>
                        <td>
                            <div class="p-project-name">${p.title}</div>
                            <div class="p-project-sub">${snippet}</div>
                        </td>
                        <td class="p-date">${dateStr}</td>
                        <td>
                            <div class="inline-stage">
                                <div class="stage-bar-small ${stageBarClass}"></div>
                                <span class="stage-text-small">${stageText}</span>
                            </div>
                        </td>
                        <td>
                            <div class="p-funding-val">$${parseFloat(p.budget_amount).toLocaleString(undefined, { minimumFractionDigits: 0 })}</div>
                            <div class="p-funding-sub">USD</div>
                        </td>
                        <td><span class="p-pill ${statusPillClass}">${statusLabel}</span></td>
                        <td class="p-actions">
                            <a href="{{ route('user.project-update') }}" class="action-details"><i class="fa-regular fa-pen-to-square"></i> Manage</a>
                        </td>
                    </tr>
                `;
            }).join('');
        }

        // Tab click filters
        document.getElementById('filter-tabs').addEventListener('click', (e) => {
            const clickedTab = e.target.closest('.ptab');
            if (!clickedTab) return;
            
            document.querySelectorAll('.ptab').forEach(t => t.classList.remove('active'));
            clickedTab.classList.add('active');
            
            activeFilter = clickedTab.dataset.status;
            renderTable();
        });

        // Initialize Page
        fetchPortfolio();
    </script>
</body>
</html>

