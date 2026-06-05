<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/jpeg" href="{{ asset('assets/images/project logo.jpeg') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>P-FUNDS || Create New Password</title>
    <!-- Font Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- FontAwesome Library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Main Project Styles -->
    <link rel="stylesheet" href="{{ asset('dist/styles/index.css') }}">
</head>
<body>
    <div class="page-container">
        <!-- Main Logo Header Area -->
        <header class="main-header signup-header" style="margin-bottom: 20px;">
            <img src="{{ asset('assets/images/project logo.jpeg') }}" alt="P-FUNDS Logo" style="width: 60px; height: 60px; border-radius: 50px; margin-bottom: 10px;">
        </header>

        <!-- Main Form Card matching exact specs -->
        <main class="login-card reset-card">
            <!-- Top Soft-Grey Icon Indicator -->
            <div class="reset-icon-box">
                <i class="fa-solid fa-lock"></i>
            </div>
            
            <!-- Header Identity -->
            <div class="reset-header">
                <h2>Create New Password</h2>
                <p>Enter a new strong access password<br>for your institutional account.</p>
            </div>
            
            <!-- Form Structure -->
            <div class="card-body" style="width: 100%;">
                <form action="#" method="POST" class="reset-form">
                    
                    <div class="form-group reset-form-group">
                        <label>New Access Password</label>
                        <div class="password-wrapper">
                            <input type="password" id="password" placeholder="Min. 12 characters">
                            <i class="fa-regular fa-eye toggle-password"></i>
                        </div>
                        <div class="password-strength">
                            <div class="strength-bars">
                                <div class="bar inactive"></div>
                                <div class="bar inactive"></div>
                                <div class="bar inactive"></div>
                                <div class="bar inactive"></div>
                            </div>
                            <span class="strength-text"></span>
                        </div>
                    </div>

                    <div class="form-group reset-form-group" style="margin-top: 15px;">
                        <label>Confirm Access Password</label>
                        <input type="password" id="password_confirmation" placeholder="Must match exactly">
                        <span id="password-match-error" style="color: #e74c3c; font-size: 12px; display: none; margin-top: 5px;"><i class="fa-solid fa-circle-exclamation"></i> Passwords do not match</span>
                    </div>

                    <!-- Submission Flow Button -->
                    <button type="button" class="submit-btn" style="margin-top: 25px;">
                        Update Password <i class="fa-solid fa-check" style="margin-left: 5px;"></i>
                    </button>
                    
                    <!-- Secondary Navigation -->
                    <a href="{{ route('login') }}" class="back-link">
                        <i class="fa-solid fa-chevron-left"></i> Cancel
                    </a>
                </form>
            </div>
            
            <hr class="reset-divider">
            
            <!-- Footer Verification Badges -->
            <div class="security-badges">
                <div class="badge">
                    <i class="fa-solid fa-shield-halved"></i> SECURE UPDATE
                </div>
                <div class="badge">
                    <i class="fa-solid fa-shield"></i> AES-256 ENCRYPTED
                </div>
            </div>
        </main>
    </div>

    <script>
        // --- UI Interactions ---
        // 1. Toggle Password Visibility
        const togglePassword = document.querySelector('.toggle-password');
        const passwordInput = document.getElementById('password');

        togglePassword.addEventListener('click', function () {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });

        // 2. Password Strength Meter
        const strengthBars = document.querySelectorAll('.strength-bars .bar');
        const strengthText = document.querySelector('.strength-text');

        passwordInput.addEventListener('input', function() {
            const val = passwordInput.value;
            let strength = 0;
            
            if (val.length > 0) strength += 1;
            if (val.length >= 8) strength += 1;
            if (/[A-Z]/.test(val) && /[0-9]/.test(val)) strength += 1;
            if (/[^A-Za-z0-9]/.test(val) && val.length >= 10) strength += 1;

            strengthBars.forEach((bar, index) => {
                if (index < strength) {
                    bar.classList.add('active');
                    bar.classList.remove('inactive');
                } else {
                    bar.classList.remove('active');
                    bar.classList.add('inactive');
                }
            });

            if (strength === 0) strengthText.textContent = '';
            else if (strength === 1) { strengthText.textContent = 'Weak'; strengthText.style.color = '#e74c3c'; }
            else if (strength === 2) { strengthText.textContent = 'Fair'; strengthText.style.color = '#f1c40f'; }
            else if (strength === 3) { strengthText.textContent = 'Good'; strengthText.style.color = '#3498db'; }
            else if (strength === 4) { strengthText.textContent = 'Institutional Grade Strength'; strengthText.style.color = '#2ecc71'; }
        });

        // 3. Confirm Password Validation
        const confirmPasswordInput = document.getElementById('password_confirmation');
        const matchError = document.getElementById('password-match-error');

        function validatePasswordMatch() {
            if (confirmPasswordInput.value === '') {
                matchError.style.display = 'none';
                confirmPasswordInput.style.borderColor = '';
            } else if (passwordInput.value !== confirmPasswordInput.value) {
                matchError.style.display = 'block';
                confirmPasswordInput.style.borderColor = '#e74c3c';
            } else {
                matchError.style.display = 'none';
                confirmPasswordInput.style.borderColor = '#2ecc71';
            }
        }

        passwordInput.addEventListener('input', validatePasswordMatch);
        confirmPasswordInput.addEventListener('input', validatePasswordMatch);

        // --- Submission Logic ---
        document.querySelector('.submit-btn').addEventListener('click', async function (e) {
            e.preventDefault();

            const password = passwordInput.value;
            const password_confirmation = confirmPasswordInput.value;
            const submitBtn = this;

            // Get token and email from URL parameters
            const urlParams = new URLSearchParams(window.location.search);
            const token = urlParams.get('token');
            const email = urlParams.get('email');

            if (!token || !email) {
                alert('Invalid password reset link. Please request a new one.');
                return;
            }

            if (!password || !password_confirmation) {
                alert('Please fill out both password fields.');
                return;
            }

            if (password !== password_confirmation) {
                alert('Passwords do not match.');
                return;
            }

            // Show loading state
            submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Updating...';
            submitBtn.disabled = true;

            try {
                const response = await fetch('http://127.0.0.1:8000/api/v1/auth/reset-password', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({ 
                        email, 
                        token, 
                        password, 
                        password_confirmation 
                    }),
                });

                const data = await response.json();

                if (response.ok && data.success) {
                    alert('Password has been successfully updated!');
                    window.location.href = "{{ route('logout') }}";
                } else {
                    alert(data.message || 'Failed to reset password. The link might be expired.');
                    submitBtn.innerHTML = 'Update Password <i class="fa-solid fa-check" style="margin-left: 5px;"></i>';
                    submitBtn.disabled = false;
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Could not connect to the server. Make sure Laravel is running.');
                submitBtn.innerHTML = 'Update Password <i class="fa-solid fa-check" style="margin-left: 5px;"></i>';
                submitBtn.disabled = false;
            }
        });
    </script>
</body>
</html>
