@extends('layouts.app')

@section('content')

<div class="br-mainpanel">
  <div class="br-pageheader">
    <nav class="breadcrumb pd-0 mg-0 tx-12">
      <a class="breadcrumb-item" href="{{route('home')}}">Home</a>
      <a class="breadcrumb-item" href="{{route('loans.index')}}">Loans</a>
      <span class="breadcrumb-item active">Apply for Loan</span>
    </nav>
  </div><!-- br-pageheader -->
  <div class="br-pagetitle">
    <i class="icon icon ion-ios-color-filter-outline tx-22"></i>
    <div>
      <h4>Loan Application</h4>
      <p class="mg-b-0">Add new loan</p>
    </div>
  </div><!-- d-flex -->

  <div class="br-pagebody">
    <div class="br-section-wrapper">
      <div class="row mg-t-20">
        <div class="col-xl-3"></div>
          <div class="form-layout form-layout-6">
            @if (count($errors) > 0)
              <div class="alert alert-danger" role="alert">
                @foreach ($errors->all() as $error)
                  <ul>
                    <li>{{ $error }}</li>
                  </ul>
                @endforeach
              </div>
            @endif
            <form method="POST" action="{{ route('loans.store') }}">
                @csrf

                  <div class="row no-gutters">
                    <div class="col-5 col-sm-4">
                      Clients Id(*):
                    </div><!-- col-4 -->
                    <div class="col-7 col-sm-8">
                      <input  class="form-control {{ $errors->has('client_id') ? ' is-invalid' : '' }}" value="{{ old('client_id') }}" type="integer" name="client_id"  autofocus>
                      @if ($errors->has('client_id'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('client_id') }}</strong>
                          </span>
                      @endif
                    </div><!-- col-8 -->
                  </div><!-- row -->

                  <div class="row no-gutters">
                    <div class="col-5 col-sm-4">
                      Loan Type(*):
                    </div><!-- col-4 -->
                    <div class="col-7 col-sm-8">
                      <select name="loan_type" class="form-control {{ $errors->has('loan_type') ? ' is-invalid' : '' }}" value="{{ old('loan_type') }}">
                        <option selected disabled>Choose Option</option>
                        @foreach ($loan_types as $loan_type)
                          <option {{ ( old('loan_type') == $loan_type->id ) ? 'selected' : '' }} value="{{ $loan_type->id }}">{{ $loan_type->name }}</option>
                        @endforeach

                      </select>
                      @if ($errors->has('loan_type'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('loan_type') }}</strong>
                          </span>
                      @endif
                    </div><!-- col-8 -->
                  </div><!-- row -->

                  <div class="row no-gutters">
                    <div class="col-5 col-sm-4">
                      Principle Amount(*):
                    </div><!-- col-4 -->
                    <div class="col-7 col-sm-8">
                      <input  class="form-control {{ $errors->has('principle_amount') ? ' is-invalid' : '' }}" value="{{ old('principle_amount') }}" type="integer" name="principle_amount" >
                      @if ($errors->has('principle_amount'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('principle_amount') }}</strong>
                          </span>
                      @endif
                    </div><!-- col-8 -->
                  </div><!-- row -->

                  <div class="row no-gutters">
                    <div class="col-5 col-sm-4">
                      Interest Rate(*):
                    </div><!-- col-4 -->
                    <div class="col-7 col-sm-8">
                      <input  class="form-control {{ $errors->has('interest_rate') ? ' is-invalid' : '' }}" value="{{ old('interest_rate') }}" type="integer" name="interest_rate" > % per Week
                      @if ($errors->has('interest_rate'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('interest_rate') }}</strong>
                          </span>
                      @endif
                    </div><!-- col-8 -->
                  </div><!-- row -->

                  <div class="row no-gutters">
                    <div class="col-5 col-sm-4">
                      Duration(*):
                    </div><!-- col-4 -->
                    <div class="col-7 col-sm-8">
                      <input  class="form-control {{ $errors->has('duration') ? ' is-invalid' : '' }}" value="{{ old('duration') }}" type="integer" name="duration" > Weeks
                      @if ($errors->has('duration'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('duration') }}</strong>
                          </span>
                      @endif
                    </div><!-- col-8 -->
                  </div><!-- row -->

                  <div class="row no-gutters">
                    <div class="col-5 col-sm-4">
                      Penalty(*):
                    </div><!-- col-4 -->
                    <div class="col-7 col-sm-8">
                      <input  class="form-control {{ $errors->has('penalty') ? ' is-invalid' : '' }}" value="{{ old('penalty') }}" type="integer" name="penalty" > % per defaulted Week
                      @if ($errors->has('penalty'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('penalty') }}</strong>
                          </span>
                      @endif
                    </div><!-- col-8 -->
                  </div><!-- row -->

                  <div class="row no-gutters">
                    <div class="col-5 col-sm-4">
                      Grace Period(*):
                    </div><!-- col-4 -->
                    <div class="col-7 col-sm-8">
                      <input  class="form-control {{ $errors->has('grace_period') ? ' is-invalid' : '' }}" value="{{ old('grace_period') }}" type="integer" name="grace_period" > Days
                      @if ($errors->has('grace_period'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('grace_period') }}</strong>
                          </span>
                      @endif
                    </div><!-- col-8 -->
                  </div><!-- row -->

                  <div class="row no-gutters">
                    <div class="col-5 col-sm-4">
                      Business Location:
                    </div><!-- col-4 -->
                    <div class="col-7 col-sm-8">
                      <div class="col-7 col-sm-8">
                        <input  class="form-control {{ $errors->has('business_location') ? ' is-invalid' : '' }}" value="{{ old('business_location') }}" type="text" name="business_location"  placeholder="Enter Business Location">
                        @if ($errors->has('business_location'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('business_location') }}</strong>
                            </span>
                        @endif
                      </div><!-- col-8 -->
                    </div><!-- col-8 -->
                  </div><!-- row -->
                  <div class="row no-gutters">
                    <div class="col-5 col-sm-4">
                      Business Type:
                    </div><!-- col-4 -->
                    <div class="col-7 col-sm-8">
                      <select name="business_type" class="form-control {{ $errors->has('business_type') ? ' is-invalid' : '' }}" value="{{ old('business_type') }}">
                        <option selected disabled>Choose Option</option>
                        @foreach ($business_types as $business_type)
                          <option {{ ( old('business_type') == $business_type->id ) ? 'selected' : '' }} value="{{ $business_type->id }}">{{ $business_type->name }}</option>
                        @endforeach

                      </select>
                      @if ($errors->has('business_type'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('business_type') }}</strong>
                          </span>
                      @endif
                    </div><!-- col-8 -->
                  </div><!-- row -->

                  <div class="row no-gutters">
                    <div class="col-5 col-sm-4">
                      Day of Payment:
                    </div><!-- col-4 -->
                    <div class="col-7 col-sm-8">
                      <select name="payment_day" class="form-control {{ $errors->has('payment_day') ? ' is-invalid' : '' }}" value="{{ old('payment_day') }}">
                        <option selected disabled>Choose Option</option>
                        @foreach ($payment_days as $key => $payment_day)
                          <option {{ ( old('payment_day') == $key ) ? 'selected' : '' }} value="{{ $key }}">{{ $payment_day }}</option>
                        @endforeach

                      </select>
                      @if ($errors->has('payment_day'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('payment_day') }}</strong>
                          </span>
                      @endif
                    </div><!-- col-8 -->
                  </div><!-- row -->

                  <div class="row no-gutters">
                    <div class="col-5 col-sm-4">
                      Application Fee:
                    </div><!-- col-4 -->
                    <div class="col-7 col-sm-8">
                      <div class="col-7 col-sm-8">
                        <input  class="form-control {{ $errors->has('application_fee') ? ' is-invalid' : '' }}" value="{{ old('application_fee') }}" type="text" name="application_fee"  placeholder="Application fee">
                        @if ($errors->has('application_fee'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('application_fee') }}</strong>
                            </span>
                        @endif
                      </div><!-- col-8 -->
                    </div><!-- col-8 -->
                  </div><!-- row -->

                  <div class="row no-gutters">
                    <div class="col-5 col-sm-4">
                      Insurance Fee:
                    </div><!-- col-4 -->
                    <div class="col-7 col-sm-8">
                      <div class="col-7 col-sm-8">
                        <input  class="form-control {{ $errors->has('insurance_fee') ? ' is-invalid' : '' }}" value="{{ old('insurance_fee') }}" type="text" name="insurance_fee"  placeholder="Insurance fee">
                        @if ($errors->has('insurance_fee'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('insurance_fee') }}</strong>
                            </span>
                        @endif
                      </div><!-- col-8 -->
                    </div><!-- col-8 -->
                  </div><!-- row -->

                  <div class="row no-gutters">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-info">
                            {{ __('Save loan') }}
                        </button>
                    </div>
                  </div><!-- row -->


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
