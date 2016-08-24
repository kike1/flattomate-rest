<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class UserLanguageController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($idUser)
    {
        // Devolverá todos los servicios.
        return "Mostrando los language del user $idUser";
    }
 
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($idUser)
    {
        //
        return "Se muestra formulario para crear un language del user $idUser.";
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
     * @param  int  $idUser
     * @return Response
     */
    public function show($idUser)
    {
        $languages = User_Language::find($idUser);
        return "Languages: $languages";
    }
 
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($idUser,$idLanguage)
    {
        //
        return "Editando -> user: $idUserSender. language: $idLanguage";
    }
 
    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($idUser,$idUser)
    {
        //
    }
 
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
}
