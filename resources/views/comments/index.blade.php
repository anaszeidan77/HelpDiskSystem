@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-semibold mb-6">Comments</h1>

        <!-- زر لإضافة تعليق جديد -->
        <a href="{{ route('comments.create') }}" class="bg-purple-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-purple-700 mb-4 inline-block">
            Add Comment
        </a>

        <!-- رسالة نجاح عند إضافة/تعديل التعليق -->
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        <!-- كارد يحتوي على الجدول -->
        <div class="bg-white p-6 rounded-lg shadow-md shadow-purple-900">
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
                            <tr class="border-b hover:bg-gray-50 transition duration-150 ease-in-out">
                                <td class="px-6 py-4 whitespace-nowrap">{{ $comment->description }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $comment->ticket_id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $comment->user_id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap flex space-x-4">
                                    <a href="{{ route('comments.show', $comment) }}" class="bg-blue-500 text-white px-3 py-1 rounded-lg shadow hover:bg-blue-600">View</a>
                                    <a href="{{ route('comments.edit', $comment) }}" class="bg-yellow-500 text-white px-3 py-1 rounded-lg shadow hover:bg-yellow-600">Edit</a>
                                    <form action="{{ route('comments.destroy', $comment) }}" method="POST" onsubmit="return confirm('Are you sure?');" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded-lg shadow hover:bg-red-600">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
