<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class UserAnswerUserController extends Controller
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
    public function show($idUserSender,$idUserReceiver)
    {
        //
        return "Mostrando -> Sender: $idUserSender. Receiver: $idUserReceiver";
    }
 
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($idUserSender,$idUserReceiver)
    {
        //
        return "Editando -> Sender: $idUserSender. Receiver: $idUserReceiver";
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
    public function destroy($idUser,$idUser)
    {
        //
    }
}
