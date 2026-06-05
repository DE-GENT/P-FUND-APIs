<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/jpeg" href="{{ asset('assets/images/project logo.jpeg') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>P-FUNDS || Email Sent Registration</title>
    <!-- Inter Typeface Import -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- FontAwesome Vector Graphics -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Cascading Style Core -->
    <link rel="stylesheet" href="{{ asset('dist/styles/index.css') }}">
</head>
<body>
    <div class="page-container">
        
        <!-- Extruded Main Header Logic -->
        <header class="main-header" style="margin-bottom: 40px;">
            <img src="{{ asset('assets/images/project logo.jpeg') }}" alt="P-FUNDS Logo" style="width: 60px; height: 60px; border-radius: 50px;">
        </header>
        
        <!-- Institutional Split View Auth Component -->
        <main class="split-auth-card">
            
            <!-- Dark Cyber Security Canvas -->
            <div class="split-card-left">
                <div class="split-brand-info">
                    <h2>P-FUNDS</h2>
                    <p>Institutional grade security infrastructure for the<br>modern financial sovereign.</p>
                </div>
            </div>
            
            <!-- Bright White Direct Action Box -->
            <div class="split-card-right">
                
                <!-- Envelope Confirmation Visual -->
                <div class="success-icon-box">
                    <i class="fa-solid fa-envelope-circle-check"></i>
                </div>
                
                <!-- Command Center Header -->
                <div class="split-header">
                    <h2>Check Your Email</h2>
                    <p>A password reset link has been sent to your<br>institutional email. Please follow the instructions to<br>secure your access.</p>
                </div>
                
                <!-- Main Authentication Return Gateway -->
                <!-- Utilized submit-btn logic directly embedded into a hyperlinked button -->
                <a href="{{ route('login') }}" class="submit-btn split-action-btn">
                    Return to Login
                </a>
                
                <!-- Recovery Pathway & Microcopy -->
                <div class="split-footer-actions">
                    <p class="secondary-info">HAVEN'T RECEIVED IT?</p>
                    <a href="#" class="resend-link">
                        <i class="fa-solid fa-rotate-right"></i> Resend Link
                    </a>
                </div>
                
                <!-- Aesthetic Hardcoded Authentication Standard -->
                <div class="split-auth-badge">
                    <i class="fa-solid fa-shield-circle-check" style="color: #0c886e;"></i> VERIFIED INSTITUTIONAL ACCESS
                </div>
                
            </div>
            
        </main>
        
    </div>
</body>
</html>
