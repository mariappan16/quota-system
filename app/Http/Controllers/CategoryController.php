<?php

namespace App\Http\Controllers;

use App\Models\Sport;
use App\Models\Gender;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::with('gender','gender')->get();
        return view('categories.index', compact('categories'));
    }
}
