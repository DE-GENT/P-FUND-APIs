<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/jpeg" href="{{ asset('assets/images/project logo.jpeg') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deliverables Review | P-FUNDS</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('dist/styles/index.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/styles/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/styles/vetter.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
</head>
<body>
<div class="dashboard-container">
    <aside class="sidebar">
        <div class="sidebar-header">
            <img class="pf-dedup-fffde0" src="{{ asset('assets/images/project logo.jpeg') }}" alt="P-FUNDS Logo">
        </div>
        <div class="sidebar-identity">
            <div class="role-name pf-dedup-4eb23a">Vetter Portal</div>
            <div class="role-subtitle pf-dedup-0c6e55">REVIEW AUTHORITY</div>
        </div>
        <nav class="sidebar-nav">
            <a href="{{ route('vetter.dashboard') }}" class="nav-item"><i class="fa-solid fa-border-all"></i> Dashboard</a>
            <a href="{{ route('vetter.queue') }}" class="nav-item"><i class="fa-solid fa-layer-group"></i> Vetting Queue</a>
            <a href="{{ route('vetter.deliverables') }}" class="nav-item active"><i class="fa-solid fa-file-circle-check"></i> Deliverables</a>
            <a href="{{ route('vetter.profile') }}" class="nav-item"><i class="fa-regular fa-circle-user"></i> Profile</a>
        </nav>
        <div class="sidebar-footer pf-dedup-56115e">
            <nav class="sidebar-nav pf-dedup-53896a">
                <a href="{{ route('logout') }}" class="nav-item" id="logout-btn"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a>
            </nav>
        </div>
    </aside>

    <main class="main-content">
        <header class="dashboard-topbar">
            <div class="brand-logo pf-dedup-e7d181">Deliverables Review</div>
            <div class="topbar-actions">
                <div class="search-container">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" id="search-input" placeholder="Search deliverables...">
                </div>
                <div class="pf-dedup-c451fd">
                    <button class="icon-btn" onclick="document.getElementById('notif-dropdown').classList.toggle('show')">
                        <i class="fa-regular fa-bell"></i>
                    </button>
                    <div class="pf-dedup-d685f1" id="notif-dropdown"></div>
                </div>
                <a href="{{ route('vetter.profile') }}" style="text-decoration: none; cursor: pointer;" class="user-profile pf-dedup-564b7d">
                    <img src="https://ui-avatars.com/api/?name=Vetter&background=7c3aed&color=fff&rounded=true" alt="Vetter" class="avatar" id="display-avatar">
                    <span class="pf-dedup-edc65a" id="header-name">Vetter</span>
                </a>
            </div>
        </header>

        <div class="page-body">
            <div class="section-card">
                <div class="section-header">
                    <span class="section-title"><i class="fa-solid fa-file-circle-check pf-dedup-ad7151"></i>Submitted Deliverables</span>
                    <div class="filter-tabs">
                        <button class="tab active" onclick="filterDeliverables('submitted', this)">Pending</button>
                        <button class="tab" onclick="filterDeliverables('under_review', this)">Under Review</button>
                        <button class="tab" onclick="filterDeliverables('accepted', this)">Accepted</button>
                        <button class="tab" onclick="filterDeliverables('rejected', this)">Rejected</button>
                    </div>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Deliverable</th>
                            <th>Project</th>
                            <th>Creator</th>
                            <th>Submitted</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="deliverables-tbody">
                        <tr><td class="pf-dedup-e7efe3" colspan="6"><i class="fa-solid fa-spinner fa-spin"></i> Loading...</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>

<!-- Review Modal -->
<div class="modal-overlay" id="review-modal">
    <div class="modal">
        <h3 id="modal-title">Review Deliverable</h3>
        <p id="modal-subtitle">Add remarks for the creator (optional)</p>
        <textarea id="modal-remarks" placeholder="Enter your review remarks here..."></textarea>
        <div class="modal-footer">
            <button class="btn-cancel" onclick="closeModal()">Cancel</button>
            <button class="btn-submit-reject" id="btn-reject-submit" onclick="submitReview('rejected')">Reject</button>
            <button class="btn-submit-accept" id="btn-accept-submit" onclick="submitReview('accepted')">Accept</button>
        </div>
    </div>
</div>

<!-- Chat -->
<button class="chat-widget" onclick="toggleGlobalChat()">
    <i class="fa-solid fa-message"></i>
    <span class="notification-dot pf-dedup-cb4589" id="chat-notif-dot"></span>
</button>
<!-- Chat Panel -->
<div class="chat-panel" id="global-chat-panel">
    <div class="chat-header pf-dedup-6f024a">
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
        <button class="pf-dedup-48783f" onclick="sendGlobalMessage()">
            <i class="fa-solid fa-paper-plane"></i>
        </button>
    </div>
</div>

<script src="{{ asset('assets/js/api.js') }}?v=1.0.4"></script>
<script src="{{ asset('assets/js/notifications.js') }}"></script>
<script src="{{ asset('assets/js/chat.js') }}?v=1.0.4"></script>
<script>
let allDeliverables = [];
let currentDeliverableId = null;
let currentDecision = null;

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

    await loadDeliverables('submitted');

    document.getElementById('search-input').addEventListener('input', e => {
        const q = e.target.value.toLowerCase();
        const filtered = allDeliverables.filter(d =>
            d.title.toLowerCase().includes(q) ||
            (d.project?.title || '').toLowerCase().includes(q)
    });
        renderTable(filtered);
    });

});

async function loadDeliverables(status) {
    const tbody = document.getElementById('deliverables-tbody');
    tbody.innerHTML = `<tr><td class="pf-dedup-e7efe3" colspan="6"><i class="fa-solid fa-spinner fa-spin"></i> Loading...</td></tr>`;
    try {
        const res = await apiClient.get(`/vetter/deliverables?status=${status}`);
        const data = res.data || res;
        allDeliverables = Array.isArray(data) ? data : (data.data || []);
        renderTable(allDeliverables);
    } catch (err) {
        tbody.innerHTML = `<tr><td class="pf-dedup-4b9fe3" colspan="6">Failed to load deliverables.</td></tr>`;
    }
}

function filterDeliverables(status, btn) {
    document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
    btn.classList.add('active');
    loadDeliverables(status);
}

function renderTable(deliverables) {
    const tbody = document.getElementById('deliverables-tbody');
    if (deliverables.length === 0) {
        tbody.innerHTML = `<tr><td class="pf-dedup-e7efe3" colspan="6"><i class="fa-solid fa-inbox pf-dedup-56d6e3"></i>No deliverables found.</td></tr>`;
        return;
    }
    const statusPill = {
        submitted:    '<span class="pill pill-submitted">Submitted</span>',
        accepted:     '<span class="pill pill-accepted">Accepted</span>',
        rejected:     '<span class="pill pill-rejected">Rejected</span>',
        under_review: '<span class="pill pill-under-review">Under Review</span>',
    };
    tbody.innerHTML = deliverables.map(d => {
        const canReview = d.status === 'submitted' || d.status === 'under_review';
        return `<tr>
            <td>
                <div class="pf-dedup-2a68b4">${d.title}</div>
                <div class="pf-dedup-b26cdf">${d.description ? d.description.substring(0,50)+'...' : ''}</div>
            </td>
            <td>${d.project?.title || '—'}</td>
            <td>${d.project?.user?.name || '—'}</td>
            <td>${new Date(d.created_at).toLocaleDateString()}</td>
            <td>${statusPill[d.status] || d.status}</td>
            <td>
                ${canReview ? `
                <div class="pf-dedup-91294d">
                    <button class="action-btn btn-accept" onclick="openModal(${d.id}, 'accepted', '${d.title.replace(/'/g,"'")}')">Accept</button>
                    <button class="action-btn btn-reject" onclick="openModal(${d.id}, 'rejected', '${d.title.replace(/'/g,"'")}')">Reject</button>
                </div>` : '<span class="pf-dedup-4b0af8">Reviewed</span>'}
            </td>
        </tr>`;
    }).join('');
}

function openModal(id, decision, title) {
    currentDeliverableId = id;
    currentDecision = decision;
    document.getElementById('modal-title').textContent = decision === 'accepted' ? '✅ Accept Deliverable' : '❌ Reject Deliverable';
    document.getElementById('modal-subtitle').textContent = `"${title}" — Add remarks for the creator (optional)`;
    document.getElementById('modal-remarks').value = '';
    document.getElementById('btn-accept-submit').style.display = decision === 'accepted' ? 'block' : 'none';
    document.getElementById('btn-reject-submit').style.display = decision === 'rejected' ? 'block' : 'none';
    document.getElementById('review-modal').classList.add('show');
}

function closeModal() {
    document.getElementById('review-modal').classList.remove('show');
    currentDeliverableId = null;
    currentDecision = null;
}

async function submitReview(decision) {
    if (!currentDeliverableId) return;
    const remarks = document.getElementById('modal-remarks').value;
    try {
        await apiClient.post(`/vetter/deliverables/${currentDeliverableId}/review`, {
            decision,
            remarks,
        });
        closeModal();
        // Reload the current tab
        const activeTab = document.querySelector('.tab.active');
        if (activeTab) activeTab.click();
        else await loadDeliverables('submitted');
    } catch (err) {
        alert('Review failed: ' + err.message);
    }
}
</script>
</body>
</html>
