@extends('layouts.app')

@section('content')

<div class="br-mainpanel">
  <div class="br-pageheader">
    <nav class="breadcrumb pd-0 mg-0 tx-12">
      <a class="breadcrumb-item" href="{{route('home')}}">Home</a>
      <a class="breadcrumb-item" href="{{route('loans.index')}}">Loans</a>
      <span class="breadcrumb-item active">Loan #{{ $loan->id }}</span>
    </nav>
  </div><!-- br-pageheader -->
  <div class="br-pagetitle">
    <i class="icon icon ion-ios-color-filter-outline tx-22"></i>
    <div>
      <h4>Loan #{{ $loan->id }}</h4>
      <p class="mg-b-0">Assigned to {{ $loan->client->first_name }} {{ $loan->client->last_name }}</p>
    </div>
  </div><!-- d-flex -->

  <div class="br-pagebody">
    <div class="br-section-wrapper info-section">
      <div class="row mg-t-20">
        <div class="col-xl-3"></div>
        <div class="alert alert-danger js-ajax-response-error" role="alert" style="display: none;">
        </div>
        <div class="alert alert-success js-ajax-response-success" role="alert" style="display: none;">
        </div>

        @if ( Session::has('success'))
          <div class="alert alert-success" role="alert">
            {{ Session::get('success')}}
          </div>
        @endif
        <div class="col-xl-9">
          <h2>Client Information</h2>
          <table class="table">
              <tr>
                <th>Client Name</th>
                <td>{{ $loan->client->first_name }} {{ $loan->client->last_name }}</td>
              </tr>
              <tr>
                <th>Group</th>
                <td>{{ isset( $loan->client->groups->last()->name ) ? $loan->client->groups->last()->name : 'None' }}</td>
              </tr>
              <tr>
                <th>Date Of Birth</th>
                <td>{{ $loan->client->date_of_birth }}</td>
              </tr>
              <tr>
                <th>Sex</th>
                <td>{{ $loan->client->sex }}</td>
              </tr>
              <tr>
                <th>Next of kin</th>
                <td>{{ $loan->client->next_of_kin }}</td>
              </tr>
              <tr>
                <th>NIN Number</th>
                <td>{{ $loan->client->NIN }}</td>
              </tr>
              <tr>
                <th>Residential Address</th>
                <td>{{ $loan->client->residential_address }}</td>
              </tr>
              <tr>
                <th>Loan Type</th>
                <td>{{ $loan->loan_type->name }}</td>
              </tr>

              <tr>
                <th>Loan Type details</th>
                <td>{{  $loan->other_details }}</td>
              </tr>

              <tr>
                <th>Business Type</th>
                <td>{{ $loan->business_type->name }}</td>
              </tr>

              <tr>
                <th>Business Location</th>
                <td>{{ $loan->business_location }}</td>
              </tr>

              <tr>
                <th>Business Details</th>
                <td>{{ $loan->business_details }}</td>
              </tr>

              <tr>
                <th>Collateral</th>
                <td>{{ $loan->collateral }}</td>
              </tr>

              <tr>
                <th>Guaranters</th>
                <td>{{ $loan->guaranters }}</td>
              </tr>

              <tr>
                <th>Loan Officer</th>
                <td>{{ $loan->loan_officer() }}</td>
              </tr>
          </table>

        </div>
      </div>
    </div>
    <div class="br-section-wrapper info-section">
      <div class="row mg-t-20">
        <div class="col-xl-3"></div>
        <div class="col-xl-9">
          <h2>Loan Information</h2>
          <hr>
          @if ( $loan->status === 'Pending' )
            @if ( Auth::user()->hasRole( 'branch_manager' ) )
              <a href="{{ route('loans.approve', $loan ) }}">Approve Loan</a>
            @endif
          @endif

          @if ( $loan->status === 'Approved' )
            @if ( Auth::user()->hasRole( 'loan_officer' ) )
              <a href="{{ route('loans.confirm', $loan ) }}">Disburse Loan</a>
            @endif
          @endif

          @if ( $loan->status === 'Confirmed' )
            @if ( Auth::user()->hasRole( 'branch_manager' ) )
              <a href="{{ route('loans.activate', $loan ) }}">Activate Loan</a>
            @endif
          @endif

          <table class="table">
            @if ( $loan->status === 'Pending' )
              <tr>
                <th>Status</th>
                <td><span id="js-status" style="color: green"> {{ $loan->status }}<br></span></td>
              </tr>
              <tr>
                <th>Loan amount</th>
                <td>{{ number_format($loan->principle) }} UGX</td>
              </tr>

            @elseif ( $loan->status === 'Approved' )

              <tr>
                <th>Status</th>
                <td><span id="js-status" style="color: green"> {{ $loan->status }}<br></span></td>
              </tr>
              <tr>
                <th>Loan amount</th>
                <td>{{ number_format($loan->principle) }} UGX</td>
              </tr>
              <tr>
                <th>Loan period</th>
                <td>{{ $loan->duration + $loan->loan_type->grace_period }} Weeks</td>
              </tr>
              <tr>
                <th>Grace Period</th>
                <td>{{ $loan->loan_type->grace_period }} Weeks</td>
              </tr>
            @elseif ( $loan->status === 'Confirmed' )
              <tr>
                <th>Status</th>
                <td><span id="js-status" style="color: green"> {{ $loan->status }}<br></span></td>
              </tr>
              <tr>
                <th>Loan amount</th>
                <td>{{ number_format($loan->principle) }} UGX</td>
              </tr>
              <tr>
                <th>Loan period</th>
                <td>{{ $loan->duration + $loan->loan_type->grace_period }} Weeks</td>
              </tr>
              <tr>
                <th>Payment Day</th>
                <td>{{ isset( $loan->client->groups->last()->name ) ? $loan->client->groups->last()->payment_day : $loan->payment_day }}</td>
              </tr>

              <tr>
                <th>Grace Period</th>
                <td>{{ $loan->loan_type->grace_period }} Weeks</td>
              </tr>
            @elseif ($loan->status === 'Active')
              <tr>
                <th>Status</th>
                <td><span id="js-status" style="color: green"> {{ $loan->status }}<br></span></td>
              </tr>
              <tr>
                <th>Loan amount</th>
                <td>{{ number_format($loan->principle) }} UGX</td>
              </tr>

              <tr>
                <th>Loan period</th>
                <td>{{ $loan->duration + $loan->loan_type->grace_period }} Weeks</td>
              </tr>
              <tr>
                <th>Installment amount</th>
                <td>{{ number_format($loan->latest_installment->expected_amount) }} UGX</td>
              </tr>
              <tr>
                <th>First installment date</th>
                <td>{{ $loan->installments->first()->due_date }}</td>
              </tr>
              <tr>
                <th>Last installment date</th>
                <td>{{  $loan->last_installment_date() }}</td>
              </tr>

              @if (Auth::user()->hasRole('general_manager'))
                <tr>
                  <th>Paid amount so far</th>
                  <td>{{ $loan->total_paid() }}</td>
                </tr>

                <tr>
                  <th>Interest Rates</th>
                  <td>{{  $loan->loan_type->interest_rate }}</td>
                </tr>

                <tr>
                  <th>Interest Earnings per installment(total)</th>
                  <td>{{ number_format($loan->interest_amount()) }} ( {{ number_format($loan->total_interest_amount()) }}) UGX</td>
                </tr>

                <tr>
                  <th>Insurance Fee</th>
                  <td>{{  number_format($loan->loan_type->insurance_fee) }}</td>
                </tr>

                <tr>
                  <th>Other fees</th>
                  <td>{{  number_format($loan->loan_type->other_fee) }}</td>
                </tr>

                <tr>
                  <th>Grace Period</th>
                  <td>{{ $loan->loan_type->grace_period }} Weeks</td>
                </tr>
              @endif
            @endif

          </table>
        </div>
      </div>
    </div>
    @if ( $loan->status === 'Active' )
    <div class="br-section-wrapper info-section">
      <table id="datatable1" class="table display responsive nowrap">
        <thead>
          <tr>
            <th>#</th>
            <th>Amount Expected</th>
            <th>Next Due Date</th>
            <th>Installment Balance</th>
            <th>Outstanding Balance</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          @php
            $current_balance = $loan->total_due();
          @endphp
          @foreach ($loan->installments as $installment)
            @php
              $current_balance -= $installment->payments->sum('amount');
            @endphp
            <tr>
              <td>{{ $installment->id }}</td>
              <td>{{ number_format($installment->expected_amount) }} UGX</td>
              <td>{{ $installment->due_date }}</td>
              <td>{{ number_format($installment->balance) }} UGX</td>
              <td>{{ number_format( $current_balance )}} UGX</td>
              <td>{{ $installment->status }}</td>
              @if ( Auth::user()->hasRole( 'branch_manager' ) )
                <td><a href="{{ route( 'installments.show', [$loan, $installment] ) }}" class="btn btn-success ln_color_white">Payments</a></td>
              @endif
            </tr>

          @endforeach

        </tbody>
      </table>
    </div>
    @endif

  </div><!-- br-pagebody -->
  @include('partials._footer')
</div><!-- br-mainpanel -->

@endsection

@section('scripts')
  <script src="{{asset('lib/jquery/jquery.min.js' ) }}"></script>
  <script src="{{asset('lib/jquery-ui/ui/widgets/datepicker.js' ) }}"></script>
  <script src="{{asset('lib/bootstrap/js/bootstrap.bundle.min.js' ) }}"></script>
  <script src="{{asset('lib/perfect-scrollbar/perfect-scrollbar.min.js' ) }}"></script>
  <script src="{{asset('lib/moment/min/moment.min.js' ) }}"></script>
  <script src="{{asset('lib/peity/jquery.peity.min.js' ) }}"></script>
  <script src="{{asset('lib/highlightjs/highlight.pack.min.js' ) }}"></script>
  <script src="{{asset('lib/select2/js/select2.min.js' ) }}"></script>

  <script src="{{asset('js/bracket.js' ) }}"></script>
  <script>
    $("#js-approve-loan").click( function( event) {
      var loan_id = $("#js-loan-id").html();

      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
      });
      jQuery.ajax({
          url: "{{ url('/approve-loan') }}",
          method: 'get',
          data: {'loan_id' : loan_id},
          success: function(result){
            if ( result.error ) {
              $('.js-ajax-response-error').html(result.error);
              $('.js-ajax-response-error').show();
            }

            if ( result.success ) {
              $('.js-ajax-response-success').html(result.success);
              $('.js-ajax-response-error').hide();
              $('.js-ajax-response-success').show();
              $("#js-approve-loan").html('Approved');
              $("#js-approve-loan").prop('disabled', true);
              $("#js-status").html("Status: Approved");

              console.log( result.success );
            }
          }
        });
    });
  </script>
@endsection
