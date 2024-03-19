<div>
    <div id="notification" class="fixed top-0 right-0 mb-4 mr-4 p-4 bg-gray-800 text-white rounded shadow-md opacity-0 
        transition-opacity duration-500 hidden">
        <span id="notificationMessage"></span>
    </div>
    <div
        x-data="{ show: false }"
        x-show = "show"
        x-on:open-create-parish.window = "show = true"
        x-on:close-modal.window = "show = false"
        style="display:none"
        class="fixed">

        <div class="fixed inset-0 bg-gray-300 opacity-80 backdrop-blur-lg"></div>
            <div class="bg-white rounded m-auto fixed inset-0 max-w-2xl overflow-y-auto" style="max-height:500px">
                    <div class="px-4 py-3 flex items-center justify-between border-b border-gray-300">
                        <div class="text-xl text-gray-800">{{__('Create Parish') }}</div>
                        <button x-on:click="$dispatch('close-modal')">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                <div class="p-4">
                    <form method="POST" action="{{ route('parish.store') }}">
                        @csrf

                        <div class="mt-6">
                            <x-label for="parish" value="{{ __('Parish Name') }}" class="font-semibold text-xl"/>
                            <x-input id="parish" class="block mt-1 w-full rounded text-gray-700" type="text" name="parish" :value="old('parish')" required autofocus autocomplete="parish" />
                        </div>

                        <div class="mt-4">
                            <x-label for="subcounty_id" value="{{ __('Select Sub-County') }}" class="font-semibold text-xl"/>
                            <select id="subcounty_id" class="w-full font-medium py-2 rounded text-gray-700" name="subcounty_id" required>
                                <option class="block mt-1 w-full" value=""></option>
                                @foreach ($subcounties as $subcounty)
                                    <option class="block mt-1 w-full" value="{{ $subcounty->id }}">{{ $subcounty->subcounty }}</option>
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
    function createParishModal() {
        const event = new CustomEvent('open-create-parish');
        window.dispatchEvent(event);
    }
</script>






