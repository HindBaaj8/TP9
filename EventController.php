<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Speaker;
use App\Models\Participant;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ParticipantsExport;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $search = $request->input('search');
        $events = Event::when($search, function($query, $search) {
                return $query->where('title', 'like', "%{$search}%")
                             ->orWhere('description', 'like', "%{$search}%");
            })->get();

        return view('events.index')->with(['events' => $events]);
    }

 
    public function create()
    {
        $speakers = Speaker::all();
        $participants = Participant::all();

        return view('events.create')->with([
            'speakers' => $speakers,
            'participants' => $participants
        ]);
    }

  
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date|after:today',
            'location' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        $event = new Event();
        $event->title = $validated['title'];
        $event->description = $validated['description'] ?? null;
        $event->date = $validated['date'];
        $event->location = $validated['location'];
        $event->user_id = Auth::id();
        if ($request->hasFile('image')) {
            $event->image = $request->file('image')->store('events', 'public');
        }
        $event->save();

   
        if (!empty($request->speakers)) {
            foreach ($request->speakers as $speakerId) {
                $event->speakers()->attach($speakerId); 
            }
        }

        if (!empty($request->participants)) {
            foreach ($request->participants as $participantId) {
                $event->participants()->attach($participantId);
            }
        }

        return redirect()->route('events.index')->with('success', 'Événement créé avec succès !');
    }


    public function show($id)
    {
        $event = Event::with(['speakers', 'participants'])->find($id);
        if (!$event) {
            return redirect()->route('events.index')->with('error', 'Événement introuvable.');
        }

        return view('events.show')->with(['event' => $event]);
    }


    public function edit($id)
    {
        $event = Event::find($id);
        if (!$event) {
            return redirect()->route('events.index')->with('error', 'Événement introuvable.');
        }

        $speakers = Speaker::all();
        $participants = Participant::all();

        return view('events.edit')->with([
            'event' => $event,
            'speakers' => $speakers,
            'participants' => $participants
        ]);
    }

 
    public function update(Request $request, $id)
    {
        $event = Event::find($id);
        if (!$event) {
            return redirect()->route('events.index')->with('error', 'Événement introuvable.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date|after:today',
            'location' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        $event->title = $validated['title'];
        $event->description = $validated['description'] ?? null;
        $event->date = $validated['date'];
        $event->location = $validated['location'];
        if ($request->hasFile('image')) {
            $event->image = $request->file('image')->store('events', 'public');
        }
        $event->save();

        if (!empty($request->speakers)) {
            foreach ($request->speakers as $speakerId) {
                $event->speakers()->attach($speakerId);
            }
        }

 
        if (!empty($request->participants)) {
            foreach ($request->participants as $participantId) {
                $event->participants()->attach($participantId);
            }
        }

        return redirect()->route('events.show', $event->id)
                         ->with('success', 'Événement mis à jour !');
    }

    public function destroy($id)
    {
        $event = Event::find($id);
        if (!$event) {
            return redirect()->route('events.index')->with('error', 'Événement introuvable.');
        }

        $event->delete();

        return redirect()->route('events.index')->with('success', 'Événement supprimé !');
    }

    public function generatePdf($id)
    {
        $event = Event::with(['speakers', 'participants'])->find($id);
        if (!$event) {
            return redirect()->route('events.index')->with('error', 'Événement introuvable.');
        }

        $pdf = PDF::loadView('events.PDF', ['event' => $event]);
        return $pdf->download("event_{$event->id}.pdf");
    }


    public function exportParticipants($id)
    {
        $event = Event::with('participants')->find($id);
        if (!$event) {
            return redirect()->route('events.index')->with('error', 'Événement introuvable.');
        }

        return Excel::download(new ParticipantsExport($event->participants), "participants_event_{$event->id}.xlsx");
    }
}
