@extends('backend.back_layouts')
@section('headname')
    Add Post
@endsection
@section('content')
    @include('backend.post.add-content')
    @push('scripts')
        <!-- CKEditor -->
        <script type="text/javascript">
            window.onbeforeunload = function() {
                return "Are you sure?";
            };
        </script>
        <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
        <script>
            let editor = CKEDITOR.replace( 'editor1', {
                filebrowserBrowseUrl: '{{ asset('ckfinder/ckfinder.html') }}',
                filebrowserImageBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Images') }}',
                filebrowserFlashBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Flash') }}',
                filebrowserUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
                filebrowserImageUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
                filebrowserFlashUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}',
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

        <!-- Import typeahead.js -->
        <script src="https://twitter.github.io/typeahead.js/releases/latest/typeahead.bundle.js"></script>
 
        <!-- Initialize typeahead.js on the input -->
        <script>
            $(document).ready(function() {
                var bloodhound = new Bloodhound({
                    datumTokenizer: Bloodhound.tokenizers.whitespace,
                    queryTokenizer: Bloodhound.tokenizers.whitespace,
                    remote: {
                        url: '{{ route('filterHashTag') }}?q=%QUERY%',
                        wildcard: '%QUERY%'
                    },
                });
                
                $('#search').typeahead({
                    hint: true,
                    highlight: true,
                    minLength: 1
                }, {
                    name: 'users',
                    source: bloodhound,
                    display: function(data) {
                        return data.hashtag_name  //Input value to be set when you select a suggestion. 
                    },
                    templates: {
                        empty: [
                            '<div class="list-group search-results-dropdown"><div class="list-group-item">Nothing found.</div></div>'
                        ],
                        header: [
                            '<div class="list-group search-results-dropdown">'
                        ],
                        suggestion: function(data) {
                        return '<div style="font-weight:normal; margin-top:-10px ! important;" class="list-group-item">' + data.hashtag_name + '</div></div>'
                        }
                    }
                });
            });
        </script>
        <script>
            window.count = 0;
            window.elHT = [];
            window.dlbox = 0;
            window.download = [];
            $(document).ready(function() {
                var input = $("#search");
                var err = $("#hashtag-error");
                input.focus(function(event) {
                    err.css({display: 'none'});
                });
            });
            function addHashtag() {
                var input = $("#search");
                var err = $("#hashtag-error");
                var ullist = $("#hashtag-ul");
                if (input.val() == "") {
                    err.css({display: 'block'});
                }
                else {
                    if (jQuery.inArray(input.val(), window.elHT) != -1) {
                        err.css({display: 'block'});
                        err.html('<i class="fa fa-times" aria-hidden="true"></i> Hashtag đã tồn tại!')
                    }
                    else {
                        ullist.append('<li class="li-hashtag hashtag-'+window.count+'">'+input.val()+'<input type="hidden" name="listht[]" value="'+input.val()+'""><span class="removeHTNow" onclick="removeLiHT('+ window.count +')">X</span>'+'</li>');
                        window.count++;
                        window.elHT.push(input.val());
                        input.val("");
                    }
                }
            }
            function removeLiHT(data){
               var elHashTag = $(".hashtag-"+data);
               elHashTag.remove();
            }

            function addDLzone(){
                var zonebox = $("#datadownload");

                zonebox.append('<div class="col-sm-12 downloaded-box downloaded-'+window.dlbox+'"><div class="col-sm-5"><input type="text" name="listdl['+window.dlbox+'][title]" placeholder="Tiêu đề" class="form-control border-input"></div><div class="col-sm-6"><input type="text" name="listdl['+window.dlbox+'][link]" placeholder="Link tải" class="form-control border-input"></div><div class="col-sm-1"><button type="button" onclick="removeDLB('+window.dlbox+')" class="btn btn-romo btn-warning btn-fill btn-xs"><i class="ti ti-eraser"></i></button></div></div>');
                window.dlbox++;
            }

            function removeDLB(data) {
                var elHashTag = $(".downloaded-"+data);
                elHashTag.remove();
            }
        </script>
    @endpush
@endsection
