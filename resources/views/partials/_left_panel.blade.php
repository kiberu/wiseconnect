<div class="br-logo"><a href=""><span>[</span><i>loan</i>system<span>]</span></a></div>
<div class="br-sideleft sideleft-scrollbar">
  <label class="sidebar-label pd-x-10 mg-t-20 op-3">Navigation</label>
  <ul class="br-sideleft-menu">
    <li class="br-menu-item">
      <a href="{{ route('home') }}" class="br-menu-link">
        <i class="menu-item-icon icon ion-ios-home-outline tx-24"></i>
        <span class="menu-item-label">Dashboard</span>
      </a><!-- br-menu-link -->
    </li><!-- br-menu-item -->
    @if ( Auth::user()->can('manage-loans') )
      <li class="br-menu-item">
        <a href="{{ route('loans.index') }}" class="br-menu-link">
          <i class="menu-item-icon icon ion-ios-color-filter-outline tx-24"></i>
          <span class="menu-item-label">Applications(Loans)</span>
        </a><!-- br-menu-link -->
      </li><!-- br-menu-item -->
      @if ( Auth::user()->can('manage-clients') )
      <li class="br-menu-item">
        <a href="{{ route('groups.index') }}" class="br-menu-link">
          <i class="menu-item-icon icon ion-ios-color-filter-outline tx-24"></i>
          <span class="menu-item-label">Groups</span>
        </a><!-- br-menu-link -->
      </li><!-- br-menu-item -->
    @endif
    @endif

    @if ( Auth::user()->can('manage-users') )
      <li class="br-menu-item">
        <a href="{{ route('user.index') }}" class="br-menu-link">
          <i class="menu-item-icon icon ion-ios-briefcase-outline tx-22"></i>
          <span class="menu-item-label">System Users</span>
        </a><!-- br-menu-link -->
      </li><!-- br-menu-item -->

    @endif
    @if ( Auth::user()->can('manage-finance') )
      <li class="br-menu-item">
        <a href="{{ route('finance.index') }}" class="br-menu-link">
          <i class="menu-item-icon icon ion-ios-paper-outline tx-22"></i>
          <span class="menu-item-label">Finance</span>
        </a><!-- br-menu-link -->
      </li><!-- br-menu-item -->
    @endif
    @if ( Auth::user()->can('manage-reports') )
      <li class="br-menu-item">
        <a href="#" class="br-menu-link with-sub">
          <i class="menu-item-icon icon ion-ios-briefcase-outline tx-22"></i>
          <span class="menu-item-label">Reports</span>
        </a><!-- br-menu-link -->
        <ul class="br-menu-sub">
          <li class="sub-item"><a href="{{ route('groups.index') }}" class="sub-link">Groups</a></li>
          <li class="sub-item"><a href="{{ route('loans.index' ) }}" class="sub-link">Loans</a></li>
          <li class="sub-item"><a href="{{ route('loans.index' ) }}" class="sub-link">System Users</a></li>
        </ul>
      </li><!-- br-menu-item -->
  @endif
  @if ( Auth::user()->hasRole('general_manager') )
    <li class="br-menu-item">
      <a href="#" class="br-menu-link with-sub">
        <i class="menu-item-icon icon ion-ios-filing-outline tx-24"></i>
        <span class="menu-item-label">Options</span>
      </a><!-- br-menu-link -->
      <ul class="br-menu-sub">
        <li class="sub-item"><a href="{{ route('options.index' ) }}" class="sub-link">Manage Options</a></li>
      </ul>
    </li><!-- br-menu-item -->
  @endif
  </ul><!-- br-sideleft-menu -->
  <br>
</div><!-- br-sideleft -->
