@extends('backend.back_layouts')
@section('headname')
	Edit Page
@endsection
@section('content')
	@include('backend.page.edit-content')
    @push('scripts')
        <!-- CKEditor -->
        <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
        <script> let editor = CKEDITOR.replace( 'editor1', {
                filebrowserBrowseUrl: '{{ asset('ckfinder/ckfinder.html') }}',
                filebrowserImageBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Images') }}',
                filebrowserFlashBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Flash') }}',
                filebrowserUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
                filebrowserImageUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
                filebrowserFlashUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
            } ); 
            editor.addCommand('jsCommand', {
                exec: function(et) {
                    et.insertHtml('<div class="jsQuery"></div>');
                }
            })
            editor.ui.addButton('addJSCommand', {
                label: 'Add JS Block',
                command: 'jsCommand',
                toolbar: 'insert',
                icon: '../img/js.png',
            })
            editor.addCommand('phpCommand', {
                exec: function(et) {
                    et.insertHtml('<div class="phpQuery"></div>');
                }
            })
            editor.ui.addButton('addPHPCommand', {
                label: 'Add PHP Block',
                command: 'phpCommand',
                toolbar: 'insert',
                icon: '../img/php.png',
            })
            editor.addCommand('pythonCommand', {
                exec: function(et) {
                    et.insertHtml('<div class="pythonQuery"></div>');
                }
            })
            editor.ui.addButton('addPythonCommand', {
                label: 'Add Python Block',
                command: 'pythonCommand',
                toolbar: 'insert',
                icon: '../img/py.png',
            })
            </script>
    @endpush
@endsection
