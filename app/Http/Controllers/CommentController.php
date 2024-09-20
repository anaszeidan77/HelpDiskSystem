<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Ticket;
use App\Models\Activity; // استيراد نموذج الأنشطة
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->role === 'admin') {
            $comments = Comment::with('ticket', 'user')->get();
        } else {
            $comments = Comment::where('user_id', $user->id)->with('ticket', 'user')->get();
        }

        return view('comments.index', compact('comments'));
    }

    public function create()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        if ($user->role === 'admin') {
            $tickets = Ticket::all();
        } else {
            $tickets = Ticket::where('user_id', $user->id)->get();
        }
        return view('comments.create', compact('tickets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string',
            'ticket_id' => 'required|exists:tickets,id',
        ]);

        $comment = new Comment($request->all());
        $comment->user_id = Auth::id(); 
        $comment->save();

        $user = Auth::user();
        Activity::create([
            'user_id' => $user->id,
            'action' => 'created',
            'subject_type' => Comment::class,
            'subject_id' => $comment->id,
        ]);

        return redirect()->route('comments.index')
            ->with('success', 'Comment created successfully.');
    }

    public function show(Comment $comment)
    {
        return view('comments.show', compact('comment'));
    }

    public function edit(Comment $comment)
    {
        return view('comments.edit', compact('comment'));
    }

    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            'description' => 'required|string',
            'ticket_id' => 'required|exists:tickets,id',
            'user_id' => 'required|exists:users,id',
        ]);

        $comment->update($request->all());

        // تسجيل النشاط - تحديث تعليق
        $user = Auth::user();
        Activity::create([
            'user_id' => $user->id,
            'action' => 'updated', // نوع النشاط
            'subject_type' => Comment::class,
            'subject_id' => $comment->id,
        ]);

        return redirect()->route('comments.index')
            ->with('success', 'Comment updated successfully.');
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        // تسجيل النشاط - حذف تعليق
        $user = Auth::user();
        Activity::create([
            'user_id' => $user->id,
            'action' => 'deleted', // نوع النشاط
            'subject_type' => Comment::class,
            'subject_id' => $comment->id,
        ]);

        return redirect()->route('comments.index')
            ->with('success', 'Comment deleted successfully.');
    }
}
