@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Categories</h1>

        <!-- زر إضافة فئة جديدة -->
        <a href="{{ route('categories.create') }}" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 mb-4 inline-block">Add Category</a>

        <!-- رسالة النجاح -->
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded-lg shadow-md mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- كارد يحتوي على الجدول -->
        <div class="bg-white p-6 rounded-lg shadow-md shadow-purple-900">
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white divide-y divide-gray-200">
                    <thead class=" text-black">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Code</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($categories as $category)
                            <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                                <td class="px-6 py-4 whitespace-nowrap">{{ $category->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $category->code }}</td>
                                <td class="px-6 py-4 whitespace-nowrap flex space-x-2">
                                    <a href="{{ route('categories.show', $category) }}" class="bg-blue-500 text-white px-3 py-1 rounded-lg shadow hover:bg-blue-600">View</a>
                                    <a href="{{ route('categories.edit', $category) }}" class="bg-yellow-500 text-white px-3 py-1 rounded-lg shadow hover:bg-yellow-600">Edit</a>
                                    <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded-lg shadow hover:bg-red-600" onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
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
