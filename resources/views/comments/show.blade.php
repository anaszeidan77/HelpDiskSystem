@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Comment Details</h1>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="mb-4">
                <p class="text-lg font-semibold"><strong>Description:</strong> {{ $comment->description }}</p>
            </div>
            <div class="mb-4">
                <p class="text-lg font-semibold"><strong>Ticket ID:</strong> {{ $comment->ticket_id }}</p>
            </div>
            <div class="mb-4">
                <p class="text-lg font-semibold"><strong>User ID:</strong> {{ $comment->user_id }}</p>
            </div>
            <div class="flex space-x-4">
                <a href="{{ route('comments.edit', $comment) }}" class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">Edit</a>
                <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500" onclick="return confirm('Are you sure you want to delete this comment?')">Delete</button>
                </form>
                <a href="{{ route('comments.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">Back</a>
            </div>
        </div>
    </div>
@endsection
