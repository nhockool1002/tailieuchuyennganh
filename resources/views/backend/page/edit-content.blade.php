<div class="main-panel">
    @include('common.back.topsetting')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="col-md-12">
                            <br>
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
                        <div class="header">
                            <h4 class="title">Edit Page</h4>
                        </div>
                        <div class="content">
                            <form method="POST" action="" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Title</label>
                                            <input type="text" class="form-control border-input" placeholder="Page Name" name="title" value="{{ $page->page_name }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Content</label>
                                            <textarea rows="5" class="form-control border-input" placeholder="Here can be your description" id="editor1" name="content">{{ $page->page_content }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Current Thumbnail</label>
                                            <div class="current-img">
                                                <img src="{{ asset('upload/pages/images') }}/{{ $page->page_img }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Add New Image Thumbnails</label>
                                            <small>(*) If you don't want to change thumnails can skip input</small>
                                            <input type="file" class="form-control border-input" placeholder="Thumbnail" name="thumb" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-info btn-fill btn-wd">Edit Page</button>
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
