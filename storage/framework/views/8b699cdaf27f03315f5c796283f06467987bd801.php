<?php $__env->startSection('content'); ?>

<div class="br-mainpanel">
  <div class="br-pageheader">
    <nav class="breadcrumb pd-0 mg-0 tx-12">
      <a class="breadcrumb-item" href="<?php echo e(route('home')); ?>">Home</a>
      <a class="breadcrumb-item" href="<?php echo e(route('loans.index')); ?>">Loans</a>
      <a class="breadcrumb-item" href="<?php echo e(route('loans.show', $loan)); ?>">Loan #<?php echo e($loan->id); ?></a>
      <span class="breadcrumb-item active">Installment <?php echo e($installment->due_date); ?></span>
    </nav>
  </div><!-- br-pageheader -->
  <div class="br-pagetitle">
    <i class="icon icon ion-ios-color-filter-outline tx-22"></i>
    <div>
      <h4>All Payments</h4>
      <p class="mg-b-0">All payments made for installment <?php echo e($installment->due_date); ?> on loan #<?php echo e($loan->id); ?></p>
    </div>
  </div><!-- d-flex -->

  <div class="br-pagebody">
    <?php if(Auth::user()->hasRole('cashier')): ?>
      <a href="<?php echo e(route('payments.create', [$loan, $installment])); ?>" class="btn btn-success ln_color_white ln_align_right ln_color_white <?php echo e(( $installment->balance <= 0 ) ? 'hide-link' : ''); ?>">Add Payment</a>
    <?php endif; ?>
    <?php $last_installment = $loan->installments->last(); ?>
    <?php $due_date = Carbon::parse( $last_installment->due_date ); ?>
    <?php $current_date = Carbon::parse( $installment->due_date ); ?>

    <?php if( ! $due_date->greaterThan( $current_date ) && $loan->status != 'Complete' ): ?>
      <a href="<?php echo e(route('installments.create', $loan)); ?>" class="btn btn-info ln_color_white ln_align_right ln_color_white <?php echo e(( $installment->balance <= 0 ) ? '' : 'hide-link'); ?>">Add Next Installment</a>
    <?php endif; ?>

    <div class="br-section-wrapper">
      <p>Total Amount Expected = <?php echo e(number_format( $installment->expected_amount )); ?> UGX</p>
      <p>Due date = <?php echo e($installment->due_date); ?></p>
      <p>Total payment number = <?php echo e(count( $installment->payments )); ?> Payments</p>
      <p>Total balance = <?php echo e(number_format( $installment->balance )); ?> UGX</p>
      <p>Installment status = <?php echo e($installment->status); ?></p>
    </div>
    <div class="br-section-wrapper">
      <table id="datatable1" class="table display responsive nowrap">
        <thead>
          <tr>
            <th>#</th>
            <th>Amount</th>
            <th>Received By</th>
            <th>Balance</th>
            <th>Created at</th>
          </tr>
        </thead>
        <tbody>
          <?php $__currentLoopData = $installment->payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <td><?php echo e($payment->id); ?></td>
              <td><?php echo e(number_format( $payment->amount )); ?> UGX</td>
              <td><?php echo e($payment->user->FullName); ?></td>
              <td><?php echo e(number_format( $payment->current_balance )); ?> UGX</td>
              <td><?php echo e($payment->created_at); ?></td>
            </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
      </table>
    </div>
  </div><!-- br-pagebody -->
  <?php echo $__env->make('partials._footer', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div><!-- br-mainpanel -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
  <script src="<?php echo e(asset('lib/jquery-ui/ui/widgets/datepicker.js' )); ?>"></script>
  <script src="<?php echo e(asset('lib/bootstrap/js/bootstrap.bundle.min.js' )); ?>"></script>
  <script src="<?php echo e(asset('lib/perfect-scrollbar/perfect-scrollbar.min.js' )); ?>"></script>
  <script src="<?php echo e(asset('lib/moment/min/moment.min.js' )); ?>"></script>
  <script src="<?php echo e(asset('lib/peity/jquery.peity.min.js' )); ?>"></script>
  <script src="<?php echo e(asset('lib/highlightjs/highlight.pack.min.js' )); ?>"></script>
  <script src="<?php echo e(asset('lib/datatables.net/js/jquery.dataTables.min.js' )); ?>"></script>
  <script src="<?php echo e(asset('lib/datatables.net-dt/js/dataTables.dataTables.min.js' )); ?>"></script>
  <script src="<?php echo e(asset('lib/datatables.net-responsive/js/dataTables.responsive.min.js' )); ?>"></script>
  <script src="<?php echo e(asset('lib/datatables.net-responsive-dt/js/responsive.dataTables.min.js' )); ?>"></script>
  <script src="<?php echo e(asset('lib/select2/js/select2.min.js' )); ?>"></script>

  <script src="<?php echo e(asset('js/bracket.js' )); ?>"></script>
  <script>
    $(function(){
      'use strict';

      $('#datatable1').DataTable({
        responsive: false,
        language: {
          searchPlaceholder: 'Search...',
          sSearch: '',
          lengthMenu: '_MENU_ items/page',
        }
      });
      // Select2
      $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });

    });
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>