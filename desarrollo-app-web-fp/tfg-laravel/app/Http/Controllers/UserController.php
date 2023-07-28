<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;
use Hash;
Use App\User;

class UserController extends Controller{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function config(){
        return view('public.w34-login.userconf');
    }
    
    public function update(Request $request){
        $user = Auth::user();
        $id = $user->id;
        $validate = $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:usuarios,email,'.$id],
        ]);

        $name = $request->input('name');
        $surname = $request->input('surname');
        $email = $request->input('email');

        $user->nombre = $name;
        $user->apellidos = $surname;
        $user->email = $email;

        $user->update();
        
        return redirect()->route('userconf')->with(['updated'=>'1']);
    }
    
    public function changePasword(Request $request){
        if(Auth::Check())
        {
            $request_data = $request->All();
            $validator = $this->admin_credential_rules($request_data);
            if($validator->fails()){
                return redirect()->route('userpwdchange')->with(['changepwd'=>'0']);
                }else{  
                    $current_password = Auth::User()->password;           
                if(Hash::check($request_data['current-password'], $current_password)){           
                    $user_id = Auth::User()->id;                       
                    $obj_user = User::find($user_id);
                    $obj_user->password = Hash::make($request_data['password']);;
                    $obj_user->save(); 
                    return redirect()->route('userpwdchange')->with(['changepwd'=>'1']);
                }else{           
                    return redirect()->route('userpwdchange')->with(['changepwd'=>'0']);   
                }
            }        
        }
        else
        {
            return redirect()->to('/');
        }  
          
    }
    public function admin_credential_rules(array $data){
        $messages = [
            'current-password.required' => 'Please enter current password',
            'password.required' => 'Please enter password',
        ];

        $validator = Validator::make($data, [
            'current-password' => 'required',
            'password' => 'required|same:password',
            'password_confirmation' => 'required|same:password',     
        ], $messages);

        return $validator;
    }  
}
?>