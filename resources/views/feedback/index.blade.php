@include('dashboard.tenant-dashboard')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }} 
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="max-w-7xl mx-auto p-6">
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
                    <div class="table-responsive" style="overflow-x: auto;" id="rentalTable">
                        <div class="container mx-auto mt-8">
                            <table class="min-w-full border border-blue-500 text-gray-500">
                                <thead>
                                    <tr>
                                        <th class="py-2 px-4 border border-blue-500">ID</th>
                                        <th class="py-2 px-4 border border-blue-500">Name</th>
                                        <th class="py-2 px-4 border border-blue-500">Contact</th>
                                        <th class="py-2 px-4 border border-blue-500">Message</th>
                                        <th class="py-2 px-4 border border-blue-500">Delete</th>
                                    </tr>
                                </thead>
                                <tbody id="">
                                    @forelse($feedbacks as $feedback)
                                        <tr>
                                            <td class="py-2 px-4 border-b border-r">{{ $feedback->id }}</td>
                                            <td class="py-2 px-4 border-b border-r">{{ $feedback->user }}</td>
                                            <td class="py-2 px-4 border-b border-r">{{ $feedback->contact }}</td>
                                            <td class="py-2 px-4 border-b border-r">{{ $feedback->message }}</td>
                                            <td class="py-2 px-4 border-b border-r">
                                                <a href="{{ route('destroy.feedback', $feedback) }}" class="py-1 px-2 bg-red-300 text-white rounded hover:bg-red-500">
                                                    Delete
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <td class="py-2 px-4 border-b border-r">{{__('No Feedback Available')}}</td>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>