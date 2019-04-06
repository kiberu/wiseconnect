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
        <div class="col-xl-9">
          <h2>Client Information</h2>
          <hr>
          <h6>Client:</strong> {{ $loan->client->first_name }} {{ $loan->client->last_name }} <br></h6>
          <hr>
          <h6>Client's group:</strong> {{ $loan->client->groups->last()->name }} <br></h6>
        </div>
      </div>
    </div>
    <div class="br-section-wrapper info-section">
      <div class="row mg-t-20">
        <div class="col-xl-3"></div>
        <div class="col-xl-9">
          <h2>Loan Information</h2>
          <hr>
          <h6>Status:</strong> {{ $loan->status }}<br></h6>
          <hr>
          <h6>Interest Rate:</strong> {{ $loan->interest_rate }}% per Week<br></h6>
          <hr>
          <h6>Loan Duration:</strong> {{ $loan->duration + $loan->grace_period }} Weeks<br></h6>
          <hr>
          <h6>Principle:</strong> {{ number_format($loan->principle) }} UGX<br></h6>
          <hr>
          <h6>Interest:</strong> {{ number_format(($loan->principle * $loan->interest_rate / 100) * $loan->duration ) }} UGX<br></h6>
          <hr>
          <h6>Insurance Fee:</strong> {{ number_format($loan->insurance_fee) }} UGX<br></h6>
          <hr>
          <h6>Loan Application Fee:</strong> {{ number_format($loan->application_fee) }} UGX<br></h6>
        </div>
      </div>
    </div>

    <div class="br-section-wrapper info-section">
      <div class="row mg-t-20">
        <div class="col-xl-3"></div>
        <div class="col-xl-9">
          <h2>Payments Information</h2>
          <hr>
          @php
            $pricinple = $loan->principle;
            $interest = ($loan->principle * $loan->interest_rate / 100) * $loan->duration;
            $total = $pricinple + $interest;
          @endphp
          <h6>Grace Period:</strong> {{ $loan->grace_period }} Weeks<br></h6>
          <hr>
          <h6>Total Due:</strong> {{ number_format($total) }} UGX<br></h6>
          <hr>
          <h6>Balance:</strong> {{ number_format( $total - $loan->payments->sum( 'amount' ) )}} UGX
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
@endsection
