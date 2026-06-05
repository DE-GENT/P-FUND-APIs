<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" type="image/jpeg" href="{{ asset('assets/images/project logo.jpeg') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>P-FUNDS || landing page</title>
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('dist/styles/index.css') }}">
</head>

<body>
    <!-- header section-->
    <div class="container">
        <div class="logo">
            <img src="{{ asset('assets/images/project logo.jpeg') }}" alt="">

        </div>
        <div class="nav-link">
            <ul>
                <li>
                    <a href="">HOME</a>
                </li>
                <li>
                    <a href="">PARTNERS</a>
                </li>
                <li>
                    <a href="">OFFERS</a>
                </li>
                <li>
                    <a href="">SOLUTIONS</a>
                </li>
            </ul>

        </div>
        <div class="search">
            <input type="text" placeholder="Search projects...">
            <button aria-label="Search">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </div>
        <div class="btn">
            <button class="login-btn" onclick="window.location.href='{{ route('login') }}'">Login</button>
            <button class="signup-btn" onclick="window.location.href='{{ route('signup') }}'">signup</button>
        </div>
        <div class="toggle-bar">
            <i class="fa-solid fa-bars"></i>
        </div>
    </div>
    <!--end of header section-->

    <!--banner section-->
    <div class="banner">
        <div class="desc">
            <h3>Bring your project<br> for funding</h3>
            <p>make an investor fund your project, <br>
                share with us , convince us</p>
            <div class="banner-btn">
                <button class="funding-btn">i want to fund</button>
                <button class="fund-btn">i want funding</button>
            </div>
            <div class="banner-search">
                <input type="text" placeholder="Search projects...">
                <button aria-label="Search">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>
        </div>
    </div>
    <!--end of banner section-->

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const toggleBar = document.querySelector('.toggle-bar');
            const navLink = document.querySelector('.nav-link');
            if (toggleBar && navLink) {
                toggleBar.addEventListener('click', () => {
                    navLink.classList.toggle('active');
                });
            }
        });
    </script>
</body>

</html>
