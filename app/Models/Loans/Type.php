<?php

namespace App\Models\Types;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
  //
  public function loans(){
    return $this->hasMany('App\Models\Loans\Loans');
  }
}
