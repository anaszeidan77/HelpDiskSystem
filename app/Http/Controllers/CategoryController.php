<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Activity; // استيراد نموذج الأنشطة
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255',
        ]);

        $category = Category::create($request->all());

        // تسجيل النشاط - إنشاء فئة جديدة
        $user = Auth::user();
        Activity::create([
            'user_id' => $user->id,
            'action' => 'created', // نوع النشاط
            'subject_type' => Category::class,
            'subject_id' => $category->id,
        ]);

        return redirect()->route('categories.index')
            ->with('success', 'Category created successfully.');
    }

    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255',
        ]);

        $category->update($request->all());
        $user = Auth::user();
        // تسجيل النشاط - تحديث الفئة
        Activity::create([
            'user_id' => $user->id,
            'action' => 'updated', // نوع النشاط
            'subject_type' => Category::class,
            'subject_id' => $category->id,
        ]);

        return redirect()->route('categories.index')
            ->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        // تسجيل النشاط - حذف الفئة
        $user = Auth::user();
        Activity::create([
            'user_id' => $user->id,
            'action' => 'deleted', // نوع النشاط
            'subject_type' => Category::class,
            'subject_id' => $category->id,
        ]);

        return redirect()->route('categories.index')
            ->with('success', 'Category deleted successfully.');
    }
}
