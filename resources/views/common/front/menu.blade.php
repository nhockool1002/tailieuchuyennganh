	@if (strpos(url()->current(), 'post'))

	<body onload="getRelative({{ $posts->id}}, {{ $posts->cat_id}})">
		@else

		<body>
			@endif
			<!-- Facebook Page plugin -->
            <!--<div id="fb-root"></div>-->
            <!--<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v14.0&appId=513881545829406&autoLogAppEvents=1" nonce="c0hE2YYl"></script>-->
			<!-- Messenger Chat Plugin Code -->

			<!-- Your Chat Plugin code -->
			<div id="fb-customer-chat" class="fb-customerchat">
			</div>

			<script>
				var chatbox = document.getElementById('fb-customer-chat');
				chatbox.setAttribute("page_id", "766478357025202");
				chatbox.setAttribute("attribution", "biz_inbox");
			</script>

			<!-- Your SDK code -->
			<script>
				window.fbAsyncInit = function() {
					FB.init({
						xfbml: true,
						version: 'v14.0'
					});
				};

				(function(d, s, id) {
					var js, fjs = d.getElementsByTagName(s)[0];
					if (d.getElementById(id)) return;
					js = d.createElement(s);
					js.id = id;
					js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
					fjs.parentNode.insertBefore(js, fjs);
				}(document, 'script', 'facebook-jssdk'));
			</script>
			<!-- Header -->
			<header id="header">
				<!-- Nav -->
				<div id="nav">
					<!-- Main Nav -->
					<div id="nav-fixed">
						<div class="container">
							<!-- logo -->
							<div class="nav-logo">
								<a href="{{ route('home') }}" class="logo"><img src="{{ \Constant::URL_HOME}}/img/logo.png" alt=""></a>
							</div>
							<!-- /logo -->

							<!-- nav -->
							<ul class="nav-menu nav navbar-nav">
								<li><a href="{{ route('home') }}">Trang chủ</a></li>
								<!-- <li class="specmenu"><a href="{{ route('getDonatePage') }}"></a></li> -->
								@foreach($menus as $menu)
								<li class="cat-{{ $menu->id }}"><a href="{{ $menu->menu_url }}">{{ $menu->menu_name }}</a></li>
								@endforeach
							</ul>
							<!-- /nav -->

							<!-- search & aside toggle -->
							<div class="nav-btns">
								<button class="aside-btn"><i class="fa fa-bars"></i></button>
								<button class="search-btn"><i class="fa fa-search"></i></button>
								<form action="{{ route('search') }}" method="GET">
									<div class="search-form">
										<input class="search-input" type="text" name="search" placeholder="Nhập từ khoá cần tìm ...">
										<button class="search-close" type="button"><i class="fa fa-times"></i></button>
										<button class="search-cn" type="submit"><i class="fa fa-search"></i></button>
									</div>
								</form>
							</div>
							<!-- /search & aside toggle -->
						</div>
					</div>
					<!-- /Main Nav -->
