<x-mail::message>
# Project Status Update: {{ $project->title }}

Hello {{ $project->user->name ?? 'Project Creator' }},

There has been an update regarding your project submission on the **P-FUNDS** platform. 

Your project **"{{ $project->title }}"** is now marked as: **{{ strtoupper($project->status) }}**.

@if($project->status === 'approved')
<x-mail::panel>
Congratulations! Your project has passed the vetting process and is now fully approved for funding deployment.
</x-mail::panel>
@elseif($project->status === 'vetting')
<x-mail::panel>
Your project has been accepted and passed to the vetting queue. It will now undergo multiple levels of technical and financial review.
</x-mail::panel>
@elseif($project->status === 'rejected')
<x-mail::panel>
Unfortunately, your project has been rejected. You may log in to view the administrator remarks or submit a revised proposal.
</x-mail::panel>
@elseif($project->status === 'submitted')
<x-mail::panel>
Your project has been successfully submitted and is now pending screening by the administration team.
</x-mail::panel>
@elseif($project->status === 'needs_update')
<x-mail::panel>
A reviewer has requested revisions or additional details for your project. Please log in to view the feedback remarks and update your proposal.
</x-mail::panel>
@endif

<x-mail::button :url="'http://127.0.0.1:5500/pages/dashboard/user/dashboard.html'">
View Project Dashboard
</x-mail::button>

Thanks,<br>
The P-FUNDS Administration Team
</x-mail::message>
