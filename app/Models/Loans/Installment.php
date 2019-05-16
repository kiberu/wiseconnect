<?php

namespace App\Models\Loans;

use Illuminate\Database\Eloquent\Model;

class Installment extends Model
{
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
