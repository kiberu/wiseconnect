@extends('layouts.app')

@section('content')

<div class="br-mainpanel">
  <div class="br-pageheader">
    <nav class="breadcrumb pd-0 mg-0 tx-12">
      <a class="breadcrumb-item" href="{{route('home')}}">Home</a>
      <a class="breadcrumb-item" href="{{route('groups.index')}}">Groups</a>
      <span class="breadcrumb-item active">{{ $group->name }}</span>
    </nav>
  </div><!-- br-pageheader -->
  <div class="br-pagetitle">
    <i class="icon icon ion-ios-color-filter-outline tx-22"></i>
    <div>
      <h4>{{ $group->name }}</h4>
      <p class="mg-b-0">{{ $group->landmark }}</p>
    </div>
  </div><!-- d-flex -->

  <div class="br-pagebody">
    <div class="br-section-wrapper">
      <div class="row mg-t-20">
        <div class="col-xl-3"></div>
        <div class="col-xl-9">
          <strong>Group Name:</strong> {{ $group->name }} <br>
          <strong>Landmark:</strong> {{ $group->landmark }} <br>
          <strong>Clients:</strong> {{ $group->clients()->count() }} <br>

        </div>
    </div>
    <hr>
    <a href="{{ route('clients.create', $group) }}" class="btn btn-success btn-block mg-b-10 wd-15p ln_align_right ln_color_white">Add Client</a>
    <div class="br-section-wrapper">
      <table id="datatable1" class="table display responsive nowrap">
        <thead>
          <tr>
            <th>#</th>
            <th>Full Name</th>
            <th>Sex</th>
            <th>Date of Birth</th>
            <th>Next of kin</th>
            <th>Phone Number</th>
            <th>Residence</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($group->clients()->get() as $client)
            <tr>
              <td>{{ $client->id }}</td>
              <td><a href="{{ route('clients.show', [$group, $client]) }}">{{ $client->first_name }} {{ $client->last_name }}</a></td>
              <td>{{ $client->sex }}</td>
              <td>{{ $client->date_of_birth }}</td>
              <td>{{ $client->next_of_kin }}</td>
              <td>{{ $client->phone_number }}</td>
              <td>{{ $client->residential_address }}</td>

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
