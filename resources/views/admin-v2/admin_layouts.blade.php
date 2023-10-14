<!DOCTYPE html>
<html lang="en">
  @include('admin-v2.common._header')
  <body>
    @include('admin-v2.common._loading')
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      @include('admin-v2.common._sidebar')
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
        @include('admin-v2.common._navigation')
        <!-- partial -->
        <div class="main-panel">
          @yield('CONTENT')
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          @include('admin-v2.common._footer')
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('assets-admin-v2/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('assets-admin-v2/vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('assets-admin-v2/vendors/progressbar.js/progressbar.min.js') }}"></script>
    <script src="{{ asset('assets-admin-v2/vendors/jvectormap/jquery-jvectormap.min.js') }}"></script>
    <script src="{{ asset('assets-admin-v2/vendors/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('assets-admin-v2/vendors/owl-carousel-2/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets-admin-v2/vendors/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets-admin-v2/vendors/typeahead.js/typeahead.bundle.min.js') }}"></script>
    <!-- End plugin js for this page -->
    <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('assets-admin-v2/js/custom.js') }}"></script>
    <!-- inject:js -->
    <script src="{{ asset('assets-admin-v2/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets-admin-v2/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('assets-admin-v2/js/misc.js') }}"></script>
    <script src="{{ asset('assets-admin-v2/js/settings.js') }}"></script>
    <script src="{{ asset('assets-admin-v2/js/todolist.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="{{ asset('assets-admin-v2/js/dashboard.js') }}"></script>
    <!-- End custom js for this page -->
    <script>
      @yield('CUSTOM_JS')
    </script>
  </body>
</html>
