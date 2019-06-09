<?php

namespace App\Models\Loans;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
  use SoftDeletes;
  
    //
    public function installment()
    {
        return $this->belongsTo('App\Models\Loans\Installment');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
