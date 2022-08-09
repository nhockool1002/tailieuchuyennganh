@extends('frontend.front_layouts')
@section('content')
	@include('frontend.home.content')
	@if ($popup['state'] == '1')
	@push('scripts')
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
	<script type='text/javascript'>
		if (typeof $.cookie('popup') == 'undefined') {
			 $(function(){
				var overlay = $('<div id="overlay"></div>');
				overlay.show();
				overlay.appendTo(document.body);
				$('.popup').show();
				$('.close').click(function(){
				$('.popup').hide();
				overlay.appendTo(document.body).remove();
				return false;
			});

				$('.x').click(function(){
					$('.popup').hide();
					overlay.appendTo(document.body).remove();
					return false;
				});

				var date = new Date();
				date.setTime(date.getTime() + (3600 * 1000));
				$.cookie("popup", 1, { expires : date });
			});
		}		
	</script>
	@endpush
	@endif
	<!-- <script type="text/javascript">
	(sc_adv_out = window.sc_adv_out || []).push({
			id: 874767,
			domain: "n.ads5-adnow.com",
	});
	</script>
	<script type="text/javascript" src="//st-n.ads5-adnow.com/js/a.js" async></script> -->
@endsection
