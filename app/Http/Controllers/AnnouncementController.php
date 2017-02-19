<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Response;
use App\Announcement;
use App\Image;
use App\Favorite;
use App\Review;
use Illuminate\Support\Facades\Log;
use DB;

use Intervention\Image\ImageManagerStatic as ImageIntervention;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $announcements = Announcement::all();
        foreach($announcements as $ad){
            Log::info("Announcement:" + $ad->id);
            $ad->accommodation = $ad->accommodation;
        }  
        return $announcements;
    }

    public function search($title){
        return Announcement::where('title', 'LIKE', '%'.$title.'%')->get();
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

            $ad = Announcement::create($request->all());
            //return ['created' => true];
	    return Response::make(json_encode($ad), 200)->header('Content-Type', 'application/json');

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
        $ad = Announcement::findOrFail($id);
        $ad->accommodation = $ad->accommodation;

        return $ad;
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

    public function getMainImage($id)
    {
        $ad = Announcement::findOrFail($id)->images->take(1);

        return $ad[0];
    }

    public function getAccommodation($id)
    {
        return Announcement::findOrFail($id)->accommodation;
    }

    public function uploadAnnouncementImage(Request $request, $id){
        
        if ($request->file)
        {
            $image_name = $request->file->getClientOriginalName();
            ImageIntervention::make($request->file)->fit(300)->save('announcements/'.$image_name);
            
	    $image = new Image;
            $image->name = $image_name;
	    $image->id_announcement = $id;
            $image->save();
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

    /**
    * Retrieves reviews from a given announcement
    * @param  int  $idannouncement
    * @return Response
    */
    public function reviews($idannouncement){
        $reviews = Review::where('id_announcement', $idannouncement)->get();

        if($reviews)
            return Response::make(json_encode($reviews), 200)->header('Content-Type', 'application/json');
        else
            return \Response::json(['error' => "This announcement has not reviews"], 404);

    }

    /**
     * Make a review from a given announcement to user
     * @param Request $review
     * @return Response
     */
    public function makeReview(Request $review){

        $newReview = new Review;
        $newReview->id_user_wrote = $review->id_user_wrote;
        $newReview->id_user_receive = $review->id_user_receive;
        $newReview->id_announcement = $review->id_announcement;
        $newReview->description = $review->description;
        $newReview->rating = $review->rating;

        if($newReview->save())
            return \Response::json(['review' => true], 200);
        else
            return \Response::json(['review' => false], 404);

    }

    public function favorite(Request $request){

        $fav = new Favorite;
        if($request->id_announcement != 0 && $request->id_announcement != 0){
            $fav->id_user = $request->id_user;
            $fav->id_announcement = $request->id_announcement;

        }
        if($fav->save())
            return \Response::json(['favorite' => true], 200);
        else
            return \Response::json(['favorite' => false], 404);
    }

    public function isFavorite($ida, $idu){

        $isFavorite = DB::table('favorites')->select('*')->where('id_user', '=', $idu)->where('id_announcement', '=', $ida)->get();
        if($isFavorite)
            return \Response::json(['isFavorite' => true], 200);
        else
            return \Response::json(['isFavorite' => false], 404);
    }
}
