@extends('layouts.app')

@section('content')

<div class="br-mainpanel">
  <div class="br-pageheader">
    <nav class="breadcrumb pd-0 mg-0 tx-12">
      <a class="breadcrumb-item" href="{{route('home')}}">Home</a>
      <a class="breadcrumb-item" href="{{route('loans.index')}}">Loans</a>
      <a class="breadcrumb-item" href="{{route('loans.show', $loan)}}">Loan #{{ $loan->id }}</a>
      <span class="breadcrumb-item active">Installment {{ $installment->due_date }}</span>
    </nav>
  </div><!-- br-pageheader -->
  <div class="br-pagetitle">
    <i class="icon icon ion-ios-color-filter-outline tx-22"></i>
    <div>
      <h4>All Payments</h4>
      <p class="mg-b-0">All payments made for installment {{ $installment->due_date }} on loan #{{ $loan->id }}</p>
    </div>
  </div><!-- d-flex -->

  <div class="br-pagebody">
    @if (Auth::user()->hasRole('cashier'))
      <a href="{{ route('payments.create', [$loan, $installment]) }}" class="btn btn-success ln_color_white ln_align_right ln_color_white {{ ( $installment->balance <= 0 ) ? 'hide-link' : '' }}">Add Payment</a>
    @endif
    @php $last_installment = $loan->installments->last(); @endphp
    @php $due_date = Carbon::parse( $last_installment->due_date ); @endphp
    @php $current_date = Carbon::parse( $installment->due_date ); @endphp

    @if ( ! $due_date->greaterThan( $current_date ) && $loan->status != 'Complete' )
      <a href="{{ route('installments.create', $loan) }}" class="btn btn-info ln_color_white ln_align_right ln_color_white {{ ( $installment->balance <= 0 ) ? '' : 'hide-link' }}">Add Next Installment</a>
    @endif

    <div class="br-section-wrapper">
      <p>Total Amount Expected = {{ number_format( $installment->expected_amount ) }} UGX</p>
      <p>Due date = {{ $installment->due_date }}</p>
      <p>Total payment number = {{ count( $installment->payments ) }} Payments</p>
      <p>Total balance = {{ number_format( $installment->balance ) }} UGX</p>
      <p>Installment status = {{ $installment->status }}</p>
    </div>
    <div class="br-section-wrapper">
      <table id="datatable1" class="table display responsive nowrap">
        <thead>
          <tr>
            <th>#</th>
            <th>Amount</th>
            <th>Received By</th>
            <th>Balance</th>
            <th>Created at</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($installment->payments as $payment)
            <tr>
              <td>{{ $payment->id }}</td>
              <td>{{ number_format( $payment->amount ) }} UGX</td>
              <td>{{ $payment->user->FullName }}</td>
              <td>{{ number_format( $payment->current_balance ) }} UGX</td>
              <td>{{ $payment->created_at }}</td>
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
  <script src="{{asset('lib/jquery-ui/ui/widgets/datepicker.js' ) }}"></script>
  <script src="{{asset('lib/bootstrap/js/bootstrap.bundle.min.js' ) }}"></script>
  <script src="{{asset('lib/perfect-scrollbar/perfect-scrollbar.min.js' ) }}"></script>
  <script src="{{asset('lib/moment/min/moment.min.js' ) }}"></script>
  <script src="{{asset('lib/peity/jquery.peity.min.js' ) }}"></script>
  <script src="{{asset('lib/highlightjs/highlight.pack.min.js' ) }}"></script>
  <script src="{{asset('lib/datatables.net/js/jquery.dataTables.min.js' ) }}"></script>
  <script src="{{asset('lib/datatables.net-dt/js/dataTables.dataTables.min.js' ) }}"></script>
  <script src="{{asset('lib/datatables.net-responsive/js/dataTables.responsive.min.js' ) }}"></script>
  <script src="{{asset('lib/datatables.net-responsive-dt/js/responsive.dataTables.min.js' ) }}"></script>
  <script src="{{asset('lib/select2/js/select2.min.js' ) }}"></script>

  <script src="{{asset('js/bracket.js' ) }}"></script>
  <script>
    $(function(){
      'use strict';

      $('#datatable1').DataTable({
        responsive: false,
        language: {
          searchPlaceholder: 'Search...',
          sSearch: '',
          lengthMenu: '_MENU_ items/page',
        }
      });
      // Select2
      $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });

    });
  </script>
@endsection
