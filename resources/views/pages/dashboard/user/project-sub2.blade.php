<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/jpeg" href="{{ asset('assets/images/project logo.jpeg') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Submission Wizard | P-FUNDS</title>
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
                    
                    <a href="{{ route('user.profile') }}" style="text-decoration: none; cursor: pointer;" class="user-profile">
                        <div class="user-info">
                            <span class="name" id="display-name">Loading...</span>
                            <span class="role" id="display-role">USER</span>
                        </div>
                        <img src="https://ui-avatars.com/api/?name=User&background=0D8ABC&color=fff&rounded=true" alt="User" class="avatar" id="display-avatar">
                    </a>
                </div>
            </header>

            <div class="pf-dedup-3ae1f6">
                <h2 class="page-header-title pf-dedup-dfffef">Project Submission Wizard</h2>
            </div>

            <!-- Stepper -->
            <div class="stepper-container stepper-wizard">
                <div class="step">
                    <div class="step-circle pf-dedup-5051c8">1</div>
                    <div class="step-label pf-dedup-8cd4ae">Basic Details <i class="fa-solid fa-angle-right pf-dedup-cd0c8c"></i></div>
                </div>
                <div class="step active">
                    <div class="step-circle pf-dedup-34fb08">2</div>
                    <div class="step-label">Attachments <i class="fa-solid fa-angle-right pf-dedup-252276"></i></div>
                </div>
                <div class="step">
                    <div class="step-circle">3</div>
                    <div class="step-label">Financials <i class="fa-solid fa-angle-right pf-dedup-252276"></i></div>
                </div>
                <div class="step">
                    <div class="step-circle">4</div>
                    <div class="step-label">Review & Submit</div>
                </div>
            </div>

            <!-- Two Column Layout -->
            <div class="wizard-layout">
                
                <!-- Left Column -->
                <div class="wizard-main">
                    
                    <!-- Demo Video Card -->
                    <div class="upload-card">
                        <div class="upload-card-header">
                            <div>
                                <h3 class="upload-card-title">Demo Video</h3>
                                <p class="upload-card-desc">Provide a short walkthrough of your product (MP4, Max 50MB).</p>
                            </div>
                            <div class="upload-icon-top">
                                <i class="fa-solid fa-video"></i>
                            </div>
                        </div>
                        
                        <div class="drop-zone pf-dedup-f9aeb2" id="demo-video-dropzone">
                            <input class="pf-dedup-cb4589" type="file" id="demo_video_input" accept="video/mp4">
                            <div class="drop-zone-icon">
                                <i class="fa-solid fa-file-arrow-up"></i>
                            </div>
                            <div class="drop-zone-text" id="demo-video-text">Drag and drop video file here</div>
                            <div class="drop-zone-subtext">or <span class="pf-dedup-f91710">browse files</span> on your computer</div>
                        </div>
                    </div>

                    <!-- Pitch Deck Card -->
                    <div class="upload-card">
                        <div class="upload-card-header pf-dedup-9ab9be">
                            <div>
                                <h3 class="upload-card-title">Pitch Deck</h3>
                                <p class="upload-card-desc">Upload your presentation deck (PPTX or PDF).</p>
                            </div>
                            <div class="upload-icon-top">
                                <i class="fa-solid fa-arrow-up-from-bracket"></i>
                            </div>
                        </div>
                        
                        <div class="file-select-box pf-dedup-b202c6" id="pitch-deck-selectbox">
                            <input class="pf-dedup-cb4589" type="file" id="pitch_deck_input" accept=".pdf,.pptx,.docx">
                            <div class="file-icon-wrapper">
                                <i class="fa-regular fa-file-lines"></i>
                            </div>
                            <div class="file-info">
                                <div class="file-name-placeholder" id="pitch-deck-text">Select a file...</div>
                                <div class="file-accepted">ACCEPTED: .PDF, .PPTX, .DOCX</div>
                            </div>
                            <button type="button" class="btn-choose-file" id="pitch-deck-btn">Choose File</button>
                        </div>
                    </div>

                    <!-- Solution Screenshots Card -->
                    <div class="upload-card">
                        <div class="upload-card-header">
                            <div>
                                <h3 class="upload-card-title">Solution Screenshots <span class="pf-dedup-8fbd8d">(Optional)</span></h3>
                                <p class="upload-card-desc">Visual snapshots of the interface or technical architecture.</p>
                            </div>
                            <div class="upload-icon-top">
                                <i class="fa-regular fa-image"></i>
                            </div>
                        </div>
                        
                        <div class="screenshot-grid">
                            <div class="screenshot-placeholder">
                                <i class="fa-solid fa-image pf-dedup-b4fe5e"></i>
                            </div>
                            <div class="screenshot-item">
                                <img src="https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?auto=format&fit=crop&q=80&w=400&h=400" alt="Mobile App">
                            </div>
                            <div class="screenshot-item">
                                <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&q=80&w=400&h=400" alt="Dashboard Dark">
                            </div>
                            <div class="screenshot-item">
                                <img src="https://images.unsplash.com/photo-1611162617474-5b21e879e113?auto=format&fit=crop&q=80&w=400&h=400" alt="Mobile Blue">
                            </div>
                        </div>
                    </div>
                    
                </div>
                
                <!-- Right Column -->
                <div class="wizard-sidebar">
                    
                    <!-- Tips Widget -->
                    <div class="tips-widget">
                        <div class="widget-title">
                            <i class="fa-solid fa-circle-info"></i> Submission Tips
                        </div>
                        <ul class="tips-list">
                            <li>Keep your demo video under 3 minutes. Focus on high-impact features.</li>
                            <li>Ensure your pitch deck contains a clear financial roadmap.</li>
                            <li>High-resolution screenshots significantly increase trust scores by 15%.</li>
                        </ul>
                    </div>

                    <!-- Status Widget -->
                    <div class="status-widget">
                        <div class="status-widget-title">Vetting Status</div>
                        
                        <div class="completeness-row">
                            <span class="completeness-label">Completeness</span>
                            <span class="completeness-value">45%</span>
                        </div>
                        
                        <div class="progress-container">
                            <div class="progress-bar pf-dedup-719087"></div>
                        </div>
                        
                        <div class="status-badge">
                            <i class="fa-regular fa-circle-check"></i> DUE DILIGENCE READY
                        </div>
                    </div>

                    <!-- Vault Widget -->
                    <div class="vault-widget">
                        <img src="https://images.unsplash.com/photo-1526304640581-d334cdbbf45e?auto=format&fit=crop&q=80&w=600" alt="Security Vault">
                        <div class="vault-content">
                            <h4>Secure Vault Storage</h4>
                            <p>All attachments are encrypted at rest with AES-256 standards.</p>
                        </div>
                    </div>

                </div>
                
            <!-- Bottom Actions -->
            <div class="wizard-actions">
                <button type="button" class="btn-back" id="btn-back"><i class="fa-solid fa-arrow-left"></i> Back to Details</button>
                <button type="button" class="btn-next" id="btn-next">Continue to Financials <i class="fa-solid fa-arrow-right"></i></button>
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
        // 2. IndexedDB Setup
        const dbName = "PFundWizardDB";
        const storeName = "wizardFiles";

        function openDB() {
            return new Promise((resolve, reject) => {
                const request = indexedDB.open(dbName, 1);
                request.onupgradeneeded = (e) => {
                    const db = e.target.result;
                    if (!db.objectStoreNames.contains(storeName)) {
                        db.createObjectStore(storeName);
                    }
                };
                request.onsuccess = (e) => resolve(e.target.result);
                request.onerror = (e) => reject(e.target.error);
            });
        }

        async function saveFileToDB(key, file) {
            const db = await openDB();
            return new Promise((resolve, reject) => {
                const transaction = db.transaction(storeName, "readwrite");
                const store = transaction.objectStore(storeName);
                const request = store.put(file, key);
                request.onsuccess = () => resolve();
                request.onerror = () => reject(request.error);
            });
        }

        async function getFileFromDB(key) {
            const db = await openDB();
            return new Promise((resolve, reject) => {
                const transaction = db.transaction(storeName, "readonly");
                const store = transaction.objectStore(storeName);
                const request = store.get(key);
                request.onsuccess = () => resolve(request.result);
                request.onerror = () => reject(request.error);
            });
        }

        // 3. Document Interactivity
        const demoZone = document.getElementById('demo-video-dropzone');
        const demoInput = document.getElementById('demo_video_input');
        const demoText = document.getElementById('demo-video-text');

        const pitchZone = document.getElementById('pitch-deck-selectbox');
        const pitchInput = document.getElementById('pitch_deck_input');
        const pitchText = document.getElementById('pitch-deck-text');
        const pitchBtn = document.getElementById('pitch-deck-btn');

        // Check if files already saved in IndexedDB
        async function loadSavedFileNames() {
            try {
                const demoFile = await getFileFromDB('demo_video');
                if (demoFile) {
                    demoText.textContent = `Attached: ${demoFile.name} (${(demoFile.size / (1024 * 1024)).toFixed(2)} MB)`;
                }
                const pitchFile = await getFileFromDB('pitch_deck');
                if (pitchFile) {
                    pitchText.textContent = `Attached: ${pitchFile.name} (${(pitchFile.size / (1024 * 1024)).toFixed(2)} MB)`;
                }
            } catch (err) {
                console.error("IndexedDB read error:", err);
            }
        }
        loadSavedFileNames();

        // Click handlers
        demoZone.addEventListener('click', (e) => {
            if (e.target !== demoInput) {
                demoInput.click();
            }
        });

        pitchZone.addEventListener('click', (e) => {
            if (e.target !== pitchInput) {
                pitchInput.click();
            }
        });

        pitchBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            pitchInput.click();
        });

        // Input changes
        demoInput.addEventListener('change', async (e) => {
            const file = e.target.files[0];
            if (file) {
                if (file.size > 52428800) { // 50MB
                    alert("Demo video size exceeds 50MB limit.");
                    return;
                }
                demoText.textContent = "Processing video...";
                await saveFileToDB('demo_video', file);
                demoText.textContent = `Attached: ${file.name} (${(file.size / (1024 * 1024)).toFixed(2)} MB)`;
            }
        });

        pitchInput.addEventListener('change', async (e) => {
            const file = e.target.files[0];
            if (file) {
                if (file.size > 10485760) { // 10MB
                    alert("Pitch deck size exceeds 10MB limit.");
                    return;
                }
                pitchText.textContent = "Processing document...";
                await saveFileToDB('pitch_deck', file);
                pitchText.textContent = `Attached: ${file.name} (${(file.size / (1024 * 1024)).toFixed(2)} MB)`;
            }
        });

        // Drag and drop support for video
        demoZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            demoZone.style.borderColor = '#0ea5e9';
            demoZone.style.background = '#eff6ff';
        });

        demoZone.addEventListener('dragleave', () => {
            demoZone.style.borderColor = '#cbd5e1';
            demoZone.style.background = '';
        });

        demoZone.addEventListener('drop', async (e) => {
            e.preventDefault();
            demoZone.style.borderColor = '#cbd5e1';
            demoZone.style.background = '';
            
            const file = e.dataTransfer.files[0];
            if (file) {
                if (file.type !== 'video/mp4') {
                    alert("Only MP4 files are supported for the demo video.");
                    return;
                }
                if (file.size > 52428800) {
                    alert("Demo video size exceeds 50MB limit.");
                    return;
                }
                demoText.textContent = "Processing video...";
                await saveFileToDB('demo_video', file);
                demoText.textContent = `Attached: ${file.name} (${(file.size / (1024 * 1024)).toFixed(2)} MB)`;
            }
        });

        // Button actions
        document.getElementById('btn-back').addEventListener('click', () => {
            window.location.href = "{{ route('user.project-submit-1') }}";
        });

        document.getElementById('btn-next').addEventListener('click', async () => {
            // Note: Since files are optional/recommended, we proceed without blocking
            window.location.href = "{{ route('user.project-submit-3') }}";
        });
    </script>
</body>
</html>
