<?php

namespace App\Models\Clients;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
  //
  public function group(){
    return $this->hasMany('App\Models\Clients\Client');
  }
}
