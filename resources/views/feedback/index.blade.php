@include('dashboard.tenant-dashboard')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Feedback Section') }} 
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="max-w-7xl mx-auto p-6">
                    <h4>  
                        <x-validation-errors class="mb-4" /> 
                        <div id="notification" class="fixed top-0 right-0 mb-4 mr-4 p-4 bg-gray-800 text-white rounded shadow-md opacity-0 transition-opacity duration-500 hidden">
                            <!-- <x-validation-errors class="mb-4" />   -->
                            <span id="notificationMessage"></span>
                        </div>
                    </h4>
                    <div class="table-responsive" style="overflow-x: auto;">
                        <div class="container mx-auto mt-8" id="resourceTable">
                            <div class="bg-blue-300 rounded py-1 px-3">Feedback Table</div>
                            <table class="min-w-full border border-blue-500 text-gray-500">
                                <thead>
                                    <tr>
                                        <th class="py-2 px-4 border border-blue-500">ID</th>
                                        <th class="py-2 px-4 border border-blue-500">Name</th>
                                        <th class="py-2 px-4 border border-blue-500">Contact</th>
                                        <th class="py-2 px-4 border border-blue-500">Message</th>
                                        @role('Admin')
                                            <th class="py-2 px-4 border border-blue-500">Delete</th>
                                        @endcan
                                    </tr>
                                </thead>
                                <tbody id="">
                                    @forelse($feedbacks as $feedback)
                                        <tr>
                                            <td class="py-2 px-4 border-b border-r">{{ $feedback->id }}</td>
                                            <td class="py-2 px-4 border-b border-r">
                                                @foreach($users as $user)
                                                    @if ($feedback->user_id == $user->id)
                                                        {{ $user->name }}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td class="py-2 px-4 border-b border-r">{{ $feedback->contact }}</td>
                                            <td class="py-2 px-4 border-b border-r">{{ $feedback->message }}</td>
                                            @role('Admin')
                                                <td class="py-2 px-4 border-b border-r">
                                                    <a href="{{ route('destroy.feedback', $feedback) }}" class="py-1 px-2 bg-red-300 text-white rounded hover:bg-red-500">
                                                        Delete
                                                    </a>
                                                </td>
                                            @endcan
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
@include('dashboard.status')