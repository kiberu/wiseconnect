<!DOCTYPE html>
<html lang="en">
  @include('partials._head')
  <body>

    <!-- ########## START: LEFT PANEL ########## -->
    @include('partials._left_panel')
    <!-- ########## END: LEFT PANEL ########## -->

    <!-- ########## START: TOP PANEL ########## -->
    @include('partials._top_panel')
    <!-- ########## END: TOP PANEL ########## -->

    <!-- ########## START: RIGHT PANEL ########## -->
    @include('partials._right_panel')
    <!-- ########## END: RIGHT PANEL ########## --->

    @yield('content')

    @yield('scripts')
  </body>
</html>
