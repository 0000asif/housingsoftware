<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PhonebookController extends Controller
{
    public function index()
    {
        $category = Category::with('user')->get();
        return view('phonebook.index', compact('category'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        Category::create($data);
        return response()->json([
            'success' => 'Category Created Success',
        ]);

    }

}
