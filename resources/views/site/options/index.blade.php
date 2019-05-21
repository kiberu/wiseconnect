@extends('layouts.app')

@section('content')

<div class="br-mainpanel">
  <div class="br-pageheader">
    <nav class="breadcrumb pd-0 mg-0 tx-12">
      <a class="breadcrumb-item" href="{{route('home')}}">Home</a>
      <span class="breadcrumb-item active">Options</span>
    </nav>
  </div><!-- br-pageheader -->
  <div class="br-pagetitle">
    <i class="icon icon ion-ios-color-filter-outline tx-22"></i>
    <div>
      <h4>All Options</h4>
      <p class="mg-b-0">Manage Options</p>
    </div>
  </div><!-- d-flex -->

  <div class="br-pagebody">

    <div class="br-section-wrapper">
      <div class="row">
        <div class="col">
          <h2>Business Types</h2>
          <form method="POST" action="{{ route('businesstypes.store') }}">
            <input type="text" name="businessTypeName">
            <input type="submit" value="Add">
          </form>
          <table class="table responsive">
            <thead>
              <tr>
                <th>#</th>
                <th>Type</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($businessTypes as $key => $businessType)
                <tr>
                  <td>{{ $businessType->id }}</td>
                  <td>{{ $businessType->name }}</td>
                  <td>Delete</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="col">
          <h2>Loan Types</h2>
          <table class="table responsive">
            <thead>
              <tr>
                <th>#</th>
                <th>Type</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($loanTypes as $key => $loanType)
                <tr>
                  <td>{{ $loanType->id }}</td>
                  <td>{{ $loanType->name }}</td>
                  <td>Delete</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
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
