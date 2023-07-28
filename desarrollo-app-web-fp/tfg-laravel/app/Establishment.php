<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Client as Client;
use App\Clientele as Clientele;
use App\ClienteleVisitEstablishment;
class Establishment extends Model
{
    protected $table = 'establishments';
    public function clientele()
    {
        return $this->belongsToMany('App\Clientele', 'clientele_visit_establishments','clientele_id','establishment_id');
    }

}
