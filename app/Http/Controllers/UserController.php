<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Response;

class UserController extends Controller
{

    private $BASE_URL = "http://192.168.2.102:8000/users";

    public function __construct()
    {
        $this->middleware('auth.basic',['only'=>['update']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return response()->json(['status'=>'ok','data'=>User::all()], 200);

    }
 
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {

        // Primero comprobaremos si estamos recibiendo todos los campos.
        if (!$request->input('name') || !$request->input('email') || !$request->input('password'))
        {
            // Se devuelve un array errors con los errores encontrados y cabecera HTTP 422 Unprocessable Entity – [Entidad improcesable] Utilizada para errores de validación.
            // En code podríamos indicar un código de error personalizado de nuestra aplicación si lo deseamos.
            return response()->json(['errors'=>array(['code'=>422,'message'=>'Faltan datos necesarios para el registro.'])],422);
        }
 
        // Insertamos una fila en User con create pasándole todos los datos recibidos.
        // En $request->all() tendremos todos los campos del formulario recibidos.
        $newUser=User::create($request->all());
 
        // Más información sobre respuestas en http://jsonapi.org/format/
        // Devolvemos el código HTTP 201 Created – [Creada] Respuesta a un POST que resulta en una creación. Debería ser combinado con un encabezado Location, apuntando a la ubicación del nuevo recurso.
        $response = Response::make(json_encode(['data'=>$newUser]), 201)->header('Location', $BASE_URL.$newUser->id)->header('Content-Type', 'application/json');
        return $response;
    }
 
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $user=User::find($id);
 
        // Si no existe ese fabricante devolvemos un error.
        if (!$user)
        {
            // Se devuelve un array errors con los errores encontrados y cabecera HTTP 404.
            // En code podríamos indicar un código de error personalizado de nuestra aplicación si lo deseamos.
            return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra un user con ese código.'])],404);
        }
 
        return response()->json(['status'=>'ok','data'=>$user],200);
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        // Primero eliminaremos todos los aviones de un fabricante y luego el fabricante en si mismo.
        // Comprobamos si el fabricante que nos están pasando existe o no.
        $user=User::find($id);
 
        // Si no existe ese fabricante devolvemos un error.
        if (!$user)
        {
            // Se devuelve un array errors con los errores encontrados y cabecera HTTP 404.
            // En code podríamos indicar un código de error personalizado de nuestra aplicación si lo deseamos.
            return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra un usuario con ese código.'])],404);
        }       
 
        // Procedemos por lo tanto a eliminar el fabricante.
        $user->delete();
 
        // Se usa el código 204 No Content – [Sin Contenido] Respuesta a una petición exitosa que no devuelve un body (como una petición DELETE)
        // Este código 204 no devuelve body así que si queremos que se vea el mensaje tendríamos que usar un código de respuesta HTTP 200.
        return response()->json(['code'=>204,'message'=>'Se ha eliminado el usuario correctamente.'],204);
    }

    public function isRegistered($name, $password)
    {
        //$user=User::find($name);
        $user = DB::table('users')->select('*')->where('password', '=', $password)->get();


        if($user)
            return response()->json(['status'=>'ok','data'=>$user],200);

    }

    public function emailUsed($email)
    {
        $user = DB::table('users')->where('email', '=', $email)->get();

        if(!$user)
            return response()->json(['code'=>204,'message'=>'Email libre.'],204);

        return response()->json(['errors'=>array(['code'=>200,'message'=>'El email está siendo usado.'])],200);
        
    }
}