				<!-- Aside Nav -->
				<div id="nav-aside">
					<!-- nav -->
					<div class="section-row">
						<ul class="nav-aside-menu">
							@if(isset($settingConfig['pjpage']))
							@foreach($settingConfig['pjpage'] as $item)
							<li><a href="{{ route('getPage', ['id' => $item['id'], 'slug' => $item['page_slug']]) }}">{{ $item['page_name'] }}</a></li>
							@endforeach
							@endif
						</ul>
					</div>
					<!-- /nav -->
					
					<!-- widget posts -->
					<div class="section-row">
						<h3>Bài viết mới</h3>
						@foreach($recent3post as $post)
						<div class="post post-widget">
							<a class="post-img" href="#"><img src="{{ asset('upload/posts/images') }}/{{ $post->post_img }}" alt="{{ $post->slug }}"></a>
							<div class="post-body">
								<h3 class="post-title"><a href="{{ route('getPost', ['id' => $post->id, 'slug' => $post->post_slug ]) }}">{{ getExcerpt($post->post_name, 0, 60) }}</a></h3>
							</div>
						</div>
						@endforeach
					</div>
					<!-- /widget posts -->

					<!-- social links -->
					<div class="section-row">
						<h3>Follow us</h3>
						<ul class="nav-aside-social">
								@if(isset($settingConfig['sc']['facebook']))
								<li><a href="{{ $settingConfig['sc']['facebook'] }}" target="_blank"><i class="fa fa-facebook"></i></a></li>
								@endif
								@if(isset($settingConfig['sc']['twitter']))
								<li><a href="{{ $settingConfig['sc']['twitter'] }}" target="_blank"><i class="fa fa-twitter"></i></a></li>
								@endif
								@if(isset($settingConfig['sc']['google']))
								<li><a href="{{ $settingConfig['sc']['google'] }}" target="_blank"><i class="fa fa-google-plus-square"></i></a></li>
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
								<hr />
								@if(Auth::check())
								<a class="btn btn-warning" href="{{ route('getLogout') }}">Logout</a>
								@else
								<a class="btn btn-success" href="{{ route('getLogin') }}">Login</a>
								@endif
								@if(Auth::check() && Auth::user()->role_id == 1)
								<a class="btn btn-danger" href="{{ route('dashboard') }}">AdminCP</a>
								@endif
								@if(Auth::check() && Auth::user()->role_id == 2)
								<a class="btn btn-info" href="{{ route('dashboard') }}">ModCP</a>
								@endif
								<hr />
								@if(isset($settingConfig['status']) && $settingConfig['status'] == '1')
								<button class="btn btn-info btn-block">XSHARE is Deactive</button>
								@endif
						</ul>
					</div>
					<!-- /social links -->

					<!-- aside nav close -->
					<button class="nav-aside-close"><i class="fa fa-times"></i></button>
					<!-- /aside nav close -->
				</div>
				<!-- Aside Nav -->
			</div>
			<!-- /Nav -->
		</header>
		<!-- /Header -->