<?php $__env->startSection('content'); ?>

<div class="br-mainpanel">
  <div class="br-pageheader">
    <nav class="breadcrumb pd-0 mg-0 tx-12">
      <a class="breadcrumb-item" href="<?php echo e(route('home')); ?>">Home</a>
      <a class="breadcrumb-item" href="<?php echo e(route('groups.index')); ?>">Groups</a>
      <a class="breadcrumb-item" href="<?php echo e(route('groups.show', $group)); ?>"><?php echo e($group->name); ?></a>
      <span class="breadcrumb-item active">Add Client</span>
    </nav>
  </div><!-- br-pageheader -->
  <div class="br-pagetitle">
    <i class="icon icon ion-ios-briefcase-outline tx-22"></i>
    <div>
      <h4>Add Client</h4>
      <p class="mg-b-0">Add Client to group <?php echo e($group->name); ?></p>
    </div>
  </div><!-- d-flex -->

  <div class="br-pagebody">
    <div class="br-section-wrapper">
      <div class="row mg-t-20">
        <div class="col-xl-3"></div>
        <div class="col-xl-6 mg-t-20 mg-xl-t-0">
          <div class="form-layout form-layout-5">
            <?php if(count($errors) > 0) : ?>
              <div class="alert alert-danger" role="alert">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <ul>
                    <li><?php echo e($error); ?></li>
                  </ul>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
            <?php endif; ?>
            <form method="POST" action="<?php echo e(route('clients.store', $group)); ?>">
                <?php echo csrf_field(); ?>
                <div class="form-layout form-layout-6">
                  <div class="row no-gutters">
                    <div class="col-5 col-sm-4">
                      Firstname(*):
                    </div><!-- col-4 -->
                    <div class="col-7 col-sm-8">
                      <input  class="form-control <?php echo e($errors->has('first_name') ? ' is-invalid' : ''); ?>" value="<?php echo e(old('first_name')); ?>" type="text" name="first_name"  placeholder="Enter client's first name" autofocus>
                        <?php if($errors->has('first_name')) : ?>
                          <span class="invalid-feedback" role="alert">
                              <strong><?php echo e($errors->first('first_name')); ?></strong>
                          </span>
                        <?php endif; ?>
                    </div><!-- col-8 -->
                  </div><!-- row -->
                  <div class="row no-gutters">
                    <div class="col-5 col-sm-4">
                      Lastname(*):
                    </div><!-- col-4 -->
                    <div class="col-7 col-sm-8">
                      <input  class="form-control <?php echo e($errors->has('last_name') ? ' is-invalid' : ''); ?>" value="<?php echo e(old('last_name')); ?>" type="text" name="last_name"  placeholder="Enter client's last name">
                        <?php if($errors->has('last_name')) : ?>
                          <span class="invalid-feedback" role="alert">
                              <strong><?php echo e($errors->first('last_name')); ?></strong>
                          </span>
                        <?php endif; ?>
                    </div><!-- col-8 -->
                  </div><!-- row -->
                  <div class="row no-gutters">
                    <div class="col-5 col-sm-4">
                      Gender(*):
                    </div><!-- col-4 -->
                    <div class="col-7 col-sm-8">
                      <select name="gender" class="form-control <?php echo e($errors->has('gender') ? ' is-invalid' : ''); ?>" value="<?php echo e(old('gender')); ?>">
                        <option selected disabled>Choose Option</option>
                        <option <?php echo e(( old('gender') == 'Male') ? 'selected' : ''); ?> value="Male">Male</option>
                        <option <?php echo e(( old('gender') == 'Female' ) ? 'selected' : ''); ?> value="Female">Female</option>
                      </select>
                        <?php if($errors->has('gender')) : ?>
                          <span class="invalid-feedback" role="alert">
                              <strong><?php echo e($errors->first('gender')); ?></strong>
                          </span>
                        <?php endif; ?>
                    </div><!-- col-8 -->
                  </div><!-- row -->
                  <div class="row no-gutters">
                    <div class="col-5 col-sm-4">
                      Date of Birth(*):
                    </div><!-- col-4 -->
                    <div class="col-7 col-sm-8">
                      <input  type="text" name="date_of_birth" class="form-control fc-datepicker <?php echo e($errors->has('date_of_birth') ? ' is-invalid' : ''); ?>" value="<?php echo e(old('date_of_birth')); ?>"  placeholder="MM/DD/YYYY"
                      >
                        <?php if($errors->has('date_of_birth')) : ?>
                          <span class="invalid-feedback" role="alert">
                              <strong><?php echo e($errors->first('date_of_birth')); ?></strong>
                          </span>
                        <?php endif; ?>

                    </div><!-- col-8 -->
                  </div><!-- row -->

                  <div class="row no-gutters">
                    <div class="col-5 col-sm-4">
                      Next of Kin(*):
                    </div><!-- col-4 -->
                    <div class="col-7 col-sm-8">
                      <input  class="form-control <?php echo e($errors->has('next_of_kin') ? ' is-invalid' : ''); ?>" value="<?php echo e(old('next_of_kin')); ?>" type="text" name="next_of_kin"  placeholder="Enter business type">
                        <?php if($errors->has('next_of_kin')) : ?>
                          <span class="invalid-feedback" role="alert">
                              <strong><?php echo e($errors->first('next_of_kin')); ?></strong>
                          </span>
                        <?php endif; ?>
                    </div><!-- col-8 -->
                  </div><!-- row -->
                  <div class="row no-gutters">
                    <div class="col-5 col-sm-4">
                      Phone Number(*):
                    </div><!-- col-4 -->
                    <div class="col-7 col-sm-8">
                      <input  class="form-control <?php echo e($errors->has('phone_number') ? ' is-invalid' : ''); ?>" value="<?php echo e(old('phone_number')); ?>" type="number" name="phone_number"  placeholder="Enter phone number">
                        <?php if($errors->has('phone_number')) : ?>
                          <span class="invalid-feedback" role="alert">
                              <strong><?php echo e($errors->first('phone_number')); ?></strong>
                          </span>
                        <?php endif; ?>
                    </div><!-- col-8 -->
                  </div><!-- row -->
                  <div class="row no-gutters">
                    <div class="col-5 col-sm-4">
                      Residential Address(*):
                    </div><!-- col-4 -->
                    <div class="col-7 col-sm-8">
                      <input  class="form-control <?php echo e($errors->has('residential_address') ? ' is-invalid' : ''); ?>" value="<?php echo e(old('residential_address')); ?>" type="text" name="residential_address"  placeholder="Enter Residential Address">
                        <?php if($errors->has('residential_address')) : ?>
                          <span class="invalid-feedback" role="alert">
                              <strong><?php echo e($errors->first('residential_address')); ?></strong>
                          </span>
                        <?php endif; ?>
                    </div><!-- col-8 -->
                  </div><!-- row -->

                  <div class="row no-gutters">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-info">
                            <?php echo e(__('Add')); ?>

                        </button>
                    </div>
                  </div><!-- row -->

                </div><!-- form-layout -->

            </form>

          </div><!-- form-layout -->
        </div><!-- col-6 -->
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
  <script>
    $(function(){
      // Datepicker
      $('.fc-datepicker').datepicker({
        showOtherMonths: true,
        selectOtherMonths: true
      });

      $('#datepickerNoOfMonths').datepicker({
        showOtherMonths: true,
        selectOtherMonths: true,
        numberOfMonths: 2
      });
    });
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>