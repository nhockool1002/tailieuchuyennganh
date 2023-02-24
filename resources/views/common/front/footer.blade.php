<!-- Footer -->
		<footer id="footer">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-5">
						<div class="footer-widget">
							<div class="footer-logo">
								<a href="{{ route('home') }}" class="logo"><img src="{{ \Constant::URL_HOME}}/img/logo.png" alt=""></a>
							</div>
							<div class="footer-column-1">
							@if(!empty($settingConfig['frontend_footer_column_1']['config_setting']))
                                {!! $settingConfig['frontend_footer_column_1']['config_setting'] !!}
                            @endif
                            </div>
						</div>
					</div>

					<div class="col-md-4">
						<div class="row">
							<div class="col-md-6">
								<div class="footer-widget">
									@if(!empty($settingConfig['frontend_footer_column_2']['config_setting']))
                                	@php $data = json_decode($settingConfig['frontend_footer_column_2']['config_setting'], true);
                                	@endphp
									<h3 class="footer-title">{{ $data['title'] }}</h3>
									<div class="footer-column-2" style="word-wrap: break-word;">
										{!! $data['config'] !!}
									</div>
									@php unset($data); @endphp
									@endif
								</div>
							</div>
							<div class="col-md-6">
								<div class="footer-widget">
									@if(!empty($settingConfig['frontend_footer_column_3']['config_setting']))
                                	@php $data = json_decode($settingConfig['frontend_footer_column_3']['config_setting'], true);
                                	@endphp
									<h3 class="footer-title">{{ $data['title'] }}</h3>
									<div class="footer-column-3" style="word-wrap: break-word;">
										{!! $data['config'] !!}
									</div>
									@php unset($data); @endphp
									@endif
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-3">
						@if(!empty($settingConfig['frontend_footer_column_4']['config_setting']))
                            @php $data = json_decode($settingConfig['frontend_footer_column_4']['config_setting'], true);
                            @endphp
						<div class="footer-widget">
							<h3 class="footer-title">{{ $data['title'] }}</h3>
							<div class="footer-column-4" style="word-wrap: break-word;">
							{!! $data['config'] !!}
							</div>
						</div>
						@php unset($data); @endphp
						@endif
					</div>

				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</footer>
		<!-- /Footer -->

		<!-- jQuery Plugins -->
		<script src="{{ asset('js/jquery.min.js') }}"></script>
		<script src="{{ asset('js/bootstrap.min.js') }}"></script>
		<script src="{{ asset('js/main.js') }}"></script>
		<script src="{{ asset('js/particles.js') }}"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/highlight.min.js"></script>
		<script src="https://unpkg.com/highlightjs-copy/dist/highlightjs-copy.min.js"></script>
        <script>
            hljs.initHighlightingOnLoad();
            hljs.addPlugin(new CopyButtonPlugin());
            var jsQuery = $('.jsQuery');
            var phpQuery = $('.phpQuery');
            var pythonQuery = $('.pythonQuery');
            jsQuery.each(function(index, obj) {
                const el = $(obj);
                el.parent().addClass("box-view-wrapper");
                el.html(`<div class="box-code-view"><pre><code class="language-javascript">${el.text()}</code></pre></div>`);
            });
            phpQuery.each(function(index, obj) {
                const el = $(obj);
                el.html(`<div class="box-code-view"><pre><code class="language-php">${el.text()}</code></pre></div>`);
            });
            pythonQuery.each(function(index, obj) {
                const el = $(obj);
                el.html(`<div class="box-code-view"><pre><code class="language-python">${el.text()}</code></pre></div>`);
            });
        </script>
		@stack('scripts')
	</body>	
</html>
