<div class="wrap-post-content">
<h3 class="post-title">{{ $posts->post_name }}</h3>
@foreach ($hashtags as $item)
<a class="hashtag-a" href="{{ route('hashtag', ['hashtag' => $item->hashtag->hashtag_name]) }}"><span class="hashtag-item">{{ $item->hashtag->hashtag_name }}</span></a>
@endforeach
<hr />
<p>
    <span><small>Chia sẻ bởi </small></span><span class="meta-user">{{ $posts->user->username }}</span>
    <span class="meta-view-count"><small> ({{ $posts->view_count }} Lượt xem)</small></span>
    @if(Auth::check() && Auth::user()->role_id == 1)
		<a class="btn btn-danger" href="{{ route('editPost', $posts->id) }}">EDIT</a>
	@endif
</p>
<div class="post-content">
    {!! $posts->post_content !!}
    <br />
    <div class="fshare-banner">
    <a href="#" style="width:100%"><img src="https://via.placeholder.com/728x90" alt="ads after post content" style="width:100%"></a>
    </div>
    <!-- @include('frontend.post.spoiler') -->
    <hr />
    @if (!empty($linkdl))
    <div class="row">
            <div class="col-sm-12">
                <div class="boxdownload-title">Link Download</div>
                <div class="boxdownload-zone">
                    @foreach($linkdl as $item)
                        <a target="_blank" href="{{ $item['link'] }}"><span style="background-color: {{ getRandomColor() }};" class="nuttaipost"><i class="fa fa-download"></i>{{ $item['title'] }}</span></a>
                    @endforeach
                </div>
            </div>
    </div>
    @endif
    <br>
    @if ($posts->category->id == '9' && $posts->category->cat_name == '#Phim')
    <div class="box-request">
        <form action="{{ route('requestHDFront') }}" method="POST">
            @csrf
            <div class="request-title">
                Yêu cầu phim chất lượng HD
            </div>
            <div class="request-body">
                @if(session('baoloi'))
                <div class="request-hd-error">
                    {{session('baoloi')}}
                </div>
                @endif
                @if(session('thanhcong'))
                <div class="request-hd-complete">
                    {{session('thanhcong')}}
                </div>
                 @endif
                <div class="input-phim">
                    <input class="form-control nhaptenphim" name="tenphim" placeholder="Nhập tên phim yêu cầu ">
                </div>
                <div class="">
                    <button class="btn btn-success btn-block">Gửi Yêu Cầu</button>
                </div>
            </div>
        </form>
    </div><br />
    @endif
        <br />
        <div class="row">
            <div class="col-sm-12 text-center">
                <div class="fb-like" data-href="{{ url()->current() }}" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
            </div>
        </div>
    <br />
    <hr />
    <div class="form-group">
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
        <a href="{{ route('report',['post' => $posts->post_name, 'id' => $posts->id ]) }}" class="btn btn-danger" onclick="return confirm('Chuyển sang báo cáo ?');">Báo cáo link hỏng</a>
        <a href="https://www.facebook.com/groups/kgroupdocument/" target="_blank" class="btn btn-info">Yêu cầu tài nguyên</a>
    </div>
</div>
<div class="sign-content">
    @if(isset($posts->user->sign))
        {!! $posts->user->sign !!}
    @else
        @if(!empty($settingConfig['signature']['config_setting']))
           {!! $settingConfig['signature']['config_setting'] !!}
        @endif
    @endif
</div>
</div>
