<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClienteleDevice extends Model
{
    protected $table = 'clientele_devices';

    public function clientele()
    {
        return $this->belongsTo('App\Clientele', 'last_proprietor');
    }

}
