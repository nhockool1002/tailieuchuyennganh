	<div class="limiter">
		<div class="container-login100" style="background-image: url('{{ asset('login-assets/images/img-01.jpg') }}');">
			<div class="wrap-login100 p-t-190 p-b-30">
				<div class="login100-form-avatar">
					<img src="{{ asset('login-assets/images/avatar-01.jpg') }}" alt="AVATAR">
				</div>
				<span class="login100-form-title p-t-20 p-b-45">
					REDIRECT PAGE
				</span>
				<div class="d-flex text-bold justify-content-center align-items-center" id="timer"></div>
			</div>
		</div>
	</div>

	@push('scripts')
	<script>
		var url = '{{ $url }}';
		var time_limit = 20;
	
		var time_out = setInterval(() => {
	
			if(time_limit == 0) {
				
				$('#timer').html(`<a class="btn btn-success btn-redirect" href="${url}">GO TO LINK</a>`);
				clearInterval(time_out);
						
			} else {
				
				if(time_limit < 10) {
					time_limit = 0 + '' + time_limit;
				}
				
				$('#timer').html('00:' + time_limit);
				
				time_limit -= 1;
				
			}
	
		}, 1000);
	
	</script>
	@endpush
