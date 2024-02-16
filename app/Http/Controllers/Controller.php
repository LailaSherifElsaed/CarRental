<?php

namespace App\Http\Controllers;
use App\Models\Testimonial;
use App\Models\Car;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Contact;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function home()
    {
        $testimonials = Testimonial::latest()->take(3)->get();
        $cars = Car::latest()->take(6)->get();
        return view('web.testHome',compact('testimonials','cars'));
    }
    public function listing()
    {

        $cars = Car::get();
        $cars = Car::paginate(6);
        $testimonials = Testimonial::get();
        return view('web.Listing', compact('cars','testimonials'));
    } 
    public function testimonials()
    {
        $testimonials = Testimonial::get();
        return view('web.Testimonials',compact('testimonials'));
    }
    public function blog()
    {
        return view('web.Blog');
    }
    public function about()
    {
        return view('web.About');
    }
    public function contact()
    {
        return view('web.Contact');
    }
    public function single($id)
    {
        $categories = Category::withCount('cars')->get();
        $car = Car::find($id);
        return view('web.single', compact('car','categories'));
    }
    public function send_contactUs(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:10',
            'last_name' => 'required|string|max:10',
            'email' => 'required',
            'message' => 'required|string',
        ]);
        Contact::create($data);
        Mail::to( 'info@email.com')->send( 
            new ContactMail($data)
        );
        return redirect('ContactUs');
    }

}
