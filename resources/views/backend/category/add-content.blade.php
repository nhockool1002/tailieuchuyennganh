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
                        </div>
                    </div>
                            <div class="header">
                                <h4 class="title">Add Category</h4>
                            </div>
                            <div class="content">
                                <form method="POST" action="">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Category Name</label>
                                                <input type="text" class="form-control border-input" placeholder="Category Name" name="cat_name" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Slug</label>
                                                <input type="text" class="form-control border-input" placeholder="Category Slug" name="cat_slug" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Category Order</label>
                                                <input type="text" class="form-control border-input" placeholder="Category Order" name="cat_order" value="">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Active</label>
                                                <select name="cat_active" class="form-control border-input">
                                                    <option value="0">Non-Active</option>
                                                    <option value="1" selected="selected">Active</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Category Description</label>
                                                <textarea rows="5" class="form-control border-input" placeholder="Here can be your description" name="cat_description"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-info btn-fill btn-wd">Add Category</button>
                                    </div>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>


                </div>
            </div
        </div>
    @include('common.back.copyright')
    </div>