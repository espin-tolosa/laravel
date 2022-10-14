<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStyleRequest;
use App\Http\Requests\UpdateStyleRequest;
use App\Http\Resources\StyleResource;
use App\Models\Style;

class StyleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return StyleResource::collection(Style::all());
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
     * @param  \App\Http\Requests\StoreStyleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStyleRequest $request)
    {
        return Style::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Style  $style
     * @return \Illuminate\Http\Response
     */
    public function show(Style $style)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Style  $style
     * @return \Illuminate\Http\Response
     */
    public function edit(Style $style)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStyleRequest  $request
     * @param  \App\Models\Style  $style
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStyleRequest $request, Style $style)
    {
        return $style->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Style  $style
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Style::destroy($id);
    }
}
