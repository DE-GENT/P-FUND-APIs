<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/jpeg" href="{{ asset('assets/images/project logo.jpeg') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Final Submission Review | P-FUNDS</title>
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
                <h2 class="page-header-title pf-dedup-ad486a">Final Submission Review</h2>
                <p class="page-subtitle">Verify the integrity of your project dossier before finalizing for the vetting process.</p>
            </div>

            <!-- Stepper -->
            <div class="stepper-wizard-new pf-dedup-035520">
                <div class="progress-fill pf-dedup-6d5673"></div>
                <div class="step-new completed">
                    <div class="step-circle-new">01</div>
                    <div class="step-label-new pf-dedup-5f7abe">Identity</div>
                </div>
                <div class="step-new completed">
                    <div class="step-circle-new">02</div>
                    <div class="step-label-new pf-dedup-5f7abe">Assets</div>
                </div>
                <div class="step-new completed">
                    <div class="step-circle-new">03</div>
                    <div class="step-label-new pf-dedup-5f7abe">Economics</div>
                </div>
                <div class="step-new active-dark">
                    <div class="step-circle-new pf-dedup-f0461e">04</div>
                    <div class="step-label-new pf-dedup-10b0e7">Review</div>
                </div>
            </div>

            <!-- Review Content -->
            
            <!-- Section 1: Project Details -->
            <div class="review-card">
                <div class="review-card-header">
                    <div class="review-card-title">
                        <i class="fa-regular fa-file-lines"></i> Section 1: Project Details
                    </div>
                    <a href="{{ route('user.project-submit-1') }}" class="review-card-link">Edit Details</a>
                </div>
                
                <div class="info-row">
                    <div class="info-group">
                        <span class="info-label">Project Name</span>
                        <span class="info-value bold" id="review-project-name">-</span>
                    </div>
                    <div class="info-group">
                        <span class="info-label">Specialty</span>
                        <div><span class="specialty-pill" id="review-specialty">-</span></div>
                    </div>
                </div>
                
                <div class="info-group pf-dedup-e1b245">
                    <span class="info-label">Problem Statement</span>
                    <span class="info-value" id="review-problem-statement">-</span>
                </div>
                
                <div class="info-group">
                    <span class="info-label">Solution Description</span>
                    <span class="info-value" id="review-solution-description">-</span>
                </div>
            </div>

            <!-- Section 2: Attachments -->
            <div class="review-card">
                <div class="review-card-header">
                    <div class="review-card-title">
                        <i class="fa-solid fa-paperclip"></i> Section 2: Attachments
                    </div>
                    <a href="{{ route('user.project-submit-2') }}" class="review-card-link">Manage Files</a>
                </div>
                
                <div class="file-preview-grid">
                    <div class="file-preview-box pf-dedup-cb4589" id="video-preview-box">
                        <i class="fa-regular fa-file-video file-preview-icon"></i>
                        <div class="file-preview-details">
                            <span class="file-preview-name" id="review-video-name">-</span>
                            <span class="file-preview-meta" id="review-video-meta">-</span>
                        </div>
                    </div>
                    <div class="file-preview-box pf-dedup-cb4589" id="pitch-preview-box">
                        <i class="fa-regular fa-file-pdf file-preview-icon"></i>
                        <div class="file-preview-details">
                            <span class="file-preview-name" id="review-pitch-name">-</span>
                            <span class="file-preview-meta" id="review-pitch-meta">-</span>
                        </div>
                    </div>
                    <div class="pf-dedup-a68fc9" id="no-files-notice">
                        No attachments uploaded.
                    </div>
                </div>
            </div>

            <!-- Section 3: Financial Requirements -->
            <div class="review-card">
                <div class="review-card-header">
                    <div class="review-card-title">
                        <i class="fa-solid fa-money-bill-wave"></i> Section 3: Financial Requirements
                    </div>
                    <a href="{{ route('user.project-submit-3') }}" class="review-card-link">Adjust Funding</a>
                </div>
                
                <div class="financial-metrics-grid">
                    <div class="financial-metric-box">
                        <span class="financial-metric-label">Total Cost</span>
                        <span class="financial-metric-value" id="review-total-cost">$0.00</span>
                    </div>
                    <div class="financial-metric-box highlight">
                        <span class="financial-metric-label">Funding Request</span>
                        <span class="financial-metric-value" id="review-funding-request">$0.00</span>
                    </div>
                    <div class="financial-metric-box">
                        <span class="financial-metric-label">Sponsor Stake</span>
                        <span class="financial-metric-value" id="review-sponsor-stake">0%</span>
                    </div>
                </div>
                
                <div class="info-group">
                    <span class="info-label">Reason for Sponsorship</span>
                    <span class="reason-text" id="review-sponsorship-reason">-</span>
                </div>
            </div>

            <!-- Bottom Actions -->
            <div class="security-badges">
                <div class="security-badge">
                    <i class="fa-solid fa-shield-halved"></i> Data Privacy Policy Compliant
                </div>
                <div class="security-badge">
                    <i class="fa-solid fa-lock"></i> AES-256 Encrypted Submission
                </div>
            </div>
            
            <div class="final-action-row">
                <button type="button" class="btn-back-light" id="btn-back">Back to Step 3</button>
                <button type="button" class="btn-submit-final" id="btn-submit"><i class="fa-regular fa-paper-plane"></i> Submit for Vetting</button>
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
        // 2. Load Draft and Populate Placeholders
        const draftStr = localStorage.getItem('project_draft');
        if (!draftStr) {
            alert("No draft found. Please start from Step 1.");
            window.location.href = "{{ route('user.project-submit-1') }}";
        }

        const draftObj = JSON.parse(draftStr || '{}');

        document.getElementById('review-project-name').textContent = draftObj.project_name || '-';
        document.getElementById('review-specialty').textContent = draftObj.specialty || '-';
        document.getElementById('review-problem-statement').textContent = draftObj.problem_statement || '-';
        document.getElementById('review-solution-description').textContent = draftObj.solution_description || '-';

        const totalCost = parseFloat(draftObj.total_cost) || 0;
        const fundingRequest = parseFloat(draftObj.funding_request) || 0;
        const percentageSponsor = parseFloat(draftObj.percentage_sponsor) || 0;

        document.getElementById('review-total-cost').textContent = `$${totalCost.toLocaleString(undefined, { minimumFractionDigits: 2 })}`;
        document.getElementById('review-funding-request').textContent = `$${fundingRequest.toLocaleString(undefined, { minimumFractionDigits: 2 })}`;
        document.getElementById('review-sponsor-stake').textContent = `${percentageSponsor}%`;
        document.getElementById('review-sponsorship-reason').textContent = draftObj.sponsorship_reason ? `"${draftObj.sponsorship_reason}"` : '-';

        // 3. Load Attachments from IndexedDB
        const dbName = "PFundWizardDB";
        const storeName = "wizardFiles";
        let videoFile = null;
        let pitchFile = null;

        function openDB() {
            return new Promise((resolve, reject) => {
                const request = indexedDB.open(dbName, 1);
                request.onsuccess = (e) => resolve(e.target.result);
                request.onerror = (e) => reject(e.target.error);
            });
        }

        async function getFileFromDB(key) {
            try {
                const db = await openDB();
                return new Promise((resolve, reject) => {
                    const transaction = db.transaction(storeName, "readonly");
                    const store = transaction.objectStore(storeName);
                    const request = store.get(key);
                    request.onsuccess = () => resolve(request.result);
                    request.onerror = () => reject(request.error);
                });
            } catch(e) {
                console.error("DB not initialized or empty:", e);
                return null;
            }
        }

        async function clearDB() {
            try {
                const db = await openDB();
                return new Promise((resolve, reject) => {
                    const transaction = db.transaction(storeName, "readwrite");
                    const store = transaction.objectStore(storeName);
                    const request = store.clear();
                    request.onsuccess = () => resolve();
                    request.onerror = () => reject(request.error);
                });
            } catch(e) {}
        }

        async function loadAttachments() {
            videoFile = await getFileFromDB('demo_video');
            pitchFile = await getFileFromDB('pitch_deck');

            let hasFiles = false;
            if (videoFile) {
                document.getElementById('video-preview-box').style.display = 'flex';
                document.getElementById('review-video-name').textContent = videoFile.name;
                document.getElementById('review-video-meta').textContent = `${(videoFile.size / (1024 * 1024)).toFixed(2)} MB • Video/MP4`;
                hasFiles = true;
            }
            if (pitchFile) {
                document.getElementById('pitch-preview-box').style.display = 'flex';
                document.getElementById('review-pitch-name').textContent = pitchFile.name;
                document.getElementById('review-pitch-meta').textContent = `${(pitchFile.size / (1024 * 1024)).toFixed(2)} MB • Document`;
                hasFiles = true;
            }
            if (hasFiles) {
                document.getElementById('no-files-notice').style.display = 'none';
            }
        }
        loadAttachments();

        // Specialty Mapper
        function mapSpecialtyToCategory(specialty) {
            const s = (specialty || '').toLowerCase();
            if (s.includes('tech') || s.includes('intelligence') || s.includes('infrastructure')) {
                return 'technology';
            }
            if (s.includes('energy') || s.includes('environment')) {
                return 'environment';
            }
            if (s.includes('education')) {
                return 'education';
            }
            if (s.includes('agric')) {
                return 'agriculture';
            }
            if (s.includes('health')) {
                return 'health';
            }
            return 'other';
        }

        // Action Handlers
        const submitBtn = document.getElementById('btn-submit');
        const backBtn = document.getElementById('btn-back');

        backBtn.addEventListener('click', () => {
            window.location.href = "{{ route('user.project-submit-3') }}";
        });

        submitBtn.addEventListener('click', async () => {
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Submitting...';

            try {
                const formData = new FormData();
                formData.append('title', draftObj.project_name);
                
                // Build markdown description
                const descriptionMarkdown = `
**Project Executive Summary**
${draftObj.project_description}

**Problem Statement**
${draftObj.problem_statement}

**Solution Description**
${draftObj.solution_description}

**Sponsorship Reason**
${draftObj.sponsorship_reason}
                `.trim();

                formData.append('description', descriptionMarkdown);
                formData.append('category', mapSpecialtyToCategory(draftObj.specialty));
                formData.append('budget_amount', draftObj.funding_request);
                formData.append('budget_currency', 'USD');

                if (videoFile) {
                    formData.append('documents[]', videoFile);
                }
                if (pitchFile) {
                    formData.append('documents[]', pitchFile);
                }

                // 1. Create project
                const resJson = await apiClient.request('/projects', {
                    method: 'POST',
                    body: formData
                });
                const project = resJson.data;

                // 2. Transition project status to Submitted
                const submitResJson = await apiClient.request(`/projects/${project.id}/submit`, {
                    method: 'POST'
                });

                // Save dynamic parameters for confirmation screen
                localStorage.setItem('last_submitted_project', JSON.stringify({
                    id: `PRJ-${String(project.id).padStart(5, '0')}`,
                    title: project.title,
                    funding: `$${parseFloat(project.budget_amount).toLocaleString(undefined, { minimumFractionDigits: 2 })}`,
                    timestamp: new Date().toLocaleDateString('en-US', {
                        month: 'long',
                        day: 'numeric',
                        year: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit'
                    })
                }));

                // Clear states
                localStorage.removeItem('project_draft');
                await clearDB();

                window.location.href = "{{ route('user.project-confirm') }}";

            } catch (err) {
                console.error("Submission error:", err);
                alert(err.message || "An unexpected error occurred. Please verify your connection.");
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<i class="fa-regular fa-paper-plane"></i> Submit for Vetting';
            }
        });
    </script>
</body>
</html>
