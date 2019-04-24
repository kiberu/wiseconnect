<?php $__env->startSection('content'); ?>

<div class="br-mainpanel">
  <div class="br-pageheader">
    <nav class="breadcrumb pd-0 mg-0 tx-12">
      <span class="breadcrumb-item active">Home</span>
    </nav>
  </div><!-- br-pageheader -->
  <div class="br-pagetitle">
    <i class="icon icon ion-ios-bookmarks-outline"></i>
    <div>
      <h4>Receivables</h4>
      <p class="mg-b-0"><?php echo e(Auth::user()->getRoleNames()); ?></p>
    </div>
  </div><!-- d-flex -->

  <div class="br-pagebody">
    <div>
      <?php if(count($errors) > 0): ?>
        <div class="alert alert-danger" role="alert">
          <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <ul>
              <li><?php echo e($error); ?></li>
            </ul>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      <?php endif; ?>
      <form method="POST" action="<?php echo e(route('receivables.store')); ?>">
          <?php echo csrf_field(); ?>
          <label>Fullname</lable><input class="" name="fullname"/>
          <?php if($errors->has('fullname')): ?>
              <span class="invalid-feedback" role="alert">
                  <strong><?php echo e($errors->first('fullname')); ?></strong>
              </span>
          <?php endif; ?>

          <label>Amount</lable><input type="number" class="" name="amount"/>
          <?php if($errors->has('amount')): ?>
              <span class="invalid-feedback" role="alert">
                  <strong><?php echo e($errors->first('amount')); ?></strong>
              </span>
          <?php endif; ?>

          <label>Notes</lable><input class="" name="notes"/>
          <?php if($errors->has('notes')): ?>
              <span class="invalid-feedback" role="alert">
                  <strong><?php echo e($errors->first('notes')); ?></strong>
              </span>
          <?php endif; ?>
          <input type="submit" value="Add"/>
      </form>
    </div>
    <div class="br-section-wrapper info-section">
      <table id="datatable1" class="table display responsive nowrap">
        <thead>
          <tr>
            <th>#</th>
            <th>Full Name</th>
            <th>Amount</th>
            <th>User</th>
            <th>Notes</th>
            <th>Status</th>
            <th>Date</th>
          </tr>
        </thead>
        <tbody>
          <?php $__currentLoopData = $receivables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $receivable): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <td><?php echo e($receivable->id); ?></td>
              <td><?php echo e($receivable->fullname); ?></td>
              <td><?php echo e($receivable->amount); ?></td>
              <td><?php echo e($receivable->user->fullName); ?></td>
              <td><?php echo e($receivable->notes); ?></td>
              <td><?php echo e($receivable->status); ?></td>
              <td><?php echo e($receivable->created_at); ?></td>
              <td><?php if( $receivable->status == 'Pending'): ?>
                <a href="#" class="btn btn-primary">Clear</a></td>
              <?php endif; ?>
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
  <script src="<?php echo e(asset('lib/jquery/jquery.min.js' )); ?>"></script>
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