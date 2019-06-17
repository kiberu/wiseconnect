<?php $__env->startSection('content'); ?>

<div class="br-mainpanel">
  <div class="br-pageheader">
    <nav class="breadcrumb pd-0 mg-0 tx-12">
      <a class="breadcrumb-item" href="<?php echo e(route('home')); ?>">Home</a>
      <a class="breadcrumb-item" href="<?php echo e(route('groups.index')); ?>">Groups</a>
      <span class="breadcrumb-item active"><?php echo e($group->name); ?></span>
    </nav>
  </div><!-- br-pageheader -->
  <div class="br-pagetitle">
    <i class="icon icon ion-ios-color-filter-outline tx-22"></i>
    <div>
      <h4><?php echo e($group->name); ?></h4>
      <p class="mg-b-0"><?php echo e($group->landmark); ?></p>
    </div>
  </div><!-- d-flex -->

  <div class="br-pagebody">
    <div class="br-section-wrapper">
      <?php if( Auth::user()->can('edit-groups') ): ?>
        <a href="<?php echo e(route('groups.edit', $group )); ?>" class="btn btn-info btn-block mg-b-10 wd-15p ln_align_right ln_color_white">Edit Group</a>
      <?php endif; ?>
      <div class="row mg-t-20">
        <div class="col-xl-3"></div>
        <div class="col-xl-9">
          <strong>Group Name:</strong> <?php echo e($group->name); ?> <br>
          <strong>Landmark:</strong> <?php echo e($group->landmark); ?> <br>
          <strong>Clients:</strong> <?php echo e($group->clients()->count()); ?> <br>
          <hr>
          <?php if(count($errors) > 0): ?>
            <div class="alert alert-danger" role="alert">
              <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <ul>
                  <li><?php echo e($error); ?></li>
                </ul>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
          <?php endif; ?>
          <?php if( Session::has('success')): ?>
            <div class="alert alert-success" role="alert">
              <?php echo e(Session::get('success')); ?>

            </div>
          <?php endif; ?>
          <?php if( Auth::user()->can('transfer-clients') ): ?>
            <form method="POST" action="<?php echo e(route('groups.transfer', $group)); ?>">
              <?php echo csrf_field(); ?>
              <lable>New Group</lable>
                <select name="client_id" class="<?php echo e($errors->has('client_id') ? ' is-invalid' : ''); ?>">
                  <option disabled selected> Select User</option>
                  <?php $__currentLoopData = $group->clients()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $clnt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value=<?php echo e($clnt->id); ?>><?php echo e($clnt->first_name); ?> <?php echo e($clnt->last_name); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            <lable>New Group</lable>
              <select name="group_id" class="<?php echo e($errors->has('group_id') ? ' is-invalid' : ''); ?>">
                <option disabled selected> Select New Group</option>
                <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $grp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php if( $grp->name != $group->name ): ?>
                    <option value=<?php echo e($grp->id); ?>><?php echo e($grp->name); ?></option>
                  <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>

              <input type="submit" value="Transfer"/>
          </form>
          <?php endif; ?>
        </div>
    </div>
    <hr>
    <?php if(Auth::user()->can('manage-loans')): ?>
      <a href="<?php echo e(route('clients.create', $group)); ?>" class="btn btn-success btn-block mg-b-10 wd-15p ln_align_right ln_color_white">Add Client</a>
    <?php endif; ?>
    <div class="br-section-wrapper">
      <table id="datatable1" class="table display responsive nowrap">
        <thead>
          <tr>
            <th>#</th>
            <th>Full Name</th>
            <th>Sex</th>
            <th>Date of Birth</th>
            <th>Next of kin</th>
            <th>Phone Number</th>
            <th>Residence</th>
            <?php if( Auth::user()->can('edit-groups') ): ?>
              <th class="wd-10p">Edit</th>
            <?php endif; ?>
          </tr>
        </thead>
        <tbody>
          <?php $__currentLoopData = $group->clients()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <td><?php echo e($client->id); ?></td>
              <td><a href="<?php echo e(route('clients.show', [$group, $client])); ?>"><?php echo e($client->first_name); ?> <?php echo e($client->last_name); ?></a></td>
              <td><?php echo e($client->sex); ?></td>
              <td><?php echo e($client->date_of_birth); ?></td>
              <td><?php echo e($client->next_of_kin); ?></td>
              <td><?php echo e($client->phone_number); ?></td>
              <td><?php echo e($client->residential_address); ?></td>
              <?php if( Auth::user()->can('edit-groups') ): ?>
                <td><a href="<?php echo e(route('clients.edit', [$group, $client])); ?>" type="button" class="btn btn-primary">Edit</a></td>
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
  <script src="<?php echo e(asset('lib/select2/js/select2.min.js' )); ?>"></script>

  <script src="<?php echo e(asset('js/bracket.js' )); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>