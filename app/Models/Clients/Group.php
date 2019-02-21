<?php

namespace App\Models\Clients;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
  public function clients(){
    return $this->hasMany('App\Models\Clients\Client');
  }

  public function loans(){
    return $this->hasManyThrough('App\Models\Loans\Loan', 'App\Models\Clients\Client');
  }
}
