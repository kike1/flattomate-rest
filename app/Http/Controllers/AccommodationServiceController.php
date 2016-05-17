<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class AccommodationServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($idAccommodation)
    {
        // Devolverá todos los servicios.
        return "Mostrando los servicios del accommodation con Id $idAccommodation";
    }
 
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($idAccommodation)
    {
        //
        return "Se muestra formulario para crear un avión del accommodation $idAccommodation.";
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
    public function show($idAccommodation,$idService)
    {
        //
        return "Se muestra avión $idService del accommodation $idAccommodation";
    }
 
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($idAccommodation,$idService)
    {
        //
        return "Se muestra formulario para editar el avión $idService del accommodation $idaccommodation";
    }
 
    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($idAccommodation,$idService)
    {
        //
    }
 
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($idAccommodation,$idService)
    {
        //
    }
}
