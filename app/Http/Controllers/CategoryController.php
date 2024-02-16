<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Car;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::get();
        $unreadMessagesCount = Contact::where('is_read', false)->count();
        $unreadMessages = Contact::where('is_read', false)->get();
        return view('admin.categories',compact('categories','unreadMessagesCount','unreadMessages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();
        $unreadMessagesCount = Contact::where('is_read', false)->count();
        $unreadMessages = Contact::where('is_read', false)->get();
        return view('admin.addCategory',compact('categories','unreadMessagesCount','unreadMessages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'cat_name'=> 'required|string',
        ]);
        Category::create($data);
        return redirect('admin/categories');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $unreadMessagesCount = Contact::where('is_read', false)->count();
        $unreadMessages = Contact::where('is_read', false)->get();
        $category=Category::findOrFail($id);
        return view('admin.editCategory',compact('category','unreadMessagesCount','unreadMessages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'cat_name'=> 'required|string',
        ]);

        Category:: where('id',$id)->update($data);
        return redirect('admin/categories');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $categoryHasCars = Car::where('categoryId', $id)->exists();
        if ($categoryHasCars) {
            return redirect('admin/categories')->with('warning', 'The category cannot be deleted because it has cars associated with it.');
        }
        Category::where('id', $id)->delete();
        return redirect('admin/categories')->with('success', 'The category has been successfully deleted');
    }

}
