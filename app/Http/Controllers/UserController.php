<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Activity; // استيراد نموذج الأنشطة
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'role'     => 'required|string|in:admin,user',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = new User();
        $user->name     = $validatedData['name'];
        $user->email    = $validatedData['email'];
        $user->role     = $validatedData['role'];
        $user->password = Hash::make($validatedData['password']);
        $user->save();

        // تسجيل النشاط - إنشاء مستخدم جديد
        Activity::create([
            'user_id' => Auth::id(),
            'action' => 'created', // نوع النشاط
            'subject_type' => User::class,
            'subject_id' => $user->id,
        ]);

        return redirect()->route('users.index')->with('success', 'تم إنشاء المستخدم بنجاح.');
    }

    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $validatedData = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id),
            ],
            'role'     => 'required|string|in:admin,user',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->name  = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->role  = $validatedData['role'];

        if (!empty($validatedData['password'])) {
            $user->password = Hash::make($validatedData['password']);
        }

        $user->save();

        // تسجيل النشاط - تحديث مستخدم
        Activity::create([
            'user_id' => Auth::id(),
            'action' => 'updated', // نوع النشاط
            'subject_type' => User::class,
            'subject_id' => $user->id,
        ]);

        return redirect()->route('users.index')->with('success', 'تم تحديث المستخدم بنجاح.');
    }

    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete(); // سيقوم بالحذف اللطيف

        // تسجيل النشاط - حذف مستخدم
        Activity::create([
            'user_id' => Auth::id(),
            'action' => 'deleted', // نوع النشاط
            'subject_type' => User::class,
            'subject_id' => $user->id,
        ]);

        return redirect()->route('users.index')->with('success', 'تم حذف المستخدم بنجاح.');
    }

    // public function trashed()
    // {
    //     $users = User::onlyTrashed()->get(); // استخدام SoftDeletes لجلب المستخدمين المحذوفين
    //     return view('users.trashed', compact('users'));
    // }

    public function viewdeleteuser()
    {
        $users = User::onlyTrashed()->get(); // استخدام SoftDeletes لجلب المستخدمين المحذوفين
        return view('users.viewdeleteuser', compact('users'));
    }
    public function restore(string $id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->restore();

        // تسجيل النشاط - استعادة مستخدم
        Activity::create([
            'user_id' => Auth::id(),
            'action' => 'restored', // نوع النشاط
            'subject_type' => User::class,
            'subject_id' => $user->id,
        ]);

        return redirect()->route('users.index')->with('success', 'تم استعادة المستخدم بنجاح.');
    }

    public function forceDelete(string $id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->forceDelete();

        // تسجيل النشاط - حذف مستخدم نهائياً
        Activity::create([
            'user_id' => Auth::id(),
            'action' => 'force_deleted', // نوع النشاط
            'subject_type' => User::class,
            'subject_id' => $user->id,
        ]);

        return redirect()->route('users.index')->with('success', 'تم حذف المستخدم نهائياً.');
    }
}
