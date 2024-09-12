@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Add Comment</h1>

        <!-- نموذج إضافة تعليق -->
        <form action="{{ route('comments.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md shadow-purple-900">
            @csrf
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea id="description" name="description" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-50" required></textarea>
            </div>

            <div class="mb-4">
                <label for="ticket_id" class="block text-sm font-medium text-gray-700">Ticket ID</label>
                <input type="text" id="ticket_id" name="ticket_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-50" required>
            </div>

            <div class="mb-4">
                <label for="user_id" class="block text-sm font-medium text-gray-700">User ID</label>
                <input type="text" id="user_id" name="user_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-50" required>
            </div>

            <!-- زر الحفظ -->
            <button type="submit" class="w-full bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-opacity-50">
                Save
            </button>
        </form>
    </div>
@endsection
