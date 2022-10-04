<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Http\Resources\EventResource;
use App\Models\Event;
use App\Models\User;
use Carbon\Carbon;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;

class EventController extends Controller
{
    /**
     * Shows all events since two months ago, time server
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /**
         * Check role of user by inspecting the auth cookie
         * It is not Laravel style but does the job now.
         */
        //! Uncoment this auth check for production
        //try {
        //    $name = explode("|", Crypt::decrypt(Cookie::get('auth'), false))[1];
        //}

        //catch (Error $error)
        //{
        //    return [];
        //}

        //$role = User::where('name', $name)->value('role');

        //if($role !== 'master')
        //{
        //    return [];
        //}

        return [];

    }

    private function getAll()
    {
        $date = Carbon::now()->subMonths(2);
        $events = Event::all()->where('end','>=', $date);
        return EventResource::collection($events);
    }

    /**
     * Filter index by user
     *
     * @return \Illuminate\Http\Response
     */
    public function indexUser(Request $request, string $name)
    {        
        if(!User::isAuth($request))
        {
            return [];
        }

        $events = $this->getAll();
        
        $role = User::where('name', $name)->value('role');
        if($role === "master")
        {
            return $events;
        }

        foreach($events as &$event)
        {
            if($event['client'] !== $name )
            {
                $event['client'] = 'MISC';
                $event['job'] = '';
            }

        }
        return $events;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEventRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEventRequest $request)
    {
        //dd($request);
        return Event::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEventRequest  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }
}