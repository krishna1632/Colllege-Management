<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class EventController extends Controller
{
    // List all events
    public function index()
    {
        $events = Event::all();   // Fetch all events from the 'events' table
        return view('admin.event.index', compact('events'));
    }






    // Show the form to create a new event
    public function create()
    {
        return view('admin.event.create');
    }

    // Store a new event in the database
    public function store(Request $request)
    {
        $request->validate([
            'event_name' => 'required',
            'convenor' => 'required',
            'mob' => 'required',
            'place' => 'required',
            'date' => 'required',
            'time' => 'required',
            'intro_event'=>'required',
        ]);

        // Create a new event
        Event::create($request->all());

        return redirect()->route('admin.event.index')->with('success', 'Event created successfully.');
    }

    // Show the form to edit an existing event


    
    public function edit(Event $event)

    {
        
        return view('admin.event.edit', compact('event'));
    }

   // Update an event in the database
   public function update(Request $request, Event $event)
{
    $request->validate([
        'event_name' => 'required',
        'convenor' => 'required',
        'mob' => 'required|numeric',
        'place' => 'required',
        'date' => 'required|date',
        'time' => 'required',
        'intro_event' => 'nullable|file',
    ]);

    // Handle file upload if exists
    if ($request->hasFile('intro_event')) {
        $fileName = time().'_'.$request->file('intro_event')->getClientOriginalName();
        $filePath = $request->file('intro_event')->storeAs('uploads/events', $fileName, 'public');
        $event->intro_event = '/storage/' . $filePath;
    }

    // Update other event details
    $event->event_name = $request->event_name;
    $event->convenor = $request->convenor;
    $event->mob = $request->mob;
    $event->place = $request->place;
    $event->date = $request->date;
    $event->time = $request->time;

    $event->save();

    return redirect()->route('admin.event.index')->with('success', 'Event updated successfully.');
}

    //Delete an event from the database
    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('admin.event.index')->with('success', 'Event deleted successfully.');
    }
}
