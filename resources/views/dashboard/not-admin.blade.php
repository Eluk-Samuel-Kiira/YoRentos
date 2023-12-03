@if(auth()->user()->role != 'Admin')
    <script>
        window.location.href = "{{route('dashboard')}}";
    </script>
@endif