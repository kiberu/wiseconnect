<?php $__env->startSection('content'); ?>

<div class="br-mainpanel">
  <div class="br-pageheader">
    <nav class="breadcrumb pd-0 mg-0 tx-12">
      <a class="breadcrumb-item" href="<?php echo e(route('home')); ?>">Home</a>
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
      <a class="btn btn-primary" href="<?php echo e(route('users.create')); ?>" >Add New User</a>
    </div>
  </div><!-- d-flex -->

  <div class="br-pagebody">
    <div class="br-section-wrapper">
      <?php if( Session::has('success')): ?>
        <div class="alert alert-success" role="alert">
          <?php echo e(Session::get('success')); ?>

        </div>
      <?php endif; ?>

      <?php if( Session::has('error')): ?>
        <div class="alert alert-danger" role="alert">
          <?php echo e(Session::get('error')); ?>

        </div>
      <?php endif; ?>
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
            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td><a href="<?php echo e(route('users.edit', $user)); ?>"><?php echo e($user->id); ?></a></td>
                <td><a href="<?php echo e(route('users.edit', $user)); ?>"><?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?></a></td>
                <td><?php echo e($user->email); ?></td>
                <td><?php echo e($user->getRoleNames()); ?></td>
                <td><?php if($user->isOnline()): ?>
                        <p class="text-success">Online</p>
                    <?php endif; ?>

                    <?php if(! $user->isOnline()): ?>
                        <p class="text-secondary">Offline</p>
                    <?php endif; ?>
                </td>
                <td>
                  <form method="POST" action="<?php echo e(route('users.destroy', $user)); ?>">
                    <?php echo csrf_field(); ?>
                    <?php echo e(method_field('delete')); ?>

                    <input type="submit" value="Delete" class="btn btn-danger js-delete-user">
                  </form>
                </td>

              </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


          </tbody>
        </table>
      </div><!-- table-wrapper -->
    </div><!-- br-section-wrapper -->
  </div><!-- br-pagebody -->
  <?php echo $__env->make('partials._footer', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <div id="dialog-confirm" title="Delete this item?">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>Are you sure you want to delete? This can not be reversed</p>
  </div>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>