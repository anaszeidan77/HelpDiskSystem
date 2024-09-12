@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-6">Tickets List</h2>
    <a href="{{ route('tickets.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded shadow-md hover:bg-blue-600 mb-4 inline-block">Add New Ticket</a>
    <div class="bg-white p-6 rounded-lg shadow-md">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Priority</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($tickets as $ticket)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $ticket->id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $ticket->title }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $ticket->description }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $ticket->status }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $ticket->priority }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $ticket->category->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $ticket->user->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap flex space-x-2">
                        <a href="{{ route('tickets.show', $ticket->id) }}" class="bg-blue-500 text-white px-3 py-1 rounded shadow-md hover:bg-blue-600 text-xs">View</a>
                        <a href="{{ route('tickets.edit', $ticket->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded shadow-md hover:bg-yellow-600 text-xs">Edit</a>
                        <form action="{{ route('tickets.destroy', $ticket->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded shadow-md hover:bg-red-600 text-xs">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
