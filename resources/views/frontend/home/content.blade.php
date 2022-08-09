<!-- section -->
		<div class="section">
			<!-- container -->
			<div class="container">
				@include('frontend.home.stickpost')
				@include('frontend.home.recentpost')
				@include('frontend.home.mostreadpost')
			</div>
			<!-- /container -->
		</div>
		<!-- /section -->
		
		<!-- section -->
		<div class="section section-grey">
			<!-- container -->
			<div class="container">
				@include('frontend.home.featurepost')
			</div>
			<!-- /container -->
		</div>
		<!-- /section -->

		<!-- section -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					@include('frontend.home.bottompost')
					@include('frontend.home.bottomwidget')
				</div>
				<!-- /row -->
				<div class="tags-widget">
								<ul>
                                    @foreach ($settingConfig['hashtag'] as $item)
									    <li><a href="{{ route('hashtag', ['hashtag' => $item->hashtag_name])}}">{{ $item->hashtag_name }} ({{ $item->posthashtag->count() }})</a></li>
                                    @endforeach
								</ul>
							</div>

			</div>
			<!-- ADNOW -->
			<div id="SC_TBlock_874767"></div>
			<!-- /container -->
		</div>
		<!-- POPUP -->
		@if ($popup['state'] == '1')
		<div class='popup'>
			<div class='cnt223'>
				<h1 class="popup-title">{{ $popup['title'] }}</h1>
				{!! $popup['content'] !!}
				<p>
				<br/>
				<a href='' class='close'>Close</a>
				</p>
			</div>
		</div>
		@endif
		<!-- /POPUP -->
		<!-- /section -->
