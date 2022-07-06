	@if (strpos(url()->current(), 'post'))
	<body onload="getRelative({{ $posts->id}}, {{ $posts->cat_id}})">
	@else
	<body>
	@endif
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.2';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
        
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-147488628-1"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());
        
          gtag('config', 'UA-147488628-1');
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
							<li class="specmenu"><a href="{{ route('getDonatePage') }}">XSHARE Online</a></li>
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
