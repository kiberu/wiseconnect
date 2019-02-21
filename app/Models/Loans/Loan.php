<?php

namespace App\Models\Loans;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
  //
  public function client(){
    return $this->belongsTo('App\Models\Clients\Client');
  }

  public function group(){
    return $this->hasOneThrough('App\Models\Clients\Group', 'App\Models\Clients\Client');
  }

  //
  public function type(){
    return $this->belongsTo('App\Models\Loans\Type');
  }

  //
  public function installments(){
    return $this->hasMany('App\Models\Loans\Installment');
  }
}
