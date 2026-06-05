<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" type="image/jpeg" href="{{ asset('assets/images/project logo.jpeg') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>P-FUNDS || login page</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('dist/styles/index.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
    <div class="page-container">
        <!-- Header -->
        <header class="main-header">
            <img src="{{ asset('assets/images/project logo.jpeg') }}" alt="">
            <p>ESTABLISHING INSTITUTIONAL TRUST</p>
        </header>

        <!-- Main Card -->
        <main class="login-card">
            <div class="card-header">
                <h2>Access Your Account</h2>
            </div>

            <div class="card-body">
                <div class="input-group">
                    <label class="section-label">INSTITUTIONAL PORTAL</label>
                    <div class="tabs secondary-tabs">
                        <button class="tab active">General</button>
                        <button class="tab">Admin</button>
                        <button class="tab">Vetter</button>
                        <button class="tab">Sponsor</button>
                    </div>
                </div>


                <div class="input-wrapper">
                    <span class="icon">
                        <i class="fa-solid fa-envelope"></i>
                    </span>
                    <input type="email" id="email" placeholder="name@institution.com">
                </div>

                <div class="password-header">
                    <label>Security Password</label>
                    <a href="{{ route('password.request') }}" class="forgot-password">Forgot Password?</a>
                </div>

                <div class="input-wrapper">
                    <span class="icon">
                        <i class="fa-solid fa-key"></i>
                    </span>
                    <input type="password" id="password" placeholder="••••••••••••">
                </div>

                <div class="remember-me">
                    <label class="checkbox-container">
                        <input type="checkbox">
                        <span class="checkmark"></span>
                        Remember this device for 30 days
                    </label>
                </div>

                <button class="submit-btn" type="button">
                    Sign In
                    <i class="fa-solid fa-arrow-right-to-bracket"></i>
                </button>
            </div>


        </main>

        <div class="registration-link">
            Don't have an account? <a href="{{ route('signup') }}">Start Registration</a>
        </div>
    </div>

    <script>
        // Handle Institutional Portal tabs click events
        const portalTabs = document.querySelectorAll('.secondary-tabs .tab');
        let selectedPortal = 'general'; // Default

        portalTabs.forEach(tab => {
            tab.addEventListener('click', () => {
                // Remove active class from all tabs
                portalTabs.forEach(t => t.classList.remove('active'));
                // Add active class to the clicked tab
                tab.classList.add('active');
                // Store the selected role
                selectedPortal = tab.textContent.trim().toLowerCase();
            });
        });

        // Auto-detect role from email to switch tabs automatically
        const emailInput = document.getElementById('email');

        async function handleEmailRoleAutoDetect() {
            const email = emailInput.value.trim();
            if (!email || !email.includes('@')) return;

            try {
                const response = await fetch('http://127.0.0.1:8000/api/v1/auth/check-email', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({ email }),
                });
                const data = await response.json();
                if (data.success && data.data && data.data.role) {
                    const detectedRole = data.data.role;
                    portalTabs.forEach(tab => {
                        const tabRole = tab.textContent.trim().toLowerCase();
                        if (tabRole === detectedRole) {
                            portalTabs.forEach(t => t.classList.remove('active'));
                            tab.classList.add('active');
                            selectedPortal = detectedRole;
                        }
                    });
                }
            } catch (e) {
                console.error("Error auto-detecting role:", e);
            }
        }

        let detectTimeout = null;
        emailInput.addEventListener('input', () => {
            clearTimeout(detectTimeout);
            detectTimeout = setTimeout(handleEmailRoleAutoDetect, 500);
        });
        emailInput.addEventListener('blur', handleEmailRoleAutoDetect);
        emailInput.addEventListener('change', handleEmailRoleAutoDetect);

        // Handle Login Submission
        document.querySelector('.submit-btn').addEventListener('click', async function (e) {
            e.preventDefault();

            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const submitBtn = this;

            if (!email || !password) {
                alert('Please enter both email and password.');
                return;
            }

            // Show loading state
            submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Authenticating...';
            submitBtn.disabled = true;

            try {
                const response = await fetch('http://127.0.0.1:8000/api/v1/auth/login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({ 
                        email, 
                        password, 
                        role: selectedPortal // Send the selected tab to the backend
                    }),
                });

                const data = await response.json();

                if (response.ok && data.success) {
                    // Save auth token and user details to localStorage
                    localStorage.setItem('pfunds_token', data.data.token);
                    localStorage.setItem('pfunds_user', JSON.stringify(data.data.user));
                    localStorage.setItem('auth_token', data.data.token);
                    localStorage.setItem('user', JSON.stringify(data.data.user));

                    // Direct them based on email verification status
                    if (!data.data.email_verified) {
                        alert('Your email is not verified yet. Redirecting to OTP verification page...');
                        window.location.href = "{{ route('otp') }}";
                    } else {
                        alert(`Login successful! Redirecting to ${selectedPortal.toUpperCase()} portal...`);

                        // Use the role from the server response (source of truth)
                        const userRole = (data.data.user.role || selectedPortal).toLowerCase();

                        // Route to different dashboards based on role
                        if (userRole === 'admin') {
                            window.location.href = "{{ route('admin.dashboard') }}";
                        } else if (userRole.startsWith('vetter')) {
                            window.location.href = "{{ route('vetter.dashboard') }}";
                        } else if (userRole === 'sponsor') {
                            window.location.href = "{{ route('sponsor.dashboard') }}";
                        } else {
                            window.location.href = "{{ route('user.dashboard') }}";
                        }
                    }
                } else {
                    // Show error from backend (e.g., Access Denied for wrong role)
                    alert(data.message || 'Login failed. Please check your credentials.');
                    // Reset button
                    submitBtn.innerHTML = 'Sign In <i class="fa-solid fa-arrow-right-to-bracket"></i>';
                    submitBtn.disabled = false;
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Could not connect to the server. Make sure Laravel is running.');
                // Reset button
                submitBtn.innerHTML = 'Sign In <i class="fa-solid fa-arrow-right-to-bracket"></i>';
                submitBtn.disabled = false;
            }
        });
    </script>
</body>

</html>