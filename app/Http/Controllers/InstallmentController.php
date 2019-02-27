<?php

namespace App\Http\Controllers;

use App\Models\Loans\Installment;
use App\Models\Loans\Loan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class InstallmentController extends Controller
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
    public function create( Loan $loan )
    {
      return view('site/loans/installments/create')->withLoan($loan);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Loan $loan)
    {
      $this->validate( $request, [
        'amount_paid' => 'required|min:3|max:255',
      ]);


      $installment = new Installment;
      $installment->amount_paid = $request->amount_paid;
      $installment->loan_id = $loan->id;
      if( $loan->installments->last() ){
        $last_payment = new Carbon($loan->installments->last()->next_due_date);
      } else {
        $last_payment = Carbon::now();
      }
      $installment->next_due_date = $last_payment->addMonths(1);
      $installment->save();

      return redirect()->route('loans.show', $loan);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Installment  $installment
     * @return \Illuminate\Http\Response
     */
    public function show(Installment $installment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Installment  $installment
     * @return \Illuminate\Http\Response
     */
    public function edit(Installment $installment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Installment  $installment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Installment $installment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Installment  $installment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Installment $installment)
    {
        //
    }
}
