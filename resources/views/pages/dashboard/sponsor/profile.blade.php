<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/jpeg" href="{{ asset('assets/images/project logo.jpeg') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sponsor Profile | P-FUNDS</title>
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
            <a href="{{ route('sponsor.new-projects') }}" class="nav-item"><i class="fa-solid fa-bolt"></i> New Projects</a>
            <a href="{{ route('sponsor.project-review') }}" class="nav-item"><i class="fa-solid fa-clock-rotate-left"></i> Project Review</a>
            <a href="{{ route('sponsor.profile') }}" class="nav-item active"><i class="fa-regular fa-circle-user"></i> Profile</a>
        </nav>
        <div class="sidebar-footer">
            <a href="{{ route('logout') }}" class="nav-item" id="logout-btn"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <div class="header-top">
            <h1>Profile Management</h1>
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

        <!-- Profile Management Card -->
        <div class="table-container pf-dedup-27b378">
            <h2>Personal Information</h2>
            <div class="pf-dedup-eaa61e">
                <!-- Avatar Upload Column -->
                <div class="pf-dedup-4bedc6">
                    <div class="pf-dedup-668691">
                        <img class="pf-dedup-621f54" id="profile-avatar-display" src="https://ui-avatars.com/api/?name=Sponsor&background=3b82f6&color=fff&rounded=true" alt="Avatar">
                    </div>
                    <input class="pf-dedup-cb4589" type="file" id="avatarFile" accept="image/png, image/jpeg, image/jpg, image/webp" onchange="handleAvatarUpload()">
                    <button class="action-btn btn-outline pf-dedup-f34dc7" onclick="document.getElementById('avatarFile').click()"><i class="fa-solid fa-upload"></i> Upload Photo</button>
                    <span class="pf-dedup-73699c">PNG, JPEG, WEBP up to 2MB</span>
                </div>

                <!-- Profile Details Form -->
                <div class="pf-dedup-4589d7">
                    <form id="profileForm">
                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" id="profileName" class="form-control" placeholder="Full name">
                        </div>
                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="email" id="profileEmail" class="form-control" disabled placeholder="Email address">
                        </div>
                        <div class="form-group pf-dedup-362910">
                            <div>
                                <label>Phone Number</label>
                                <input type="text" id="profilePhone" class="form-control" placeholder="Phone number">
                            </div>
                            <div>
                                <label>Nationality</label>
                                <input type="text" id="profileNationality" class="form-control" placeholder="Nationality">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Field of Specialty / Funding Focus</label>
                            <input type="text" id="profileSpecialty" class="form-control" placeholder="e.g. Biomedical Research, Artificial Intelligence">
                        </div>
                        <div class="form-group">
                            <label>Office Address</label>
                            <input type="text" id="profileAddress" class="form-control" placeholder="Address">
                        </div>
                        <div class="pf-dedup-8508bf">
                            <button type="submit" class="action-btn"><i class="fa-solid fa-save"></i> Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Security / Password Card -->
        <div class="table-container pf-dedup-219f04">
            <h2>Security Settings</h2>
            <form id="passwordForm">
                <div class="form-group">
                    <label>Current Password</label>
                    <input type="password" id="currentPassword" class="form-control" required placeholder="Enter current password">
                </div>
                <div class="form-group pf-dedup-49cc92">
                    <div>
                        <label>New Password</label>
                        <input type="password" id="newPassword" class="form-control" required placeholder="New password">
                    </div>
                    <div>
                        <label>Confirm New Password</label>
                        <input type="password" id="confirmPassword" class="form-control" required placeholder="Confirm new password">
                    </div>
                </div>
                <div class="pf-dedup-589c83">
                    <button type="submit" class="action-btn pf-dedup-f64a1d"><i class="fa-solid fa-shield-halved"></i> Update Password</button>
                </div>
            </form>
        </div>
    </main>

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

            // Load user data
            await fetchUserProfile();

            // Setup forms
            document.getElementById('profileForm').addEventListener('submit', handleProfileUpdate);
            document.getElementById('passwordForm').addEventListener('submit', handlePasswordUpdate);

            // Setup logout button
        });

        async function fetchUserProfile() {
            try {
                const response = await apiClient.get('/me');
                const user = response.data || response;

                // Sync elements
                document.getElementById('userName').textContent = `Hello, ${user.name}`;
                document.getElementById('profileName').value = user.name || '';
                document.getElementById('profileEmail').value = user.email || '';
                document.getElementById('profilePhone').value = user.phone || '';
                document.getElementById('profileNationality').value = user.nationality || '';
                document.getElementById('profileSpecialty').value = user.field_of_specialty || '';
                document.getElementById('profileAddress').value = user.address || '';

                const avatarUrl = user.avatar_url || `https://ui-avatars.com/api/?name=${encodeURIComponent(user.name)}&background=3b82f6&color=fff&rounded=true`;
                document.getElementById('userAvatar').src = avatarUrl;
                document.getElementById('profile-avatar-display').src = avatarUrl;

                // Update localStorage cache
                localStorage.setItem('pfunds_user', JSON.stringify(user));
            } catch (error) {
                console.error("Failed to fetch profile details:", error);
            }
        }

        async function handleProfileUpdate(e) {
            e.preventDefault();
            const name = document.getElementById('profileName').value;
            const phone = document.getElementById('profilePhone').value;
            const nationality = document.getElementById('profileNationality').value;
            const specialty = document.getElementById('profileSpecialty').value;
            const address = document.getElementById('profileAddress').value;

            try {
                await apiClient.put('/me', {
                    name: name,
                    phone: phone,
                    nationality: nationality,
                    field_of_specialty: specialty,
                    address: address
                });
                alert("Profile details updated successfully!");
                await fetchUserProfile(); // Refresh view
            } catch (error) {
                console.error("Profile update failed:", error);
                alert("Failed to update profile details. Verify fields and connection.");
            }
        }

        async function handlePasswordUpdate(e) {
            e.preventDefault();
            const currentPassword = document.getElementById('currentPassword').value;
            const newPassword = document.getElementById('newPassword').value;
            const confirmPassword = document.getElementById('confirmPassword').value;

            if (newPassword !== confirmPassword) {
                alert("New passwords do not match!");
                return;
            }

            try {
                await apiClient.put('/me/password', {
                    current_password: currentPassword,
                    password: newPassword,
                    password_confirmation: confirmPassword
                });
                alert("Password changed successfully! Other sessions have been signed out.");
                document.getElementById('passwordForm').reset();
            } catch (error) {
                console.error("Password change failed:", error);
                alert(error.message || "Failed to change password. Make sure current password is correct.");
            }
        }

        async function handleAvatarUpload() {
            const fileInput = document.getElementById('avatarFile');
            if (fileInput.files.length === 0) return;

            const token = localStorage.getItem('pfunds_token');
            const formData = new FormData();
            formData.append('avatar', fileInput.files[0]);

            try {
                const response = await fetch(`${window.location.origin}/api/v1/me/avatar`, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': `Bearer ${token}`
                    },
                    body: formData
                });

                const data = await response.json();
                if (!response.ok) {
                    throw new Error(data.message || 'Avatar upload failed.');
                }

                alert("Profile photo updated successfully!");
                await fetchUserProfile(); // Refresh view
            } catch (error) {
                console.error("Avatar upload failed:", error);
                alert(error.message || "Failed to upload photo. Ensure it's under 2MB and formatted as image.");
            }
        }
    </script>
</body>
</html>
