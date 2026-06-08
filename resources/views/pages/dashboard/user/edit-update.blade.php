<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/jpeg" href="{{ asset('assets/images/project logo.jpeg') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Project | P-FUNDS</title>
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
                    
                    <a href="{{ route('user.profile') }}" style="text-decoration: none; cursor: pointer;" class="user-profile">
                        <div class="user-info">
                            <span class="name">Alex Rivers</span>
                            <span class="role">FOUNDER & CEO</span>
                        </div>
                        <img src="https://ui-avatars.com/api/?name=Alex+Rivers&background=0D8ABC&color=fff&rounded=true" alt="Alex Rivers" class="avatar">
                    </a>
                </div>
            </header>

            <div class="edit-header">
                <h2 id="project-title-header">Edit Project</h2>
                <p>Review the vetting feedback and update your project dossier accordingly.</p>
            </div>
            
            <div class="feedback-banner pf-dedup-cb4589" id="feedback-banner">
                <h4><i class="fa-solid fa-triangle-exclamation"></i> Vetting Feedback Required</h4>
                <p id="feedback-text"></p>
            </div>
            
            <!-- Form Sections -->
            <form id="edit-project-form">
                <!-- Section 1 -->
                <div class="edit-section">
                    <div class="edit-section-title">1. Basic Project Details</div>
                    <div class="form-grid">
                        <div class="form-group">
                            <label>Project Name</label>
                            <input type="text" id="project-title-input" required>
                        </div>
                        <div class="form-group">
                            <label>Funding Requested (FCFA)</label>
                            <input type="number" id="project-budget-input" required>
                        </div>
                        <div class="form-group pf-dedup-b45265">
                            <label>Problem Statement & Description</label>
                            <textarea rows="6" id="project-description-input" required></textarea>
                        </div>
                    </div>
                </div>
                
                <!-- Section 2 -->
                <div class="edit-section">
                    <div class="edit-section-title">2. Remediation Notes (Append to Description)</div>
                    <div class="form-group">
                        <label>Response to Vetter Comments</label>
                        <textarea rows="4" id="project-remediation-input" placeholder="Detail how you have addressed the feedback..."></textarea>
                    </div>
                </div>
                
                <!-- Section 3 -->
                <div class="edit-section">
                    <div class="edit-section-title">3. Current & Updated Attachments</div>
                    <div class="pf-dedup-7a68fb" id="attachments-list">
                        <!-- Dynamically populated current files -->
                    </div>
                    
                    <div class="form-grid">
                        <div class="file-upload-box" onclick="document.getElementById('file-input').click()">
                            <i class="fa-solid fa-file-arrow-up pf-dedup-f42113"></i>
                            <p>Upload New Document</p>
                            <span>PDF, DOCX, XLSX, MP4, JPG, PNG (Max 50MB)</span>
                            <input class="pf-dedup-cb4589" type="file" id="file-input" multiple>
                        </div>
                    </div>
                </div>
                
                <div class="action-footer">
                    <button type="button" class="btn-cancel" onclick="window.location.href="{{ route('user.project-update') }}"">Cancel</button>
                    <button type="button" class="btn-save" id="btn-save-project">Save Changes</button>
                    <button type="button" class="btn-submit" id="btn-submit-project">Resubmit Dossier</button>
                </div>
            </form>

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
                // Populate user panel (not dynamically present in default layout topbar but let's handle if it is)
                const dispNameEl = document.querySelector('.user-info .name');
                const dispRoleEl = document.querySelector('.user-info .role');
                const dispAvatarEl = document.querySelector('.user-profile .avatar');
                if (dispNameEl) dispNameEl.textContent = user.name;
                if (dispRoleEl) {
                    let role = user.role || 'GENERAL USER';
                    if (role.toLowerCase() === 'creator' || role.toLowerCase() === 'general') {
                        role = 'PROJECT SPONSOR / CREATOR';
                    }
                    dispRoleEl.textContent = role.toUpperCase();
                }
                if (dispAvatarEl) dispAvatarEl.src = user.avatar_url || `https://ui-avatars.com/api/?name=${encodeURIComponent(user.name)}&background=0D8ABC&color=fff&rounded=true`;
            } catch (e) { console.error("Error parsing user data"); }
        }

        // 2. Fetch Project Data
        const urlParams = new URLSearchParams(window.location.search);
        const projectId = urlParams.get('project_id');
        if (!projectId) {
            alert('No Project ID specified. Returning to remediation queue.');
            window.location.href = "{{ route('user.project-update') }}";
        }

        let currentProject = null;

        async function fetchProjectDetails() {
            try {
                const resJson = await apiClient.get(`/projects/${projectId}`);
                currentProject = resJson.data;

                // Populate UI
                document.getElementById('project-title-header').textContent = `Edit Project: ${currentProject.title}`;
                document.getElementById('project-title-input').value = currentProject.title;
                document.getElementById('project-budget-input').value = Math.floor(currentProject.budget_amount);
                document.getElementById('project-description-input').value = currentProject.description || '';

                // Admin Remarks Banner
                if (currentProject.admin_remarks) {
                    document.getElementById('feedback-banner').style.display = 'block';
                    document.getElementById('feedback-text').textContent = currentProject.admin_remarks;
                } else {
                    document.getElementById('feedback-banner').style.display = 'none';
                }

                // Render current attachments list
                renderAttachments(currentProject.documents || []);

            } catch (err) {
                console.error(err);
                alert('Error loading project details. Please try again.');
                window.location.href = "{{ route('user.project-update') }}";
            }
        }

        function renderAttachments(documents) {
            const listContainer = document.getElementById('attachments-list');
            if (documents.length === 0) {
                listContainer.innerHTML = `<p class="pf-dedup-9c97eb">No documents currently attached.</p>`;
                return;
            }

            listContainer.innerHTML = documents.map(doc => {
                const sizeMB = (doc.file_size / (1024 * 1024)).toFixed(2);
                return `
                    <div class="pf-dedup-4e6f25">
                        <div class="pf-dedup-786cae">
                            <i class="fa-solid fa-paperclip pf-dedup-d2abea"></i>
                            <span class="pf-dedup-1e29ee">${doc.file_name}</span>
                            <span class="pf-dedup-1252f0">(${sizeMB} MB)</span>
                        </div>
                        <button class="pf-dedup-ec790a" type="button" onclick="deleteDocument(${doc.id})">
                            <i class="fa-regular fa-trash-can"></i> Delete
                        </button>
                    </div>
                `;
            }).join('');
        }

        // 3. Document Deletion Handler
        async function deleteDocument(docId) {
            if (!confirm('Are you sure you want to permanently remove this document?')) return;

            try {
                await apiClient.delete(`/projects/${projectId}/documents/${docId}`);
                alert('Document removed successfully.');
                fetchProjectDetails(); // Refresh details and documents list

            } catch (err) {
                console.error(err);
                alert(err.message || 'Failed to delete document.');
            }
        }

        // 4. Document Upload Handler
        document.getElementById('file-input').addEventListener('change', async (e) => {
            const files = e.target.files;
            if (files.length === 0) return;

            const formData = new FormData();
            for (let i = 0; i < files.length; i++) {
                formData.append('documents[]', files[i]);
            }

            try {
                // Save textual changes first to prevent losing inputs on page refresh!
                if (currentProject && (currentProject.status === 'rejected' || currentProject.status === 'needs_update' || currentProject.status === 'draft')) {
                    await saveChanges(false); // save silently
                }

                await apiClient.request(`/projects/${projectId}/documents`, {
                    method: 'POST',
                    body: formData
                });

                alert('Document(s) uploaded successfully.');
                fetchProjectDetails(); // Refresh list

            } catch (err) {
                console.error(err);
                alert(err.message || 'Failed to upload document(s).');
            } finally {
                e.target.value = ''; // Reset input
            }
        });

        // 5. Save Changes Function
        async function saveChanges(showAlert = true) {
            const title = document.getElementById('project-title-input').value.trim();
            const budgetAmount = parseFloat(document.getElementById('project-budget-input').value);
            let description = document.getElementById('project-description-input').value.trim();
            const remediation = document.getElementById('project-remediation-input').value.trim();

            if (!title || isNaN(budgetAmount) || !description) {
                alert('Please fill out all required fields.');
                return false;
            }

            // Append remediation notes to description if provided
            if (remediation) {
                description += `\n\n**Remediation Notes / Vetter Response:**\n${remediation}`;
            }

            try {
                const resJson = await apiClient.put(`/projects/${projectId}`, {
                    title: title,
                    budget_amount: budgetAmount,
                    description: description,
                    category: currentProject ? currentProject.category : 'other'
                });

                // Update current project cache
                currentProject = resJson.data;

                // Clear remediation field after appending
                document.getElementById('project-remediation-input').value = '';
                document.getElementById('project-description-input').value = currentProject.description || '';

                if (showAlert) alert('Project changes saved successfully.');
                return true;

            } catch (err) {
                console.error(err);
                alert(err.message || 'Failed to save changes.');
                return false;
            }
        }

        // Save Button Handler
        document.getElementById('btn-save-project').addEventListener('click', () => saveChanges(true));

        // 6. Resubmit Dossier Handler
        document.getElementById('btn-submit-project').addEventListener('click', async () => {
            if (!confirm('Are you sure you want to resubmit this dossier for institutional vetting?')) return;

            // Save text changes first
            const saved = await saveChanges(false);
            if (!saved) return;

            try {
                await apiClient.request(`/projects/${projectId}/submit`, {
                    method: 'POST'
                });

                alert('Dossier successfully resubmitted. Returning to portfolio review.');
                window.location.href = "{{ route('user.project-review') }}";

            } catch (err) {
                console.error(err);
                alert(err.message || 'Failed to resubmit project dossier.');
            }
        });

        // Initialize Page
        fetchProjectDetails();
    </script>
</body>
</html>

