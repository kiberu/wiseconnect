@extends('layouts.app')

@section('content')

<div class="br-mainpanel">
  <div class="br-pageheader">
    <nav class="breadcrumb pd-0 mg-0 tx-12">
      <a class="breadcrumb-item" href="{{route('home')}}">Home</a>
      <span class="breadcrumb-item active">System Users</span>
    </nav>
  </div><!-- br-pageheader -->
  <div class="br-pagetitle">
    <i class="icon icon ion-ios-briefcase-outline tx-22"></i>
    <div>
      <h4>System Users</h4>
      <p class="mg-b-0">Users that can login into this system; with indicidual roles</p>
    </div>
    <div class="btn-right">
      <a class="btn btn-primary" href="{{ route('users.create') }}" >Add New User</a>
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
      <div class="table-wrapper">
        <table id="datatable1" class="table display responsive nowrap">
          <thead>
            <tr>
              <th class="wd-15p">#</th>
              <th class="wd-15p">Full Name</th>
              <th class="wd-15p">Email</th>
              <th class="wd-20p">Role</th>
              <th class="wd-20p">Online</th>
              <th class="wd-10p">Delete User</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($users as $id => $user)
              <tr>
                <td><a href="{{ route('users.edit', $user) }}">{{ $user->id }}</a></td>
                <td><a href="{{ route('users.edit', $user) }}">{{ $user->first_name }} {{ $user->last_name }}</a></td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->getRoleNames() }}</td>
                <td>@if($user->isOnline())
                        <p class="text-success">Online</p>
                    @endif

                    @if(! $user->isOnline())
                        <p class="text-secondary">Offline</p>
                    @endif
                </td>
                <td>
                  <form method="POST" action="{{ route('users.destroy', $user) }}">
                    @csrf
                    {{ method_field('delete')}}
                    <input type="submit" value="Delete" class="btn btn-danger js-delete-user">
                  </form>
                </td>

              </tr>
            @endforeach


          </tbody>
        </table>
      </div><!-- table-wrapper -->
    </div><!-- br-section-wrapper -->
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

  $(".js-delete-user").on('click', function(e) {
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
