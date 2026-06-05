// ====================================================
// P-FUNDS Notifications Engine
// Handles real-time bell notifications for all users
// ====================================================

let _notifPollInterval = null;

async function loadNotifications() {
    try {
        const res = await apiClient.get('/notifications');
        const { notifications, unread_count } = res;

        // Update bell badge
        updateBellBadge(unread_count);

        // Populate dropdown panel (id="notif-dropdown" or "notif-dropdown-user")
        const panel = document.getElementById('notif-dropdown') || document.getElementById('notif-dropdown-user');
        if (!panel) return;

        const body = panel.querySelector('[data-notif-list]') || panel.querySelector('div:last-child');
        if (!body) return;

        if (notifications.length === 0) {
            body.innerHTML = `<div style="padding: 20px; text-align: center; color: #94a3b8; font-size: 13px;">
                <i class="fa-regular fa-bell-slash" style="font-size:24px; margin-bottom:8px; display:block;"></i>
                No new notifications
            </div>`;
            return;
        }

        body.innerHTML = notifications.map(n => {
            const isUnread = !n.read_at;
            const time = timeSince(new Date(n.created_at));
            return `
                <div onclick="markNotifRead(${n.id}, this)" style="
                    padding: 14px 16px;
                    border-bottom: 1px solid #f1f5f9;
                    cursor: pointer;
                    background: ${isUnread ? '#f0fdf4' : '#fff'};
                    transition: background 0.2s;
                " onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='${isUnread ? '#f0fdf4' : '#fff'}'">
                    <div style="font-weight: ${isUnread ? '600' : '400'}; font-size: 13px; color: #0f172a; margin-bottom: 4px;">
                        ${n.title}
                    </div>
                    <div style="font-size: 12px; color: #64748b; line-height: 1.5;">${n.body}</div>
                    <div style="font-size: 11px; color: #94a3b8; margin-top: 5px;">${time}</div>
                </div>`;
        }).join('');

    } catch (err) {
        console.error('Failed to load notifications', err);
    }
}

async function markNotifRead(id, el) {
    try {
        await apiClient.post(`/notifications/${id}/read`);
        el.style.background = '#fff';
        el.querySelector('div:first-child').style.fontWeight = '400';
        await loadNotifications(); // refresh badge
    } catch (e) {
        console.error('Failed to mark notification read', e);
    }
}

async function markAllNotifsRead() {
    try {
        await apiClient.post('/notifications/mark-all-read');
        await loadNotifications();
    } catch (e) {
        console.error('Failed to mark all read', e);
    }
}

function updateBellBadge(count) {
    // Bell badges in header
    const badges = document.querySelectorAll('.bell-badge, #bell-badge');
    badges.forEach(b => {
        if (count > 0) {
            b.textContent = count > 9 ? '9+' : count;
            b.style.display = 'flex';
        } else {
            b.style.display = 'none';
        }
    });

    // Also update the topbar icon-btn bell icon with a red dot if needed
    const bellBtns = document.querySelectorAll('.icon-btn .fa-bell, .icon-btn .fa-regular.fa-bell');
    bellBtns.forEach(icon => {
        const btn = icon.closest('button');
        if (!btn) return;
        let dot = btn.querySelector('.bell-live-dot');
        if (count > 0 && !dot) {
            dot = document.createElement('span');
            dot.className = 'bell-live-dot';
            dot.style.cssText = `
                position: absolute; top: 6px; right: 6px;
                width: 8px; height: 8px;
                background: #ef4444; border-radius: 50%;
                border: 2px solid #fff;
            `;
            btn.style.position = 'relative';
            btn.appendChild(dot);
        } else if (count === 0 && dot) {
            dot.remove();
        }
    });
}

function timeSince(date) {
    const seconds = Math.floor((new Date() - date) / 1000);
    if (seconds < 60) return 'Just now';
    const mins = Math.floor(seconds / 60);
    if (mins < 60) return `${mins}m ago`;
    const hrs = Math.floor(mins / 60);
    if (hrs < 24) return `${hrs}h ago`;
    return `${Math.floor(hrs / 24)}d ago`;
}

function buildNotifDropdown(panelId) {
    const panel = document.getElementById(panelId);
    if (!panel) return;

    // Rebuild panel structure to include "Mark all read" header action
    panel.innerHTML = `
        <div style="padding: 12px 16px; border-bottom: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: space-between;">
            <span style="font-weight: 600; color: #0f172a; font-size: 14px;">Notifications</span>
            <button onclick="markAllNotifsRead()" style="font-size: 12px; color: #064e3b; background: none; border: none; cursor: pointer; font-weight: 500;">Mark all read</button>
        </div>
        <div data-notif-list style="max-height: 350px; overflow-y: auto;">
            <div style="padding: 20px; text-align: center; color: #94a3b8; font-size: 13px;">Loading...</div>
        </div>
    `;
}

// Start polling on page load
document.addEventListener('DOMContentLoaded', () => {
    // Build dropdown structure
    buildNotifDropdown('notif-dropdown');
    buildNotifDropdown('notif-dropdown-user');

    // Initial load
    loadNotifications();

    // Poll every 20 seconds
    _notifPollInterval = setInterval(loadNotifications, 20000);

    // Close dropdown when clicking outside
    document.addEventListener('click', (e) => {
        ['notif-dropdown', 'notif-dropdown-user'].forEach(id => {
            const panel = document.getElementById(id);
            if (panel && panel.classList.contains('show')) {
                const wrapper = panel.closest('[style*="position: relative"]') || panel.parentElement;
                if (!wrapper.contains(e.target)) {
                    panel.classList.remove('show');
                }
            }
        });
    });
});
