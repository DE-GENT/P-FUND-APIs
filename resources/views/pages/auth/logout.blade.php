<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logging Out | P-FUNDS</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            color: #374151;
        }
        .logout-container {
            text-align: center;
            background: white;
            padding: 2.5rem;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            max-width: 400px;
            width: 100%;
        }
        .spinner {
            border: 4px solid rgba(0, 0, 0, 0.1);
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border-left-color: #0d8abc;
            animation: spin 1s linear infinite;
            margin: 0 auto 1.5rem;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        h2 {
            margin: 0 0 0.5rem 0;
            font-size: 1.25rem;
            font-weight: 600;
        }
        p {
            margin: 0;
            color: #6b7280;
            font-size: 0.875rem;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            // Find any valid Sanctum token in local storage across all portal prefixes
            const prefixes = ['admin_', 'sponsor_', 'vetter_', 'user_', ''];
            let token = null;
            for (const pref of prefixes) {
                const t = localStorage.getItem(pref + 'pfunds_token') || localStorage.getItem(pref + 'auth_token');
                if (t) {
                    token = t;
                    break;
                }
            }

            if (token) {
                // Trigger background API call to invalidate token on the server
                try {
                    await fetch('/api/v1/auth/logout', {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'Authorization': `Bearer ${token}`
                        }
                    });
                } catch (e) {
                    console.error("Failed to invalidate token on server:", e);
                }
            }

            // Clear all user credentials stored locally
            localStorage.clear();
            sessionStorage.clear();
            
            // Redirect to login page
            setTimeout(() => {
                window.location.href = "{{ route('login') }}";
            }, 800); // Slight delay for visual smoothness
        });
    </script>
</head>
<body>
    <div class="logout-container">
        <div class="spinner"></div>
        <h2>Logging Out Securely</h2>
        <p>Clearing your secure credentials, please wait...</p>
    </div>
</body>
</html>
