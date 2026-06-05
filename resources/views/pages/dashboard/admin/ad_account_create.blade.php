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
                <a href="{{ route('admin.dashboard') }}" class="nav-item active"><i class="fa-solid fa-border-all"></i> Dashboard</a>
                
                <div class="nav-group">
                    <div class="nav-group-header" onclick="this.parentElement.classList.toggle('expanded')">
                        <div class="pf-dedup-e2f701">
                            <i class="fa-solid fa-users icon"></i> Account Management
                        </div>
                        <i class="fa-solid fa-chevron-right chevron"></i>
                    </div>
                    <div class="sub-nav">
                        <a href="{{ route('admin.account-create') }}" class="sub-nav-item">Create Account</a>
                        <a href="{{ route('admin.account-review') }}" class="sub-nav-item">View Accounts</a>
                        <a href="{{ route('admin.role-assignment') }}" class="sub-nav-item">Role Assignments</a>
                        <a href="{{ route('admin.activity-logs') }}" class="sub-nav-item">Activity Logs</a>
                    </div>
                </div>

                <div class="nav-group">
                    <div class="nav-group-header" onclick="this.parentElement.classList.toggle('expanded')">
                        <div class="pf-dedup-e2f701">
                            <i class="fa-solid fa-folder-tree icon"></i> Project Management
                        </div>
                        <i class="fa-solid fa-chevron-right chevron"></i>
                    </div>
                    <div class="sub-nav">
                        <a href="{{ route('admin.project-review') }}" class="sub-nav-item">Pending Approval</a>
                        <a href="{{ route('admin.rejected-projects') }}" class="sub-nav-item">Rejected Projects</a>
                        <a href="{{ route('admin.project-tracking') }}" class="sub-nav-item">Project Tracking</a>
                        <a href="{{ route('admin.milestones') }}" class="sub-nav-item">Milestone Updates</a>
                    </div>
                </div>

                <a href="{{ route('admin.activity-logs') }}" class="nav-item"><i class="fa-regular fa-eye"></i> System Oversight</a>
                <a href="{{ route('admin.profile') }}" class="nav-item"><i class="fa-regular fa-circle-user"></i> Profile</a>
            </nav>

            <div class="sidebar-footer pf-dedup-56115e">
                <nav class="sidebar-nav pf-dedup-53896a">
                    <a href="#" class="nav-item">
                        <i class="fa-solid fa-shield-halved"></i> Security Logs
                    </a>
                    <a href="{{ route('auth.logout') }}" class="nav-item">
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
                    
                    

                    <div class="user-profile pf-dedup-564b7d">
                        <img src="https://ui-avatars.com/api/?name=Admin&background=0a192f&color=fff&rounded=true" alt="Admin" class="avatar" id="display-avatar">
                    </div>
                </div>
            </header>

            <div class="dashboard-header pf-dedup-53896a">
                <h2>Create Account</h2>
                <p>Provision new institutional accounts for Vetters and Sponsors.</p>
            </div>

            <div class="admin-table-section pf-dedup-375d5b">
                <form class="pf-dedup-ac4e39" id="create-account-form" onsubmit="handleAccountCreate(event)">
                    <div class="pf-dedup-20f3dc">
                        <div>
                            <label class="pf-dedup-867e5d">Full Name</label>
                            <input class="pf-dedup-0785ee" type="text" id="acc_name" required onfocus="this.style.borderColor='#064e3b'; this.style.boxShadow='0 0 0 3px rgba(6,78,59,0.1)'" onblur="this.style.borderColor='#cbd5e1'; this.style.boxShadow='none'">
                        </div>
                        <div>
                            <label class="pf-dedup-867e5d">Email Address</label>
                            <input class="pf-dedup-0785ee" type="email" id="acc_email" required onfocus="this.style.borderColor='#064e3b'; this.style.boxShadow='0 0 0 3px rgba(6,78,59,0.1)'" onblur="this.style.borderColor='#cbd5e1'; this.style.boxShadow='none'">
                        </div>
                    </div>

                    <div class="pf-dedup-20f3dc">
                        <div>
                            <label class="pf-dedup-867e5d">Physical Address</label>
                            <input class="pf-dedup-0785ee" type="text" id="acc_address" required onfocus="this.style.borderColor='#064e3b'; this.style.boxShadow='0 0 0 3px rgba(6,78,59,0.1)'" onblur="this.style.borderColor='#cbd5e1'; this.style.boxShadow='none'">
                        </div>
                        <div>
                            <label class="pf-dedup-867e5d">Phone Number (Optional)</label>
                            <input class="pf-dedup-0785ee" type="tel" id="acc_phone" onfocus="this.style.borderColor='#064e3b'; this.style.boxShadow='0 0 0 3px rgba(6,78,59,0.1)'" onblur="this.style.borderColor='#cbd5e1'; this.style.boxShadow='none'">
                        </div>
                    </div>

                    <div class="pf-dedup-20f3dc">
                        <div>
                            <label class="pf-dedup-867e5d">Account Role</label>
                            <select class="pf-dedup-59aa04" id="acc_role" required onchange="toggleVetterLevel(this)" onfocus="this.style.borderColor='#064e3b'; this.style.boxShadow='0 0 0 3px rgba(6,78,59,0.1)'" onblur="this.style.borderColor='#cbd5e1'; this.style.boxShadow='none'">
                                <option value="" disabled selected>Select assigned tier</option>
                                <option value="vetter">Vetter (Technical Reviewer)</option>
                                <option value="sponsor">Sponsor (Funding Partner)</option>
                                <option value="admin">Sovereign Admin</option>
                            </select>
                        </div>
                        <div class="pf-dedup-cb4589" id="vetter_level_container">
                            <label class="pf-dedup-867e5d">Vetter Evaluation Level</label>
                            <select class="pf-dedup-59aa04" id="acc_vetter_level" onfocus="this.style.borderColor='#064e3b'; this.style.boxShadow='0 0 0 3px rgba(6,78,59,0.1)'" onblur="this.style.borderColor='#cbd5e1'; this.style.boxShadow='none'">
                                <option value="1">Level 1 (Initial Screening)</option>
                                <option value="2">Level 2 (Technical Review)</option>
                                <option value="3">Level 3 (Final Approval)</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="pf-dedup-867e5d">Initial Password</label>
                        <input class="pf-dedup-0785ee" type="password" id="acc_password" required minlength="8" onfocus="this.style.borderColor='#064e3b'; this.style.boxShadow='0 0 0 3px rgba(6,78,59,0.1)'" onblur="this.style.borderColor='#cbd5e1'; this.style.boxShadow='none'">
                        <small class="pf-dedup-3fb820">Credentials will be automatically dispatched to the user's email upon creation.</small>
                    </div>

                    <div class="pf-dedup-f601c6">
                        <button type="button" class="btn-outline" onclick="document.getElementById('create-account-form').reset();">Clear Form</button>
                        <button type="submit" class="btn-dark pf-dedup-2d0029">Provision Account</button>
                    </div>
                </form>
            </div>

        </main>
        
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

        function toggleVetterLevel(selectElem) {
            const container = document.getElementById('vetter_level_container');
            if (selectElem.value === 'vetter') {
                container.style.display = 'block';
            } else {
                container.style.display = 'none';
            }
        }

        async function handleAccountCreate(event) {
            event.preventDefault();
            
            const submitBtn = event.target.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerText;
            submitBtn.innerText = 'Provisioning...';
            submitBtn.disabled = true;

            const name = document.getElementById('acc_name').value;
            const email = document.getElementById('acc_email').value;
            const role = document.getElementById('acc_role').value;
            const password = document.getElementById('acc_password').value;
            const address = document.getElementById('acc_address').value;
            const phone = document.getElementById('acc_phone').value;
            
            const payload = {
                name,
                email,
                role,
                password,
                password_confirmation: password,
                address,
                phone
            };

            if (role === 'vetter') {
                payload.vetter_level = parseInt(document.getElementById('acc_vetter_level').value);
            }

            try {
                await apiClient.post('/admin/users', payload);
                alert('Account successfully provisioned!');
                event.target.reset();
                toggleVetterLevel(document.getElementById('acc_role'));
            } catch (error) {
                alert('Failed to provision account: ' + error.message);
            } finally {
                submitBtn.innerText = originalText;
                submitBtn.disabled = false;
            }
        }
    </script>
<script src="{{ asset('assets/js/notifications.js') }}"></script>
    <script src="{{ asset('assets/js/chat.js') }}?v=1.0.4"></script></body>
</html>









