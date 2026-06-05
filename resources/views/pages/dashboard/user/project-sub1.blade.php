<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/jpeg" href="{{ asset('assets/images/project logo.jpeg') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Submission: Details | P-FUNDS</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('dist/styles/index.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/styles/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/styles/user.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    
</head>
<body>
    <div class="dashboard-container">
        
        <!-- Sidebar (Reused from Dashboard) -->
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
            
            <!-- Topbar (Reused from Dashboard) -->
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
                    
                    <div class="user-profile">
                        <div class="user-info">
                            <span class="name" id="display-name">Loading...</span>
                            <span class="role" id="display-role">USER</span>
                        </div>
                        <img src="https://ui-avatars.com/api/?name=User&background=0D8ABC&color=fff&rounded=true" alt="User" class="avatar" id="display-avatar">
                    </div>
                </div>
            </header>

            <div class="pf-dedup-3ae1f6">
                <h2 class="page-header-title">The Sovereign Ledger</h2>
            </div>

            <!-- Stepper -->
            <div class="stepper-container">
                <div class="step active">
                    <div class="step-circle">1</div>
                    <div class="step-label">Details</div>
                </div>
                <div class="step-line"></div>
                <div class="step">
                    <div class="step-circle">2</div>
                    <div class="step-label">Attachments</div>
                </div>
                <div class="step-line"></div>
                <div class="step">
                    <div class="step-circle">3</div>
                    <div class="step-label">Financials</div>
                </div>
                <div class="step-line"></div>
                <div class="step">
                    <div class="step-circle">4</div>
                    <div class="step-label">Review</div>
                </div>
            </div>

            <!-- Form Card -->
            <div class="form-card">
                <div class="form-header">
                    <h2>Project Submission: Details</h2>
                    <p>Define the core identity of your initiative. Institutional vetting begins with a clear<br>articulation of the problem-solution fit.</p>
                </div>

                <form id="submission-form-1">
                    <div class="form-row">
                        <div class="form-group">
                            <label>Project Name</label>
                            <input type="text" id="project_name" class="form-control" placeholder="e.g. Project Aethelgard Ledger" required>
                        </div>
                        <div class="form-group">
                            <label>Specialty</label>
                            <select id="specialty" class="form-control" required>
                                <option value="" disabled selected>Select an option</option>
                                <option value="FinTech & Infrastructure">FinTech & Infrastructure</option>
                                <option value="Green Energy">Green Energy</option>
                                <option value="Healthcare Tech">Healthcare Tech</option>
                                <option value="Artificial Intelligence">Artificial Intelligence</option>
                                <option value="Real Estate Development">Real Estate Development</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group pf-dedup-8c2756">
                        <label>Project Description</label>
                        <textarea id="project_description" class="form-control" placeholder="Provide a high-level executive summary..." required></textarea>
                    </div>

                    <div class="pf-dedup-8c2756">
                        <div class="section-subtitle">Problem Statement</div>
                        <div class="field-desc">Define the friction or inefficiency this project aims to eliminate.</div>
                        <textarea id="problem_statement" class="form-control" placeholder="Describe the current state of affairs and the specific pain point..." required></textarea>
                    </div>

                    <div>
                        <div class="section-subtitle">Solution Description</div>
                        <div class="field-desc">Outline the technical or operational architecture of your resolution.</div>
                        <textarea id="solution_description" class="form-control" placeholder="Detail how your project addresses the problem statement above..." required></textarea>
                    </div>

                    <div class="form-actions">
                        <button type="button" class="btn-draft" id="btn-draft">Save as Draft</button>
                        <button type="button" class="btn-next" id="btn-next">Next: Attachments <i class="fa-solid fa-arrow-right"></i></button>
                    </div>
                </form>
            </div>

            <!-- Info Banners -->
            <div class="info-banners">
                <div class="info-banner banner-left">
                    <div class="banner-icon">
                        <i class="fa-solid fa-shield-halved"></i>
                    </div>
                    <div class="banner-content">
                        <h4>Institutional Vetting Protocol</h4>
                        <p>Submissions undergo a rigorous 48-hour manual review by our<br>Sovereign Analysts. Ensure all technical documentation is complete to<br>avoid processing delays.</p>
                    </div>
                </div>
                
                <div class="info-banner banner-right">
                    <div class="banner-right-content">
                        <h4>Need Assistance?</h4>
                        <a href="#">Contact Advisory <i class="fa-solid fa-angle-right pf-dedup-6b9c17"></i></a>
                    </div>
                </div>
            </div>

        </main>
    </div>

    <script src="{{ asset('assets/js/api.js') }}?v=1.0.4"></script>
    <script src="{{ asset('assets/js/notifications.js') }}"></script>
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

        // Logout Logic
        // 2. Form State Management (Wizard Step 1)
        const formFields = ['project_name', 'specialty', 'project_description', 'problem_statement', 'solution_description'];
        
        // Load Draft if exists
        let draftStr = localStorage.getItem('project_draft');
        let draftObj = draftStr ? JSON.parse(draftStr) : {};

        formFields.forEach(field => {
            const el = document.getElementById(field);
            if (el && draftObj[field]) {
                el.value = draftObj[field];
            }
        });

        function saveDraft() {
            formFields.forEach(field => {
                const el = document.getElementById(field);
                if (el) draftObj[field] = el.value;
            });
            localStorage.setItem('project_draft', JSON.stringify(draftObj));
        }

        document.getElementById('btn-draft').addEventListener('click', () => {
            saveDraft();
            alert('Draft saved to browser storage successfully!');
        });

        document.getElementById('btn-next').addEventListener('click', () => {
            // Validate required fields
            let isValid = true;
            formFields.forEach(field => {
                const el = document.getElementById(field);
                if (!el.value) isValid = false;
            });

            if (!isValid) {
                alert('Please fill out all fields before proceeding.');
                return;
            }

            saveDraft();
            window.location.href = "{{ route('user.project-submit-2') }}";
        });

    </script>
</body>
</html>


