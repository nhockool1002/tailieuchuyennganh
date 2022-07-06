		<!-- section -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- Post content -->
					<div class="col-md-8">
						<div class="section-row sticky-container">
							<div class="main-post">
								@include('frontend.page.main-content')
							</div>
							<div class="post-shares sticky-shares">
								@include('frontend.page.social')
							</div>
						</div>

						<!-- ad -->
						<div class="section-row text-center">
							@include('frontend.ads.ads-bottom-post')
						</div>
						<!-- ad -->
						
						<!-- author -->
						<div class="section-row">
							<div class="post-author">
								{{--@include('frontend.page.author')--}}
							</div>
						</div>
						<!-- /author -->

						<!-- comments -->
						<div class="section-row">
							{{--@include('frontend.page.comments')--}}
						</div>
						<!-- /comments -->

						<!-- reply -->
						<div class="section-row">
							{{--@include('frontend.page.form')--}}
						</div>
						<!-- /reply -->
					</div>
					<!-- /Post content -->

					<!-- aside -->
					<div class="col-md-4">
						@include('frontend.page.widget')
					</div>
					<!-- /aside -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /section -->
