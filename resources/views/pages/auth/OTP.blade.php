<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/jpeg" href="{{ asset('assets/images/project logo.jpeg') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>P-FUNDS || OTP Verification</title>
    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Project Main Stylesheet -->
    <link rel="stylesheet" href="{{ asset('dist/styles/index.css') }}">
</head>
<body class="otp-body">
    <!-- Main page wrapper leveraging the layout structured for OTP strictly -->
    <div class="otp-page-container">
        
        <!-- Header with logo -->
        <header class="main-header signup-header">
            <img src="{{ asset('assets/images/project logo.jpeg') }}" alt="P-FUNDS Logo">
            <p>ESTABLISHING INSTITUTIONAL TRUST</p>
        </header>

        <!-- Container for 2 elements side by side -->
        <main class="signup-content-wrapper">
            
            <!-- Left Sidebar: Verification Status Tracker -->
            <aside class="status-panel">
                <h3 class="panel-title">Verification Status</h3>
                
                <div class="timeline">
                    <!-- Step 1: Now Completed (Grayed out) -->
                    <div class="timeline-step inactive completed-step">
                        <div class="step-indicator">1</div>
                        <div class="step-content">
                            <h4>Identity Profile</h4>
                            <p>Submit your personal credentials for initial vetting.</p>
                        </div>
                    </div>
                    
                    <!-- Step 2: Now Active -->
                    <div class="timeline-step active">
                        <div class="step-indicator">2</div>
                        <div class="step-content">
                            <h4>Email OTP</h4>
                            <p>Requires institutional domain verification.</p>
                        </div>
                    </div>
                </div>
            </aside>

            <!-- Right Area: OTP Verification Panel -->
            <section class="otp-card">
                <!-- Heading Block & Information Context -->
                <div class="otp-header">
                    <h2>Verify Your Identity</h2>
                    <p class="otp-info">
                        A secure 6-digit verification code has been dispatched<br>
                        to your institutional email: <strong id="user-email-display">loading...</strong>
                    </p>
                    
                </div>
                
                <!-- Interaction Form -->
                <form action="#" method="POST" class="enrollment-form otp-form">
                    
                    <!-- 6 Digit Input Fields for OTP Code -->
                    <div class="otp-inputs-wrapper">
                        <input type="text" class="otp-input" maxlength="1" pattern="[0-9]" inputmode="numeric" placeholder="0" autocomplete="off">
                        <input type="text" class="otp-input" maxlength="1" pattern="[0-9]" inputmode="numeric" placeholder="0" autocomplete="off">
                        <input type="text" class="otp-input" maxlength="1" pattern="[0-9]" inputmode="numeric" placeholder="0" autocomplete="off">
                        <input type="text" class="otp-input" maxlength="1" pattern="[0-9]" inputmode="numeric" placeholder="0" autocomplete="off">
                        <input type="text" class="otp-input" maxlength="1" pattern="[0-9]" inputmode="numeric" placeholder="0" autocomplete="off">
                        <input type="text" class="otp-input" maxlength="1" pattern="[0-9]" inputmode="numeric" placeholder="0" autocomplete="off">
                    </div>
                    
                    <!-- Submit Interaction -->
                    <button type="button" class="submit-btn otp-btn">
                        <i class="fa-solid fa-circle-check"></i> Verify & Proceed
                    </button>
                    
                    <!-- Form Footer: Time trackers -->
                    <div class="otp-action-footer">
                        <p class="resend-cta">Didn't receive the code? <a href="#">Resend Code</a></p>
                        <p class="timer-display">AVAILABLE IN <strong class="timer-countdown">00:59</strong></p>
                    </div>
                </form>
            </section>
        </main>
    </div>

    <!-- Interactive JavaScript code allowing inputs to natively jump to the next input cell -->
   
    <!-- Interactive JavaScript code -->
    <script>
        const otpInputs = document.querySelectorAll('.otp-input');
        const submitBtn = document.querySelector('.submit-btn');
        const resendBtn = document.querySelector('.resend-cta a');
        
        // --- UI Updates: Dynamic Email & Timer ---
        const userEmailDisplay = document.getElementById('user-email-display');
        const savedEmail = localStorage.getItem('user_email');
        if (savedEmail) {
            userEmailDisplay.textContent = savedEmail;
        }

        const timerDisplay = document.querySelector('.timer-countdown');
        let countdownTime = 59;
        let timerInterval;

        function startTimer() {
            clearInterval(timerInterval);
            countdownTime = 59;
            resendBtn.style.pointerEvents = 'none';
            resendBtn.style.opacity = '0.5';
            
            timerInterval = setInterval(() => {
                countdownTime--;
                let seconds = countdownTime < 10 ? `0${countdownTime}` : countdownTime;
                timerDisplay.textContent = `00:${seconds}`;
                
                if (countdownTime <= 0) {
                    clearInterval(timerInterval);
                    timerDisplay.textContent = '00:00';
                    resendBtn.style.pointerEvents = 'auto';
                    resendBtn.style.opacity = '1';
                }
            }, 1000);
        }
        
        startTimer(); // Start the timer when the page loads

        // --- 1. Auto-focusing & Pasting Logic ---
        // Handle Paste Event
        otpInputs[0].addEventListener('paste', (e) => {
            e.preventDefault();
            const pastedData = (e.clipboardData || window.clipboardData).getData('text').replace(/\D/g, '').slice(0, 6);
            if (pastedData) {
                pastedData.split('').forEach((char, i) => {
                    if (i < otpInputs.length) {
                        otpInputs[i].value = char;
                    }
                });
                const focusIndex = Math.min(pastedData.length, otpInputs.length - 1);
                otpInputs[focusIndex].focus();
            }
        });

        otpInputs.forEach((input, index) => {
            input.addEventListener('input', (e) => {
                if (e.target.value.length === 1 && index < otpInputs.length - 1) {
                    otpInputs[index + 1].focus();
                }
            });
            
            input.addEventListener('keydown', (e) => {
                if (e.key === 'Backspace' && !e.target.value && index > 0) {
                    otpInputs[index - 1].focus();
                }
            });
        });
    
        // --- 2. VERIFY OTP INTEGRATION ---
        submitBtn.addEventListener('click', async (e) => {
            e.preventDefault();
            
            // Collect the 6 digits into one string
            let otpCode = '';
            otpInputs.forEach(input => {
                otpCode += input.value;
            });
    
            // Ensure they entered all 6 digits
            if (otpCode.length < 6) {
                alert('Please enter the complete 6-digit code.');
                return;
            }
    
            // Get the token saved from the Signup/Login step
            const token = localStorage.getItem('auth_token');
            if (!token) {
                alert('Authentication missing. Please log in again.');
                window.location.href = "{{ route('logout') }}"; // Redirect if no token
                return;
            }
    
            // Disable button to prevent double-clicking
            submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Verifying...';
            submitBtn.disabled = true;
    
            try {
                // Call our Laravel API
                const response = await fetch(`${window.location.origin}/api/v1/auth/verify-email`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'Authorization': `Bearer ${token}` // Send the token
                    },
                    body: JSON.stringify({ code: otpCode })
                });
    
                const data = await response.json();
    
                if (response.ok && data.success) {
                    // Success! Save token and user details to localStorage
                    const currentToken = localStorage.getItem('auth_token') || localStorage.getItem('pfunds_token');
                    if (currentToken) {
                        localStorage.setItem('auth_token', currentToken);
                        localStorage.setItem('pfunds_token', currentToken);
                    }
                    if (data.data && data.data.user) {
                        const userStr = JSON.stringify(data.data.user);
                        localStorage.setItem('user', userStr);
                        localStorage.setItem('pfunds_user', userStr);
                    }
                    alert('Email verified successfully!');
                    const userRole = (data.data && data.data.user && data.data.user.role || '').toLowerCase();
                    if (userRole === 'admin') {
                        window.location.href = "{{ route('admin.dashboard') }}";
                    } else if (userRole.startsWith('vetter')) {
                        window.location.href = "{{ route('vetter.dashboard') }}";
                    } else if (userRole === 'sponsor') {
                        window.location.href = "{{ route('sponsor.dashboard') }}";
                    } else {
                        window.location.href = "{{ route('user.dashboard') }}";
                    }
                } else {
                    // Show error from backend (e.g., "Invalid code" or "Expired")
                    alert(data.message || 'Verification failed. Please try again.');
                    submitBtn.innerHTML = '<i class="fa-solid fa-circle-check"></i> Verify & Proceed';
                    submitBtn.disabled = false;
                }
            } catch (error) {
                console.error('Error:', error);
                alert('A network error occurred. Please try again.');
                submitBtn.innerHTML = '<i class="fa-solid fa-circle-check"></i> Verify & Proceed';
                submitBtn.disabled = false;
            }
        });
    
        // --- 3. RESEND CODE INTEGRATION ---
        resendBtn.addEventListener('click', async (e) => {
            e.preventDefault();
            
            const token = localStorage.getItem('auth_token');
            if (!token) return;
    
            try {
                const response = await fetch(`${window.location.origin}/api/v1/auth/resend-verification-code`, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': `Bearer ${token}`
                    }
                });
    
                const data = await response.json();
    
                if (response.ok && data.success) {
                    alert('A new verification code has been sent to your email.');
                    // Clear the inputs
                    otpInputs.forEach(input => input.value = '');
                    otpInputs[0].focus();
                    startTimer(); // Restart the timer
                } else {
                    alert(data.message || 'Failed to resend code.');
                }
            } catch (error) {
                console.error('Error:', error);
            }
        });
    </script>
    
</body>
</html>
vvcvvdoafxpkmhqb