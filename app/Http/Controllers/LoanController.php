<?php

namespace App\Http\Controllers;

use App\Models\Loans\Loan;
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
      $loans = Loan::all();
      return view('site/loans/index')->withLoans($loans);
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
      return view('site/loans/create')->with(['business_types' => $business_types, 'loan_types' => $loan_types]);
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
        'principle_amount' => 'required|max:255',
        'interest_rate' => 'required|max:255',
        'penalty' => 'required|max:255',
        'grace_period' => 'required|max:255',
        'duration' => 'required|max:255',
        'business_name' => 'required',
        'business_type' => 'required',
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
      $loan->business_name= $request->business_name;
      $loan->status= 'Grace';
      $loan->save();

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
      $due = new Carbon($loan->created_at);
      switch ($loan->interval) {
        case 'Day':
          $carbon_nterval = CarbonInterval::days($loan->grace_period);
          break;
        case 'Week':
          $carbon_nterval = CarbonInterval::weeks($loan->grace_period);
          break;
        case 'Month':
          $carbon_nterval = CarbonInterval::months($loan->grace_period);
          break;
          case 'Quarter':
            $carbon_nterval = CarbonInterval::quarters($loan->grace_period);
            break;
        case 'Year':
          $carbon_nterval = CarbonInterval::years($loan->grace_period);
          break;
        default:
          $carbon_nterval = CarbonInterval::days($loan->grace_period);
          break;
      }
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
