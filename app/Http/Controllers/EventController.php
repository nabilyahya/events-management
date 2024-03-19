<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Session;
class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();
        return view('events.index', compact('events'));
    }
    public function create()
    {
        $events = Event::all(); // Fetch all events
        return view('events.create', compact('events')); // Pass events to view
    }
    

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ]);
    
        try {
            Event::create($request->all());
            Session::flash('success', 'Event created successfully!');
        } catch (\Exception $e) {
            Session::flash('error', 'There was a problem creating the event.');
        }
    
        return redirect()->route('events.create');
    }
    public function showFormWithEvents()
{
    $events = Event::all(); // Assuming you have an Event model
    return view('events.create', compact('events'));
}

    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return redirect()->route('events/create')->with('success', 'Event deleted successfully');
    }

        public function show($id)
    {
        $event = Event::findOrFail($id); 
        
        return view('events.show', compact('event')); 
    }

    public function showWeekly()
    {
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        $events = Event::whereBetween('start_time', [$startOfWeek, $endOfWeek])->get();

        return view('events.weekly', compact('events', 'startOfWeek', 'endOfWeek'));
    }
}
