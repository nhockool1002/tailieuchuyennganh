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
                            @if(session('danger_mesage'))
                                <div class="alert alert-danger">
                                    <i class="fa fa-check" aria-hidden="true"></i> {{session('danger_mesage')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Filter Administrator</h4>
                                <p class="category">This page show all members and some tools for user manage</p>
                                @include('backend.user.buttonzone')
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="userlist table table-striped">
                                    <thead>
                                        <th>ID</th>
                                    	<th>Username</th>
                                    	<th>Email</th>
                                    	<th>Join Date</th>
                                    	<th>Permission</th>
                                        <th>Opion</th>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $user)
                                        <tr>
                                        	<td>{{ $user->id }}</td>
                                            <td>{{ $user->username }}</td>
                                        	<td>{{ $user->email }}</td>
                                        	<td>{{ $user->created_at }}</td>
                                        	<td>{{ $user->role->role_name }}</td>
                                            <td>
                                                <a href="{{ route('editUser', $user->id) }}" class="btn btn-sm btn-primary"><i class="ti-pencil"></i></a>
                                                <a href="{{ route('deleteUser', $user->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this item?');"><i class="ti-close"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="paginate-page" style="text-align: center">
                                {!! $users->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>