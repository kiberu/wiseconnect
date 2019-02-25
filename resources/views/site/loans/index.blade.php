@extends('layouts.app')

@section('content')

<div class="br-mainpanel">
  <div class="br-pageheader">
    <nav class="breadcrumb pd-0 mg-0 tx-12">
      <a class="breadcrumb-item" href="{{route('home')}}">Home</a>
      <span class="breadcrumb-item active">Loans</span>
    </nav>
  </div><!-- br-pageheader -->
  <div class="br-pagetitle">
    <i class="icon icon ion-ios-color-filter-outline tx-22"></i>
    <div>
      <h4>All Loans</h4>
      <p class="mg-b-0">All loans per client</p>
    </div>
  </div><!-- d-flex -->

  <div class="br-pagebody">
    <div class="br-section-wrapper">
      <table id="datatable1" class="table display responsive nowrap">
        <thead>
          <tr>
            <th>#</th>
            <th>Loan Type</th>
            <th>Principle</th>
            <th>Interest</th>
            <th>Interest Rate</th>
            <th>Duration</th>
            <th>Interval</th>
            <th>Penalty</th>
            <th>Status</th>
            <th>Created at</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($loans as $loan)
            <tr>
              <td>{{ $loan->id }}</td>
              <td>{{ $loan->loan_type->name }}</td>
              <td>{{ number_format($loan->principle) }}</td>
              <td>{{ number_format(($loan->principle * $loan->interest_rate / 100) * $loan->duration )}}  </td>
              <td>{{ $loan->interest_rate }}% per {{ $loan->interval }}</td>
              <td>{{ $loan->duration }}</td>
              <td>{{ $loan->interval }}</td>
              <td>{{ $loan->penalty }} in {{ $loan->penalty_value }} </td>
              <td>{{ $loan->status }}</td>
              <td>{{ $loan->created_at }}</td>

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
