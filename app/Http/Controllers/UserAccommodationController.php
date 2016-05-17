<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class UserAccommodationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($idUser)
    {
        // Devolverá todos los servicios.
        return "Mostrando los servicios del accommodation con Id $idUser";
    }
 
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($idUser)
    {
        //
        return "Se muestra formulario para crear un avión del accommodation $idUser.";
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
    public function show($idUser,$idAccommodation)
    {
        //
        return "Se muestra avión $idAccommodation del accommodation $idUser";
    }
 
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($idUser,$idAccommodation)
    {
        //
        return "Se muestra formulario para editar el avión $idAccommodation del accommodation $idUser";
    }
 
    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($idUser,$idAccommodation)
    {
        //
    }
 
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($idUser,$idAccommodation)
    {
        //
    }
}
