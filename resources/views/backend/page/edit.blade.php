@extends('backend.back_layouts')
@section('headname')
	Edit Page
@endsection
@section('content')
	@include('backend.page.edit-content')
    @push('scripts')
        <!-- CKEditor -->
        <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
        <script> CKEDITOR.replace( 'editor1', {
                filebrowserBrowseUrl: '{{ asset('ckfinder/ckfinder.html') }}',
                filebrowserImageBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Images') }}',
                filebrowserFlashBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Flash') }}',
                filebrowserUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
                filebrowserImageUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
                filebrowserFlashUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
            } ); </script>
    @endpush
@endsection
