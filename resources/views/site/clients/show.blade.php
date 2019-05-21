@extends('layouts.app')

@section('content')

<div class="br-mainpanel">
  <div class="br-pageheader">
    <nav class="breadcrumb pd-0 mg-0 tx-12">
      <a class="breadcrumb-item" href="{{route('home')}}">Home</a>
      <span class="breadcrumb-item active"> Client #{{ $client->id }}</span>
    </nav>
  </div><!-- br-pageheader -->
  <div class="br-pagetitle">
    <i class="icon icon ion-ios-color-filter-outline tx-22"></i>
    <div>
      <h4>Client #{{ $client->id }}</h4>
      <p class="mg-b-0">{{ $client->first_name }}  {{ $client->last_name }}</p>
    </div>
  </div><!-- d-flex -->

  <div class="br-pagebody">
    <div class="br-section-wrapper">

      <div class="row mg-t-20">
        <div class="col-xl-3"></div>
        <div class="col-xl-9">
          <strong>Client:</strong> {{ $client->first_name }} {{ $client->last_name }}  <br>
          <strong>Group Name:</strong> {{ (! empty($client->groups)) ? $client->groups->last()->name : 'None' }} <br>
          <hr>
          <h2>Bio</h2>
          <strong>Sex:</strong> {{ $client->sex }} <br>
          <strong>Date of Birth:</strong> {{ $client->date_of_birth }} <br>
          <strong>Next of Kin</strong> {{ $client->next_of_kin }} <br>
          <strong>Phone Number</strong> {{ $client->phone_number }} <br>
          <strong>Residence</strong> {{ $client->residential_address }} <br>

          <hr>
          <h2>Loans</h2>
          <strong>Loans:</strong> {{ $client->loans->count() }}
        </div>
    </div>
    <hr>
    <div class="br-section-wrapper">
      <table id="datatable1" class="table display responsive nowrap">
        <thead>
          <tr>
            <th>#</th>
            <th>Loan Type</th>
            <th>Principle</th>
            <th>Interest</th>
            <th>Interest Rate</th>
            <th>Duration</th>
            <th>Penalty</th>
            <th>Status</th>
            <th>Created at</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($client->loans as $loan)
            <tr>
              <td>{{ $loan->id }}</td>
              <td>{{ $loan->loan_type->name }}</td>
              <td>{{ number_format($loan->principle) }}</td>
              <td>{{ number_format(($loan->principle * $loan->interest_rate / 100) * $loan->duration )}}  </td>
              <td>{{ $loan->interest_rate }}% per {{ $loan->interval }}</td>
              <td>{{ $loan->duration }}</td>
              <td>{{ $loan->penalty }} in {{ $loan->penalty_value }} </td>
              <td>{{ $loan->status }}</td>
              <td>{{ $loan->created_at }}</td>

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
  <script src="{{asset('lib/select2/js/select2.min.js' ) }}"></script>

  <script src="{{asset('js/bracket.js' ) }}"></script>
@endsection
