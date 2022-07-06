    <div class="main-panel">
        @include('common.back.topsetting')
        <div class="content">
            @include('backend.setting.donate.listcourse.main-content-listcourse')
        </div>
    @include('common.back.copyright')
    @push('scripts')
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#your-link').DataTable();
        } );
    </script>
    @endpush
    @push('styles')
        <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css" rel="stylesheet">
    @endpush
    </div>