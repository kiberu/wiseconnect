<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loans\Loan;
use App\Models\Clients\Group;
use App\Models\Clients\Client;
use App\Models\Bank;
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
        // $this->update_loans();
        $groups = Group::all();
        $clients = Client::all();
        $loans = Loan::where('status', 'Active')->get();
        $balance = 0;
        if (! empty($loans) ) {
            foreach ($loans as $loan) {
                $balance += $loan->balance();
            }
        }

        $defaulters = Loan::where('status', '=', 'Defaulting')->get();
        $def_balance = 0;

        if (! empty($defaulters) ) {
            foreach ($defaulters as $defaulter) {
                $def_balance += $loan->balance();
            }
        }

        $today = Carbon::now();
        $today_loans = Loan::where('status', 'Active')->get()->where('latest_installment.due_date', $today->toDateString());
        $today_balance = 0;
        $paid_total = 0;
        if (! empty($today_loans) ) {
            foreach ( $today_loans as $today_loan ) {
                $today_balance += $today_loan->installments_balance();
                $paid_total += $today_loan->total_paid();
            }
        }

        $all_loans = Loan::all();
        $banks = Bank::all();

        return view('home')->with(
            [
            'groups' => $groups,
            'clients' => $clients,
            'loans'  => $loans,
            'balance' => $balance,
            'defaulters' => $defaulters,
            'def_balance' => $def_balance,
            'today_loans' => $today_loans,
            'today_balance' => $today_balance,
            'paid_total' => $paid_total,
            'today' => $today,
            'all_loans' => $all_loans,
            'banks' => $banks,
            ] 
        );
    }

    private function update_loans()
    {
        // update loan data
        // get all active loans
        $loans = Loan::where('status', 'Active')->orWhere('status', 'Defaulting')->get();

        // get due date of last installment
        foreach ( $loans  as $loan ) {
            $last_installment = $loan->installments->last();
            // check if today is after due date
            $due_date = Carbon::parse($last_installment->due_date);
            if ($due_date->isPast() && ! $due_date->isCurrentDay() ) {
                // then create new installment if true
                $installment = new Installment;
                $installment->loan_id = $loan->id;
                $installment->expected_amount = $loan->partial_amount;
                $installment->due_date = Carbon::parse('next ' . $loan->payment_day);
                $installment->status = 'Pending';
                $installment->balance = $loan->partial_amount;
                $installment->save();

                // if the installment is not zero, add defaulter flag to the loan
                if ($loan->installments->where('status', 'Pending') ) {
                    $loan->status = "Defaulting";
                    $loan->update();
                }
            }
        }
    }
}
