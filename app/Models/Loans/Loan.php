<?php

namespace App\Models\Loans;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Loan extends Model
{
  use SoftDeletes;

    //
    public function client()
    {
        return $this->belongsTo('App\Models\Clients\Client');
    }

    public function group()
    {
        return $this->hasOneThrough('App\Models\Clients\Group', 'App\Models\Clients\Client');
    }

    //
    public function business_type()
    {
        return $this->belongsTo('App\Models\BusinessType');
    }

    //
    public function installments()
    {
        return $this->hasMany('App\Models\Loans\Installment');
    }

    //
    public function loan_type()
    {
        return $this->belongsTo('App\Models\LoanType');
    }

    public function payments()
    {
        return $this->hasManyThrough('App\Models\Loans\Payment', 'App\Models\Loans\Installment');
    }

    public function latest_installment()
    {
        return $this->hasOne(Installment::class)->latest();
    }

    public function number_of_installments()
    {
        return $this->installments->count();
    }

    public function unpaid_installments()
    {
      return $this->installments->where( 'status', '==', 'Cleared' );

    }

    public function installments_balance()
    {
        return $this->installments->sum('balance');
    }

    public function total_paid()
    {
        return $this->payments->sum('amount');
    }

    public function balance()
    {
        return $this->total_due() - $this->payments->sum('amount');
    }

    public function total_due()
    {
        return ( $this->interest_amount() + $this->attributes[ 'principle' ] );
    }

    public function interest_amount()
    {
        // return $this->attributes[ 'principle' ] * ( ( $this->attributes[ 'interest_rate' ] / 100) * $this->attributes[ 'duration' ] );
    }
}
