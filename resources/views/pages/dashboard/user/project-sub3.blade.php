<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/jpeg" href="{{ asset('assets/images/project logo.jpeg') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Project Submission | P-FUNDS</title>
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
                    
                    <a href="{{ route('user.profile') }}" style="text-decoration: none; cursor: pointer;" class="user-profile">
                        <div class="user-info">
                            <span class="name" id="display-name">Loading...</span>
                            <span class="role" id="display-role">USER</span>
                        </div>
                        <img src="https://ui-avatars.com/api/?name=User&background=0D8ABC&color=fff&rounded=true" alt="User" class="avatar" id="display-avatar">
                    </a>
                </div>
            </header>

            <!-- Page Title and Step Badge -->
            <div class="wizard-header-row">
                <h2 class="page-header-title pf-dedup-2cbabd">New Project Submission</h2>
                <div class="step-badge">STEP 3 OF 4</div>
            </div>

            <!-- New Stepper style -->
            <div class="stepper-wizard-new pf-dedup-83aaf8">
                <div class="progress-fill"></div>
                <div class="step-new completed">
                    <div class="step-circle-new">1</div>
                    <div class="step-label-new">Project Details</div>
                </div>
                <div class="step-new completed">
                    <div class="step-circle-new">2</div>
                    <div class="step-label-new">Attachments</div>
                </div>
                <div class="step-new active">
                    <div class="step-circle-new">3</div>
                    <div class="step-label-new">Financials</div>
                </div>
                <div class="step-new">
                    <div class="step-circle-new">4</div>
                    <div class="step-label-new">Review</div>
                </div>
            </div>

            <!-- Flipped Two Column Layout -->
            <div class="wizard-layout-flipped">
                
                <!-- Left Column (Info Widgets) -->
                <div class="wizard-sidebar">
                    
                    <!-- Financial Summary Card -->
                    <div class="financial-summary-card">
                        <div class="summary-header">
                            <h3>Financial Summary</h3>
                            <p>Define the capital structure and sponsorship objectives for this project.</p>
                        </div>
                        <div class="summary-metrics">
                            <div class="metric-row">
                                <span class="metric-label">Total Capital Cost</span>
                                <span class="metric-value" id="metric-total-cost">$0.00</span>
                            </div>
                            <div class="metric-row">
                                <span class="metric-label">Requested Funds</span>
                                <span class="metric-value" id="metric-request-cost">$0.00</span>
                            </div>
                            <div class="metric-row">
                                <span class="metric-label">Sponsor Equity</span>
                                <span class="metric-value highlight" id="metric-equity-pct">0%</span>
                            </div>
                        </div>
                    </div>

                    <!-- Guideline Tip Card -->
                    <div class="guideline-tip-card">
                        <div class="tip-icon">
                            <i class="fa-solid fa-circle-info"></i>
                        </div>
                        <div class="tip-content">
                            <h4>Guideline Tip</h4>
                            <p>Projects with a personal equity contribution above 25% typically experience faster approval timelines in Vetting Phase 1.</p>
                        </div>
                    </div>

                </div>
                
                <!-- Right Column (Main Form) -->
                <div class="wizard-main">
                    
                    <div class="form-card pf-dedup-e7ec54">
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label class="pf-dedup-5f7abe">TOTAL BUSINESS COST</label>
                                <div class="input-with-prefix">
                                    <span class="prefix"></span>
                                    <input type="number" id="total_cost" class="form-control" placeholder="20,000,000FCFA" min="0" step="any">
                                </div>
                                <div class="input-helper-text">Include operational runway for first 12 months.</div>
                            </div>
                            <div class="form-group">
                                <label class="pf-dedup-5f7abe">FUNDING REQUEST AMOUNT</label>
                                <div class="input-with-prefix">
                                    <span class="prefix"></span>
                                    <input type="number" id="funding_request" class="form-control" placeholder="20,000,000FCFA" min="0" step="any">
                                </div>
                                <div class="input-helper-text">Maximum permissible: 80% of total cost.</div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="pf-dedup-5f7abe">PERCENTAGE OFFERED TO SPONSOR</label>
                                <div class="input-with-suffix">
                                    <span class="suffix">%</span>
                                    <input type="number" id="percentage_sponsor" class="form-control" placeholder="0" min="0" max="100">
                                </div>
                            </div>
                            <div class="form-group pf-dedup-7458ac">
                                <div class="inline-progress-wrapper">
                                    <div class="inline-progress-bg">
                                        <div class="inline-progress-fill pf-dedup-9c33ea" id="equity-progress-fill"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="pf-dedup-5f7abe">REASON FOR SPONSORSHIP</label>
                            <textarea id="sponsorship_reason" class="form-control" placeholder="Detail how this sponsorship aligns with your growth strategy and why current capital markets are insufficient..."></textarea>
                            <div class="input-helper-text">
                                <span id="char-counter">0 / 2500</span>
                            </div>
                        </div>
                        
                    </div>

                    <!-- Bottom Actions -->
                    <div class="wizard-actions pf-dedup-8a7905">
                        <button type="button" class="btn-back" id="btn-back"><i class="fa-solid fa-arrow-left"></i> Back to Attachments</button>
                        <button type="button" class="btn-submit-blue" id="btn-next">Review & Submit <i class="fa-solid fa-arrow-right"></i></button>
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
        // 2. Financials Calculation & Draft Saving
        const totalCostInput = document.getElementById('total_cost');
        const fundingRequestInput = document.getElementById('funding_request');
        const percentageSponsorInput = document.getElementById('percentage_sponsor');
        const reasonTextarea = document.getElementById('sponsorship_reason');

        const metricTotal = document.getElementById('metric-total-cost');
        const metricRequest = document.getElementById('metric-request-cost');
        const metricEquity = document.getElementById('metric-equity-pct');
        const progressFill = document.getElementById('equity-progress-fill');
        const charCounter = document.getElementById('char-counter');

        // Load existing draft
        let draftStr = localStorage.getItem('project_draft');
        let draftObj = draftStr ? JSON.parse(draftStr) : {};

        // Pre-fill fields
        if (draftObj.total_cost) totalCostInput.value = draftObj.total_cost;
        if (draftObj.funding_request) fundingRequestInput.value = draftObj.funding_request;
        if (draftObj.percentage_sponsor) percentageSponsorInput.value = draftObj.percentage_sponsor;
        if (draftObj.sponsorship_reason) reasonTextarea.value = draftObj.sponsorship_reason;

        // Dynamic calculator
        function updateFinancialMetrics() {
            const total = parseFloat(totalCostInput.value) || 0;
            const request = parseFloat(fundingRequestInput.value) || 0;
            const equity = parseFloat(percentageSponsorInput.value) || 0;

            metricTotal.textContent = `${total.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 })}FCFA`;
            metricRequest.textContent = `${request.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 })}FCFA`;
            metricEquity.textContent = `${equity}%`;

            // Sponsor equity color / styling tip
            if (equity >= 25) {
                metricEquity.style.color = '#10b981'; // Green
            } else {
                metricEquity.style.color = ''; // Default highlight color
            }

            // Update UI progress bar
            progressFill.style.width = `${Math.min(100, Math.max(0, equity))}%`;

            // Update character counter
            const chars = reasonTextarea.value.length;
            charCounter.textContent = `${chars} / 2500`;
            if (chars < 50) {
                charCounter.style.color = '#ef4444';
            } else {
                charCounter.style.color = '';
            }
        }

        // Bind events
        [totalCostInput, fundingRequestInput, percentageSponsorInput, reasonTextarea].forEach(el => {
            el.addEventListener('input', updateFinancialMetrics);
        });

        // Run initial calculations
        updateFinancialMetrics();

        function saveDraft() {
            draftObj.total_cost = totalCostInput.value;
            draftObj.funding_request = fundingRequestInput.value;
            draftObj.percentage_sponsor = percentageSponsorInput.value;
            draftObj.sponsorship_reason = reasonTextarea.value;
            localStorage.setItem('project_draft', JSON.stringify(draftObj));
        }

        // Navigation
        document.getElementById('btn-back').addEventListener('click', () => {
            saveDraft();
            window.location.href = "{{ route('user.project-submit-2') }}";
        });

        document.getElementById('btn-next').addEventListener('click', () => {
            const total = parseFloat(totalCostInput.value) || 0;
            const request = parseFloat(fundingRequestInput.value) || 0;
            const equity = parseFloat(percentageSponsorInput.value) || 0;
            const reason = reasonTextarea.value.trim();

            if (!total || !request || !reason) {
                alert('Please fill out all required financial and justification fields.');
                return;
            }

            if (request > total * 0.8) {
                alert('Funding request amount cannot exceed 80% of the total business cost.');
                return;
            }

            if (equity < 0 || equity > 100) {
                alert('Percentage offered to sponsor must be between 0 and 100.');
                return;
            }

            saveDraft();
            window.location.href = "{{ route('user.project-submit-4') }}";
        });
    </script>
</body>
</html>
