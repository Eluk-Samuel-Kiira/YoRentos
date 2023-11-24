<div id="brokerModal" class="modal auto hidden inset-0 z-50 overflow-auto bg-black bg-opacity-50 flex">
    <div class="modal-content bg-white w-2/3 mx-auto my-10 p-4 relative sm:rounded-lg">        
        <!-- Close button -->
        <span id="closeBrokerModal" class="cursor-pointer absolute top-0 right-0 p-2 bg-red-500 hover:bg-red-700 text-white rounded">
            &times; close
        </span>        
        <!-- Form content -->
        <h6 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create a Broker and Location') }} 
        </h6>
        <form method="POST" action="{{ route('create.broker') }}">
            @csrf
            
            <div class="mt-4">
                <x-label for="broker_id" value="{{ __('Broker Name') }}" class="font-semibold text-xl"/>
                <select id="broker_id" class="w-full font-medium py-2 rounded text-gray-700" name="broker_id" required>
                    <option class="block mt-1 w-full" value=""></option>
                    @foreach ($brokers as $broker)
                        <option class="block mt-1 w-full" value="{{ $broker->id }}">{{ $broker->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mt-4">
                <x-label for="broker_id" value="{{ __('District Name') }}" class="font-semibold text-xl"/>
                <select id="district_id" class="w-full font-medium py-2 rounded text-gray-700" name="district_id" required>
                    <option class="block mt-1 w-full" value=""></option>
                    @foreach ($districts as $district)
                        <option class="block mt-1 w-full" value="{{ $district->id }}">{{ $district->district }}</option>
                    @endforeach
                </select>
            </div>

            <x-button class="mt-8">
                {{ __('Save') }}
            </x-button>
            </div>
        </form>
    </div>
</div>

<script>
    // JavaScript to handle opening and closing the modal
    document.getElementById('createBrokerModal').onclick = function () {
        document.getElementById('brokerModal').classList.remove('hidden');
    };

    document.getElementById('closeBrokerModal').onclick = function () {
        document.getElementById('brokerModal').classList.add('hidden');
    };
</script>

