<div>
    <div id="notification" class="fixed top-0 right-0 mb-4 mr-4 p-4 bg-gray-800 text-white rounded shadow-md opacity-0 
        transition-opacity duration-500 hidden">
        <span id="notificationMessage"></span>
    </div>
    <div
        x-data="{ show: false }"
        x-show = "show"
        x-on:open-create-subcounty.window = "show = true"
        x-on:close-modal.window = "show = false"
        style="display:none"
        class="fixed">

        <div class="fixed inset-0 bg-gray-300 opacity-80 backdrop-blur-lg"></div>
            <div class="bg-white rounded m-auto fixed inset-0 max-w-2xl overflow-y-auto" style="max-height:500px">
                    <div class="px-4 py-3 flex items-center justify-between border-b border-gray-300">
                        <div class="text-xl text-gray-800">{{__('Create Subcounty') }}</div>
                        <button x-on:click="$dispatch('close-modal')">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                <div class="p-4">       
                    <form method="POST" action="{{ route('subcounty.store') }}">
                        @csrf

                        <div class="mt-6">
                            <x-label for="subcounty" value="{{ __('Sub-County Name') }}" class="font-semibold text-xl"/>
                            <x-input id="subcounty" class="block mt-1 w-full rounded text-gray-700" type="text" name="subcounty" :value="old('subcounty')" required autofocus autocomplete="subcounty" />
                        </div>

                        <div class="mt-4">
                            <x-label for="county_id" value="{{ __('Select County') }}" class="font-semibold text-xl"/>
                            <select id="county_id" class="w-full font-medium py-2 rounded text-gray-700" name="county_id" required>
                                <option class="block mt-1 w-full" value=""></option>
                                @foreach ($counties as $county)
                                    <option class="block mt-1 w-full" value="{{ $county->id }}">{{ $county->county }}</option>
                                @endforeach
                            </select>
                        </div>

                        <x-button class="mt-8">
                            {{ __('Save') }}
                        </x-button>
                    </form>
                </div>        
            </div>
        </div>
    </div>
</div>

<script>
    function createSubcountyModal() {
        const event = new CustomEvent('open-create-subcounty');
        window.dispatchEvent(event);
    }
</script>





