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
        <div class="col-xl-9">
          <h2>Client Information</h2>
          <hr>
          <h6>Client:</strong> {{ $loan->client->first_name }} {{ $loan->client->last_name }} <br></h6>
          <hr>
          <h6>Client's group:</strong> {{ isset( $loan->client->groups->last()->name ) ? $loan->client->groups->last()->name : 'None' }} <br></h6>
        </div>
      </div>
    </div>
    <div class="br-section-wrapper info-section">
      <div class="row mg-t-20">
        <div class="col-xl-3"></div>
        <div class="col-xl-9">
          <h2>Loan Information</h2>
          <hr>
          <h6><span id="js-status" style="color: green">Status:</strong> {{ $loan->status }}<br></span></h6>
          @if ( $loan->status === 'Pending' )
            @if ( Auth::user()->hasRole( 'branch_manager' ) )
              <button id="js-approve-loan">APPROVE</button>
              <p id="js-loan-id" style="display:none;">{{ $loan->id }}</p>
            @endif
          @endif

          @if ( $loan->status === 'Approved' )
              <a href="{{ route('loans.activate', $loan ) }}">Activate Loan</a>
          @endif
          <hr>
          @if ( $loan->status === 'Active' )
          <h6>Interest Rate:</strong> {{ $loan->interest_rate }}% per Week<br></h6>
          <hr>
          <h6>Loan Duration:</strong> {{ $loan->duration + $loan->grace_period }} Weeks<br></h6>
          <hr>
          <h6>Interest:</strong> {{ number_format(($loan->principle * $loan->interest_rate / 100) * $loan->duration ) }} UGX<br></h6>
          <hr>
          <h6>Insurance Fee:</strong> {{ number_format($loan->insurance_fee) }} UGX<br></h6>
          <hr>
          <h6>Loan Application Fee:</strong> {{ number_format($loan->application_fee) }} UGX<br></h6>
          <hr>
          @endif
          <h6>Principle:</strong> {{ number_format($loan->principle) }} UGX<br></h6>
          <h6>Business</strong> {{ $loan->business_location}}<br></h6>
          <h6>Business Type:</strong> {{ $loan->business_type->name }}<br></h6>
          <hr>

        </div>
      </div>
    </div>
    @if ( $loan->status === 'Active' )
    <div class="br-section-wrapper info-section">
      <div class="row mg-t-20">
        <div class="col-xl-3"></div>
        <div class="col-xl-9">
          <h2>Payments Information</h2>
          <hr>
          <h6>Grace Period:</strong> {{ $loan->grace_period }} Weeks<br></h6>
          <hr>
          <h6>Total Due:</strong> {{ number_format( $loan->total_due() ) }} UGX<br></h6>
          <hr>
          <h6>Balance:</strong> {{ number_format( $loan->balance() )}} UGX
          <hr>
          <h6>Each Installment:</strong> {{ number_format( $loan->partial_amount ) }} UGX (With Interest)<br></h6>
          <hr>
          <h6>Payment Date:</strong> {{ $loan->payment_day }}<br></h6>
        </div>
      </div>
    </div>
    <div class="br-section-wrapper info-section">
      <table id="datatable1" class="table display responsive nowrap">
        <thead>
          <tr>
            <th>#</th>
            <th>Amount Expected</th>
            <th>Next Due Date</th>
            <th>Payments</th>
            <th>Installment Balance</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($loan->installments as $installment)
            <tr>
              <td>{{ $installment->id }}</td>
              <td>{{ number_format($installment->expected_amount) }} UGX</td>
              <td>{{ $installment->due_date }}</td>
              <td><a href="{{ route( 'installments.show', [ $loan, $installment ] ) }}">{{ count( $installment->payments ) }}</a></td>
              <td>{{ number_format($installment->balance) }} UGX</td>
              <td>{{ $installment->status }}</td>
              <td><a href="{{ route( 'installments.show', [$loan, $installment] ) }}" class="btn btn-success ln_color_white">Payments</a></td>
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
