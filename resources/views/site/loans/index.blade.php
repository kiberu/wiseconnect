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
      <h4>Loans</h4>
      <p class="mg-b-0">All loans per client</p>
    </div>
    <div class="btn-right">
      <a class="btn btn-primary" {{ ( ! Auth::user()->hasRole('loan_officer') ) ? 'style=display:none' : '' }} href="{{ route('clients.create') }}" >Add New Apllication</a>
    </div>
  </div><!-- d-flex -->

  <div class="br-pagebody">
    <div class="br-section-wrapper">
      <form method="GET" action="{{ route('loans.index') }}">
        @csrf
        <table>
          <tr>
            <td>Client: </td>
            <td>
              <input name="client" type="text" value="{{ old('client') }}" />
            </td>

            <td>Loan Type</td>
            <td>
              <input name="loan_type" type="text" value="{{ old('loan_type') }}" />
            </td>
            <td>Group</td>
            <td>
              <input name="group" type="text" value="{{ old('group') }}" />
            </td>
          </tr>
          <tr>
            <td>Gender</td>
            <td>
              <input name="gender" type="text" value="{{ old('gender') }}" />
            </td>
            <td>Business Type</td>
            <td>
              <input name="business_type" type="text" value="{{ old('business_type') }}" />
            </td>
            <td>Status</td>
            <td>
              <input name="status" type="text" value="{{ old('status') }}" />
            </td>
          </tr>
          <tr>
            <td>
              <input type="submit" value="Filter" />
            </td>
          </tr>
        </table>
      </form>
      <hr>
      <div class="row table-responsive">
        <table class="table-striped table-hover report-table">
          <thead>
            <tr>
              <th>#</th>
              <th>Client</th>
              <th>Loan Type</th>
              <th>Group</th>
              <th>Gender</th>
              <th>Business Type</th>
              <th>Guaranters</th>
              <th>Principle</th>
              <th>Status</th>
              <th>Created At</th>
            </tr>
          </thead>
          <tbody>
            @foreach ( $loans as $loan )
              <tr class="">
                <td>{{ $loan->id }}</td>
                <td>{{ $loan->client->first_name }} {{ $loan->client->last_name }}</td>
                <td>{{ $loan->loan_type->name }}</td>
                <td>{{ isset( $loan->client->groups->last()->name ) ? $loan->client->groups->last()->name : 'None' }}</td>
                <td>{{ $loan->client->sex }}</td>
                <td>{{ $loan->business_type->name }}</td>
                <td>{{ $loan->guaranters }}</td>
                <td>{{ $loan->principle }}</td>
                <td>{{ $loan->status }}</td>
                <td>{{ $loan->created_at }}</td>
                <td><a href="{{ route('loans.show', $loan) }}" class="btn btn-success">Open</a></td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
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
