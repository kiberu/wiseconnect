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
        <div class="col-xl-9">
          <h2>Client Information</h2>
          <hr>
          <h6>Client:</strong> <?php echo e($loan->client->first_name); ?> <?php echo e($loan->client->last_name); ?> <br></h6>
          <hr>
          <h6>Client's group:</strong> <?php echo e($loan->client->groups->last()->name); ?> <br></h6>
        </div>
      </div>
    </div>
    <div class="br-section-wrapper info-section">
      <div class="row mg-t-20">
        <div class="col-xl-3"></div>
        <div class="col-xl-9">
          <h2>Loan Information</h2>
          <hr>
          <h6>Status:</strong> <?php echo e($loan->status); ?><br></h6>
          <hr>
          <h6>Interest Rate:</strong> <?php echo e($loan->interest_rate); ?>% per Week<br></h6>
          <hr>
          <h6>Loan Duration:</strong> <?php echo e($loan->duration + $loan->grace_period); ?> Weeks<br></h6>
          <hr>
          <h6>Principle:</strong> <?php echo e(number_format($loan->principle)); ?> UGX<br></h6>
          <hr>
          <h6>Interest:</strong> <?php echo e(number_format(($loan->principle * $loan->interest_rate / 100) * $loan->duration )); ?> UGX<br></h6>
          <hr>
          <h6>Insurance Fee:</strong> <?php echo e(number_format($loan->insurance_fee)); ?> UGX<br></h6>
          <hr>
          <h6>Loan Application Fee:</strong> <?php echo e(number_format($loan->application_fee)); ?> UGX<br></h6>
        </div>
      </div>
    </div>

    <div class="br-section-wrapper info-section">
      <div class="row mg-t-20">
        <div class="col-xl-3"></div>
        <div class="col-xl-9">
          <h2>Payments Information</h2>
          <hr>
          <?php
            $pricinple = $loan->principle;
            $interest = ($loan->principle * $loan->interest_rate / 100) * $loan->duration;
            $total = $pricinple + $interest;
          ?>
          <h6>Grace Period:</strong> <?php echo e($loan->grace_period); ?> Weeks<br></h6>
          <hr>
          <h6>Total Due:</strong> <?php echo e(number_format($total)); ?> UGX<br></h6>
          <hr>
          <h6>Balance:</strong> <?php echo e(number_format( $total - $loan->payments->sum( 'amount' ) )); ?> UGX
          <hr>
          <h6>Each Installment:</strong> <?php echo e(number_format( $loan->partial_amount )); ?> UGX (With Interest)<br></h6>
          <hr>
          <h6>Payment Date:</strong> <?php echo e($loan->payment_day); ?><br></h6>
        </div>
      </div>
    </div>

    <div class="br-section-wrapper info-section">
      <table id="datatable1" class="table display responsive nowrap">
        <thead>
          <tr>
            <th>#</th>
            <th>Amount Expected</th>
            <th>Next Due Date</th>
            <th>Payments</th>
            <th>Installment Balance</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php $__currentLoopData = $loan->installments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $installment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <td><?php echo e($installment->id); ?></td>
              <td><?php echo e(number_format($installment->expected_amount)); ?> UGX</td>
              <td><?php echo e($installment->due_date); ?></td>
              <td><a href="<?php echo e(route( 'installments.show', [ $loan, $installment ] )); ?>"><?php echo e(count( $installment->payments )); ?></a></td>
              <td><?php echo e(number_format($installment->balance)); ?> UGX</td>
              <td><?php echo e($installment->status); ?></td>
              <td><a href="<?php echo e(route( 'installments.show', [$loan, $installment] )); ?>" class="btn btn-success ln_color_white">Payments</a></td>
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