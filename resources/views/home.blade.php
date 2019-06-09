@extends('layouts.app')

@section('content')

  <div class="br-mainpanel">
    <div class="br-pagetitle">
      <i class="icon ion-ios-home-outline"></i>
      <div>
        <h4>Welcome {{Auth::user()->first_name }} {{ Auth::user()->last_name}}</h4>
        <p class="mg-b-0">{{ Auth::user()->getRoleNames()}}</p>
      </div>
    </div><!-- d-flex -->

    <div class="br-pagebody">

      <!-- hidden on purpose using d-none class to have a different look with the original -->
      <!-- feel free to unhide by removing the d-none class below -->
      <div class="row row-sm mg-b-20">
        <div class="col-sm-6 col-xl-3">
          <div class="bg-info rounded overflow-hidden">
            <div class="pd-x-20 pd-t-20 d-flex align-items-center">
              <i class="ion ion-earth tx-60 lh-0 tx-white op-7"></i>
              <a href="{{ route('loans.index') }}">

                <div class="mg-l-20">
                  <p class="tx-10 tx-spacing-1 tx-mont tx-semibold tx-uppercase tx-white-8 mg-b-10">Approved Loans</p>
                  <p class="tx-24 tx-white tx-lato tx-bold mg-b-0 lh-1">{{ $loans->where('status', 'Approved')->count() }}</p>
                  <span class="tx-11 tx-roboto tx-white-8">{{ $loans->where('status', 'Approved')->count() .'/'.$loans->where('status', 'Pending')->count() }}</span>

                </div>
              </a>
            </div>
            <div id="ch1" class="ht-50 tr-y-1"></div>
          </div>
        </div><!-- col-3 -->
          <div class="col-sm-6 col-xl-3 mg-t-20 mg-sm-t-0">
            <div class="bg-purple rounded overflow-hidden">
              <div class="pd-x-20 pd-t-20 d-flex align-items-center">
                <i class="ion ion-bag tx-60 lh-0 tx-white op-7"></i>
                <a href="{{ route('loans.index') }}">
                <div class="mg-l-20">
                  <p class="tx-10 tx-spacing-1 tx-mont tx-semibold tx-uppercase tx-white-8 mg-b-10">Pending</p>
                  <p class="tx-24 tx-white tx-lato tx-bold mg-b-0 lh-1">{{ $loans->where('status', 'Pending')->count() }}</p>
                  <span class="tx-11 tx-roboto tx-white-8">worthy {{ number_format( $balance ) }} UGX</span>
                </div>
                </a>
              </div>
              <div id="ch3" class="ht-50 tr-y-1"></div>
            </div>
          </div><!-- col-3 -->
        <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
          <div class="bg-orange rounded overflow-hidden">
            <div class="pd-x-20 pd-t-20 d-flex align-items-center">
              <i class="ion ion-monitor tx-60 lh-0 tx-white op-7"></i>
              <div class="mg-l-20">
                <p class="tx-10 tx-spacing-1 tx-mont tx-semibold tx-uppercase tx-white-8 mg-b-10">Defaulters</p>
                <p class="tx-24 tx-white tx-lato tx-bold mg-b-0 lh-1">{{ $defaulters->count() }}</p>
                <span class="tx-11 tx-roboto tx-white-8">worthy {{ number_format( $def_balance ) }} UGX</span>
              </div>
            </div>
            <div id="ch2" class="ht-50 tr-y-1"></div>
          </div>
        </div><!-- col-3 -->
        <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
          <div class="bg-primary rounded overflow-hidden">
            <div class="pd-x-20 pd-t-20 d-flex align-items-center">
              <i class="ion ion-clock tx-60 lh-0 tx-white op-7"></i>
              <div class="mg-l-20">
                <p class="tx-10 tx-spacing-1 tx-mont tx-semibold tx-uppercase tx-white-8 mg-b-10">Today's Loans</p>
                <p class="tx-24 tx-white tx-lato tx-bold mg-b-0 lh-1">{{ $today_loans->count() }}</p>
                <span class="tx-11 tx-roboto tx-white-8">worthy {{ number_format( $today_balance ) }} UGX</span>
              </div>
            </div>
            <div id="ch4" class="ht-50 tr-y-1"></div>
          </div>
        </div><!-- col-3 -->
      </div><!-- row -->

      <div class="row row-sm">
        <div class="col-lg-12">
          <div class="card bd-0 shadow-base">
            <div class="d-md-flex justify-content-between pd-25">
              <div>
                <h6 class="tx-13 tx-uppercase tx-inverse tx-semibold tx-spacing-1">Today's Loans</h6>
                <p>{{ $today->format('l jS \\of F Y h:i:s A') }}7</p>
              </div>
              <div class="d-sm-flex">
                <div>
                  <p class="mg-b-5 tx-uppercase tx-10 tx-mont tx-semibold">Expected Amount</p>
                  <h4 class="tx-lato tx-inverse tx-bold mg-b-0">{{ number_format( $today_balance ) }} UGX</h4>
                </div>
                <div class="bd-sm-l pd-sm-l-20 mg-sm-l-20 mg-t-20 mg-sm-t-0">
                  <p class="mg-b-5 tx-uppercase tx-10 tx-mont tx-semibold">Paid Amount</p>
                  <h4 class="tx-lato tx-inverse tx-bold mg-b-0">{{ number_format($paid_total) }} UGX</h4>
                  <span class="tx-12 tx-danger tx-roboto">{{ number_format( $today_balance - $paid_total ) }} UGX REMAINING</span>
                </div>
              </div><!-- d-flex -->
            </div><!-- d-flex -->

            <div class="pd-l-25 pd-r-15 pd-b-25">
                <table class="table display responsive nowrap">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Client</th>
                      <th>Loan Type</th>
                      <th>Amount Due Today</th>
                      <th>Payment Day</th>
                      <th>Manage</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ( $today_loans as $loan )
                      @php
                        $today = Carbon::today();
                        $due = Carbon::parse( $loan->latest_installment->due_date );

                      @endphp
                      <tr class="{{ ( Carbon::today()->equalTo( Carbon::parse( $loan->latest_installment->due_date ) ) )  ? 'today-bg' : '' }}">
                        <td>{{ $loan->id }}</td>
                        <td><a href="{{ route('clients.show', [ $loan->client->groups->last(), $loan->client ]) }}">{{ $loan->client->first_name }} {{ $loan->client->last_name }}</a></td>
                        <td>{{ $loan->loan_type->name }}</td>
                        <td>{{ number_format( $loan->latest_installment->balance ) }} UGX</td>
                        <th>{{ $loan->payment_day }}</th>
                        <td><a href="{{ route('loans.show', $loan) }}" class="btn btn-success">Manage</a></td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
            </div>
          </div><!-- card -->

        </div><!-- col-8 -->
      </div><!-- row -->

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
  <script src="{{asset('lib/datatables.net/js/jquery.dataTables.min.js' ) }}"></script>
  <script src="{{asset('lib/datatables.net-dt/js/dataTables.dataTables.min.js' ) }}"></script>
  <script src="{{asset('lib/datatables.net-responsive/js/dataTables.responsive.min.js' ) }}"></script>
  <script src="{{asset('lib/datatables.net-responsive-dt/js/responsive.dataTables.min.js' ) }}"></script>
  <script src="{{asset('lib/select2/js/select2.min.js' ) }}"></script>

  <script src="{{asset('js/bracket.js' ) }}"></script>
  <script>
    $(function(){
      'use strict';

      $('#datatable1').DataTable({
        responsive: true,
        language: {
          searchPlaceholder: 'Search...',
          sSearch: '',
          lengthMenu: '_MENU_ items/page',
        }
      });

      $('#datatable2').DataTable({
        bLengthChange: false,
        searching: false,
        responsive: true
      });

      // Select2
      $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });

    });
  </script>
@endsection
