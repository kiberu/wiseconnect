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
    <li class="br-menu-item">
      <a href="#" class="br-menu-link with-sub">
        <i class="menu-item-icon icon ion-ios-color-filter-outline tx-24"></i>
        <span class="menu-item-label">Clients</span>
      </a><!-- br-menu-link -->
      <ul class="br-menu-sub">
        <li class="sub-item"><a href="{{ route('groups.create') }}" class="sub-link">Add new group</a></li>
        <li class="sub-item"><a href="{{ route('groups.index') }}" class="sub-link">All groups</a></li>
      </ul>
    </li><!-- br-menu-item -->
    <li class="br-menu-item">
      <a href="#" class="br-menu-link with-sub">
        <i class="menu-item-icon icon ion-ios-filing-outline tx-24"></i>
        <span class="menu-item-label">Loans</span>
      </a><!-- br-menu-link -->
      <ul class="br-menu-sub">
        <li class="sub-item"><a href="{{ route('loans.create' ) }}" class="sub-link">Add Loan</a></li>
        <li class="sub-item"><a href="{{ route('loans.today' ) }}" class="sub-link">Today's Loans</a></li>
        <li class="sub-item"><a href="{{ route('loans.index') }}" class="sub-link">Active Loans</a></li>
        <li class="sub-item"><a href="{{ route('loans.defaulters') }}" class="sub-link">Defaulters</a></li>
      </ul>
    </li><!-- br-menu-item -->
    <li class="br-menu-item">
      <a href="#" class="br-menu-link with-sub">
        <i class="menu-item-icon icon ion-ios-briefcase-outline tx-22"></i>
        <span class="menu-item-label">System Users</span>
      </a><!-- br-menu-link -->
      <ul class="br-menu-sub">
        <li class="sub-item"><a href="{{ route('users.create') }}" class="sub-link">Add System User</a></li>
        <li class="sub-item"><a href="{{ route('users.index') }}" class="sub-link">All Users</a></li>
      </ul>
    </li><!-- br-menu-item -->
    <li class="br-menu-item">
      <a href="{{ route('finance.index') }}" class="br-menu-link">
        <i class="menu-item-icon icon ion-ios-paper-outline tx-22"></i>
        <span class="menu-item-label">Finance</span>
      </a><!-- br-menu-link -->
    </li><!-- br-menu-item -->
    <li class="br-menu-item">
      <a href="layouts.html" class="br-menu-link">
        <i class="menu-item-icon icon ion-ios-book-outline tx-22"></i>
        <span class="menu-item-label">Report</span>
      </a><!-- br-menu-link -->
    </li><!-- br-menu-item -->
  </ul><!-- br-sideleft-menu -->
  <br>
</div><!-- br-sideleft -->
