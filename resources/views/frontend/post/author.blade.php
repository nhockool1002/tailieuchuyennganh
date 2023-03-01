								<!-- <div class="media">
									<div class="media-left">
										<img class="media-object author-avatar" src="{{ isset($posts->user->avatar) ? \Constant::AVATAR_PATH.$posts->user->avatar : \Constant::IMG_PATH.'nblogsite.png' }}" alt="">
									</div>
									<div class="media-body">
										<div class="media-heading">
											<h3>{{ $posts->user->username }}</h3>
										</div>
										<p>{{ $posts->user->aboutme }}</p>
										<ul class="author-social">
											@if(isset($settingConfig['sc']['facebook']))
											<li><a href="{{ $settingConfig['sc']['facebook'] }}" target="_blank"><i class="fa fa-facebook"></i></a></li>
											@endif
											@if(isset($settingConfig['sc']['twitter']))
											<li><a href="{{ $settingConfig['sc']['twitter'] }}" target="_blank"><i class="fa fa-twitter"></i></a></li>
											@endif
											@if(isset($settingConfig['sc']['google']))
											<li><a href="{{ $settingConfig['sc']['google'] }}" target="_blank"><i class="fa fa-google-plus"></i></a></li>
											@endif
											@if(isset($settingConfig['sc']['pinterest']))
											<li><a href="{{ $settingConfig['sc']['pinterest'] }}" target="_blank"><i class="fa fa-pinterest-square"></i></a></li>
											@endif
											@if(isset($settingConfig['sc']['linkedin']))
											<li><a href="{{ $settingConfig['sc']['linkedin'] }}" target="_blank"><i class="fa fa-linkedin"></i></a></li>
											@endif
											@if(isset($settingConfig['sc']['yahoo']))
											<li><a href="{{ $settingConfig['sc']['yahoo'] }}" target="_blank"><i class="fa fa-envelope"></i></a></li>
											@endif
										</ul>
									</div>
								</div> -->
                                @if($user)
								<div class="wrapUser">
									<div class="container-fluid p-0">
										<div class="row">
											<div class="col-sm-3 text-center">
												<img class="media-object author-avatar" src="{{ isset($user->avatar) ? \Constant::AVATAR_PATH.$user->avatar : \Constant::IMG_PATH.'nblogsite.png' }}"
													alt="avatar user"
													style="width:60px; height: 60px; margin: 0 auto; border-radius: 50%"
												>
											</div>
											<div class="col-sm-5 userRank">
												<h4
													style="margin: 0; padding: 0; margin-bottom: 0px; font-weight: lighter"
												>{{ $user->username }}</h4>
												<h6
													style="margin: 0; padding: 0; margin-bottom: 5px; color: green;"
												>{{ convertRoleToRoleName($user->getRoleNames()[0]) }}</h6>

                                                <a href="{{ route('user.cp', ['id' => $user->id]) }}" class="view-profile">[View Profile]</a>
{{--												<img--}}
{{--													src="{{ asset('rank/uploader.jpg') }}"--}}
{{--													style="width: 100px; height: auto; box-shadow: 2px 4px 4px #000000a1;"--}}
{{--													alt="ranking user"--}}
{{--												/>--}}
											</div>
											<div class="col-sm-4 userSocial">
												<span class="titleUserWg">Bài viết:</span> <span class="contentUserWg">{{ $user->countPosts() }}</span><br />
												<span class="titleUserWg">TPoint$:</span> <span class="contentUserWg">{{ $tpoint }}</span><br />
												<ul class="author-social">
													@if(isset($settingConfig['sc']['facebook']))
													<li><a href="{{ $settingConfig['sc']['facebook'] }}" target="_blank"><i class="fa fa-facebook"></i></a></li>
													@endif
													@if(isset($settingConfig['sc']['twitter']))
													<li><a href="{{ $settingConfig['sc']['twitter'] }}" target="_blank"><i class="fa fa-twitter"></i></a></li>
													@endif
													@if(isset($settingConfig['sc']['google']))
													<li><a href="{{ $settingConfig['sc']['google'] }}" target="_blank"><i class="fa fa-google-plus"></i></a></li>
													@endif
													@if(isset($settingConfig['sc']['pinterest']))
													<li><a href="{{ $settingConfig['sc']['pinterest'] }}" target="_blank"><i class="fa fa-pinterest-square"></i></a></li>
													@endif
													@if(isset($settingConfig['sc']['linkedin']))
													<li><a href="{{ $settingConfig['sc']['linkedin'] }}" target="_blank"><i class="fa fa-linkedin"></i></a></li>
													@endif
													@if(isset($settingConfig['sc']['yahoo']))
													<li><a href="{{ $settingConfig['sc']['yahoo'] }}" target="_blank"><i class="fa fa-envelope"></i></a></li>
													@endif
												</ul>
											</div>
										</div>
									</div>
								</div>
                                @endif
