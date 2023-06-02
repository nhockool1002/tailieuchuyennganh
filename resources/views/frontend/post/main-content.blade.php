<div class="wrap-post-content">
<h3 class="post-title">{{ $posts->post_name }}</h3>
@foreach ($hashtags as $item)
<a class="hashtag-a" href="{{ route('hashtag', ['hashtag' => $item->hashtag->hashtag_name]) }}"><span class="hashtag-item">{{ $item->hashtag->hashtag_name }}</span></a>
@endforeach
<hr />
<p>
    <span><small>Chia sẻ bởi </small></span><span class="meta-user">{{ $posts->user->username }}</span>
    <span class="meta-view-count"><small> ({{ $posts->view_count }} Lượt xem)</small></span>
    <span style="color:gray; font-size: 12px;float: right;">〜 {{ $readTime }} </span>
    @if(Auth::check() && Auth::user()->role_id == 1)
		<a class="btn btn-danger" href="{{ route('editPost', $posts->id) }}">EDIT</a>
	@endif
</p>
<div class="post-content">
    {!! $posts->post_content !!}
    @if($posts->private_content)
        @if(!Auth::check())
            <div class="not-auth">[Nội dung - liên kết VIP đã bị ẩn, bạn không thể xem nếu chưa đăng kí thành viên, xin vui lòng đăng kí bằng cách nhấp vào <a href="{{ route('getRegister') }}">Liên kết này để đăng kí thành viên</a>]</div>
        @elseif(Auth::check() && !Auth::user()->hasRole(['super-admin', 'admin', 'super-moderator', 'moderator', 's-member', 'vip-member']))
            <div class="auth-not-smem">[Nội dung - liên kết VIP dành cho S-MEMBER trở lên, xin vui lòng nâng cấp tài khoản bằng cách nhấn vào <a href="{{ route('getRegister') }}">NÂNG CẤP TÀI KHOẢN</a>]</div>
        @else
            <div class="authicated">
                <p>NỘI DUNG ẨN</p>
                {!! $posts->private_content !!}
            </div>
        @endif
    @endif
    <br />
    @if($user_has_like === 0)
        <div class="w-100 like-box">
            <div class="not-thank" data-post-id="{{ $posts->id }}">
                <span class="icon">
                    <img src="{{ asset('img/like.png') }}" />
                </span>
                <span class="content-thank">THANK POST</span>
            </div>
        </div>
    @elseif($user_has_like === 1)
        <div class="w-100 like-box">
            <div class="thanked" data-post-id="{{ $posts->id }}">
                <span class="icon">
                    <img src="{{ asset('img/like.png') }}" />
                </span>
                <span class="content-thank">YOU THANKED</span>
            </div>
        </div>
    @endif
    <br />
    @if(isset($category_top_content_728x90))
    <a href="{{ $category_top_content_728x90->target_link }}" style="display: inline-block;margin: auto;">
        <img class="img-responsive" src="{{ $category_top_content_728x90->ads_img }}" alt="" target="_blank">
    </a>
    @endif
    @if($likedUsers && count($likedUsers) >= 0)
    <hr />
    <h4 class="people-say-thank">Các thành viên đã like bài viết: </h4>
    @endif
    <div class="box-say-thank">
        @if($likedUsers && count($likedUsers) >= 0)
            @foreach($likedUsers as $user)
                @if(!$loop->last)
                    <a href="#">{{ $user->username }}</a>,
                @else
                    <a href="#">{{ $user->username }}</a>
                @endif
            @endforeach
        @endif
    </div>
    <!-- @include('frontend.post.spoiler') -->
    <hr />
    @if (!empty($linkdl))
    <div class="alert alert-danger box-notice">
        <p>Hiện tại TÀI LIỆU CHUYÊN NGÀNH đã hổ trợ toàn bộ liên kết download với <b>TỐC ĐỘ CAO - KHÔNG QUẢNG CÁO</b>.</p>
        <p>Để nhận liên kết tải về <b>TỐC ĐỘ CAO</b> cho bài viết này, vui lòng xem hướng dẫn <a target="_blank" href="https://tailieuchuyennganh.com/page/6/huong-dan-nhan-link-tai-toc-do-cao">TẠI ĐÂY</a></p>
    </div>
    <div class="row">
            <div class="col-sm-12">
                <div class="boxdownload-title">Link Download</div>
                <div class="boxdownload-zone">
                    <!-- <b style="color:red">Hệ thống download đang được bảo trì - Vui lòng yêu cầu download bằng cách nhấn vào chat bên góc phải </b> -->
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
        <a href="{{ route('report',['post' => $posts->post_name, 'id' => $posts->id ]) }}" class="btn btn-danger nmlink" onclick="confirmRobot()">Báo cáo link hỏng</a>
        <a href="https://www.facebook.com/groups/kgroupdocument/" target="_blank" class="btn btn-info nmlink">Yêu cầu tài nguyên</a>
    </div>
</div>
<!-- <div class="sign-content">
    @if(isset($posts->user->sign))
        {!! $posts->user->sign !!}
    @else
        @if(!empty($settingConfig['signature']['config_setting']))
           {!! $settingConfig['signature']['config_setting'] !!}
        @endif
    @endif
</div> -->
</div>
