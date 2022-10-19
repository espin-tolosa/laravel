<?php

namespace App\Http\Controllers;

use App\Http\Requests\DestroyEventRequest;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Http\Resources\EventResource;
use App\Http\Resources\UserResource;
use App\Models\Event;
use App\Models\Style;
use App\Models\User;
use Carbon\Carbon;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

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
     * 1. Check authentication
     * 2. Get all events since configured date
     * 3. If user is master -> return all
     //! Point 4. is a decision, I could trust in Users or in Styles, I decided Styles
     * 4. Take a list of all possible type of events client, team based on style
     * 5. Take only events of type client and partner
     * 6. If user is partner return events of type client and partner
     * 7. If user is client return only events of type client but censored
     *
     * @return \Illuminate\Http\Response
     */
    public function indexUser(Request $request, string $name)
    {
        //1.
        if(!User::isAuth($request))
        {
            //return [];
        }

        //2.
        $events = $this->getAll();

        //3.
        $role = User::where('name', $name)->value('role');
        if($role === "master")
        {
            return $events;
        }

        //4.
        $clients = Style::all()->where('type', '=', 'client'); //orderBy('role')->get();
        $clientsData = UserResource::collection($clients);
        $clientsList = [];
        foreach($clientsData as $client)
        {
            $clientsList []= $client['name'];
        }

        //TODO: extract this to a method
        /**
         * I get an array of all possible events of some type as: team, but also: public, private to user later to filter
         * events sent to clients
         */
        $public = Style::all()->where('type', '=', 'public'); //orderBy('role')->get();
        $publicData = UserResource::collection($public);

        $publicList = [];
        foreach($publicData as $public)
        {
            $publicList []= $public['name'];
        }
        
        $team = Style::all()->where('type', '=', 'team'); //orderBy('role')->get();
        $teamData = UserResource::collection($team);

        $teamList = [];
        foreach($teamData as $team)
        {
            $teamList []= $team['name'];
        }

        //5.
 
        /**
         * These are the criteria to filter events of clients, to avoid overfitted matching, I will add a new columns in envents
         * with topic, which is shared among styles and events
         *
         * TODO: add a `type' column into events to easily filter the type of events visible to users
         */
        /**
         * Busines: show clients only list of clients + public, nothing about team or private
         */
        $filterEvents = [];
        foreach($events as $event)
        {
            if(
                in_array($event['client'], $clientsList) ||
                in_array($event['client'], $publicList) ||
                in_array($event['client'], $teamList)
                //$event['client'] === 'holiday' //this will be easily captured as a public type
            )
            {
                $filterEvents []= $event;
            }
        }

        //6.
        if($role === 'partner')
        {
            $fE = [];
            $fE['data'] = $filterEvents;
            return $fE;
        }

        /**
         * Censored events for clients
         */

         //7.
        $filterEvents = [];
        foreach($events as $event)
        {
            if(
                in_array($event['client'], $clientsList) ||
                in_array($event['client'], $publicList)
                //in_array($event['client'], $teamList)
                //$event['client'] === 'holiday' //this will be easily captured as a public type
            )
            {
                $filterEvents []= $event;
            }
        }

         foreach($filterEvents as &$event)
         {
             if ($event['client'] === 'holiday')
             {
                $event['job'] = '';
                continue;
            }

            if( strtolower($event['client']) !== strtolower($name) )
            {
                $event['client'] = 'unavailable';
                $event['job'] = '';
            }

        }
        return EventResource::collection($filterEvents);
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
    public function update(UpdateEventRequest $request, $id)
    {
        return Event::find($id)->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy($event)
    {
        return Event::destroy($event);
    }
}