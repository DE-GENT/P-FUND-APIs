<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>P-FUNDS — Project Funding Platform</title>
  <link rel="icon" type="image/jpeg" href="{{ asset('assets/images/project logo.jpeg') }}">
  <!-- Font Awesome CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,300&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="{{ asset('dist/styles/home.css') }}">
</head>
<body>

  <!-- NAV -->
  <nav>
    <div class="nav-logo">
      <img src="{{ asset('assets/images/project logo.jpeg') }}" alt="P-FUNDS Logo">
      P<span class="accent">·</span>FUNDS
    </div>
    <ul class="nav-links">
      <li><a href="#how">How It Works</a></li>
      <li><a href="{{ route('login') }}">Projects</a></li>
      <li><a href="#roles">For Sponsors</a></li>
      <li><a href="#roles">About</a></li>
    </ul>
    <div class="nav-cta">
      <a href="{{ route('login') }}" class="btn-outline">Sign in</a>
      <a href="{{ route('signup') }}" class="btn-primary">Get Started</a>
    </div>
  </nav>

  <!-- HERO -->
  <section class="hero">
    <div class="hero-text">
      <div class="hero-badge">🇨🇲 Built for Cameroon's Tech Ecosystem</div>
      <h1>Fund the ideas that will <em>shape tomorrow</em></h1>
      <p class="hero-sub">P-FUNDS connects innovative Cameroonian tech projects with the right sponsors and vetters — transparently, securely, and efficiently.</p>
      <div class="hero-actions">
        <a href="{{ route('signup') }}" class="btn-hero">Submit Your Project</a>
        <a href="#how" class="btn-ghost">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polygon points="10 8 16 12 10 16 10 8"/></svg>
          See how it works
        </a>
      </div>
      <div class="hero-stats">
        <div>
          <div class="stat-val">48<span>+</span></div>
          <div class="stat-label">Projects funded</div>
        </div>
        <div>
          <div class="stat-val">12<span>M+</span></div>
          <div class="stat-label">XAF mobilised</div>
        </div>
        <div>
          <div class="stat-val">97<span>%</span></div>
          <div class="stat-label">Vetting accuracy</div>
        </div>
      </div>
    </div>

    <div class="hero-visual">
      <div class="domain-grid">
        <!-- AgriTech Card -->
        <div class="domain-card" onclick="window.location.href='{{ route('login') }}'">
          <img src="{{ asset('assets/images/agritech.png') }}" class="domain-img" alt="Agriculture">
          <div class="domain-overlay">
            <span class="domain-badge">AgriTech</span>
            <h3 class="domain-title">Smart Agriculture</h3>
          </div>
        </div>

        <!-- EdTech Card -->
        <div class="domain-card" onclick="window.location.href='{{ route('login') }}'">
          <img src="{{ asset('assets/images/edtech.png') }}" class="domain-img" alt="Education">
          <div class="domain-overlay">
            <span class="domain-badge">EdTech</span>
            <h3 class="domain-title">Digital Learning</h3>
          </div>
        </div>

        <!-- HealthTech Card -->
        <div class="domain-card" onclick="window.location.href='{{ route('login') }}'">
          <img src="{{ asset('assets/images/healthtech.png') }}" class="domain-img" alt="Healthcare">
          <div class="domain-overlay">
            <span class="domain-badge">HealthTech</span>
            <h3 class="domain-title">Telemedicine</h3>
          </div>
        </div>

        <!-- FinTech Card -->
        <div class="domain-card" onclick="window.location.href='{{ route('login') }}'">
          <img src="{{ asset('assets/images/fintech.png') }}" class="domain-img" alt="Finance">
          <div class="domain-overlay">
            <span class="domain-badge">FinTech</span>
            <h3 class="domain-title">Mobile Money</h3>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- HOW IT WORKS -->
  <section class="section" id="how">
    <div class="section-label">Process</div>
    <div class="section-title">From idea to funded<br>in three steps</div>
    <p class="section-sub">A clear, structured pathway that protects both project founders and sponsors.</p>

    <div class="how-grid">
      <div class="how-step">
        <div class="step-num">01</div>
        <div class="step-icon">📋</div>
        <div class="step-title">Submit Your Project</div>
        <div class="step-desc">Fill out the structured submission form with your project scope, budget breakdown, team details, and expected impact. No gatekeeping — any Cameroonian tech project qualifies to apply.</div>
      </div>
      <div class="how-step">
        <div class="step-num">02</div>
        <div class="step-icon">🔍</div>
        <div class="step-title">Expert Vetting</div>
        <div class="step-desc">Assigned vetters review your submission for technical viability, financial feasibility, and social impact. You receive feedback and scores across all criteria before your project goes live.</div>
      </div>
      <div class="how-step">
        <div class="step-num">03</div>
        <div class="step-icon">🚀</div>
        <div class="step-title">Get Funded</div>
        <div class="step-desc">Approved projects are published to sponsors and donors. Track your funding progress in real-time, receive disbursements by milestone, and submit progress reports to maintain trust.</div>
      </div>
    </div>
  </section>

  <!-- ROLES -->
  <section class="roles-section" id="roles">
    <div class="section-label">Who Is This For</div>
    <div class="section-title" style="color:white;">A platform built<br>for three key players</div>
    <p class="section-sub">P-FUNDS is designed around the distinct needs of founders, experts, and investors.</p>

    <div class="roles-grid">
      <div class="role-card">
        <div class="role-avatar">👩‍💻</div>
        <div class="role-title">Project Founders</div>
        <div class="role-desc">Tech entrepreneurs and student innovators with solutions ready to be funded and scaled.</div>
        <ul class="role-features">
          <li>Submit and manage your project</li>
          <li>Receive structured vetting feedback</li>
          <li>Track funding in real time</li>
          <li>Submit milestone reports</li>
        </ul>
      </div>
      <div class="role-card">
        <div class="role-avatar">🧑‍⚖️</div>
        <div class="role-title">Vetters</div>
        <div class="role-desc">Domain experts and industry professionals who evaluate project quality and readiness.</div>
        <ul class="role-features">
          <li>Access assigned projects dashboard</li>
          <li>Score across defined criteria</li>
          <li>Submit detailed review reports</li>
          <li>Build verified expert profile</li>
        </ul>
      </div>
      <div class="role-card">
        <div class="role-avatar">💼</div>
        <div class="role-title">Sponsors</div>
        <div class="role-desc">Companies, NGOs, and individuals who want to invest in Africa's next generation of tech.</div>
        <ul class="role-features">
          <li>Browse vetted project catalogue</li>
          <li>Fund fully or co-fund projects</li>
          <li>Monitor impact and reports</li>
          <li>Get recognition on platform</li>
        </ul>
      </div>
    </div>
  </section>

  <!-- CTA -->
  <section class="cta-section">
    <div class="section-label">Get Started</div>
    <div class="section-title">Ready to bring your project to life?</div>
    <p class="section-sub">Join the growing community of Cameroonian innovators building the future with P-FUNDS.</p>
    <div class="cta-actions">
      <a href="{{ route('signup') }}" class="btn-lg green">Submit a Project</a>
      <a href="{{ route('signup') }}" class="btn-lg outline">Become a Sponsor</a>
    </div>
  </section>

  <!-- FOOTER -->
  <footer>
    <div>
      <div class="footer-logo">
        <img src="{{ asset('assets/images/project logo.jpeg') }}" alt="P-FUNDS Logo">
        P<span>·</span>FUNDS
      </div>
      <div class="footer-tagline">Powering Cameroon's tech ecosystem · By iClan</div>
    </div>
    <div class="footer-copy">© 2025 iClan. All rights reserved.</div>
  </footer>

</body>
</html>
