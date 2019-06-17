<?php

namespace App\Http\Controllers;

use App\Models\LoanType;
use App\Models\BusinessType;
use Illuminate\Http\Request;
use Session;

class LoanTypeController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate(
          $request, [
            'loanTypeName' => 'required|string|max:255',
            'loanTypeInterest' => 'required|numeric',
            'loanTypeInsurance' => 'required|numeric',
            'loanTypeOther' => 'required|numeric',
            'loanTypeGrace' => 'required|numeric',
          ]
      );


      $type = new LoanType;
      $type->name = $request->loanTypeName;
      $type->interest_rate = $request->loanTypeInterest;
      $type->insurance_fee = $request->loanTypeInsurance;
      $type->other_fee = $request->loanTypeOther;
      $type->grace_period = $request->loanTypeGrace;
      $type->save();

      Session::flash('success', $type->name . ' successfully added');

      return redirect()->route('options.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LoanType $loanType
     * @return \Illuminate\Http\Response
     */
    public function show(LoanType $loanType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LoanType $loanType
     * @return \Illuminate\Http\Response
     */
    public function edit($loanType)
    {
      $lType = LoanType::find($loanType);
      $businessTypes = BusinessType::all();
      $loanTypes = LoanType::all();
      return view('site.options.index')->with(['lType' => $lType, 'businessTypes' => $businessTypes, 'loanTypes' => $loanTypes]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\LoanType     $loanType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LoanType $loanType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LoanType $loanType
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $loanType)
    {
      $type = LoanType::find($loanType);
      if ( $type->delete() ) {
        Session::flash('success', 'Loan Type deleted');
        return redirect()->route('options.index');

      }

      if ( ! $type->delete() ) {
        Session::flash('error', 'Loan Type Not deleted');
        return redirect()->route('options.index');
      }
    }
}
