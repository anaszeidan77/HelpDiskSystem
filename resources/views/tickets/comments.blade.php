@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Comments for Ticket: {{ $ticket->title }}</h1>

    <div class="bg-white p-6 rounded-lg shadow-md">
        @foreach($comments as $comment)
            <div class="mb-4">
                <p><strong>User:</strong> {{ $comment->user->name }}</p>
                <p><strong>Description:</strong> {{ $comment->description }}</p>
                <hr class="my-4">
            </div>
        @endforeach
    </div>
@endsection
