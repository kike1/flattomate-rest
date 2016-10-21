<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Response;
use App\Announcement;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }
 
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }
 
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
    }
 
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return Announcement::findOrFail($id);
    }
    
    public function getUser($id)
    {
        $ad = Announcement::find($id);
        
        if (!$ad)
        {
           return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra un anuncio con ese código.'])],404);
        }

        //$languages = array_column($user->languages->toArray(), 'name');  

        return Response::make(json_encode($ad->user), 200)->header('Content-Type', 'application/json');

        //return Announcement::findOrFail($id)->user();
    }

    public function getServices($id)
    {
        return Announcement::findOrFail($id)->accommodation->services;
    }

    public function getImages($id)
    {
        return Announcement::findOrFail($id)->images;
    }

    public function getAccommodation($id)
    {
        return Announcement::findOrFail($id)->accommodation;
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }
 
    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }
 
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
