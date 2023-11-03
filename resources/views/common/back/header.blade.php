<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="apple-touch-icon" sizes="76x76" href="{{ asset('admin-assets/img/apple-icon.png') }}">
	<link rel="icon" type="image/png" sizes="96x96" href="{{ asset(\Constant::FAV_ICON_PATH) }}">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>{{ \Constant::ADMIN_TITLE_NAME }}</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

    <!-- Animation library for notifications   -->
    <link href="{{ asset('admin-assets/css/animate.min.css') }}" rel="stylesheet"/>

    <!--  Paper Dashboard core CSS    -->
    <link href="{{ asset('admin-assets/css/paper-dashboard.css') }}" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="{{ asset('admin-assets/css/demo.css') }}" rel="stylesheet" />


    <!--  Fonts and icons     -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <link href="{{ asset('admin-assets/css/themify-icons.css') }}" rel="stylesheet">

    <!--  Custom CSS     -->
    <link href="{{ asset('admin-assets/css/style.css') }}" rel="stylesheet" />
    @stack('styles')
</head>
<body>

<div class="wrapper">
