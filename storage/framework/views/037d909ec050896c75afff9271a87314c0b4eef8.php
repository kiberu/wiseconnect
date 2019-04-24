<!DOCTYPE html>
<html lang="en">
  <?php echo $__env->make('partials._head', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <body>

    <!-- ########## START: LEFT PANEL ########## -->
    <?php echo $__env->make('partials._left_panel', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <!-- ########## END: LEFT PANEL ########## -->

    <!-- ########## START: TOP PANEL ########## -->
    <?php echo $__env->make('partials._top_panel', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <!-- ########## END: TOP PANEL ########## -->

    <!-- ########## START: RIGHT PANEL ########## -->
    <?php echo $__env->make('partials._right_panel', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <!-- ########## END: RIGHT PANEL ########## --->

    <?php echo $__env->yieldContent('content'); ?>

    <?php echo $__env->yieldContent('scripts'); ?>
  </body>
</html>
