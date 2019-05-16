<?php $__env->startSection('content'); ?>

<div class="br-mainpanel">
  <div class="br-pageheader">
    <nav class="breadcrumb pd-0 mg-0 tx-12">
      <a class="breadcrumb-item" href="<?php echo e(route('home')); ?>">Home</a>
      <span class="breadcrumb-item active">Loans</span>
    </nav>
  </div><!-- br-pageheader -->
  <div class="br-pagetitle">
    <i class="icon icon ion-ios-color-filter-outline tx-22"></i>
    <div>
      <h4><?php echo e($heading); ?></h4>
      <p class="mg-b-0">All loans per client</p>
    </div>
  </div><!-- d-flex -->

  <div class="br-pagebody">
    <a href="<?php echo e(route('loans.create')); ?>" class="btn btn-info btn-block mg-b-10 wd-15p ln_align_right ln_color_white">Add new loan</a>

    <div class="br-section-wrapper">
      <table class="table display responsive nowrap">
        <thead>
          <tr>
            <th>#</th>
            <th>Client</th>
            <th>Loan Type</th>
            <th>Application Fee</th>
            <th>Created at</th>
            <th>Manage</th>
          </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $loans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                $today = Carbon::today();
                $due = Carbon::parse($loan->latest_installment->due_date);

                ?>
            <tr class="<?php echo e(( Carbon::today()->equalTo(Carbon::parse($loan->latest_installment->due_date)) )  ? 'today-bg' : ''); ?>">
              <td><?php echo e($loan->id); ?></td>
              <td><a href="<?php echo e(route('clients.show', [ $loan->client->groups->last(), $loan->client ])); ?>"><?php echo e($loan->client->first_name); ?> <?php echo e($loan->client->last_name); ?></a></td>
              <td><?php echo e($loan->loan_type->name); ?></td>
              <td><?php echo e(number_format($loan->application_fee)); ?> UGX</td>
              <td><?php echo e($loan->created_at); ?></td>
              <td><a href="<?php echo e(route('loans.show', $loan)); ?>" class="btn btn-success">Manage</a></td>
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