<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Client as Client;
use App\Establishment as Establishment;
use App\ClienteleVisitEstablishment;
class Clientele extends Model
{
    protected $table = 'clientele';

    public function gender(){
        return $this->belongsTo('App\Gender');
    }

    public function visits(){
            return $this->belongsToMany('App\Establishment', 'clientele_visit_establishments','clientele_id','establishment_id');
    }

}
