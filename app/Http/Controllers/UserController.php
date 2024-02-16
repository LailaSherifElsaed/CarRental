<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Contact;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::get();
        View::share('user', auth()->user());
        $unreadMessagesCount = Contact::where('is_read', false)->count();
        $unreadMessages = Contact::where('is_read', false)->get();
        return view('admin.users', compact('users','unreadMessagesCount','unreadMessages'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    /**
 * Show the form for creating a new resource.
 */
    public function create()
    {
        $unreadMessagesCount = Contact::where('is_read', false)->count();
        $unreadMessages = Contact::where('is_read', false)->get();
        $users = User::get(); // Retrieve the users (or an empty array if there are none)
        return view('admin.addUser', compact('users','unreadMessagesCount','unreadMessages'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = $this->messages();
        $data=$request->validate([
            'name'=>'required|string|max:255',
            'user_name'=>'required|string|max:50',
            'email'=> 'required|string',
            'password'=> 'required|string',
        ],$messages);

        $data['active']=isset($request->active);
        $user = User::create($data);
        $user->forceFill([
            'email_verified_at' => now(),
        ])->save();
        $unreadMessagesCount = Contact::where('is_read', false)->count();
        $unreadMessages = Contact::where('is_read', false)->get();
        return view('admin.users',compact('unreadMessagesCount','unreadMessages'))->with('users', User::all()); 
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
        $user = User::findOrFail($id); // Retrieve the user by ID
        return view('admin.editUser', compact('user','unreadMessagesCount','unreadMessages')); // Pass the user data to the view
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data=$request->validate([
            'name'=>'required|string|max:255',
            'user_name'=>'required|string|max:50',
            'email'=> 'required|string',
            'password'=> 'required|string',
        ]);

        $data['active']=isset($request->active);
        $user = User::findOrFail($id); // Retrieve the user by ID
        $user->update($data); // Use the update method on the instance
        return redirect()->route('admin.users');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function messages(){
        return[
        'name.required'=>'ادخل الاسم بالكامل',
        'name.string'=>'should be string',
        'user_name.required'=>'ادخل اسم المستخدم',
        'email.required'=>'email is required',
        'password.required'=> 'Password is required',
        ];
        
    }
}
