<?php

namespace App\Http\Controllers;

use App\Models\Loans\Installment;
use App\Models\Loans\Loan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class InstallmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:manage-loans');
    }
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
        $last_installment = $loan->latest_installment;

        $installment = new Installment;
        $installment->loan_id = $loan->id;
        $installment->expected_amount = $loan->partial_amount;
        $installment->due_date = Carbon::parse($last_installment->due_date)->addWeek(1);
        $installment->status = 'Pending';
        $installment->balance = $loan->partial_amount;
        $installment->save();

        return redirect()->route('loans.show', $loan);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Loan $loan)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Installment $installment
     * @return \Illuminate\Http\Response
     */
    public function show(Loan $loan, Installment $installment)
    {
        return view('site/loans/installments/show')->with(['loan' => $loan, 'installment' => $installment]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Installment $installment
     * @return \Illuminate\Http\Response
     */
    public function edit(Installment $installment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
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
     * @param  \App\Models\Installment $installment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Installment $installment)
    {
        //
    }
}
