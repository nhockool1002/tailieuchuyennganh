<div class="loading-wrap">
    <div class="loadingio-spinner-cube-ybnfvzk6hrb"><div class="ldio-4rdaneva26h">
        <div></div><div></div><div></div><div></div>
    </div></div>
</div>
</div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.5.1/axios.min.js" integrity="sha512-emSwuKiMyYedRwflbZB2ghzX8Cw8fmNVgZ6yQNNXXagFzFOaQmbvQ1vmDkddHjm5AITcBIZfC7k4ShQSjgPAmQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script>
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const loading = $('.loading-wrap');
            axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken;

            window.showLoading = () => loading.css('display', 'flex');
            window.hideLoading = () => loading.css('display', 'none');
        </script>
        <!--   Core JS Files   -->
        <script src="{{ asset('admin-assets/js/jquery-1.10.2.js') }}" type="text/javascript"></script>
        <script src="{{ asset('admin-assets/js/bootstrap.min.js') }}" type="text/javascript"></script>

        <!--  Checkbox, Radio & Switch Plugins -->
        <script src="{{ asset('admin-assets/js/bootstrap-checkbox-radio.js') }}"></script>

        <!--  Notifications Plugin    -->
        <script src="{{ asset('admin-assets/js/bootstrap-notify.js') }}"></script>

        <!--  Google Maps Plugin    -->
        <!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script> -->

        <!-- Paper Dashboard Core javascript and methods for Demo purpose -->
        <script src="{{ asset('admin-assets/js/paper-dashboard.js') }}"></script>

        @stack('scripts')
        <!-- CUSTOM CSS -->
        <script src="{{ asset('admin-assets/js/script.js') }}"></script>
    </body>
</html>
