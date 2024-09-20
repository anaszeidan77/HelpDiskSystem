<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Ticket;
use App\Models\Activity; // استيراد نموذج الأنشطة
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        if ($user->role === 'admin') {
            $tickets = Ticket::with('category', 'user')->get();
        } else {
            $tickets = Ticket::where('user_id', $user->id)->with('category', 'user')->get();
        }

        return view('tickets.index', compact('tickets'));
    }

    public function create()
    {
        $categories = Category::all();
        $users = User::all();
        return view('tickets.create', compact('categories', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:open,in_progress,closed',
            'priority' => 'required|in:low,medium,high',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id',
        ]);

        $ticket = Ticket::create($request->all());

        // تسجيل النشاط - إنشاء تذكرة جديدة
        $user = Auth::user();
        Activity::create([
            'user_id' => $user->id,
            'action' => 'created', // نوع النشاط
            'subject_type' => Ticket::class,
            'subject_id' => $ticket->id,
        ]);

        return redirect()->route('tickets.index')
            ->with('success', 'Ticket created successfully.');
    }

    public function show(Ticket $ticket)
    {
        return view('tickets.show', compact('ticket'));
    }

    public function edit(Ticket $ticket)
    {
        $categories = Category::all();
        $users = User::all();
        return view('tickets.edit', compact('ticket', 'categories', 'users'));
    }

    public function update(Request $request, Ticket $ticket)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:open,in_progress,closed',
            'priority' => 'required|in:low,medium,high',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id',
        ]);

        $ticket->update($request->all());

        // تسجيل النشاط - تحديث تذكرة
        $user = Auth::user();
        Activity::create([
            'user_id' => $user->id,
            'action' => 'updated', // نوع النشاط
            'subject_type' => Ticket::class,
            'subject_id' => $ticket->id,
        ]);

        return redirect()->route('tickets.index')
            ->with('success', 'Ticket updated successfully.');
    }

    public function destroy(Ticket $ticket)
    {
        $ticket->delete();

        // تسجيل النشاط - حذف تذكرة
        $user = Auth::user();
        Activity::create([
            'user_id' => $user->id,
            'action' => 'deleted', // نوع النشاط
            'subject_type' => Ticket::class,
            'subject_id' => $ticket->id,
        ]);

        return redirect()->route('tickets.index')
            ->with('success', 'Ticket deleted successfully.');
    }

    public function showComments(Ticket $ticket)
    {
        $comments = $ticket->comments()->with('user')->get();

        return view('tickets.comments', compact('ticket', 'comments'));
    }
}
