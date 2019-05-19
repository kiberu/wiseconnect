@extends('layouts.app')

@section('content')

<div class="br-mainpanel">
  <div class="br-pageheader">
    <nav class="breadcrumb pd-0 mg-0 tx-12">
      <a class="breadcrumb-item" href="{{route('home')}}">Home</a>
      <a class="breadcrumb-item" href="{{route('loans.show', $loan )}}">Loan</a>
      <a class="breadcrumb-item" href="{{route('installments.show', [$loan, $installment] )}}">{{ $installment->due_date }}</a>
      <span class="breadcrumb-item active">Payment</span>
    </nav>
  </div><!-- br-pageheader -->
  <div class="br-pagetitle">
    <i class="icon icon ion-ios-color-filter-outline tx-22"></i>
    <div>
      <h4>Make payment</h4>
      <p class="mg-b-0">Add payment to installment {{ $installment->due_date  }}</p>
    </div>
  </div><!-- d-flex -->

  <div class="br-pagebody">
    <div class="br-section-wrapper">
      <div class="row mg-t-20">
        <div class="col-xl-3"></div>
          <div class="form-layout form-layout-5">

            <form method="POST" action="{{ route('payments.store', [$loan, $installment] ) }}">
                @csrf

                <div class="form-layout form-layout-2">
                  <div class="row no-gutters">
                    <div class="col-md-12 mg-t--1 mg-md-t-0">
                      <div class="form-group">
                        <label class="form-control-label">Amount Paid <span class="tx-danger">*</span></label>
                        <input class="form-control {{ $errors->has('amount_paid') ? ' is-invalid' : '' }}" type="integer" name="amount_paid" value="{{ old('amount_paid') }}" autofocus>
                        @if ($errors->has('amount_paid'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('amount_paid') }}</strong>
                            </span>
                        @endif
                      </div>
                    </div><!-- col-12 -->

                    <div class="col-md-12 mg-t--1 mg-md-t-0">
                      <div class="form-group mg-md-l--1">
                        <button type="submit" class="btn btn-info">
                            {{ __('Save') }}
                        </button>
                      </div>
                    </div><!-- col-12 -->

                </div><!-- form-layout -->
            </form>

          </div><!-- form-layout -->
        <div class="col-xl-3"></div>
      </div><!-- row -->
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
