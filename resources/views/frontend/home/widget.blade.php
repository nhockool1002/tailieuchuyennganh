					<div class="col-md-4">
						<!-- post widget -->
						<div class="aside-widget">
							<div class="section-title">
								<h2>Thư viện đồ hoạ</h2>
							</div>
							@foreach($graphic6post as $post)
							<div class="post post-widget">
								<a class="post-img" href="{{ route('getPost', ['id' => $post->id, 'slug' => $post->post_slug ]) }}"><img src="{{ \Constant::IMAGE_THUMB_POST }}/{{ $post->post_img }}" alt="{{ $post->post_slug }}"></a>
								<div class="post-body">
									<h3 class="post-title"><a href="{{ route('getPost', ['id' => $post->id, 'slug' => $post->post_slug ]) }}">{{ $post->post_name }}</a></h3>
								</div>
							</div>
							@endforeach
						</div>
						<!-- /post widget -->

						<!-- post widget -->
						<div class="aside-widget">
							<div class="section-title">
								<h2>Sách hay mỗi ngày</h2>
							</div>
							@foreach($random2book as $post)
							<div class="post post-thumb">
								<a class="post-img" href="{{ route('getPost', ['id' => $post->id, 'slug' => $post->post_slug ]) }}"><img class="h40" src="{{ \Constant::IMAGE_THUMB_POST}}/{{ $post->post_img }}" alt="{{ $post->post_slug }}"></a>
								<div class="post-body">
									<h3 class="post-title"><a href="{{ route('getPost', ['id' => $post->id, 'slug' => $post->post_slug ]) }}">{{ $post->post_name }}</a></h3>
								</div>
							</div>
							@endforeach
						</div>
						<!-- /post widget -->
						
						<!-- ad -->
						<div class="aside-widget text-center">
							@include('frontend.ads.ads-right-widget-home')
						</div>
						<!-- /ad -->
					</div>
