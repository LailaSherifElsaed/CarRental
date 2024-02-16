<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Category;
use App\Traits\Common;
use App\Models\Contact;

class CarController extends Controller
{
    use Common;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories=Category::get();
        $cars=Car::with('category')->get();
        $unreadMessagesCount = Contact::where('is_read', false)->count();
        $unreadMessages = Contact::where('is_read', false)->get();
        return view('admin.cars',compact('cars','categories','unreadMessagesCount','unreadMessages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories=Category::get();
        $unreadMessagesCount = Contact::where('is_read', false)->count();
        $unreadMessages = Contact::where('is_read', false)->get();
        return view('admin.addCar',compact('categories','unreadMessagesCount','unreadMessages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'categoryId' => 'required',
            'title' => 'required|string',
            'luggage' => 'required|integer',
            'doors' => 'required|integer',
            'passenger' => 'required|integer',
            'description' => 'required|string',
            'price' => 'required|integer', 
            'image' => 'required|mimes:png,jpg,jpeg|max:2048',
        ]);
    
        $data['active'] = isset($request->active);
        $fileName = $this->uploadFile($request->image, 'assets/images');    
        $data['image'] = $fileName;
    
        Car::create($data);
        
        return redirect('admin/cars');
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
        $car = Car::findOrFail($id);
        $categories=Category::get();
        $currentCategoryId = $car->categoryId;
        return view('admin.editCar', compact('car','categories','currentCategoryId','unreadMessagesCount','unreadMessages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'categoryId' => 'required',
            'title' => 'required|string',
            'luggage' => 'required|integer',
            'doors' => 'required|integer',
            'passenger' => 'required|integer',
            'description' => 'required|string',
            'price' => 'required|integer', 
            'image' => 'sometimes|mimes:png,jpg,jpeg|max:2048',
        ]);
        if($request->hasFile('image')){
            $fileName = $this->uploadFile($request->image, 'assets/images');    
            $data['image'] = $fileName;
        }
        $data['active'] = isset($request->active);
        Car::where('id',$id)->update($data);      
        return redirect('admin/cars');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Car::where('id', $id)->delete();
        return redirect('admin/cars');
    }
}
