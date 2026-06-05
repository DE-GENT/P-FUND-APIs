<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/jpeg" href="{{ asset('assets/images/project logo.jpeg') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submission Confirmed | P-FUNDS</title>
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
                <a href="{{ route('user.project-submit-1') }}" class="nav-item active">
                    <i class="fa-regular fa-square-plus"></i>
                    Submit Project
                </a>
                <a href="{{ route('user.project-review') }}" class="nav-item">
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
                    
                    <div class="user-profile">
                        <div class="user-info">
                            <span class="name" id="display-name">-</span>
                            <span class="role" id="display-role">PROJECT SPONSOR</span>
                        </div>
                        <img src="" alt="Avatar" class="avatar" id="display-avatar">
                    </div>
                </div>
            </header>

            <!-- Confirm Card -->
            <div class="confirm-card">
                <div class="success-icon-wrapper">
                    <i class="fa-solid fa-check"></i>
                </div>
                
                <h2 class="confirm-title">Project Submission Complete</h2>
                <p class="confirm-desc">Your project dossier has been successfully uploaded to the safe vault and is queued for vetting.</p>
                
                <!-- Dynamic Summary -->
                <div class="details-summary">
                    <div class="details-row">
                        <span class="details-label">Submission ID</span>
                        <span class="details-value" id="confirm-project-id">-</span>
                    </div>
                    <div class="details-row">
                        <span class="details-label">Project Title</span>
                        <span class="details-value" id="confirm-project-title">-</span>
                    </div>
                    <div class="details-row">
                        <span class="details-label">Funding Target</span>
                        <span class="details-value" id="confirm-project-funding">-</span>
                    </div>
                    <div class="details-row">
                        <span class="details-label">Submitted On</span>
                        <span class="details-value" id="confirm-project-time">-</span>
                    </div>
                </div>
                
                <!-- Progress Timeline -->
                <div class="timeline-steps">
                    <div class="timeline-line">
                        <div class="timeline-line-progress"></div>
                    </div>
                    <div class="timeline-step completed">
                        <div class="timeline-circle"><i class="fa-solid fa-check"></i></div>
                        <span class="timeline-label">Submitted</span>
                    </div>
                    <div class="timeline-step active">
                        <div class="timeline-circle">2</div>
                        <span class="timeline-label">Screening</span>
                    </div>
                    <div class="timeline-step">
                        <div class="timeline-circle">3</div>
                        <span class="timeline-label">Due Diligence</span>
                    </div>
                    <div class="timeline-step">
                        <div class="timeline-circle">4</div>
                        <span class="timeline-label">Decision</span>
                    </div>
                </div>
                
                <!-- Navigation -->
                <div class="actions-row">
                    <a href="{{ route('user.dashboard') }}" class="btn-primary"><i class="fa-solid fa-table-columns"></i> Back to Dashboard</a>
                    <a href="{{ route('user.project-review') }}" class="btn-secondary"><i class="fa-solid fa-list-check"></i> View Reviews</a>
                </div>
            </div>
            
        </main>
    </div>

    <script src="{{ asset('assets/js/api.js') }}?v=1.0.4"></script>
    <script src="{{ asset('assets/js/notifications.js') }}"></script>
    <script>
        // Protect Route & Load User Profile
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

        // Populate Confirmation Details
        const projectDataStr = localStorage.getItem('last_submitted_project');
        if (projectDataStr) {
            try {
                const projectData = JSON.parse(projectDataStr);
                document.getElementById('confirm-project-id').textContent = projectData.id || '-';
                document.getElementById('confirm-project-title').textContent = projectData.title || '-';
                document.getElementById('confirm-project-funding').textContent = projectData.funding || '-';
                document.getElementById('confirm-project-time').textContent = projectData.timestamp || '-';
            } catch(e) {
                console.error("Error loading confirmation data", e);
            }
        }
    </script>
</body>
</html>
