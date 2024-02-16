<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $unreadMessagesCount = Contact::where('is_read', false)->count();
        $unreadMessages = Contact::where('is_read', false)->get();
        $messages = Contact::get();

        return view('admin.messages', compact('messages', 'unreadMessagesCount', 'unreadMessages'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
{
    $message = Contact::findOrFail($id);
    $message->update(['is_read' => true]);

    $unreadMessagesCount = Contact::where('is_read', false)->count();
    $unreadMessages = Contact::where('is_read', false)->get();
    $messages = Contact::get(); // Include this line

    return view('admin.showMessage', compact('message', 'unreadMessagesCount', 'unreadMessages', 'messages'));
}



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    { 
        Contact::where('id', $id)->delete();
        return redirect()->route('admin.message');
    }

    



}
