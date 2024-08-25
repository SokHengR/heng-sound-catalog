<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate(['name' => 'required']);
        Category::create(['name' => $request->input('name')]);
        return redirect()->back()->with('status', 'Category added.');
    }
    
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->back()->with('status', 'Category deleted.');
    }
    
}
