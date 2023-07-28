<?php

namespace App\Http\Controllers;
//Libs
use Illuminate\Http\Request;

//Models
use App\Client as Client;
use App\Establishment as Establishment;
use App\Clientele as Clientele;
use App\User as User;
use App\ClienteleVisitEstablishment;
use App\RelationshipClienteleEstablishment;
use Auth;
use DB;
class HomeController extends Controller
{
    private $request;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function showClients(){        
        if(Auth::check()){ 
            $id = Auth::id();
            if (Auth::user()->isAdmin()) {
                $data = Client::where('eliminado',0)->get();
                
            }else{
                $data = Client::whereHas('user', function($query) use ($id){
                    $query->where('usuarios_clients.usuarios_id','=', $id);
                })->where('eliminado',0)->get();
            } 
            $columns = array(
                'id',
                'name'
            );
            
            $perms= Auth::user()->havePerms(Auth::id());
        }
        return view('public.w34-login.table', ['data'=>$data, 'columns'=>$columns, 'table' =>'Clients', 'perms'=>$perms]);
    }
    public function showdelClients(){        
        if(Auth::check()){ 
            $id = Auth::id();
            if (Auth::user()->isAdmin()) {
                $data = Client::where('eliminado',1)->get();
                
            }else{
                $data = Client::whereHas('user', function($query) use ($id){
                    $query->where('usuarios_clients.usuarios_id','=', $id);
                })->where('eliminado',1)->get();
            } 
            $columns = array(
                'id',
                'name'
            );
            
            $perms= Auth::user()->havePerms(Auth::id());
        }
        return view('public.w34-login.table', ['data'=>$data, 'columns'=>$columns, 'table' =>'Deleted Clients', 'perms'=>$perms]);
    }
    public function showEstablishments($client_id = null){
        if($client_id == null && Auth::user()->isAdmin()){
            $data = Establishment::join('clients','establishments.client_id','=','clients.id')
                    ->join('establishment_categories','establishments.categori_id','=','establishment_categories.id')
                    ->select('establishments.*','clients.name as client_name','establishment_categories.name as categori_type')
                    ->where('establishments.eliminado',0)->get();
                    
        }elseif(!empty($client_id) && Auth::user()->isAdmin()){
            $data = Establishment::join('clients','establishments.client_id','=','clients.id')
                    ->join('establishment_categories','establishments.categori_id','=','establishment_categories.id')
                    ->select('establishments.*','clients.name as client_name','establishment_categories.name as categori_type' )
                    ->where('establishments.client_id', $client_id)
                    ->where('establishments.eliminado',0)->get();
        }
        elseif(!empty($client_id)){
            $data = Establishment::join('clients','establishments.client_id','=','clients.id')
                ->join('establishment_categories','establishments.categori_id','=','establishment_categories.id')
                ->select('establishments.*','clients.name as client_name','establishment_categories.name as categori_type' )
                ->where('establishments.client_id', $client_id)
                ->where('establishments.eliminado',0)->get();
                    
        }
        $columns = array(
            'id',
            'guid',
            'name',
            'client_id',
            'categori_type'
        );
        $perms= Auth::user()->havePerms(Auth::id(), $client_id);
        if(isset($data)){
            return view('public.w34-login.table', ['data'=>$data, 'columns'=>$columns,'perms'=>$perms, 'table'=>'Establishments','client_id'=>$client_id]);
        }else{
            return view('public.w34-login.table', ['columns'=>$columns,'perms'=>$perms, 'table'=>'Establishments','client_id'=>$client_id]);    
        }
        
    }
    public function showdelEstablishments($client_id = null){
        if($client_id == null && Auth::user()->isAdmin()){
            $data = Establishment::join('clients','establishments.client_id','=','clients.id')
                    ->join('establishment_categories','establishments.categori_id','=','establishment_categories.id')
                    ->select('establishments.*','clients.name as client_name','establishment_categories.name as categori_type')
                    ->where('establishments.eliminado',1)->get();
                    
        }elseif(!empty($client_id) && Auth::user()->isAdmin()){
            $data = Establishment::join('clients','establishments.client_id','=','clients.id')
                    ->join('establishment_categories','establishments.categori_id','=','establishment_categories.id')
                    ->select('establishments.*','clients.name as client_name','establishment_categories.name as categori_type' )
                    ->where('establishments.client_id', $client_id)
                    ->where('establishments.eliminado',1)->get();
        }
        elseif(!empty($client_id)){
            $data = Establishment::join('clients','establishments.client_id','=','clients.id')
                ->join('establishment_categories','establishments.categori_id','=','establishment_categories.id')
                ->select('establishments.*','clients.name as client_name','establishment_categories.name as categori_type' )
                ->where('establishments.client_id', $client_id)
                ->where('establishments.eliminado',1)->get();
                    
        }
    
        $columns = array(
            'id',
            'guid',
            'name',
            'client_id',
            'categori_type'
        );
        $perms= Auth::user()->havePerms(Auth::id(), $client_id);
        if(isset($data)){
            return view('public.w34-login.table', ['data'=>$data, 'columns'=>$columns,'perms'=>$perms, 'table'=>'Deleted Establishments','client_id'=>$client_id]);
        }else{
            return view('public.w34-login.table', ['columns'=>$columns,'perms'=>$perms, 'table'=>'Deleted Establishments','client_id'=>$client_id]);    
        }
        
    }
    public function showClientele($establishment_id = null){
        if($establishment_id == null && Auth::user()->isAdmin()){
            $data = Clientele::get();

        }elseif($establishment_id == null && !Auth::user()->isAdmin()){
            $data = null;
        }else{
            $data = Clientele::whereHas('visits', function($query) use ($establishment_id){
                $query->select('clientele_visit_establishments.establishment_id')->where('clientele_visit_establishments.establishment_id','=', $establishment_id);
            })->get();
            if(count($data) > 0){
                $establishment = Establishment::select('client_id')
                                    ->where('id',$establishment_id)
                                    ->first();
                $client_id = $establishment->client_id;
                $perms= Auth::user()->havePerms(Auth::id(), $client_id);
            }
        }
        $columns = array(
            'id',
            'name',
            'surname',
            'email'
        );
        
        if(isset($client_id)){
            return view('public.w34-login.table', ['data'=>$data, 'columns'=>$columns,'perms'=>$perms, 'table'=>'Clientele','client_id'=>$client_id]);
        }else{
            return view('public.w34-login.table', ['data'=>$data, 'columns'=>$columns, 'table'=>'Clientele']);
        }
        
            
    }
    public function delClient($id){
        if(Auth::check()){ 
            if(isset($id)){
                $client = Client::where('id',$id)->first();
                $establishment = Establishment::where('client_id',$id)->get();
                
                if($client->eliminado == 1){
                    if(count($establishment)>0){
                        foreach ($establishment as $singleestash => $value) {
                            $relation1 = ClienteleVisitEstablishment::where('establishment_id',$value->id)->delete();
                            $relation2 = RelationshipClienteleEstablishment::where('establishment_id',$value->id)->delete();
                        }
                        if(Establishment::where('client_id',$id)->delete() && $client->delete()){
                            session(['successdel'=>'ok']);
                            return ['successdel'=>'ok'];
                        }
                    }
                    if(count(DB::table('usuarios_clients')->where('usuarios_clients.client_id','=',$client->id)->get())>0){
                        $relation3 = DB::table('usuarios_clients')->where('usuarios_clients.client_id','=',$client->id)->delete();
                        if($client->delete()){
                            session(['successdel'=>'ok']);
                            return ['successdel'=>'ok'];
                        }
                    }
                    if($client->delete()){
                        session(['successdel'=>'ok']);
                        return ['successdel'=>'ok'];
                    }

                }else{
                    $client->eliminado = 1;
                    if($client->save() && Establishment::where('client_id',$id)->update(['eliminado'=>1])){
                        session(['successdel'=>'ok']);
                        return ['successdel'=>'ok'];
                    }
                }
            }else{
                return ['successdel'=>'error'];
            } 
        }
    }
    public function delEstablishment($id){
        if(Auth::check()){
            if(isset($id)){
                $establishment = Establishment::where('id',$id)->first();
                if($establishment->eliminado == 1){
                    $relation1 = ClienteleVisitEstablishment::where('establishment_id',$id)->delete();
                    $relation2 = RelationshipClienteleEstablishment::where('establishment_id',$id)->delete();
                    if($establishment->delete()){
                        session(['successdel'=>'ok']);
                        return ['successdel'=>'ok'];
                    }
                }else{
                    $establishment->eliminado = 1;
                    if($establishment->save()){
                        session(['successdel'=>'ok']);
                        return ['successdel'=>'ok'];
                    }
                }
            }else{
                return ['successdel'=>'error'];
            }
        }
    }
    public function recoverClient($id){
        if(Auth::check()){
            if(isset($id)){
                $client = Client::where('id',$id)->first();
                if($client){
                    $client->eliminado = 0;
                    if($client->save()){
                        session(['successrecover'=>'ok']);
                        return ['successrecover'=>'ok'];
                    }
                }
            }else{
                return ['successrecover'=>'error'];
            }
        }
    }
    public function recoverEstablishment($id){
        if(Auth::check()){
            if(isset($id)){
                $establishment = Establishment::where('id',$id)->first();
                if($establishment){
                    $establishment->eliminado = 0;
                    if($establishment->save()){
                        session(['successrecover'=>'ok']);
                        return ['successrecover'=>'ok'];
                    }
                }
            }else{
                return ['successrecover'=>'error'];
            }
        }
    }
    public function getUsers(){
        if (Auth::user() -> isAdmin()) {
            $users = User::select('usuarios.id','usuarios.nombre','usuarios.apellidos')
                            /*->where('usuarios.admin','1')*/->get();
            if($users){
                return view('public.w34-login.perms',['data'=>$users]);
            }
        }
    }
    public function getUserClients($userid = null){
        if(Auth::check()){
            if($userid != null){
                $client = Client::join('usuarios_clients', 'clients.id','usuarios_clients.client_id')
                        ->select('clients.id','clients.name','usuarios_clients.crear','usuarios_clients.editar','usuarios_clients.borrar')
                        ->where('usuarios_clients.usuarios_id',$userid)
                        ->get();
                if($client){
                    return $client;
                }
            }else{
                $client = Client::select('id','name')->get();
                if($client){
                    return $client;
                }
            }
        }
    }
    public function addUserPerm($user_id=null, $client_id=null){
        if(Auth::check()){
            $perm = DB::table('usuarios_clients')
                    ->where('usuarios_id',$user_id)
                    ->where('client_id',$client_id)
                    ->first();
            if(!$perm){
                $insertPerm = DB::insert('insert into usuarios_clients (usuarios_id, client_id) values (?, ?)', [$user_id, $client_id]);
                if($insertPerm){
                    $insertedPerm = Client::join('usuarios_clients', 'clients.id','usuarios_clients.client_id')
                    ->select('clients.id','clients.name','usuarios_clients.crear','usuarios_clients.editar','usuarios_clients.borrar')
                    ->where('usuarios_clients.usuarios_id',$user_id)->where('usuarios_clients.client_id',$client_id)
                    ->first();
                    if($insertedPerm){
                        return json_encode($insertedPerm);
                    }
                }
            }
        }
    }
    public function delUserPerm($user_id=null, $client_id=null){
        if(Auth::check()){
            $perm = DB::table('usuarios_clients')
                    ->where('usuarios_id',$user_id)
                    ->where('client_id',$client_id)
                    ->first();
            if($perm){
                $delPerm = DB::table('usuarios_clients')
                    ->where('usuarios_id',$user_id)
                    ->where('client_id',$client_id)
                    ->delete();
                if($delPerm){
                    return json_encode($delPerm);
                }
            }
        }
    }
    
    public function showCatTypes(){
        $data = DB::table('establishment_categories')->get();
        if($data){
            return view('public.w34-login.catqual', ['data'=>$data, 'table'=>'category-types']);
        }
    }
    public function showQualTypes(){
        $data = DB::table('quality_types')->get();
        if($data){
            return view('public.w34-login.catqual', ['data'=>$data, 'table'=>'quality-types']);
        }
    }
    public function addCategoryType(){
        $categoryname = array_get($this->request, 'name');
        $categoryadd = DB::insert('insert into establishment_categories (name) values (?)', [$categoryname]);
        if($categoryadd){
            return redirect()->back()->with('successcreate', 'ok');
        }
    }
    public function editCategoryTypes(){
        $id = $this->request->id;
        $name = $this->request->name;
        if(DB::table('establishment_categories')->find($id)){
            $update = DB::table('establishment_categories')->where('id',$id)->update(['name'=>$name]);
            if($update){
                return redirect()->back()->with('successedit','ok');
            }
            else{
                return redirect()->back()->with('successedit','no');
            }
        }
    }
    public function delCategoryTypes($id, $changefor){
        $clientrelation = Establishment::where('categori_id',$id)->update(['categori_id' => $changefor]);
        $categorydel = DB::table('establishment_categories')->where('id',$id)->delete();
        
        if($categorydel){
            return ['successdelete'=>'ok'];
        }
    }
    public function addQualityType(){
        $qualityname = array_get($this->request, 'name');
        $qualityadd = DB::insert('insert into quality_types (name) values (?)', [$qualityname]);
        if($qualityadd){
            return redirect()->back()->with('successcreate', 'ok');
        }
    }
    public function delQualityTypes($id, $changefor){
        $clientrelation = Establishment::where('type_quality_id',$id)->update(['type_quality_id' => $changefor]);
        $qualitydel = DB::table('quality_types')->where('id',$id)->delete();
        if($qualitydel){
            return ['successdelete'=>'ok'];
        }
    }
    public function editQualityTypes(){
        $id = $this->request->id;
        $name = $this->request->name;
        if(DB::table('quality_types')->find($id)){
            $update = DB::table('quality_types')->where('id',$id)->update(['name'=>$name]);
            if($update){
                return redirect()->back()->with('successedit','ok');
            }
            else{
                return redirect()->back()->with('successedit','no');
            }
        }
    }

    public function showCatTypesAjax(){
        $data = DB::table('establishment_categories')->select('id','name')
                ->get();
        if($data){
            return json_encode($data);
        }
    }
}
