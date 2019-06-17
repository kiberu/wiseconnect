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
      @if ( Auth::user()->can('edit-groups') )
        <a href="{{ route('groups.edit', $group ) }}" class="btn btn-info btn-block mg-b-10 wd-15p ln_align_right ln_color_white">Edit Group</a>
      @endif
      <div class="row mg-t-20">
        <div class="col-xl-3"></div>
        <div class="col-xl-9">
          <strong>Group Name:</strong> {{ $group->name }} <br>
          <strong>Landmark:</strong> {{ $group->landmark }} <br>
          <strong>Clients:</strong> {{ $group->clients()->count() }} <br>
          <hr>
          @if (count($errors) > 0)
            <div class="alert alert-danger" role="alert">
              @foreach ($errors->all() as $error)
                <ul>
                  <li>{{ $error }}</li>
                </ul>
              @endforeach
            </div>
          @endif
          @if ( Session::has('success'))
            <div class="alert alert-success" role="alert">
              {{ Session::get('success')}}
            </div>
          @endif
          @if ( Auth::user()->can('transfer-clients') )
            <form method="POST" action="{{ route('groups.transfer', $group) }}">
              @csrf
              <lable>New Group</lable>
                <select name="client_id" class="{{ $errors->has('client_id') ? ' is-invalid' : '' }}">
                  <option disabled selected> Select User</option>
                  @foreach ($group->clients()->get() as $clnt)
                    <option value={{ $clnt->id }}>{{ $clnt->first_name }} {{ $clnt->last_name }}</option>
                  @endforeach
                </select>
            <lable>New Group</lable>
              <select name="group_id" class="{{ $errors->has('group_id') ? ' is-invalid' : '' }}">
                <option disabled selected> Select New Group</option>
                @foreach ($groups as $grp)
                  @if ( $grp->name != $group->name )
                    <option value={{ $grp->id }}>{{ $grp->name }}</option>
                  @endif
                @endforeach
              </select>

              <input type="submit" value="Transfer"/>
          </form>
          @endif
        </div>
    </div>
    <hr>
    @if (Auth::user()->can('manage-loans'))
      <a href="{{ route('clients.create', $group) }}" class="btn btn-success btn-block mg-b-10 wd-15p ln_align_right ln_color_white">Add Client</a>
    @endif
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
            @if ( Auth::user()->can('edit-groups') )
              <th class="wd-10p">Edit</th>
            @endif
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
              @if ( Auth::user()->can('edit-groups') )
                <td><a href="{{ route('clients.edit', [$group, $client]) }}" type="button" class="btn btn-primary">Edit</a></td>
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
  <script src="{{asset('lib/select2/js/select2.min.js' ) }}"></script>

  <script src="{{asset('js/bracket.js' ) }}"></script>
@endsection
