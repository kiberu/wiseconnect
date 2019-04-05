<?php

namespace App\Models\Loans;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
  //
  public function installment(){
    return $this->belongsTo('App\Models\Loans\Installment');
  }

  public function user(){
    return $this->belongsTo('App\Models\User');
  }
}
