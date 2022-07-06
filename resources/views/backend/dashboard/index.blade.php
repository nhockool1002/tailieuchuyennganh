@extends('backend.back_layouts')
@section('headname')
	Dashboard
@endsection
@section('content')
@include('backend.dashboard.content')
    @push('scripts')
        <!--  Charts Plugin -->
        <script src="{{ asset('admin-assets/js/chartist.min.js') }}"></script>
        <!-- Paper Dashboard DEMO methods, don't include it in your project! -->
        <script src="{{ asset('admin-assets/js/demo.js') }}"></script>
        <script type="text/javascript">
            $(document).ready(function(){

                demo.initChartist();

                $.notify({
                    icon: 'ti-gift',
                    message: "Welcome to <b>Paper Dashboard</b> - a beautiful Bootstrap freebie for your next project."

                },{
                    type: 'success',
                    timer: 4000
                });

            });
        </script>
    @endpush
@endsection
