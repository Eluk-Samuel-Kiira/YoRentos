<div>
    <div id="notification" class="fixed top-0 right-0 mb-4 mr-4 p-4 bg-gray-800 text-white rounded shadow-md opacity-0 
        transition-opacity duration-500 hidden">
        <span id="notificationMessage"></span>
    </div>
    <div
        x-data="{ show: true, rental_id: '', rental_name: '' }"
        x-show = "show"
        x-on:open-edit-rental.window = "show = true; rental_id = $event.detail.rental_id; rental_name = $event.detail.rental_name;"
        x-on:close-modal.window = "show = false"
        style="display:none"
        class="fixed">

        <div class="fixed inset-0 bg-gray-300 opacity-80 backdrop-blur-lg"></div>
            <div class="bg-white rounded m-auto fixed inset-0 max-w-2xl overflow-y-auto" style="max-height:500px">
                    <div class="px-4 py-3 flex items-center justify-between border-b border-gray-300">
                        <div class="text-xl text-gray-800">{{__('Edit Role') }}</div>
                        <button x-on:click="$dispatch('close-modal')">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                <div class="p-4">        
                    <form method="POST" action="{{ route('rental.update', $rental_edit->slug) }}">
                        @csrf
                        @method('PUT')
                    
                        <div class="mt-6">
                            <x-label for="duration" value="{{ __('Rental Name') }}" class="font-semibold text-xl"/>
                            <x-input class="block mt-1 w-full rounded text-gray-700" type="text" name="name" value="{{ $rental_edit->name }}" required />
                        </div>

                        <x-button type="submit" class="mt-8">
                            Save
                        </x-button>
                    </form>
                </div>        
            </div>
        </div>
    </div>
</div>

<script>
    function editRental(rental_id, rental_name) {
        const event = new CustomEvent('open-edit-rental', { detail: { rental_id, rental_name} });
        window.dispatchEvent(event);
    }

</script>

