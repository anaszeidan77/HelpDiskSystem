@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Add Category</h1>

        <!-- نموذج إضافة فئة -->
        <form action="{{ route('categories.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md shadow-purple-900">
            @csrf

            <!-- حقل الاسم -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" id="name" name="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-50" required>
            </div>

            <!-- حقل الكود -->
            <div class="mb-4">
                <label for="code" class="block text-sm font-medium text-gray-700">Code</label>
                <input type="text" id="code" name="code" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-50" required>
            </div>

            <!-- زر الحفظ -->
            <button type="submit" class="w-full bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-opacity-50">
                Save
            </button>
        </form>
    </div>
@endsection
