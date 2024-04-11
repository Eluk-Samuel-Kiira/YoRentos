@include('dashboard.tenant-dashboard')
@include('dashboard.not-admin')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Roles & Permissions') }} 
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
                    @role('Admin')
                        <button onclick="createRole()" class="px-3 py-1 bg-gray-500 text-white">Create Role</button>
                        <button onclick="editRole()" class="px-3 py-1 bg-gray-500 text-white">Edit Role</button>
                        <div class="table-responsive" style="overflow-x: auto;">
                            <div class="container mx-auto mt-8">
                                <table class="min-w-full border border-blue-500 text-gray-500">
                                    <thead>
                                        <tr>
                                            <th class="py-2 px-4 border border-blue-500">ID</th>
                                            <th class="py-2 px-4 border border-blue-500">Role</th>
                                            <th class="py-2 px-4 border border-blue-500">Permissions</th>
                                            <th class="py-2 px-4 border border-blue-500">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($roles as $role)
                                            <tr>
                                                <td class="py-2 px-4 border-b border-r">{{ $role->id }}</td>
                                                <td class="py-2 px-4 border-b border-r">{{ $role->name }}</td>
                                                <td class="py-2 px-4 border-b border-r">
                                                    @foreach ($role->permissions as $permission)
                                                        {{ $permission->name }}
                                                        @if (!$loop->last)
                                                            , 
                                                        @endif
                                                    @endforeach
                                                </td> 
                                                <td class="py-2 px-3 border-b">
                                                    <a href="{{ route('delete-role', $role->id) }}" 
                                                        onclick="return confirm('Are you sure you want to delete this role?');"
                                                        class="py-1 px-2 bg-red-300 text-white rounded hover:bg-red-500">
                                                        Delete
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <td class="py-2 px-4 border-b border-r">No Role Found</td>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endrole
                    @include('users.create-role')
                    @include('users.edit-role')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
@include('dashboard.status')
