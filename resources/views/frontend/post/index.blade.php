@extends('frontend.front_layouts')
@section('content')
	@include('frontend.post.header-post')
	@include('frontend.post.content')
	@push('postname')
		{{ isset($posts) ? $posts->post_name.' - ' : '' }}
	@endpush
@endsection