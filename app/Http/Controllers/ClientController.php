<?php

namespace App\Http\Controllers;

use App\Models\Clients\Client;
use App\Models\Clients\Group;
use App\Models\BusinessType;
use App\Models\LoanType;
use App\Models\Loans\Loan;
use Illuminate\Support\Facades\Auth;



use Illuminate\Http\Request;
use Session;

class ClientController extends Controller
{
    public function __construct()
    {
        // $this->middleware('permission:manage-clients');
        $this->middleware('permission:edit-groups', ['only' => [ 'edit', 'update', 'destroy' ] ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $clients = Client::all();
      if ( Auth::user()->hasRole( 'loan_officer' ) ) {
        $clients = Auth::user()->clients;
      }
      return view('site.clients.index')->with(['clients' => $clients]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create( $group = 0 )
    {
        $groups = Group::all();
        $business_types = BusinessType::all();
        $loan_types = LoanType::all();
        $payment_days = $this->get_payment_days();
        return view('site.clients.create')->with(['group' => $group, 'groups' => $groups, 'business_types' => $business_types, 'loan_types' => $loan_types, 'payment_days' => $payment_days]);;
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
    public function store( Request $request )
    {
        $data = array(
          'first_name' => $request->first_name,
          'last_name' => $request->last_name,
          'gender' => $request->gender,
          'date_of_birth' => $request->date_of_birth,
          'next_of_kin' => $request->next_of_kin,
          'nin_number' => $request->nin_number,
          'phone_number' => $request->phone_number,
          'residential_address' => $request->residential_address,
          'loan_type' => $request->loan_type,
          'principle_amount' => $request->principle_amount,
          'business_location' => $request->business_location,
          'business_type' => $request->business_type,
          'business_details' => $request->business_details,
          'business_type' => $request->business_type,
          'collateral' => $request->collateral,
          'guaranters'  => $request->guaranters,
        );

        $message = $this->validate_application_form( $data );

        if ( $message === true ) {
          $client = new Client;
          $client->first_name = $data['first_name'];
          $client->last_name = $data['last_name'];
          $client->sex = $data['gender'];
          $client->date_of_birth = date('Y-m-d', strtotime($data['date_of_birth']));
          $client->NIN = $data['phone_number'];
          $client->next_of_kin = $data['next_of_kin'];
          $client->phone_number = $data['phone_number'];
          $client->user_id = Auth::user()->id;
          $client->residential_address = $data['residential_address'];
          $client->save();

          if ( ! empty( $request->group )){
            $client->groups()->attach([$request->group]);
          }

          $loan = new Loan;
          $loan->client_id = $client->id;
          $loan->loan_type_id = $data['loan_type'];
          $loan->principle = $data['principle_amount'];
          $loan->business_type_id = $data['business_type'];
          $loan->business_details = $data['business_details'];
          $loan->business_location = $data['business_location'];
          $loan->status= 'Pending';
          $loan->collateral= $data['collateral'];
          $loan->guaranters= $data['guaranters'];
          $loan->other_details= $request->other_details;
          $loan->save();

          return response()->json( ['success' => 'Loan Account has been set for client '] );
        }

        return response()->json( ['error' => $message] );

    }

    public function validate_application_form( $data )
    {
        foreach ($data as $key => $value) {
          if ( empty( $value ) ) {
            return $response = $key . ' is required';
          }

          if ( $key === 'phone_number' && strlen( $value ) < 10  ) {
            return $response = $key . ' should be a minimum of 10 characters';
          }

          if ( $key === 'nin_number' && strlen( $value ) < 12  ) {
            return $response = $key . ' should be a minimum of 12 characters';
          }
        }

        return true;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return view('site/clients/show')->with(['client' => $client]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client $client
     * @return \Illuminate\Http\Response
     */
    public function edit( Client $client)
    {

        return view('site.clients.edit')->with(['client' => $client]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Client       $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        $this->validate(
            $request, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'date_of_birth' => 'date|required|string|max:255',

            'next_of_kin' => 'required|string|max:255',
            'phone_number' => 'required|min:10',
            'residential_address' => 'required|string|max:255',
            ]
        );

        $client->first_name = $request->first_name;
        $client->last_name = $request->last_name;
        $client->sex = $request->gender;
        $client->date_of_birth = date('Y-m-d', strtotime($request->date_of_birth));
        $client->next_of_kin = $request->next_of_kin;
        $client->phone_number = $request->phone_number;
        $client->residential_address = $request->residential_address;
        $client->update();

        // $client->groups()->sync([$group->id]);

        Session::flash('success', $client->first_name . ' ' . $client->last_name . ' has been edited');
        return redirect()->route('clients.show', $client);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client $client
     * @return \Illuminate\Http\Response
     */
    public function destroy( Client $client )
    {
        // // Detach all roles from the user...
        // $client->groups()->detach();
        // // $client->delete();
        // Session::flash('success', $client->first_name . ' ' . $client->last_name . ' has been deleted from ' . $group->name . ' group.' );
        // return redirect()->route('clients.show', $group );
    }
}
