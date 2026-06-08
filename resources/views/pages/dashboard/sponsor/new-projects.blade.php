<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/jpeg" href="{{ asset('assets/images/project logo.jpeg') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sponsor New Projects | P-FUNDS</title>
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('dist/styles/index.css') }}">
    
    <link rel="stylesheet" href="{{ asset('dist/styles/sponsor.css') }}">
</head>
<body>

    <!-- Sidebar Navigation -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <img src="{{ asset('assets/images/project logo.jpeg') }}" alt="P-FUNDS Logo">
        </div>
        <div class="sidebar-identity">
            <div class="role-name">Sponsor Portal</div>
            <div class="role-subtitle">FUNDING AUTHORITY</div>
        </div>
        <nav class="sidebar-nav">
            <a href="{{ route('sponsor.dashboard') }}" class="nav-item"><i class="fa-solid fa-border-all"></i> Dashboard</a>
            <a href="{{ route('sponsor.new-projects') }}" class="nav-item active"><i class="fa-solid fa-bolt"></i> New Projects</a>
            <a href="{{ route('sponsor.project-review') }}" class="nav-item"><i class="fa-solid fa-clock-rotate-left"></i> Project Review</a>
            <a href="{{ route('sponsor.profile') }}" class="nav-item"><i class="fa-regular fa-circle-user"></i> Profile</a>
        </nav>
        <div class="sidebar-footer">
            <a href="{{ route('logout') }}" class="nav-item" id="logout-btn"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <div class="header-top">
            <h1>New Project Submissions</h1>
            <div class="pf-dedup-c84b7b">
                <!-- Notification Bell -->
                <div class="pf-dedup-eba4ea">
                    <button class="icon-btn pf-dedup-233408" onclick="document.getElementById('notif-dropdown').classList.toggle('show')" onmouseover="this.style.color='var(--primary)'" onmouseout="this.style.color='var(--text-muted)'">
                        <i class="fa-regular fa-bell"></i>
                    </button>
                    <div class="pf-dedup-e9c927" id="notif-dropdown">
                        <!-- Dynamically populated by notifications.js -->
                    </div>
                </div>

                <a href="{{ route('sponsor.profile') }}" style="text-decoration: none; cursor: pointer;" class="pf-dedup-d27166">
                    <span class="pf-dedup-093364" id="userName">Hello, Sponsor</span>
                    <img class="pf-dedup-b91b77" id="userAvatar" src="https://ui-avatars.com/api/?name=Sponsor&background=3b82f6&color=fff&rounded=true" alt="Avatar">
                </a>
            </div>
        </div>

        <!-- All New Projects Table -->
        <div class="table-container">
            <div class="table-header">
                <h2>All Submitted Projects</h2>
                <p>Browse newly verified projects, mark interest, save for later, or reject submissions.</p>
            </div>
            <table id="new-projects-table">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Project Name</th>
                        <th>Description</th>
                        <th>Funding Amt</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="new-projects-tbody">
                    <tr><td colspan="5" class="empty-state"><i class="fa-solid fa-spinner fa-spin"></i> Loading new projects...</td></tr>
                </tbody>
            </table>
        </div>
    </main>

    <!-- Project Details Modal -->
    <div class="modal-overlay" id="project-details-modal">
        <div class="modal-content">
            <button class="modal-close" onclick="closeProjectDetailsModal()">&times;</button>
            <div class="modal-header">
                <h2 id="modal-project-title">Project Title</h2>
                <div class="modal-meta">
                    <span class="modal-meta-item"><i class="fa-solid fa-tag"></i> <span id="modal-project-category">Category</span></span>
                    <span class="modal-meta-item"><i class="fa-solid fa-wallet"></i> <span id="modal-project-budget">Budget</span></span>
                    <span class="modal-meta-item"><i class="fa-solid fa-user"></i> <span id="modal-project-creator">Creator</span></span>
                </div>
            </div>
            <div class="modal-section">
                <h4>Description</h4>
                <p class="modal-description" id="modal-project-description">Project Description goes here...</p>
            </div>
            <div class="modal-section">
                <h4>Attachments / Documents</h4>
                <div class="attachments-list" id="modal-project-attachments">
                    <!-- Dynamic attachment items will go here -->
                </div>
            </div>
        </div>
    </div>

    <!-- Global Chat Panel -->
    <div class="chat-panel" id="global-chat-panel">
        <div class="chat-header pf-dedup-53da94">
            <div class="pf-dedup-786cae">
                <i class="fa-solid fa-earth-americas"></i>
                <h3 class="pf-dedup-6d676d">Global Platform Chat</h3>
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
            <button class="pf-dedup-4e76a9" onclick="sendGlobalMessage()">
                <i class="fa-solid fa-paper-plane"></i>
            </button>
        </div>
    </div>
    
    <!-- Chat Widget Button -->
    <button class="chat-widget" onclick="toggleGlobalChat()">
        <i class="fa-solid fa-message"></i>
        <span class="notification-dot pf-dedup-cb4589" id="chat-notif-dot"></span>
    </button>

    <!-- Scripts -->
    <script src="{{ asset('assets/js/api.js') }}?v=1.0.4"></script>
    <script src="{{ asset('assets/js/notifications.js') }}"></script>
    <script src="{{ asset('assets/js/chat.js') }}?v=1.0.4"></script>
    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            // Check auth token defensively
            if (!localStorage.getItem('pfunds_token') && localStorage.getItem('auth_token')) {
                localStorage.setItem('pfunds_token', localStorage.getItem('auth_token'));
            }
            if (!localStorage.getItem('pfunds_user') && localStorage.getItem('user')) {
                localStorage.setItem('pfunds_user', localStorage.getItem('user'));
            }

            const token = localStorage.getItem('pfunds_token');
            if (!token) {
                window.location.href = "{{ route('logout') }}";
                return;
            }

            // Set user name and avatar
            const userStr = localStorage.getItem('pfunds_user');
            if (userStr) {
                try {
                    const user = JSON.parse(userStr);
                    document.getElementById('userName').textContent = `Hello, ${user.name}`;
                    if (user.avatar_url) {
                        document.getElementById('userAvatar').src = user.avatar_url;
                    } else {
                        document.getElementById('userAvatar').src = `https://ui-avatars.com/api/?name=${encodeURIComponent(user.name)}&background=3b82f6&color=fff&rounded=true`;
                    }
                } catch (e) {
                    console.error("Error parsing user data:", e);
                }
            }

            // Load data
            await loadNewProjects();

            // Setup logout button
        });

        async function loadNewProjects() {
            try {
                // Fetch projects
                const projectsData = await apiClient.get('/sponsor/projects');
                const projects = Array.isArray(projectsData) ? projectsData : (projectsData.projects || []);
                renderNewProjects(projects);
            } catch (error) {
                console.error("Failed to load new projects:", error);
                let message = 'Failed to load data. Ensure the API is running.';
                if (error.status === 403) {
                    message = 'Access Denied. You do not have permission to view the Sponsor dashboard.';
                }
                const errorMsg = `<tr><td class="pf-dedup-4b996d" colspan="5"><i class="fa-solid fa-triangle-exclamation"></i> ${message}</td></tr>`;
                document.getElementById('new-projects-tbody').innerHTML = errorMsg;
            }
        }

        function renderNewProjects(projects) {
            const tbody = document.getElementById('new-projects-tbody');
            tbody.innerHTML = '';

            if (projects.length === 0) {
                tbody.innerHTML = '<tr><td colspan="5" class="empty-state"><i class="fa-regular fa-folder-open"></i><br>No new project submissions found.</td></tr>';
                return;
            }

            projects.forEach(project => {
                const tr = document.createElement('tr');
                const creatorName = project.creator ? project.creator.name : (project.user ? project.user.name : 'Unknown Creator');
                
                // Format Funding
                const symbolMap = {
                    'USD': '$',
                    'NGN': '₦',
                    'EUR': '€',
                    'GBP': '£'
                };
                const currencySymbol = symbolMap[project.budget_currency] || project.budget_currency || '$';
                const formattedFunding = `${currencySymbol}${parseFloat(project.budget_amount).toLocaleString()}`;
                const rawDesc = project.description || '';
                const previewDesc = rawDesc.length > 80 ? rawDesc.substring(0, 80) + '...' : rawDesc;

                tr.innerHTML = `
                    <td class="pf-dedup-cc5621"><i class="fa-regular fa-user pf-dedup-ed18db"></i>${escapeHtml(creatorName)}</td>
                    <td class="pf-dedup-3acea4">${escapeHtml(project.title)}</td>
                    <td class="pf-dedup-5b795a">${escapeHtml(previewDesc)}</td>
                    <td class="pf-dedup-607e0c">${formattedFunding}</td>
                    <td class="pf-dedup-4ddbe9">
                        <button class="action-btn" onclick="viewDetails(${project.id})" title="See More"><i class="fa-solid fa-eye"></i></button>
                        <button class="action-btn btn-like" onclick="interactWithProject(${project.id}, 'like')" title="Interested/Like"><i class="fa-solid fa-heart"></i></button>
                        <button class="action-btn btn-dislike" onclick="interactWithProject(${project.id}, 'dislike')" title="Not Interested/Dislike"><i class="fa-solid fa-xmark"></i></button>
                        <button class="action-btn btn-save" onclick="interactWithProject(${project.id}, 'save')" title="Save"><i class="fa-solid fa-bookmark"></i></button>
                    </td>
                `;
                tbody.appendChild(tr);
            });
        }

        async function interactWithProject(projectId, type) {
            try {
                await apiClient.post(`/sponsor/projects/${projectId}/interact`, { type: type });
                alert(`Successfully marked as ${type}!`);
                await loadNewProjects();
            } catch (error) {
                console.error("Interaction failed:", error);
                alert("Could not save interaction. Make sure the API is running.");
            }
        }

        async function viewDetails(projectId) {
            try {
                const response = await apiClient.get(`/projects/${projectId}/all-documents`);
                const data = response.data || response;
                
                const projectRes = await apiClient.get(`/sponsor/projects/${projectId}`);
                const project = projectRes.project;
                
                document.getElementById('modal-project-title').textContent = project.title;
                document.getElementById('modal-project-category').textContent = project.category || 'N/A';
                
                const currencySymbol = project.currency ? (project.currency === 'USD' ? '$' : (project.currency === 'NGN' ? '₦' : project.currency)) : '$';
                const formattedBudget = currencySymbol + Number(project.budget || 0).toLocaleString();
                document.getElementById('modal-project-budget').textContent = formattedBudget;
                
                document.getElementById('modal-project-creator').textContent = project.creator ? project.creator.name : 'Unknown';
                document.getElementById('modal-project-description').textContent = project.description || 'No description provided.';
                
                const attachmentsContainer = document.getElementById('modal-project-attachments');
                attachmentsContainer.innerHTML = '';
                
                const docs = data.documents || [];
                if (docs.length === 0) {
                    attachmentsContainer.innerHTML = '<div class="pf-dedup-40cf0f">No documents uploaded.</div>';
                } else {
                    docs.forEach(doc => {
                        const fileExt = doc.name.split('.').pop().toLowerCase();
                        let iconClass = 'fa-file';
                        if (fileExt === 'pdf') iconClass = 'fa-file-pdf';
                        else if (['doc', 'docx'].includes(fileExt)) iconClass = 'fa-file-word';
                        else if (['jpg', 'jpeg', 'png'].includes(fileExt)) iconClass = 'fa-file-image';
                        
                        const item = document.createElement('div');
                        item.className = 'attachment-item';
                        
                        let sizeStr = 'N/A';
                        if (doc.size) {
                            const kb = doc.size / 1024;
                            sizeStr = kb > 1024 ? (kb / 1024).toFixed(1) + ' MB' : kb.toFixed(0) + ' KB';
                        }
                        
                        item.innerHTML = `
                            <div class="attachment-info">
                                <i class="fa-solid ${iconClass}"></i>
                                <div class="attachment-details">
                                    <div class="attachment-name" title="${escapeHtml(doc.name)}">${escapeHtml(doc.name)}</div>
                                    <div class="attachment-size">${sizeStr}</div>
                                </div>
                            </div>
                            <button class="btn-download-file" onclick="downloadAttachmentFile(${doc.id}, '${doc.name.replace(/'/g, "\'")}')">
                                <i class="fa-solid fa-download"></i> Download
                            </button>
                        `;
                        attachmentsContainer.appendChild(item);
                    });
                }
                
                document.getElementById('project-details-modal').classList.add('show');
                
                apiClient.post(`/sponsor/projects/${projectId}/interact`, { type: 'viewed' }).catch(console.error);
            } catch (err) {
                console.error("Failed to load project details:", err);
                alert("Failed to load project details: " + err.message);
            }
        }
        
        function closeProjectDetailsModal() {
            document.getElementById('project-details-modal').classList.remove('show');
        }
        
        async function downloadAttachmentFile(docId, name) {
            try {
                const response = await fetch(`/api/v1/documents/${docId}/download`, {
                    headers: {
                        'Authorization': 'Bearer ' + (localStorage.getItem('pfunds_token') || localStorage.getItem('auth_token'))
                    }
                });
                if (!response.ok) throw new Error('File download failed');
                
                const blob = await response.blob();
                const url = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = name;
                document.body.appendChild(a);
                a.click();
                a.remove();
                window.URL.revokeObjectURL(url);
            } catch (err) {
                alert('Download failed: ' + err.message);
            }
        }

        function escapeHtml(str) {
            if (!str) return '';
            return str.replace(/&/g, "&amp;")
                      .replace(/</g, "&lt;")
                      .replace(/>/g, "&gt;")
                      .replace(/"/g, "&quot;")
                      .replace(/'/g, "&#039;");
        }
    </script>
</body>
</html>
