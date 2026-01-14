<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Contact;

class AdminController extends Controller
{
    public function search(Request $request)
    {
        $contacts = Contact::with('category')
            ->CategorySearch($request->category_id)
            ->GenderSearch($request->gender)
            ->DateSearch($request->date)
            ->KeywordSearch($request->keyword)
            ->paginate(7)
            ->appends([
                'category_id' => $request->category_id,
                'gender' => $request->gender,
                'date' => $request->date,
                'keyword' => $request->keyword,
            ]);
            
        $categories = Category::paginate(7);

        return view('admin', compact('contacts', 'categories'));
    }

    public function destroy(Request $request)
    {
        Contact::find($request->id)->delete();
        return redirect('/admin');
    }
}
