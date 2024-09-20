{{-- resources/views/users/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Users</h2>
        <a href="{{ route('users.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded shadow-md hover:bg-blue-600 mb-4 inline-block">
            Add New User
        </a>
        <a href="{{ route('users.viewdeleteuser') }}" class="bg-blue-500 text-white px-4 py-2 rounded shadow-md hover:bg-blue-600 mb-4 inline-block">Trashed Users</a>
    </div>

    @if(session('success'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    <table class="min-w-full bg-white rounded-lg shadow-md">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b">ID</th>
                <th class="py-2 px-4 border-b">Name</th>
                <th class="py-2 px-4 border-b">Email</th>
                <th class="py-2 px-4 border-b">Role</th>
                <th class="py-2 px-4 border-b">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
                <tr class="hover:bg-gray-100">
                    <td class="py-2 px-4 border-b">{{ $user->id }}</td>
                    <td class="py-2 px-4 border-b">{{ $user->name }}</td>
                    <td class="py-2 px-4 border-b">{{ $user->email }}</td>
                    <td class="py-2 px-4 border-b">{{ ucfirst($user->role) }}</td>
                    <td class="py-2 px-4 border-b">
                        <a href="{{ route('users.show', $user->id) }}" class="bg-blue-500 text-white px-3 py-1 rounded shadow-md hover:bg-blue-600 text-xs"><i class="fas fa-eye"></i></a>
                        <a href="{{ route('users.edit', $user->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded shadow-md hover:bg-yellow-600 text-xs"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline-block ml-2" onsubmit="return confirm('Are you sure you want to delete this user?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded shadow-md hover:bg-red-600 text-xs"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="py-2 px-4 text-center">No users found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <br>



</div>
@endsection
