<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Participant;

class ParticipantController extends Controller
{
   
    public function index(Request $request)
    {
        $search = $request->input('search');
        $participants = Participant::when($search, function($query, $search){
            return $query->where('first_name', 'like', "%{$search}%")
                         ->orWhere('last_name', 'like', "%{$search}%")
                         ->orWhere('email', 'like', "%{$search}%")
                         ->orWhere('phone', 'like', "%{$search}%");
        })->get();

        return view('participants.index', ['participants' => $participants]);
    }

  
    public function create()
    {
        return view('participants.create');
    }

  
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:participants,email',
            'phone' => 'required|string|max:20',
        ]);

        $participant = new Participant();
        $participant->first_name = $request->first_name;
        $participant->last_name = $request->last_name;
        $participant->email = $request->email;
        $participant->phone = $request->phone;
        $participant->save();

        return redirect('/participants');
    }

    public function show($id)
    {
        $participant = Participant::find($id);
        return view('participants.show', ['participant' => $participant]);
    }


    public function edit($id)
    {
        $participant = Participant::find($id);
        return view('participants.edit', ['participant' => $participant]);
    }

 
    public function update(Request $request, $id)
    {
        $participant = Participant::find($id);

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:participants,email,'.$id,
            'phone' => 'required|string|max:20',
        ]);

        $participant->first_name = $request->first_name;
        $participant->last_name = $request->last_name;
        $participant->email = $request->email;
        $participant->phone = $request->phone;
        $participant->save();

        return redirect('/participants');
    }

    
    public function destroy($id)
    {
        $participant = Participant::find($id);
        if($participant){
            $participant->delete();
        }
        return redirect('/participants');
    }
}
