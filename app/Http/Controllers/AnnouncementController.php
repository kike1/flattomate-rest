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
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        if (!is_array($request->all())) {
            return ['error' => 'request must be an array'];
        }
        // Creamos las reglas de validación
        $rules = [
            'title'      => 'required',
            'description'     => 'required',
            'availability'  => 'required',
            'min_stay'  => 'required',
            'max_stay'  => 'required',
            'price'  => 'required',
            'is_shared_room'  => 'required',
            'id_user'  => 'required'
            ];

        try {
            // Ejecutamos el validador y en caso de que falle devolvemos la respuesta
            $validator = \Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return [
                    'created' => false,
                    'errors'  => $validator->errors()->all()
                ];
            }

            Announcement::create($request->all());
            return ['created' => true];
	    //return Response::make(json_encode($ad), 200)->header('Content-Type', 'application/json');

            //return ['created' => true];
        } catch (Exception $e) {
            \Log::info('Error creating announcement: '.$e);
            return \Response::json(['created' => false], 500);
        }
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

    public function uploadAnnouncementImage(Request $request){
        
        if ($request->file)
        {
            $image_name = $request->file->getClientOriginalName();
            Image::make($request->file)->fit(300)->save('announcements/'.$image_name);
            
            return \Response::json(['uploaded' => true], 200);    
        }

        return \Response::json(['uploaded' => false], 204);
    }

    public function last(){
        return $this->announcements()->orderBy('created_at', 'desc')->first();
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
