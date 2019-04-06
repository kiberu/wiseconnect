<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loans\Loan;
use Carbon\Carbon;
use App\Models\Loans\Installment;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      $this->update_loans();
      return view('home');
    }

    private function update_loans(){
      // update loan data
      // get all active loans
      $loans = Loan::where( 'status', 'Active' )->orWhere( 'status', 'Defaulting' )->get();

      // get due date of last installment
      foreach ( $loans  as $loan ) {
        $last_installment = $loan->installments->last();
        // check if today is after due date
        $due_date = Carbon::parse( $last_installment->due_date );
        if ( $due_date->isPast() && ! $due_date->isCurrentDay() ) {
          // then create new installment if true
          $installment = new Installment;
          $installment->loan_id = $loan->id;
          $installment->expected_amount = $loan->partial_amount;
          $installment->due_date = Carbon::parse('next ' . $loan->payment_day );
          $installment->status = 'Pending';
          $installment->balance = $loan->partial_amount;
          $installment->save();

          // if the installment is not zero, add defaulter flag to the loan
          if ( $loan->installments->where( 'status', 'Pending' ) ) {
            $loan->status = "Defaulting";
            $loan->update();
          }
        }
      }
    }
}
