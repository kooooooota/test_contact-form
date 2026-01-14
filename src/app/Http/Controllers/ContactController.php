<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Contact;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    public function index()
    {
        $categories = category::all();
        return view('index', compact('categories'));
    }

    public function confirm(ContactRequest $request)
    {
        $request->flash();

        $category = Category::find($request->category_id);
        $contact = $request->all();

        return view('confirm', compact('contact', 'category'));
    }

    public function store(Request $request)
    {
        $contact = $request->only(['first_name', 'last_name', 'gender', 'email', 'tel', 'address', 'building', 'category_id', 'detail']);
        Contact::create($contact);
        
        return view('thanks');
    }

    public function edit()
    {
        return view('index', ['contact' => session('old_input')]);
    }

    public function register()
    {
        return view('auth.register');
    }
}
