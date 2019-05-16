<?php

namespace App\Http\Controllers;

use App\Models\Receivable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ReceivableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $receivables = Receivable::all();
        return view('site/finance/receivables/index')->withReceivables($receivables);
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


        $receivables = new Receivable;
        $receivables->fullname = $request->fullname;
        $receivables->amount = $request->amount;
        $receivables->notes = $request->notes;
        $receivables->status = 'Pending';
        $receivables->user_id = Auth::user()->id;

        $receivables->save();
        return redirect()->route('receivables.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Receivable $receivable
     * @return \Illuminate\Http\Response
     */
    public function show(Receivable $receivable)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Receivable $receivable
     * @return \Illuminate\Http\Response
     */
    public function edit(Receivable $receivable)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Receivable   $receivable
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Receivable $receivable)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Receivable $receivable
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receivable $receivable)
    {
        //
    }
}
