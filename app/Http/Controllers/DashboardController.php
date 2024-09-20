<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Comment;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
// داخل Controller
public function index()
{
    $totalTickets = Ticket::count();
    $openTickets = Ticket::where('status', 'open')->count();
    $closedTickets = Ticket::where('status', 'closed')->count();
    $totalComments = Comment::count();
    $totalUsers = User::count(); // حساب عدد المستخدمين
    $totalCategories = Category::count(); // للمسؤول
    $activities = Activity::latest()->limit(10)->get(); 

    return view('dashboard', compact('totalTickets', 'openTickets', 'closedTickets', 'totalComments', 'totalUsers', 'totalCategories','activities'));
}

}
