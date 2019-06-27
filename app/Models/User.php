<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

use Cache;


class User extends Authenticatable
{
    use Notifiable, HasRoles;
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function payments()
    {
        return $this->hasMany('App\Models\Loans\Payment');
    }

    public function banks()
    {
        return $this->hasMany('App\Models\Bank');
    }

    public function expenditures()
    {
        return $this->hasMany('App\Models\Expenditure');
    }

    public function payables()
    {
        return $this->hasMany('App\Models\Payable');
    }

    public function receivables()
    {
        return $this->hasMany('App\Models\Receivable');
    }

    public function clients()
    {
        return $this->hasMany('App\Models\Clients\Client');
    }

    public function groups()
    {
        return $this->hasMany('App\Models\Clients\Group');
    }

    public function getFullNameAttribute()
    {
        return $this->attributes['first_name'] . ' ' . $this->attributes['last_name'];
    }

    public function isOnline()
    {
        return Cache::has('user-is-online-' . $this->id);
    }

    public function loans()
    {
        return $this->hasManyThrough('App\Models\Loans\Loan', 'App\Models\Clients\Client');
    }
}
