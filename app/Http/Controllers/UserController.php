<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Language;
use Response;
use DB;

class UserController extends Controller
{

    private $BASE_URL = "http://192.168.1.130:8000/users";

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
        return response()->json(['status'=>'ok',User::all()], 200);

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
        
        //ahora comprobamos si ya existe ese usuario en la BD
        $user = DB::table('users')->select('*')->where('email', '=', $request->input('email'))->get();
        if($user)
            return response()->json(['errors'=>array(['code'=>423,'message'=>'El usuario ya existe.'])],423);

        // Insertamos una fila en User con create pasándole todos los datos recibidos.
        // En $request->all() tendremos todos los campos del formulario recibidos.
        $user=User::create($request->all());
 
        // Más información sobre respuestas en http://jsonapi.org/format/
        // Devolvemos el código HTTP 201 Created – [Creada] Respuesta a un POST que resulta en una creación. Debería ser combinado con un encabezado Location, apuntando a la ubicación del nuevo recurso.
        $response = Response::make(json_encode(/*['data'=>$user]*/$user), 200)->header('Location', $BASE_URL.$user->id)->header('Content-Type', 'application/json');
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
 
        // Si no existe ese usuario devolvemos un error.
        if (!$user)
        {
            // Se devuelve un array errors con los errores encontrados y cabecera HTTP 404.
            // En code podríamos indicar un código de error personalizado de nuestra aplicación si lo deseamos.
            return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra un user con ese código.'])],404);
        }
 
        return $response = Response::make(json_encode($user), 200)->header('Content-Type', 'application/json');

    }
    
    public function login($email, $password)
    {
        $user = DB::table('users')->select('*')->whereEmailAndPassword($email, $password)->first();

        if($user){
            //$this->error('El usuario existe!');
            $response = Response::make(json_encode($user), 200)->header('Content-Type', 'application/json');
            return $response;
        }else{
            //$this->error('El usuario NO existe');
            return response()->json(['errors'=>array(['code'=>401,'message'=>'Usuario o contraseña incorrectos.'])],401);
        }

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
 
        // Procedemos por lo tanto a eliminar el usuario.
        $user->delete();
 
        // Se usa el código 204 No Content – [Sin Contenido] Respuesta a una petición exitosa que no devuelve un body (como una petición DELETE)
        // Este código 204 no devuelve body así que si queremos que se vea el mensaje tendríamos que usar un código de respuesta HTTP 200.
        return response()->json(['code'=>204,'message'=>'Se ha eliminado el usuario correctamente.'],204);
    }

    // function extract_name($el) {
    //     return $el['name'];
    // }
    public function getLanguages($id){
         $user = User::find($id);
        
        if (!$user)
        {
           return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra un usuario con ese código.'])],404);
        }

        //$languages = array_column($user->languages->toArray(), 'name');  

        return Response::make(json_encode($user->languages), 200)->header('Content-Type', 'application/json');

        // $languages = array_map(array($this, "extract_name"), $user->languages->toArray());
        // return Response::make(json_encode($languages), 200)->header('Content-Type', 'application/json');

    }

    public function setLanguage($id, $language){
        $user = User::find($id);
        $lang = Language::find($language);
        
        if (!$user)
        {
           return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra un usuario con ese código.'])],404);
        }

        if(!$user->languages->contains($lang)){
            $user->languages()->save($lang);

            return Response::make(json_encode($user->languages), 200)->header('Content-Type', 'application/json');

        }else
            return response()->json(['errors'=>array(['code'=>404,'message'=>'Ya tenías ese idioma antes!'])],404);
    }

    public function removeLanguage($id, $language){
        $user = User::find($id);
        $lang = Language::find($language);
        
        if (!$user)
        {
           return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra un usuario con ese código.'])],404);
        }

        //if user has language associated, desaciociate it
        if($user->languages->contains($lang)){
            
            $user->languages()->detach($lang);
            return Response::make(json_encode($user->languages), 200)->header('Content-Type', 'application/json');


        }else
            return response()->json(['errors'=>array(['code'=>404,'message'=>'No tenias ese idioma asociado!'])],404);
    }

}
