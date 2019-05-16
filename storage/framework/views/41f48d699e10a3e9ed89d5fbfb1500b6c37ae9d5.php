<?php $__env->startSection('content'); ?>

<div class="br-mainpanel">
  <div class="br-pageheader">
    <nav class="breadcrumb pd-0 mg-0 tx-12">
      <a class="breadcrumb-item" href="<?php echo e(route('home')); ?>">Home</a>
      <a class="breadcrumb-item" href="<?php echo e(route('user.index')); ?>">System Users</a>
      <span class="breadcrumb-item active">Add New User</span>
    </nav>
  </div><!-- br-pageheader -->
  <div class="br-pagetitle">
    <i class="icon icon ion-ios-briefcase-outline tx-22"></i>
    <div>
      <h4>Add User</h4>
      <p class="mg-b-0">Create User and assign roles</p>
    </div>
  </div><!-- d-flex -->

  <div class="br-pagebody">
    <div class="br-section-wrapper">
      <div class="row mg-t-20">
        <div class="col-xl-3"></div>
        <div class="col-xl-6 mg-t-20 mg-xl-t-0">
          <div class="form-layout form-layout-5">
            <form method="POST" action="<?php echo e(route('users.store')); ?>">
                <?php echo csrf_field(); ?>

                <div class="form-group row">
                    <label for="first_name" class="col-md-4 col-form-label text-md-right"><?php echo e(__('First Name')); ?></label>

                    <div class="col-md-6">
                        <input id="first_name" type="text" class="form-control<?php echo e($errors->has('first_name') ? ' is-invalid' : ''); ?>" name="first_name" value="<?php echo e(old('first_name')); ?>" required autofocus>

                        <?php if($errors->has('first_name')) : ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($errors->first('first_name')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="last_name" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Last Name')); ?></label>

                    <div class="col-md-6">
                        <input id="last_name" type="text" class="form-control<?php echo e($errors->has('last_name') ? ' is-invalid' : ''); ?>" name="last_name" value="<?php echo e(old('last_name')); ?>" required>

                        <?php if($errors->has('last_name')) : ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($errors->first('first_name')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right"><?php echo e(__('E-Mail Address')); ?></label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" name="email" value="<?php echo e(old('email')); ?>" required>

                        <?php if($errors->has('email')) : ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($errors->first('email')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Password')); ?></label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" name="password" required>

                        <?php if($errors->has('password')) : ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($errors->first('password')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Confirm Password')); ?></label>

                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="role" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Assign Role')); ?></label>

                    <div class="col-md-6">
                      <select class="form-control select2" name="role" data-placeholder="Choose one">
                        <option selected disabled value="" >Select Role</option>
                        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($role->name); ?>"><?php echo e($role->name); ?></option>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>

                        <?php if($errors->has('role')) : ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($errors->first('role')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-info">
                            <?php echo e(__('Register')); ?>

                        </button>
                    </div>
                </div>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>