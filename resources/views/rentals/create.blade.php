<div>
    <div id="notification" class="fixed top-0 right-0 mb-4 mr-4 p-4 bg-gray-800 text-white rounded shadow-md opacity-0 
        transition-opacity duration-500 hidden">
        <span id="notificationMessage"></span>
    </div>
    <div
        x-data="{ show: false }"
        x-show = "show"
        x-on:open-create-rental.window = "show = true"
        x-on:close-modal.window = "show = false"
        style="display:none"
        class="fixed">

        <div class="fixed inset-0 bg-gray-300 opacity-80 backdrop-blur-lg"></div>
            <div class="bg-white rounded m-auto fixed inset-0 max-w-2xl overflow-y-auto" style="max-height:500px">
                    <div class="px-4 py-3 flex items-center justify-between border-b border-gray-300">
                        <div class="text-xl text-gray-800">{{__('Create Role') }}</div>
                        <button x-on:click="$dispatch('close-modal')">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                <div class="p-4">        
                    <form method="POST" action="{{ route('rental.store') }}">
                        @csrf
                        <div class="mt-6">
                            <x-label for="rental_name" value="{{ __('Rental Name') }}" class="font-semibold text-xl"/>
                            <x-input id="rental_name" class="block mt-1 w-full" type="text" name="name" :value="old('rental_name')" required autofocus autocomplete="rental_name" />
                        </div>
                        
                        <x-button class="mt-8">
                            {{ __('Save') }}
                        </x-button>
                        </div>
                    </form>
                </div>        
            </div>
        </div>
    </div>
</div>

<script>
    function createRental() {
        const event = new CustomEvent('open-create-rental');
        window.dispatchEvent(event);
    }
</script>

