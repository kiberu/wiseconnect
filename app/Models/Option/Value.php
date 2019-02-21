<?php

namespace App\Models\Options;

use Illuminate\Database\Eloquent\Model;

class Value extends Model
{
  //
  public function option(){
    return $this->belongsTo('App\Models\Options\Option');
  }
}
