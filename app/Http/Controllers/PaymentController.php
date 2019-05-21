<?php

namespace App\Http\Controllers;

use App\Models\Loans\Payment;
use App\Models\Loans\Installment;
use App\Models\Loans\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( )
    {
        $payments =  Payment::all()->sortByDesc('created_at');
        return view('site/loans/installments/payments/index')->withPayments($payments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create( Loan $loan, Installment $installment )
    {
        return view('site/loans/installments/payments/create')->with(['loan' => $loan, 'installment' => $installment ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Loan $loan, Installment $installment)
    {
      $this->validate(
          $request, [
          'amount_paid' => 'required|numeric',
          ]
      );

      //if paid amount is less than expected_amount
      if ( $request->amount_paid < $installment->balance ) {
        $new_balance = $installment->balance - $request->amount_paid;

        $payment = new Payment;
        $payment->amount = $request->amount_paid;
        $payment->installment_id = $installment->id;
        $payment->user_id = Auth::user()->id;
        $payment->current_balance = $new_balance;
        $payment->save();

        $installment->status = 'Partial';
        $installment->update();
      }

      //if paid amount is greater than expected_amount
      if ( $request->amount_paid >= $installment->balance ) {
        $new_balance = 0;
        $payment = new Payment;
        $payment->amount = $installment->expected_amount;
        $payment->installment_id = $installment->id;
        $payment->user_id = Auth::user()->id;
        $payment->current_balance = $new_balance;
        $payment->save();

        $installment->status = 'Cleared';
        $installment->balance = 0;
        $installment->update();

        $excess = $request->amount_paid - $installment->expected_amount;
        $times_paid = floor( $excess/$installment->expected_amount );
        for ( $i=0; $i < $times_paid + 1; $i++) {

          $new_installment = new Installment;
          $new_installment->loan_id = $loan->id;
          $new_installment->expected_amount = $loan->latest_installment->expected_amount;
          $new_installment->due_date = Carbon::parse('next ' . $loan->payment_day)->addWeek(1);
          $new_installment->status = 'Cleared';
          $new_installment->balance = $loan->latest_installment->expected_amount;
          $new_installment->save();


          $excess -= $loan->latest_installment->expected_amount;

          if ( $excess < $installment->expected_amount && $excess !== 0 ) {
            $new_installment->status = 'Partial';
            $new_installment->balance = $loan->latest_installment->expected_amount - $excess;
            $new_installment->save();

            //save payment
            $payment = new Payment;
            $payment->amount = $excess;
            $payment->installment_id = $new_installment->id;
            $payment->user_id = Auth::user()->id;
            $payment->current_balance = $loan->latest_installment->expected_amount - $excess;
            $payment->save();

            break;
          }

          if ( $excess === 0 ) {
            break;
          }
          
          //save payment
          $payment = new Payment;
          $payment->amount = $loan->latest_installment->expected_amount;
          $payment->installment_id = $new_installment->id;
          $payment->user_id = Auth::user()->id;
          $payment->current_balance = 0;
          $payment->save();

        }

      }


      $pricinple = $loan->principle;
      $interest = ($loan->principle * $loan->interest_rate / 100) * $loan->duration;
      $total = $pricinple + $interest;

      $loan_balance = $total - $loan->payments->sum('amount');

      if (($loan_balance - $request->amount_paid) <= 0 ) {
          $loan->status = 'Complete';
          $loan->save();
      }

      return redirect()->route('loans.show', $loan);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Payment $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Payment $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Payment             $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payment $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
