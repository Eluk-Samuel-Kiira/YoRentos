<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div>
            <x-label value="{{ __('Your Account Has Been Suspended, Contact Admin To Be Reinstated') }}" />
            <x-label value="{{ __('') }}" />
            <a href="/" class="py-1 px-2 bg-blue-300 text-white rounded hover:bg-blue-500">Home</a>
        </div>

    </x-authentication-card>
</x-guest-layout>

