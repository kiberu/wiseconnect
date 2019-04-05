<?php

namespace App\Http\Controllers;

use App\Models\Loans\Payment;
use App\Models\Loans\Installment;
use App\Models\Loans\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create( Loan $loan, Installment $installment )
    {
      if ( $installment->balance <= 0 ) {
        return redirect()->route('installments.show', [ $loan, $installment ]);

      }
      return view('site/loans/installments/payments/create')->with(['loan' => $loan, 'installment' => $installment ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Loan $loan, Installment $installment)
    {
      $this->validate( $request, [
        'amount_paid' => 'required|numeric|max:' . $installment->balance,
      ]);

      $new_balance = $installment->balance - $request->amount_paid;

      $payment = new Payment;
      $payment->amount = $request->amount_paid;
      $payment->installment_id = $installment->id;
      $payment->user_id = Auth::user()->id;
      $payment->current_balance = $new_balance;
      $payment->save();


      //change balance and status
      $installment->balance = $new_balance;
      if ( $new_balance != 0 ) {
        $installment->status = 'Partial';
      }

      if ( $new_balance == 0 ) {
        $installment->status = 'Cleared';
      }

      $installment->update();

      $pricinple = $loan->principle;
      $interest = ($loan->principle * $loan->interest_rate / 100) * $loan->duration;
      $total = $pricinple + $interest;

      $loan_balance = $total - $loan->payments->sum( 'amount' );

      if ( ($loan_balance - $request->amount_paid) <= 0 ) {
        $loan->status = 'Complete';
        $loan->save();
      }

      return redirect()->route('installments.show', [$loan, $installment]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
