<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessType extends Model
{
    //
    public function loans()
    {
        return $this->hasMany('App\Models\Loans\Loan');
    }
}
