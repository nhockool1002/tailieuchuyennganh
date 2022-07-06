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
                                <h4 class="title">Logs List</h4>
                                <p class="category">This page show all log and some tools for log manage</p>
                                <div class="buttonzone">
                                <a onclick="return confirm('Are you sure ?')" href="{{ route('deleteAllLog') }}" class="btn btn-danger pull-right btn-fill"><i class="ti-settings"> Delete All</i></a>
                                </div>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-striped">
                                    <thead>
                                        <th>ID</th>
                                    	<th>Content</th>
                                    	<th>Screen</th>
                                    	<th>User</th>
                                        <th>Created Time</th>
                                    </thead>
                                    <tbody>
                                        @foreach($logs as $log)
                                        <tr>
                                        	<td>{{ $log->id }}</td>
                                            <td>{!! $log->changelog !!}</td>
                                        	<td>{{ $log->screen }}</td>
                                            <td>{{ $log->user }}</td>
                                        	<td>{{ $log->created_at }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="paginate-page" style="text-align: center">
                                {!! $logs->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>