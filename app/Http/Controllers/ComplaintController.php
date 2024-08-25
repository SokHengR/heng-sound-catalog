<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint;
use App\Models\Sound;

class ComplaintController extends Controller
{
    /**
     * Store a complaint about a sound.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $request->validate([
            'complaint_type' => 'required|string|max:255',
            'details' => 'nullable|string|max:1000',
        ]);

        $sound = Sound::findOrFail($id);

        $complaint = new Complaint();
        $complaint->user_id = auth()->id();
        $complaint->sound_id = $sound->id;
        $complaint->complaint_type = $request->input('complaint_type');
        $complaint->details = $request->input('details');
        $complaint->save();

        return redirect()->route('sounds.index')->with('success', 'Complaint submitted successfully.');
    }
}
