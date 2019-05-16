@extends('layouts.app')

@section('content')

<div class="br-mainpanel">
  <div class="br-pageheader">
    <nav class="breadcrumb pd-0 mg-0 tx-12">
      <a class="breadcrumb-item" href="{{route('home')}}">Home</a>
      <a class="breadcrumb-item" href="{{route('groups.index')}}">Groups</a>
      <a class="breadcrumb-item" href="{{route('groups.show', $group)}}">{{ $group->name }}</a>
      <a class="breadcrumb-item" href="{{route('clients.show', [$group, $client])}}">{{ $client->id }}</a>
      <span class="breadcrumb-item active">Edit  Client</span>
    </nav>
  </div><!-- br-pageheader -->
  <div class="br-pagetitle">
    <i class="icon icon ion-ios-briefcase-outline tx-22"></i>
    <div>
      <h4>Edit  Client #{{ $client->id }}</h4>
      <p class="mg-b-0">Edit Client #{{ $client->id }} of group {{ $group->name }}</p>
    </div>
  </div><!-- d-flex -->

  <div class="br-pagebody">
    <div class="br-section-wrapper">
      <div class="row mg-t-20">
        <div class="col-xl-3"></div>
        <div class="col-xl-6 mg-t-20 mg-xl-t-0">
          <div class="form-layout form-layout-5">
            <form method="POST" action="{{ route('clients.update', [$group, $client]) }}">
                @csrf
                {{ method_field('PUT')}}
                <div class="form-layout form-layout-6">
                  <div class="row no-gutters">
                    <div class="col-5 col-sm-4">
                      Firstname(*):
                    </div><!-- col-4 -->
                    <div class="col-7 col-sm-8">
                      <input  class="form-control {{ $errors->has('first_name') ? ' is-invalid' : '' }}" value="{{ $client->first_name }}" type="text" name="first_name"  placeholder="Enter client's first name" autofocus>
                      @if ($errors->has('first_name'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('first_name') }}</strong>
                          </span>
                      @endif
                    </div><!-- col-8 -->
                  </div><!-- row -->
                  <div class="row no-gutters">
                    <div class="col-5 col-sm-4">
                      Lastname(*):
                    </div><!-- col-4 -->
                    <div class="col-7 col-sm-8">
                      <input  class="form-control {{ $errors->has('last_name') ? ' is-invalid' : '' }}" value="{{ $client->last_name}}" type="text" name="last_name"  placeholder="Enter client's last name">
                      @if ($errors->has('last_name'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('last_name') }}</strong>
                          </span>
                      @endif
                    </div><!-- col-8 -->
                  </div><!-- row -->
                  <div class="row no-gutters">
                    <div class="col-5 col-sm-4">
                      Gender(*):
                    </div><!-- col-4 -->
                    <div class="col-7 col-sm-8">
                      <select name="gender" class="form-control {{ $errors->has('gender') ? ' is-invalid' : '' }}">
                        <option selected disabled>Choose Option</option>
                        <option {{ ( $client->sex == 'Male') ? 'selected' : '' }} value="Male">Male</option>
                        <option {{ ( $client->sex == 'Female' ) ? 'selected' : '' }} value="Female">Female</option>
                      </select>
                      @if ($errors->has('gender'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('gender') }}</strong>
                          </span>
                      @endif
                    </div><!-- col-8 -->
                  </div><!-- row -->
                  <div class="row no-gutters">
                    <div class="col-5 col-sm-4">
                      Date of Birth(*):
                    </div><!-- col-4 -->
                    <div class="col-7 col-sm-8">
                      <input  type="text" name="date_of_birth" class="form-control fc-datepicker {{ $errors->has('date_of_birth') ? ' is-invalid' : '' }}" value="{{ str_replace('-', '/', date('m-d-Y', strtotime($client->date_of_birth))) }}"  placeholder="MM/DD/YYYY"
                      >
                      @if ($errors->has('date_of_birth'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('date_of_birth') }}</strong>
                          </span>
                      @endif

                    </div><!-- col-8 -->
                  </div><!-- row -->

                  <div class="row no-gutters">
                    <div class="col-5 col-sm-4">
                      Next of Kin(*):
                    </div><!-- col-4 -->
                    <div class="col-7 col-sm-8">
                      <input  class="form-control {{ $errors->has('next_of_kin') ? ' is-invalid' : '' }}" value="{{ $client->next_of_kin }}" type="text" name="next_of_kin"  placeholder="Enter next of kin">
                      @if ($errors->has('next_of_kin'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('next_of_kin') }}</strong>
                          </span>
                      @endif
                    </div><!-- col-8 -->
                  </div><!-- row -->
                  <div class="row no-gutters">
                    <div class="col-5 col-sm-4">
                      Phone Number(*):
                    </div><!-- col-4 -->
                    <div class="col-7 col-sm-8">
                      <input  class="form-control {{ $errors->has('phone_number') ? ' is-invalid' : '' }}" value="{{ $client->phone_number }}" type="text" name="phone_number"  placeholder="Enter phone number">
                      @if ($errors->has('phone_number'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('phone_number') }}</strong>
                          </span>
                      @endif
                    </div><!-- col-8 -->
                  </div><!-- row -->
                  <div class="row no-gutters">
                    <div class="col-5 col-sm-4">
                      Residential Address(*):
                    </div><!-- col-4 -->
                    <div class="col-7 col-sm-8">
                      <input  class="form-control {{ $errors->has('residential_address') ? ' is-invalid' : '' }}" value="{{ $client->residential_address }}" type="text" name="residential_address"  placeholder="Enter Residential Address">
                      @if ($errors->has('residential_address'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('residential_address') }}</strong>
                          </span>
                      @endif
                    </div><!-- col-8 -->
                  </div><!-- row -->

                  <div class="row no-gutters">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-info">
                            {{ __('Edit Client') }}
                        </button>
                    </div>
                  </div><!-- row -->

                </div><!-- form-layout -->

            </form>

          </div><!-- form-layout -->
        </div><!-- col-6 -->
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
  </script>
@endsection
