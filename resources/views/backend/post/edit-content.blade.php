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
                                @if(session('warning_mesage'))
                                    <div class="alert alert-danger">
                                        <i class="fa fa-times" aria-hidden="true"></i> {{session('warning_mesage')}}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="header">
                            <h4 class="title">Edit Post</h4>
                        </div>
                        <div class="content">
                            <form method="POST" action="{{ route('posteditPost',$post->id) }}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Title</label>
                                            <input type="text" class="form-control border-input" placeholder="Post Name" name="title" value="{{ $post->post_name }}">
                                            <small><a  class="overview-edit" href="{{ route('getPost', ['id' => $post->id, 'slug' => $post->post_slug ]) }}" target="_blank">[Xem bài viết {{ $post->post_name }}]</a></small>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Category</label>
                                            <select name="category" class="form-control border-input">
                                                @foreach($cats as $cat)
                                                    <option value="{{ $cat->id }}" @if($cat->id == $post->cat_id) selected="selected" @endif>{{ $cat->cat_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Content</label>
                                            <textarea rows="5" class="form-control border-input" placeholder="Here can be your description" id="editor1" name="content">{{ $post->post_content }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Private Content</label>
                                            <textarea rows="5" class="form-control border-input" placeholder="Here can be your description" id="editor2" name="private_content">{{ $post->private_content }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 download-zone-box">
                                        <div class="form-group">
                                            <label>Link Download </label>
                                            <div class="row">
                                                <div class="col-sm-12 box-content">
                                                    <div class="row datadownloadcr" id="datadownloadcr">
                                                        @if($linkdl != NULL)
                                                        @foreach($linkdl as $key => $item)
                                                        <div class="col-sm-12 downloaded-box box-cr-{{ $key+99 }}">
                                                            <div class="col-sm-5">
                                                                <input type="text" name="listdl[{{ $key+99 }}][title]" value="{{ $item['title'] }}" class="form-control border-input">
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <input type="text" name="listdl[{{ $key+99 }}][link]" value="{{ $item['link'] }}" class="form-control border-input">
                                                            </div>
                                                            <div class="col-sm-1">
                                                                <button type="button" onclick="removeDLBK({{ $key+99 }})" class="btn btn-romo btn-warning btn-fill btn-xs"><i class="ti ti-eraser"></i></button>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 download-zone-box">
                                        <div class="form-group">
                                            <label>Add MoreLink Download </label><span><small>(Có thể bỏ qua)</small></span>
                                            <div class="row">
                                                <div class="col-sm-12 box-content">
                                                    <button class="custom-dl-btn" type="button" onclick="addDLzone()">+</button>
                                                    <div class="row datadownload" id="datadownload">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Current Thumbnail</label>
                                            <div class="current-img">
                                                <img src="{{ asset('upload/posts/images') }}/{{ $post->post_img }}">
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
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Stick Post</label>
                                            <select name="sticky" class="form-control border-input">
                                                    <option value="0" {{ $post->post_special == 0 ? 'selected="selected"' : '' }}>Không</option>
                                                    <option value="1" {{ $post->post_special == 1 ? 'selected="selected"' : '' }}>Có</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Hashtag List</label>
                                            <div class="list-hashtagged">
                                                <ul id="hashtagged-ul">
                                                    @foreach ($listtags as $item)
                                                        <li class="li-hashtag hashtagged-{{ $item->hashtag->id }}">{{ $item->hashtag->hashtag_name }}<input type="hidden" name="listht[]" value="{{ $item->hashtag->hashtag_name }}" "=""><span class="removeHTNow" onclick="removeHTADD({{ $item->hashtag->id }}, {{ $post->id }})">X</span></li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Add Hashtag</label>
                                                {{ csrf_field() }}
                                            <div class="form-group">
                                                <div class="alert alert-danger" id="hashtag-error" style="display: none;">
                                                    <i class="fa fa-times" aria-hidden="true"></i> Vui lòng không để trống nội dung khi lưu HashTag
                                                </div>
                                                <input name="username" class="form-control border-input ohashtag" type="text" id="search" placeholder="Gõ đễ tìm username" autocomplete="off" >
                                                <br /><br />
                                                <button type="button" class="btn btn-success btn-fill" onclick="addHashtag()">Add Hashtag</button>
                                            </div>
                                            <div class="list-hashtag">
                                                <ul id="hashtag-ul">

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-info btn-fill btn-wd">Edit Post</button>
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
