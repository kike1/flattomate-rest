<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Announcement;
use App\Language;
use Response;
use DB;

//require 'vendor/autoload.php';
use Intervention\Image\ImageManagerStatic as Image;

class UserController extends Controller
{

    //private $BASE_URL = "http://192.168.1.130:8000/users";

    public function __construct()
    {
       // $this->middleware('auth.basic',['only'=>['update']]);
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
    // public function store(Request $request)
    // {

        // Primero comprobaremos si estamos recibiendo todos los campos.
        // if (!$request->input('name') || !$request->input('email') || !$request->input('password'))
        // {
        //     // Se devuelve un array errors con los errores encontrados y cabecera HTTP 422 Unprocessable Entity – [Entidad improcesable] Utilizada para errores de validación.
        //     // En code podríamos indicar un código de error personalizado de nuestra aplicación si lo deseamos.
        //     return response()->json(['errors'=>array(['code'=>422,'message'=>'Faltan datos necesarios para el registro.'])],422);
        // }
        
        // //ahora comprobamos si ya existe ese usuario en la BD
        // $user = DB::table('users')->select('*')->where('email', '=', $request->input('email'))->get();
        // if($user)
        //     return response()->json(['errors'=>array(['code'=>423,'message'=>'El usuario ya existe.'])],423);

        // // Insertamos una fila en User con create pasándole todos los datos recibidos.
        // // En $request->all() tendremos todos los campos del formulario recibidos.
        // $user=User::create($request->all());
 
        // // Más información sobre respuestas en http://jsonapi.org/format/
        // // Devolvemos el código HTTP 201 Created – [Creada] Respuesta a un POST que resulta en una creación. Debería ser combinado con un encabezado Location, apuntando a la ubicación del nuevo recurso.
        // $response = Response::make(json_encode(/*['data'=>$user]*/$user), 200)->header('Location', $BASE_URL.$user->id)->header('Content-Type', 'application/json');
        // return $response;

    // -------------------------------------------------------------------

    public function store(Request $request)
    {
        if (!is_array($request->all())) {
            return ['error' => 'request must be an array'];
        }
        // Creamos las reglas de validación
        $rules = [
            'name'      => 'required',
            'email'     => 'required|email',
            'password'  => 'required'
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

            User::create($request->all());
            return ['created' => true];
        } catch (Exception $e) {
            \Log::info('Error creating user: '.$e);
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
        $user = User::findOrFail($id);
        $user->languages = $user->languages;
        return $user;
    }
    
    public function login($email, $password)
    {
        $user = DB::table('users')->select('*')->whereEmailAndPassword($email, $password)->first();

        if($user){
            //$this->error('El usuario existe!');
            return Response::make(json_encode($user), 200)->header('Content-Type', 'application/json');
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
    public function update(Request $request, $id)
    {
        // Primero comprobaremos si estamos recibiendo todos los campos.
        /*if ( !$request->input('name') || !$request->input('email') || 
            !$request->input('password') || !$request->input('birthdate') || 
            !$request->input('avatar') || !$request->input('activity') || 
            !$request->input('sex') || !$request->input('smoke') || 
            !$request->input('sociable') || !$request->input('tidy') || 
            !$request->input('bio'))
        {
            // Se devuelve un array errors con los errores encontrados y cabecera HTTP 422 Unprocessable Entity – [Entidad improcesable] Utilizada para errores de validación.
            return response()->json(['errors'=>array(['code'=>422,'message'=>'Algunos campos no se han recibido.'])],422);
        }

        // Buscamos el usuario.
        $user = User::find($id);

        // Si no existe el user que le hemos pasado mostramos otro código de error de no encontrado.
        if (!$user)
        {
            // Se devuelve un array errors con los errores encontrados y cabecera HTTP 404.
            // En code podríamos indicar un código de error personalizado de nuestra aplicación si lo deseamos.
            return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra un usuario con ese id.'])],404);
        }*/
        // -------------------------------------------------------------------
        

        //$id = $request->input('id');
        $user = User::findOrFail($id);
        if($user->update($request->all()))
            return \Response::json(['updated' => true], 200);
        else
            return \Response::json(['updated' => false], 204);
    }
 
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return ['deleted' => true];
    }

    // function extract_name($el) {
    //     return $el['name'];
    // }
    public function getLanguages($id){
        $user = User::findOrFail($id);
        
        if (!$user)
        {
           return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra un usuario con ese código.'])],404);
        }

        //$languages = array_column($user->languages->toArray(), 'name');  

        //return Response::make(json_encode($user->languages), 200)->header('Content-Type', 'application/json');
        return $user->languages;
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

    public function uploadImageProfile(Request $request){
        
        if ($request->file)
        {
            $image_name = $request->file->getClientOriginalName();
            Image::make($request->file)->fit(300)->save('imgs/'.$image_name);
            
            return \Response::json(['uploaded' => true], 200);    
        }

        return \Response::json(['uploaded' => false], 204);
    }

    public function requestNegotiation($id, $idUserAnnouncement, $idAnnouncement){
        $user = User::findOrFail($id);
        $userAnnouncement = User::findOrFail($idUserAnnouncement);
        //$announcement = Announcement::findOrFail($idAnnouncement);

        if($user->chats->contains($idUserAnnouncement))
            return \Response::json(['request_negotiation' => false], 404); 
        else
            $user->chats()->save($userAnnouncement, ['id_announcement' => $idAnnouncement]);   
        
        return \Response::json(['request_negotiation' => true], 200); 
    }

    public function isRequestedNegotiation($id, $idUserAnnouncement, $idAnnouncement){
        $user = User::findOrFail($id);
        $userAnnouncement = User::findOrFail($idUserAnnouncement);

        if($user->chats->contains($idUserAnnouncement))
            return \Response::json(['requested' => true], 200); 
        else
            return \Response::json(['requested' => false], 404);  
    }

}
