@extends('layouts.app')

@section('content')

<div class="br-mainpanel">
  <div class="br-pageheader">
    <nav class="breadcrumb pd-0 mg-0 tx-12">
      <a class="breadcrumb-item" href="{{route('home')}}">Home</a>
      <span class="breadcrumb-item active">Groups</span>
    </nav>
  </div><!-- br-pageheader -->
  <div class="br-pagetitle">
    <i class="icon icon ion-ios-color-filter-outline tx-22"></i>
    <div>
      <h4>All Groups</h4>
      <p class="mg-b-0">All client community groups</p>
    </div>
    <div class="btn-right">
      <a class="btn btn-primary" href="{{ route('groups.create') }}" >Add New Group</a>
    </div>
  </div><!-- d-flex -->

  <div class="br-pagebody">
    <div class="br-section-wrapper">
      <div class="table-wrapper">
        @if ( Session::has('success'))
          <div class="alert alert-success" role="alert">
            {{ Session::get('success')}}
          </div>
        @endif
        <table id="datatable1" class="table display responsive nowrap">
          <thead>
            <tr>
              <th class="wd-15p">#</th>
              <th class="wd-15p">Group Name</th>
              <th class="wd-15p">Landmark</th>
              <th class="wd-20p">Number of Clients</th>
              @if ( Auth::user()->can('edit-groups') )
                <th class="wd-10p">Edit</th>
              @endif
            </tr>
          </thead>
          <tbody>
            @foreach ($groups as $id => $group)
              <tr>
                <td>{{ $group->id }}</td>
                <td><a href="{{ route('groups.show', $group) }}">{{ $group->name }}</a></td>
                <td>{{ $group->landmark }}</td>
                <td>{{ $group->clients()->count() }}</td>
                @if ( Auth::user()->can('edit-groups') )
                  <td><a href="{{ route('groups.edit', $group) }}" type="button" class="btn btn-primary">Edit</a></td>
                @endif
              </tr>
            @endforeach


          </tbody>
        </table>
      </div><!-- table-wrapper -->
    </div><!-- br-section-wrapper -->
  </div><!-- br-pagebody -->
  @include('partials._footer')
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
    $(function(){
      'use strict';

      // $('#datatable1').DataTable({
      //   responsive: false,
      //   language: {
      //     searchPlaceholder: 'Search...',
      //     sSearch: '',
      //     lengthMenu: '_MENU_ items/page',
      //   }
      // });
      // Select2
      $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });

    });
  </script>
@endsection
