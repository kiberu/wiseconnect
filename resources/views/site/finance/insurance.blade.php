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
      <h4>{{ $heading }}</h4>
      <p class="mg-b-0">All loans per client</p>
    </div>
  </div><!-- d-flex -->

  <div class="br-pagebody">
    <a href="{{ route('loans.create') }}" class="btn btn-info btn-block mg-b-10 wd-15p ln_align_right ln_color_white">Add new loan</a>

    <div class="br-section-wrapper">
      <table class="table display responsive nowrap">
        <thead>
          <tr>
            <th>#</th>
            <th>Client</th>
            <th>Loan Type</th>
            <th>Insurance Fee</th>
            <th>Created at</th>
            <th>Manage</th>
          </tr>
        </thead>
        <tbody>
          @foreach ( $loans as $loan )
            @php
              $today = Carbon::today();
              $due = Carbon::parse( $loan->created_at );

            @endphp
            <tr class="{{ ( Carbon::today()->equalTo( Carbon::parse( $loan->created_at ) ) )  ? 'today-bg' : '' }}">
              <td>{{ $loan->id }}</td>
              <td><a href="{{ route('clients.show', [ $loan->client->groups->last(), $loan->client ]) }}">{{ $loan->client->first_name }} {{ $loan->client->last_name }}</a></td>
              <td>{{ $loan->loan_type->name }}</td>
              <td>{{ number_format($loan->insurance_fee) }} UGX</td>
              <td>{{ $loan->created_at }}</td>
              <td><a href="{{ route('loans.show', $loan) }}" class="btn btn-success">Manage</a></td>
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
