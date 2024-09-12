@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-semibold mb-4">Comments</h1>
        <a href="{{ route('comments.create') }}" class="btn btn-primary mb-4">Add Comment</a>

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
                <thead>
                    <tr class="bg-gray-100 border-b">
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ticket ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @foreach($comments as $comment)
                        <tr class="border-b">
                            <td class="px-6 py-4 whitespace-nowrap">{{ $comment->description }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $comment->ticket_id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $comment->user_id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a href="{{ route('comments.show', $comment) }}" class="text-blue-500 hover:text-blue-700">View</a>
                                <a href="{{ route('comments.edit', $comment) }}" class="text-yellow-500 hover:text-yellow-700 mx-4">Edit</a>
                                <form action="{{ route('comments.destroy', $comment) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
