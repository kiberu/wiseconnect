<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessType extends Model
{
  //
  public function clients(){
    return $this->hasMany('App\Models\Clients\Client');
  }
}
