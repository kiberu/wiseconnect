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
      <h4>Loans</h4>
      <p class="mg-b-0">All loans per client</p>
    </div>
    <div class="btn-right">
      <a class="btn btn-primary" <?php echo e(( ! Auth::user()->hasRole('loan_officer') ) ? 'style=display:none' : ''); ?> href="<?php echo e(route('clients.create')); ?>" >Add New Apllication</a>
    </div>
  </div><!-- d-flex -->

  <div class="br-pagebody">
    <div class="br-section-wrapper">
      <form method="GET" action="<?php echo e(route('loans.index')); ?>">
        <?php echo csrf_field(); ?>
        <table>
          <tr>
            <td>Client: </td>
            <td>
              <input name="client" type="text" value="<?php echo e(old('client')); ?>" />
            </td>

            <td>Loan Type</td>
            <td>
              <input name="loan_type" type="text" value="<?php echo e(old('loan_type')); ?>" />
            </td>
            <td>Group</td>
            <td>
              <input name="group" type="text" value="<?php echo e(old('group')); ?>" />
            </td>
          </tr>
          <tr>
            <td>Gender</td>
            <td>
              <input name="gender" type="text" value="<?php echo e(old('gender')); ?>" />
            </td>
            <td>Business Type</td>
            <td>
              <input name="business_type" type="text" value="<?php echo e(old('business_type')); ?>" />
            </td>
            <td>Status</td>
            <td>
              <input name="status" type="text" value="<?php echo e(old('status')); ?>" />
            </td>
          </tr>
          <tr>
            <td>
              <input type="submit" value="Filter" />
            </td>
          </tr>
        </table>
      </form>
      <hr>
      <div class="row table-responsive">
        <table class="table-striped table-hover report-table">
          <thead>
            <tr>
              <th>#</th>
              <th>Client</th>
              <th>Loan Type</th>
              <th>Group</th>
              <th>Gender</th>
              <th>Business Type</th>
              <th>Guaranters</th>
              <th>Principle</th>
              <th>Status</th>
              <th>Created At</th>
            </tr>
          </thead>
          <tbody>
            <?php $__currentLoopData = $loans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr class="">
                <td><?php echo e($loan->id); ?></td>
                <td><?php echo e($loan->client->first_name); ?> <?php echo e($loan->client->last_name); ?></td>
                <td><?php echo e($loan->loan_type->name); ?></td>
                <td><?php echo e(isset( $loan->client->groups->last()->name ) ? $loan->client->groups->last()->name : 'None'); ?></td>
                <td><?php echo e($loan->client->sex); ?></td>
                <td><?php echo e($loan->business_type->name); ?></td>
                <td><?php echo e($loan->guaranters); ?></td>
                <td><?php echo e($loan->principle); ?></td>
                <td><?php echo e($loan->status); ?></td>
                <td><?php echo e($loan->created_at); ?></td>
                <td><a href="<?php echo e(route('loans.show', $loan)); ?>" class="btn btn-success">Open</a></td>
              </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
        </table>
      </div>
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