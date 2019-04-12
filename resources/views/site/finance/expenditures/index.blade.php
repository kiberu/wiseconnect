@extends('layouts.app')

@section('content')

<div class="br-mainpanel">
  <div class="br-pageheader">
    <nav class="breadcrumb pd-0 mg-0 tx-12">
      <span class="breadcrumb-item active">Home</span>
    </nav>
  </div><!-- br-pageheader -->
  <div class="br-pagetitle">
    <i class="icon icon ion-ios-bookmarks-outline"></i>
    <div>
      <h4>Expenditures</h4>
      <p class="mg-b-0">{{ Auth::user()->getRoleNames()}}</p>
    </div>
  </div><!-- d-flex -->

  <div class="br-pagebody">
    <div>
      @if (count($errors) > 0)
        <div class="alert alert-danger" role="alert">
          @foreach ($errors->all() as $error)
            <ul>
              <li>{{ $error }}</li>
            </ul>
          @endforeach
        </div>
      @endif
      <form method="POST" action="{{ route('expenditures.store') }}">
          @csrf
          <label>Item Name</lable><input class="" name="item_name"/>
          @if ($errors->has('item_name'))
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('item_name') }}</strong>
              </span>
          @endif

          <label>Amount</lable><input type="number" class="" name="amount"/>
          @if ($errors->has('amount'))
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('amount') }}</strong>
              </span>
          @endif

          <label>Unit Cost</lable><input type="number" class="" name="unit_cost"/>
          @if ($errors->has('unit_cost'))
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('unit_cost') }}</strong>
              </span>
          @endif

          <label>Notes</lable><input class="" name="notes"/>
            @if ($errors->has('notes'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('notes') }}</strong>
                </span>
            @endif

          <input type="submit" value="Add"/>
      </form>
    </div>
    <div class="br-section-wrapper info-section">
      <table id="datatable1" class="table display responsive nowrap">
        <thead>
          <tr>
            <th>#</th>
            <th>Item Name</th>
            <th>Unit Cost</th>
            <th>Amount</th>
            <th>User</th>
            <th>Notes</th>
            <th>Date</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($expenditures as $expenditure)
            <tr>
              <td>{{ $expenditure->id }}</td>
              <td>{{ $expenditure->item_name }}</td>
              <td>{{ $expenditure->unit_cost }}</td>
              <td>{{ $expenditure->amount }}</td>
              <td>{{ $expenditure->user->fullName }}</td>
              <td>{{ $expenditure->notes }}</td>
              <td>{{ $expenditure->created_at }}</td>
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
        responsive: true,
        language: {
          searchPlaceholder: 'Search...',
          sSearch: '',
          lengthMenu: '_MENU_ items/page',
        }
      });

      $('#datatable2').DataTable({
        bLengthChange: false,
        searching: false,
        responsive: true
      });

      // Select2
      $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });

    });
  </script>
@endsection
