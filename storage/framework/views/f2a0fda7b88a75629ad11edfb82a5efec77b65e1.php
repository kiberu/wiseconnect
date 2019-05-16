<?php $__env->startSection('content'); ?>

<div class="br-mainpanel">
  <div class="br-pageheader">
    <nav class="breadcrumb pd-0 mg-0 tx-12">
      <a class="breadcrumb-item" href="<?php echo e(route('home')); ?>">Home</a>
      <a class="breadcrumb-item" href="<?php echo e(route('groups.index')); ?>">Groups</a>
      <a class="breadcrumb-item" href="<?php echo e(route('groups.show', $group)); ?>"><?php echo e($group->name); ?></a>
      <span class="breadcrumb-item active"> Client #<?php echo e($client->id); ?></span>
    </nav>
  </div><!-- br-pageheader -->
  <div class="br-pagetitle">
    <i class="icon icon ion-ios-color-filter-outline tx-22"></i>
    <div>
      <h4>Client #<?php echo e($client->id); ?></h4>
      <p class="mg-b-0"><?php echo e($client->first_name); ?>  <?php echo e($client->last_name); ?></p>
    </div>
  </div><!-- d-flex -->

  <div class="br-pagebody">
    <div class="br-section-wrapper">
        <?php if(Auth::user()->can('edit-groups') ) : ?>
        <a href="<?php echo e(route('clients.edit', [$group, $client])); ?>" class="btn btn-info btn-block mg-b-10 wd-15p ln_align_right ln_color_white">Edit Client</a>
        <?php endif; ?>
      <div class="row mg-t-20">
        <div class="col-xl-3"></div>
        <div class="col-xl-9">
          <strong>Client:</strong> <?php echo e($client->first_name); ?> <?php echo e($client->last_name); ?>  <br>
          <strong>Group Name:</strong> <?php echo e($group->name); ?> <br>
          <hr>
          <h2>Bio</h2>
          <strong>Sex:</strong> <?php echo e($client->sex); ?> <br>
          <strong>Date of Birth:</strong> <?php echo e($client->date_of_birth); ?> <br>
          <strong>Next of Kin</strong> <?php echo e($client->next_of_kin); ?> <br>
          <strong>Phone Number</strong> <?php echo e($client->phone_number); ?> <br>
          <strong>Residence</strong> <?php echo e($client->residential_address); ?> <br>

          <hr>
          <h2>Loans</h2>
          <strong>Loans:</strong> <?php echo e($client->loans->count()); ?>

        </div>
    </div>
    <hr>
    <div class="br-section-wrapper">
      <table id="datatable1" class="table display responsive nowrap">
        <thead>
          <tr>
            <th>#</th>
            <th>Loan Type</th>
            <th>Principle</th>
            <th>Interest</th>
            <th>Interest Rate</th>
            <th>Duration</th>
            <th>Penalty</th>
            <th>Status</th>
            <th>Created at</th>
          </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $client->loans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <td><?php echo e($loan->id); ?></td>
              <td><?php echo e($loan->loan_type->name); ?></td>
              <td><?php echo e(number_format($loan->principle)); ?></td>
              <td><?php echo e(number_format(($loan->principle * $loan->interest_rate / 100) * $loan->duration)); ?>  </td>
              <td><?php echo e($loan->interest_rate); ?>% per <?php echo e($loan->interval); ?></td>
              <td><?php echo e($loan->duration); ?></td>
              <td><?php echo e($loan->penalty); ?> in <?php echo e($loan->penalty_value); ?> </td>
              <td><?php echo e($loan->status); ?></td>
              <td><?php echo e($loan->created_at); ?></td>

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
  <script src="<?php echo e(asset('lib/jquery/jquery.min.js')); ?>"></script>
  <script src="<?php echo e(asset('lib/jquery-ui/ui/widgets/datepicker.js')); ?>"></script>
  <script src="<?php echo e(asset('lib/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
  <script src="<?php echo e(asset('lib/perfect-scrollbar/perfect-scrollbar.min.js')); ?>"></script>
  <script src="<?php echo e(asset('lib/moment/min/moment.min.js')); ?>"></script>
  <script src="<?php echo e(asset('lib/peity/jquery.peity.min.js')); ?>"></script>
  <script src="<?php echo e(asset('lib/highlightjs/highlight.pack.min.js')); ?>"></script>
  <script src="<?php echo e(asset('lib/select2/js/select2.min.js')); ?>"></script>

  <script src="<?php echo e(asset('js/bracket.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>