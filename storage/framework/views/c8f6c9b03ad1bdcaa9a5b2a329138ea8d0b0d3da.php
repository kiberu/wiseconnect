<?php $__env->startSection('content'); ?>

<div class="br-mainpanel">
  <div class="br-pageheader">
    <nav class="breadcrumb pd-0 mg-0 tx-12">
      <a class="breadcrumb-item" href="<?php echo e(route('home')); ?>">Home</a>
      <span class="breadcrumb-item active">Options</span>
    </nav>
  </div><!-- br-pageheader -->
  <div class="br-pagetitle">
    <i class="icon icon ion-ios-color-filter-outline tx-22"></i>
    <div>
      <h4>All Options</h4>
      <p class="mg-b-0">Manage Options</p>
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

      <?php if(count($errors) > 0): ?>
        <div class="alert alert-danger" role="alert">
          <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <ul>
              <li><?php echo e($error); ?></li>
            </ul>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      <?php endif; ?>

      <div class="row">
        <div class="col">
          <h2>Business Types</h2>
          <form method="POST" action="<?php echo e(route('businesstypes.store')); ?>">
            <?php echo csrf_field(); ?>
            <input type="text" name="businessTypeName" placeholder="business type">
            <input type="submit" value="Add">
          </form>
          <table class="table responsive">
            <thead>
              <tr>
                <th>#</th>
                <th>Type</th>
              </tr>
            </thead>
            <tbody>
              <?php $__currentLoopData = $businessTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <td><?php echo e($bType->id); ?></td>
                  <td><?php echo e($bType->name); ?></td>
                  <td>
                    <form method="POST" action="<?php echo e(route('businesstypes.destroy', $bType )); ?>">
                      <?php echo csrf_field(); ?>
                      <input type="submit" value="Delete" class="btn btn-danger js-delete-business-type">
                    </form>
                  </td>
                </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
          </table>
        </div>
        <div class="col">
          <h2>Loan Types</h2>
          <?php if( ! isset($lType) ): ?>
            <form method="POST" action="<?php echo e(route('loantypes.store')); ?>">
              <?php echo csrf_field(); ?>
              <input class="form-control <?php echo e($errors->has('loanTypeName') ? ' is-invalid' : ''); ?>" value="<?php echo e(old('loanTypeName')); ?>" type="text" name="loanTypeName" placeholder="Loan Type">
              <?php if($errors->has('loanTypeName')): ?>
                  <span class="invalid-feedback" role="alert">
                      <strong><?php echo e($errors->first('loanTypeName')); ?></strong>
                  </span>
              <?php endif; ?>
              <input class="form-control <?php echo e($errors->has('loanTypeInterest') ? ' is-invalid' : ''); ?>" value="<?php echo e(old('loanTypeInterest')); ?>" type="number" name="loanTypeInterest" placeholder="Interest Rate">
              <?php if($errors->has('loanTypeInterest')): ?>
                  <span class="invalid-feedback" role="alert">
                      <strong><?php echo e($errors->first('loanTypeInterest')); ?></strong>
                  </span>
              <?php endif; ?>
              <input class="form-control <?php echo e($errors->has('loanTypeInsurance') ? ' is-invalid' : ''); ?>" value="<?php echo e(old('loanTypeInsurance')); ?>" type="number" name="loanTypeInsurance" placeholder="Insurance fee">
              <?php if($errors->has('loanTypeInsurance')): ?>
                  <span class="invalid-feedback" role="alert">
                      <strong><?php echo e($errors->first('loanTypeInsurance')); ?></strong>
                  </span>
              <?php endif; ?>
              <input class="form-control <?php echo e($errors->has('loanTypeOther') ? ' is-invalid' : ''); ?>" value="<?php echo e(old('loanTypeOther')); ?>" type="number" name="loanTypeOther" placeholder="Other Fees">
              <?php if($errors->has('loanTypeOther')): ?>
                  <span class="invalid-feedback" role="alert">
                      <strong><?php echo e($errors->first('loanTypeOther')); ?></strong>
                  </span>
              <?php endif; ?>
              <input type="submit" value="Add">
            </form>
          <?php endif; ?>
          <?php if( isset($lType) ): ?>
            <form method="POST" action="<?php echo e(route('loantypes.update', $lType)); ?>">
              <?php echo csrf_field(); ?>
              <input class="form-control <?php echo e($errors->has('loanTypeName') ? ' is-invalid' : ''); ?>" value="<?php echo e($lType->name); ?>" type="text" name="loanTypeName" placeholder="Loan Type">
              <?php if($errors->has('loanTypeName')): ?>
                  <span class="invalid-feedback" role="alert">
                      <strong><?php echo e($errors->first('loanTypeName')); ?></strong>
                  </span>
              <?php endif; ?>
              <input class="form-control <?php echo e($errors->has('loanTypeInterest') ? ' is-invalid' : ''); ?>" value="<?php echo e($lType->interest_rate); ?>" type="number" name="loanTypeInterest" placeholder="Interest Rate">
              <?php if($errors->has('loanTypeInterest')): ?>
                  <span class="invalid-feedback" role="alert">
                      <strong><?php echo e($errors->first('loanTypeInterest')); ?></strong>
                  </span>
              <?php endif; ?>
              <input class="form-control <?php echo e($errors->has('loanTypeInsurance') ? ' is-invalid' : ''); ?>" value="<?php echo e($lType->insurance_fee); ?>" type="number" name="loanTypeInsurance" placeholder="Insurance fee">
              <?php if($errors->has('loanTypeInsurance')): ?>
                  <span class="invalid-feedback" role="alert">
                      <strong><?php echo e($errors->first('loanTypeInsurance')); ?></strong>
                  </span>
              <?php endif; ?>
              <input class="form-control <?php echo e($errors->has('loanTypeOther') ? ' is-invalid' : ''); ?>" value="<?php echo e($lType->other_fee); ?>" type="number" name="loanTypeOther" placeholder="Other Fees">
              <?php if($errors->has('loanTypeOther')): ?>
                  <span class="invalid-feedback" role="alert">
                      <strong><?php echo e($errors->first('loanTypeOther')); ?></strong>
                  </span>
              <?php endif; ?>
              <input class="form-control <?php echo e($errors->has('loanTypeGrace') ? ' is-invalid' : ''); ?>" value="<?php echo e($lType->other_fee); ?>" type="number" name="loanTypeGrace" placeholder="Grace Period">
              <?php if($errors->has('loanTypeGrace')): ?>
                  <span class="invalid-feedback" role="alert">
                      <strong><?php echo e($errors->first('loanTypeGrace')); ?></strong>
                  </span>
              <?php endif; ?>
              <input type="submit" value="Edit">
            </form>
          <?php endif; ?>
          <table class="table responsive">
            <thead>
              <tr>
                <th>#</th>
                <th>Type</th>
                <th>Interest Rate</th>
                <th>Insurance Fee</th>
                <th>Other Fee</th>
              </tr>
            </thead>
            <tbody>
              <?php $__currentLoopData = $loanTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $loanType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <td><?php echo e($loanType->id); ?></td>
                  <td><?php echo e($loanType->name); ?></td>
                  <td><?php echo e($loanType->interest_rate); ?></td>
                  <td><?php echo e($loanType->insurance_fee); ?></td>
                  <td><?php echo e($loanType->other_fee); ?></td>
                  <td><a class="btn btn-success" href="<?php echo e(route( 'loantypes.edit', $loanType )); ?>"> Edit </a></td>
                  <td>
                    <form method="POST" action="<?php echo e(route('loantypes.destroy', $loanType )); ?>">
                      <?php echo csrf_field(); ?>
                      <input type="submit" value="Delete" class="btn btn-danger js-delete-loan-type">
                    </form>
                  </td>
                </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
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
  $(".js-delete-business-type").on('click', function(e) {
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

  $(".js-delete-loan-type").on('click', function(e) {
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

    $('#datatable1').DataTable({
      responsive: false,
      language: {
        searchPlaceholder: 'Search...',
        sSearch: '',
        lengthMenu: '_MENU_ items/page',
      }
    });
    // Select2
    $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });

  });



  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>