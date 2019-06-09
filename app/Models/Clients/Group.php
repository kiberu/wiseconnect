<?php

namespace App\Models\Clients;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
  use SoftDeletes;
  
    public function clients()
    {
        return $this->belongsToMany('App\Models\Clients\Client');
    }

    public function loans()
    {
        return $this->hasManyThrough('App\Models\Loans\Loan', 'App\Models\Clients\Client');
    }

    //
    public function user()
    {
        return $this-belongsTo('App\Models\User');
    }
}
