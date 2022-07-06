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
                                <h4 class="title">Page List</h4>
                                <p class="category">This page show all page and some tools for page manage</p>
                                @include('backend.page.buttonzone')
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-striped">
                                    <thead>
                                        <th>ID</th>
                                    	<th>Page Title</th>
                                    	<th>Description</th>
                                        <th>User</th>
                                        <th>Opion</th>
                                    </thead>
                                    <tbody>
                                        @if(isset($pages))
                                        @foreach($pages as $page)
                                        <tr>
                                        	<td>{{ $page->id }}</td>
                                            <td>{{ getExcerpt($page->page_name, 0, 55) }}</td>
                                        	<td>{{ strip_tags(trim(html_entity_decode(getExcerpt($page->page_content, 0, 250)))) }}</td>
                                        	<td>{{ $page->user->username }}</td>
                                            <td>
                                                <a href="{{ route('editPage',$page->id) }}" class="btn btn-xs btn-primary"><i class="ti-pencil"></i></a>
                                                <a href="{{ route('deletePage',$page->id) }}" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure you want to delete this item?');"><i class="ti-close"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                                <div class="paginate-page" style="text-align: center">
                                @if(isset($pages))
                                    {!! $pages->links() !!}
                                @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
