<?php

namespace App\Models\Loans;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;


class Loan extends Model
{
  use SoftDeletes;

    //
    public function client()
    {
        return $this->belongsTo('App\Models\Clients\Client');
    }

    public function client_object()
    {
        return $this->client;
    }

    public function group_name()
    {
        return $this->client->groups->last()->name;
    }


    public function loan_officer()
    {
      $user = \App\Models\User::find( $this->client->user_id );
        return $user->fullName;
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

    public function first_installment()
    {
        return $this->hasOne(Installment::class)->first();
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

    public function total_interest_amount()
    {
        return $this->attributes[ 'principle' ] * ( ( $this->loan_type->interest_rate / 100) * $this->attributes[ 'duration' ] );
    }

    public function interest_amount()
    {
        return $this->attributes[ 'principle' ] * ( ( $this->loan_type->interest_rate / 100) );
    }

    public function last_installment_date( )
    {
      $first = new Carbon($this->first_installment()->due_date);
      $loan_duration = $this->attribute['duration'];
      $loan_grace = $this->loan_type->grace_period;

      $total_weeks = $loan_duration + $loan_grace;

      return $first->addWeeks($total_weeks);
    }
}
