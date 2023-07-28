<?php

namespace App;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    
    protected $table = 'usuarios';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre','apellidos','email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isAdmin(){
        return $this->where('id','=',$this->id)->where('admin','=',1)->exists();
    }
    public function havePerms($user = null, $client_id = null){
        if($user != null){
            $perms = DB::table('usuarios_clients')->where('usuarios_clients.usuarios_id','=',$user)->get();
        }
        if($client_id != null){
            $perms = DB::table('usuarios_clients')->where('usuarios_clients.client_id','=',$client_id)->get();
            
        }
        return $perms;
    }
    public function clients(){
        return $this->belongsToMany('App\Client', 'usuarios_clients','usuarios_id','client_id');
    }
}