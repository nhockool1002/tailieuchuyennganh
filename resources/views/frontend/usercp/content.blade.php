<div class="container user_cp">
    <div class="row">
        <div class="col-sm-3">
            <div class="avatar-image">
                <img class="media-object" src="{{ isset($user->avatar) ? \Constant::AVATAR_PATH.$user->avatar : \Constant::IMG_PATH.'nblogsite.png' }}"
                     alt="avatar user"
                     style="width:200px; height: 200px; margin: 0 auto"
                >
            </div>
            <div class="list_user_cp_info">
                <p class="user_info__items">{{ $user->username }} <span>({{ convertRoleToRoleName($user->getRoleNames()[0]) }})</span></p>
                <p class="user_info_email_items">{{ $user->email }}</p>
                <div class="user_cp_bottom_items"></div>
                <p class="item__title">Tham gia:
                    <span class="info_items">{{ date('Y-m-d', strtotime($user->created_at)) }}</span>
                    <span>({{ convertDateStringToDay($user->created_at) }})</span>
                </p>
                <p class="item__title">Tổng số bài viết: <span class="info_items">{{ $user->countPosts() }}</span></p>
                <p class="item__title">Tổng số Like được nhận: <span class="info_items">{{ $totalLikesReceived }}</span></p>
                <p class="item__title">Tổng số Like đã thực hiện: <span class="info_items">{{ $total_likes }}</span></p>
                <p class="item__title">TPoint$: <span class="info_items">{{ number_format($tpoint, 2, ',', '.') }}</span></p>
                @if($user->id !== $currentUser->id)
                    <div class="user_cp_bottom_items"></div>
                    <a href="#"><i class="fa fa-envelope" aria-hidden="true"></i> Gửi tin nhắn riêng</a><br />
                    <a href="#"><i class="fa fa-address-book" aria-hidden="true"></i> Gửi lời mời kết bạn</a>
                @endif
            </div>
            @if($user->id === $currentUser->id)
                <div class="list_user_cp_options">
                <div class="user_cp_setting">
                    Cài đặt
                </div>
                <a href="#" class="usercp_alink_items">
                    <div class="user_cp_setting_items">
                        <i class="fa fa-cog" aria-hidden="true"></i> Thông tin tài khoản
                    </div>
                </a>
                <div class="user_cp_bottom_items"></div>
                <a href="#" class="usercp_alink_items">
                    <div class="user_cp_setting_items">
                        <i class="fa fa-archive" aria-hidden="true"></i> Danh sách vật phẩm
                    </div>
                </a>
                <div class="user_cp_bottom_items"></div>
                <a href="#" class="usercp_alink_items">
                    <div class="user_cp_setting_items">
                        <i class="fa fa-certificate" aria-hidden="true"></i> Danh sách huy hiệu
                    </div>
                </a>
                <div class="user_cp_bottom_items"></div>
                <a href="#" class="usercp_alink_items">
                    <div class="user_cp_setting_items">
                        <i class="fa fa-envelope" aria-hidden="true"></i> Hộp thư cá nhân
                    </div>
                </a>
                <div class="user_cp_bottom_items"></div>
                <a href="#" class="usercp_alink_items">
                    <div class="user_cp_setting_items">
                        <i class="fa fa-money" aria-hidden="true"></i> Lịch sử TPoint$
                    </div>
                </a>
                <div class="user_cp_divide_items"></div>
            </div>
            @endif
        </div>
        <div class="col-sm-9">
            <div class="user_cp_message_box">
                <form method="POST" action="{{ route('user.cp.post', ['id' => $user->id]) }}">
                    <div class="container-fluid">
                        {{ csrf_field() }}
                        <textarea id="__message_user_cp" name="content"></textarea>
                        <div class="w-100 text-center send__msg">
                            <button class="btn btn-primary float-end" type="submit">Gửi</button>
                        </div>
                    </div>
                </form>
                <hr />
               <div class="user_cp_comments_lists">
                   @if($comments)
                       @foreach($comments as $cmt)
                            <div class="user_comments_items">
                                <div class="user_comments_img">
                                    <img src="{{ isset($cmt->user->avatar) ? \Constant::AVATAR_PATH.$user->avatar : \Constant::IMG_PATH.'nblogsite.png' }}" />
                                </div>
                                <div class="user_comments_content">
                                    <b>
                                        <a href="{{ route('user.cp', ['id' => $cmt->user->id]) }}">{{ $cmt->user->username }}</a>
                                    </b>
                                    <div class="comments_main_content">
                                        {!! $cmt->content !!}
                                        @hasanyrole('super-admin|admin')
                                            <div class="delete_comments">
                                                <form method="POST" action="{{ route('user.cp.delete.post', ['id' => $cmt->id]) }}">
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                </form>
                                            </div>
                                        @endhasallroles
                                    </div>
                                </div>
                                <div class="user_comments_time">
                                    {!! $cmt->created_at !!}
                                </div>
                            </div>
                           <hr />
                       @endforeach
                   @endif
               </div>
                <div class="user_cp_comment_paginate text-center">
                    {{ $comments->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
