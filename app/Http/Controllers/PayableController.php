<?php

namespace App\Http\Controllers;

use App\Models\Payable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PayableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( )
    {
        $payables = Payable::all();
        return view('site/finance/payables/index')->withPayables($payables);
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
            'fullname' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'notes' => 'string',
            ]
        );


        $payable = new Payable;
        $payable->fullname = $request->fullname;
        $payable->amount = $request->amount;
        $payable->notes = $request->notes;
        $payable->status = 'Pending';
        $payable->user_id = Auth::user()->id;

        $payable->save();
        return redirect()->route('payables.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payable $payable
     * @return \Illuminate\Http\Response
     */
    public function show(Payable $payable)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payable $payable
     * @return \Illuminate\Http\Response
     */
    public function edit(Payable $payable)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Payable      $payable
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payable $payable)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payable $payable
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payable $payable)
    {
        //
    }
}
