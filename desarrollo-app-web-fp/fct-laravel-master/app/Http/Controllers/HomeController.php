<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(){
        return view('login');
    }
    public function fbLogin(Request $request){
      $findUser = DB::TABLE("user")->where('email','=', $request->email);
      if ($findUser->first()){
        return response()->json(['response'=>'Usuario Encontrado']);
      }
      else{
        return $this->createUser($request);
      }
    }
    private function createUser(Request $request){
      if(empty(DB::TABLE('user') -> insertGetId(["email" => $request->email,
                                          "firstname" => $request->firstname,
                                          "lastname" => $request->lastname,
                                          "birth"=>$request->birth,
                                          "photo"=>$request->photo]))){
        return response()->json(['response' =>'Usuario Creado']);
      }
    }
}
