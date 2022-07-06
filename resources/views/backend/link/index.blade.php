@extends('backend.back_layouts')
@section('headname')
	Links Manager
@endsection
@section('content')
	@include('backend.link.content')
@endsection
@push('scripts')
<script>
	function openPage(pageName,elmnt,color) {
	    var i, tabcontent, tablinks;
	    tabcontent = document.getElementsByClassName("tabcontent");
	    for (i = 0; i < tabcontent.length; i++) {
	        tabcontent[i].style.display = "none";
	    }
	    tablinks = document.getElementsByClassName("tablink");
	    for (i = 0; i < tablinks.length; i++) {
	        tablinks[i].style.backgroundColor = "";
	    }
	    document.getElementById(pageName).style.display = "block";

	    $('.tablink').removeClass('active');
	    elmnt.classList.add('active');
	}
	document.getElementById("defaultOpen").click();
</script>
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