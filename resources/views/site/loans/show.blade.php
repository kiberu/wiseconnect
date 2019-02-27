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
    <div class="br-section-wrapper">
      <div class="row mg-t-20">
        <div class="col-xl-3"></div>
        <div class="col-xl-9">
          <h2>Client</h2>
          <strong>Client:</strong> {{ $loan->client->first_name }} {{ $loan->client->last_name }} <br>
          <strong>Client's group:</strong> {{ $loan->client->groups->last()->name }} <br>
          <hr>
          <h2>Loan</h2>
          <strong>Duration:</strong> {{ $loan->duration }}<br>
          <strong>Period:</strong> {{ $loan->interval }}(s)<br>
          <strong>Grace Period:</strong> {{ $loan->grace_period }}<br>
          <strong>Interest Rate:</strong> {{ $loan->interest_rate }}<br>
          <strong>No of installments:</strong> {{ $loan->duration }}<br>
          <strong>Principle:</strong> {{ number_format($loan->principle) }} UGX<br>
          <strong>Interest:</strong> {{ number_format(($loan->principle * $loan->interest_rate / 100) * $loan->duration ) }} UGX<br>
          @php
            $pricinple = $loan->principle;
            $interest = ($loan->principle * $loan->interest_rate / 100) * $loan->duration;
            $total = $pricinple + $interest;
          @endphp
          <strong>Total Due:</strong> {{ number_format($total) }} UGX<br>
          <strong>Balance: {{ number_format($total - ($loan->installments->sum('amount_paid'))) }}
          <hr>
          <h2>Timelines</h2>
          <strong>Each Installment:</strong> {{ number_format(($loan->principle / $loan->duration) + ($loan->principle * $loan->interest_rate / 100) ) }} (With Interest)<br>
          <strong>Next Due date:</strong> {{ $loan->installments->last() ? $loan->installments->last()->next_due_date: 'Pleaase make initial deposit' }}<br>

        </div>
    </div>
    <hr>
    <a href="{{ route('installments.create', $loan) }}" class="btn btn-success btn-block mg-b-10 wd-15p ln_align_right ln_color_white">Make Installment</a>
    <div class="br-section-wrapper">
      <table id="datatable1" class="table display responsive nowrap">
        <thead>
          <tr>
            <th>#</th>
            <th>Amount Expected</th>
            <th>Amount paid</th>
            <th>Paid on</th>
            <th>Next Due Date</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($loan->installments as $installment)
            <tr>
              <td>{{ $installment->id }}</td>
              <td>{{ number_format(($loan->principle / $loan->duration) + ($loan->principle * $loan->interest_rate / 100) ) }}</td>
              <td>{{ number_format($installment->amount_paid) }}</td>
              <td>{{ $installment->created_at }}</td>
              <td>{{ $installment->next_due_date }}</td>
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
