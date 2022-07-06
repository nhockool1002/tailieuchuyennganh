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
                                <h4 class="title">Category List</h4>
                                <p class="category">This page show all category and some tools for category manage</p>
                                <div class="buttonzone">
                                <a href="{{ route('addCategory') }}" class="btn btn-warning pull-right"><i class="ti-plus">Add Category</i></a>
                                </div>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-striped">
                                    <thead>
                                        <th>ID</th>
                                    	<th>Category Name</th>
                                    	<th>Slug</th>
                                    	<th>Description</th>
                                    	<th>Order</th>
                                        <th>Active</th>
                                        <th>Opion</th>
                                    </thead>
                                    <tbody>
                                        @foreach($category as $cat)
                                        <tr>
                                        	<td>{{ $cat->id }}</td>
                                            <td>{{ $cat->cat_name }}</td>
                                        	<td>{{ $cat->cat_slug }}</td>
                                        	<td>{{ $cat->cat_description }}</td>
                                            <td>{{ $cat->cat_order }}</td>
                                        	<td>@if($cat->active == 1) Active @else Non-Active @endif</td>
                                            <td>
                                                <a href="{{ route('editCategory', $cat->id) }}" class="btn btn-xs btn-primary"><i class="ti-pencil"></i></a>
                                                <a href="{{ route('deleteCategory', $cat->id) }}" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure you want to delete this item?');"><i class="ti-close"></i></a>
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
