@extends('backend.back_layouts')
@section('headname')
	Code Example View
@endsection
@section('content')
	@include('backend.setting.code-example.content')
	@push('styles')
		<link rel="stylesheet" href="{{ asset('admin-assets/css/prettify.css') }}">
	@endpush
	@push('scripts')
		<script type="text/javascript" src="{{ asset('admin-assets/js/prettify.js') }}"></script>
		<script>prettyPrint();</script>
	@endpush
@endsection