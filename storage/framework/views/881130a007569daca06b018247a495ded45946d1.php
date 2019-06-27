<?php $__env->startSection('content'); ?>

<div class="br-mainpanel">
  <div class="br-pageheader">
    <nav class="breadcrumb pd-0 mg-0 tx-12">
      <a class="breadcrumb-item" href="<?php echo e(route('home')); ?>">Home</a>
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
      <a class="btn btn-primary" href="<?php echo e(route('groups.create')); ?>" >Add New Group</a>
    </div>
  </div><!-- d-flex -->

  <div class="br-pagebody">
    <div class="br-section-wrapper">
      <div class="table-wrapper">
        <?php if( Session::has('success')): ?>
          <div class="alert alert-success" role="alert">
            <?php echo e(Session::get('success')); ?>

          </div>
        <?php endif; ?>
        <table id="datatable1" class="table display responsive nowrap">
          <thead>
            <tr>
              <th class="wd-15p">#</th>
              <th class="wd-15p">Group Name</th>
              <th class="wd-15p">Landmark</th>
              <th class="wd-20p">Number of Clients</th>
              <?php if( Auth::user()->can('edit-groups') ): ?>
                <th class="wd-10p">Edit</th>
              <?php endif; ?>
            </tr>
          </thead>
          <tbody>
            <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td><?php echo e($group->id); ?></td>
                <td><a href="<?php echo e(route('groups.show', $group)); ?>"><?php echo e($group->name); ?></a></td>
                <td><?php echo e($group->landmark); ?></td>
                <td><?php echo e($group->clients()->count()); ?></td>
                <?php if( Auth::user()->can('edit-groups') ): ?>
                  <td><a href="<?php echo e(route('groups.edit', $group)); ?>" type="button" class="btn btn-primary">Edit</a></td>
                <?php endif; ?>
              </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


          </tbody>
        </table>
      </div><!-- table-wrapper -->
    </div><!-- br-section-wrapper -->
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>