<?php

namespace App\Models\Options;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
  //
  public function values(){
    return $this->hasMany('App\Models\Options\Value');
  }
}
