<x-mail::message>
# Welcome to P-FUNDS, {{ $user->name }}!

An administrator has successfully provisioned a new account for you on the **P-FUNDS** platform. You can now access your dashboard and manage your activities.

Here are your login credentials:

- **Email:** {{ $user->email }}
- **Temporary Password:** `{{ $password }}`
- **Assigned Role:** {{ $user->friendly_role }}

<x-mail::panel>
Please log in and update your password immediately for security purposes.
</x-mail::panel>

<x-mail::button :url="route('login')">
Login to your Account
</x-mail::button>

Thanks,<br>
The P-FUNDS Administration Team
</x-mail::message>
