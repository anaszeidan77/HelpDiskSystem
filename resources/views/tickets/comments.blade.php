@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Comments for Ticket: {{ $ticket->title }}</h1>
    <a href="{{ route('comments.create') }}"
    class="bg-purple-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-purple-700 mb-4 inline-flex items-center">
    <i class="fas fa-plus mr-2"></i> Add Comment
</a>

    <div class="bg-white p-6 rounded-lg shadow-md shadow-purple-900">
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
                <thead>
                    <tr class="bg-gray-100 border-b">
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Description</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Ticket ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User
                            ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @foreach ($comments as $comment)
                        <tr class="border-b hover:bg-gray-50 transition duration-150 ease-in-out">
                            <td class="px-6 py-4 whitespace-nowrap">{{ $comment->description }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $comment->ticket->title }}</td>
                            <!-- عرض اسم التذكرة -->
                            <td class="px-6 py-4 whitespace-nowrap">{{ $comment->user->name }}</td>
                            <!-- عرض اسم المستخدم -->
                            <td class="px-6 py-4 whitespace-nowrap flex space-x-2 items-center">
                                <a href="{{ route('comments.show', $comment) }}"
                                    class="bg-blue-500 text-white px-3 py-1 rounded shadow-md hover:bg-blue-600 text-xs">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('comments.edit', $comment) }}"
                                    class="bg-yellow-500 text-white px-3 py-1 rounded shadow-md hover:bg-yellow-600 text-xs">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('comments.destroy', $comment) }}" method="POST"
                                    onsubmit="return confirm('Are you sure?');" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-500 text-white px-3 py-1 rounded shadow-md hover:bg-red-600 text-xs">
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
