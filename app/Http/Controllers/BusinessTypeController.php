<?php

namespace App\Http\Controllers;

use App\Models\BusinessType;
use Illuminate\Http\Request;
use Session;

class BusinessTypeController extends Controller
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
          'businessTypeName' => 'required|string|max:255',
          ]
      );


      $type = new BusinessType;
      $type->name = $request->businessTypeName;
      $type->save();

      return redirect()->route('options.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BusinessType $businessType
     * @return \Illuminate\Http\Response
     */
    public function show(BusinessType $businessType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BusinessType $businessType
     * @return \Illuminate\Http\Response
     */
    public function edit(BusinessType $businessType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\BusinessType $businessType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BusinessType $businessType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BusinessType $businessType
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $bType)
    {
      $type = BusinessType::find($bType);
      if ( $type->delete() ) {
        Session::flash('success', 'Business Type deleted');
        return redirect()->route('options.index');

      }

      if ( ! $type->delete() ) {
        Session::flash('error', 'Business Type Not deleted');
        return redirect()->route('options.index');
      }

    }
}
