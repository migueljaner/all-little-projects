<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Validator;

use App\Establishment as Establishment;

class EstablishmentController extends Controller
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {  
    }

    public function getForAdmin(Request $request)
    {
    }

    public function getForClient()
    {
        $user = Auth::user();
    }

    private function get($establishmentID)
    {

        $establishment = Establishment::where('id', '=', array_get($request, 'establishment_id'))->first();

        if($establishment){
            return json_encode(['success' => 'ok', 'msg' => '', 'establishment' => $establishment], JSON_UNESCAPED_UNICODE);
        }

        return json_encode(['success' => 'error', 'msg' => 'There is no client with the id: '.array_get($request, 'establishment_id')], JSON_UNESCAPED_UNICODE);

    }

    public function createForAdmin(Request $request)
    {
    }

    public function createForClient()
    {
    }

    public function create(Request $request, $client_id)
    {
        $validator = $this->validatorCreateEstablishment($request);

        if (!$validator->passes()){
            return json_encode(['success' => 'error', 'msg' => $validator->errors()], JSON_UNESCAPED_UNICODE);
        }

        $establishment = new Establishment;
        $establishment->name = array_get($request, 'name');
        $establishment->client_id = $client_id;
            $strguid = $client_id.'/'.date("Y-m-d h:i:s");
        $establishment->guid = md5($strguid).rand(1000, 9999);
        $establishment->categori_id = array_get($request, 'categori_type');
        $establishment->save();

        if($establishment){
            return redirect()->back()->with('successcreate', 'ok');
        }

        return json_encode(['success' => 'error', 'msg' => 'There is no establishment with the id: '.array_get($request, 'establishment_id')], JSON_UNESCAPED_UNICODE);

    }

    public function editForAdmin(Request $request)
    {
    }

    public function editForClient()
    {
        $user = Auth::user();
    }
 
    public function edit(Request $request)
    {
               
        $validator = $this->validatorEditEstablishment($request);
        if($validator->passes()){
            $id = array_get($request, 'id');
            $establishment = Establishment::where('id', '=', $id)->first();
            
            if($establishment){
            $establishment->name = array_get($request, 'name', $establishment->name);
            $establishment->categori_id =array_get($request, 'categori_type', $establishment->categori_type);
            $establishment->save();

            return redirect()->back()->with(['successedit' => 'ok']);
            }
        }
        return redirect()->back()->with(['successedit' => 'error']);
    }

    public function deleteForAdmin(Request $request)
    {
    }

    public function deleteForClient()
    {
        $user = Auth::user();
    }

    public function delete($establishmentid){

        $establishment = Establishment::where('id', '=', $establishmentid)->first();

        if($establishment){
            $c_e_relation = DB::table('clientele_visit_establishments')->where('establishment_id',$establishment->id)->get();
            if($c_e_relation){
                if($c_e_relation->delete()){
                    if($establishment->delete()){
                        return json_encode(['successpermdel' => 'ok'], JSON_UNESCAPED_UNICODE);
                    }
                }
            }
        }
        return json_encode(['successpermdel' => 'error', 'msg' => 'It was not possible to delete the client with the id: '.array_get($request, 'establishment_id')], JSON_UNESCAPED_UNICODE);
    }

    private function validatorCreateEstablishment($data)
    {
        return Validator::make($data->all(), [
            'name' => 'required|min:3|max:30|string',
            'categori_type' => 'required|min:1|string',
        ]);

    }
    private function validatorEditEstablishment($data)
    {
        $validatorRules = [
            'id' => 'required|string|max:4',
            'name' => 'required|min:3|max:30|string',
            'categori_type' => 'required|string|min:1'
        ];
        
        return Validator::make($data->all(), $validatorRules);
    }
}
