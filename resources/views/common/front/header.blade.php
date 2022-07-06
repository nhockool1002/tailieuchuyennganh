<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		@if (strpos(url()->current(), 'post'))
		    <title>{{ $posts->post_name }} - {{ \Constant::TITLE_NAME_TOP }}</title>
        @elseif (strpos(url()->current(), 'category'))
            <title>{{ $cat->cat_name }} - {{ \Constant::TITLE_NAME_TOP }}</title>
        @else
            <title>{{ \Constant::TITLE_NAME }}</title>
        @endif
		

		<meta name="description" content="XShare Community - Cộng đồng chia sẻ tài nguyên miễn phí tất tần tật các lĩnh vực, bao gồm CNTT - GAMES - ĐỒ HOẠ - DATA SCIENCE - Big Data. Và tất cả tài nguyên đều hoàn toàn miễn phí." />
		<meta content='Tài nguyên miễn phí, tài liệu miễn phí, chia sẻ tài liệu' name='keywords'/>

		<meta content='blogger' name='generator'/>

        <!-- Schema.org markup for Google+ -->
        <meta itemprop="name" content="@stack('postname') {{ \Constant::TITLE_NAME }}">
        <meta itemprop="description" content="XShare Community - Cộng đồng chia sẻ tài nguyên miễn phí tất tần tật các lĩnh vực, bao gồm CNTT - GAMES - ĐỒ HOẠ - DATA SCIENCE - Big Data. Và tất cả tài nguyên đều hoàn toàn miễn phí.">
        <meta itemprop="image" content="https://tinyurl.com/yb9yenp8">

        <!-- Twitter Card data -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="XShare Community">
        @if (strpos(url()->current(), 'post'))
            <meta name="twitter:title" content="@stack('postname') {{ \Constant::TITLE_NAME }}">
        @elseif (strpos(url()->current(), 'category'))
            <meta name="twitter:title" content="{{ $cat->cat_name }} {{ \Constant::TITLE_NAME }}">
        @else
            <meta name="twitter:title" content="{{ \Constant::TITLE_NAME }}">
        @endif
        <meta name="twitter:description" content="XShare Community - Cộng đồng chia sẻ tài nguyên miễn phí tất tần tật các lĩnh vực, bao gồm CNTT - GAMES - ĐỒ HOẠ - DATA SCIENCE - Big Data. Và tất cả tài nguyên đều hoàn toàn miễn phí.">
        <meta name="twitter:creator" content="XShare Community">
        <meta name="twitter:image:src" content="https://tinyurl.com/yb9yenp8">
        <meta property="fb:admins" content="100002753472309"/>
        <meta property="fb:app_id" content="287055021963669"/>
        <!-- Open Graph data -->
        <meta content='{{ \Constant::TITLE_NAME_TOP }}' property='og:site_name'/>
        @if (strpos(url()->current(), 'post'))
		    <meta property="og:title" content="{{ $posts->post_name }} - {{ \Constant::TITLE_NAME_TOP }}" />
        @elseif (strpos(url()->current(), 'category'))
            <meta property="og:title" content="{{ $cat->cat_name }} - {{ \Constant::TITLE_NAME_TOP }}" />
        @else
            <meta property="og:title" content="{{ \Constant::TITLE_NAME }}" />
        @endif
        <meta property="og:type" content="article" />
        <meta property="og:url" content="{{ url()->current() }}" />
        @if (strpos(url()->current(), 'post'))
		<meta property="og:image" content="{{ \Constant::UPLOAD_PATH }}{{ $posts->post_img }}" />
        @else
        <meta property="og:image" content="https://tinyurl.com/yb9yenp8" />
        @endif
        <meta property="og:image:alt" content="XShare Community - Cộng đồng chia sẻ tài nguyên miễn phí" />
        <meta property="og:description" content="XShare Community - Cộng đồng chia sẻ tài nguyên miễn phí tất tần tật các lĩnh vực, bao gồm CNTT - GAMES - ĐỒ HOẠ - DATA SCIENCE - Big Data. Và tất cả tài nguyên đều hoàn toàn miễn phí." />
        <link rel="icon" type="image/png" href="{{ asset(\Constant::FAV_ICON_PATH) }}"/>
		<!-- Google font -->
        <link href="https://fonts.googleapis.com/css?family=Cuprum:400,400i,700,700i&amp;subset=vietnamese" rel="stylesheet">

		<!-- Bootstrap -->
		<link type="text/css" rel="stylesheet" href="{{ asset('css/bootstrap.min.css')}}"/>

		<!-- Font Awesome Icon -->
		<link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">

		<!-- Custom stlylesheet -->
		<link type="text/css" rel="stylesheet" href="{{ asset('css/style.css') }}"/>

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <script>
          (adsbygoogle = window.adsbygoogle || []).push({
            google_ad_client: "ca-pub-3267312035281248",
            enable_page_level_ads: true
          });
        </script>
    </head>
