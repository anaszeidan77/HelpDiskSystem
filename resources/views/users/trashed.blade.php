{{-- resources/views/users/trashed.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-6">Trashed Users</h2>

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
                <th class="py-2 px-4 border-b">Deleted At</th>
                <th class="py-2 px-4 border-b">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
                <tr class="hover:bg-gray-100">
                    <td class="py-2 px-4 border-b">{{ $user->id }}</td>
                    <td class="py-2 px-4 border-b">{{ $user->name }}</td>
                    <td class="py-2 px-4 border-b">{{ $user->email }}</td>
                    <td class="py-2 px-4 border-b">{{ $user->deleted_at->format('Y-m-d H:i') }}</td>
                    <td class="py-2 px-4 border-b">
                        <form action="{{ route('users.restore', $user->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to restore this user?');">
                            @csrf
                            <button type="submit" class="text-green-600 hover:underline">Restore</button>
                        </form>
                        <form action="{{ route('users.forceDelete', $user->id) }}" method="POST" class="inline-block ml-2" onsubmit="return confirm('Are you sure you want to permanently delete this user?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Delete Permanently</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="py-2 px-4 text-center">No trashed users found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        <a href="{{ route('users.index') }}" class="text-purple-600 hover:underline">Back to Users</a>
    </div>
</div>
@endsection
