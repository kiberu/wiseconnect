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
      <h4>Bank Transactions</h4>
      <p class="mg-b-0"><?php echo e(Auth::user()->getRoleNames()); ?></p>
    </div>
  </div><!-- d-flex -->

  <div class="br-pagebody">
    <div>
        <?php if(count($errors) > 0) : ?>
        <div class="alert alert-danger" role="alert">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <ul>
              <li><?php echo e($error); ?></li>
            </ul>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php endif; ?>
      <form method="POST" action="<?php echo e(route('banks.store')); ?>">
            <?php echo csrf_field(); ?>
        <label>Transaction ID</lable><input class="" name="trans_id"/>
            <?php if($errors->has('trans_id')) : ?>
              <span class="invalid-feedback" role="alert">
                  <strong><?php echo e($errors->first('trans_id')); ?></strong>
              </span>
            <?php endif; ?>
        <label>Amount</lable><input class="" name="amount"/>
            <?php if($errors->has('amount')) : ?>
              <span class="invalid-feedback" role="alert">
                  <strong><?php echo e($errors->first('amount')); ?></strong>
              </span>
            <?php endif; ?>
        <label>Banked By</lable><input class="" name="banked_by"/>
            <?php if($errors->has('banked_by')) : ?>
              <span class="invalid-feedback" role="alert">
                  <strong><?php echo e($errors->first('banked_by')); ?></strong>
              </span>
            <?php endif; ?>
        <lable>Type</lable>
          <select name="type" class="<?php echo e($errors->has('type') ? ' is-invalid' : ''); ?>">
            <option selected disabled>Choose Option</option>
            <option <?php echo e(( old('type') == 'Deposit' ) ? 'selected' : ''); ?> value="Deposit">Deposit</option>
            <option <?php echo e(( old('type') == 'Withdraw' ) ? 'selected' : ''); ?> value="Withdraw">Withdraw</option>
            <option <?php echo e(( old('type') == 'Transfer' ) ? 'selected' : ''); ?> value="Transfer">Transfer</option>
            <option <?php echo e(( old('type') == 'Interest' ) ? 'selected' : ''); ?> value="Interest">Interest</option>
            <option <?php echo e(( old('type') == 'Commission' ) ? 'selected' : ''); ?> value="Commission">Commission</option>
            <option <?php echo e(( old('type') == 'Bank_charges' ) ? 'selected' : ''); ?> value="Bank_charges">Bank_charges</option>

          </select>
            <?php if($errors->has('loan_type')) : ?>
              <span class="invalid-feedback" role="alert">
                  <strong><?php echo e($errors->first('loan_type')); ?></strong>
              </span>
            <?php endif; ?>
          <input type="submit" value="submit"/>
      </form>
    </div>
    <div class="br-section-wrapper info-section">
      <table id="datatable1" class="table display responsive nowrap">
        <thead>
          <tr>
            <th>#</th>
            <th>Transaction Id</th>
            <th>Amount</th>
            <th>Type</th>
            <th>Banked By</th>
            <th>Entry By</th>
            <th>Date</th>
          </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $banks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bank): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <td><?php echo e($bank->id); ?></td>
              <td><?php echo e($bank->transaction_id); ?></td>
              <td><?php echo e($bank->amount); ?></td>
              <td><?php echo e($bank->type); ?></td>
              <td><?php echo e($bank->banked_by); ?></td>
              <td><?php echo e($bank->user->fullName); ?></td>
              <td><?php echo e($bank->created_at); ?></td>
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
  <script src="<?php echo e(asset('lib/datatables.net/js/jquery.dataTables.min.js')); ?>"></script>
  <script src="<?php echo e(asset('lib/datatables.net-dt/js/dataTables.dataTables.min.js')); ?>"></script>
  <script src="<?php echo e(asset('lib/datatables.net-responsive/js/dataTables.responsive.min.js')); ?>"></script>
  <script src="<?php echo e(asset('lib/datatables.net-responsive-dt/js/responsive.dataTables.min.js')); ?>"></script>
  <script src="<?php echo e(asset('lib/select2/js/select2.min.js')); ?>"></script>

  <script src="<?php echo e(asset('js/bracket.js')); ?>"></script>
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