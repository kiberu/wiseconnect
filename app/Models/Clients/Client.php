<?php

namespace App\Models\Clients;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //
    public function groups(){
      return $this->belongsToMany('App\Models\Clients\Group');
    }

    //
    public function business_type(){
      return $this->belongsTo('App\Models\BusinessType');
    }

    //
    public function loans(){
      return $this->hasMany('App\Models\Loans\Loan');
    }


}
