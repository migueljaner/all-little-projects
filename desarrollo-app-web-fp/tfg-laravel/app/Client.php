<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clients';

    public function service(){
        return $this->belongsTo('App\Service');
    }
    public function crmIntegration(){
        return $this->belongsTo('App\CrmIntegration');
    }
    public function user(){
        return $this->belongsToMany('App\User', 'usuarios_clients','client_id','usuarios_id');
    }
}
