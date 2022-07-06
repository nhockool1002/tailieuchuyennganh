    <div class="main-panel">
        @include('common.back.topsetting')
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="col-md-12">
                                <div class="alertbox">
                                    <br />
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
                                        <div class="alert alert-info">
                                            <i class="fa fa-times" aria-hidden="true"></i> {{session('warning_mesage')}}
                                        </div>
                                    @endif
                        </div>
                    </div>
                            <div class="header">
                                <h4 class="title">Edit Category</h4>
                            </div>
                            <div class="content">
                                <form method="POST" action="{{ route('posteditCategory', $category->id) }}">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Category Name</label>
                                                <input type="text" class="form-control border-input" placeholder="Category Name" name="cat_name" value="{{ $category->cat_name }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Slug</label>
                                                <input type="text" class="form-control border-input" placeholder="Category Slug" name="cat_slug" value="{{ $category->cat_slug }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Category Order</label>
                                                <input type="text" class="form-control border-input" placeholder="Category Order" name="cat_order" value="{{ $category->cat_order }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Active</label>
                                                <select name="cat_active" class="form-control border-input">
                                                    <option value="0" @if($category->active == 0) selected="selected" @endif>Non-Active</option>
                                                    <option value="1" @if($category->active == 1) selected="selected" @endif>Active</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Category Description</label>
                                                <textarea rows="5" class="form-control border-input" placeholder="Here can be your description" name="cat_description">{{ $category->cat_description }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-info btn-fill btn-wd">Edit Category</button>
                                    </div>
                                    <div class="clearfix"></div>
                                </form>
                            </div>

                            <hr />
                            <div class="content">
                                    <div class="row">
                                        <div class="col-md-3 text-center">
                                            <div class="header">
                                                <h4 class="title">Moderator</h4>
                                            </div>
                                            <hr />
                                            <form method="POST" action="{{ route('postaddModerator') }}">
                                                {{ csrf_field() }}
                                            <div class="form-group">
                                                <input name="username" class="form-control border-input" type="text" id="search" placeholder="Gõ đễ tìm username" autocomplete="off" >
                                                <input type="hidden" name="catID" value="{{ $category->id }}">
                                            </div>
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-info btn-fill btn-wd">Add Moderator</button>
                                            </div>
                                            </form>
                                        </div> 
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <div class="content table-responsive table-full-width">
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <th>ID</th>
                                                            <th>Username</th>
                                                            <th>Opion</th>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($mods as $mod)
                                                            <tr>
                                                                <td>{{ $mod->user_id }}</td>
                                                                <td>{{ $mod->user->username }}</td>
                                                                <td><a href="{{ route('removeModerator', $mod->id) }}" class="btn btn-danger btn-xs">X</a></td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>


                                    
                                    <div class="clearfix"></div>
                                
                            </div>

                        </div>
                    </div>
                </div>
            </div
        </div>
    @include('common.back.copyright')
    </div>