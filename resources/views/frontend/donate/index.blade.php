@extends('frontend.front_layouts')
@section('content')
	@include('frontend.donate.breadcrum')
	@include('frontend.donate.content')
@endsection
@push('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
    $('#your-link').DataTable( {
        "order": [[ 2, "asc" ]],
        "language": {
            "lengthMenu": "Hiển thị _MENU_ mỗi trang",
            "zeroRecords": "Không có dữ liệu",
            "info": "Tổng cộng",
            "infoEmpty": "Không có dữ liệu",
            "infoFiltered": "(filtered from _MAX_ total records)"
        },
        "oLanguage": {
            "sSearch": "Tìm kiếm ",
            "oPaginate" : {
                "sNext" : "Tiếp theo",
                "sPrevious" : "Trang trước"    
            },
            "sInfo": "Hiển thị _TOTAL_ trong _END_ khóa học",
            "sLengthMenu" : "Hiển thị _MENU_ khóa học"
    }
    });
});
</script>
@endpush
@push('styles')
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css" rel="stylesheet">
@endpush