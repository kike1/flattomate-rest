<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Accommodation;
use Response;

class AccommodationController extends Controller
{

    public function setServices($idaccommodation, $service){
        $accommodation = Accommodation::findOrFail($idaccommodation);

            if(!$accommodation->services->contains($service)){
                $accommodation->services()->save($service);
                return \Response::json(['service_added' => true], 200);
            }else
                return response()->json(['errors'=>array(['code'=>404,'message'=>'Ya tenía ese servicio!'])],404);
    }

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
    public function store(Request $request)
    {
        if (!is_array($request->all())) {
            return ['error' => 'request must be an array'];
        }
        // Creamos las reglas de validación
        $rules = [
            'n_beds'      => 'required',
            'location'     => 'required',
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
	    
	    $accommodation = Accommodation::create($request->all());
            return Response::make(json_encode($accommodation), 200)->header('Content-Type', 'application/json');
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
        return Accommodation::findOrFail($id);
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
