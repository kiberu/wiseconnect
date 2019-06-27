<?php

namespace App\Http\Controllers;

use App\Models\Loans\Loan;
use App\Models\Loans\Installment;
use App\Models\BusinessType;
use App\Models\LoanType;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Session;

use Illuminate\Support\Facades\Auth;


class LoanController extends Controller
{

    public function __construct()
    {
        // $this->middleware('permission:manage-loans');
        $this->middleware('permission:create-loans', ['only' => ['create','edit','store','update','delete']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request )
    {

      $loans = Loan::select('*');
      if ( Auth::user()->hasRole( 'loan_officer' ) ) {
        $loans->whereHas( 'client', function( $c_query ){
          $c_query->where( 'user_id', '=',  Auth::user()->id );
        }  );
      }

      $fields = ['client', 'loan_type', 'group', 'gender', 'business_type', 'status' ];
      if ( $request->has( 'status' ) ) {
        $loans->where( 'status', $request->input( 'status' ) );
      }

      // Search for a user based on their company.
      if ( $request->has( 'loan_type' ) ) {
        $loans->whereHas( 'loan_type', function( $c_query ) use( $request ) {
          $c_query->where( 'name', '=',  $request->loan_type );
        }  );
      }

      // // Search for a user based on their city.
      // if ( $request->has( 'city' ) ) {
      //     $user->where( 'city', $request->input('city') );
      // }

      $heading = "Active Loans";

      // if ( isset( $request->client ) ) {
      //   $client = Client::where( 'fullName', 'like', '%'. $request->client . '%'  )->get();
      // }
      return view('site/loans/index')->with([ 'loans' => $loans->get(), 'heading' => $heading ]);
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
        $payment_days = $this->get_payment_days();
        return view('site/loans/create')->with(['business_types' => $business_types, 'loan_types' => $loan_types, 'payment_days' => $payment_days]);
    }

    public function get_payment_days()
    {
        return array(
        'Monday' => 'Monday',
        'Tuesday' => 'Tuesday',
        'Wednesday' => 'Wednesday',
        'Thursday' => 'Thursday',
        'Friday' => 'Friday',
        'Saturday' => 'Saturday',
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Loan $loan
     * @return \Illuminate\Http\Response
     */
    public function show(Loan $loan)
    {
        return view('site/loans/show')->with(['loan' => $loan]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Loan $loan
     * @return \Illuminate\Http\Response
     */
    public function edit(Loan $loan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Loan         $loan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Loan $loan)
    {
        //
    }

    public function today( Request $request )
    {
        $today = Carbon::now();
        $heading = "Today's Loans List";
        $loans = Loan::where('status', 'Active')->get()->where('latest_installment.due_date', $today->toDateString());
        return view('site/loans/index')->with([ 'loans' => $loans, 'heading' => $heading ]);

    }

    public function defaulters( Request $request )
    {
        $loans = Loan::where('status', '=', 'Defaulting')->get();
        $heading = "Defaulters";
        return view('site/loans/index')->with([ 'loans' => $loans, 'heading' => $heading ]);

    }

    public function completed( Request $request )
    {
        $loans = Loan::where('status', 'Complete')->get()->sortBy('latest_installment.due_date');
        $heading = "Completed Loans";
        return view('site/loans/index')->with([ 'loans' => $loans, 'heading' => $heading ]);
    }

    public function approve( Request $request, Loan $loan )
    {
      return view('site/loans/approve')->with([
        'loan' => $loan,
      ]);

    }


    public function confirm( Request $request, Loan $loan )
    {
      $payment_days = $this->get_payment_days();
      return view('site/loans/confirm')->with([
        'loan' => $loan,
        'payment_days' => $payment_days
      ]);

    }

    public function save_confirmation( Request $request, Loan $loan ){

      $this->validate(
          $request, [
          'payment_day' => 'required',
          'collateral' => 'required',
          ]
      );

      $loan->status = 'Confirmed';
      $loan->collateral = $request->collateral;
      $loan->payment_day = $request->payment_day;
      $loan->save();

      return redirect()->route('loans.show', $loan);

    }

    public function activate( Request $request, Loan $loan ){

      if ( Loan::find($loan->id) == null ) {
         return;
      }

      $loan->status= 'Active';
      $loan->collateral = $request->collateral;
      $loan->update();

      $partial = ( $loan->principle / $loan->duration ) + ( $loan->principle * $loan->loan_type->interest_rate / 100);

      //create installment
      $installment = new Installment;
      $installment->loan_id = $loan->id;
      $installment->expected_amount = $partial;
      $installment->due_date = (($loan->payment_day) !== '') ? Carbon::parse('next ' . $loan->payment_day)->addWeek($loan->loan_type->grace_period) : Carbon::parse('next ' . $loan->client->groups->last()->payment_day)->addWeek($loan->loan_type->grace_period) ;
      $installment->status = 'Pending';
      $installment->balance = $partial;
      $installment->save();

      Session::flash('success', 'This loan has been activated');

      return redirect()->route('loans.show', $loan);

    }

    public function save_approval( Request $request, Loan $loan ){

      $this->validate(
          $request, [
          'principle_amount' => 'required|numeric',
          'interest_rate' => 'required|max:255',
          'grace_period' => 'required|max:255',
          'duration' => 'required|max:255',
          'application_fee' => 'required|numeric',
          'insurance_fee' => 'required|numeric',
          'guaranters' => 'required',
          ]
      );

      $loan->principle = $request->principle_amount;
      $loan->duration = $request->duration;
      $loan->guaranters = $request->guaranters;
      $loan->status= 'Approved';
      $loan->save();

      return redirect()->route('loans.show', $loan);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Loan $loan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Loan $loan)
    {
        //
    }

    public function search( Request $request )
    {
        //
    }
}
