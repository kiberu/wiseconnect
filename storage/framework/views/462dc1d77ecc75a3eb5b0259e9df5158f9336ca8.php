<?php $__env->startSection('content'); ?>

<div class="br-mainpanel">
  <div class="br-pageheader">
    <nav class="breadcrumb pd-0 mg-0 tx-12">
      <span class="breadcrumb-item active">Finance</span>
    </nav>
  </div><!-- br-pageheader -->
  <div class="br-pagetitle">
    <i class="icon icon ion-ios-bookmarks-outline"></i>
    <div>
      <h4>Finance Home</h4>
    </div>
  </div><!-- d-flex -->

  <div class="br-pagebody">
      <div class="br-section-wrapper">
        <div class="row finance-icon-section">
          <a href="<?php echo e(route('banks.index')); ?>">
            <div class="finance-icon" >
              <i class="fa fa-piggy-bank"></i>
              <span>Bank Transactions</span>
            </div>
          </a>
          <a href="<?php echo e(route('finance.payments')); ?>">
            <div class="finance-icon" >
              <i class="fa fa-address-book"></i>
              <span>Payments</span>
            </div>
          </a>
          <a href="<?php echo e(route('finance.badloans')); ?>">
            <div class="finance-icon" >
              <i class="fa fa-notes-medical"></i>
              <span>Bad loans</span>
            </div>
          </a>
          <a href="<?php echo e(route('finance.insurance')); ?>">
            <div class="finance-icon" >
              <i class="fa fa-house-damage"></i>
              <span>Insurance Fees</span>
            </div>
          </a>
          <a href="<?php echo e(route('finance.application')); ?>">
            <div class="finance-icon" >
              <i class="fa fa-handshake"></i>
              <span>Other Fees</span>
            </div>
          </a>
          <a href="<?php echo e(route('expenditures.index')); ?>">
            <div class="finance-icon" >
              <i class="fa fa-comments-dollar"></i>
              <span>Expenditures</span>
            </div>
          </a>
          <a href="<?php echo e(route('payables.index')); ?>">
            <div class="finance-icon" >
              <i class="fa fa-hands-helping"></i>
              <span>Payables</span>
            </div>
          </a>
          <a href="<?php echo e(route('receivables.index')); ?>">
            <div class="finance-icon" >
              <i class="fa fa-hand-holding-heart"></i>
              <span>Receivables</span>
            </div>
          </a>
        </div>
      </div>
  </div><!-- br-pagebody -->
    <?php echo $__env->make('partials._footer', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div><!-- br-mainpanel -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
  <script src="<?php echo e(asset('lib/jquery/jquery.min.js')); ?>"></script>
  <script src="<?php echo e(asset('lib/jquery-ui/ui/widgets/datepicker.js')); ?>"></script>
  <script src="<?php echo e(asset('lib/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
  <script src="<?php echo e(asset('lib/perfect-scrollbar/perfect-scrollbar.min.js')); ?>"></script>
  <script src="<?php echo e(asset('lib/moment/min/moment.min.js')); ?>"></script>
  <script src="<?php echo e(asset('lib/peity/jquery.peity.min.js')); ?>"></script>
  <script src="<?php echo e(asset('lib/highlightjs/highlight.pack.min.js')); ?>"></script>
  <script src="<?php echo e(asset('lib/datatables.net/js/jquery.dataTables.min.js')); ?>"></script>
  <script src="<?php echo e(asset('lib/datatables.net-dt/js/dataTables.dataTables.min.js')); ?>"></script>
  <script src="<?php echo e(asset('lib/datatables.net-responsive/js/dataTables.responsive.min.js')); ?>"></script>
  <script src="<?php echo e(asset('lib/datatables.net-responsive-dt/js/responsive.dataTables.min.js')); ?>"></script>
  <script src="<?php echo e(asset('lib/select2/js/select2.min.js')); ?>"></script>

  <script src="<?php echo e(asset('js/bracket.js')); ?>"></script>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>