@extends('frontend.front_layouts')
@section('content')
    @include('frontend.usercp.content')
    @push('postname')
        USER PANEL
    @endpush
@endsection
