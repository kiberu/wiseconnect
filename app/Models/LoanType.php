<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanType extends Model
{
  //
  public function loans(){
    return $this->hasMany('App\Models\Loans\Loan');
  }
}
