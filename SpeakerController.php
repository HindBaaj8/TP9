<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Speaker;

class SpeakerController extends Controller
{
    
    public function index(Request $request)
    {
        $search = $request->input('search');
        $speakers = Speaker::when($search, function($query, $search){
            return $query->where('name', 'like', "%{$search}%")
                         ->orWhere('email', 'like', "%{$search}%");
        })->get();

        return view('speakers.index', ['speakers' => $speakers]);
    }


    public function create()
    {
        return view('speakers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'email' => 'required|email|unique:speakers,email',
        ]);

        $speaker = new Speaker();
        $speaker->name = $request->name;
        $speaker->bio = $request->bio;
        $speaker->email = $request->email;
        $speaker->save();

        return redirect('/speakers');
    }

   
    public function show($id)
    {
        $speaker = Speaker::find($id);
        return view('speakers.show', ['speaker' => $speaker]);
    }


    public function edit($id)
    {
        $speaker = Speaker::find($id);
        return view('speakers.edit', ['speaker' => $speaker]);
    }

    
    public function update(Request $request, $id)
    {
        $speaker = Speaker::find($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'email' => 'required|email|unique:speakers,email,'.$id,
        ]);

        $speaker->name = $request->name;
        $speaker->bio = $request->bio;
        $speaker->email = $request->email;
        $speaker->save();

        return redirect('/speakers');
    }

  
    public function destroy($id)
    {
        $speaker = Speaker::find($id);
        if($speaker){
            $speaker->delete();
        }
        return redirect('/speakers');
    }
}
