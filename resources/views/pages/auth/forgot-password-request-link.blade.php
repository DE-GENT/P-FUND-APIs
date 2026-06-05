<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/jpeg" href="{{ asset('assets/images/project logo.jpeg') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>P-FUNDS || Reset Access</title>
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
            <!-- Utilized user's preferred logo dynamically overriding the layout -->
            <img src="{{ asset('assets/images/project logo.jpeg') }}" alt="P-FUNDS Logo" style="width: 60px; height: 60px; border-radius: 50px; margin-bottom: 10px;">
        </header>

        <!-- Main Form Card matching exact specs -->
        <main class="login-card reset-card">
            
            <!-- Top Soft-Grey Icon Indicator -->
            <div class="reset-icon-box">
                <i class="fa-solid fa-clock-rotate-left"></i>
            </div>
            
            <!-- Header Identity -->
            <div class="reset-header">
                <h2>Reset Access</h2>
                <p>Enter your institutional credentials to<br>receive a secure restoration link.</p>
            </div>
            
            <!-- Form Structure -->
            <div class="card-body" style="width: 100%;">
                <form action="#" method="POST" class="reset-form">
                    
                    <!-- Institutional Email Section -->
                    <div class="form-group reset-form-group">
                        <label>Institutional Email</label>
                        <!-- Leveraging pre-built input wrapper with absolute icon -->
                        <div class="input-wrapper">
                           
                            <input type="email" id="email" placeholder="name@organization.com">
                        </div>
                    </div>

                    <!-- Submission Flow Button -->
                    <button type="button" class="submit-btn">
                        Send Reset Link <i class="fa-solid fa-arrow-right" style="margin-left: 5px;"></i>
                    </button>
                    
                    <!-- Secondary Navigation -->
                    <a href="{{ route('login') }}" class="back-link">
                        <i class="fa-solid fa-chevron-left"></i> Back to Login
                    </a>
                    
                </form>
            </div>
            
            <!-- Structural Divider -->
            <hr class="reset-divider">
            
            <!-- Footer Verification Badges -->
            <div class="security-badges">
                <div class="badge">
                    <i class="fa-solid fa-shield-halved"></i> SECURE REQUEST
                </div>
                <div class="badge">
                    <i class="fa-solid fa-shield"></i> AES-256 ENCRYPTED
                </div>
            </div>
            
        </main>
    </div>
    <script>
        document.querySelector('.submit-btn').addEventListener('click', async function (e) {
            e.preventDefault();

            const email = document.getElementById('email').value;
            const submitBtn = this;

            if (!email) {
                alert('Please enter your email address.');
                return;
            }

            // Show loading state
            submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Sending...';
            submitBtn.disabled = true;

            try {
                const response = await fetch('http://127.0.0.1:8000/api/v1/auth/forgot-password', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({ email }),
                });

                const data = await response.json();

                if (response.ok && data.success) {
                    // Redirect to the success screen
                    window.location.href = "{{ route('password.sent') }}";
                } else {
                    // Show error from backend
                    alert(data.message || 'Failed to send reset link. Please check the email and try again.');
                    submitBtn.innerHTML = 'Send Reset Link <i class="fa-solid fa-arrow-right" style="margin-left: 5px;"></i>';
                    submitBtn.disabled = false;
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Could not connect to the server. Make sure Laravel is running.');
                submitBtn.innerHTML = 'Send Reset Link <i class="fa-solid fa-arrow-right" style="margin-left: 5px;"></i>';
                submitBtn.disabled = false;
            }
        });
    </script>
</body>
</html>
