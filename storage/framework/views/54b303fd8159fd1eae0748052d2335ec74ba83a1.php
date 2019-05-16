<?php $__env->startSection('content'); ?>

<div class="br-mainpanel">
  <div class="br-pageheader">
    <nav class="breadcrumb pd-0 mg-0 tx-12">
      <a class="breadcrumb-item" href="<?php echo e(route('home')); ?>">Home</a>
      <a class="breadcrumb-item" href="<?php echo e(route('loans.index')); ?>">Loans</a>
      <span class="breadcrumb-item active">Apply for Loan</span>
    </nav>
  </div><!-- br-pageheader -->
  <div class="br-pagetitle">
    <i class="icon icon ion-ios-color-filter-outline tx-22"></i>
    <div>
      <h4>Loan Application</h4>
      <p class="mg-b-0">Add new loan</p>
    </div>
  </div><!-- d-flex -->

  <div class="br-pagebody">
    <div class="br-section-wrapper">
      <div class="row mg-t-20">
        <div class="col-xl-3"></div>
          <div class="form-layout form-layout-6">
            <?php if(count($errors) > 0) : ?>
              <div class="alert alert-danger" role="alert">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <ul>
                    <li><?php echo e($error); ?></li>
                  </ul>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
            <?php endif; ?>
            <form method="POST" action="<?php echo e(route('loans.store')); ?>">
                <?php echo csrf_field(); ?>

                  <div class="row no-gutters">
                    <div class="col-5 col-sm-4">
                      Clients Id(*):
                    </div><!-- col-4 -->
                    <div class="col-7 col-sm-8">
                      <input  class="form-control <?php echo e($errors->has('client_id') ? ' is-invalid' : ''); ?>" value="<?php echo e(old('client_id')); ?>" type="integer" name="client_id"  autofocus>
                        <?php if($errors->has('client_id')) : ?>
                          <span class="invalid-feedback" role="alert">
                              <strong><?php echo e($errors->first('client_id')); ?></strong>
                          </span>
                        <?php endif; ?>
                    </div><!-- col-8 -->
                  </div><!-- row -->

                  <div class="row no-gutters">
                    <div class="col-5 col-sm-4">
                      Loan Type(*):
                    </div><!-- col-4 -->
                    <div class="col-7 col-sm-8">
                      <select name="loan_type" class="form-control <?php echo e($errors->has('loan_type') ? ' is-invalid' : ''); ?>" value="<?php echo e(old('loan_type')); ?>">
                        <option selected disabled>Choose Option</option>
                        <?php $__currentLoopData = $loan_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loan_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option <?php echo e(( old('loan_type') == $loan_type->id ) ? 'selected' : ''); ?> value="<?php echo e($loan_type->id); ?>"><?php echo e($loan_type->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                      </select>
                        <?php if($errors->has('loan_type')) : ?>
                          <span class="invalid-feedback" role="alert">
                              <strong><?php echo e($errors->first('loan_type')); ?></strong>
                          </span>
                        <?php endif; ?>
                    </div><!-- col-8 -->
                  </div><!-- row -->

                  <div class="row no-gutters">
                    <div class="col-5 col-sm-4">
                      Principle Amount(*):
                    </div><!-- col-4 -->
                    <div class="col-7 col-sm-8">
                      <input  class="form-control <?php echo e($errors->has('principle_amount') ? ' is-invalid' : ''); ?>" value="<?php echo e(old('principle_amount')); ?>" type="integer" name="principle_amount" >
                        <?php if($errors->has('principle_amount')) : ?>
                          <span class="invalid-feedback" role="alert">
                              <strong><?php echo e($errors->first('principle_amount')); ?></strong>
                          </span>
                        <?php endif; ?>
                    </div><!-- col-8 -->
                  </div><!-- row -->

                  <div class="row no-gutters">
                    <div class="col-5 col-sm-4">
                      Interest Rate(*):
                    </div><!-- col-4 -->
                    <div class="col-7 col-sm-8">
                      <input  class="form-control <?php echo e($errors->has('interest_rate') ? ' is-invalid' : ''); ?>" value="<?php echo e(old('interest_rate')); ?>" type="integer" name="interest_rate" > % per Week
                        <?php if($errors->has('interest_rate')) : ?>
                          <span class="invalid-feedback" role="alert">
                              <strong><?php echo e($errors->first('interest_rate')); ?></strong>
                          </span>
                        <?php endif; ?>
                    </div><!-- col-8 -->
                  </div><!-- row -->

                  <div class="row no-gutters">
                    <div class="col-5 col-sm-4">
                      Duration(*):
                    </div><!-- col-4 -->
                    <div class="col-7 col-sm-8">
                      <input  class="form-control <?php echo e($errors->has('duration') ? ' is-invalid' : ''); ?>" value="<?php echo e(old('duration')); ?>" type="integer" name="duration" > Weeks
                        <?php if($errors->has('duration')) : ?>
                          <span class="invalid-feedback" role="alert">
                              <strong><?php echo e($errors->first('duration')); ?></strong>
                          </span>
                        <?php endif; ?>
                    </div><!-- col-8 -->
                  </div><!-- row -->

                  <div class="row no-gutters">
                    <div class="col-5 col-sm-4">
                      Penalty(*):
                    </div><!-- col-4 -->
                    <div class="col-7 col-sm-8">
                      <input  class="form-control <?php echo e($errors->has('penalty') ? ' is-invalid' : ''); ?>" value="<?php echo e(old('penalty')); ?>" type="integer" name="penalty" > % per defaulted Week
                        <?php if($errors->has('penalty')) : ?>
                          <span class="invalid-feedback" role="alert">
                              <strong><?php echo e($errors->first('penalty')); ?></strong>
                          </span>
                        <?php endif; ?>
                    </div><!-- col-8 -->
                  </div><!-- row -->

                  <div class="row no-gutters">
                    <div class="col-5 col-sm-4">
                      Grace Period(*):
                    </div><!-- col-4 -->
                    <div class="col-7 col-sm-8">
                      <input  class="form-control <?php echo e($errors->has('grace_period') ? ' is-invalid' : ''); ?>" value="<?php echo e(old('grace_period')); ?>" type="integer" name="grace_period" > Days
                        <?php if($errors->has('grace_period')) : ?>
                          <span class="invalid-feedback" role="alert">
                              <strong><?php echo e($errors->first('grace_period')); ?></strong>
                          </span>
                        <?php endif; ?>
                    </div><!-- col-8 -->
                  </div><!-- row -->

                  <div class="row no-gutters">
                    <div class="col-5 col-sm-4">
                      Business Location:
                    </div><!-- col-4 -->
                    <div class="col-7 col-sm-8">
                      <div class="col-7 col-sm-8">
                        <input  class="form-control <?php echo e($errors->has('business_location') ? ' is-invalid' : ''); ?>" value="<?php echo e(old('business_location')); ?>" type="text" name="business_location"  placeholder="Enter Business Location">
                        <?php if($errors->has('business_location')) : ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($errors->first('business_location')); ?></strong>
                            </span>
                        <?php endif; ?>
                      </div><!-- col-8 -->
                    </div><!-- col-8 -->
                  </div><!-- row -->
                  <div class="row no-gutters">
                    <div class="col-5 col-sm-4">
                      Business Type:
                    </div><!-- col-4 -->
                    <div class="col-7 col-sm-8">
                      <select name="business_type" class="form-control <?php echo e($errors->has('business_type') ? ' is-invalid' : ''); ?>" value="<?php echo e(old('business_type')); ?>">
                        <option selected disabled>Choose Option</option>
                        <?php $__currentLoopData = $business_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $business_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option <?php echo e(( old('business_type') == $business_type->id ) ? 'selected' : ''); ?> value="<?php echo e($business_type->id); ?>"><?php echo e($business_type->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                      </select>
                        <?php if($errors->has('business_type')) : ?>
                          <span class="invalid-feedback" role="alert">
                              <strong><?php echo e($errors->first('business_type')); ?></strong>
                          </span>
                        <?php endif; ?>
                    </div><!-- col-8 -->
                  </div><!-- row -->

                  <div class="row no-gutters">
                    <div class="col-5 col-sm-4">
                      Day of Payment:
                    </div><!-- col-4 -->
                    <div class="col-7 col-sm-8">
                      <select name="payment_day" class="form-control <?php echo e($errors->has('payment_day') ? ' is-invalid' : ''); ?>" value="<?php echo e(old('payment_day')); ?>">
                        <option selected disabled>Choose Option</option>
                        <?php $__currentLoopData = $payment_days; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $payment_day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option <?php echo e(( old('payment_day') == $key ) ? 'selected' : ''); ?> value="<?php echo e($key); ?>"><?php echo e($payment_day); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                      </select>
                        <?php if($errors->has('payment_day')) : ?>
                          <span class="invalid-feedback" role="alert">
                              <strong><?php echo e($errors->first('payment_day')); ?></strong>
                          </span>
                        <?php endif; ?>
                    </div><!-- col-8 -->
                  </div><!-- row -->

                  <div class="row no-gutters">
                    <div class="col-5 col-sm-4">
                      Application Fee:
                    </div><!-- col-4 -->
                    <div class="col-7 col-sm-8">
                      <div class="col-7 col-sm-8">
                        <input  class="form-control <?php echo e($errors->has('application_fee') ? ' is-invalid' : ''); ?>" value="<?php echo e(old('application_fee')); ?>" type="text" name="application_fee"  placeholder="Application fee">
                        <?php if($errors->has('application_fee')) : ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($errors->first('application_fee')); ?></strong>
                            </span>
                        <?php endif; ?>
                      </div><!-- col-8 -->
                    </div><!-- col-8 -->
                  </div><!-- row -->

                  <div class="row no-gutters">
                    <div class="col-5 col-sm-4">
                      Insurance Fee:
                    </div><!-- col-4 -->
                    <div class="col-7 col-sm-8">
                      <div class="col-7 col-sm-8">
                        <input  class="form-control <?php echo e($errors->has('insurance_fee') ? ' is-invalid' : ''); ?>" value="<?php echo e(old('insurance_fee')); ?>" type="text" name="insurance_fee"  placeholder="Insurance fee">
                        <?php if($errors->has('insurance_fee')) : ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($errors->first('insurance_fee')); ?></strong>
                            </span>
                        <?php endif; ?>
                      </div><!-- col-8 -->
                    </div><!-- col-8 -->
                  </div><!-- row -->

                  <div class="row no-gutters">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-info">
                            <?php echo e(__('Save loan')); ?>

                        </button>
                    </div>
                  </div><!-- row -->


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