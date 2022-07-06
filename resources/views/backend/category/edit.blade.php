@extends('backend.back_layouts')
@section('headname')
	Edit Category
@endsection
@section('content')
	@include('backend.category.edit-content')
	@push('scripts')
        <!-- Import typeahead.js -->
        <script src="https://twitter.github.io/typeahead.js/releases/latest/typeahead.bundle.js"></script>
 
        <!-- Initialize typeahead.js on the input -->
        <script>
            $(document).ready(function() {
                var bloodhound = new Bloodhound({
                    datumTokenizer: Bloodhound.tokenizers.whitespace,
                    queryTokenizer: Bloodhound.tokenizers.whitespace,
                    remote: {
                        url: '{{ route('findUser') }}?q=%QUERY%',
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
                        return data.username  //Input value to be set when you select a suggestion. 
                    },
                    templates: {
                        empty: [
                            '<div class="list-group search-results-dropdown"><div class="list-group-item">Nothing found.</div></div>'
                        ],
                        header: [
                            '<div class="list-group search-results-dropdown">'
                        ],
                        suggestion: function(data) {
                        return '<div style="font-weight:normal; margin-top:-10px ! important;" class="list-group-item">' + data.username + '</div></div>'
                        }
                    }
                });
            });
        </script>
	@endpush
@endsection