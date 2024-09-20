{{-- resources/views/users/show.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-6">User Details</h2>

    <div class="bg-white p-6 rounded-lg shadow-md shadow-purple-900">
        <div class="mb-4">
            <strong>ID:</strong> {{ $user->id }}
        </div>
        <div class="mb-4">
            <strong>Name:</strong> {{ $user->name }}
        </div>
        <div class="mb-4">
            <strong>Email:</strong> {{ $user->email }}
        </div>
        <div class="mb-4">
            <strong>Role:</strong> {{ ucfirst($user->role) }}
        </div>
        <div class="mb-4">
            <strong>Created At:</strong> {{ $user->created_at->format('Y-m-d H:i') }}
        </div>
        <div class="mb-4">
            <strong>Updated At:</strong> {{ $user->updated_at->format('Y-m-d H:i') }}
        </div>

        <div class="mt-6">
            <a href="{{ route('users.edit', $user->id) }}" class="bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                Edit User
            </a>
            <a href="{{ route('users.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded ml-2">
                Back to Users
            </a>
        </div>
    </div>
</div>
@endsection
