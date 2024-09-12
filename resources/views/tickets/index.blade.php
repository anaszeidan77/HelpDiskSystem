@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-6">Tickets List</h2>
    <a href="{{ route('tickets.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded shadow-md hover:bg-blue-600 mb-4 inline-block">
        <i class="fas fa-plus"></i> Add New Ticket
    </a>

    <!-- تعديل الكارد ليظهر ضل بنفسجي داكن -->
    <div class="bg-white p-6 rounded-lg shadow-md shadow-purple-900">
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
                        <a href="{{ route('tickets.show', $ticket->id) }}" class="bg-blue-500 text-white px-3 py-1 rounded shadow-md hover:bg-blue-600 text-xs" title="View">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('tickets.edit', $ticket->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded shadow-md hover:bg-yellow-600 text-xs" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="{{ route('tickets.comments', $ticket->id) }}" class="bg-purple-500 text-white px-3 py-1 rounded shadow-md hover:bg-purple-600 text-xs" title="Comments">
                            <i class="fas fa-comments"></i>
                        </a>
                        <form action="{{ route('tickets.destroy', $ticket->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded shadow-md hover:bg-red-600 text-xs" title="Delete">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
