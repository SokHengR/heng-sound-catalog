<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SoundController extends Controller
{
    public function index()
    {
        $categories = Category::with('sounds')->get();
        return view('sounds.index', compact('categories'));
    }
    public function search(Request $request)
    {
        $query = $request->input('query');
        $sounds = Sound::where('name', 'like', "%{$query}%")->get();
        return view('sounds.search', compact('sounds'));
    }
    public function download($id)
    {
        $sound = Sound::findOrFail($id);
        return response()->download(storage_path('app/sounds/' . $sound->path));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'sound' => 'required|file|max:10240', // Max size 10MB
        ]);
    
        $path = $request->file('sound')->store('sounds');
    
        Sound::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'category_id' => $request->input('category_id'),
            'path' => $path,
            'approved' => false,
        ]);
    
        return redirect()->back()->with('status', 'Sound uploaded, waiting for approval.');
    }
}
