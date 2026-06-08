// sponsor.js - Logic for the SRS-aligned Sponsor Dashboard

const API_BASE_URL = 'http://127.0.0.1:8000/api/v1'; 
let authToken = localStorage.getItem('pfunds_token') || localStorage.getItem('auth_token'); 

document.addEventListener('DOMContentLoaded', () => {
    fetchDashboardData();
});

function showSection(sectionId) {
    document.getElementById('section-dashboard').style.display = 'none';
    document.getElementById('section-new-projects').style.display = 'none';
    document.getElementById('section-project-review').style.display = 'none';
    document.getElementById('section-profile').style.display = 'none';
    
    document.getElementById(`section-${sectionId}`).style.display = 'block';

    document.querySelectorAll('.sidebar-nav a').forEach(a => a.classList.remove('active'));
    event.currentTarget.classList.add('active');

    if(sectionId === 'project-review') {
        fetchReviewedProjects();
    }
}

function logout() {
    if(confirm("Are you sure you want to log out?")) {
        localStorage.removeItem('pfunds_token');
        window.location.href = '../../../auth/login.html';
    }
}

async function fetchDashboardData() {
    try {
        // Fetch stats
        const statsRes = await fetch(`${API_BASE_URL}/sponsor/dashboard/stats`, {
            headers: { 'Authorization': `Bearer ${authToken}`, 'Accept': 'application/json' }
        });
        if (statsRes.ok) {
            const stats = await statsRes.json();
            document.getElementById('stat-new-projects').innerText = stats.new_projects;
            document.getElementById('stat-saved-projects').innerText = stats.saved_projects;
            document.getElementById('stat-interested-projects').innerText = stats.interested_projects;
        }

        // Fetch projects
        const response = await fetch(`${API_BASE_URL}/sponsor/projects`, {
            headers: { 'Authorization': `Bearer ${authToken}`, 'Accept': 'application/json' }
        });

        if (!response.ok) throw new Error('Failed to fetch projects');
        const data = await response.json();

        renderRecentProjects(data.projects);
        renderNewProjects(data.projects);
    } catch (error) {
        console.error(error);
        const errorMsg = '<tr><td colspan="5" style="text-align: center; color: #ef4444;">Failed to load data. Ensure the API is running.</td></tr>';
        document.querySelector('#recent-projects-table tbody').innerHTML = errorMsg;
        document.querySelector('#new-projects-table tbody').innerHTML = errorMsg;
    }
}

async function fetchReviewedProjects() {
    const tbody = document.querySelector('#reviewed-projects-table tbody');
    tbody.innerHTML = '<tr><td colspan="4" style="text-align: center; color: #94a3b8;"><i class="fa-solid fa-spinner fa-spin"></i> Loading...</td></tr>';

    try {
        const response = await fetch(`${API_BASE_URL}/sponsor/projects/reviewed`, {
            headers: { 'Authorization': `Bearer ${authToken}`, 'Accept': 'application/json' }
        });

        if (!response.ok) throw new Error('Failed to fetch reviewed projects');
        const data = await response.json();
        
        tbody.innerHTML = '';
        if (data.projects.length === 0) {
            tbody.innerHTML = '<tr><td colspan="4" style="text-align: center; color: #94a3b8;">No projects reviewed yet.</td></tr>';
            return;
        }

        data.projects.forEach(project => {
            const creatorName = project.creator ? project.creator.name : 'Unknown';
            const interactionType = project.interaction_type ? `<span style="font-size:0.8rem; color:var(--primary);">(${project.interaction_type})</span>` : '';
            
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td style="color: #cbd5e1;"><i class="fa-solid fa-user-circle"></i> ${creatorName}</td>
                <td style="font-weight: 600;">${project.title} ${interactionType}</td>
                <td style="color: #cbd5e1;">${project.description.length > 50 ? project.description.substring(0, 50) + '...' : project.description}</td>
                <td>
                    <button class="action-btn" onclick="viewDetails(${project.id})"><i class="fa-solid fa-eye"></i> View More</button>
                </td>
            `;
            tbody.appendChild(tr);
        });

    } catch (error) {
        console.error(error);
        tbody.innerHTML = '<tr><td colspan="4" style="text-align: center; color: #ef4444;">Error loading reviewed projects.</td></tr>';
    }
}

async function interactWithProject(projectId, type) {
    try {
        const response = await fetch(`${API_BASE_URL}/sponsor/projects/${projectId}/interact`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${authToken}`,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ type: type })
        });

        if (!response.ok) throw new Error('Interaction failed');
        
        const data = await response.json();
        alert(`Successfully marked as ${type}!`);
        
        // Refresh dashboard stats after interaction
        fetchDashboardData();
    } catch (error) {
        console.error(error);
        alert('An error occurred. Make sure you are logged in and the API is running.');
    }
}

function viewDetails(projectId) {
    alert('Viewing details and attachments for project ID: ' + projectId);
    // Track 'viewed' interaction
    interactWithProject(projectId, 'viewed');
}

function renderRecentProjects(projects) {
    const tbody = document.querySelector('#recent-projects-table tbody');
    tbody.innerHTML = '';

    if (projects.length === 0) {
        tbody.innerHTML = '<tr><td colspan="5" style="text-align: center; color: #94a3b8;">No recent projects available.</td></tr>';
        return;
    }

    projects.slice(0, 5).forEach(project => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td style="font-weight: 600;">${project.title}</td>
            <td style="color: #cbd5e1;">${project.description.length > 50 ? project.description.substring(0, 50) + '...' : project.description}</td>
            <td style="color: #94a3b8;">${new Date(project.created_at).toLocaleDateString()}</td>
            <td>
                <button class="action-btn" onclick="viewDetails(${project.id})"><i class="fa-solid fa-eye"></i> See More</button>
            </td>
            <td>
                <button class="action-btn btn-like" onclick="interactWithProject(${project.id}, 'like')" title="Like"><i class="fa-solid fa-thumbs-up"></i></button>
                <button class="action-btn btn-dislike" onclick="interactWithProject(${project.id}, 'dislike')" title="Dislike"><i class="fa-solid fa-thumbs-down"></i></button>
            </td>
        `;
        tbody.appendChild(tr);
    });
}

function renderNewProjects(projects) {
    const tbody = document.querySelector('#new-projects-table tbody');
    tbody.innerHTML = '';

    if (projects.length === 0) {
        tbody.innerHTML = '<tr><td colspan="5" style="text-align: center; color: #94a3b8;">No new projects available.</td></tr>';
        return;
    }

    projects.forEach(project => {
        const creatorName = project.creator ? project.creator.name : 'Unknown';
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td style="color: #cbd5e1;"><i class="fa-solid fa-user-circle"></i> ${creatorName}</td>
            <td style="font-weight: 600;">${project.title}</td>
            <td style="color: #cbd5e1;">${project.description.length > 50 ? project.description.substring(0, 50) + '...' : project.description}</td>
            <td style="font-weight: bold; color: #10b981;">${Number(project.budget_amount).toLocaleString()} CFA</td>
            <td style="display: flex; gap: 0.5rem;">
                <button class="action-btn" onclick="viewDetails(${project.id})" title="View More"><i class="fa-solid fa-eye"></i></button>
                <button class="action-btn btn-like" onclick="interactWithProject(${project.id}, 'like')" title="Interested"><i class="fa-solid fa-heart"></i></button>
                <button class="action-btn btn-dislike" onclick="interactWithProject(${project.id}, 'dislike')" title="Not Interested"><i class="fa-solid fa-xmark"></i></button>
                <button class="action-btn" style="color: #f59e0b;" onclick="interactWithProject(${project.id}, 'save')" title="Save"><i class="fa-solid fa-bookmark"></i></button>
            </td>
        `;
        tbody.appendChild(tr);
    });
}
