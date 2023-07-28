<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

use App\Http\Controllers\ViewController as View;

use App\Client as Client;

class ClientController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {  
    }

    public function index()
    {

        $view = new View('home');

        return $view->draw();

    }

    public function getForAdmin(Request $request)
    {
        $clientID = array_get($request, 'client_id');

        return $this->get($clientID);
    }

    public function getForClient()
    {
        $user = Auth::user();

        return $this->get($user->profile->client->id);
    }

    private function get($clientID)
    {
        
        if($clientID == 'all'){
            $clients = Client::all();
        } else {
            $client = Client::where('id', '=', array_get($request, 'client_id'))->first();
        }

        if($client){
            return json_encode(['success' => 'ok', 'msg' => '', 'clients' => $client], JSON_UNESCAPED_UNICODE);
        }

        return json_encode(['success' => 'error', 'msg' => 'There is no client with the id: '.array_get($request, 'client_id')], JSON_UNESCAPED_UNICODE);

    }

    public function delete(Request $request)
    {

        $client = Client::where('id', '=', array_get($request, 'client_id'));

        if($client){

            if($client->delete()){
                return json_encode(['success' => 'ok'], JSON_UNESCAPED_UNICODE);
            }

        }

        return json_encode(['success' => 'error', 'msg' => 'It was not possible to delete the client with the id: '.array_get($request, 'client_id')], JSON_UNESCAPED_UNICODE);

    }

    public function create(Request $request){
                     
        $validator = $this->validatorCreateClient($request);
        
        if (!$validator->passes()){
            return json_encode(['successcreate' => 'error', 'msg' => $validator->errors()], JSON_UNESCAPED_UNICODE);
        }
        
        $client = new Client;
        $client->name = array_get($request, 'name');
        $client->save();
        $relation = \DB::insert('insert into usuarios_clients (usuarios_id, client_id) values (?, ?)', [\Auth::id(), $client->id]);
        

        if($client && $relation){
            return redirect()->back()->with('successcreate', 'ok');
        }

        return json_encode(['successcreate' => 'error', 'msg' => 'There is no client with the id: '.array_get($request, 'client_id')], JSON_UNESCAPED_UNICODE);

    }

    public function editForAdmin(Request $request)
    {

        $validator = $this->validatorEditClient($request, true);

        if (!$validator->passes()){
            return json_encode(['success' => 'error', 'msg' => $validator->errors()], JSON_UNESCAPED_UNICODE);
        }

        return $this->edit(array_get($request, 'client_id'));
        
    }

    public function editForClient()
    {

        $validator = $this->validatorEditClient($request);

        if (!$validator->passes()){
            return json_encode(['success' => 'error', 'msg' => $validator->errors()], JSON_UNESCAPED_UNICODE);
        }
        
        $user = Auth::user();

        return $this->edit($user->profile->client->id);

    }
    
    public function edit(Request $request)
    {   
        
        $validator = $this->validatorEditClient($request);
        if($validator->passes()){
            $id = array_get($request, 'id');
            $client = Client::where('id', '=', $id)->first();
            
            if($client){
            $client->name = array_get($request, 'name', $client->name);
            $client->save();

            return redirect()->back()->with(['successedit' => 'ok']);
            }
        }
        return redirect()->back()->with(['successedit' => 'error']);
    }

    private function validatorCreateClient($data)
    {
        return Validator::make($data->all(), [
            'name' => 'required|min:3|max:30|string',
        ]);

    }

    private function validatorEditClient($data)
    {
        $validatorRules = [
            'id' => 'required|string|max:4',
            'name' => 'required|min:3|max:30|string',
        ];
        return Validator::make($data->all(), $validatorRules);
    }
    public function changePerms($perm, $user_id, $client_id){
        $client = \DB::table('usuarios_clients')->where('client_id', $client_id)->where('usuarios_id',$user_id)->first();
        if($client){
           switch ($perm) {
                case 'crear':
                    if($client->crear == 0){
                        if(\DB::table('usuarios_clients')->where('client_id', $client_id)->where('usuarios_id',$user_id)->update(['crear'=>1])){
                            return ['changeperms'=>'crear=1'];
                        }
                    }else{
                        if(\DB::table('usuarios_clients')->where('client_id', $client_id)->where('usuarios_id',$user_id)->update(['crear'=>0])){
                            return ['changeperms'=>'crear=0'];
                        } 
                    }
                    break;
                case 'borrar':
                    if($client->borrar == 0){
                        if(\DB::table('usuarios_clients')->where('client_id', $client_id)->where('usuarios_id',$user_id)->update(['borrar'=>1])){
                            return ['changeperms'=>'borrar=1'];
                        }
                    }else{
                        if(\DB::table('usuarios_clients')->where('client_id', $client_id)->where('usuarios_id',$user_id)->update(['borrar'=>0])){
                            return ['changeperms'=>'borrar=0'];
                        } 
                    }
                    break;
                
                case 'editar':
                if($client->editar == 0){
                    if(\DB::table('usuarios_clients')->where('client_id', $client_id)->where('usuarios_id',$user_id)->update(['editar'=>1])){
                        return ['changeperms'=>'editar=1'];
                    }
                }else{
                    if(\DB::table('usuarios_clients')->where('client_id', $client_id)->where('usuarios_id',$user_id)->update(['editar'=>0])){
                        return ['changeperms'=>'editar=0'];
                    } 
                }
                    break;
                default:
                   return ['changeperms'=>'Algo no ha ido bien'];
                break;
           }
        }else{
            return ['changeperms'=>'No se ha encontrado el cliente'];
        }
    }
}
