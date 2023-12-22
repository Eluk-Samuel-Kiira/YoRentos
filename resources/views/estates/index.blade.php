@include('dashboard.tenant-dashboard')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Estates') }} 
        </h2>
        <h6>
            <div id="error-container"></div>
        </h6>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg  table-responsive"  style="overflow-x: auto;">
                <div class="max-w-7xl mx-auto p-6">
                    <input type="text" id="estateSearch" class="rounded text-gray-500 mb-4" placeholder="Search Estate">
                    <div class="flex space-x-4" id="estateContainer">
                        @forelse($estates as $estate)
                            @if(auth()->user()->role == 'Admin' || auth()->user()->id == $estate->landlord_id || auth()->user()->id == $estate->broker_id)
                                <button class="bg-blue-500 active:bg-red-700 text-white px-4 py-2 rounded hover:bg-0" onclick="showContent('{{ $estate->uid }}')">{{ $estate->estate }}</button>
                            @endif
                        @empty
                            <h2 class="text-xl font-bold mb-2">No Estate Registered</h2>
                        @endforelse
                    </div>
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
                    @forelse($estates as $estate)
                        <div id="content_{{ $estate->uid }}" class="hidden mt-4">
                            <h2 class="text-2xl font-bold mb-4">{{ $estate->estate }}</h2>
                            <div class="border-b border-gray-200 py-3">
                                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                                    <div> 
                                        @foreach($users as $user)
                                            @if ($estate->landlord_id == $user->id)
                                                <p class="text-lg font-semibold">Landlord: {{ $user->name }}</p>
                                                <p class="text-sm text-gray-500">Email: {{ $user->email }}</p>
                                                <p class="text-sm text-gray-500">Phone: {{ $user->phone_number }}</p>
                                            @endif
                                        @endforeach
                                    </div>
                                    <div>
                                        @foreach($users as $user)
                                            @if ($estate->broker_id == $user->id)
                                                <p class="text-lg font-semibold">Broker: {{ $user->name }}</p>
                                                <p class="text-sm text-gray-500">Email: {{ $user->email }}</p>
                                                <p class="text-sm text-gray-500">Phone: {{ $user->phone_number }}</p>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <!-- account details -->
                            <div class="border-b border-gray-200 py-3">
                                <div class="flex justify-between items-center">
                                    <h3 class="text-lg font-semibold mb-2">Pricing:</h3>
                                    <div class="inline-block p-1">
                                        <button onclick="toggleAdvert('{{ $estate->uid }}')" class="bg-blue-500 text-white px-2 py-1 rounded-sm text-xs hover:bg-blue-600 motion-reduce:transform-none">
                                            Advertise Estate
                                        </button>
                                    </div>
                                    <div class="inline-block p-1">
                                        <button onclick="toggleUnits('{{ $estate->uid }}')" class="bg-blue-500 text-white px-2 py-1 rounded-sm text-xs hover:bg-blue-600 motion-reduce:transform-none">
                                            Access Units
                                        </button>
                                    </div>
                                </div> 
                                    
                                <div class="md:flex">
                                    @include('estates.advertise-estate')
                                    @include('estates.pay-unit')
                                    <div class="w-full md:w-1/3 bg-gray-200 rounded-lg p-2 mt-4 md:mt-0">
                                        <div class="w-full bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                                            <div class="flex flex-col space-y-4">
                                                <div>
                                                    <p class="text-lg font-semibold">Advert Status</p>
                                                    @if($estate->sponsored == 1)
                                                        <p class="text-sm text-gray-500 flex items-center">
                                                            <span class="py-1 px-2 bg-green-300 text-white rounded">Advert is Still Running</span>
                                                        </p>
                                                    @else
                                                        <p class="text-sm text-gray-500 flex items-center">
                                                            <span class="py-1 px-2 bg-red-300 text-white rounded">Advert is Off</span>
                                                        </p>
                                                    @endif
                                                </div>
                                                <div>
                                                    <p class="text-lg font-semibold">Units Status</p>
                                                    @if($estate->sponsored == 1)
                                                        <p class="text-sm text-gray-500 flex items-center">
                                                            <span class="py-1 px-2 bg-green-300 text-white rounded">Advert is Still Running</span>
                                                        </p>
                                                    @else
                                                        <p class="text-sm text-gray-500 flex items-center">
                                                            <span class="py-1 px-2 bg-red-300 text-white rounded">Advert is Off</span>
                                                        </p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                            
                            <!-- account details -->
                            <div class="border-b border-gray-200 py-3">
                                <div class="flex justify-between items-center">
                                    <h3 class="text-lg font-semibold mb-2">Account Payments:</h3>
                                </div> 
                                    
                                <div class="md:flex">
                                    <div class="w-full md:w-1/3 bg-gray-200 rounded-lg p-2">
                                        <div class="w-full max-w-sm mx-auto">
                                            <form action="{{route('payment.store')}}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                                                @csrf
                                                <input type="hidden" id="landlord_id" name="landlord_id" value="{{ $estate->landlord_id }}" required>
                                                <input type="hidden" id="estate_id" name="estate_id" value="{{ $estate->uid }}" required>
                                                <div class="mb-4">
                                                    <label for="pay_mode" class="block text-gray-700 text-sm font-bold mb-2">Payment Mode</label>
                                                    <select id="pay_mode" class="w-full font-medium py-2 rounded text-gray-700" name="pay_mode" required>
                                                        <option class="block mt-1 w-full" value=""></option>
                                                        <option class="block mt-1 w-full" value="Mobile Money">Mobile Money</option>
                                                        <option class="block mt-1 w-full" value="Bank Payment">Bank Payments</option>
                                                    </select>      
                                                </div>                                          
                                                <div class="mb-4">
                                                    <label for="account_name" class="block text-gray-700 text-sm font-bold mb-2">Account Name/ Mobile Name</label>
                                                    <input type="text" id="account_name" name="account_name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                                </div>
                                                <div class="mb-4">
                                                    <label for="account_number" class="block text-gray-700 text-sm font-bold mb-2">Account Number/ Mobile Number </label>
                                                    <input type="number" id="account_number" name="account_number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                                </div>
                                                <div class="flex items-center justify-between">
                                                    <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded-sm text-sm hover:bg-blue-600 motion-reduce:transform-none">
                                                        Save
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="w-full md:w-2/3 bg-gray-200 rounded-lg p-2 mt-4 md:mt-0">
                                        <div class="w-full bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                                            <div class="flex flex-col space-y-4">
                                                <div>
                                                    <p class="text-lg font-semibold">Mobile Details</p>
                                                    @foreach ($estate->payEstate as $pay)
                                                        @if($pay->pay_mode == 'Mobile Money')
                                                            <p class="text-sm text-gray-500 flex items-center">
                                                                <span>{{ $pay->account_name }}: {{ $pay->account_number }}</span>
                                                                <button class="delete-pay ml-2 bg-red-500 text-white px-1 py-0 rounded-md"
                                                                        data-pay="{{ $pay->id }}">
                                                                    &times;
                                                                </button>
                                                            </p>
                                                        @endif
                                                    @endforeach
                                                </div>
                                                <div>
                                                    <p class="text-lg font-semibold">Bank Details</p>
                                                    @foreach ($estate->payEstate as $pay)
                                                        @if($pay->pay_mode == 'Bank Payment')
                                                            <p class="text-sm text-gray-500">
                                                                <span>{{ $pay->account_name }}: {{ $pay->account_number }}</span>
                                                                <button class="delete-pay ml-2 bg-red-500 text-white px-1 py-0 rounded-md"
                                                                        data-pay="{{ $pay->id }}">
                                                                    &times;
                                                                </button>
                                                            </p>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                            </div>

                            <!-- location details -->
                            <div>
                                <div class="flex justify-between items-center">
                                    <h3 class="text-lg font-semibold mb-2">Location:</h3>
                                    <button onclick="getGeoPosition({{ json_encode($estate) }})" class="bg-blue-500 text-white px-3 py-1 rounded-sm text-sm">
                                        Reset Location
                                    </button>
                                </div>
                                <div class="flex items-center justify-between border-b border-gray-200 py-3">
                                    <div> 
                                        @if ($estate->latitude)
                                            <p class="text-lg font-semibold">Latitude:
                                                <span class="text-black"> 
                                                    <span class="text-blue-500">{{ $estate->latitude }}</span>
                                                </span>
                                            </p>
                                            <p class="text-lg font-semibold">Latitude:
                                                <span class="text-black"> 
                                                    <span class="text-blue-500">{{ $estate->longitude }}</span>
                                                </span>
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Description Field -->
                            <div class="border-b border-gray-200 py-3">
                                <div class="flex justify-between items-center">
                                    <h3 class="text-lg font-semibold mb-2">Estate Description</h3>
                                </div>
                                <!-- Description -->
                                <div class="flex flex-col space-y-4 md:flex-row md:space-y-0 md:space-x-4">
                                    <div class="w-full md:w-1/3 bg-gray-200 rounded-lg p-2">
                                        <div class="w-full max-w-sm mx-auto">
                                            <form action="{{ route('estate.description') }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                                                @csrf
                                                <input type="hidden" id="landlord_id" name="landlord_id" value="{{ $estate->landlord_id }}" required>
                                                <input type="hidden" id="estate_id" name="estate_id" value="{{ $estate->uid }}" required>
                                                <div class="mb-4">
                                                    <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Update Description:</label>
                                                    <textarea id="editor" name="description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required></textarea>
                                                </div>
                                                <div class="flex items-center justify-between">
                                                    <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded-sm text-sm hover:bg-blue-600 motion-reduce:transform-none">
                                                        Update
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="w-full md:w-2/3 bg-gray-200 rounded-lg p-2">
                                        <div class="w-full bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                                            {!! $estate->description !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Videos and Images -->
                            <div class="border-b border-gray-200 py-3">
                                <div class="flex justify-between items-center">
                                    <h3 class="text-lg font-semibold mb-2">Media</h3>
                                </div>
                                <!-- Videos -->
                                <div class="flex flex-col space-y-4 md:flex-row md:space-y-0 md:space-x-4 mb-2">
                                    <div class="w-full md:w-1/3 bg-gray-200 rounded-lg p-2">
                                        <video controls class="w-full h-48 md:h-40 rounded-lg">
                                            <source src="{{ asset('storage/estate_videos')}}/{{$estate->video }}" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    </div>
                                    <div class="w-full md:w-1/3 bg-gray-200 rounded-lg p-2">
                                        <div class="w-full max-w-sm mx-auto">
                                            <form action="{{route('estate.video')}}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                                                @csrf
                                                <input type="hidden" id="landlord_id" name="landlord_id" value="{{ $estate->landlord_id }}" required>
                                                <input type="hidden" id="estate_id" name="estate_id" value="{{ $estate->uid }}" required>
                                                <div class="mb-4">
                                                    <label for="video" class="block text-gray-700 text-sm font-bold mb-2">Update Video:</label>
                                                    <input type="file" id="video" name="video" accept="video/*" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                                </div>
                                                <div class="flex items-center justify-between">
                                                    <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded-sm text-sm hover:bg-blue-600 motion-reduce:transform-none">
                                                        Upload
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- Upload Images -->
                                    <div class="w-full md:w-1/3 bg-gray-200 rounded-lg p-2">
                                        <div class="w-full max-w-sm mx-auto">
                                            <form action="{{route('estate.images')}}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                                                @csrf
                                                <input type="hidden" id="landlord_id" name="landlord_id" value="{{ $estate->landlord_id }}" required>
                                                <input type="hidden" id="estate_id" name="estate_id" value="{{ $estate->uid }}" required>
                                                <div class="mb-4">
                                                    <label for="images" class="block text-gray-700 text-sm font-bold mb-2">Upload Images: 10 images only</label>
                                                    <input type="file" id="images" name="images[]" accept="image/*" multiple class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                                </div>
                                                <div class="flex items-center justify-between">
                                                    <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded-sm text-sm hover:bg-blue-600 motion-reduce:transform-none">
                                                        Upload
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- Display Images -->
                                <div class="flex flex-wrap -mx-4">
                                    @if($estate->images)
                                        @foreach(explode(',', $estate->images) as $imageName)
                                            <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/5 px-4 mb-4">
                                                <div class="bg-gray-200 rounded-lg p-2 relative">
                                                    <img src="{{ asset('storage/estate_images/' . $estate->landlord_id . '/' . $imageName) }}" alt="Image" class="w-full rounded-lg">
                                                    <button class="absolute top-0 right-0 px-2 py-1 bg-red-500 text-white rounded-md delete-image" 
                                                        data-estate-uid="{{ $estate->uid }}"
                                                        data-estate-landlord-id="{{ $estate->landlord_id }}"
                                                        data-image="{{ $imageName }}">
                                                            &times;
                                                    </button>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <h2 class="text-xl font-bold mb-2">No Estate Registered</h2>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
@include('estates.estate-location')
<script>
    // toggle the entire Estate
    function showContent(sectionId) {
        const sections = document.querySelectorAll('[id^="content_"]');
        sections.forEach(section => {
            if (section.id === `content_${sectionId}`) {
                section.classList.toggle('hidden');
            } else {
                section.classList.add('hidden');
            }
        });
    }
    
    $(document).ready(function() {
        $('.delete-image').on('click', function() {
            $(this).parent().remove();
            var imageName = $(this).data('image');
            var estateUid = $(this).data('estate-uid');
            var estateLandlordId = $(this).data('estate-landlord-id');
            // console.log(imageName);
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Send an AJAX request to delete the image
            $.ajax({
                url: '{{ route('image.delete') }}', // Replace with your route for deleting images
                method: 'POST',
                data: { image: imageName,
                        estateUid: estateUid,
                        estateLandlordId: estateLandlordId },
                success: function(response) {
                    if (response.success) {
                        // On success, remove the image's parent div
                        $(this).parent().remove();
                    } else {
                        // Handle error or display a message
                        console.log(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    // Handle error
                    console.error(error);
                }
            });
        });
    });

    $(document).ready(function() {
        $('.delete-pay').on('click', function() {
            $(this).parent().remove();
            var payName = $(this).data('pay');
            // console.log(imageName);
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Send an AJAX request to delete the image
            $.ajax({
                url: '{{ route('payment.delete') }}', 
                method: 'POST',
                data: { pay_id: payName,
                },
                success: function(response) {
                    if (response.success) {
                        // On success, remove the image's parent div
                        $(this).parent().remove();
                    } else {
                        // Handle error or display a message
                        console.log(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    // Handle error
                    console.error(error);
                }
            });
        });
    });
    
    // Function to handle estate filtering based on search query
    function filterEstates() {
        const searchText = document.getElementById('estateSearch').value.toLowerCase();
        const estateButtons = document.querySelectorAll('#estateContainer button');
        
        estateButtons.forEach(button => {
            const estateName = button.textContent.toLowerCase();
            
            if (estateName.includes(searchText)) {
                button.style.display = 'block'; 
            } else {
                button.style.display = 'none'; 
            }
        });
    }
    document.getElementById('estateSearch').addEventListener('input', filterEstates);
    
</script>


