<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function approveSound($id)
    {
        $sound = Sound::findOrFail($id);
        $sound->update(['approved' => true]);
        return redirect()->back()->with('status', 'Sound approved.');
    }
    
    public function deleteSound($id)
    {
        $sound = Sound::findOrFail($id);
        $sound->delete();
        return redirect()->back()->with('status', 'Sound deleted.');
    }
    public function banUser($id)
    {
        $user = User::findOrFail($id);
        $user->update(['banned' => true]);
        return redirect()->back()->with('status', 'User banned.');
    }    
}
