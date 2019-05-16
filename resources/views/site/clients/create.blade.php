@extends('layouts.app')

@section('content')

<div class="br-mainpanel">
  <div class="br-pageheader">
    <nav class="breadcrumb pd-0 mg-0 tx-12">
      <a class="breadcrumb-item" href="{{route('home')}}">Home</a>
      <span class="breadcrumb-item active">New Application</span>
    </nav>
  </div><!-- br-pageheader -->
  <div class="br-pagetitle">
    <i class="icon icon ion-ios-briefcase-outline tx-22"></i>
    <div>
      <h4>Add new application</h4>
      <p class="mg-b-0">Enter new applicant's data</p>
    </div>
  </div><!-- d-flex -->

  <div class="br-pagebody">
    <div class="br-section-wrapper">
      <div class="row mg-t-20">
        <div class="col-xl-3"></div>
        <div class="col-xl-6 mg-t-20 mg-xl-t-0">
          <form method="POST" id="apllication-form">
              @csrf
              <div id="wizard2">
            <h3>Personal Information</h3>
            <section>
              <div class="form-group wd-xs-300">
                <label class="form-control-label">First name: <span class="tx-danger">*</span></label>
                <input id="first_name" class="form-control {{ $errors->has('first_name') ? ' is-invalid' : '' }}" value="{{ old('first_name') }}" type="text" name="first_name" required  placeholder="Enter client's first name" autofocus>
                @if ($errors->has('first_name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('first_name') }}</strong>
                    </span>
                @endif
              </div><!-- form-group -->
              <div class="form-group wd-xs-300">
                <label class="form-control-label">Last name: <span class="tx-danger">*</span></label>
                <input id="last_name" class="form-control {{ $errors->has('last_name') ? ' is-invalid' : '' }}" value="{{ old('last_name') }}" type="text" name="last_name"  required placeholder="Enter client's last name">
                @if ($errors->has('last_name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('last_name') }}</strong>
                    </span>
                @endif
              </div><!-- form-group -->
              <div class="form-group wd-xs-300">
                <label class="form-control-label">Gender: <span class="tx-danger">*</span></label>
                <select id="gender" name="gender" class="form-control {{ $errors->has('gender') ? ' is-invalid' : '' }}" value="{{ old('gender') }}">
                  <option selected disabled>Choose Option</option>
                  <option {{ ( old('gender') == 'Male') ? 'selected' : '' }} value="Male">Male</option>
                  <option {{ ( old('gender') == 'Female' ) ? 'selected' : '' }} value="Female">Female</option>
                </select>
                @if ($errors->has('gender'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('gender') }}</strong>
                    </span>
                @endif
              </div><!-- form-group -->
              <div class="form-group wd-xs-300">
                <label class="form-control-label">Date of birth: <span class="tx-danger">*</span></label>
                <input id="date_of_birth" type="text" name="date_of_birth" class="form-control fc-datepicker {{ $errors->has('date_of_birth') ? ' is-invalid' : '' }}" value="{{ old('date_of_birth') }}"  required placeholder="MM/DD/YYYY"
                >
                @if ($errors->has('date_of_birth'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('date_of_birth') }}</strong>
                    </span>
                @endif
              </div><!-- form-group -->
              <div class="form-group wd-xs-300">
                <label class="form-control-label">Next of kin: <span class="tx-danger">*</span></label>
                <input id="next_of_kin" class="form-control {{ $errors->has('next_of_kin') ? ' is-invalid' : '' }}" value="{{ old('next_of_kin') }}" type="text" name="next_of_kin"  required placeholder="Name, relationship, phone">
                @if ($errors->has('next_of_kin'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('next_of_kin') }}</strong>
                    </span>
                @endif
              </div><!-- form-group -->
              <div class="form-group wd-xs-300">
                <label class="form-control-label">Phone number: <span class="tx-danger">*</span></label>
                <input id="phone_number" class="form-control {{ $errors->has('phone_number') ? ' is-invalid' : '' }}" value="{{ old('phone_number') }}" type="number" name="phone_number"  required placeholder="Enter phone number">
                @if ($errors->has('phone_number'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('phone_number') }}</strong>
                    </span>
                @endif
              </div><!-- form-group -->
              <div class="form-group wd-xs-300">
                <label class="form-control-label">Residential Address: <span class="tx-danger">*</span></label>
                <input id="residential_address" class="form-control {{ $errors->has('residential_address') ? ' is-invalid' : '' }}" value="{{ old('residential_address') }}" type="text" name="residential_address"  required placeholder="Enter Residential Address">
                @if ($errors->has('residential_address'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('residential_address') }}</strong>
                    </span>
                @endif
              </div><!-- form-group -->
              <div class="form-group wd-xs-300">
                <label class="form-control-label">NIN number: <span class="tx-danger">*</span></label>
                <input id="nin_number" class="form-control {{ $errors->has('nin_number') ? ' is-invalid' : '' }}" value="{{ old('nin_number') }}" type="text" name="nin_number"  required placeholder="Enter Residential Address">
                @if ($errors->has('nin_number'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('nin_number') }}</strong>
                    </span>
                @endif
              </div><!-- form-group -->
              <div class="form-group wd-xs-300">
                <label class="form-control-label">Guaranters: <span class="tx-danger">*</span></label>
                <textarea id="guaranters" cols="10" rows="10" class="form-control {{ $errors->has('guaranters') ? ' is-invalid' : '' }}" value="{{ old('guaranters') }}" type="text" name="guaranters"  required placeholder="Name, phone, nin"></textarea>
                @if ($errors->has('guaranters'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('guaranters') }}</strong>
                    </span>
                @endif
              </div><!-- form-group -->
            </section>
            <h3>Loan Application</h3>
            <section>
              <div class="form-group wd-xs-300">
                <label>Loan Type:  <span class="tx-danger">*</span></label>
                <select id="loan_type" name="loan_type" class="form-control {{ $errors->has('loan_type') ? ' is-invalid' : '' }}" value="{{ old('loan_type') }}">
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
              </div><!-- form-group -->
              <div class="form-group wd-xs-300">
                <label>Principle Amount:  <span class="tx-danger">*</span></label>
                <input  id="principle_amount" class="form-control {{ $errors->has('principle_amount') ? ' is-invalid' : '' }}" value="{{ old('principle_amount') }}" type="integer" name="principle_amount" >
                @if ($errors->has('principle_amount'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('principle_amount') }}</strong>
                    </span>
                @endif
              </div><!-- form-group -->
              <div class="form-group wd-xs-300">
                <label>Business Location: <span class="tx-danger">*</span></label>
                <input  id="business_location" class="form-control {{ $errors->has('business_location') ? ' is-invalid' : '' }}" value="{{ old('business_location') }}" type="text" name="business_location"  placeholder="Enter Business Location">
                @if ($errors->has('business_location'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('business_location') }}</strong>
                    </span>
                @endif
              </div><!-- row -->
              <div class="form-group wd-xs-300">
                <label>Business Type: <span class="tx-danger">*</span></label>
                <select id="business_type" name="business_type" class="form-control {{ $errors->has('business_type') ? ' is-invalid' : '' }}" value="{{ old('business_type') }}">
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
              </div><!-- row -->
              <div class="form-group wd-xs-300">
                <label class="form-control-label">Collateral: <span class="tx-danger">*</span></label>
                <textarea id="collateral" cols="10" rows="10" class="form-control {{ $errors->has('collateral') ? ' is-invalid' : '' }}" value="{{ old('collateral') }}" type="text" name="collateral"  required placeholder="Name, phone, nin"></textarea>
                @if ($errors->has('collateral'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('collateral') }}</strong>
                    </span>
                @endif
              </div><!-- form-group -->
            </section>
          </form>
        </div><!-- col-6 -->
        <div class="col-xl-3"></div>
      </div><!-- row -->
    </div>
  </div><!-- br-pagebody -->
  @include('partials._footer')
</div><!-- br-mainpanel -->

@endsection

@section('scripts')
  <script src="{{ asset('lib/jquery/jquery.min.js' ) }}"></script>
  <script src="{{ asset('lib/jquery-ui/ui/widgets/datepicker.js' ) }}"></script>
  <script src="{{ asset('lib/bootstrap/js/bootstrap.bundle.min.js' ) }}"></script>
  <script src="{{ asset('lib/perfect-scrollbar/perfect-scrollbar.min.js' ) }}"></script>
  <script src="{{ asset('lib/moment/min/moment.min.js' ) }}"></script>
  <script src="{{ asset('lib/peity/jquery.peity.min.js' ) }}"></script>
  <script src="{{ asset('lib/highlightjs/highlight.pack.min.js' ) }}"></script>
  <script src="{{ asset('lib/select2/js/select2.min.js' ) }}"></script>
  <script src="{{ asset('lib/jquery-steps/build/jquery.steps.min.js') }}"></script>
  <script src="{{ asset('lib/parsleyjs/parsley.min.js') }}"></script>

  <script src="{{ asset('js/bracket.js' ) }}"></script>
  <script>
    $(function(){
      // Datepicker
      $('.fc-datepicker').datepicker({
        showOtherMonths: true,
        selectOtherMonths: true
      });

      $('#datepickerNoOfMonths').datepicker({
        showOtherMonths: true,
        selectOtherMonths: true,
        numberOfMonths: 2
      });
    });

    $('#wizard2').steps({
      headerTag: 'h3',
      bodyTag: 'section',
      autoFocus: true,
      cssClass: 'wizard wizard-style-2',
      titleTemplate: '<span class="number">#index#</span> <span class="title">#title#</span>',
      onStepChanging: function (event, currentIndex, newIndex) {
        if(currentIndex < newIndex) {
          // Step 1 form validation
          if(currentIndex === 0) {
            var fname = $('#first_name').parsley();
            var lname = $('#last_name').parsley();
            var gender = $('#gender').parsley();
            var dob = $('#date_of_birth').parsley();
            var nok = $('#next_of_kin').parsley();
            var phone = $('#phone_number').parsley();
            var residence = $('#residential_address').parsley();
            var nin = $('#nin_number').parsley();
            var guaranters = $('#guaranters').parsley();

            if(fname.isValid() &&
              lname.isValid() &&
              gender.isValid() &&
              dob.isValid() &&
              nok.isValid() &&
              phone.isValid() &&
              nin.isValid() &&
              residence.isValid() &&
              guaranters.isValid()) {
                return true;
            } else {
              fname.validate();
              lname.validate();
              gender.validate();
              dob.validate();
              nok.validate();
              phone.validate();
              nin.validate();
              residence.validate();
              guaranters.validate();
            }
          }

          // Step 2 form validation
          if(currentIndex === 1) {
            var loanType = $('#loan_type').parsley();
            var principle = $('#principle_amount').parsley();
            var businessLocation = $('#business_location').parsley();
            var businessType = $('#business_type').parsley();
            var collateral = $('#collateral').parsley();
            if(loanType.isValid() && principle.isValid() && businessLocation.isValid() && businessType.isValid() && collateral.isValid()) {
              return true;
            } else {
                 loanType.validate();
                 principle.validate();
                 businessLocation.validate();
                 businessType.validate();
                 collateral.validate();
                 }
          }
        // Always allow step back to the previous step even if the current step is not valid.
        } else { return true; }
      },
      onFinishing: function (event, currentIndex) {
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
          }
      });
      jQuery.ajax({
          url: "{{ url('/new-application') }}",
          method: 'post',
          data: $('#apllication-form').serialize(),
          success: function(result){
            if ( result.error ) {
              console.log( result.error );
            }

            if ( result.success ) {
              console.log( result.success );
            }
          }
        });
      }
    });
  </script>
@endsection
