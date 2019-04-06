<?php

namespace App\Http\Controllers;

use App\Models\Loans\Loan;
use App\Models\Loans\Installment;
use App\Models\BusinessType;
use App\Models\LoanType;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Carbon\CarbonInterval;

class LoanController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( $status = '' )
    {
      $loans = Loan::where( 'status', 'Active' )->get()->sortBy('latest_installment.due_date');
      $heading = "Active Loans";
      return view('site/loans/index')->with( [ 'loans' => $loans, 'heading' => $heading ] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $business_types = BusinessType::all();
      $loan_types = LoanType::all();
      $payment_days = array(
        'Monday' => 'Monday',
        'Tuesday' => 'Tuesday',
        'Wednesday' => 'Wednesday',
        'Thursday' => 'Thursday',
        'Friday' => 'Friday',
        'Saturday' => 'Saturday',
      );
      return view('site/loans/create')->with(['business_types' => $business_types, 'loan_types' => $loan_types, 'payment_days' => $payment_days]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate( $request, [
        'client_id' => 'required|max:255',
        'loan_type' => 'required|max:255',
        'principle_amount' => 'required|numeric',
        'interest_rate' => 'required|max:255',
        'penalty' => 'required|max:255',
        'grace_period' => 'required|max:255',
        'duration' => 'required|max:255',
        'business_location' => 'required',
        'business_location' => 'required',
        'business_type' => 'required',
        'payment_day' => 'required',
        'application_fee' => 'required|numeric',
        'insurance_fee' => 'required|numeric'
      ]);


      $loan = new Loan;
      $loan->client_id = $request->client_id;
      $loan->loan_type_id = $request->loan_type;
      $loan->principle = $request->principle_amount;
      $loan->interest_rate = $request->interest_rate;
      $loan->grace_period = $request->grace_period;
      $loan->duration = $request->duration;
      $loan->penalty = $request->penalty;
      $loan->business_type_id = $request->business_type;
      $loan->payment_day = $request->payment_day;
      $loan->business_location= $request->business_location;
      $loan->status= 'Active';
      $loan->application_fee = $request->application_fee;
      $loan->insurance_fee = $request->insurance_fee;
      $loan->partial_amount = ( $request->principle_amount / $request->duration ) + ( $request->principle_amount * $request->interest_rate / 100);
      $loan->initial_start = Carbon::parse('next ' . $request->payment_day )->addWeek( $request->grace_period );
      $loan->save();

      //create installment
      $installment = new Installment;
      $installment->loan_id = $loan->id;
      $installment->expected_amount = $loan->partial_amount;
      $installment->due_date = $loan->initial_start;
      $installment->status = 'Pending';
      $installment->balance = $loan->partial_amount;
      $installment->save();

      return redirect()->route('loans.show', $loan);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function show(Loan $loan)
    {
      return view('site/loans/show')->with(['loan' => $loan]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function edit(Loan $loan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Loan $loan)
    {
        //
    }

    public function today( Request $request ){
      $today = Carbon::now();
      $heading = "Today's Loans List";
      $loans = Loan::where( 'status', 'Active' )->get()->where( 'latest_installment.due_date', $today->toDateString() );
      return view('site/loans/index')->with( [ 'loans' => $loans, 'heading' => $heading ] );

    }

    public function defaulters( Request $request ){
      $loans = Loan::where('status', '=', 'Defaulting' )->get();
      $heading = "Defaulters";
      return view('site/loans/index')->with( [ 'loans' => $loans, 'heading' => $heading ] );

    }

    public function completed( Request $request )
    {
      $loans = Loan::where( 'status', 'Complete' )->get()->sortBy('latest_installment.due_date');
      $heading = "Completed Loans";
      return view('site/loans/index')->with( [ 'loans' => $loans, 'heading' => $heading ] );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Loan $loan)
    {
        //
    }
}
