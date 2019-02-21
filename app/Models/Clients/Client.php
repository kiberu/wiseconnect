<?php

namespace App\Models\Clients;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //
    public function group(){
      return $this->belongsTo('App\Models\Clients\Group');
    }

    //
    public function business(){
      return $this->belongsTo('App\Models\Clients\Business');
    }

    //
    public function loans(){
      return $this->hasMany('App\Models\Loans\Loan');
    }
}
