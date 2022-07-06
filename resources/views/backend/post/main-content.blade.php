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
                            @if(session('warning_mesage'))
                                <div class="alert alert-warning">
                                    <i class="fa fa-times" aria-hidden="true"></i> {{session('warning_mesage')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Posts List</h4>
                                <p class="category">This page show all post and some tools for post manage</p>
                                @include('backend.post.buttonzone')
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-striped">
                                    <thead>
                                        <th>ID</th>
                                    	<th>Post Title</th>
                                    	<th>Description</th>
                                    	<th>Category</th>
                                        <th>User</th>
                                        <th>Opion</th>
                                    </thead>
                                    <tbody>
                                        @foreach($posts as $post)
                                        <tr>
                                        	<td>{{ $post->id }}</td>
                                            <td>{{ getExcerpt($post->post_name, 0, 55) }}</td>
                                        	<td>{{ strip_tags(trim(html_entity_decode(getExcerpt($post->post_content, 0, 250)))) }}</td>
                                            <td>{{ $post->category->cat_name }}</td>
                                        	<td>{{ $post->user->username }}</td>
                                            <td>
                                                <a href="{{ route('editPost', $post->id) }}" class="btn btn-xs btn-primary"><i class="ti-pencil"></i></a>
                                                <a href="{{ route('deletePost', $post->id) }}" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure you want to delete this item?');"><i class="ti-close"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="paginate-page" style="text-align: center">
                                {!! $posts->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
