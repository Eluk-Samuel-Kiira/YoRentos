@if(auth()->user()->role == 'Tenant')
    <script>
        window.location.href = "{{route('tenant.dashboard')}}";
    </script>
@endif