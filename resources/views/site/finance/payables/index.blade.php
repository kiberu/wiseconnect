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
      <h4>Payabkes</h4>
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
      <form method="POST" action="{{ route('payables.store') }}">
          @csrf
          <label>Fullname</lable><input class="" name="fullname"/>
          @if ($errors->has('fullname'))
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('fullname') }}</strong>
              </span>
          @endif

          <label>Amount</lable><input type="number" class="" name="amount"/>
          @if ($errors->has('amount'))
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('amount') }}</strong>
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
            <th>Full Name</th>
            <th>Amount</th>
            <th>User</th>
            <th>Notes</th>
            <th>Status</th>
            <th>Date</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($payables as $payable)
            <tr>
              <td>{{ $payable->id }}</td>
              <td>{{ $payable->fullname }}</td>
              <td>{{ $payable->amount }}</td>
              <td>{{ $payable->user->fullName }}</td>
              <td>{{ $payable->notes }}</td>
              <td>{{ $payable->status }}</td>
              <td>{{ $payable->created_at }}</td>
              <td>@if ( $payable->status == 'Pending')
                <a href="#" class="btn btn-primary">Clear</a></td>
              @endif
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
