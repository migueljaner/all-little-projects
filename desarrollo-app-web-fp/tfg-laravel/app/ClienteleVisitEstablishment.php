<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Client as Client;
use App\Establishment as Establishment;
use App\Clientele as Clientele;
class ClienteleVisitEstablishment extends Model
{
    protected $table = 'clientele_visit_establishments';
}
