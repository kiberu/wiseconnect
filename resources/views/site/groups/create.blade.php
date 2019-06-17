@extends('layouts.app')

@section('content')

<div class="br-mainpanel">
  <div class="br-pageheader">
    <nav class="breadcrumb pd-0 mg-0 tx-12">
      <a class="breadcrumb-item" href="{{route('home')}}">Home</a>
      <a class="breadcrumb-item" href="{{route('groups.index')}}">Group</a>
      <span class="breadcrumb-item active">Add New Group</span>
    </nav>
  </div><!-- br-pageheader -->
  <div class="br-pagetitle">
    <i class="icon icon ion-ios-color-filter-outline tx-22"></i>
    <div>
      <h4>Add Client Group</h4>
      <p class="mg-b-0">Create grooup and assign clients</p>
    </div>
  </div><!-- d-flex -->

  <div class="br-pagebody">
    <div class="br-section-wrapper">
      <div class="row mg-t-20">
        <div class="col-xl-3"></div>
          <div class="form-layout form-layout-5">
            <form method="POST" action="{{ route('groups.store') }}">
                @csrf

                <div class="form-layout form-layout-2">
                  <div class="row no-gutters">
                    <div class="col-md-12 mg-t--1 mg-md-t-0">
                      <div class="form-group">
                        <label class="form-control-label">Group Name <span class="tx-danger">*</span></label>
                        <input class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" type="text" name="name" value="{{ old('name') }}" placeholder="Enter group name">
                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                      </div>
                    </div><!-- col-12 -->
                    <div class="col-md-12 mg-t--1 mg-md-t-0">
                      <div class="form-group mg-md-l--1">
                        <label class="form-control-label">Group Landmark: <span class="tx-danger">*</span></label>
                        <input class="form-control {{ $errors->has('landmark') ? ' is-invalid' : '' }}" type="text" name="landmark" value="{{ old('landmark') }}" placeholder="Enter location landmark">
                        @if ($errors->has('landmark'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('landmark') }}</strong>
                            </span>
                        @endif
                      </div>
                    </div><!-- col-12 -->
                    <div class="col-md-12 mg-t--1 mg-md-t-0">
                      <div class="form-group mg-md-l--1">
                        <select name="payment_day" class="form-control {{ $errors->has('payment_day') ? ' is-invalid' : '' }}" value="{{ old('payment_day') }}">
                          <option selected disabled>Choose Payment Day</option>
                          @foreach ($payment_days as $key => $payment_day)
                            <option {{ ( old('payment_day') == $key ) ? 'selected' : '' }} value="{{ $key }}">{{ $payment_day }}</option>
                          @endforeach

                        </select>
                        @if ($errors->has('payment_day'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('payment_day') }}</strong>
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
