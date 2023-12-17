<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />
        <h4>  
            <x-validation-errors class="mb-4" />  
            @if(session('error'))
                <span class="bg-red-500 text-white rounded">
                    {{ session('error') }}
                </span>
            @endif
            @if(session('success'))
                <span class="bg-green-500 text-white rounded">
                    {{ session('success') }}
                </span>
            @endif
        </h4>

        <form method="POST" action="{{ route('confirm-otp') }}">
            @csrf

            <div>
                <x-input id="user_id" class="block mt-1 w-full" type="hidden" name="user_id" value="{{ auth()->user()->id }}" required/>    
                <x-label for="otp_number" value="{{ __('Enter The OTP Sent to Your Email') }}" />
                <x-input id="otp_number" class="block mt-1 w-full" type="number" name="otp_number" required/>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ms-4">
                    {{ __('confirm Code') }}
                </x-button>
            </div>
        </form>
        <div class="flex items-center justify-end mt-4">
            <x-label for="code_no" value="{{ __('If You Didnt Receive The OTP, kindly Click or Write A Correct Email Address ') }}" />
            <x-button class="ms-4" id="requestCodeButton">
                {{ __('Request Code') }}
            </x-button>
        </div>
        <h6>
            <div id="error-container"></div>
        </h6>
    </x-authentication-card>
</x-guest-layout>

<script>
    function showError(message) {
        var errorContainer = document.getElementById('error-container');
        errorContainer.innerHTML = '<div class="flex text-center ms-4">' +
                                        '<span class="bg-yellow-400 text-white p-2 rounded-md">' + message + '</span>' +
                                        '</div>';
    }

    const button = document.getElementById('requestCodeButton');

    function handleClick() {
        
        const url = `{{ route('otp.request') }}`;

        fetch(url, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
            },
        })
        .then(response => {
            // console.log('OTP requested successfully');
            var errorMessage = "OTP Sent Successfully";
                showError(errorMessage);
        })
        .catch(error => {
            console.error('Error requesting OTP:', error);
        });
    }
    button.addEventListener('click', handleClick);
</script>
