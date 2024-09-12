<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // استخدام Auth Facade بدلاً من auth()

        if (!$user) {
            return redirect()->route('login'); // إعادة التوجيه إذا لم يكن هناك مستخدم
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
            'status' => 'required|string',
            'priority' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id',
        ]);

        Ticket::create($request->all());

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
            'status' => 'required|string',
            'priority' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id',
        ]);

        $ticket->update($request->all());

        return redirect()->route('tickets.index')
            ->with('success', 'Ticket updated successfully.');
    }

    public function destroy(Ticket $ticket)
    {
        $ticket->delete();

        return redirect()->route('tickets.index')
            ->with('success', 'Ticket deleted successfully.');
    }
    public function showComments(Ticket $ticket)
    {
        // تحميل التعليقات الخاصة بالتذكرة المحددة
        $comments = $ticket->comments()->with('user')->get();

        return view('tickets.comments', compact('ticket', 'comments'));
    }
}
