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
      @if ( Session::has('success'))
        <div class="alert alert-success" role="alert">
          {{ Session::get('success')}}
        </div>
      @endif

      @if ( Session::has('error'))
        <div class="alert alert-danger" role="alert">
          {{ Session::get('error')}}
        </div>
      @endif

      @if (count($errors) > 0)
        <div class="alert alert-danger" role="alert">
          @foreach ($errors->all() as $error)
            <ul>
              <li>{{ $error }}</li>
            </ul>
          @endforeach
        </div>
      @endif

      <div class="row">
        <div class="col">
          <h2>Business Types</h2>
          <form method="POST" action="{{ route('businesstypes.store') }}">
            @csrf
            <input type="text" name="businessTypeName" placeholder="business type">
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
              @foreach ($businessTypes as $bType)
                <tr>
                  <td>{{ $bType->id }}</td>
                  <td>{{ $bType->name }}</td>
                  <td>
                    <form method="POST" action="{{ route('businesstypes.destroy', $bType ) }}">
                      @csrf
                      <input type="submit" value="Delete" class="btn btn-danger js-delete-business-type">
                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="col">
          <h2>Loan Types</h2>
          @if ( ! isset($lType) )
            <form method="POST" action="{{ route('loantypes.store') }}">
              @csrf
              <input class="form-control {{ $errors->has('loanTypeName') ? ' is-invalid' : '' }}" value="{{ old('loanTypeName') }}" type="text" name="loanTypeName" placeholder="Loan Type">
              @if ($errors->has('loanTypeName'))
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('loanTypeName') }}</strong>
                  </span>
              @endif
              <input class="form-control {{ $errors->has('loanTypeInterest') ? ' is-invalid' : '' }}" value="{{ old('loanTypeInterest') }}" type="number" name="loanTypeInterest" placeholder="Interest Rate">
              @if ($errors->has('loanTypeInterest'))
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('loanTypeInterest') }}</strong>
                  </span>
              @endif
              <input class="form-control {{ $errors->has('loanTypeInsurance') ? ' is-invalid' : '' }}" value="{{ old('loanTypeInsurance') }}" type="number" name="loanTypeInsurance" placeholder="Insurance fee">
              @if ($errors->has('loanTypeInsurance'))
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('loanTypeInsurance') }}</strong>
                  </span>
              @endif
              <input class="form-control {{ $errors->has('loanTypeOther') ? ' is-invalid' : '' }}" value="{{ old('loanTypeOther') }}" type="number" name="loanTypeOther" placeholder="Other Fees">
              @if ($errors->has('loanTypeOther'))
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('loanTypeOther') }}</strong>
                  </span>
              @endif
              <input type="submit" value="Add">
            </form>
          @endif
          @if ( isset($lType) )
            <form method="POST" action="{{ route('loantypes.update', $lType) }}">
              @csrf
              <input class="form-control {{ $errors->has('loanTypeName') ? ' is-invalid' : '' }}" value="{{ $lType->name }}" type="text" name="loanTypeName" placeholder="Loan Type">
              @if ($errors->has('loanTypeName'))
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('loanTypeName') }}</strong>
                  </span>
              @endif
              <input class="form-control {{ $errors->has('loanTypeInterest') ? ' is-invalid' : '' }}" value="{{ $lType->interest_rate }}" type="number" name="loanTypeInterest" placeholder="Interest Rate">
              @if ($errors->has('loanTypeInterest'))
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('loanTypeInterest') }}</strong>
                  </span>
              @endif
              <input class="form-control {{ $errors->has('loanTypeInsurance') ? ' is-invalid' : '' }}" value="{{ $lType->insurance_fee }}" type="number" name="loanTypeInsurance" placeholder="Insurance fee">
              @if ($errors->has('loanTypeInsurance'))
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('loanTypeInsurance') }}</strong>
                  </span>
              @endif
              <input class="form-control {{ $errors->has('loanTypeOther') ? ' is-invalid' : '' }}" value="{{ $lType->other_fee }}" type="number" name="loanTypeOther" placeholder="Other Fees">
              @if ($errors->has('loanTypeOther'))
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('loanTypeOther') }}</strong>
                  </span>
              @endif
              <input class="form-control {{ $errors->has('loanTypeGrace') ? ' is-invalid' : '' }}" value="{{ $lType->other_fee }}" type="number" name="loanTypeGrace" placeholder="Grace Period">
              @if ($errors->has('loanTypeGrace'))
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('loanTypeGrace') }}</strong>
                  </span>
              @endif
              <input type="submit" value="Edit">
            </form>
          @endif
          <table class="table responsive">
            <thead>
              <tr>
                <th>#</th>
                <th>Type</th>
                <th>Interest Rate</th>
                <th>Insurance Fee</th>
                <th>Other Fee</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($loanTypes as $key => $loanType)
                <tr>
                  <td>{{ $loanType->id }}</td>
                  <td>{{ $loanType->name }}</td>
                  <td>{{ $loanType->interest_rate }}</td>
                  <td>{{ $loanType->insurance_fee }}</td>
                  <td>{{ $loanType->other_fee }}</td>
                  <td><a class="btn btn-success" href="{{ route( 'loantypes.edit', $loanType ) }}"> Edit </a></td>
                  <td>
                    <form method="POST" action="{{ route('loantypes.destroy', $loanType ) }}">
                      @csrf
                      <input type="submit" value="Delete" class="btn btn-danger js-delete-loan-type">
                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div><!-- br-pagebody -->
  @include('partials._footer')
  <div id="dialog-confirm" title="Delete this item?">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>Are you sure you want to delete? This can not be reversed</p>
  </div>
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
  $(".js-delete-business-type").on('click', function(e) {
    var thisForm = $( this ).closest("form");
      $( "#dialog-confirm" ).dialog({
      resizable: false,
      height: "auto",
      width: 400,
      modal: true,
      buttons: {
        "Continue": function() {
          $( this ).dialog( "close" );
          thisForm.submit();
          console.log(thisForm);
        },
        Cancel: function() {
          $( this ).dialog( "close" );
          return false;
        }
      }
    });

    return false;
  });

  $(".js-delete-loan-type").on('click', function(e) {
    var thisForm = $( this ).closest("form");
      $( "#dialog-confirm" ).dialog({
      resizable: false,
      height: "auto",
      width: 400,
      modal: true,
      buttons: {
        "Continue": function() {
          $( this ).dialog( "close" );
          thisForm.submit();
          console.log(thisForm);
        },
        Cancel: function() {
          $( this ).dialog( "close" );
          return false;
        }
      }
    });

    return false;
  });
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
