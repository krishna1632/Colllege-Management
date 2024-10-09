<?php

namespace App\Http\Controllers\User;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventsController extends Controller
{
    public function index()
    {
        $events = Event::where('created_by', auth()->id())->get(); // User sees their own events
        return view('user.events.index', compact('events'));
    }

    public function create()
    {
        return view('user.events.create');
    }

    // Implement store, edit, update, destroy for users...
}
