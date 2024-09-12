@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-6">Ticket Details</h2>
    <div class="bg-white p-6 rounded-lg shadow-md shadow-purple-900">
        <div class="mb-4">
            <strong class="text-gray-600">Title:</strong> 
            <span class="text-gray-900 font-medium">{{ $ticket->title }}</span>
        </div>
        <div class="mb-4">
            <strong class="text-gray-600">Description:</strong> 
            <span class="text-gray-900 font-medium">{{ $ticket->description }}</span>
        </div>
        <div class="mb-4">
            <strong class="text-gray-600">Status:</strong> 
            <span class="text-gray-900 font-medium">{{ $ticket->status }}</span>
        </div>
        <div class="mb-4">
            <strong class="text-gray-600">Priority:</strong> 
            <span class="text-gray-900 font-medium">{{ $ticket->priority }}</span>
        </div>
        <div class="mb-4">
            <strong class="text-gray-600">Category:</strong> 
            <span class="text-gray-900 font-medium">{{ $ticket->category->name }}</span>
        </div>
        <div class="mb-4">
            <strong class="text-gray-600">User:</strong> 
            <span class="text-gray-900 font-medium">{{ $ticket->user->name }}</span>
        </div>

        <!-- تحسين تصميم الزر -->
        <a href="{{ route('tickets.index') }}" class="inline-block bg-purple-600 text-white px-4 py-2 rounded shadow-md hover:bg-purple-700 transition duration-200 ease-in-out">
            Back to List
        </a>
    </div>
</div>
@endsection
