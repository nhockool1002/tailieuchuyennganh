            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="alertbox">
                            @if(count($errors) > 0)
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $err)
                                    <i class="fa fa-times" aria-hidden="true"></i> {{$err}}<br>
                                @endforeach
                            </div>
                            @endif
                            @if(session('success_mesage'))
                                <div class="alert alert-success">
                                    <i class="fa fa-check" aria-hidden="true"></i> {{session('success_mesage')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Search Data</h4>
                                <div class="buttonzone">
                                <a onclick="return confirm('Are you sure ?')" href="{{ route('resetSearchData') }}" class="btn btn-danger pull-right btn-fill"><i class="ti-settings"> Reset Search Data</i></a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="content table-responsive table-full-width search-data-table">
                                        @foreach($search as $item)
                                        <span class="search-item-data">{{ $item->data }} | {{ $item->search_count }} | <a href="{{ route('deleteSearchData', $item->id) }}" class="btn btn-success btn-fill btn-xs">X</a></span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
