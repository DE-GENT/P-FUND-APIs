<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/jpeg" href="{{ asset('assets/images/project logo.jpeg') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vetting Queue | P-FUNDS</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('dist/styles/index.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/styles/dashboard.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('dist/styles/vetter.css') }}">
</head>
<body>
<div class="dashboard-container">

    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <img src="{{ asset('assets/images/project logo.jpeg') }}" alt="P-FUNDS Logo" style="max-height: 45px; border-radius: 6px; padding: 4px; background: #fff;">
        </div>
        <div class="sidebar-identity">
            <div class="role-name" style="color:#fff;">Vetter Portal</div>
            <div class="role-subtitle" style="color:#c4b5fd;">REVIEW AUTHORITY</div>
        </div>
        <nav class="sidebar-nav">
            <a href="{{ route('vetter.dashboard') }}" class="nav-item {{ request()->routeIs('vetter.dashboard') ? 'active' : '' }}"><i class="fa-solid fa-border-all"></i> Dashboard</a>
            <a href="{{ route('vetter.queue') }}" class="nav-item {{ request()->routeIs('vetter.queue') ? 'active' : '' }}"><i class="fa-solid fa-layer-group"></i> Vetting Queue</a>
            <a href="{{ route('vetter.deliverables') }}" class="nav-item {{ request()->routeIs('vetter.deliverables') ? 'active' : '' }}"><i class="fa-solid fa-file-circle-check"></i> Deliverables</a>
            <a href="{{ route('vetter.profile') }}" class="nav-item {{ request()->routeIs('vetter.profile') ? 'active' : '' }}"><i class="fa-regular fa-circle-user"></i> Profile</a>
        </nav>
        <div class="sidebar-footer" style="margin-top: auto;">
            <nav class="sidebar-nav" style="margin-top: 0;">
                <a href="{{ route('logout') }}" class="nav-item" id="logout-btn"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a>
            </nav>
        </div>
    </aside>

    <!-- Main -->
    <main class="main-content" style="overflow: hidden;">

        <header class="dashboard-topbar">
            <div class="brand-logo" style="font-weight: 700; color: #4c1d95;">Vetting Queue</div>
            <div class="topbar-actions">
                <div class="search-container">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" id="search-input" placeholder="Search projects...">
                </div>
                <div style="position: relative;">
                    <button class="icon-btn" onclick="document.getElementById('notif-dropdown').classList.toggle('show')">
                        <i class="fa-regular fa-bell"></i>
                    </button>
                    <div id="notif-dropdown" style="display:none; position: absolute; right: 0; top: 50px; background: white; border: 1px solid #e2e8f0; border-radius: 8px; width: 300px; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); z-index: 100;"></div>
                </div>
                <a href="{{ route('vetter.profile') }}" class="user-profile" style="text-decoration: none; cursor: pointer; border: none; padding-left: 0;">
                    <img src="https://ui-avatars.com/api/?name=Vetter&background=7c3aed&color=fff&rounded=true" alt="Vetter" class="avatar" id="display-avatar">
                    <span id="header-name" style="font-size: 14px; font-weight: 600; color: #1e1b4b;">Vetter</span>
                </a>
            </div>
        </header>

        <div class="queue-grid">
            <!-- Left: Project List -->
            <div>
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px;">
                    <h3 style="margin: 0; font-size: 16px; font-weight: 700; color: #1e1b4b;">Projects Awaiting Review</h3>
                    <span id="queue-count" style="background: #ede9fe; color: #7c3aed; font-size: 12px; font-weight: 700; padding: 4px 10px; border-radius: 99px;">—</span>
                </div>
                <div id="projects-list">
                    <div style="text-align: center; padding: 40px; color: #9ca3af;"><i class="fa-solid fa-spinner fa-spin"></i> Loading...</div>
                </div>
            </div>

            <!-- Right: Detail / Milestone Panel -->
            <div class="detail-panel" id="detail-panel">
                <div class="empty-panel">
                    <i class="fa-solid fa-arrow-left" style="color: #c4b5fd;"></i>
                    <p>Select a project from the list to begin reviewing milestones</p>
                </div>
            </div>
        </div>
    </main>
</div>

<!-- Chat -->
<button class="chat-widget" onclick="toggleGlobalChat()">
    <i class="fa-solid fa-message"></i>
    <span class="notification-dot" id="chat-notif-dot" style="display:none;"></span>
</button>
<!-- Chat Panel -->
<div class="chat-panel" id="global-chat-panel">
    <div class="chat-header" style="background-color: #4c1d95; padding: 15px; display: flex; justify-content: space-between; align-items: center; color: white;">
        <div style="display: flex; align-items: center; gap: 10px;">
            <i class="fa-solid fa-earth-americas"></i>
            <h3 style="margin: 0; font-size: 16px;">Global Platform Chat</h3>
        </div>
        <button class="icon-btn" onclick="toggleGlobalChat()" style="color: white; background: none; border: none; cursor: pointer;">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>
    <div class="chat-messages" id="global-chat-messages" style="padding: 15px; height: 350px; overflow-y: auto; background: #f8fafc; display: flex; flex-direction: column; gap: 10px;">
        <!-- Messages will be populated here -->
        <div style="text-align: center; color: #94a3b8; font-size: 12px; margin-top: auto; margin-bottom: auto;">
            Welcome to the Global Chat.<br>All roles can interact here.
        </div>
    </div>
    <div class="chat-input" style="padding: 15px; background: white; border-top: 1px solid #e2e8f0; display: flex; gap: 10px;">
        <input type="text" id="global-chat-input" placeholder="Type a message..." style="flex: 1; padding: 10px; border: 1px solid #e2e8f0; border-radius: 20px; font-family: 'Inter', sans-serif;">
        <button onclick="sendGlobalMessage()" style="background: #4c1d95; color: white; border: none; width: 40px; height: 40px; border-radius: 50%; cursor: pointer;">
            <i class="fa-solid fa-paper-plane"></i>
        </button>
    </div>
</div>

<script src="{{ asset('assets/js/api.js') }}?v=1.0.4"></script>
<script src="{{ asset('assets/js/notifications.js') }}"></script>
<script src="{{ asset('assets/js/chat.js') }}?v=1.0.4"></script>
<script>
let allProjects = [];
let selectedProjectId = null;
const currencies = { USD: '$', NGN: '₦', EUR: '€', GBP: '£' };

document.addEventListener('DOMContentLoaded', async () => {
    // Auth and Role check
    const token = localStorage.getItem('pfunds_token') || localStorage.getItem('auth_token');
    const userStr = localStorage.getItem('pfunds_user') || localStorage.getItem('user');
    if (!token || !userStr) { 
        window.location.href = "{{ route('logout') }}"; 
        return; 
    }

    const user = JSON.parse(userStr);
    const userRole = (user.role || '').toLowerCase();
    
    // Ensure the user has a Vetter role
    if (!userRole.startsWith('vetter')) {
        alert('Access Denied: You do not have permission to access the Vetter Portal.');
        if (userRole === 'admin') {
            window.location.href = "{{ route('admin.dashboard') }}";
        } else if (userRole === 'sponsor') {
            window.location.href = "{{ route('sponsor.dashboard') }}";
        } else {
            window.location.href = "{{ route('user.dashboard') }}";
        }
        return;
    }

    // Set avatar/name from user data
    document.getElementById('header-name').textContent = user.name;
    document.getElementById('display-avatar').src = user.avatar_url ||
        `https://ui-avatars.com/api/?name=${encodeURIComponent(user.name)}&background=7c3aed&color=fff&rounded=true`;

    await loadProjects();

    document.getElementById('search-input').addEventListener('input', e => {
        const q = e.target.value.toLowerCase();
        const filtered = allProjects.filter(p => p.title.toLowerCase().includes(q) || (p.user?.name || '').toLowerCase().includes(q));
        renderProjectList(filtered);
    });

});

async function loadProjects() {
    try {
        const res = await apiClient.get('/vetter/projects');
        allProjects = Array.isArray(res) ? res : (res.data || []);
        document.getElementById('queue-count').textContent = allProjects.length;
        renderProjectList(allProjects);
    } catch (err) {
        document.getElementById('projects-list').innerHTML = `<div style="text-align:center; padding:40px; color:#ef4444;">Failed to load queue.</div>`;
    }
}

function renderProjectList(projects) {
    const container = document.getElementById('projects-list');
    if (projects.length === 0) {
        container.innerHTML = `<div style="text-align:center; padding:60px 20px; color:#9ca3af;"><i class="fa-solid fa-inbox" style="font-size:36px; display:block; margin-bottom:10px;"></i>No projects in the queue.</div>`;
        return;
    }
    container.innerHTML = projects.map(p => {
        const done  = (p.milestones || []).filter(m => m.status === 'completed').length;
        const total = (p.milestones || []).length || 3;
        const pct   = Math.round((done / total) * 100);
        const sym   = currencies[p.budget_currency] || '$';
        return `<div class="project-card ${selectedProjectId === p.id ? 'selected' : ''}" onclick="selectProject(${p.id})" id="card-${p.id}">
            <div class="project-card-title">${p.title}</div>
            <div class="project-card-meta">
                <span><i class="fa-regular fa-user"></i>${p.user ? p.user.name : 'Unknown'}</span>
                <span><i class="fa-solid fa-tag"></i>${p.category || 'General'}</span>
                <span><i class="fa-solid fa-dollar-sign"></i>${sym}${parseFloat(p.budget_amount || 0).toLocaleString()}</span>
            </div>
            <div class="progress-bar-track" style="margin-top:10px;">
                <div class="progress-bar-fill" style="width:${pct}%;"></div>
            </div>
            <div style="font-size:11px; color:#9ca3af; margin-top:4px;">${done} of ${total} milestones complete</div>
        </div>`;
    }).join('');
}

async function selectProject(id) {
    selectedProjectId = id;
    // Mark card as selected
    document.querySelectorAll('.project-card').forEach(c => c.classList.remove('selected'));
    const card = document.getElementById(`card-${id}`);
    if (card) card.classList.add('selected');

    const panel = document.getElementById('detail-panel');
    panel.innerHTML = `<div class="empty-panel"><i class="fa-solid fa-spinner fa-spin" style="color:#7c3aed;"></i><p>Loading project details...</p></div>`;

    // Smoothly scroll to the milestones/details panel on mobile/tablet viewports
    if (window.innerWidth <= 992) {
        panel.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    try {
        const res = await apiClient.get(`/vetter/projects/${id}`);
        const p   = res.data || res;
        renderDetailPanel(p);
        
        // Re-scroll in case content height changes after rendering
        if (window.innerWidth <= 992) {
            panel.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    } catch (err) {
        panel.innerHTML = `<div class="empty-panel" style="color:#ef4444;"><i class="fa-solid fa-triangle-exclamation"></i><p>Failed to load project.</p></div>`;
    }
}

function renderDetailPanel(p) {
    const panel = document.getElementById('detail-panel');
    const milestones = p.milestones || [];
    const done  = milestones.filter(m => m.status === 'completed').length;
    const total = milestones.length;
    const allDone = done === total && total > 0;
    const sym   = currencies[p.budget_currency] || '$';

    const msHTML = milestones.map(m => {
        const isDone = m.status === 'completed';
        return `<div class="milestone-item" id="ms-item-${m.id}">
            <div class="ms-icon ${isDone ? 'done' : 'pending'}">
                <i class="fa-solid ${isDone ? 'fa-check' : 'fa-clock'}"></i>
            </div>
            <div>
                <div class="ms-name">${m.title}</div>
                <div class="ms-status">${isDone ? 'Completed' : 'Pending'}</div>
            </div>
            <div class="ms-toggle">
                <button class="toggle-btn ${isDone ? 'undo' : 'complete'}"
                    onclick="toggleMilestone(${m.id}, '${isDone ? 'pending' : 'completed'}', ${p.id})">
                    ${isDone ? 'Undo' : 'Mark Complete'}
                </button>
            </div>
        </div>`;
    }).join('');

    // Build files section (load async after panel renders)
    panel.innerHTML = `
        <div class="detail-header">
            <h3>${p.title}</h3>
            <p>${p.category || 'General'} · Submitted by ${p.user ? p.user.name : 'Unknown'}</p>
        </div>

        ${allDone ? `<div class="all-done-banner"><i class="fa-solid fa-check-circle"></i> All milestones complete! This project is ready for final approval.</div>` : ''}

        <div class="detail-info">
            <div class="info-row"><span>Budget</span><span>${sym}${parseFloat(p.budget_amount || 0).toLocaleString()}</span></div>
            <div class="info-row"><span>Submitted</span><span>${p.submitted_at ? new Date(p.submitted_at).toLocaleDateString() : '—'}</span></div>
            <div class="info-row"><span>Accepted by Admin</span><span>${p.reviewed_at ? new Date(p.reviewed_at).toLocaleDateString() : '—'}</span></div>
            <div class="info-row"><span>Progress</span><span>${done}/${total} milestones</span></div>
        </div>

        <div style="padding: 0 24px 8px; font-size: 13px; font-weight: 600; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em;">Milestones</div>
        <div id="milestones-container">${milestones.length ? msHTML : '<div style="padding:20px; text-align:center; color:#9ca3af;">No milestones found.</div>'}</div>

        <!-- Files section injected by loadProjectFiles() -->
        <div id="files-section">
            <div class="file-section">
                <div class="file-section-title"><i class="fa-solid fa-spinner fa-spin" style="margin-right:6px;"></i>Loading files...</div>
            </div>
        </div>

        ${p.description ? `
        <div style="padding: 16px 24px; border-top: 1px solid #f3f4f6;">
            <div style="font-size: 12px; font-weight: 600; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 8px;">Project Description</div>
            <div style="font-size: 13px; color: #374151; line-height: 1.6;">${p.description}</div>
        </div>` : ''}

        <div style="padding: 16px 24px; border-top: 1px solid #f3f4f6; background: #fff8f8;">
            <div style="font-size: 12px; font-weight: 700; color: #dc2626; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 8px;">
                <i class="fa-solid fa-circle-exclamation"></i> Reviewer Actions (Remediation / Rejection)
            </div>
            <p style="font-size: 12px; color: #4b5563; margin: 0 0 12px;">Request corrections from the creator, or reject this project proposal entirely.</p>
            <textarea id="update-remarks" placeholder="Enter instructions for updates or reasons for rejection..." style="width: 100%; min-height: 80px; padding: 10px; border: 1px solid #e5e7eb; border-radius: 8px; font-family: inherit; font-size: 13px; resize: vertical; outline: none; transition: border-color 0.2s; box-sizing: border-box;"></textarea>
            <div style="display: flex; gap: 10px; margin-top: 10px;">
                <button class="toggle-btn" style="background: #f59e0b; color: white; flex: 1; display: flex; align-items: center; justify-content: center; gap: 8px;" onclick="requestProjectUpdate(${p.id})">
                    <i class="fa-regular fa-paper-plane"></i> Request Update
                </button>
                <button class="toggle-btn" style="background: #dc2626; color: white; flex: 1; display: flex; align-items: center; justify-content: center; gap: 8px;" onclick="rejectProject(${p.id})">
                    <i class="fa-solid fa-ban"></i> Reject Project
                </button>
            </div>
        </div>
    `;

    // Load files asynchronously
    loadProjectFiles(p.id);
}

async function toggleMilestone(milestoneId, newStatus, projectId) {
    const btn = document.querySelector(`#ms-item-${milestoneId} .toggle-btn`);
    if (btn) { btn.disabled = true; btn.textContent = '...'; }
    try {
        await apiClient.post(`/vetter/milestones/${milestoneId}/complete`, { status: newStatus });
        await selectProject(projectId);
        await loadProjects();
    } catch (err) {
        alert('Failed to update milestone: ' + err.message);
        if (btn) { btn.disabled = false; btn.textContent = newStatus === 'completed' ? 'Mark Complete' : 'Undo'; }
    }
}

async function loadProjectFiles(projectId) {
    const section = document.getElementById('files-section');
    if (!section) return;
    try {
        const res  = await apiClient.get(`/projects/${projectId}/all-documents`);
        const data = res.data || res;
        const docs  = data.documents    || [];
        const deliv = data.deliverables || [];

        let html = '';

        // Proposal documents
        html += `<div class="file-section">
            <div class="file-section-title"><i class="fa-solid fa-file-alt" style="margin-right:6px; color:#7c3aed;"></i>Proposal Documents (${docs.length})</div>`;
        if (docs.length === 0) {
            html += `<div class="file-empty">No proposal documents uploaded.</div>`;
        } else {
            docs.forEach(d => { html += buildFileItem(d); });
        }
        html += `</div>`;

        // Deliverables
        html += `<div class="file-section">
            <div class="file-section-title"><i class="fa-solid fa-paper-plane" style="margin-right:6px; color:#059669;"></i>Submitted Deliverables (${deliv.length})</div>`;
        if (deliv.length === 0) {
            html += `<div class="file-empty">No deliverables submitted yet.</div>`;
        } else {
            deliv.forEach(d => { html += buildFileItem(d); });
        }
        html += `</div>`;

        section.innerHTML = html;
    } catch (err) {
        section.innerHTML = `<div class="file-section"><div class="file-empty" style="color:#ef4444;">Could not load files.</div></div>`;
    }
}

function buildFileItem(f) {
    const ext  = (f.name || '').split('.').pop().toLowerCase();
    const icon = ext === 'pdf' ? 'pdf' : ['doc','docx'].includes(ext) ? 'doc' : ['jpg','png','jpeg','gif'].includes(ext) ? 'img' : 'other';
    const iconMap = { pdf: 'fa-file-pdf', doc: 'fa-file-word', img: 'fa-file-image', other: 'fa-file' };
    const size = f.size ? (f.size > 1048576 ? (f.size/1048576).toFixed(1)+' MB' : (f.size/1024).toFixed(0)+' KB') : '';
    const dlBtn = f.download_url
        ? `<a class="file-dl-btn" href="${f.download_url}" target="_blank" onclick="injectTokenToLink(event, '${f.download_url}')"><i class="fa-solid fa-download"></i> Open</a>`
        : `<span class="file-dl-btn" style="background:#f3f4f6; color:#9ca3af; cursor:not-allowed;">No file</span>`;
    const badge = f.status ? `<span style="font-size:10px; background:#f3f4f6; color:#6b7280; padding:2px 6px; border-radius:99px; margin-left:6px;">${f.status}</span>` : '';
    return `<div class="file-item">
        <div class="file-icon ${icon}"><i class="fa-solid ${iconMap[icon]}"></i></div>
        <div style="flex:1; min-width:0;">
            <div class="file-name">${f.name || f.title || 'Unnamed'}${badge}</div>
            <div class="file-size">${size}</div>
        </div>
        ${dlBtn}
    </div>`;
}

async function requestProjectUpdate(projectId) {
    const remarks = document.getElementById('update-remarks').value.trim();
    if (!remarks) {
        alert('Please enter remarks explaining what needs to be updated.');
        return;
    }
    
    if (!confirm('Are you sure you want to request an update for this project? This will return it to the creator.')) {
        return;
    }

    const btn = document.querySelector('[onclick="requestProjectUpdate(' + projectId + ')"]');
    if (btn) {
        btn.disabled = true;
        btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Sending...';
    }

    try {
        await apiClient.post(`/vetter/projects/${projectId}/require-update`, { remarks: remarks });
        alert('Update request sent successfully. The project has been returned to the creator.');
        selectedProjectId = null;
        document.getElementById('detail-panel').innerHTML = `
            <div class="empty-panel">
                <i class="fa-solid fa-arrow-left" style="color: #c4b5fd;"></i>
                <p>Select a project from the list to begin reviewing milestones</p>
            </div>
        `;
        await loadProjects();
    } catch (err) {
        alert('Failed to request update: ' + err.message);
        if (btn) {
            btn.disabled = false;
            btn.innerHTML = '<i class="fa-regular fa-paper-plane"></i> Request Update';
        }
    }
}

async function rejectProject(projectId) {
    const remarks = document.getElementById('update-remarks').value.trim();
    if (!remarks) {
        alert('Please enter remarks explaining the reason for rejection.');
        return;
    }
    
    if (!confirm('Are you sure you want to permanently reject this project? This action is irreversible.')) {
        return;
    }

    const btn = document.querySelector('[onclick="rejectProject(' + projectId + ')"]');
    if (btn) {
        btn.disabled = true;
        btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Rejecting...';
    }

    try {
        await apiClient.post(`/vetter/projects/${projectId}/reject`, { remarks: remarks });
        alert('Project has been successfully rejected.');
        selectedProjectId = null;
        document.getElementById('detail-panel').innerHTML = `
            <div class="empty-panel">
                <i class="fa-solid fa-arrow-left" style="color: #c4b5fd;"></i>
                <p>Select a project from the list to begin reviewing milestones</p>
            </div>
        `;
        await loadProjects();
    } catch (err) {
        alert('Failed to reject project: ' + err.message);
        if (btn) {
            btn.disabled = false;
            btn.innerHTML = '<i class="fa-solid fa-ban"></i> Reject Project';
        }
    }
}

// Opens file in new tab by fetching with token
function injectTokenToLink(e, url) {
    e.preventDefault();
    const token = localStorage.getItem('pfunds_token') || localStorage.getItem('auth_token');
    fetch(url, { headers: { 'Authorization': 'Bearer ' + token, 'Accept': '*/*' } })
        .then(r => r.blob())
        .then(blob => {
            const bUrl = URL.createObjectURL(blob);
            window.open(bUrl, '_blank');
        })
        .catch(() => alert('Could not open file.'));
}
</script>
</body>
</html>
