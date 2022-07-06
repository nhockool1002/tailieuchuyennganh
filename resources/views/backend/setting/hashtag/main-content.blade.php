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
                                <h4 class="title">Hashtag List</h4>
                                <div class="buttonzone">
                                <a href="{{ route('setting') }}" class="btn btn-danger pull-right"><i class="ti-settings"> Setting</i></a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="content table-responsive table-full-width">
                                        <table class="table table-striped" id="your-link">
                                            <thead>
                                            <th>ID</th>
                                            <th>Hashtag</th>
                                            <th>Postcount</th>
                                            <th>Option</th>
                                            </thead>
                                            <tbody>
                                            @foreach($hashtaglist as $item)
                                                <tr>
                                                    <td>{{ $item->id }}</td>
                                                    <td>{{ $item->hashtag_name }}</td>
                                                    <td>{{ $item->posthashtag->count() }}</td>
                                                    <td>
                                                        <a href="{{ route('deleteHashtag', $item->id) }}" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure you want to delete this item?');"><i class="ti-close"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
