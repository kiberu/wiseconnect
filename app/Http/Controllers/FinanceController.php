<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loans\Loan;
use App\Models\Loans\Payment;


class FinanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:manage-finance');
    }

    public function index()
    {
        return view('site/finance/index');
    }

    public function cash()
    {
        return view('site/finance/cash');
    }

    public function payments()
    {
        $loans = Loan::all();
        return view('site/loans/installments/payments/index')->withPayments($loans);
    }

    public function insurance()
    {
        $loans = Loan::where('status', 'Active')->get()->sortByDesc('created_at');
        $heading = "Insurance Fees";
        return view('site/finance/insurance')->with(['loans' =>$loans, 'heading' => $heading]);
    }

    public function application()
    {
        $loans = Loan::where('status', 'Active')->get()->sortByDesc('created_at');
        $heading = "Application Fees";
        return view('site/finance/application')->with(['loans' =>$loans, 'heading' => $heading]);
    }
}
