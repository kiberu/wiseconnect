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
      <h4>Bank Transactions</h4>
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
      <form method="POST" action="{{ route('banks.store') }}">
          @csrf
        <label>Transaction ID</lable><input class="" name="trans_id"/>
          @if ($errors->has('trans_id'))
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('trans_id') }}</strong>
              </span>
          @endif
        <label>Amount</lable><input class="" name="amount"/>
          @if ($errors->has('amount'))
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('amount') }}</strong>
              </span>
          @endif
        <label>Banked By</lable><input class="" name="banked_by"/>
          @if ($errors->has('banked_by'))
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('banked_by') }}</strong>
              </span>
          @endif
        <lable>Type</lable>
          <select name="type" class="{{ $errors->has('type') ? ' is-invalid' : '' }}">
            <option selected disabled>Choose Option</option>
            <option {{ ( old('type') == 'Deposit' ) ? 'selected' : '' }} value="Deposit">Deposit</option>
            <option {{ ( old('type') == 'Withdraw' ) ? 'selected' : '' }} value="Withdraw">Withdraw</option>
            <option {{ ( old('type') == 'Transfer' ) ? 'selected' : '' }} value="Transfer">Transfer</option>
            <option {{ ( old('type') == 'Interest' ) ? 'selected' : '' }} value="Interest">Interest</option>
            <option {{ ( old('type') == 'Commission' ) ? 'selected' : '' }} value="Commission">Commission</option>
            <option {{ ( old('type') == 'Bank_charges' ) ? 'selected' : '' }} value="Bank_charges">Bank_charges</option>

          </select>
          @if ($errors->has('loan_type'))
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('loan_type') }}</strong>
              </span>
          @endif
          <input type="submit" value="submit"/>
      </form>
    </div>
    <div class="br-section-wrapper info-section">
      <table id="datatable1" class="table display responsive nowrap">
        <thead>
          <tr>
            <th>#</th>
            <th>Transaction Id</th>
            <th>Amount</th>
            <th>Type</th>
            <th>Banked By</th>
            <th>Entry By</th>
            <th>Date</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($banks as $bank)
            <tr>
              <td>{{ $bank->id }}</td>
              <td>{{ $bank->transaction_id }}</td>
              <td>{{ $bank->amount }}</td>
              <td>{{ $bank->type }}</td>
              <td>{{ $bank->banked_by }}</td>
              <td>{{ $bank->user->fullName }}</td>
              <td>{{ $bank->created_at }}</td>
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
