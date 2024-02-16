<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;
use App\Traits\Common;
use App\Models\Contact;

class TestimonialController extends Controller
{
    use Common;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testimonials = Testimonial::get();
        $unreadMessagesCount = Contact::where('is_read', false)->count();
        $unreadMessages = Contact::where('is_read', false)->get();
        return view('admin.testimonials', compact('testimonials','unreadMessagesCount','unreadMessages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $unreadMessagesCount = Contact::where('is_read', false)->count();
        $unreadMessages = Contact::where('is_read', false)->get();
        return view('admin.addTestimonials',compact('unreadMessagesCount','unreadMessages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = $this->messages();
        $data = $request->validate([
            'Name'=>'required|string|max:50',
            'position'=> 'required|string',
            'image' => 'required|mimes:png,jpg,jpeg|max:2048',
            'content' =>'required|string'
        ],$messages);
    $data['published']=isset($request->published);
    $fileName = $this->uploadFile($request->image, 'assets/images');    
    $data['image'] = $fileName;
    Testimonial::create($data);
    return redirect('admin/testimonials') ;
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
        $testimonial = Testimonial::findOrFail($id);
        return view('admin.editTestimonials',compact('testimonial','unreadMessagesCount','unreadMessages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'Name'=>'required|string|max:50',
            'position'=> 'required|string',
            'image' => 'nullable|mimes:png,jpg,jpeg|max:2048',
            'content' =>'required|string'
        ]);
        if($request->hasFile('image')){
            $fileName = $this->uploadFile($request->image, 'assets/images');    
            $data['image'] = $fileName;

        }
        $data['published']=isset($request->published);
        Testimonial:: where('id',$id)->update($data);
        return redirect('admin/testimonials');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Testimonial::where('id', $id)->delete();
        return redirect('admin/testimonials');
    }
    public function messages(){
        return[
        'Name.required'=>'Name is required',
        'Name.string'=>'should be string',
        'position.required'=> 'position is required',
        'image.required'=> 'image is required',
        'content.required'=>'content is required',
        ];
        
    }
}
