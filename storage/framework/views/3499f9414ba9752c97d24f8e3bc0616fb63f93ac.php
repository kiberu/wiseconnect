<?php $__env->startSection('content'); ?>

<div class="br-mainpanel">
  <div class="br-pageheader">
    <nav class="breadcrumb pd-0 mg-0 tx-12">
      <a class="breadcrumb-item" href="<?php echo e(route('home')); ?>">Home</a>
      <a class="breadcrumb-item" href="<?php echo e(route('loans.show', $loan )); ?>">Loan</a>
      <a class="breadcrumb-item" href="<?php echo e(route('installments.show', [$loan, $installment] )); ?>"><?php echo e($installment->due_date); ?></a>
      <span class="breadcrumb-item active">Payment</span>
    </nav>
  </div><!-- br-pageheader -->
  <div class="br-pagetitle">
    <i class="icon icon ion-ios-color-filter-outline tx-22"></i>
    <div>
      <h4>Make payment</h4>
      <p class="mg-b-0">Add payment to installment <?php echo e($installment->due_date); ?></p>
    </div>
  </div><!-- d-flex -->

  <div class="br-pagebody">
    <div class="br-section-wrapper">
      <div class="row mg-t-20">
        <div class="col-xl-3"></div>
          <div class="form-layout form-layout-5">

            <form method="POST" action="<?php echo e(route('payments.store', [$loan, $installment] )); ?>">
                <?php echo csrf_field(); ?>

                <div class="form-layout form-layout-2">
                  <div class="row no-gutters">
                    <div class="col-md-12 mg-t--1 mg-md-t-0">
                      <div class="form-group">
                        <label class="form-control-label">Amount Paid <span class="tx-danger">*</span></label>
                        <input class="form-control <?php echo e($errors->has('amount_paid') ? ' is-invalid' : ''); ?>" type="integer" name="amount_paid" value="<?php echo e(old('amount_paid')); ?>" autofocus>
                        <?php if($errors->has('amount_paid')): ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($errors->first('amount_paid')); ?></strong>
                            </span>
                        <?php endif; ?>
                      </div>
                    </div><!-- col-12 -->

                    <div class="col-md-12 mg-t--1 mg-md-t-0">
                      <div class="form-group mg-md-l--1">
                        <button type="submit" class="btn btn-info">
                            <?php echo e(__('Save')); ?>

                        </button>
                      </div>
                    </div><!-- col-12 -->

                </div><!-- form-layout -->
            </form>

          </div><!-- form-layout -->
        <div class="col-xl-3"></div>
      </div><!-- row -->
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