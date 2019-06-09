<?php

namespace App\Models\Loans;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Installment extends Model
{
  use SoftDeletes;
  
    //
    public function loan()
    {
        return $this->belongsTo('App\Models\Loans\Loan');
    }

    public function payments()
    {
        return $this->hasMany('App\Models\Loans\Payment');
    }
}
