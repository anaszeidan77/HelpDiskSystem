@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-6">Edit Ticket</h2>
    <form action="{{ route('tickets.update', $ticket->id) }}" method="POST" class="bg-white p-6 rounded-lg shadow-md shadow-purple-900">
        @csrf
        @method('PATCH')
        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
            <input type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-50" id="title" name="title" value="{{ $ticket->title }}" required>
        </div>

        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-50" id="description" name="description" required>{{ $ticket->description }}</textarea>
        </div>

        <div class="mb-4">
            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
            <input type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-50" id="status" name="status" value="{{ $ticket->status }}" required>
        </div>

        <div class="mb-4">
            <label for="priority" class="block text-sm font-medium text-gray-700">Priority</label>
            <input type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-50" id="priority" name="priority" value="{{ $ticket->priority }}" required>
        </div>

        <div class="mb-4">
            <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
            <select class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-50" id="category_id" name="category_id" required>
                @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ $ticket->category_id == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="user_id" class="block text-sm font-medium text-gray-700">User</label>
            <select class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-50" id="user_id" name="user_id" required>
                @foreach($users as $user)
                <option value="{{ $user->id }}" {{ $ticket->user_id == $user->id ? 'selected' : '' }}>
                    {{ $user->name }}
                </option>
                @endforeach
            </select>
        </div>

        <!-- زر التحديث مع تحسين التصميم -->
        <button type="submit" class="w-full bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-opacity-50">
            Update Ticket
        </button>
    </form>
</div>
@endsection
