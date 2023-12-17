@if (auth()->user()->deleted != 1)
    <script>
        window.location.href = "{{route('account.confirm')}}";
    </script>
@elseif (auth()->user()->status != 1)
    <script>
        window.location.href = "{{route('account-deactivate')}}";
    </script>
@elseif (auth()->user()->role == 'Tenant')
    <script>
        window.location.href = "{{route('tenant.dashboard')}}";
    </script>
@endif