$files = Get-ChildItem -Path C:\xampp\htdocs\P-FUNDS\pages\dashboard\admin\*.html
foreach ($file in $files) {
    $content = Get-Content $file.FullName -Raw
    
    $content = $content -replace '<a href="#" class="nav-item active">\s*<i class="fa-solid fa-border-all"></i> Dashboard\s*</a>', '<a href="ad_dashboard.html" class="nav-item active"><i class="fa-solid fa-border-all"></i> Dashboard</a>'
    $content = $content -replace '<a href="#" class="nav-item">\s*<i class="fa-solid fa-border-all"></i> Dashboard\s*</a>', '<a href="ad_dashboard.html" class="nav-item"><i class="fa-solid fa-border-all"></i> Dashboard</a>'
    
    $content = $content -replace '<a href="#" class="sub-nav-item">Create Account</a>', '<a href="ad_account_create.html" class="sub-nav-item">Create Account</a>'
    $content = $content -replace '<a href="#" class="sub-nav-item">View Accounts</a>', '<a href="ad_account_review.html" class="sub-nav-item">View Accounts</a>'
    $content = $content -replace '<a href="#" class="sub-nav-item">Role Assignments</a>', '<a href="ad_role_assignment.html" class="sub-nav-item">Role Assignments</a>'
    $content = $content -replace '<a href="#" class="sub-nav-item">Activity Logs</a>', '<a href="ad_activity_logs.html" class="sub-nav-item">Activity Logs</a>'
    
    $content = $content -replace '<a href="#" class="sub-nav-item">Pending Approval</a>', '<a href="ad_project_review.html" class="sub-nav-item">Pending Approval</a>'
    $content = $content -replace '<a href="#" class="sub-nav-item">Rejected Projects</a>', '<a href="ad_rejected_projects.html" class="sub-nav-item">Rejected Projects</a>'
    $content = $content -replace '<a href="#" class="sub-nav-item">Project Tracking</a>', '<a href="ad_project_tracking.html" class="sub-nav-item">Project Tracking</a>'
    $content = $content -replace '<a href="#" class="sub-nav-item">Milestone Updates</a>', '<a href="ad_milestone_updates.html" class="sub-nav-item">Milestone Updates</a>'
    
    Set-Content -Path $file.FullName -Value $content
}
