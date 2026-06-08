// Global Chat Logic for P-FUNDS Platform

let chatFetchInterval = null;
let lastKnownMessageCount = parseInt(localStorage.getItem('pfunds_chat_last_count') || '0');

function ensureChatPanelExists() {
    let panel = document.getElementById('global-chat-panel');
    if (!panel) {
        panel = document.createElement('div');
        panel.id = 'global-chat-panel';
        panel.className = 'global-chat-panel';
        panel.innerHTML = `
            <div class="chat-header">
                <div style="display: flex; align-items: center; gap: 8px;">
                    <i class="fa-solid fa-earth-americas"></i>
                    <h3 style="margin: 0; font-size: 14px;">Global Platform Chat</h3>
                </div>
                <button class="icon-btn" onclick="toggleGlobalChat()" style="color: white; background: none; border: none; cursor: pointer;">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="chat-messages" id="global-chat-messages">
                <div style="text-align: center; color: #94a3b8; font-size: 12px; margin-top: auto; margin-bottom: auto;">
                    Welcome to the Global Chat.<br>All roles can interact here.
                </div>
            </div>
            <div class="chat-input-area">
                <input type="text" id="global-chat-input" placeholder="Type a message...">
                <button onclick="sendGlobalMessage()">
                    <i class="fa-solid fa-paper-plane"></i>
                </button>
            </div>
        `;
        document.body.appendChild(panel);
    }
}

function toggleGlobalChat() {
    ensureChatPanelExists();
    const panel = document.getElementById('global-chat-panel');
    panel.classList.toggle('active');

    if (panel.classList.contains('active')) {
        fetchGlobalMessages();
        // Poll for new messages every 5 seconds while open
        chatFetchInterval = setInterval(fetchGlobalMessages, 5000);

        // Hide notification dot when opening chat
        hideNotificationDot();
    } else {
        if (chatFetchInterval) {
            clearInterval(chatFetchInterval);
        }
    }
}

async function fetchGlobalMessages(isBackgroundCheck = false) {
    try {
        const response = await apiClient.get('/chat');
        const messages = Array.isArray(response) ? response : (response.data || []);

        // Handle unread notifications if background check
        if (isBackgroundCheck) {
            const currentCount = messages.length;
            if (currentCount > lastKnownMessageCount) {
                showNotificationDot(currentCount - lastKnownMessageCount);
            } else {
                hideNotificationDot();
            }
            return;
        }

        // If panel is open, render messages
        const messagesContainer = document.getElementById('global-chat-messages');
        messagesContainer.innerHTML = '';

        const intro = document.createElement('div');
        intro.style = 'text-align: center; color: #94a3b8; font-size: 12px; margin-top: auto; margin-bottom: auto;';
        intro.innerHTML = 'Welcome to the Global Chat.<br>All roles can interact here.';
        messagesContainer.appendChild(intro);

        const userStr = localStorage.getItem('pfunds_user') || localStorage.getItem('user');
        const currentUser = userStr ? JSON.parse(userStr) : null;

        messages.forEach(msg => {
            const senderName = msg.user ? msg.user.name : 'Unknown User';
            const senderId = msg.user ? msg.user.id : null;
            const senderRole = msg.user ? msg.user.role : null;
            const friendlyRole = msg.user ? msg.user.friendly_role : null;
            const isMe = currentUser && (
                (currentUser.id && senderId && Number(senderId) === Number(currentUser.id)) ||
                (currentUser.email && msg.user && msg.user.email === currentUser.email)
            );

            // Check for private message
            const recipientName = msg.recipient ? msg.recipient.name : null;

            appendMessage(senderName, msg.message, isMe ? 'sent' : 'received', senderRole, friendlyRole, senderId, recipientName);
        });

        messagesContainer.scrollTop = messagesContainer.scrollHeight;

        // Update read count
        lastKnownMessageCount = messages.length;
        localStorage.setItem('pfunds_chat_last_count', lastKnownMessageCount);
        hideNotificationDot();

    } catch (err) {
        console.error('Failed to load chat messages', err);
    }
}

let activeRecipientId = null;
let activeRecipientName = null;

function setReplyRecipient(id, name) {
    activeRecipientId = id;
    activeRecipientName = name;

    let bar = document.getElementById('chat-reply-bar');
    if (!bar) {
        const inputEl = document.getElementById('global-chat-input');
        if (inputEl) {
            const inputContainer = inputEl.parentElement;
            bar = document.createElement('div');
            bar.id = 'chat-reply-bar';
            bar.style.display = 'flex';
            bar.style.padding = '6px 15px';
            bar.style.background = '#f1f5f9';
            bar.style.borderTop = '1px solid #e2e8f0';
            bar.style.fontSize = '11px';
            bar.style.color = '#475569';
            bar.style.alignItems = 'center';
            bar.style.justifyContent = 'space-between';
            bar.innerHTML = `
                <span>Replying directly to <strong id="chat-reply-name"></strong></span>
                <button onclick="clearReplyRecipient()" style="background: none; border: none; cursor: pointer; color: #ef4444; padding: 2px 5px;"><i class="fa-solid fa-xmark"></i></button>
            `;
            inputContainer.parentNode.insertBefore(bar, inputContainer);
        }
    }

    if (bar) {
        document.getElementById('chat-reply-name').textContent = name;
        bar.style.display = 'flex';
    }

    const inputEl = document.getElementById('global-chat-input');
    if (inputEl) {
        inputEl.focus();
    }
}

function clearReplyRecipient() {
    activeRecipientId = null;
    activeRecipientName = null;
    const bar = document.getElementById('chat-reply-bar');
    if (bar) {
        bar.style.display = 'none';
    }
}

async function sendGlobalMessage() {
    const inputEl = document.getElementById('global-chat-input');
    const text = inputEl.value.trim();
    if (!text) return;

    inputEl.value = '';

    const payload = { message: text };
    if (activeRecipientId) {
        payload.recipient_id = activeRecipientId;
    }

    try {
        await apiClient.post('/chat', payload);
        clearReplyRecipient();
        fetchGlobalMessages(); // Refresh chat immediately
    } catch (err) {
        alert('Failed to send message: ' + err.message);
    }
}

function appendMessage(senderName, text, type, senderRole = null, friendlyRole = null, senderId = null, recipientName = null) {
    const container = document.getElementById('global-chat-messages');
    const wrapper = document.createElement('div');
    wrapper.style.display = 'flex';
    wrapper.style.flexDirection = 'column';
    wrapper.style.marginBottom = '8px';

    if (type === 'received') {
        wrapper.style.alignItems = 'flex-start';

        const headerEl = document.createElement('div');
        headerEl.style.display = 'flex';
        headerEl.style.alignItems = 'center';
        headerEl.style.gap = '6px';
        headerEl.style.marginBottom = '4px';
        headerEl.style.marginLeft = '2px';

        const nameEl = document.createElement('span');
        nameEl.className = 'chat-sender-name';
        nameEl.style.fontWeight = '600';
        nameEl.style.fontSize = '12px';
        nameEl.style.color = '#334155';
        nameEl.textContent = senderName;
        headerEl.appendChild(nameEl);

        if (senderRole) {
            const badgeEl = document.createElement('span');
            badgeEl.style.fontSize = '9px';
            badgeEl.style.padding = '2px 6px';
            badgeEl.style.borderRadius = '12px';
            badgeEl.style.fontWeight = 'bold';
            badgeEl.style.color = '#ffffff';
            badgeEl.style.textTransform = 'uppercase';
            badgeEl.style.letterSpacing = '0.5px';
            badgeEl.style.display = 'inline-flex';
            badgeEl.style.alignItems = 'center';

            const roleLower = senderRole.toLowerCase();
            if (roleLower === 'admin') {
                badgeEl.style.backgroundColor = '#10b981'; // Green
                badgeEl.textContent = 'Admin';
            } else if (roleLower === 'sponsor') {
                badgeEl.style.backgroundColor = '#3b82f6'; // Blue
                badgeEl.textContent = 'Sponsor';
            } else if (roleLower.startsWith('vetter')) {
                badgeEl.style.backgroundColor = '#8b5cf6'; // Purple
                if (roleLower === 'vetter_1') badgeEl.textContent = 'Vetter L1';
                else if (roleLower === 'vetter_2') badgeEl.textContent = 'Vetter L2';
                else if (roleLower === 'vetter_3') badgeEl.textContent = 'Vetter L3';
                else badgeEl.textContent = 'Vetter';
            } else if (roleLower === 'creator') {
                badgeEl.style.backgroundColor = '#64748b'; // Slate
                badgeEl.textContent = 'Creator';
            } else {
                badgeEl.style.backgroundColor = '#94a3b8';
                badgeEl.textContent = senderRole;
            }
            headerEl.appendChild(badgeEl);
        }

        if (recipientName) {
            const privBadge = document.createElement('span');
            privBadge.style.fontSize = '9px';
            privBadge.style.padding = '2px 6px';
            privBadge.style.borderRadius = '12px';
            privBadge.style.fontWeight = 'bold';
            privBadge.style.color = '#b91c1c';
            privBadge.style.backgroundColor = '#fee2e2';
            privBadge.style.textTransform = 'uppercase';
            privBadge.style.letterSpacing = '0.5px';
            privBadge.textContent = 'special';
            headerEl.appendChild(privBadge);
        }

        if (senderId) {
            const replyBtn = document.createElement('button');
            replyBtn.style.background = 'none';
            replyBtn.style.border = 'none';
            replyBtn.style.cursor = 'pointer';
            replyBtn.style.color = '#94a3b8';
            replyBtn.style.padding = '0 4px';
            replyBtn.style.display = 'inline-flex';
            replyBtn.style.alignItems = 'center';
            replyBtn.title = 'Reply directly';
            replyBtn.innerHTML = '<i class="fa-solid fa-reply" style="font-size: 10px;"></i>';
            replyBtn.onmouseover = () => replyBtn.style.color = '#3b82f6';
            replyBtn.onmouseout = () => replyBtn.style.color = '#94a3b8';

            const escapedName = senderName.replace(/'/g, "\\'");
            replyBtn.onclick = () => setReplyRecipient(senderId, escapedName);
            headerEl.appendChild(replyBtn);
        }

        wrapper.appendChild(headerEl);
    } else {
        wrapper.style.alignItems = 'flex-end';
        if (recipientName) {
            const infoEl = document.createElement('span');
            infoEl.style.fontSize = '9px';
            infoEl.style.color = '#94a3b8';
            infoEl.style.marginBottom = '2px';
            infoEl.style.marginRight = '2px';
            infoEl.textContent = `Direct to ${recipientName}`;
            wrapper.appendChild(infoEl);
        }
    }

    const msgEl = document.createElement('div');
    msgEl.className = `chat-message ${type}`;
    msgEl.textContent = text;
    wrapper.appendChild(msgEl);

    container.appendChild(wrapper);
}

function showNotificationDot(unreadCount) {
    const dots = document.querySelectorAll('.notification-dot');
    dots.forEach(dot => {
        dot.textContent = unreadCount > 9 ? '9+' : unreadCount;
        dot.style.display = 'flex';
    });
}

function hideNotificationDot() {
    const dots = document.querySelectorAll('.notification-dot');
    dots.forEach(dot => {
        dot.style.display = 'none';
    });
}

// Check for unread messages on page load and bind enter key
document.addEventListener('DOMContentLoaded', () => {
    ensureChatPanelExists();
    // Initial background check
    fetchGlobalMessages(true);

    // Poll every 15 seconds in the background for notifications
    setInterval(() => fetchGlobalMessages(true), 15000);

    const inputEl = document.getElementById('global-chat-input');
    if (inputEl) {
        inputEl.addEventListener('keypress', function (e) {
            if (e.key === 'Enter') sendGlobalMessage();
        });
    }
});
