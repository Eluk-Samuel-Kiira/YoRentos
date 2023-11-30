@include('dashboard.tenant-dashboard')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Estates') }} 
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg  table-responsive"  style="overflow-x: auto;">
                <div class="max-w-7xl mx-auto p-6">
                    <div class="flex space-x-4">
                        @forelse($estates as $estate)
                            <button class="bg-blue-500 active:bg-red-700 text-white px-4 py-2 rounded hover:bg-0" onclick="showContent('{{ $estate->uid }}')">{{ $estate->estate }}</button>
                        @empty
                            <h2 class="text-xl font-bold mb-2">No Estate Registered</h2>
                        @endforelse
                    </div>

                    @foreach($estates as $estate)
                        <div id="content_{{ $estate->uid }}" class="hidden mt-4">
                            <h2 class="text-2xl font-bold mb-4">{{ $estate->estate }}</h2>
                            <div class="flex items-center justify-between border-b border-gray-200 py-3">
                                <div> 
                                        @foreach($users as $user)
                                            @if ($estate->landlord_id == $user->id)
                                                <p class="text-lg font-semibold">Landlord: {{ $user->name }}</p>
                                                <p class="text-sm text-gray-500">Email: {{ $user->email }}</p>
                                            @endif
                                        @endforeach
                                </div>
                                <div>
                                        @foreach($users as $user)
                                            @if ($estate->broker_id == $user->id)
                                                <p class="text-lg font-semibold">Broker: {{ $user->name }}</p>
                                                <p class="text-sm text-gray-500">Email: {{ $user->email }}</p>
                                            @endif
                                        @endforeach
                                </div>
                            </div>

                            <!-- Videos and Images -->
                            <div class="border-b border-gray-200 py-3">
                                <h3 class="text-lg font-semibold mb-2">Media</h3>
                                <!-- Videos -->
                                <div class="flex space-x-4 mb-2">
                                    <!-- Video thumbnails -->
                                    <div class="w-1/3 bg-gray-200 rounded-lg p-2">
                                        <img src="video_thumbnail1.jpg" alt="Video Thumbnail" class="w-full rounded-lg">
                                    </div>
                                    <div class="w-1/3 bg-gray-200 rounded-lg p-2">
                                        <img src="video_thumbnail2.jpg" alt="Video Thumbnail" class="w-full rounded-lg">
                                    </div>
                                    <!-- Add more video thumbnails as needed -->
                                </div>
                                <!-- Images -->
                                <div class="flex space-x-4">
                                    <!-- Image thumbnails -->
                                    <div class="w-1/3 bg-gray-200 rounded-lg p-2">
                                        <img src="image1.jpg" alt="Image" class="w-full rounded-lg">
                                    </div>
                                    <div class="w-1/3 bg-gray-200 rounded-lg p-2">
                                        <img src="image2.jpg" alt="Image" class="w-full rounded-lg">
                                    </div>
                                    <!-- Add more image thumbnails as needed -->
                                </div>
                            </div>

                            <!-- Unit Information -->
                            <div>
                                <h3 class="text-lg font-semibold mb-2">Units</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                    <!-- Single Unit -->
                                    <div class="bg-gray-100 rounded-lg p-4">
                                        <h4 class="text-lg font-semibold mb-2">Unit 101</h4>
                                        <p>Unit details...</p>
                                        <!-- Edit button -->
                                        <button class="mt-2 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Edit</button>
                                        <!-- Longitude and Latitude -->
                                        <div class="mt-2 text-gray-500">
                                            <p>Longitude: 123.456</p>
                                            <p>Latitude: 78.910</p>
                                        </div>
                                    </div>
                                    <!-- Add more units as needed -->
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    function showContent(sectionId) {
        const sections = document.querySelectorAll('[id^="content_"]');
        sections.forEach(section => {
            if (section.id === `content_${sectionId}`) {
                section.classList.remove('hidden');
            } else {
                section.classList.add('hidden');
            }
        });
    }
</script>


