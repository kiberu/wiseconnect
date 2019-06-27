<?php

namespace App\Models\Clients;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
  use SoftDeletes;

    //
    public function groups()
    {
        return $this->belongsToMany('App\Models\Clients\Group');
    }

    //
    public function loans()
    {
        return $this->hasMany('App\Models\Loans\Loan');
    }

    //
    public function user()
    {
        return $this-belongsTo('App\Models\User');
    }

    public function getFullNameAttribute()
    {
        return $this->attributes['first_name'] . ' ' . $this->attributes['last_name'];
    }


}
