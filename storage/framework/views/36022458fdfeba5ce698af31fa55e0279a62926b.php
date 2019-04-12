<div class="br-header">
  <div class="br-header-left">
    <div class="navicon-left hidden-md-down"><a id="btnLeftMenu" href=""><i class="icon ion-navicon-round"></i></a></div>
    <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href=""><i class="icon ion-navicon-round"></i></a></div>

  </div><!-- br-header-left -->
  <div class="br-header-right">
    <nav class="nav">

      <div class="dropdown">
        <a href="" class="nav-link nav-link-profile" data-toggle="dropdown">
          <span class="logged-name hidden-md-down"><?php echo e(Auth::user()->first_name); ?> <?php echo e(Auth::user()->last_name); ?></span>
          <img src="https://via.placeholder.com/500" class="wd-32 rounded-circle" alt="">
          <span class="square-10 bg-success"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-header wd-250">
          <div class="tx-center">
            <a href=""><img src="https://via.placeholder.com/500" class="wd-80 rounded-circle" alt=""></a>
            <h6 class="logged-fullname"><?php echo e(Auth::user()->first_name); ?> <?php echo e(Auth::user()->last_name); ?></h6>
            <p><?php echo e(Auth::user()->email); ?></p>
          </div>
          <hr>
          <ul class="list-unstyled user-profile-nav">

            <li>
              <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
               onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                             <i class="icon ion-power"></i> Sign Out</a>
            </li>

            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                <?php echo csrf_field(); ?>
            </form>
          </ul>
        </div><!-- dropdown-menu -->
      </div><!-- dropdown -->
    </nav>

  </div><!-- br-header-right -->
</div><!-- br-header -->
