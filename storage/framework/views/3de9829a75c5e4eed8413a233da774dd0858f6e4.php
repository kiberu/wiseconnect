<?php $__env->startSection('content'); ?>

<div class="br-mainpanel">
  <div class="br-pageheader">
    <nav class="breadcrumb pd-0 mg-0 tx-12">
      <a class="breadcrumb-item" href="<?php echo e(route('home')); ?>">Home</a>
      <a class="breadcrumb-item" href="<?php echo e(route('loans.index')); ?>">Loans</a>
      <span class="breadcrumb-item active">Loan #<?php echo e($loan->id); ?></span>
    </nav>
  </div><!-- br-pageheader -->
  <div class="br-pagetitle">
    <i class="icon icon ion-ios-color-filter-outline tx-22"></i>
    <div>
      <h4>Loan #<?php echo e($loan->id); ?></h4>
      <p class="mg-b-0">Assigned to <?php echo e($loan->client->first_name); ?> <?php echo e($loan->client->last_name); ?></p>
    </div>
  </div><!-- d-flex -->

  <div class="br-pagebody">
    <div class="br-section-wrapper info-section">
      <div class="row mg-t-20">
        <div class="col-xl-3"></div>
        <div class="alert alert-danger js-ajax-response-error" role="alert" style="display: none;">
        </div>
        <div class="alert alert-success js-ajax-response-success" role="alert" style="display: none;">
        </div>

        <?php if( Session::has('success')): ?>
          <div class="alert alert-success" role="alert">
            <?php echo e(Session::get('success')); ?>

          </div>
        <?php endif; ?>
        <div class="col-xl-9">
          <h2>Client Information</h2>
          <table class="table">
              <tr>
                <th>Client Name</th>
                <td><?php echo e($loan->client->first_name); ?> <?php echo e($loan->client->last_name); ?></td>
              </tr>
              <tr>
                <th>Group</th>
                <td><?php echo e(isset( $loan->client->groups->last()->name ) ? $loan->client->groups->last()->name : 'None'); ?></td>
              </tr>
              <tr>
                <th>Date Of Birth</th>
                <td><?php echo e($loan->client->date_of_birth); ?></td>
              </tr>
              <tr>
                <th>Sex</th>
                <td><?php echo e($loan->client->sex); ?></td>
              </tr>
              <tr>
                <th>Next of kin</th>
                <td><?php echo e($loan->client->next_of_kin); ?></td>
              </tr>
              <tr>
                <th>NIN Number</th>
                <td><?php echo e($loan->client->NIN); ?></td>
              </tr>
              <tr>
                <th>Residential Address</th>
                <td><?php echo e($loan->client->residential_address); ?></td>
              </tr>
              <tr>
                <th>Loan Type</th>
                <td><?php echo e($loan->loan_type->name); ?></td>
              </tr>

              <tr>
                <th>Loan Type details</th>
                <td><?php echo e($loan->other_details); ?></td>
              </tr>

              <tr>
                <th>Business Type</th>
                <td><?php echo e($loan->business_type->name); ?></td>
              </tr>

              <tr>
                <th>Business Location</th>
                <td><?php echo e($loan->business_location); ?></td>
              </tr>

              <tr>
                <th>Business Details</th>
                <td><?php echo e($loan->business_details); ?></td>
              </tr>

              <tr>
                <th>Collateral</th>
                <td><?php echo e($loan->collateral); ?></td>
              </tr>

              <tr>
                <th>Guaranters</th>
                <td><?php echo e($loan->guaranters); ?></td>
              </tr>

              <tr>
                <th>Loan Officer</th>
                <td><?php echo e($loan->loan_officer()); ?></td>
              </tr>
          </table>

        </div>
      </div>
    </div>
    <div class="br-section-wrapper info-section">
      <div class="row mg-t-20">
        <div class="col-xl-3"></div>
        <div class="col-xl-9">
          <h2>Loan Information</h2>
          <hr>
          <?php if( $loan->status === 'Pending' ): ?>
            <?php if( Auth::user()->hasRole( 'branch_manager' ) ): ?>
              <a href="<?php echo e(route('loans.approve', $loan )); ?>">Approve Loan</a>
            <?php endif; ?>
          <?php endif; ?>

          <?php if( $loan->status === 'Approved' ): ?>
            <?php if( Auth::user()->hasRole( 'loan_officer' ) ): ?>
              <a href="<?php echo e(route('loans.confirm', $loan )); ?>">Disburse Loan</a>
            <?php endif; ?>
          <?php endif; ?>

          <?php if( $loan->status === 'Confirmed' ): ?>
            <?php if( Auth::user()->hasRole( 'branch_manager' ) ): ?>
              <a href="<?php echo e(route('loans.activate', $loan )); ?>">Activate Loan</a>
            <?php endif; ?>
          <?php endif; ?>

          <table class="table">
            <?php if( $loan->status === 'Pending' ): ?>
              <tr>
                <th>Status</th>
                <td><span id="js-status" style="color: green"> <?php echo e($loan->status); ?><br></span></td>
              </tr>
              <tr>
                <th>Loan amount</th>
                <td><?php echo e(number_format($loan->principle)); ?> UGX</td>
              </tr>

            <?php elseif( $loan->status === 'Approved' ): ?>

              <tr>
                <th>Status</th>
                <td><span id="js-status" style="color: green"> <?php echo e($loan->status); ?><br></span></td>
              </tr>
              <tr>
                <th>Loan amount</th>
                <td><?php echo e(number_format($loan->principle)); ?> UGX</td>
              </tr>
              <tr>
                <th>Loan period</th>
                <td><?php echo e($loan->duration + $loan->loan_type->grace_period); ?> Weeks</td>
              </tr>
              <tr>
                <th>Grace Period</th>
                <td><?php echo e($loan->loan_type->grace_period); ?> Weeks</td>
              </tr>
            <?php elseif( $loan->status === 'Confirmed' ): ?>
              <tr>
                <th>Status</th>
                <td><span id="js-status" style="color: green"> <?php echo e($loan->status); ?><br></span></td>
              </tr>
              <tr>
                <th>Loan amount</th>
                <td><?php echo e(number_format($loan->principle)); ?> UGX</td>
              </tr>
              <tr>
                <th>Loan period</th>
                <td><?php echo e($loan->duration + $loan->loan_type->grace_period); ?> Weeks</td>
              </tr>
              <tr>
                <th>Payment Day</th>
                <td><?php echo e(isset( $loan->client->groups->last()->name ) ? $loan->client->groups->last()->payment_day : $loan->payment_day); ?></td>
              </tr>

              <tr>
                <th>Grace Period</th>
                <td><?php echo e($loan->loan_type->grace_period); ?> Weeks</td>
              </tr>
            <?php elseif($loan->status === 'Active'): ?>
              <tr>
                <th>Status</th>
                <td><span id="js-status" style="color: green"> <?php echo e($loan->status); ?><br></span></td>
              </tr>
              <tr>
                <th>Loan amount</th>
                <td><?php echo e(number_format($loan->principle)); ?> UGX</td>
              </tr>

              <tr>
                <th>Loan period</th>
                <td><?php echo e($loan->duration + $loan->loan_type->grace_period); ?> Weeks</td>
              </tr>
              <tr>
                <th>Installment amount</th>
                <td><?php echo e(number_format($loan->latest_installment->expected_amount)); ?> UGX</td>
              </tr>
              <tr>
                <th>First installment date</th>
                <td><?php echo e($loan->installments->first()->due_date); ?></td>
              </tr>
              <tr>
                <th>Last installment date</th>
                <td><?php echo e($loan->last_installment_date()); ?></td>
              </tr>

              <?php if(Auth::user()->hasRole('general_manager')): ?>
                <tr>
                  <th>Paid amount so far</th>
                  <td><?php echo e($loan->total_paid()); ?></td>
                </tr>

                <tr>
                  <th>Interest Rates</th>
                  <td><?php echo e($loan->loan_type->interest_rate); ?></td>
                </tr>

                <tr>
                  <th>Interest Earnings per installment(total)</th>
                  <td><?php echo e(number_format($loan->interest_amount())); ?> ( <?php echo e(number_format($loan->total_interest_amount())); ?>) UGX</td>
                </tr>

                <tr>
                  <th>Insurance Fee</th>
                  <td><?php echo e(number_format($loan->loan_type->insurance_fee)); ?></td>
                </tr>

                <tr>
                  <th>Other fees</th>
                  <td><?php echo e(number_format($loan->loan_type->other_fee)); ?></td>
                </tr>

                <tr>
                  <th>Grace Period</th>
                  <td><?php echo e($loan->loan_type->grace_period); ?> Weeks</td>
                </tr>
              <?php endif; ?>
            <?php endif; ?>

          </table>
        </div>
      </div>
    </div>
    <?php if( $loan->status === 'Active' ): ?>
    <div class="br-section-wrapper info-section">
      <table id="datatable1" class="table display responsive nowrap">
        <thead>
          <tr>
            <th>#</th>
            <th>Amount Expected</th>
            <th>Next Due Date</th>
            <th>Installment Balance</th>
            <th>Outstanding Balance</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $current_balance = $loan->total_due();
          ?>
          <?php $__currentLoopData = $loan->installments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $installment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
              $current_balance -= $installment->payments->sum('amount');
            ?>
            <tr>
              <td><?php echo e($installment->id); ?></td>
              <td><?php echo e(number_format($installment->expected_amount)); ?> UGX</td>
              <td><?php echo e($installment->due_date); ?></td>
              <td><?php echo e(number_format($installment->balance)); ?> UGX</td>
              <td><?php echo e(number_format( $current_balance )); ?> UGX</td>
              <td><?php echo e($installment->status); ?></td>
              <?php if( Auth::user()->hasRole( 'branch_manager' ) ): ?>
                <td><a href="<?php echo e(route( 'installments.show', [$loan, $installment] )); ?>" class="btn btn-success ln_color_white">Payments</a></td>
              <?php endif; ?>
            </tr>

          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </tbody>
      </table>
    </div>
    <?php endif; ?>

  </div><!-- br-pagebody -->
  <?php echo $__env->make('partials._footer', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div><!-- br-mainpanel -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
  <script src="<?php echo e(asset('lib/jquery/jquery.min.js' )); ?>"></script>
  <script src="<?php echo e(asset('lib/jquery-ui/ui/widgets/datepicker.js' )); ?>"></script>
  <script src="<?php echo e(asset('lib/bootstrap/js/bootstrap.bundle.min.js' )); ?>"></script>
  <script src="<?php echo e(asset('lib/perfect-scrollbar/perfect-scrollbar.min.js' )); ?>"></script>
  <script src="<?php echo e(asset('lib/moment/min/moment.min.js' )); ?>"></script>
  <script src="<?php echo e(asset('lib/peity/jquery.peity.min.js' )); ?>"></script>
  <script src="<?php echo e(asset('lib/highlightjs/highlight.pack.min.js' )); ?>"></script>
  <script src="<?php echo e(asset('lib/select2/js/select2.min.js' )); ?>"></script>

  <script src="<?php echo e(asset('js/bracket.js' )); ?>"></script>
  <script>
    $("#js-approve-loan").click( function( event) {
      var loan_id = $("#js-loan-id").html();

      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
      });
      jQuery.ajax({
          url: "<?php echo e(url('/approve-loan')); ?>",
          method: 'get',
          data: {'loan_id' : loan_id},
          success: function(result){
            if ( result.error ) {
              $('.js-ajax-response-error').html(result.error);
              $('.js-ajax-response-error').show();
            }

            if ( result.success ) {
              $('.js-ajax-response-success').html(result.success);
              $('.js-ajax-response-error').hide();
              $('.js-ajax-response-success').show();
              $("#js-approve-loan").html('Approved');
              $("#js-approve-loan").prop('disabled', true);
              $("#js-status").html("Status: Approved");

              console.log( result.success );
            }
          }
        });
    });
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>